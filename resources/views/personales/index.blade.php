@extends('layouts.app', ['activePage' => 'personales', 'titlePage' => 'Contrato de Personales'])

@section('content')
@section('css')
@endsection

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Contrato de Personales</h3>

    </div>
    <div class="section-body">
        <div class="row">
            {{-- <a class="btn btn-outline-info" href="{{ route('personales.create') }}">Nuevo contrato de
                personal</a><br><br> --}}
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <a class="btn btn-outline-info" href="{{ route('personales.create') }}">Nuevo contrato de
                            personal</a>
                        {{-- @can('personales.vencimientoContratos') --}}
                        <a class="btn btn-info  float-right" href="{{ route('personales.vencimientoContratos') }}">Ver
                            Contratos a Vencer</a>
                        {{-- @endcan --}}
                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-striped mt-15" id="table">
                                <thead style="background-color: #6777ef;">
                                    <th style="color: #fff;">C I</th>
                                    <th style="color: #fff;">Nombre y Apellido</th>
                                    <th style="color: #fff;">Celular Personal</th>
                                    <th style="color: #fff;">Codigo de Usuario</th>
                                    <th style="color: #fff;">Estado del Personal</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($personales as $personal)
                                        <tr>
                                            <td>
                                                <a href="{{ route('personales.showDetalleContrato', $personal->id) }}"
                                                    value="{{ $personal->ci }}">{{ $personal->ci }} </a>
                                            </td>

                                            <td>{{ $personal->name }} {{ $personal->apellido }}</td>
                                            <td>{{ $personal->celular_personal }} </td>
                                            @if ($personal->codigo != '')
                                                <td>{{ $personal->codigo }} </td>
                                            @endif
                                            @if ($personal->codigo == '')
                                                <td>Sin Codigo Asignado </td>
                                            @endif
                                            @if ($personal->estado == 1)
                                                <td>
                                                    <div class="badge badge-success">Activo</div>
                                                </td>
                                            @endif
                                            @if ($personal->estado == 0)
                                                <td>
                                                    <div class="badge badge-danger">Inactivo</div>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="dropdown" style="position: absolute;">
                                                    <a href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('personales.showDetalleContrato', $personal->id) }}">Ver
                                                                Detalle</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('personales.editContratoUser', $personal->id) }}">Actualizar
                                                                Contrato</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('bonos.create') }}">Asignar
                                                                Bono</a>
                                                        </li>
                                                        {{-- <li>
                                                            <form
                                                                action="{{ route('personales.destroy', $personal->id) }}"
                                                                id="formulario-eliminar2" class="formulario-eliminar"
                                                                method="POST">
                                                                @csrf
                                                                @method('Delete')
                                                                <a class="dropdown-item" href="javascript:;"
                                                                    onclick="document.getElementById('formulario-eliminar2').submit()"
                                                                    id="enlace">Eliminar</a>
                                                            </form>
                                                        </li> --}}
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
@if (session('eliminar') == 'ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'Tu registro ha sido eliminado.',
            'success'
        )
    </script>
@endif

@if (session('contratar') == 'ok')
    <script>
        iziToast.success({
            title: 'BIEN',
            message: "El personal se ha contratado exitosamente",
            position: 'topRight',
        });
    </script>
@endif
<script>
    $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Estas Seguro(a)?',
            text: "??No podr??s revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Eliminarlo!'
        }).then((result) => {
            if (result.value) {
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
                    sLast: "????ltimo",
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
                }

            ]
        });
    </script>
@endsection
@endsection

@section('css')
.titulo{
font-size: 50px;
background-color: red;

}
@endsection
