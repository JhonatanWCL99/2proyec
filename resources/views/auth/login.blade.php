@extends('layouts.auth_app')
@section('title')
Admin Login
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card card-primary">
    <div class="card-header">
        <h5 class="titulo">Te damos la bienvenida al sistema DONESCO SRL.</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger p-0">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            <input aria-describedby="emailHelpBlock" id="email" type="hidden" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Enter Email" tabindex="1" value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}" autofocus>
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            <label class="label" for="codigo">Codigo de usuario *</label><br><br>
            <input aria-describedby="emailHelpBlock" id="codigo" type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" placeholder="Ingresa tu codigo" tabindex="1" value="{{ (Cookie::get('codigo') !== null) ? Cookie::get('codigo') : old('codigo') }}" autofocus>
            <div class="invalid-feedback">
                {{ $errors->first('codigo') }}
            </div><br>
           <!--  <label class="label" for="codigo">Sucursal *</label><br><br>
            <div class="selectric-hide-select">
                <select name="categoria_id" class="form-control selectric">
                    @foreach($sucursales as $sucursal)
                    <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                    @endforeach
                </select>
            </div> -->
            <div class="form-group">
                <div class="d-block">
                </div>
                <input aria-describedby="passwordHelpBlock" id="password" type="hidden" value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}" placeholder="Enter Password" class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password" tabindex="2">
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block boton" tabindex="4" id="boton">
                    Login
                </button>
            </div>
        </form>
    </div>

</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script>
    $('#codigo').bind('input', function() {
        let ruta = "{{route('auth.find')}}";
        var digitos = document.querySelector('#codigo').value.length;
        if (digitos > 3) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: ruta,
                type: 'POST',
                data: {
                    codigo: $('#codigo').val()
                },
                success: function(response) {
                    $('#email').val(response[0]['email']);
                    $('#password').val(response[0]['password']);
                }
            });
        }
    });
</script>

@endsection
<style>
    .titulo {
        text-align: center;
        font-size: 15px;
    }

    .label {
        font-weight: bold;
        font-size: 15px;
    }

    .boton {
        width: 100%;
    }

    input[type="text"]:focus,
    select.form-control:focus {
        -webkit-box-shadow: none;
        box-shadow: none;
    }
</style>