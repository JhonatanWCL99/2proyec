<?php

namespace App\Http\Controllers;

use App\Models\DetalleVacacion;
use App\Models\User;
use App\Models\Vacacion;
use Illuminate\Http\Request;

class VacacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacaciones =  Vacacion::all();
        //dd($vacaciones);
        return view('vacaciones.index', compact('vacaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        return view('vacaciones.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*  dd($request); */
        $vacacion = new Vacacion();
        $detalleVacacion = new DetalleVacacion();

        $vacacion->fecha_inicio = $request->get('fecha_inicio');
        $vacacion->fecha_fin = $request->get('fecha_fin');
        $vacacion->user_id = $request->get('usuario_solicitante');
        $vacacion->save();

        if($vacacion->save()){
            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $destinationPath = 'img/vacaciones/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('foto')->move($destinationPath, $filename);
                $detalleVacacion->imagen = $destinationPath . $filename;
            }

            $detalleVacacion->vacacion_id = $vacacion->id;
            $detalleVacacion->user_id = $request->get('usuario_encargado');
            $detalleVacacion->save();
        }

        return redirect()->route('vacaciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacacion =  Vacacion::find($id);
        return view('vacaciones.show', ['vacacion'=>$vacacion]);
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
