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

use LaraIzitoast\Toaster;
use LaraIzitoast\LaraIzitoastServiceProvider;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{


    public function index()
    {
        $personales = User::all();
        
        return view('personales.index', compact('personales'));
    }

    public function create()
    {
        $correo = 'alguien@gmail.com';
        $user_cod = rand(10000, 99999);
        $sucursales = Sucursal::all();
        $contratos = Contrato::all();
        return view('personales.create', compact('sucursales', 'contratos', 'user_cod','correo'));
    }
    public function showDetalleContrato($id)
    {
        $user = User::find($id);
        $detalleContratos = DetalleContrato::where('user_id', $id)->get();

        return view('personales.show', compact('user', 'detalleContratos'));

    }




    public function contratar(Request $request)
    {
        /*   dd($request); */
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'carnet_identidad' => 'required',
            'domicilio' => 'required',
            'zona' => 'required',
            'nro_celular_personal' => 'required',
            'fecha_inicio_contrato' => 'required',
            'fecha_fin_contrato' => 'required',
            'codigo' => 'unique:users|max:5',
            /* 'habilidades.*' => 'required', */
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
                if($request->habilidades[$i]!=""){
                    Habilidad::create([
                        'habilidad' => $request->habilidades[$i],
                        'user_id' => $contratar_personal->id,
                    ]);
                }
            }
            for ($j = 0; $j < sizeof($request->nombre_empresas); $j++) {
                if($request->cargos[$j]!="" && $request->nombre_empresas[$j]!=""){
                    ExperienciaLaboral::create([
                        'cargo' => $request->cargos[$j],
                        'nombre_empresa' => $request->nombre_empresas[$j],
                        'descripcion' => $request->descripciones[$j],
                        'user_id' => $contratar_personal->id,
                    ]);
                }
                
            }

            DetalleContrato::create([
                'fecha_inicio_contrato' => $request->fecha_inicio_contrato,
                'fecha_fin_contrato' => $request->fecha_fin_contrato,
                'disponibilidad' => $request->disponibilidad,
                'contrato_id' => $request->contrato_id,
                'user_id' =>  $contratar_personal->id,
            ]);
        }
        return redirect()->route('personales.index')->with('contratar', 'ok');
    }

    public function actualizarContratoUser(Request $request)
    {
        $detalleContrato = new DetalleContrato();
        $detalleContrato->fecha_inicio_contrato = $request->get('fecha_inicio_contrato');
        $detalleContrato->fecha_fin_contrato = $request->get('fecha_fin_contrato');
        $detalleContrato->disponibilidad = $request->get('disponibilidad');
        $detalleContrato->contrato_id = $request->get('contrato_id');
        $detalleContrato->user_id = $request->get('usuario_id');

        $detalleContrato->save();

        if($detalleContrato->save()){
            return redirect()->route('personales.showDetalleContrato',$detalleContrato->user_id);
        }
    }

    public function editContratoUser($id)
    {
        $contratos = Contrato::all();
        $usuario = User::find($id);
        $detalleContratos = DetalleContrato::where('user_id', $id)->get();
        return view('personales.editContratoUser', compact('contratos', 'usuario'));
    }

    public function editDatosBasicos($id)
    {   
        $roles = Role::all();
        $usuario = User::find($id);
        return view('personales.editDatosBasicos', compact('usuario','roles'));
    }

    public function actualizarDatosBasicos($id, Request $request)
    {


        $user = User::find($id);
        $user->roles()->sync($request->roles);
        /*  dd($request); */
        $user->name = $request->get('nombre');
        $user->apellido = $request->get('apellido');
        $user->domicilio = $request->get('domicilio');
        $user->zona = $request->get('zona');
        $user->celular_personal = $request->get('celular_personal');
        $user->celular_referencia = $request->get('celular_referencia');
        $user->email = $request->get('email');
        $user->ci = $request->get('ci');
        $user->estado = $request->get('estado');
        /* $mi_imagen = public_path() . '/imgages/products/mi_imagen.jpg'; */
        if ($request->hasFile("foto")) {
            if (@getimagesize($user->foto)) {
                unlink($user->foto);
                $file = $request->file('foto');
                $destinationPath = 'img/contratos/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('foto')->move($destinationPath, $filename);
                $user->foto = $destinationPath . $filename;
            } else {
                $file = $request->file('foto');
                $destinationPath = 'img/contratos/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('foto')->move($destinationPath, $filename);
                $user->foto = $destinationPath . $filename;
            }
        }
        $user->save();
        $contratos = Contrato::all();
        return redirect()->route('personales.showDetalleContrato', $user->id)->with('actualizado', 'ok');
    }

    public function vencimientoContratos(){
        $detalleContratos=DetalleContrato::all();
        return view('personales.vencimientoContratos',compact('detalleContratos'));
    }

    public function filtrarContratos(Request $request){
        $fecha_inicial=$request->get('fecha_inicial');
        $fecha_final=$request->get('fecha_final');

       /*  $detalleContratos=DetalleContrato::whereBetween('fecha_fin_contrato', [$fecha_inicial, $fecha_final])->get(); */
        $detalleContratos=DetalleContrato::where('fecha_fin_contrato','>=',$fecha_inicial)->where('fecha_fin_contrato','<=',$fecha_final)->get();
        return view('personales.vencimientoContratos',compact('detalleContratos'));
    }
    public function rolesPersonales($id){
        $roles = Role::all();
        $usuario = User::find($id);
       return redirect()->route('personales.rolesPersonales', compact('usuario','roles'));
    }
}
