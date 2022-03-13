@extends('layouts.app', ['activePage' => 'horarios', 'titlePage' => 'horarios'])

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registrar Horario</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card card-primary">
                            <br>
                            <form action="{{ route('horarios.store') }}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha">Fecha<span class="required">*</span></label>
                                            <input type="date" class="form-control  @error('fecha') is-invalid @enderror" name="fecha" value="{{$fecha->format('Y-m-d')}}">
                                            @error('fecha')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_ingreso">Hora de Ingreso<span class="required">*</span></label>
                                            <input type="time" class="form-control  @error('hora_ingreso') is-invalid @enderror" name="hora_ingreso" >
                                            @error('hora_ingreso')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_entrada">Hora Entrada<span class="required">*</span></label>
                                            <input type="time" class="form-control  @error('hora_entrada') is-invalid @enderror" name="hora_entrada" value="{{$hora_ent->format('H:i')}}" >
                                            @error('hora_entrada')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_salida">Hora Salida<span class="required">*</span></label>
                                            <input type="time" class="form-control  @error('hora_salida') is-invalid @enderror" name="hora_salida" value="{{$hora_sal}}" >
                                            @error('hora_salida')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="horas_trabajadas">Horas Trabajadas<span class="required">*</span></label>
                                            <input type="text" class="form-control  @error('horas_trabajadas') is-invalid @enderror" name="horas_trabajadas" value="{{$horas_trab}}">
                                            @error('horas_trabajadas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_pagar">Total a Pagar<span class="required">*</span></label>
                                            <input type="text" class="form-control  @error('total_pagar') is-invalid @enderror" name="total_pagar" value="{{$total_pagar}}">
                                            @error('total_pagar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Asignar</button>
                                        <a class="btn btn-danger" href="{{route('productos.index')}}">Cancelar</a>
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