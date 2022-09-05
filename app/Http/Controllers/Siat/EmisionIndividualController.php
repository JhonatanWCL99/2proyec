<?php

namespace App\Http\Controllers\Siat;

use App\Http\Controllers\Controller;
use App\Models\Siat\SiatCufd;
use App\Models\Siat\SiatCui;
use App\Services\CufdService;
use App\Services\CuisService;
use App\Services\EmisionIndividualService;
use Carbon\Carbon;
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
       /*  return response()->json($dataFactura); */
        $fecha_actual = Carbon::now();
        $puntoventa = 0;
        $sucursal_id = 12;
        $sucursalcodigoFiscal = 0;
       /*  $sucursal_id = $dataFactura['sucursal']['id'];
        $sucursalcodigoFiscal = $dataFactura['sucursal']['codigo_fiscal']; */
        $modalidad = $this->emisionIndividualService->configService->config->modalidad;
        $documentoSector = $this->emisionIndividualService->configService->documentoSector;
        $codigoActividad = $this->emisionIndividualService->configService->codigoActividad;
        $codigoProductoSin = $this->emisionIndividualService->configService->codigoProductoSin;
        $tipoFactura = $this->emisionIndividualService->configService->tipoFactura;

        $cuis = SiatCui::where('sucursal_id', $sucursal_id)
            ->where('estado', 'V')
            ->orderBy('id', 'desc')->first();
        $cufd = SiatCufd::where('sucursal_id',$sucursal_id)
            ->where('fecha_vigencia','<=',$fecha_actual)
            ->first();
        $factura = $this->emisionIndividualService->construirFactura($puntoventa, $sucursalcodigoFiscal, $modalidad, $documentoSector, $codigoActividad, $codigoProductoSin);
        /* dd($factura); */
        $res = $this->emisionIndividualService->testFactura($sucursalcodigoFiscal, $puntoventa, $factura, $tipoFactura);
        return $res;
    }
}
