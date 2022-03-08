<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Sucursal;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();
        return view('cargos.index')->with('cargos',$cargos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales= Sucursal::all();
        $departamentos= Departamento::all();
        return view('cargos.create')->with('departamentos',$departamentos)->with('sucursales',$sucursales);
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
            'nombre'=>'required',
           
        ]);

        $cargo= new Cargo();
        $cargo->nombre =$request->get('nombre');
        $cargo->departamento_id =$request->get('departamento_id');
        $cargo->sucursal_id =$request->get('sucursal_id');
        $cargo->save();
        return redirect()->route('cargos.index');
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
        $sucursales= Sucursal::all();
        $departamentos= Departamento::all();
        $cargo = Cargo::find($id);
        return view ('cargos.edit',compact('cargo','departamentos','sucursales'));
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
        $cargo= Cargo::find($id);
        $cargo->nombre =$request->get('nombre');
    
        $cargo->departamento_id =$request->get('departamento_id');
        $cargo->sucursal_id =$request->get('sucursal_id');
        $cargo->save();
        return redirect()->route('cargos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargo= Cargo::find($id);
        $cargo->delete();
        return redirect()->route('cargos.index')->with('eliminar','ok');
        
    }
}
