@extends('layouts.app', ['activePage' => 'personales', 'titlePage' => 'Personales'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Actualizar Contrato</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($detalleContratos as $detalleContrato)
                        <div class="card">
                            <div class="card-header">
                                <h4>Contratos Anteriores</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="card card-primary"> --}}
                                    <div class="row ">
                                        <h5></h5>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="direccion">Fecha de Inicio de Contrato<span
                                                        class="required">*</span></label>
                                                <input type="text" class="form-control" name="direccion"
                                                    value="{{ $detalleContrato->fecha_inicio_contrato }}" required
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">Fecha Fin de Contrato<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="nombre"
                                                    value="{{ $detalleContrato->fecha_fin_contrato }}" required disabled>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="correo">Disponibilidad<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="correo"
                                                    value="{{ $detalleContrato->disponibilidad }}" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nro_fiscal">Tipo de Contrato<span
                                                        class="required">*</span></label>
                                                <input type="number" class="form-control" name="nro_fiscal"
                                                    value="{{ $detalleContrato->contrato->tipo_contrato }}" required
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                {{-- </div> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Nuevo Contrato</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('personales.actualizarContratoUser') }}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="usuario_id">Usuario<span
                                                    class="required">*</span></label>
                                            <input type="text" class="form-control "
                                                name="usuario" value="{{$usuario->id}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_inicio_contrato">Fecha Inicio Contrato<span
                                                    class="required">*</span></label>
                                            <input type="date" class="form-control  @error('fecha_inicio_contrato') is-invalid @enderror"
                                                name="fecha_inicio_contrato">
                                            @error('fecha_inicio_contrato')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_fin_contrato">Fecha Fin Contrato<span
                                                    class="required">*</span></label>
                                            <input type="date"
                                                class="form-control  @error('fecha_fin_contrato') is-invalid @enderror"
                                                name="fecha_fin_contrato">
                                            @error('fecha_fin_contrato')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="disponibilidad">Disponibilidad<span
                                                    class="required">*</span></label>
                                            <input type="text"
                                                class="form-control @error('disponibilidad') is-invalid @enderror"
                                                name="disponibilidad" placeholder="Disponibilidad...">
                                            @error('disponibilidad')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contrato_id">Seleccione el Tipo de Contrato<span
                                                    class="required">*</span></label>
                                            <div class="selectric-hide-select">
                                                <select name="contrato_id" class="form-control selectric">

                                                    @foreach ($contratos as $contrato)
                                                        <option value="{{ $contrato->id }}">
                                                            {{ $contrato->tipo_contrato }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a class="btn btn-danger" href="{{ route('sucursales.index') }}">Volver</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

    </section>
@endsection
