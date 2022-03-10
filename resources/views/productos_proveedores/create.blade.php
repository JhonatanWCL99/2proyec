@extends('layouts.app', ['activePage' => 'productos_proveedores', 'titlePage' => 'Productos_Proveedores'])

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Asignar  a Producto</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card card-primary">
                            <br>
                            <form action="{{ route('productos_proveedores.store') }}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio">Precio<span class="required">*</span></label>
                                            <input type="text" class="form-control  @error('precio') is-invalid @enderror" name="precio">
                                            @error('precio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="precio">Fecha<span class="required">*</span></label>
                                            <input type="date" class="form-control  @error('fecha') is-invalid @enderror" name="fecha" value="{{$fecha_act}}" readonly>
                                            @error('fecha')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="producto_id">Seleccione el Producto<span class="required">*</span></label>
                                            <div class="selectric-hide-select">
                                                <select name="producto_id" class="form-control selectric">
                                                    @foreach($productos as $producto)
                                                    <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                               
                        
     
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sucursal_id">Seleccione la Sucursal<span class="required">*</span></label>
                                            <div class="selectric-hide-select">
                                                <select name="sucursal_id" class="form-control selectric">
                                                    @foreach($sucursales as $sucursal)
                                                    <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="proveedor_id">Selecciona el Proveedor<span class="required">*</span></label>
                                            <div class="selectric-hide-select">
                                                <select name="proveedor_id" class="form-control selectric">
                                                    @foreach($proveedores as $proveedor)
                                                    <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Asignar</button>
                                    <a class="btn btn-danger" href="{{route('productos.index')}}">Cancelar</a>   
                                    </div>
                                    </div>    
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection