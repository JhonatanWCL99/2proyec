@extends('layouts.app', ['activePage' => 'sanciones', 'titlePage' => 'Sanciones'])
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Nuevo registro</h3>
    </div>
    <div class="section-body">
    <div class="card">
        <h5 class="card-header">Agregar una nueva sanción</h5>
        <div class="card-body">
        <form action="#" method="POST" >
            <div class="mb-3">
                    <h6 class="card-title">Sucursal</h6>
                    <select class="form-select" aria-label="Default select example">
                        @foreach($sucursales as $sucursal)
                            <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            
            
            <div class="mb-3">
                <h6><label for="exampleFormControlInput1" class="form-label">Cantidad de sanciones</label></h6>
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Inserte la cantidad">
            </div>
            <input type="hidden" name="fecha">
            <div class="mb-3">
                <h6><label for="exampleFormControlInput1" class="form-label">Detalle <input type="button" id="agregar" class="btn btn-primary btn-sm" value="Add"> </label></h6>
                <div id="listas">
                    
            </div>
            <div class="mb-3">
                <h6 class="card-title">Usuario</h6>
                <select class="form-select" aria-label="Default select example">
                    @foreach($usuarios as $usuario)
                        <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                    @endforeach
                </select>
            </div>
                
            </div>
            
            
            <a href="#" class="btn btn-primary">Guardar</a>
        </form>
        </div>
    </div>
    </div>
</section>
@endsection
@section('scripts')
@section('page_js')
<script>
var campos_max= 10;   
var x = 0;
$('#agregar').click (function(e) {
        e.preventDefault();   
        if (x < campos_max) {
                $('#listas').append('<div class="row"><div class="col-4">\<label> Fecha</label>\
                <input type="date" class="form-control" id="agregar" name="agregar[]">\
                </div>\<div class="col-4">\<label> Descripcion</label>\
                <input type="text" class="form-control" id="agregar" name="agregar[]" placeholder="Inserte la descrpcion">\
                \</div><div class="col-4">\<label>Foto</label>\
                <input type="file" class="form-control" id="agregar" name="agregar[]">\
                <a href="#" class="remover_campo"><div class="col-3"><i class="fas fa-trash"></i></a></div></div>');
                x++;
        }
});
// Remover o div anterior
$('#listas').on("click",".remover_campo",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
});      
</script>>       
@endsection
@endsection
@section('css')
<style>
input[type=button] {
        color: white;
        font-family: Lato;
        padding-left: auto;
        padding-right: auto;
        text-align: center;
        font-size: 18px;
        border-style: solid;
        border-width: thin;
        border-color: rgb(193, 218, 214);
        border-radius: 3px;
}
</style>
@endsection