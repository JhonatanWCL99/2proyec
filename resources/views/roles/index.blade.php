@extends('layouts.app', ['activePage' => 'roles', 'titlePage' => 'Roles'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Roles Activos en el Sistema</h3>
                            <!--Podemos crear rol con esta directiva-->
                                <a class="btn btn-info" href="{{route('roles.create')}}">Agregar nuevo Rol</a>
                           

                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">

                                    <th style="color: #fff;">ID</th>
                                    <th style="color: #fff;">Rol</th>
                                    <th style="color: #fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td >{{$role->id}}</td>
                                            <td >{{$role->name}}</td>

                                            <td>
                                             <!--Podemos crear rol con esta directiva-->
                                                <a class="btn btn-warning" href="{{route('roles.edit',$role->id)}}">Editar</a>
                                       
                                             
                                                {!! Form::open(['method'=>'DELETE', 'route'=>['roles.destroy', $role->id],'style'=>'display:inline' ]) !!}
                                                {!! Form::submit('Borrar', ['class'=> 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                      
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                                  
                              

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

