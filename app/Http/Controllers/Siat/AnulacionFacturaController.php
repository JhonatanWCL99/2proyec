<?php

namespace App\Http\Controllers\siat;

use App\Http\Controllers\Controller;
use App\Models\Siat\MotivoAnulacion;
use App\Models\Venta;
use App\Services\AnulacionFacturaService;
use CreateSiatMotivosAnulacionesTable;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnulacionFacturaController extends Controller
{
    public $emisionIndividualService;
    
    public function index(){

        $fecha_actual =  Carbon::now()->subDay()->toDateString();
        /* dd($fecha_actual); */
        $motivos_anulaciones =  MotivoAnulacion::all();
        $ventas = Venta::where('fecha_venta',$fecha_actual)->get();

        return view('siat.anulaciones_facturas.index', compact('fecha_actual','ventas','motivos_anulaciones'));
    }

    public function filtrar_facturas(Request $request){
        $fecha_inicial = $request->fecha_inicial;
        $fecha_final = $request->fecha_final;
        $motivos_anulaciones =  MotivoAnulacion::all();

        $ventas = Venta::whereBetween('fecha_venta',[$fecha_inicial,$fecha_final])->get();

        return view('siat.anulaciones_facturas.index', compact('fecha_actual','ventas','motivos_anulaciones'));
    }

    
    public function test_anulacion_factura(){

        $anulacion_factura_service = new AnulacionFacturaService();
        $res = $anulacion_factura_service->pruebasAnulacion();
        return $res;
    }

    public function anular_factura($factura_id, Request $request){

        $factura_id = Venta::find($request->factura_id);
        $anulacion_factura_service = new AnulacionFacturaService();
        $res = $anulacion_factura_service->pruebasAnulacion($factura_id);
        return $res;

    }
}
