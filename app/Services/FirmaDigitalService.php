<?php

namespace App\Services;

use App\Models\Siat\SiatCui;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\SiatInvoice;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioSiat;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioFacturacionElectronica;

class FirmaDigitalService {
    public $cuisService;
    public $cufdService;

    public function __construct()
    {
        $this->cuisService = new CuisService();
        $this->cufdService = new CufdService();
        $this->configService = new ConfigService();
        $this->emisionIndividualService = new EmisionIndividualService(); /* Methods BuildInvoice and TestInvoice */
    }

    function pruebasFirma(){
	
    $sucursal =0;
	$puntoventa = 0;
	$resCuis = SiatCui::first();
	$resCufd = $this->cufdService->obtenerCufd($puntoventa, $sucursal, $resCuis->codigo_cui);

	for ($i = 0; $i < 115; $i++) {
		$factura = $this->emisionIndividualService->construirFactura($puntoventa, $sucursal,  $this->configService->config->modalidad, $this->configService->documentoSector, $this->configService->codigoActividad, $this->configService->codigoProductoSin);
		$res = $this->testFirma($sucursal, $puntoventa, $factura, $this->configService->tipoFactura);
		/* print_r($res); */
		//die;
	}
}

function testFirma($sucursal, $puntoventa, SiatInvoice $factura, $tipoFactura)
{

	
	//$pubCert 	= MOD_SIAT_DIR . SB_DS . 'certs' . SB_DS . 'gemgloo-publickey.pem';
	//$privCert 	= MOD_SIAT_DIR . SB_DS . 'certs' . SB_DS . 'GemgloosSA.pem';
	//echo $privCert, "\n";
	
	$this->configService->config->modalidad 	= ServicioSiat::MOD_ELECTRONICA_ENLINEA;
	
	$resCuis = $this->cuisService->obtenerCuis($puntoventa, $sucursal);
	$resCufd = $this->cufdService->obtenerCufd($puntoventa, $sucursal,$resCuis->RespuestaCuis->codigo);
    

/* 	echo "Codigo CUIS: ", $resCuis->codigo_cui, "\n";
	echo "Codigo CUFD: ", $resCufd->RespuestaCufd->codigo, "\n";
	echo "Codigo Control: ", $resCufd->RespuestaCufd->codigoControl, "\n"; */
	
	$service = new ServicioFacturacionElectronica($resCuis->RespuestaCuis->codigo, $resCufd->RespuestaCufd->codigo, $this->configService->config->tokenDelegado);
	$service->setConfig((array)$this->configService->config);
	$service->codigoControl = $resCufd->RespuestaCufd->codigoControl;
	$service->setPrivateCertificateFile($this->configService->config->privCert);
	$service->setPublicCertificateFile($this->configService->config->pubCert);
	$service->debug = !true;
	
	$tipoEmision 			= SiatInvoice::TIPO_EMISION_ONLINE;
	$res = $service->recepcionFactura($factura, $tipoEmision, $tipoFactura);
	
	return $res;
}


}