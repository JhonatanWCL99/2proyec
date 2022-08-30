<?php

namespace App\Http\Controllers\Siat;

use App\Http\Controllers\Controller;
use App\Models\Siat\RegistroPuntoVenta;
use App\Models\Siat\SiatCui;
use App\Models\Sucursal;
use App\Services\CuisService;
use Illuminate\Http\Request;

class CuisController extends Controller
{


    public function index()
    {
        $cuis = SiatCui::all();
        return view('siat.cuis.index', compact('cuis'));
    }

    public function create()
    {
        $sucursales = Sucursal::all();
        return view('siat.cuis.create', compact('sucursales'));
    }

    public function store(Request $request)
    {
       /*  $codigoPuntoVenta = RegistroPuntoVenta::where('sucursal_id', $request->sucursal_id)->first();
        if (is_null($codigoPuntoVenta)) {
            return response()->json(["error" => "No Existe Punto de Venta Registrado"]);
        } */
        $cuisService = new CuisService();

        $response = $cuisService->obtenerCuis(0,  $request->sucursal_id);
        $cuisService->createCuis($response, $request->sucursal_id);
        if (isset($response->RespuestaCuis->mensajesList)) {

            if ($response->RespuestaCuis->mensajesList->codigo == 980) {
                return redirect()->route('cuis.index');
            } else {
                return response()->json(["error" => "No Se pudo guardar el cuis"]);
            }
        } else {
            return response()->json(["error"=>"Sin Codigo de Respuesta"]);

        }
    }
}
