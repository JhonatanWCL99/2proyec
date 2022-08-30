<?php

namespace App\Http\Controllers\Siat;

use App\Http\Controllers\Controller;
use App\Models\Siat\SiatCufd;
use App\Models\Sucursal;
use App\Services\ConfigService;
use App\Services\CufdService;
use App\Services\CuisService;
use App\Services\EmisionIndividualService;
use App\Services\EmisionPaqueteService;
use Carbon\Carbon;
use Illuminate\Http\Request;


class EmisionPaqueteController extends Controller
{

    public $configService;
    public $cuisService;
    public $cufdService;
    public $emisionIndividualService;
    public $emisionPaqueteService;

    public function __construct()
    {
        $this->configService = new ConfigService();
        $this->cuisService = new CuisService();
        $this->cufdService = new CufdService();
        $this->emisionIndividualService = new EmisionIndividualService();
        $this->emisionPaqueteService = new EmisionPaqueteService();
    }

    public function emisionPaquetes()
    {
        $sucursal = 0;
        $puntoventa = 0;
        $cantidad = 500;
        $codigoEvento = 5;
        $fecha_generica = Carbon::now();
        $sucursal_db = Sucursal::where('codigo_fiscal', $sucursal)->first();
        $cufd_bd = SiatCufd::where('sucursal_id', $sucursal_db->id)->orderBy('fecha_generado', 'desc')->first();
        $cufdAntiguo = $cufd_bd;
        $codigoControlAntiguo     = $cufd_bd->codigo_control;
        $fechaInicio     = (new Carbon($cufd_bd->fecha_generado))->format("Y-m-d\TH:i:s.v");
        $fechaFin        = (new Carbon())->subMinutes(2)->format("Y-m-d\TH:i:s.v");

        $cafc            = null; //'101B4283AAD6D';
        $resEvento         = null;
        $resCuis         = $this->cuisService->obtenerCuis($puntoventa, $sucursal);
        $resCufd        = $this->cufdService->obtenerCufd($puntoventa, $sucursal, $resCuis->RespuestaCuis->codigo);
        $evento         = $this->emisionPaqueteService->obtenerListadoEventos($sucursal, $puntoventa, $codigoEvento);
        $evento or die('Evento no encontrado');

        $pvfechaInicio     = $fechaInicio;
        $pvfechaFin        = $fechaFin;
        /* for ($i = 0; $i < 70; $i++) { */
        # code...

        $resEvento         = $resEvento ?: $this->emisionPaqueteService->registroEvento(
            $resCuis->RespuestaCuis->codigo,
            $resCufd->RespuestaCufd->codigo,
            $sucursal,
            $puntoventa,
            $evento,
            $cufdAntiguo->codigo,
            $fechaInicio,
            $fechaFin
        );
        if (!isset($resEvento->RespuestaListaEventos->codigoRecepcionEventoSignificativo)) {
            print_r($resEvento);
            die("No se pudo registrar el evento significativo\n");
        }
        $this->emisionPaqueteService->test_log($resEvento);
        $facturas         = $this->emisionPaqueteService->construirFacturas(
            $sucursal,
            $puntoventa,
            $cantidad,
            $this->configService->documentoSector,
            $this->configService->codigoActividad,
            $this->configService->codigoProductoSin,
            $pvfechaInicio,
            $cufdAntiguo
        );


        $res = $this->emisionPaqueteService->testPaquetes($sucursal, $puntoventa, $facturas, $codigoControlAntiguo, $this->configService->tipoFactura, $resEvento->RespuestaListaEventos, $cafc);
        if (isset($res->RespuestaServicioFacturacion->codigoRecepcion)) {
            $res = $this->emisionPaqueteService->testRecepcionPaquete($sucursal, $puntoventa, $this->configService->documentoSector, $this->cofigService->tipoFactura, $res->RespuestaServicioFacturacion->codigoRecepcion);
            print_r($res);
        }

        $this->emisionPaqueteService->test_log($pvfechaInicio);
        $this->emisionPaqueteService->test_log($pvfechaFin);
        /* } */
    }
}
