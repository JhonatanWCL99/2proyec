@extends('layouts.app', ['activePage' => 'personales', 'titlePage' => 'Personales'])

@section('content')
@section('css')
@endsection

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Vencimiento de Contratos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-align: center;font-size:large">Seleccione las Fechas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x: hidden">
                        <form action="{{ route('personales.filtrarContratos') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <span class="input-group-addon "><strong>Fecha De:</strong> </span>
                                        <input type="date" id="fechaini" class="input-sm form-control"
                                            name="fecha_inicial" value="" />
                                        <span class="input-group-addon">A</span>
                                        <input type="date" id="fechamax" class="input-sm form-control"
                                            name="fecha_final" value="" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control btn btn-primary" type="submit" value="Filtrar Contratos"
                                        id="filtrar" name="filtrar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" style="justify-content:center ;">
                    <h4>Contratos Activos</h4>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                 
                        <table class="table table-striped mt-15" id="table">
                            
                            <thead style="background-color: #6777ef;">

                                <th style="color: #fff;">Nombre del Funcionario</th>
                                <th style="color: #fff;">Sucursal  Funcionario</th>

                                <th style="color: #fff;">Estado</th>
                                <th style="color: #fff;">Tipo de Contrato</th>

                                <th style="color: #fff;">Fecha Inicio Contrato</th>
                                <th style="color: #fff;">Fecha de Vencimiento de Contrato</th>
                                <th style="color: #fff;">Tiempo Restante del Contrato</th>

                                {{-- <th style="color: #fff;">Hora Ingreso</th> --}}
                            </thead>
                            <tbody>
                                @if (isset($detalleContratos))
                                    @foreach ($detalleContratos as $detalleContrato)
                                    @php
                                    $fechaActual = date('Y-m-d');
                                    $diff = strtotime($detalleContrato->fecha_fin_contrato) - strtotime($fechaActual);
                                    $years = floor($diff / (365 * 60 * 60 * 24));
                                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                    
                                    @endphp
                                    @if($detalleContrato->user->estado==1)
                                    @if($detalleContrato->fecha_fin_contrato > $fechaActual)
                                        <tr>
                                            <td>{{ $detalleContrato->user->name }}
                                                {{ $detalleContrato->user->apellido }}
                                            </td>
                                            @if(isset($detalleContrato->user->sucursals[0]->nombre))
                                            <td>{{$detalleContrato->user->sucursals[0]->nombre}}</td>
                                            @else
                                            <td>Sin Sucursal</td>
                                            @endif

                                            <td><span class="badge badge-success">Activo</span></td>                        
                                            <td>{{ $detalleContrato->contrato->tipo_contrato }}</td>
                                            <td>{{ $detalleContrato->fecha_inicio_contrato }}</td>

                                            <td style="color:black; background-color: #B9C86D;">
                                                {{ $detalleContrato->fecha_fin_contrato }}</td>
 
                                            <td>
                                                @if ($years < 0)
                                                    Contrato Vencido
                                                @else
                                                    @if ($years > 0)
                                                        {{ $years }} Años
                                                    @endif
                                                    @if ($months > 0)
                                                        {{ $months }} Meses
                                                    @endif
                                                    @if ($months >= 0)
                                                        {{ $days }} Dias
                                                    @endif
                                                </td>
                                                @endif
                                            </tr>
                                            @endif
                                            @endif
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" style="justify-content:center ;">
                    <h4>Contratos Vencidos</h4>
                </div>
                
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped mt-15" id="table1">
                            <thead style="background-color: #6777ef;">

                                <th style="color: #fff;">Nombre del Funcionario</th>
                                <th style="color: #fff;">Sucursal  Funcionario</th>

                                <th style="color: #fff;">Estado</th>
                                <th style="color: #fff;">Tipo de Contrato</th>

                                <th style="color: #fff;">Fecha Inicio Contrato</th>
                                <th style="color: #fff;">Fecha de Vencimiento de Contrato</th>
                                <th style="color: #fff;">Tiempo Restante del Contrato</th>

                                {{-- <th style="color: #fff;">Hora Ingreso</th> --}}
                            </thead>
                            <tbody>
                                @if (isset($detalleContratos))
                                    @foreach ($detalleContratos as $detalleContrato)
                                    @php
                                    $fechaActual = date('Y-m-d');
                                    $diff = strtotime($detalleContrato->fecha_fin_contrato) - strtotime($fechaActual);
                                    $years = floor($diff / (365 * 60 * 60 * 24));
                                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                    
                                    @endphp
                                    @if($detalleContrato->user->estado==1)
                                    @if($detalleContrato->fecha_fin_contrato < $fechaActual)
                                        <tr>
                                            <td>{{ $detalleContrato->user->name }}
                                                {{ $detalleContrato->user->apellido }}
                                            </td>
                                            @if(isset($detalleContrato->user->sucursals[0]->nombre))
                                            <td>{{$detalleContrato->user->sucursals[0]->nombre}}</td>
                                            @else
                                            <td>Sin Sucursal</td>
                                            @endif

                                            <td><span class="badge badge-success">Activo</span></td>                        
                                            <td>{{ $detalleContrato->contrato->tipo_contrato }}</td>
                                            <td>{{ $detalleContrato->fecha_inicio_contrato }}</td>

                                            <td style="color:black; background-color: #B9C86D;">
                                                {{ $detalleContrato->fecha_fin_contrato }}</td>
 
                                            <td>
                                                @if ($years < 0)
                                                    Contrato Vencido
                                                @else
                                                    @if ($years > 0)
                                                        {{ $years }} Años
                                                    @endif
                                                    @if ($months > 0)
                                                        {{ $months }} Meses
                                                    @endif
                                                    @if ($months >= 0)
                                                        {{ $days }} Dias
                                                    @endif
                                                </td>
                                                @endif
                                            </tr>
                                            @endif
                                            @endif
                                    @endforeach
                                @endif

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
@if (session('eliminar') == 'ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'Tu registro ha sido eliminado.',
            'success'
        )
    </script>
@endif

<script>
    $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Estas Seguro(a)?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Eliminarlo!'
        }).then((result) => {
            if (result.value) {
                /*  Swal.fire(
                     'Deleted!',
                     'Your file has been deleted.',
                     'success'
                 ) */
                console.log(this);
                this.submit();
            }
        })
    });
</script>

@section('page_js')
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
                    targets: 4
                },
            ]
        });
    </script>


<script>
    $('#table1').DataTable({
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
                targets: 4
            },
        ]
    });
</script>
@endsection
@endsection
@section('css')
.tablecolor {
background-color: #212121;
}
@endsection
