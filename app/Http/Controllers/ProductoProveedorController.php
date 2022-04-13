<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto_Proveedor;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\Proveedor;

class ProductoProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$productos_proveedores = Producto_Proveedor::all();
        return view('productos_proveedores.index')->with('productos_proveedores',$productos_proveedores);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fecha_act= date("Y-m-d");
        $productos= Producto::all();
        $sucursales= Sucursal::all();
        $proveedores= Proveedor::all();
        return view('productos_proveedores.create',compact('fecha_act'))->with('productos',$productos)->with('sucursales',$sucursales)->with('proveedores',$proveedores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'precio'=>'required',
            'fecha' => 'required',
            
        ]);
      
        $producto_proveedor = new Producto_Proveedor();
       
        $producto_proveedor->precio =$request->get('precio');
    
        $producto_proveedor->producto_id =$request->get('producto_id');
        $producto_proveedor->proveedor_id =$request->get('proveedor_id');
        $producto_proveedor->sucursal_id =$request->get('sucursal_id');
        $producto_proveedor->fecha =$request->get('fecha');
    
        $producto_proveedor->save();
       
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
