@extends('layouts.app', ['activePage' => 'contrato_personales', 'titlePage' => 'Contrato de Personales'])

@section('content')
@section('css')
@endsection

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Datos del empleado: {{ $user->name }}</h3>
    </div>
    <div class="section-body">
        <div class="row">
            {{-- <div class="col-md-12">
                <div class="card-body">
                    <div class="card card-user">
                        @if (session('success'))
                            <div class="alert alert-success" role="success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-header ">
                        <h4>Datos Basicos</h4>
                    </div>

                    <div class="card-body">
                        <p class="card-text">
                        <div class="author">
                            {{-- <a href="#"> --}}
                            @if ($user->foto === null || $user->foto === '')
                                <img src="{{ url('img/no-user.png') }}" alt="image" class="rounded-circle"
                                    width="125px" height="125px" />
                                <br>
                            @endif
                            @if ($user->foto != null)
                                <img src="{{ url($user->foto) }}" alt="image" class="rounded-circle" width="125px"
                                    height="125px">
                                <br> 
                             
                            @endif

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
                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                            <a href="{{ route('personales.editDatosBasicos', $user->id) }}"
                                class="btn btn-sm btn-primary" style="color:white">Editar Datos Basicos</a>
                                <a  href="{{ route('personales.index')}}" class="btn btn-sm btn-warning" style="color:white">Volver</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col">
                <div class="col-md-12">

                    <div class="card ">
                        <div class="card-header">
                            <h4>Datos en la Empresa</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <tr>
                                        <th>Codigo</th>
                                        <td>{{ $user->codigo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sucursal</th>
                                        <td>{{ $user->sucursal->nombre }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Email</th>
                                        <td>{!! $user->email !!}</td>
                                    </tr> --}}

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
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="card-footer">
                        <div class="button-container">
                            <button class="btn btn-sm btn-primary">Actualizar Datos de la Empresas</button>
                        </div>
                    </div> --}}
                    </div>
                </div>
                <div class="col-md-12">

                    <div class="card ">
                        <div class="card-header">
                            <h4>Habilidades de {{ $user->name }} {{ $user->apellido }}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    @php
                                        $contador=0;
                                    @endphp
                                    @foreach ($user->habilidades as $habilidad)
                                    @php
                                         $contador+=1;
                                    @endphp
                                        <tr>
                                            <th>Habilidad # {{$contador}}</th>
                                            <td>{{ $habilidad->habilidad }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="card-footer">
                        <div class="button-container">
                            <button class="btn btn-sm btn-primary">Actualizar Datos de la Empresas</button>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-user">
                    <div class="card-header ">
                        <h4>Contratos de {{ $user->name }}</h4>
                        <a data-bs-toggle="collapse" href="#collapseContratos" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <i class="fas fa-angle-down"></i>
                        </a>
                    </div>
                    <div class="collapse" id="collapseContratos">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">Tipo de Contrato</th>
                                            <th scope="col" class="text-center">Fecha Inicio</th>
                                            <th scope="col" class="text-center">Fecha Fin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->detalleContratos as $detallecontrato)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $detallecontrato->contrato->tipo_contrato }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $detallecontrato->fecha_inicio_contrato }}
                                                </td>
                                                <td class="text-center">{{ $detallecontrato->fecha_fin_contrato }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="button-container">
                                <a href="{{ route('personales.editContratoUser', $user->id) }}"
                                    class="btn btn-sm btn-primary" style="color:white">Renovar Contrato</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-user">
                    <div class="card-header ">
                        <h4>Bonos de {{ $user->name }}</h4>
                        <a data-bs-toggle="collapse" href="#collapseBonos" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <i class="fas fa-angle-down"></i>
                        </a>
                    </div>
                    <div class="collapse" id="collapseBonos">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">Fecha</th>
                                            <th scope="col" class="text-center">Monto</th>
                                            <th scope="col" class="text-center">Motivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->bonos as $bono)
                                            <tr>
                                                <td class="text-center">
                                                    <a href="{{ route('bonos.show', $bono->id) }}"
                                                        value="{{ $user->id }}" class="dato"
                                                        target="_blank">
                                                        {{ $bono->fecha }} </a>
                                                </td>
                                                <td class="text-center">{{ $bono->monto }}</td>
                                                <td class="text-center">{{ $bono->motivo }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="button-container">
                                <a class="btn btn-sm btn-primary" href="{{ route('bonos.create') }}"
                                    target="_blank">Agregar Bono</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-user">
                    <div class="card-header ">
                        <h4>Sanciones de {{ $user->name }}</h4>
                        <a data-bs-toggle="collapse" href="#collapseSanciones" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <i class="fas fa-angle-down"></i>
                        </a>
                    </div>
                    <div class="collapse" id="collapseSanciones">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">Fecha</th>
                                            <th scope="col" class="text-center">Tipo Sancion</th>
                                            <th scope="col" class="text-center">Descripcion</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($user->sanciones as $sancion)
                                            <tr>
                                                <td class="text-center">
                                                    <a href="{{ route('sanciones.show', $sancion->id) }}"
                                                        value="{{ $sancion->id }}" class="dato"
                                                        target="_blank">
                                                        {{ $sancion->fecha }} </a>
                                                </td>
                                                <td class="text-center">{{ $sancion->categoriaSancion->nombre }}
                                                </td>
                                                <td class="text-center">{{ $sancion->descripcion }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="button-container">
                                <a class="btn btn-sm btn-primary" href="{{ route('sanciones.create') }}"
                                    target="_blank">Agregar Sancion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-user">
                    <div class="card-header ">
                        <h4>Descuentos de {{ $user->name }}</h4>
                        <a data-bs-toggle="collapse" href="#descuentos" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <i class="fas fa-angle-down"></i>
                        </a>
                    </div>
                    <div class="collapse" id="descuentos">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">Fecha</th>
                                            <th scope="col" class="text-center">Monto</th>
                                            <th scope="col" class="text-center">Motivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->descuentos as $descuento)
                                            <tr>
                                                <td class="text-center">
                                                    <a href="{{ route('descuentos.show', $descuento->id) }}"
                                                        value="{{ $user->id }}" class="dato"
                                                        target="_blank">
                                                        {{ $descuento->fecha }} </a>
                                                </td>
                                                <td class="text-center">{{ $descuento->monto }}</td>
                                                <td class="text-center">{{ $descuento->motivo }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="button-container">
                                <a class="btn btn-sm btn-primary" href="{{ route('descuentos.index') }}"
                                    target="_blank">Agregar Descuento</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</section>
@endsection
@section('scripts')
@section('page_js')
@endsection
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
