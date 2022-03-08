<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\ExperienciaLaboral;
use App\Models\Habilidad;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $personales = User::all();
        return view('personales.index', compact('personales'));
    }

    public function create()
    {
        $sucursales = Sucursal::all();
        $contratos = Contrato::all();
        return view('personales.create', compact('sucursales', 'contratos'));
    }
    public function showDetalleContrato($id){
        $user=User::find($id);
        $habilidades=Habilidad::where('usuario_id',$user->id);
        $experienciaLaboral=ExperienciaLaboral::where('usuario_id',$user->id);

        return view('personales.show',compact('user','habilidades','experienciaLaboral'));
    }

    public function contratar(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'carnet_identidad' => 'required',
            'domicilio' => 'required',
            'zona' => 'required',
            'nro_celular_personal' => 'required',
            'nro_celular_referencia' => 'required',
            'foto' => 'required',
            'codigo_usuario' => 'required',
            'nombre_empresas[]' => 'required',
            'cargos[]' => 'required',
            'fecha_inicios[]' => 'required',
            'fecha_fines[]' => 'required',
            'descripciones[]' => 'required',
            'habilidades[]' => 'required',
        ]);
        /* dd($request->habilidades[1]); */
        $contratar_personal = new User();
        $contratar_personal->email = $request->get('email');
        $contratar_personal->name = $request->get('nombre');
        $contratar_personal->apellido = $request->get('apellido');
        $contratar_personal->fecha_nacimiento = $request->get('fecha_nacimiento');
        $contratar_personal->ci = $request->get('carnet_identidad');
        $contratar_personal->domicilio = $request->get('domicilio');
        $contratar_personal->zona = $request->get('zona');
        $contratar_personal->celular_personal = $request->get('nro_celular_personal');
        $contratar_personal->celular_referencia = $request->get('nro_celular_referencia');
        $contratar_personal->password = '12345678';
        $contratar_personal->estado = 1;
        $contratar_personal->codigo =  $request->get('codigo_usuario');
        $contratar_personal->sucursal_id =  $request->get('sucursal_id');
        $contratar_personal->tipo_usuario_id =  2;
        if ($request->hasFile("foto")) {
            $imagen = $request->file("foto");
            $nombreimagen = Str::slug($request->nombre . $request->codigo_usuario) . "." . $imagen->guessExtension();
            $ruta = public_path("img/contratos/");
            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(), $ruta . $nombreimagen);
            $contratar_personal->foto = $nombreimagen;
        }

        $contratar_personal->save();
        if ($contratar_personal->save()) {
            for ($i = 0; $i < sizeof($request->habilidades); $i++) {
                $habilidad = Habilidad::create([
                    'habilidad' => $request->habilidades[$i],
                    'usuario_id' => $contratar_personal->id,
                ]);
            }
            for ($j = 0; $j < sizeof($request->nombre_empresas); $j++) {
                $experienciaLaboral = ExperienciaLaboral::create([
                    'cargo' => $request->cargos[$j],
                    'nombre_empresa' => $request->nombre_empresas[$j],
                    'fecha_inicio' => $request->fecha_inicios[$j],
                    'fecha_fin' => $request->fecha_fines[$j],
                    'descripcion' => $request->descripciones[$j],
                    'usuario_id' => $contratar_personal->id,
                ]);
            }

            if ($habilidad && $experienciaLaboral) {

            }
        }
        return redirect()->route('personales.index')->with('success', 'Personal contratado correctamente');
    }

    public function actualizarContrato(){

    }
}