<?php

namespace App\Http\Controllers\Siat;
use Carbon\Carbon;
use App\Models\Venta;
use Illuminate\Http\Request;
use App\Services\CuisService;
use App\Services\CufdService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Siat\EventoSignificativo;
use App\Services\EventoSignificativoService;

class EventoSignificativoController extends Controller
{
    public $cuisService;
    public $cufdService;
    public $emisionIndividualService;

    public function __construct()
    {
        $this->cuisService = new CuisService();
        $this->cufdService = new CufdService();
        
    }

    public function generar_evento_significativo(){
        $evento_significativoService = new EventoSignificativoService();
        $response = $evento_significativoService->pruebasEventos2();
        return $response;

    }

    public function index(){
        $fecha_actual = Carbon::now()->toDateString();
        $eventos_significativos = EventoSignificativo::all();

        $ventas = Venta::where('sucursal_id', Auth::user()->sucursals[0]->id)
        ->where('fecha_venta', (new Carbon())->toDateString())
        ->where('estado',1)
        ->get();
        return view('siat.eventos_significativos.index',compact('eventos_significativos','ventas','fecha_actual'));
    }

    public function filtrarEventosSignificativos(Request $request){ 
        
        $fecha_inicial = $request->fecha_inicial;
        $fecha_final = $request->fecha_final;
        $evento_significativo =$request->evento_significativo_id;

        $fecha_actual = Carbon::now()->toDateString();
        $eventos_significativos = EventoSignificativo::all();

        $ventas = Venta::where('sucursal_id', Auth::user()->sucursals[0]->id)
        ->whereBetween('fecha_venta',[$fecha_inicial,$fecha_final])
        ->where('ventas.evento_significativo_id',$evento_significativo)
        ->where('estado',1)
        ->get();
        

        return view('siat.eventos_significativos.index',compact('eventos_significativos','ventas','fecha_actual'));
    }


    
}
