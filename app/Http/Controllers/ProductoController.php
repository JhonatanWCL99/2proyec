<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index')->with('productos',$productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias= Categoria::all();
        return view('productos.create')->with('categorias',$categorias);
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
            'codigo'=>'required',
            'nombre' => 'required',
            'stock' => 'required',
            'precio' => 'required',
        ]);

        $producto= new Producto();
        $producto->codigo =$request->get('codigo');
        $producto->nombre =$request->get('nombre');
        $producto->stock =$request->get('stock');
        $producto->precio =$request->get('precio');
        $producto->estado =$request->get('estado');
        $producto->categoria_id =$request->get('categoria_id');
    
        $producto->save();
       
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
        $producto = Producto::find($id);
        $categoria = Categoria::find($producto->categoria_id);
        return view('productos.show', ['producto'=>$producto, 'categoria'=> $categoria ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias= Categoria::all();
        $producto = Producto::find($id);
        return view ('productos.edit',compact('producto','categorias'));
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
        $producto= Producto::find($id);
        $producto->codigo =$request->get('codigo');
        $producto->nombre =$request->get('nombre');
        $producto->stock =$request->get('stock');
        $producto->precio =$request->get('precio');
        $producto->estado =$request->get('estado');
        $producto->categoria_id =$request->get('categoria_id');
        $producto->save();
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto= Producto::find($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('eliminar','ok');
    }
}
