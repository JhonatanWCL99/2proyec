<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TurnoIngreso;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function update_state_turn(Request $request)
    {
        $id = $request->id;
        $state = $request->state;
        $turno = TurnoIngreso::find($id);
        if ($state == "Abrir") {
            //turno estado : 1 es abierto
            $turno->estado = 1;
            $turno->save();
            return response()->json([
                'status' => true,
                'msg' => "Habilitado Correctamente",
            ])->header('Content-Type', 'application/json');
        } else if ($state == "Cerrar") {
            //turno estado : 0 es cerrado
            $turno->estado = 0;
            $turno->save();
            return response()->json([
                'status' => true,
                'msg' => "Inhabilitado Correctamente",
            ])->header('Content-Type', 'application/json');
        }
    }

    public function get_tax_sales(Request $request)
    {
        //0 Anulado : 1 Habilitado
        $turno_id = $request->turno_id;
        $sucursal_id = $request->sucursal_id;
        $ventas_fiscales = Venta::selectRaw('categorias_plato.nombre, sum(detalles_ventas.cantidad) as cantidad, sum(detalles_ventas.subtotal) as subtotal')
            ->join('detalles_ventas', 'detalles_ventas.venta_id', '=', 'ventas.id')
            ->join('platos', 'platos.id', '=', 'detalles_ventas.plato_id')
            ->join('platos_sucursales', 'platos_sucursales.plato_id', '=', 'platos.id')
            ->join('categorias_plato', 'categorias_plato.id', '=', 'platos_sucursales.categoria_plato_id')
            ->join('turnos_ingresos', 'turnos_ingresos.id', '=', 'ventas.turnos_ingreso_id')
            ->where('ventas.turnos_ingreso_id', $turno_id)
            ->where('ventas.estado', 1)
            ->where('platos_sucursales.sucursal_id', $sucursal_id)
            ->where('ventas.tipo_pago', "<>", 'Comida Personal')
            ->where('ventas.tipo_pago', "<>", 'Comida Personal')
            ->groupBy(['categorias_plato.nombre'])
            ->get();

        $turno = TurnoIngreso::find($turno_id);
        $json = [
            'ventas_fiscales' => $ventas_fiscales,
            'fecha' => $turno->fecha,
            'hora_inicio' => $turno->hora_inicio,
            'hora_fin' => $turno->hora_fin != null ? $turno->hora_fin : "00:00:00",
            'turno' => $turno->turno == 0 ? "AM" : "PM"
        ];

        return  response($json, 200)->header('Content-Type', 'application/json');
    }

    public function get_transaction(Request $request)
    {
        $turno = TurnoIngreso::find($request->turno_id);

        return  response(['nro_transaccion' => $turno->nro_transacciones != null ? $turno->nro_transacciones : 0], 200)->header('Content-Type', 'application/json');
    }

    public function check_open_turn(Request $request)
    {
        //turno estado : 1 es abierto - turno estado : 0 es cerrado
        $sucursal_id = $request->sucursal_id;
        $fecha_actual = Carbon::now()->format('Y-m-d');
        $turno = TurnoIngreso::where('sucursal_id', $sucursal_id)
            ->where('fecha', $fecha_actual)
            ->where('estado', 1)
            ->first();

        if (!is_null($turno)) {
            return  response(["status" => true, "msj" => "Ya existe un Turno Abierto"], 200)->header('Content-Type', 'application/json');
        } else {
            return  response(["status" => false, "msj" => "No hay Turnos Abiertos"], 200)->header('Content-Type', 'application/json');
        }
    }

    public function get_open_turn(Request $request)
    {

        $sucursal_id = $request->sucursal_id;
        $fecha_actual = Carbon::now()->format('Y-m-d');
        $turno = TurnoIngreso::where('sucursal_id', $sucursal_id)
            ->where('fecha', $fecha_actual)
            ->where('estado', 1)
            ->first();

        return response(["turno" => $turno != null ? $turno : []], 200)->header('Content-Type', 'application/json');

    }
}
