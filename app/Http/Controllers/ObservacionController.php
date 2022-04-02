<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Observacion;
use App\Models\User;

class ObservacionController extends Controller
{
    public function index(){
        $observaciones= Observacion::all();
        return view('observaciones.index',compact('observaciones'));
    }

    public function create(){
        $observaciones=Observacion::all();
        return view('observaciones.create',compact('observaciones'));
    }

    public function store(Request $request){
        $request->validate([
            'fecha_observacion',
            'descripcion',
        ]);
        $observacion = new Observacion();
        $observacion->fecha_observacion = $request->get('fecha_observacion');
        $observacion->descripcion = $request->get('descripcion');
        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $destinationPath = 'img/contratos/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($destinationPath, $filename);
            $observacion->foto = $destinationPath . $filename;
        }
        $observacion->user_id = $request->get('usuario');
        $observacion->save();
        return redirect()->route('observaciones.index');
    }

    public function show($id){
        $observacion = Observacion::find($id);
        $usuario = User::find($observacion->user_id);
        return view('observaciones.show', ['observacion'=>$observacion, 'usuario'=> $usuario ]);
    }

    public function edit($id){
        $observacion = Observacion::find($id);
        $usuarios=User::all();
        return view('observaciones.edit',compact('observacion','usuarios'));
    }

    public function update(Request $request,$id){
        $observacion=  Observacion::find($id);

        $observacion->fecha_observacion =$request->get('fecha_observacion');
        $observacion->descripcion =$request->get('descripcion');
        $observacion->user_id = $request->get('usuario');

        if ($request->hasFile("foto")) {
            if (@getimagesize($user->foto)) {
                unlink($observacion->foto);
                $file = $request->file('foto');
                $destinationPath = 'img/contratos/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('foto')->move($destinationPath, $filename);
                $observacion->foto = $destinationPath . $filename;
            } else {
                $file = $request->file('foto');
                $destinationPath = 'img/contratos/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('foto')->move($destinationPath, $filename);
                $observacion->foto = $destinationPath . $filename;
            }
        }
    
        $observacion->save();
       
        return redirect()->route('observaciones.index');
    }

    public function destroy($id){
        $observacion= Observacion::find($id);
        $observacion->delete();
        return redirect()->route('observaciones.index')->with('eliminar','ok');
    }
}
