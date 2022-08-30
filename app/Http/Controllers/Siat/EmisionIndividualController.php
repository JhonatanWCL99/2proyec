<?php

namespace App\Http\Controllers\Siat;

use App\Http\Controllers\Controller;
use App\Services\CufdService;
use App\Services\CuisService;
use App\Services\EmisionIndividualService;
use Illuminate\Http\Request;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\DocumentTypes;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Invoices\SiatInvoice;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioSiat;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\SiatConfig;



class EmisionIndividualController extends Controller
{
    public $cuisService;
    public $cufdService;
    public $emisionIndividualService;

    public function __construct()
    {
        $this->cuisService = new CuisService();
        $this->cufdService = new CufdService();
        $this->emisionIndividualService = new EmisionIndividualService();
    }

    public function emisionIndividual()
    {
        $puntoventa = $this->emisionIndividualService->configService->puntoventa;
        $sucursal = $this->emisionIndividualService->configService->sucursal;
        $modalidad = $this->emisionIndividualService->configService->config->modalidad;
        $documentoSector=$this->emisionIndividualService->configService->documentoSector;
        $codigoActividad = $this->emisionIndividualService->configService->codigoActividad;
        $codigoProductoSin = $this->emisionIndividualService->configService->codigoProductoSin;
        $tipoFactura = $this->emisionIndividualService->configService->tipoFactura;

        $resCuis     = $this->cuisService->obtenerCuis($puntoventa,$sucursal , true);
        $resCufd    = $this->cufdService->obtenerCufd($puntoventa,$sucursal, $resCuis->RespuestaCuis->codigo, true);

        $factura = $this->emisionIndividualService->construirFactura($puntoventa, $sucursal,$modalidad ,$documentoSector ,$codigoActividad , $codigoProductoSin);
        $res = $this->emisionIndividualService->testFactura($sucursal, $puntoventa, $factura,$tipoFactura);

        return $res;
    }


}
