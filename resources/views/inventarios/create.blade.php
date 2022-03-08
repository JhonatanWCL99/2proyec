@extends('layouts.app', ['activePage' => 'inventarios', 'titlePage' => 'Inventarios'])

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registro de Inventario</h3>
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
                                            <label for="total">total<span class="required">*</span></label>
                                            <input type="text" class="form-control  @error('total') is-invalid @enderror" name="total">
                                            @error('total')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha">Fecha<span class="required">*</span></label>
                                            <input type="date" class="form-control  @error('fecha') is-invalid @enderror" name="fecha" >
                                            @error('fecha')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Hora">Hora<span class="required">*</span></label>
                                            <input type="date" class="form-control  @error('Hora') is-invalid @enderror" name="Hora" >
                                            @error('Hora')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                               
                        
     
                                    
                            </form>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Asignar</button>
                            <a class="btn btn-danger" href="{{route('productos.index')}}">Cancelar</a>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection