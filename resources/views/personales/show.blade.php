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
                    
                </div>
            </div>
  
            <div class="col-md-8">
                
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
                                <th>Tipo de contrato </th>
                                    @foreach ($detalleContratos as $detallecontrato)
                                        <td>{{$detallecontrato->contrato->tipo_contrato}} </td>
                                    @endforeach
                                </tr>
                                <th>Duracion de contrato </th>
                                    @foreach ($detalleContratos as $detallecontrato)
                                        <td>{{$detallecontrato->contrato->duracion_contrato}}</td>
                                    @endforeach
                                </tr>                               
                                <tr>
                                    <th>Fecha Inicio</th>
                                        @foreach ($detalleContratos as $detallecontrato)
                                            <td>{{$detallecontrato->fecha_inicio_contrato}}</td>
                                        @endforeach
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>   
            
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header ">
                        <h4>Bonos  de {{ $user->name }}</h4>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered table-md">
                            <thead >
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
                                        <a href="{{route('bono.show', $user->id)}}" value="{{$user->id}}" class="dato"  target="_blank"> {{$bono->fecha }} </a></td>
                                        <td class="text-center">{{$bono->monto}}</td>
                                        <td class="text-center">{{$bono->motivo }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </tbody>
                        </table>

                    </div>
                   
                </div>
            </div> 
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header ">
                        <h4>Sanciones  de {{ $user->name }}</h4>
                        <a  data-bs-toggle="collapse" href="#collapseSanciones" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-angle-down"></i>
                        </a>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-md">
                            <thead >
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
                                        <a href="{{route('sanciones.show', $sancion->id)}}" value="{{$sancion->id}}" class="dato"  target="_blank"> {{$sancion->fecha }} </a></td>
                                        <td class="text-center">{{$sancion->categoriaSancion->nombre }}</td>
                                        <td class="text-center">{{$sancion->descripcion }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h4>Descuentos  de {{ $user->name }}</h4>
                        <a  data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-angle-down"></i>
                        </a>
                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <table class="table table-bordered table-md">
                                <thead >
                                    <tr>
                                        <th scope="col" class="text-center">Fecha</th>
                                        <th scope="col" class="text-center">Monto</th>
                                        <th scope="col" class="text-center">Motivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    @foreach ($user->descuentos as $descuento)
                                        <tr>
                                            <td class="text-center">
                                            <a href="{{route('descuentos.index', $user->id)}}" value="{{$user->id}}" class="dato"  target="_blank"> {{$descuento->fecha }} </a></td>
                                            <td class="text-center">{{$descuento->monto }}</td>
                                            <td class="text-center">{{$descuento->motivo }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </tbody>
                            </table>
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