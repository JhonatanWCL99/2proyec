@extends('layouts.app', ['activePage' => 'cargos', 'titlePage' => 'Cargos'])

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Actualizar Cargo</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card card-primary">
                            <br>
                            <form action="{{ route('cargos.update',$producto->id) }}" method="POST" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="nombre" value="{{$producto->nombre}}" required>
                                        </div>
                                    </div>
                                    

                                <div class="row">
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="departamento_id">Departamento<span class="required">*</span></label>
                                            <div class="selectric-hide-select">
                                                <select name="departamento_id" class="form-control selectric">
                                                    @foreach($departamentos as $departamento)
                                                    @if($categoria->id==$producto->departamento_id)
                                                    <option value="{{$departamento->id}}" selected>{{$departamento->nombre}}</option>
                                                    @else
                                                    <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
                                        <a href="{{route('cargos.index')}}" class="btn btn-danger" tabindex="8">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
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