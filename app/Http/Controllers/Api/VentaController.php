<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Autorizacion;
use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\RegistroVisita;
use App\Models\TurnoIngreso;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function registerSale(Request $request)
    {
        try {
            DB::beginTransaction();
            $fecha = Carbon::now()->toDateString();
            $hora_actual = Carbon::now()->toTimeString();
            $user = User::find($request->user_id);
            $cliente = Cliente::where('ci_nit', "=", $request->nit_ci)->first();
            $cantidad_visitas = 1;
            $cantidad_transacciones = 1;
            $sucursal =$request->sucursal;

            if ($request->cliente == "SIN NOMBRE" && $request->empresa == "SIN EMPRESA" && $request->nit_ci == 0 && $request->telefono == 0) {
                $cliente = $this->registrarclienteSN();
            } else {
                if (is_null($cliente)) {
                    $cliente = new Cliente();
                    $cliente->nombre = $request->cliente;
                    $cliente->ci_nit = $request->nit_ci;
                    $cliente->empresa = $request->empresa;
                    $cliente->telefono = $request->telefono;
                    $cliente->contador_visitas = $sucursal==18?$cantidad_visitas:0;//17 PIRAI, sino sera 0 sus visitas
                    $cliente->save();
                } else {
                    $cantidad_visitas = intval($cliente->contador_visitas) + 1;
                    if ($cliente->nombre != $request->cliente) {
                        $cliente->nombre = $request->cliente;
                    }
                    if ($cliente->empresa != $request->empresa) {
                        $cliente->empresa = $request->empresa;
                    }
                    if ($cliente->telefono != $request->telefono) {
                        $cliente->telefono = $request->telefono;
                    }
                    if ($cliente->nombre != $request->cliente || $cliente->empresa != $request->empresa || $cliente->telefono != $request->telefono) {
                    }
                    $cliente->contador_visitas =$sucursal==18?$cantidad_visitas:0;
                    $cliente->save();
                }
            }

            $venta = new Venta();
            $venta->fecha_venta = Carbon::now();
            $venta->hora_venta = $hora_actual;
            $venta->total_venta = $request->total_venta;
            $venta->tipo_pago = $request->tipo_pago;
            $venta->lugar = $request->lugar;

            if($request->lugar=="Delivery"){
                $venta->nombre_delivery=$request->delivery;
            }

            $venta->nro_transaccion = $cantidad_transacciones;
            $venta->estado = 1;

            $venta->turnos_ingreso_id = $request->turno_id;
            $venta->user_id = $user->id;
            $venta->cliente_id = $cliente->id;
            $venta->sucursal_id = $user->sucursals[0]->id;

            $lastventa = Venta::where('sucursal_id', $user->sucursals[0]->id)->where('turnos_ingreso_id', $request->turno_id)->count();


            $cantidad_transacciones = intval($lastventa) + 1;

            $turno = TurnoIngreso::find($request->turno_id);

            $turno->nro_transacciones++;
            $venta->nro_transaccion = $turno->nro_transacciones;
            $turno->save();

            $autorizacion =  Autorizacion::where('sucursal_id', $request->sucursal)->where('estado', 0)->first();
            if ($request->tipo_pago != 'Comida Personal') {
                //ultimo registro de autorizaciones, incrementar factura 

                if (is_null($autorizacion) != true) {
                    $autorizacion->nro_factura = intval($autorizacion->nro_factura) + 1;
                    $autorizacion->save();
                }


                $venta->numero_factura = $autorizacion->nro_factura;
                $venta->codigo_control = $request->codigo_control;
                $venta->qr = $request->qr;
                $venta->autorizacion_id = $autorizacion->id;
            } else {
                $venta->numero_factura = 0;
                $venta->codigo_control = '0';
                $venta->qr = '0';
                $venta->autorizacion_id = $autorizacion->id;
            }

            $venta->save();
            foreach ($request->detalle_venta as $detalle) {
                $detalle_venta = new DetalleVenta();
                $detalle_venta->cantidad = $detalle["cantidad"];
                $detalle_venta->precio = $detalle["costo"];
                $detalle_venta->subtotal = $detalle["subtotal"];
                $detalle_venta->plato_id = $detalle["plato_id"];
                $detalle_venta->venta_id = $venta->id;
                $detalle_venta->save();
            }

            $registro_visita = RegistroVisita::create([
                'fecha' => $fecha,
                'registro_contador' =>$sucursal==18? $cantidad_visitas:0,//HABILITADO PARA PIRAI, SINO SERA 0
                'cliente_id' => $cliente->id,
                'venta_id' => $venta->id,
            ]);

            if ($cliente->contador_visitas == 10) {
                $cantidad_visitas = 0;
                $cliente->contador_visitas = $cantidad_visitas;
                $cliente->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'msg' => "Venta registrada Exitosamente",
                'cantidad_visitas' => $cliente->contador_visitas,
                'cliente' => $cliente
            ])->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage(),
            ])->header('Content-Type', 'application/json');
        }
    }

    public function registrarclienteSN()
    {

        $cliente = Cliente::where('nombre', "SIN NOMBRE")->first();
        if (is_null($cliente)) {
            $cliente = new Cliente();
            $cliente->nombre = "SIN NOMBRE";
            $cliente->ci_nit = 0;
            $cliente->empresa = "SIN EMPRESA";
            $cliente->telefono = 0;
            $cliente->contador_visitas = 0;
            $cliente->save();
        }
        return $cliente;
    }
}
