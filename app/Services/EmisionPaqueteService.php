<?php

namespace App\Services;

use App\Models\Siat\EventoSignificativo;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioFacturacionSincronizacion;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioOperaciones;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\SiatInvoice;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioFacturacionComputarizada;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\SiatFactory;

class EmisionPaqueteService
{
    public $cuisService;
    public $cufdService;
    public $configService;
    public $emisionIndividualService;

    public function __construct()
    {
        $this->cuisService = new CuisService();
        $this->cufdService = new CufdService();
        $this->configService = new ConfigService();
        $this->emisionIndividualService = new EmisionIndividualService();
    }

    function obtenerListadoEventos($codigoSucursal = 0, $codigoPuntoVenta = 1, $buscarId = null)
    {
        $resCuis = $this->cuisService->obtenerCuis($codigoPuntoVenta, $codigoSucursal);
        //##obtener listado de eventos
        $serviceSync = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $serviceSync->setConfig((array)$this->configService->config);
        $serviceSync->cuis = $resCuis->RespuestaCuis->codigo;

        $eventsList = $serviceSync->sincronizarParametricaEventosSignificativos($codigoSucursal, $codigoPuntoVenta);
        if (!$buscarId)
            return $eventsList;

        $nombre_evento = 'CORTE DEL SERVICIO DE INTERNET';
        $evento = null;
        foreach ($eventsList->RespuestaListaParametricas->listaCodigos as $evt) {
            if ($evt->codigoClasificador == $buscarId) {
                $evento = $evt;
                break;
            }
        }
        return $evento;
    }

    function registroEvento($cuis, $cufd, $sucursal, $puntoventa, object $evento, $cufdAntiguo, $fechaInicio, $fechaFin)
    {
        /* dd($evento); */
        $serviceOps = new ServicioOperaciones();
        $serviceOps->setConfig((array)$this->configService->config);
        $serviceOps->cuis = $cuis;
        $serviceOps->cufd = $cufd;
        $resEvent = $serviceOps->registroEventoSignificativo(
            $evento->codigoClasificador,
            $evento->descripcion,
            $cufdAntiguo,
            $fechaInicio,
            $fechaFin,
            $sucursal,
            $puntoventa
        );
        return $resEvent;
    }

    function construirFacturas($sucursal, $puntoventa, int $cantidad, $documentoSector, $codigoActividad, $codigoProductoSin, &$fechaEmision = null, $cufdAntiguo = null, $cafc = null)
    {
        $facturas = [];
        for ($i = 0; $i < $cantidad; $i++) {
            $factura = $this->emisionIndividualService->construirFactura($puntoventa, $sucursal, $this->configService->config->modalidad, $documentoSector, $codigoActividad, $codigoProductoSin);
            $factura->cabecera->nitEmisor = $this->configService->config->nit;
            $factura->cabecera->razonSocialEmisor = $this->configService->config->razonSocial;
            $factura->cabecera->fechaEmision = $fechaEmision ?: date('Y-m-d\TH:i:s.v');
            $factura->cabecera->cufd = $cufdAntiguo;
            $factura->cabecera->cafc = $cafc;
            $facturas[] = $factura;
            $fechaEmision = date('Y-m-d\TH:i:s.v', strtotime($fechaEmision) + 10);
        }
        return $facturas;
    }

    function testPaquetes($codigoSucursal, $codigoPuntoVenta, array $facturas, $codigoControlAntiguo, $tipoFactura, $evento, $cafc = null)
    {

        $resCuis = $this->cuisService->obtenerCuis($codigoPuntoVenta, $codigoSucursal);
        $resCufd = $this->cufdService->obtenerCufd($codigoPuntoVenta, $codigoSucursal, $resCuis->RespuestaCuis->codigo);
        //var_dump('CUIS PRIMARIO: ' . $resCuis->RespuestaCuis->codigo);

        if (!$evento)
            die('ERROR: No se encontro el evento');


        $service = SiatFactory::obtenerServicioFacturacion($this->configService->config, $resCuis->RespuestaCuis->codigo, $resCufd->RespuestaCufd->codigo, $codigoControlAntiguo);
        //$service->setConfig((array)$config);
        //$service->codigoControl = $codigoControlAntiguo;
        $res = $service->recepcionPaqueteFactura(
            $facturas,
            $evento->codigoRecepcionEventoSignificativo,
            SiatInvoice::TIPO_EMISION_OFFLINE,
            $tipoFactura,
            $cafc
        );
        $this->test_log("RESULTADO RECEPCION PAQUETE\n=============================");
        $this->test_log($res);
        return $res;
    }

    function testRecepcionPaquete($codigoSucursal, $codigoPuntoVenta, $documentoSector, $tipoFactura, $codigoRecepcion)
    {

        $resCuis =  $this->cuisService->obtenerCuis($codigoPuntoVenta, $codigoSucursal);
        $resCufd =  $this->cufdService->obtenerCufd($codigoPuntoVenta, $codigoSucursal, $resCuis->RespuestaCuis->codigo);

        $service = new ServicioFacturacionComputarizada(
            $resCuis->RespuestaCuis->codigo,
            $resCufd->RespuestaCufd->codigo
        );
        //$service->setConfig((array)$config);
        //$service->codigoControl = $resCufd->RespuestaCufd->codigoControl;
        $res = $service->validacionRecepcionPaqueteFactura($codigoSucursal, $codigoPuntoVenta, $codigoRecepcion, $tipoFactura, $documentoSector);

        while ($res->RespuestaServicioFacturacion->codigoDescripcion == 'PENDIENTE') {
            echo "REINTENTANTO RESPUESTA RECEPCION PAQUETE\n=====================\n";
            $res = testRecepcionPaquete($codigoSucursal, $codigoPuntoVenta, $documentoSector, $tipoFactura, $codigoRecepcion);
        }
        echo "RESPUESTA RECEPCION PAQUETE\n=====================\n";
        print_r($res);
        return $res;
    }

    function test_log($data, $destFile = null)
    {
     

        $filename = __DIR__ . '/nit-' . $this->configService->config->nit . ($destFile ? '-' . $destFile : '') . '.log';
        $fh = fopen($filename, is_file($filename) ? 'a+' : 'w+');
        fwrite($fh, sprintf("[%s]#\n%s\n", date('Y-m-d H:i:s'), print_r($data, 1)));
        fclose($fh);
        print_r($data);
    }
}