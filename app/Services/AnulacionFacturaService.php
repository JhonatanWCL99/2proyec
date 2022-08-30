<?php
namespace App\Services;

use App\Models\Siat\SiatCui;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\SiatInvoice;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioFacturacionComputarizada;



Class AnulacionFacturaService{

    public $configService;


    public function __construct()
    {
        $this->cuisService = new CuisService();
		$this->cufdService = new CufdService();
        $this->configService = new ConfigService();
        $this->emisionIndividualService = new EmisionIndividualService();
    }

    function pruebasAnulacion(){
    $sucursal =0;

	foreach ([0] as $puntoventa) {
		$resCuis 	= SiatCui::first();
		$resCufd	= $this->cufdService->obtenerCufd($puntoventa, $sucursal, $resCuis->codigo_cui, true);

		for ($i = 0; $i < 125; $i++) {
			$factura = $this->emisionIndividualService->construirFactura($puntoventa, $sucursal, $this->configService->config->modalidad, $this->configService->documentoSector, $this->configService->codigoActividad, $this->configService->codigoProductoSin);
			$res = $this->emisionIndividualService->testFactura($sucursal, $puntoventa, $factura, $this->configService->tipoFactura);
			/* print_r($res); */
			if ($res->RespuestaServicioFacturacion->codigoEstado == 908) {
				$resa = $this->testAnular(1, $factura->cabecera->cuf, $sucursal, $puntoventa, $this->configService->tipoFactura, SiatInvoice::TIPO_EMISION_ONLINE, $this->configService->documentoSector);
				/* print_r($resa); */
			}
			if ($i == 100)
				sleep(10);
		}
		sleep(10);
	}
	die;
}

function testAnular($motivo, $cuf, $sucursal, $puntoventa, $tipoFactura, $tipoEmision, $documentoSector)
{
	
	
	$resCuis = $this->cuisService->obtenerCuis($puntoventa, $sucursal);
	$resCufd = $this->cufdService->obtenerCufd($puntoventa, $sucursal, $resCuis->RespuestaCuis->codigo);
	
	$service = new ServicioFacturacionComputarizada();
	$service->setConfig((array)$this->configService->config);
	$service->cuis = $resCuis->RespuestaCuis->codigo;
	$service->cufd = $resCufd->RespuestaCufd->codigo;
	
	$res = $service->anulacionFactura($motivo, $cuf, $sucursal, $puntoventa, $tipoFactura, $tipoEmision, $documentoSector);
	
	return $res;
}



}