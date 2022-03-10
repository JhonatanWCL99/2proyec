@extends('layouts.app', ['activePage' => 'Sanciones', 'titlePage' => 'Sanciones'])

@section('content')

@section('css')

@endsection
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Sanciones</h3>

    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-outline-info" href="{{route('sanciones.create')}}">Agregar sanción</a><br><br>
                        <div class="table-resposive">
                            <table class="table table-bordered table-md" id="table">
                                <thead>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Sucursal</th>
                                    <th>Tipo de sanción</th>
                                    <th>Detalles</th>      
                                    <th></th>
                                </thead>
                                <tbody>
                                @foreach ($sanciones as $sancion)
                                <tr>
                                <td>{{$sancion->fecha}}</td>
                                <td>{{$sancion->user->name}}</td>
                                <td>{{$sancion->sucursal->nombre}} <br></td>
                                <td>{{$sancion->sanciones->nombre}}</td>
                                <td>
                                <div class="badge badge-warning">
                                <a href="{{route('sanciones.show', $sancion->id)}}" value="{{$sancion->id}}" class="dato"> Detalles </a>
                                </div>
                                
                                </td>    
                                <td>
                                <div class="dropdown" style="position: absolute;">
                                    <a href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item " href="{{route('sanciones.edit', $sancion->id)}}">Editar</a></li>
                                            <li>
                                                        <form action="#" id="formulario-eliminar2" class="formulario-eliminar" method="POST">
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
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
        columnDefs: [
            {
                orderable: false,
                targets: 3
            },
            { className: 'text-center', targets: [0,1,2,3] },
        ]
});
</script>
@endsection
@endsection
@section('page_css')
<style>
a:link {
  color: rgb(0, 0, 0);
  background-color: transparent;
  text-decoration: none;
}
.dato:visited {
  color: rgb(255, 255, 255);
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: red;
  background-color: transparent;
  text-decoration: underline;
}
a:active {
  color: yellow;
  background-color: transparent;
  text-decoration: underline;
}
</style>
@endsection