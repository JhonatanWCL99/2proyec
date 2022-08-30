<?php

namespace App\Http\Controllers\Siat;

use App\Http\Controllers\Controller;
use App\Models\Siat\ListadoTotalActividad;
use App\Models\Siat\TipoDocumentoSector;
use Illuminate\Http\Request;
use App\Services\CuisService;
use App\Services\SincronizarCatalogosService;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioFacturacion;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioFacturacionSincronizacion;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioSiat;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\SiatConfig;

class SincronizarCatalogosController extends Controller
{
    public $config;

    public function __construct()
    {
        $this->config = new SiatConfig([
            'nombreSistema' => 'MAGNOREST',
            'codigoSistema' => '722907F2BAECC0B26025FE7',
            'nit'           => 166172023,
            'razonSocial'   => 'DONESCO S.R.L',
            'modalidad'     => ServicioSiat::MOD_COMPUTARIZADA_ENLINEA,
            'ambiente'      => ServicioSiat::AMBIENTE_PRUEBAS,
            'tokenDelegado'    => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJET05FU0NPXzAyMyIsImNvZGlnb1Npc3RlbWEiOiI3MjI5MDdGMkJBRUNDMEIyNjAyNUZFNyIsIm5pdCI6Ikg0c0lBQUFBQUFBQUFETTBNek0wTnpJd01nWUE3bHFjcHdrQUFBQT0iLCJpZCI6NTE5NjgyLCJleHAiOjE2NjQ1ODI0MDAsImlhdCI6MTY2MDgyOTA0NCwibml0RGVsZWdhZG8iOjE2NjE3MjAyMywic3Vic2lzdGVtYSI6IlNGRSJ9.8ubSTM8oYEuY7pHiNQYbNj6I87koRUqzOqsQ341VMKwA8Y_A9nh_qA4ttCdY-6HywevMQ4Ov64I-w7S3k47NYw',
            /* 'pubCert'		=> MOD_SIAT_DIR . SB_DS . 'certs' . SB_DS . 'terminalx' . SB_DS . 'certificado.pem',
          'privCert'		=> MOD_SIAT_DIR . SB_DS . 'certs' . SB_DS . 'terminalx' . SB_DS . 'llave_privada.pem', */
            'telefono'        => '34345435',
            'ciudad'        => 'SANTA CRUZ GC'
        ]);
    }
    function sincronizarListaLeyendasFactura($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $count = 0;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarListaLeyendasFactura($sucursal, $puntoventa);
        $leyendas_facturas = new SincronizarCatalogosService();
        $response = $leyendas_facturas->create_lista_leyendas($res);
        return $response;
    }

    function sincronizarListadoTotalActividades($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $count = 0;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarActividades($sucursal, $puntoventa);

        $total_actividades = new SincronizarCatalogosService();
        $response = $total_actividades->create_listado_actividades($res);

        return $response;
    }

    function sincronizarFechaHora($sucursal_id)
    {

        $sucursal = $sucursal_id;
        $puntoventa = 0;

        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarFechaHora($sucursal, $puntoventa);

        $fecha_hora = new SincronizarCatalogosService();
        $response = $fecha_hora->create_fecha_hora_actual($res);

        return $response;
    }

    function sincronizarMensajesServicios($sucursal_id)
    {

        $sucursal = $sucursal_id;
        $puntoventa = 0;

        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);

        $res = $service->sincronizarListaMensajesServicios($sucursal, $puntoventa);

        $service_message = new SincronizarCatalogosService();
        $response = $service_message->create_mensajes_servicios($res);

        return $response;
    }

    function sincronizarProductosServicios($sucursal_id)
    {

        $sucursal = $sucursal_id;
        $puntoventa = 0;

        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);

        $res = $service->sincronizarListaProductosServicios($sucursal, $puntoventa);

        $product_service = new SincronizarCatalogosService();
        $response = $product_service->create_productos_servicios($res);

        return $response;
    }

    function sincronizarEventosSignificativos($sucursal_id)
    {

        $sucursal = $sucursal_id;
        $puntoventa = 0;

        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);

        $res = $service->sincronizarParametricaEventosSignificativos($sucursal, $puntoventa);

        $signifficant_event = new SincronizarCatalogosService();
        $response = $signifficant_event->create_eventos_significativos($res);

        return $response;
    }

    function sincronizarMotivosAnulaciones($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;

        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);

        $res = $service->sincronizarParametricaMotivoAnulacion($sucursal, $puntoventa);

        $anulation_reason = new SincronizarCatalogosService();
        $response = $anulation_reason->create_motivo_anulacion($res);

        return $response;
    }

    function sincronizarListadoPaises($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;

        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);

        $res = $service->sincronizarParametricaPaisOrigen($sucursal, $puntoventa);

        $listado_paises = new SincronizarCatalogosService();
        $response = $listado_paises->create_listado_paises($res);

        return $response;
    }

    function sincronizarDocumentosIdentidades($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;

        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);

        $res = $service->sincronizarParametricaTipoDocumentoIdentidad($sucursal, $puntoventa);

        $identity_document = new SincronizarCatalogosService();
        $response = $identity_document->create_documento_identidad($res);

        return $response;
    }


    /*Ya esta Probado*/
    function sincronizarTiposDocumentoSector($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarParametricaTipoDocumentoSector($sucursal, $puntoventa);

        $tipoDocumentosSector = new SincronizarCatalogosService();
        /* return $res; */
        $response = $tipoDocumentosSector->createTiposDocumentosSector($res);

        return $response;
    }

    /*Ya esta Probado*/
    function sincronizarTiposEmisiones($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarParametricaTipoEmision($sucursal, $puntoventa);

        $tipoDocumentosSector = new SincronizarCatalogosService();
        $response = $tipoDocumentosSector->createTiposEmisiones($res);

        return $response;
    }

    /*Ya esta Probado*/
    function sincronizarTiposHabitaciones($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarParametricaTipoHabitacion($sucursal, $puntoventa);

        $tipoDocumentosSector = new SincronizarCatalogosService();
        $response = $tipoDocumentosSector->createTiposHabitaciones($res);

        return $response;
    }

    /*Ya esta Probado*/
    function sincronizarMetodosPagos($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarParametricaTipoMetodoPago($sucursal, $puntoventa);

        $tipoDocumentosSector = new SincronizarCatalogosService();
        $response = $tipoDocumentosSector->createMetodosPagos($res);

        return $response;
    }

    /*Ya esta Probado*/
    function sincronizarTiposMonedas($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarParametricaTipoMoneda($sucursal, $puntoventa);

        $tipoDocumentosSector = new SincronizarCatalogosService();
        $response = $tipoDocumentosSector->createTiposMonedas($res);

        return $response;
    }

    /*Ya esta Probado*/
    function sincronizarTiposPuntosVentas($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarParametricaTipoPuntoVenta($sucursal, $puntoventa);

        $tipoDocumentosSector = new SincronizarCatalogosService();
        $response = $tipoDocumentosSector->createTiposPuntosVentas($res);

        return $response;
    }

    /*Ya esta Probado*/
    function sincronizarTiposPuntosFacturas($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarParametricaTiposFactura($sucursal, $puntoventa);

        $tipoDocumentosSector = new SincronizarCatalogosService();
        $response = $tipoDocumentosSector->createTiposFacturas($res);

        return $response;
    }

    /*Ya esta Probado*/
    function sincronizarUnidadesMedidades($sucursal_id)
    {
        $sucursal = $sucursal_id;
        $puntoventa = 0;
        $cuisService = new CuisService();
        $resCuis     = $cuisService->obtenerCuis($puntoventa, $sucursal, true);
        $service     = new ServicioFacturacionSincronizacion($resCuis->RespuestaCuis->codigo);
        $service->setConfig((array)$this->config);
        $res = $service->sincronizarParametricaUnidadMedida($sucursal, $puntoventa);

        $tipoDocumentosSector = new SincronizarCatalogosService();
        $response = $tipoDocumentosSector->createUnidadesMedidas($res);

        return $response;
    }



    /* FUNCION QUE EJECUTA TODOS LOS CATALOGOS */

    function ejecutar_pruebas_catalogos()
    {
        $sucursal = 1;
        $this->sincronizarFechaHora($sucursal);
        $this->sincronizarUnidadesMedidades($sucursal);
        $this->sincronizarTiposPuntosVentas($sucursal);
        $this->sincronizarTiposMonedas($sucursal);
        $this->sincronizarTiposPuntosFacturas($sucursal);
        $this->sincronizarListadoPaises($sucursal);
        $this->sincronizarDocumentosIdentidades($sucursal);
        $this->sincronizarMensajesServicios($sucursal);
        $this->sincronizarMotivosAnulaciones($sucursal); 
        $this->sincronizarTiposDocumentoSector($sucursal);
        $this->sincronizarListaLeyendasFactura($sucursal);
        $this->sincronizarDocumentosIdentidades($sucursal);
        $this->sincronizarEventosSignificativos($sucursal);
        $this->sincronizarListadoTotalActividades($sucursal);
        $this->sincronizarMetodosPagos($sucursal);
        $this->sincronizarProductosServicios($sucursal);
        $this->sincronizarTiposEmisiones($sucursal);
        $this->sincronizarTiposHabitaciones($sucursal); 
        $count = 0;
      
    }
}
