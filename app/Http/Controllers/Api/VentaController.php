<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Siat\EmisionIndividualController;
use App\Models\Autorizacion;
use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\RegistroVisita;
use App\Models\Sucursal;
use App\Models\TurnoIngreso;
use App\Models\User;
use App\Models\Venta;
use App\Services\ClienteService;
use App\Services\VentaService;
use Carbon\Carbon;
use Error;
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
           
           
            $cantidad_visitas = 1;
            $sucursal =$request->sucursal;

           /*  return response()->json($request->nit_ci); */

            $clienteData = [
                'cliente'=>$request->cliente,
                'ci_nit'=>$request->nit_ci,
                'telefono'=>$request->telefono,
                'empresa'=>$request->empresa,
                'sucursal'=>$request->sucursal,
                'cantidad_visitas'=>$cantidad_visitas,
            ];

            $clienteService = new ClienteService();
            $cliente = $clienteService->registrarCliente($clienteData);

            $ventaData = collect([
                'user_id'=>$request->user_id,
                'total_venta'=>$request->total_venta,
                'tipo_pago'=>$request->tipo_pago,
                'lugar'=>$request->lugar,
                'delivery'=>$request->delivery,
                'turno_id'=>$request->turno_id,
                'cliente_id'=>$cliente->id,
                'sucursal'=>$sucursal,
                'tipo_pago'=>$request->tipo_pago,
                'codigo_control'=>$request->codigo_control,
                'qr'=>$request->qr,
            ]);

            $ventaService = new VentaService();
            $venta = $ventaService->registrarVenta($ventaData);
           /*  return $venta; */
            foreach ($request->detalle_venta as $detalle) {
               $ventaService->registrarDetalleVenta($detalle,$venta->id);
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

            $user=User::find($request->user_id);
            $sucursal = Sucursal::find($sucursal);
            DB::commit();

            $dataFactura=[
                'cliente'=>$cliente,
                'sucursal'=>$sucursal,
                'user'=>$user,
                'venta'=>$venta,
                'detalle_venta'=>$request->detalle_venta,
            ];



            /* return response()->json($dataFactura); */

         /*    $emisionIndividualController = new EmisionIndividualController();

            $response = $emisionIndividualController->emisionIndividual($dataFactura); */
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

   
}
