@extends('layouts.app', ['activePage' => 'vacaciones', 'titlePage' => 'Vacaciones'])

@section('content')

@section('css')
@endsection
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Vacaciones</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('vacaciones.create') }}">Asignar vacación</a><br><br>
                        <div class="table-resposive">
                            <table class="table table-bordered table-md" id="table">
                                <thead>
                                    <th>ID</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Personal asignado</th>
                                    <th>Funcionario encargado</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($vacaciones as $vacacion)
                                        <tr>
                                            <td>
                                                <a href="{{ route('vacaciones.show', $vacacion->id) }}"
                                                    value="{{ $vacacion->id }}">{{ $vacacion->id }} </a>
                                            </td>
                                            <td>{{ $vacacion->fecha_inicio }}</td>
                                            <td>{{ $vacacion->fecha_fin }}</td>
                                            <td>{{ $vacacion->user->name }} </td>
                                            <td>{{ $vacacion->detalleVacacion->user->name }} </td>
                                            <td>
                                                <div class="dropdown" style="position: absolute;">
                                                    <a href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{ route('vacaciones.edit', $vacacion->id) }}">Editar</a></li>
                                                        <li>
                                                            <form action="{{route('vacaciones.destroy',$vacacion->id)}}" id="formulario-eliminar2" class="formulario-eliminar" method="POST">
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
                    targets: 5
                },
                {
                    className: 'text-center',
                    targets: [0, 1, 2, 3]
                },
            ]
        });
    </script>
    <script type="application/javascript">
        function deleteItem(e) {

            let id = e.getAttribute('data-id');


            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger',
                },
                buttonsStyling: true
            });

            swalWithBootstrapButtons.fire({
                title: 'Esta seguro de que desea eliminar este registro?',
                text: "Este cambio no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        let id = e.getAttribute('data-id');
                        $.ajax({
                            type: 'DELETE',
                            url: '{{ route('sanciones.destroy', '') }}/' + id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                if (data.success) {
                                    swalWithBootstrapButtons.fire(
                                        'Eliminado!',
                                        'El registro ha sido eliminado.',
                                        "success",
                                    ).then(function() {
                                        window.location = "sanciones";
                                    });
                                }

                            }
                        });

                    }

                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'No se registro la eliminación',
                        'error'
                    );
                }
            });

        }
    </script>
@endsection
@endsection
{{-- @section('page_css')
<style>
a:link {
    color: rgb(0, 0, 0);
    background-color: transparent;
    text-decoration: none;
}

a:active {
    color: yellow;
    background-color: transparent;
    text-decoration: underline;
}
</style>
@endsection --}}
