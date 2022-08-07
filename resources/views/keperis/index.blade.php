@extends('layouts.app', ['activePage' => 'keperis', 'titlePage' => 'Keperi'])

@section('content')

@section('css')

@endsection

<section class="section">

    <div class="section-header">
        <h3 class="page__heading"> Keperis Registrados</h3>
    </div>
    
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-outline-info" href="{{route('keperis.create')}}">Nueva Gestion</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead style="background-color: #6777ef;">
                                    <th class="text-center" style="color: #fff;">Fecha de Cortado</th>
                                    <th class="text-center" style="color: #fff;">Funcionario Encargado</th>

                                    <th class="text-center" style="color: #fff;">Keperi Kilos</th>
                                    <th class="text-center" style="color: #fff;">Keperi Para Producir</th>
                                    <th class="text-center" style="color: #fff;">Keperi Marinado</th>

                                    <th class="text-center" style="color: #fff;">% Hidratado Marinado</th>
                                    
                                    <th class="text-center" style="color: #fff;">Keperi Cocido</th>
                                    <th class="text-center" style="color: #fff;">Keperi Sellado</th>
                                    
                                    <th class="text-center" style="color: #fff;">Keperi Enviado</th>
                                    <th class="text-center" style="color: #fff;">Diferencia Keperi</th>
                                    <th class="text-center" style="color: #fff;">% Deshidratacion</th>
                                    <th class="text-center" style="color: #fff;">% Deshidratado despues Cocido</th>
                                    <th class="text-center" style="color: #fff;">% Rendimiento</th>
                                    <th style="color: #fff;"></th>
                                </thead>
                                <tbody>
                                    @foreach ($keperis as $keperi)
                                    <tr>
                                        @php
                                        
                                        $deshidratado_cocido = $keperi->cantidad_sellado/$keperi->cantidad_crudo-1;
                                        $hidratado_marinado = +($keperi->cantidad_crudo / $keperi->cantidad_marinado-1)*100;
                                        $diferencia = $keperi->cantidad_sellado - $keperi->cantidad_enviado;
                                        $deshidratado = (($keperi->cantidad_crudo - $keperi->cantidad_sellado)/$keperi->cantidad_crudo ) *100 ;
                                        $inflado = ( $keperi->cantidad_crudo/ $keperi->cantidad_marinado) *100 ;

                                        $rendimiento = ($keperi->cantidad_enviado/$keperi->cantidad_crudo)*100
 
                                        @endphp
                                   
                                       <td class="text-center">{{$keperi->fecha}} </td>
                                   
                                       
                                   
                                        <td class="text-center">{{$keperi->nombre_usuario}} </td>
                                        <td class="text-center">{{$keperi->cantidad_kilos}} kg </td>
                                        <td class="text-center">{{$keperi->cantidad_crudo}} kg </td>
                                        <td class="text-center">{{$keperi->cantidad_marinado }} kg </td>

                                        <td class="text-center">{{number_format($hidratado_marinado,2)  }} %</td>
                                        <td class="text-center">{{$keperi->cantidad_cocido }} kg </td>
                                        
                                        <td class="text-center">{{$keperi->cantidad_sellado }} kg </td>
                                        @if (isset($keperi->cantidad_enviado))
                                        <td class="text-center"> {{$keperi->cantidad_enviado}} kg </td>
                                        @else
                                        <td class="text-center"> <span class="badge badge-warning"> No registrado </span> </td>
                                        @endif

                                        <td class="text-center">{{$diferencia}} kg </td>
                                        <td class="text-center">{{ number_format($deshidratado,2)}} % </td>
                                        <td class="text-center">{{ number_format($deshidratado_cocido,2)}} % </td>
                                        <td class="text-center">{{ number_format($rendimiento,2)}} % </td>
                                       
                                       

                                        <td>
                                            <div class="dropdown" style="position: absolute;">
                                                <a href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <ul class="dropdown-menu" ara-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item " href="{{ route('keperis.edit', $keperi->id) }}">Editar</a></li>
                                                    <li>
                                                        <form action="{{route('keperis.destroy',$keperi->id)}}" id="formulario-eliminar2" class="formulario-eliminar" method="POST">
                                                            @csrf
                                                            @method('Delete')
                                                            <a class="dropdown-item" href="javascript:;" onclick="document.getElementById('formulario-eliminar2').submit()" id="enlace">Eliminar</a>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@if(session('eliminar')=='ok')
<script>
    Swal.fire(
        'Eliminado!',
        'Tu registro ha sido eliminado.',
        'success'
    )
</script>
@endif

<script>
    $('#table').DataTable({

        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningun dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Ãšltimo",
                sNext: "Siguiente",
                sPrevious: "Anterior"
            },
            oAria: {
                sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                sSortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        },
        columnDefs: [{
            orderable: false,
            targets: 12
        }, ]
    });
</script>

@endsection

@section('css')
.titulo{
font-size: 50px;
background-color: red;

}
@endsection