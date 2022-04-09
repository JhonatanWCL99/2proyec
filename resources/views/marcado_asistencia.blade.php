@extends('layouts.app',['activePage' => 'home', 'titlePage' => 'Home'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Marcado Asistencia Donesco</h3>

        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-info">
                        <div class="card-body ">
                            <h4 class="text-left">Registro de Llegada y Salida</h4>
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                
                    <div class="form-group">
                        <label>Codigo de Usuario*</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-code"></i>
                            </div>
                          </div>
                          <input type="text" class="form-control phone-number">
                        </div>
                      </div>

                      
                    <div class="form-group">
                        <label>Sucursales*</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-building"></i>
                            </div>
                          </div>
                          <input type="text" class="form-control phone-number">
                          
                        </div>
                      
                      </div>
                      <div class="text-center">
                        <a class="btn btn-outline-danger btn-block" href="">Marcar</a>
                      </div>
                      

                </div>

              
               
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
   


 
@endsection
