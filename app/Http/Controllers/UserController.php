<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\DetalleContrato;
use App\Models\ExperienciaLaboral;
use App\Models\Habilidad;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
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
        /*$user_cod = rand(1, 15);*/
        $sucursales = Sucursal::all();
        $contratos = Contrato::all();
        return view('personales.create', compact('sucursales', 'contratos'));
    }
    public function showDetalleContrato($id)
    {
        $user = User::find($id);
        $habilidades = Habilidad::where('user_id', $user->id);
        $detalleContratos = DetalleContrato::where('user_id', $id)->get();
        $experienciaLaboral = ExperienciaLaboral::where('user_id', $user->id);

        return view('personales.show', compact('user', 'habilidades', 'experienciaLaboral', 'detalleContratos'));
    }




    public function contratar(Request $request)
    {
        /*   dd($request); */
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
            'codigo' => 'required|unique:users|max:4',
            'fecha_inicio_contrato' => 'required',
            'fecha_fin_contrato' => 'required',
            /* 'habilidades' => 'required|array', 
            'habilidades.*' => 'required' */
            //'habilidades.*' => 'required|array'
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
        $contratar_personal->codigo =  $request->get('codigo');
        $contratar_personal->sucursal_id =  $request->get('sucursal_id');
        $contratar_personal->tipo_usuario_id =  2;
        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $destinationPath = 'img/contratos/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('foto')->move($destinationPath, $filename);
            $contratar_personal->foto = $destinationPath . $filename;
        }

        $contratar_personal->save();
        if ($contratar_personal->save()) {
            for ($i = 0; $i < sizeof($request->habilidades); $i++) {
                $habilidad = Habilidad::create([
                    'habilidad' => $request->habilidades[$i],
                    'user_id' => $contratar_personal->id,
                ]);
            }
            for ($j = 0; $j < sizeof($request->nombre_empresas); $j++) {
                $experienciaLaboral = ExperienciaLaboral::create([
                    'cargo' => $request->cargos[$j],
                    'nombre_empresa' => $request->nombre_empresas[$j],
                    'descripcion' => $request->descripciones[$j],
                    'user_id' => $contratar_personal->id,
                ]);
            }

            /* if ($habilidad && $experienciaLaboral) { */
                DetalleContrato::create([
                    'fecha_inicio_contrato' => $request->fecha_inicio_contrato,
                    'fecha_fin_contrato' => $request->fecha_fin_contrato,
                    'disponibilidad' => $request->disponibilidad,
                    'contrato_id' => $request->contrato_id,
                    'user_id' =>  $contratar_personal->id,
                ]);
            /* } */
        }
        return redirect()->route('personales.index')->with('success', 'Personal contratado correctamente');
    }

    public function actualizarContratoUser(Request $request)
    {
        dd($request);
    }

    public function editContratoUser($id)
    {
        $contratos = Contrato::all();
        $usuario = User::find($id);
        $detalleContratos = DetalleContrato::where('usuario_id', $id)->get();
        return view('personales.editContratoUser', compact('contratos', 'detalleContratos', 'usuario'));
    }
}
