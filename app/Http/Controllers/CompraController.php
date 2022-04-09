<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CompraController extends Controller
{
    public function index(){
        $compras=Compra::all();
        return view('compras.index',compact('compras'));
    }

    public function create(){
        $fecha_actual=Carbon::now()->toDateString();
        $proveedores=Proveedor::all();
        return view('compras.create',compact("proveedores","fecha_actual"));
    }
}
