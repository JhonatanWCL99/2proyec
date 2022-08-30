<?php

namespace App\Http\Controllers\Siat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CuisService;
use App\Services\CufdService;
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

    
}
