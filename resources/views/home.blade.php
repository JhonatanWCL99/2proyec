@extends('layouts.app',['activePage' => 'home', 'titlePage' => 'Home'])

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Dashboard</h3>

    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-body ">
                        <h3 class="text-left">Donesco ERP</h3>
                        <div class="row">
                            <div class="col-md-4 col-xl-4">
                                
                                <div class="card  text-white bg-warning mb-3 order-card ">
                                    <div class="card-block border-success mb-3 ">
                                        <h6 class="text-center">&nbsp</h6>
                                        @php
                                        use App\Models\User;
                                        $cant_usuarios = User::count();
                                        @endphp
                                        <h2 class="text-center"><i class="fa fa-users f-left"></i><span> {{$cant_usuarios}}</span></h2>
                                        
                                        <p class="m-b-0 text-center"><a href="/usuarios" class="text-white">Usuarios</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-green order-card text-white bg-danger">
                                    <div class="card-block border-success mb-3">
                                        <h6 class= "" >&nbsp</h6>
                                        
                                        <h2 class="text-center"><i class="fa fa-user-lock f-left"></i><span></span></h2>
                                        <p class="m-b-0 text-center"><a href="/roles" class="text-white">Roles</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-pink order-card text-white bg-info mb-3">
                                    <div class="card-block border-success mb-3">
                                        <h6>&nbsp</h6>
                                        @php
                                        use App\Models\Proveedor;
                                        $cant_proveedores = Proveedor::count();
                                        @endphp
                                        <h2 class="text-center"><i class="fa fa-car"></i><span> {{$cant_proveedores}}</span></h2>
                                        <p class="m-b-0 text-center"><a href="{{ route('proveedores.index') }}" class="text-white">Proveedores</a></p>
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