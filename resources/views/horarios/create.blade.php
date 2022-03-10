@extends('layouts.app', ['activePage' => 'horarios', 'titlePage' => 'Horarios'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Horario Personal</h3>
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
                                                <label for="horario_ingreso">horario_ingreso<span
                                                        class="required">*</span></label>
                                                <input type="time"
                                                    class="form-control  @error('horario_ingreso') is-invalid @enderror"
                                                    name="horario_ingreso">
                                                @error('horario_ingreso')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="horario_entrada">Horario de Entrada<span
                                                        class="required">*</span></label>
                                                <input type="time"
                                                    class="form-control  @error('horario_entrada') is-invalid @enderror"
                                                    name="horario_entrada">
                                                @error('horario_entrada')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="horario_salida">Horario de Salida<span
                                                        class="required">*</span></label>
                                                <input type="time"
                                                    class="form-control  @error('horario_salida') is-invalid @enderror"
                                                    name="horario_salida">
                                                @error('horario_salida')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="turno">Turno<span class="required">*</span></label>
                                                <div class="selectric-hide-select">
                                                    <select name="turno" class="form-control selectric">

                                                        <option>AM</option>
                                                        <option>PM</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sucursal_id">Asigne la Sucursal<span
                                                        class="required">*</span></label>
                                                <div class="selectric-hide-select">
                                                    <select name="sucursal_id" id="_sucursal"
                                                        class="form-control selectric ">
                                                        @foreach ($sucursales as $sucursal)
                                                            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="encargado_id">Encargado<span
                                                        class="required">*</span></label>
                                                <div class="selectric-hide-select">
                                                    <select name="" id="_funcionarios"
                                                        class="form-control selectric "></select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a class="btn btn-danger" href="{{ route('horarios.index') }}">Volver</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            document.getElementById('_sucursal').addEventListener('change', (e) => {
                fetch( '{{route("sucursal.funcionarios")}}', {
                    method: 'POST',
                    body: JSON.stringify({
                        texto: e.target.value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    }
                }).then(response => {
                    return response.json()
                }).then(data => {
                    var opciones = "";
                    for (let i in data.lista) {
                        opciones += '<option value="' + data.lista[i].id + '">' + data.lista[i].name +
                            '</option>';
                    }
                    document.getElementById("_funcionarios").innerHTML = opciones;
                }).catch(error => console.error(error));
            })
        </script>
    </section>
@endsection