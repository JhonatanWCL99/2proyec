@extends('layouts.app',['activePage' => 'contrato_personales', 'titlePage' => 'Contrato de Personales'])

@section('content')
@section('css')
@endsection

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Nuevo Contrato de Personal</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card card-primary">
                            <br>
                            <!-- MultiStep Form -->
                            <div {{-- class="container-fluid" --}} id="grad1">
                                <div class="row justify-content-center mt-0">
                                    <div class="col-lg-11 text-center p-0 mt-3 mb-2">
                                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-12 mx-0">
                                                    <form action="{{ route('personales.contratar') }}" id="msform"
                                                        method="POST" class="form-horizontal"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <!-- progressbar -->
                                                        <ul id="progressbar">
                                                            <li class="active" id="account">
                                                                <strong>Datos Personales</strong>
                                                            </li>
                                                            <li id="personal"><strong>Experiencia Laboral</strong>
                                                            </li>
                                                            <li id="payment"><strong>Competencia y Habilidades</strong>
                                                            </li>
                                                            <li id="confirm"><strong>Datos en Donesco</strong>
                                                            </li>
                                                        </ul> <!-- fieldsets -->
                                                        <fieldset>
                                                            <div class="form-card">
                                                                <h2 class="fs-title">Datos Personales</h2>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="nombre">NOMBRES</label>
                                                                        <input type="text"
                                                                            class="form-control  @error('nombre') is-invalid @enderror"
                                                                            id="nombre" name="nombre"
                                                                            placeholder="Nombres..."
                                                                            value="{{ old('nombre') }}">
                                                                        @error('nombre')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="apellidos">APELLIDOS</label>
                                                                        <input type="text"
                                                                            class="form-control @error('apellido') is-invalid @enderror"
                                                                            id="apellido" name="apellido"
                                                                            placeholder="Apellidos..."
                                                                            value="{{ old('apellido') }}">
                                                                        @error('apellido')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror

                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="fecha_nacimiento">FECHA
                                                                            NACIMIENTO</label>
                                                                        <input type="date"
                                                                            class="form-control  @error('fecha_nacimiento') is-invalid @enderror"
                                                                            id="fecha_nacimiento"
                                                                            name="fecha_nacimiento"
                                                                            placeholder="Fecha de Nacimiento..."
                                                                            value="{{ old('fecha_nacimiento') }}">
                                                                        @error('fecha_nacimiento')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="carnet_identidad">CARNET DE
                                                                            IDENTIDAD</label>
                                                                        <input type="text"
                                                                            class="form-control @error('carnet_identidad') is-invalid @enderror"
                                                                            id="carnet_identidad"
                                                                            name="carnet_identidad"
                                                                            placeholder="Carnet de Identidad..."
                                                                            value="{{ old('carnet_identidad') }}">
                                                                        @error('carnet_identidad')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group col-md-6 ">
                                                                        <label for="domicilio">DOMICILIO</label>
                                                                        <input type="text"
                                                                            class="form-control @error('domicilio') is-invalid @enderror"
                                                                            id="domicilio" name="domicilio"
                                                                            placeholder="Domicilio..."
                                                                            value="{{ old('carnet_identidad') }}">
                                                                        @error('domicilio')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="zona">ZONA</label>
                                                                        <input type="text"
                                                                            class="form-control @error('zona') is-invalid @enderror"
                                                                            id="zona" name="zona" placeholder="Zona..."
                                                                            value="{{ old('zona') }}">
                                                                        @error('zona')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="nro_celular_personal">NRO DE CELULAR
                                                                            PERSONAL</label>
                                                                        <input type="number"
                                                                            class="form-control @error('nro_celular_personal') is-invalid @enderror"
                                                                            id="nro_celular_personal"
                                                                            name="nro_celular_personal"
                                                                            placeholder="Nro de Celular Personal..."
                                                                            value="{{ old('nro_celular_personal') }}">
                                                                        @error('nro_celular_personal')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="nro_celular_referencia">NRO CELULAR
                                                                            DE REFERENCIA</label>
                                                                        <input type="number" class="form-control"
                                                                            id="nro_celular_referencia"
                                                                            name="nro_celular_referencia"
                                                                            placeholder="Nro de Celular de Refencia..."
                                                                            value="{{ old('nro_celular_referencia') }}">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="email">CORREO
                                                                            ELECTRONICO</label>
                                                                        <input type="text" class="form-control "
                                                                            id="email" name="email"
                                                                            placeholder="Correo Electronico..."
                                                                            value="{{ $correo }}">

                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="foto">FOTO</label>
                                                                        <input type="file" class="form-control"
                                                                            id="foto" name="foto">
                                                                    </div>
                                                                </div>
                                                            </div> <button type="button" name="next"
                                                                class="btn btn-primary next">Siguiente</button>
                                                        </fieldset>
                                                        <fieldset>
                                                            <div class="form-card">
                                                                <h2 class="fs-title"> DATOS DE EXPERIENCIA LABORAL
                                                                </h2>
                                                                <div class="form-row clonar_experiencia">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="nombre_empresa">NOMBRE DE LA
                                                                            EMPRESA</label>
                                                                        <input type="text"
                                                                            class="form-control @error('nombre_empresas[]') is-invalid @enderror"
                                                                            id="nombre_empresas"
                                                                            name="nombre_empresas[]"
                                                                            placeholder="Nombre de la empresa..."
                                                                            value="{{ old('nombre_empresas[]') }}">
                                                                        @error('nombre_empresas[]')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="cargo">CARGO EN LA
                                                                            EMPRESA</label>
                                                                        <input type="text"
                                                                            class="form-control @error('cargos[]') is-invalid @enderror"
                                                                            name="cargos[]" id="cargos"
                                                                            placeholder="Cargo..."
                                                                            value="{{ old('cargos[]') }}">
                                                                        @error('cargos[]')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="descripcion">DESCRIPCION DEL
                                                                            TRABAJO</label>
                                                                        <textarea cols="30" rows="10" type="text" class="form-control @error('descripciones[]') is-invalid @enderror"
                                                                            name="descripciones[]" id="descripciones"
                                                                            placeholder="descripcion del trabajo..."
                                                                            value="{{ old('descripciones[]') }}"></textarea>
                                                                        @error('descripciones[]')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        <br>
                                                                        <span
                                                                            class="badge badge-pill badge-danger puntero_experiencia ocultar_experiencia">Eliminar</span>
                                                                    </div>

                                                                </div>
                                                                <div id="contenedor_experiencia">

                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="col-md-12 text-center">
                                                                        <button class="btn btn-info" type="button"
                                                                            id="agregar_experiencia">Agregar Experiencia
                                                                            +</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button" name="previous"
                                                                class="btn btn-primary previous">Anterior</button>
                                                            <button type="button" name="next"
                                                                class="btn btn-primary next">Siguiente</button>
                                                        </fieldset>
                                                        <fieldset>
                                                            <div class="form-card">
                                                                <h2 class="fs-title">HABILIDADES TECNICAS</h2>
                                                                <div class="form-row clonar_habilidad">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="habilidad">HABILIDAD</label>
                                                                        <input type="text"
                                                                            class="form-control @error('habilidades.' . '0') is-invalid @enderror"
                                                                            id="habilidad" name="habilidades[]"
                                                                            placeholder="Habilidad..."
                                                                            value="{{ old('habilidades.' . '0') }}">
                                                                        @error('habilidades.' . '0')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        <br>
                                                                        <span
                                                                            class="badge badge-pill badge-danger puntero_habilidad ocultar_habilidad">Eliminar</span>
                                                                    </div>
                                                                </div>
                                                                <div id="contenedor_habilidad">

                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="col-md-12 text-center">
                                                                        <button class="btn btn-info" type="button"
                                                                            id="agregar_habilidad">Agregar Habilidad
                                                                            +</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button" name="previous"
                                                                class="btn btn-primary previous">Anterior</button>
                                                            <button type="button" name="next"
                                                                class="btn btn-primary next">Siguiente</button>
                                                        </fieldset>
                                                        <fieldset>
                                                            <div class="form-card">
                                                                <h2 class="fs-title text-center">DATOS EN LA EMPRESA
                                                                </h2>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="fecha_inicio">FECHA INICIAL DEL
                                                                            CONTRATO</label>
                                                                        <input type="date"
                                                                            class="form-control @error('fecha_inicio_contrato') is-invalid @enderror"
                                                                            id="fecha_inicio_contrato"
                                                                            name="fecha_inicio_contrato"
                                                                            value="{{ old('fecha_inicio_contrato') }}">
                                                                        @error('fecha_inicio_contrato')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="fecha_fin_contrato">FECHA FINAL DEL
                                                                            CONTRATO</label>
                                                                        <input type="date"
                                                                            class="form-control @error('fecha_fin_contrato') is-invalid @enderror"
                                                                            id="fecha_fin_contrato"
                                                                            name="fecha_fin_contrato"
                                                                            value="{{ old('fecha_fin_contrato') }}"
                                                                            readonly>
                                                                        @error('fecha_fin_contrato')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="tipo_contrato">TIPO DE
                                                                            CONTRATO</label>
                                                                        <select name="contrato_id" id="tipo_contrato"
                                                                            class="form-control">
                                                                            @foreach ($contratos as $contrato)
                                                                                <option value="{{ $contrato->id }}">
                                                                                    {{ $contrato->tipo_contrato }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label
                                                                            for="disponibilidad">DISPONIBILIDAD</label>
                                                                        <select name="disponibilidad" id=""
                                                                            class="form-control">
                                                                            <option value="am">Am</option>
                                                                            <option value="pm">Pm</option>
                                                                            <option value="ambos">Ambos</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="sucursal">SUCURSAL</label>
                                                                        <select name="sucursal_id" id=""
                                                                            class="form-control">
                                                                            @foreach ($sucursales as $sucursal)
                                                                                <option value="{{ $sucursal->id }}">
                                                                                    {{ $sucursal->nombre }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="sucursal">CODIGO DE USUARIO</label>
                                                                        <div class="input-group mb-6">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="" id="codigo" name="codigo"
                                                                                value="{{ $user_cod }}" readonly>
                                                                            <button class="btn btn-primary "
                                                                                id="actualizar_codigo"
                                                                                type="button">Actualizar
                                                                                Codigo</button>
                                                                        </div>
                                                                        @error('codigo')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <button type="button" name="previous"
                                                                class="btn btn-primary previous">Anterior</button>
                                                            <button type="submit" name="make_payment "
                                                                class="btn btn-primary " id="submit">Guardar</button>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    //
    const formatearFecha = fecha => {
        const mes = fecha.getMonth() + 1; // Ya que los meses los cuenta desde el 0
        const dia = fecha.getDate();
        return `${fecha.getFullYear()}-${(mes < 10 ? '0' : '').concat(mes)}-${(dia < 10 ? '0' : '').concat(dia)}`;
    };

    let tipo_contrato = document.getElementById('tipo_contrato');
    let fecha_fin_contrato = document.getElementById('fecha_fin_contrato');
    let fecha_inicio_contrato = document.getElementById('fecha_inicio_contrato');
    tipo_contrato.addEventListener('change', e => {

        let fecha_inicio_parseada = new Date(fecha_inicio_contrato.value);
        if (tipo_contrato.value == 1) {
            let nueva_fecha_fin = new Date(fecha_inicio_parseada.setMonth(fecha_inicio_parseada.getMonth() +
                3));
            fecha_final_formateada = formatearFecha(nueva_fecha_fin);
            fecha_fin_contrato.value = fecha_final_formateada;
        }

        if (tipo_contrato.value == 2) {
            let nueva_fecha_fin = new Date(fecha_inicio_parseada.setFullYear(fecha_inicio_parseada
            .getFullYear() +
                1));
            fecha_final_formateada = formatearFecha(nueva_fecha_fin);
            fecha_fin_contrato.value = fecha_final_formateada;
        }

        if (tipo_contrato.value == 3) {
            let nueva_fecha_fin = new Date(fecha_inicio_parseada.setFullYear(fecha_inicio_parseada
            .getFullYear() +
                5));
            fecha_final_formateada = formatearFecha(nueva_fecha_fin);
            fecha_fin_contrato.value = fecha_final_formateada;
        }

    });


    //
    let agregar_habilidad = document.getElementById('agregar_habilidad');
    let contenido_habilidad = document.getElementById('contenedor_habilidad');

    agregar_habilidad.addEventListener('click', e => {
        e.preventDefault();
        let clonado_habilidad = document.querySelector('.clonar_habilidad');
        let clon_habilidad = clonado_habilidad.cloneNode(true);

        clon_habilidad.querySelectorAll("input").forEach(e => e.value = "");
        clon_habilidad.querySelector('#habilidad').className = 'form-control'


        contenido_habilidad.appendChild(clon_habilidad).classList.remove('clonar_habilidad');

        let remover_ocutar = contenido_habilidad.lastChild.childNodes[1].querySelectorAll('span');
        remover_ocutar[0].classList.remove('ocultar_habilidad');
    });


    contenido_habilidad.addEventListener('click', e => {
        e.preventDefault();
        if (e.target.classList.contains('puntero_habilidad')) {
            let contenedor_habilidad = e.target.parentNode.parentNode;

            contenedor_habilidad.parentNode.removeChild(contenedor_habilidad);
        }
    });

    let agregar_experiencia = document.getElementById('agregar_experiencia');
    let contenido_experiencia = document.getElementById('contenedor_experiencia');

    agregar_experiencia.addEventListener('click', e => {
        e.preventDefault();
        let clonado_experiencia = document.querySelector('.clonar_experiencia');
        let clon_experiencia = clonado_experiencia.cloneNode(true);

        clon_experiencia.querySelectorAll("input").forEach(e => e.value = "");
        clon_experiencia.querySelectorAll("textarea").forEach(e => e.value = "");

        contenido_experiencia.appendChild(clon_experiencia).classList.remove('clonar_experiencia');

        let remover_ocutar = contenido_experiencia.lastChild.childNodes[1].querySelectorAll('span');
        remover_ocutar[0].classList.remove('ocultar_experiencia');
    });

    contenido_experiencia.addEventListener('click', e => {
        e.preventDefault();
        if (e.target.classList.contains('puntero_experiencia')) {
            let contenedor_experiencia = e.target.parentNode.parentNode;

            contenedor_experiencia.parentNode.removeChild(contenedor_experiencia);
        }
    });

    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });

        $('.radio-group .radio').click(function() {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
        });

        $(".submit").click(function() {
            return false;
        })

        let botonActualizar = document.getElementById("actualizar_codigo");
        let inputCodigo = document.getElementById("codigo");

        botonActualizar.addEventListener("click", function() {
            numeroRandom = getRandomIntInclusive(10000, 99999);

            inputCodigo.value = numeroRandom;
        });

        function getRandomIntInclusive(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1) + min);
        }

    });
</script>
@endsection
<style>
#grad1 {
    background-color: #9C27B0;
    background-image: linear-gradient(120deg, #FF4081, #81D4FA)
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;
    position: relative
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid skyblue;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: skyblue;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
}

select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px
}

select.list-dt:focus {
    border-bottom: 2px solid skyblue
}

.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #000000
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative
}

#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f023"
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007"
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f09d"
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: skyblue
}

.radio-group {
    position: relative;
    margin-bottom: 25px
}

.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
}

.fit-image {
    width: 100%;
    object-fit: cover
}

</style>
