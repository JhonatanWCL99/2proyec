<?php

namespace App\Http\Controllers;

use App\Models\CargoSucursal;
use App\Models\Encargado;
use App\Models\Horario;
use App\Models\Sucursal;
use App\Models\Turno;
use App\Models\User;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::all();
        return view('horarios.index', compact('horarios'));
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $encargados = Encargado::all();
        $sucursales = Sucursal::all();
        return view('horarios.create')->with('sucursales', $sucursales)->with('encargados', $encargados);
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
            'fecha' => 'required',
            'horario_ingreso' => 'required',
            'horario_entrada' => 'required',
        ]);

        $horario = new horario();

        $horario->fecha = $request->get('fecha');
        $horario->horario_ingreso = $request->get('horario_ingreso');
        $horario->horario_entrada = $request->get('horario_entrada');
        $horario->horario_salida = $request->get('horario_salida');
        $horario->turno = $request->get('turno');


        $horario->sucursal_id = $request->get('sucursal_id');
        $horario->encargado_id = $request->get('encargado_id');

        $horario->save();

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

    public function funcionarios(Request $request)
    {
        if (isset($request->texto)) {
            $funcionarios2 = User::where('sucursal_id',$request->texto)->get();
            return response()->json(
                [
                    'lista' => $funcionarios2,
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

    public function planillaHorarios()
    {   
        $sucursales=Sucursal::all();
        $cargos_sucursales=CargoSucursal::all();
       /*  $cargo_sucursal=CargoSucursal::find(1); */
        $user=User::find(1);
        $turnos=Turno::all();
        /* dd($cargo_sucursal->users); */
        return view('horarios.planillaHorarios',compact('sucursales','cargos_sucursales','turnos'));
    }

    public function cargarHorarios(Request $request){

        /* dd($request); */
        if(isset($request->fecha_inicial,$request->fecha_final)){
            User::where('sucursal_id',$request->sucursal_id)->whereBetween('points', [1, 150]);
        }
    }
}