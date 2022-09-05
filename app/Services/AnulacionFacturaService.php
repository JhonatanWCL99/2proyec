<?php
namespace App\Services;

use App\Models\Siat\SiatCui;
use App\Models\Siat\SiatCufd;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\SiatInvoice;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Request;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioFacturacionComputarizada;



Class AnulacionFacturaService{
    public function __construct()
    {
        $this->cuisService = new CuisService();
		$this->cufdService = new CufdService();
        $this->configService = new ConfigService();
        $this->emisionIndividualService = new EmisionIndividualService();
    }

    function pruebasAnulacion(Request $request){
		$sucursal =0;
		$factura = $request->factura_id;
		$motivo = $request->codigo_clasificador;

	foreach ([0] as $puntoventa) {
		$resCuis 	= SiatCui::first();
		$resCufd = SiatCufd::first();
			
		for ($i = 0; $i < 125; $i++) {
			$res = $this->emisionIndividualService->testFactura($sucursal, $puntoventa, $factura, $this->configService->tipoFactura);
			if ($res->RespuestaServicioFacturacion->codigoEstado == 908) {
				$resa = $this->testAnular($motivo, $factura->cuf, $sucursal, $puntoventa, $this->configService->tipoFactura, SiatInvoice::TIPO_EMISION_ONLINE, $this->configService->documentoSector);
			}
			if ($i == 100)
				sleep(10);
		}
		sleep(10);
	}
	die;
}

function testAnular($motivo, $cuf, $sucursal, $puntoventa, $tipoFactura, $tipoEmision, $documentoSector){
	$resCuis 	= SiatCui::first();
	$resCufd = SiatCufd::first();
	
	$service = new ServicioFacturacionComputarizada();
	$service->setConfig((array)$this->configService->config);
	$service->cuis = $resCuis->codigo_cui;
	$service->cufd = $resCufd->codigo;
	
	$res = $service->anulacionFactura($motivo, $cuf, $sucursal, $puntoventa, $tipoFactura, $tipoEmision, $documentoSector);
	/* dd($res); */
	
	return $res;
}



}