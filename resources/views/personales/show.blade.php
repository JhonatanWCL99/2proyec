@extends('layouts.app', ['activePage' => 'contrato_personales', 'titlePage' => 'Contrato de Personales'])

@section('content')
@section('css')
@endsection

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Vista detallada del contrato del usuario: {{ $user->name }}</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-header ">
                        <h4>Datos Basicos</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                        <div class="author">
                            {{-- <a href="#"> --}}
                            <img src="http://192.168.0.54/eerpwebv2/public/img/contratos/{{ $user->foto }}" alt="image"
                                class="rounded-circle" width="125px" height="125px" >
                            <h5 class="title mt-3">{{ $user->name }} {{ $user->apellido }}</h5>
                            {{-- </a> --}}
                            <p class="description">
                                Correo Electronico : {{ $user->email }} <br>
                                Carnet de Identidad : {{ $user->ci }} <br>
                                Direccion : {{ $user->domicilio }} <br>
                                Zona : {{ $user->zona }} <br>
                                Celular Personal : {{ $user->celular_personal }} <br>
                                Celular de Referencial : {{ $user->celular_referencia }} <br>
                            </p>
                        </div>
                        </p>
                       {{--  <div class="card-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam officia corporis molestiae
                            aliquid provident placeat.
                        </div> --}}
                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                            <button class="btn btn-sm btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card ">
                    <div class="card-header">
                        <h4>Datos en la Empresa</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped ">
                            <tbody>
                                <tr>
                                    <th>Codigo</th>
                                    <td>{{ $user->codigo }}</td>
                                </tr>
                                <tr>
                                    <th>Sucursal</th>
                                    <td>{{ $user->sucursal->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{!! $user->email !!}</td>
                                </tr>

                                <tr>
                                    <th>Estado Usuario</th>
                                    @if ($user->estado == 1)
                                        <td>
                                            <div class="badge badge-success">Activo</div>
                                        </td>
                                    @endif
                                    @if ($user->estado == 0)
                                        <td>
                                            <div class="badge badge-danger">Inactivo</div>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Fecha Nacimiento</th>
                                    <td>{!! $user->fecha_nacimiento !!}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="button-container ">
                            <a href="{{ route('personales.index') }}" class="btn btn-warning  btn-twitter mr-2">
                                Volver
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">
                <div class="card card-user">
                    <div class="card-header ">
                        <h4>Contratos de {{ $user->name }}</h4>
                    </div>
                    <div class="card-body">

                        <p class="description">
                            @foreach ($detalleContratos as $detalleContrato)
                                <h6>{{ $detalleContrato->contrato->tipo_contrato }}</h6>
                                fecha Inicio del Contrato : {{ $detalleContrato->fecha_inicio_contrato }} <br>
                                fecha Final del Contrato : {{ $detalleContrato->fecha_fin_contrato }} <br>
                                Disponibilidad : {{ $detalleContrato->disponibilidad }} <br>
                            @endforeach


                        </p>

                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                            <a href="{{ route('personales.editContratoUser',$user->id) }}" class="btn btn-sm btn-primary mr-3"> Actualizar Contrato
                            </a>
                            {{-- <button class="btn btn-sm btn-primary">Actualizar Contrato</button> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--end card user 2-->


        </div>
</section>
@endsection
<style>
    .avatar2 {
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 200px;
    width: 150px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 50%;
    background-size: 100% auto;
    shape-image-threshold: linear-gradient(50deg, rgb(77, 26, 103), transparent 80%,
                transparent);
}
</style>