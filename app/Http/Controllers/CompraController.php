<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Producto_Proveedor;
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

    public function agregarProducto($id){
        $producto = Producto::find($id);
        $detallesCompra = session()->get('detallesCompra');

        if(!$detallesCompra){
            $detallesCompra=[
                $id =>[
                    "id" => $id,
                    "producto" => $producto->nombre,
                    "precio" => $producto->precio,
                    "cantidad" => 1
                ]
            ];
        session()->put('detallesCompra' , $detallesCompra);
        return redirect()->back()->with('success','Producto agregado correctamente');
        }
        if(isset($detallesCompra[$id])){
            $detallesCompra[$id]['cantidad']++;
            session()->put('detallesCompra', $detallesCompra);
        return redirect()->back()->with('success','Producto agregado correctamente');
        }
        $detallesCompra[$id] = [
            "id" => $id,
            "producto" =>$producto->nombre_producto,
            "precio" => $producto->precio,
            "cantidad" => 1
        ];
        session()->put('detallesCompra', $detallesCompra);
        return redirect()->back()->with('success','Producto agregado correctamente');
    }

    public function eliminar($id)
    {
        $detallesCompra = session()->get('detallesCompra');
            if( $detallesCompra[$id]['cantidad'] <= 1){
                unset($detallesCompra[$id]);
                session()->put('detallesCompra', $detallesCompra);
                return redirect()->route('carrito.index');
            }else{
                $detallesCompra[$id]['cantidad']--;
                session()->put('detallesCompra', $detallesCompra);
                return redirect()->route('carrito.index');
            }
        return redirect()->route('carrito.index');
    }

    public function obtenerProductos(Request $request){

        if (isset($request->proveedor_id)) {
            $productos = Producto_Proveedor::where('proveedor_id', $request->proveedor_id)->get();
            return response()->json(
                [
                    'lista' => $productos,
                    'success' => true
                ]
            ); 
        } else {
            return response()->json(
                [
                    'success' => false
                ]
            );
        }
    }
}
