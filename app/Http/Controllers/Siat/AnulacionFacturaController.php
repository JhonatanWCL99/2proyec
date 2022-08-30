<?php

namespace App\Http\Controllers\siat;

use App\Http\Controllers\Controller;
use App\Services\AnulacionFacturaService;
use Illuminate\Http\Request;

class AnulacionFacturaController extends Controller
{
    public $emisionIndividualService;

    public function test_anulacion_factura(){

        $anulacion_factura_service = new AnulacionFacturaService();
        $res = $anulacion_factura_service->pruebasAnulacion();
        return $res;

    }
}
