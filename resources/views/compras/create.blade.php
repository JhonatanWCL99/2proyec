@extends('layouts.app', ['activePage' => 'compras', 'titlePage' => 'Compras'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Nuevo Compra</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card card-primary">
                                <br>
                                <form action="{{ route('compras.store') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_actual">Fecha Actual</label>
                                                <input type="date" class="form-control" name="fecha_actual"
                                                    value="{{ $fecha_actual }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">Proveedor<span class="required">*</span></label>
                                                <select name="proveedor" id="" class="form-select">
                                                    @foreach ($proveedores as $proveedor)
                                                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-info" id="toggle-modal" data-toggle="modal"
                                            data-target="#exampleModal">Agregar
                                            Producto</button>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a class="btn btn-danger" href="{{ route('bonos.index') }}">Volver</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    
@endsection

