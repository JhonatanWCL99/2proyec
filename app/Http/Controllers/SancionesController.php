<?php

namespace App\Http\Controllers;

use App\Models\Sanciones;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;

class SancionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sanciones = Sanciones::all();
        //dd($sanciones);
        return view('sanciones.index', compact('sanciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios= User::all();
        $sucursales = Sucursal::all();
        //dd($usuarios);
        return view('sanciones.create', compact('usuarios', 'sucursales'));
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
            'imagen'=>'required',
            'fecha'=>'required',
            'user_id'=>'required',
            'sucursal_id'=>'required',
            'descripcion'=>'required',         
        ]);
        $datos = new Sanciones();
        if($request->hasFile('imagen')){
            $file= $request->file(('imagen'));
            $destinationPath ='img/';
            $filename = time() .'-'. $file->getClientOriginalName();
            $uploadsucess = $request->file('imagen')->move($destinationPath, $filename);
            $datos->imagen = $destinationPath.$filename;
        }
        $datos->fecha = $request->fecha;
        $datos->descripcion = $request->descripcion;
        $datos->sucursal_id = $request->sucursal_id;
        $datos->user_id = $request->user_id;
        $datos->save();
        return redirect()->route('sanciones.index');

    } 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sancion =  Sanciones::find($id);
        return view('sanciones.show', ['sancion'=>$sancion]);
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
