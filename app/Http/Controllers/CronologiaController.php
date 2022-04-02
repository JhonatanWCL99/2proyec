<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cronologia;
use App\Models\User;

class CronologiaController extends Controller
{
    public function index(){
        $cronologias= Cronologia::all();
        return view('cronologias.index',compact('cronologias'));
    }

    public function create(){
        $usuarios=User::all();
        return view('cronologias.create',compact('usuarios'));
    }

    public function store(Request $request){
        $request->validate([
            'fecha_cronologia',
            'descripcion',
        ]);
        $cronologia = new Cronologia();
        $cronologia->fecha_cronologia = $request->get('fecha_cronologia');
        $cronologia->descripcion = $request->get('descripcion');
        $cronologia->user_id = $request->get('usuario');
        $cronologia->save();
        return redirect()->route('cronologias.index');
    }

    public function show($id){
        $cronologia = Cronologia::find($id);
        $usuario = User::find($cronologia->user_id);
        return view('cronologias.show', ['cronologia'=>$cronologia, 'usuario'=> $usuario ]);
    }

    public function edit($id){
        $cronologia = Cronologia::find($id);
        $usuarios=User::all();
        return view('cronologias.edit',compact('cronologia','usuarios'));
    }

    public function update(Request $request,$id){
        $cronologia=  Cronologia::find($id);

        $cronologia->fecha_cronologia =$request->get('fecha_cronologia');
        $cronologia->descripcion =$request->get('descripcion');
        $cronologia->user_id = $request->get('usuario');
        $cronologia->save();
       
        return redirect()->route('cronologias.index');
    }

    public function destroy($id){
        $cronologia= Cronologia::find($id);
        $cronologia->delete();
        return redirect()->route('cronologias.index')->with('eliminar','ok');
    }
}
