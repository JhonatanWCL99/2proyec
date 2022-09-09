<?php
namespace App\Services;


use Carbon\Carbon;
use App\Models\Sucursal;
use App\Models\Siat\SiatCui;
use App\Models\Siat\SiatCufd;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\SiatConfig;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\SiatFactory;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\DocumentTypes;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\Hotel;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\TasaCero;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\Hospitales;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\SiatInvoice;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\CompraVenta;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioSiat;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\InvoiceDetail;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ServicioBasico;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\SectorEducativo;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaHotel;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\EntidadFinanciera;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaTasaCero;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ComercialExportacion;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaHospitales;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaCompraVenta;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaServicioBasico;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ServicioTuristicoHospedaje;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaSectorEducativo;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ComercialExportacionServicio;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaEntidadFinanciera;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaComercialExportacion;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaServicioTuristicoHospedaje;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\ElectronicaComercialExportacionServicio;



class EmisionIndividualService
{

    public $cuisService;
    public $cufdService;
    public $configService;

    public function __construct()
    {
        $this->cuisService = new CuisService();
        $this->cufdService = new CufdService();
        $this->configService = new ConfigService();
    }

    function construirFactura($codigoPuntoVenta = 0, $codigoSucursal = 0, $modalidad = 0, $documentoSector = 1, $codigoActividad = '620100', $codigoProductoSin = '', $dataFactura = null)
    {
        $subTotal = 0;
        $factura = null;
        $detailClass = InvoiceDetail::class;

        if ($modalidad == ServicioSiat::MOD_ELECTRONICA_ENLINEA) {
            if ($documentoSector == DocumentTypes::FACTURA_COMPRA_VENTA)
                $factura = new ElectronicaCompraVenta();
        } else {
            if ($documentoSector == DocumentTypes::FACTURA_COMPRA_VENTA)
                $factura = new CompraVenta();
        }

        for ($i = 0; $i < sizeof($dataFactura['detalle_venta']); $i++) {
            $detalle = new $detailClass();
            $detalle->cantidad                = $dataFactura['detalle_venta'][$i]['cantidad'];
            $detalle->actividadEconomica    = $codigoActividad;
            $detalle->codigoProducto        = $dataFactura['detalle_venta'][$i]['plato_id'];
            $detalle->codigoProductoSin        = $codigoProductoSin;
            $detalle->descripcion            = $dataFactura['detalle_venta'][$i]['plato'];
            $detalle->precioUnitario        = $dataFactura['detalle_venta'][$i]['costo'];
            $detalle->montoDescuento        = 0;
            $detalle->subTotal                = $dataFactura['detalle_venta'][$i]['subtotal'];
            $subTotal += $detalle->subTotal;
            $factura->detalle[] = $detalle;
        }
        $factura->cabecera->razonSocialEmisor    = $this->configService->config->razonSocial;
        $factura->cabecera->municipio            = 'Santa Cruz de la Sierra';
        $factura->cabecera->telefono            = '78555410';
        $factura->cabecera->numeroFactura        = $dataFactura['venta']['numero_factura'];
        $factura->cabecera->codigoSucursal        = $dataFactura['sucursal']['codigo_fiscal'];
        $factura->cabecera->direccion            = $dataFactura['sucursal']['direccion'];
        $factura->cabecera->codigoPuntoVenta    = $codigoPuntoVenta;
        $factura->cabecera->fechaEmision        = date('Y-m-d\TH:i:s.v');
        $factura->cabecera->nombreRazonSocial    = $dataFactura['cliente']['nombre'];
        $factura->cabecera->codigoTipoDocumentoIdentidad    = 5; //NIT 
        $factura->cabecera->numeroDocumento        = 166172023;
        $factura->cabecera->codigoCliente        = $dataFactura['cliente']['id']; //Codigo Unico Asignado por el sistema de facturacion (ID DEL CLIENTE)
        $factura->cabecera->codigoMetodoPago    = 1;
        $factura->cabecera->montoTotal            = $dataFactura['venta']['total_venta'];
        $factura->cabecera->montoTotalMoneda    = $factura->cabecera->montoTotal;
        $factura->cabecera->montoTotalSujetoIva    = $factura->cabecera->montoTotal;
        $factura->cabecera->descuentoAdicional    = 0;
        $factura->cabecera->codigoMoneda        = 1; //BOLIVIANO
        $factura->cabecera->tipoCambio            = 1;
        $factura->cabecera->cuf            = $dataFactura['venta']['cuf'];
        $factura->cabecera->usuario              = $dataFactura['user']['name']." ".$dataFactura['user']['apellido'];
        return $factura;
    }

    function testFactura($sucursal, $puntoventa, SiatInvoice $factura, $tipoFactura)
    {
        $fecha_actual = Carbon::now();
        $sucursal_DB = Sucursal::where('codigo_fiscal', $sucursal)->first();
        $cuis = SiatCui::where('sucursal_id', $sucursal_DB->id)
            ->where('estado', 'V')
            ->orderBy('id', 'desc')->first();
        $cufd = SiatCufd::where('sucursal_id', $sucursal_DB->id)
            ->whereDate('fecha_vigencia', '>=', $fecha_actual)
            ->first();
        $service = SiatFactory::obtenerServicioFacturacion($this->configService->config, $cuis->codigo_cui, $cufd->codigo, $cufd->codigo_control);
        $service->codigoControl = $cufd->codigo_control;
        $res = $service->recepcionFactura($factura, SiatInvoice::TIPO_EMISION_ONLINE, $tipoFactura);
       /*  $this->test_log("RESULTADO RECEPCION FACTURA\n=============================");*/
        /* $this->test_log($res);  */
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
