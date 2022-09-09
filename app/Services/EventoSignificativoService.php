<?php

namespace App\Services;

use App\Models\Cargo;
use Carbon\Carbon;
use App\Models\Siat\SiatCufd;
use App\Models\Siat\EventoSignificativo;
use App\Models\Siat\SiatCui;
use App\Models\Sucursal;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioFacturacionSincronizacion;
use SinticBolivia\SBFramework\Modules\Invoices\Classes\Siat\Services\ServicioOperaciones;

class EventoSignificativoService
{
	public $configService;


	public function __construct()
	{
		$this->cuisService = new CuisService();
		$this->cufdService = new CufdService();
		$this->configService = new ConfigService();
	}

	function pruebasEventos2()
	{
		$sucursal = 0;
		$puntoventa = 1;
		$codigoEvento	= 6;
		$fecha_generica = Carbon::now();
		
		$sucursal_db = Sucursal::where('codigo_fiscal',$sucursal)->first();
		$cufd_bd = SiatCufd::where('sucursal_id',$sucursal_db->id)->orderBy('fecha_generado','desc')->first();
		$cufdAntiguo = $cufd_bd->codigo;
		$resCuis 	= $this->cuisService->obtenerCuis($puntoventa, $sucursal, true);
		$resCufd	= $this->cufdService->obtenerCufd($puntoventa, $sucursal, $resCuis->RespuestaCuis->codigo, true);

		$pvfechaInicio 	= (new Carbon($cufd_bd->fecha_generado))->format("Y-m-d\TH:i:s.v");
		$pvfechaFin		= (new Carbon())->subMinutes(2)->format("Y-m-d\TH:i:s.v");

		$evento 	= $this->obtenerListadoEventos($sucursal, $puntoventa, $codigoEvento);
		$resEvento = $this->registroEvento(
			$resCuis->RespuestaCuis->codigo,
			$resCufd->RespuestaCufd->codigo,
			$sucursal,
			$puntoventa,
			$evento,
			$cufdAntiguo,
			$pvfechaInicio,
			$pvfechaFin
		);
	
		return $resEvento;
	}



	function registroEvento($cuis, $cufd, $sucursal, $puntoventa, object  $evento, $cufdAntiguo, $fechaInicio, $fechaFin)
	{

		$re = EventoSignificativo::first();

		/* dd($evento); */
		$serviceOps = new ServicioOperaciones();
		$serviceOps->setConfig((array)$this->configService->config);
		$serviceOps->cuis = $cuis;
		$serviceOps->cufd = $cufd;
		/* dd($serviceOps->cuis,$serviceOps->cufd); */
		/* $resEvent = $serviceOps->consultaEventoSignificativo(0,0,(Carbon::now())->format("Y-m-d\TH:i:s.v")); */

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

		$nombre_evento = 'VENTA EN LUGARES SIN INTERNET';
		$evento = null;
		foreach ($eventsList->RespuestaListaParametricas->listaCodigos as $evt) {
			if ($evt->codigoClasificador == $buscarId) {
				$evento = $evt;
				break;
			}
		}
		return $evento;
	}
}
