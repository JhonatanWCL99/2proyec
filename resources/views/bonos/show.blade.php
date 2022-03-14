@extends('layouts.app', ['activePage' => 'bonos', 'titlePage' => 'Bonos'])

@section('content')

@section('css')

@endsection

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Bono detallado:</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                    <table class="table table-bordered table-striped ">
                        <tbody>
                            <tr>
                                <th>Monto Recibido</th>
                                <td >{{ $bono->monto }}Bs</td>
                            </tr>
                            <tr>
                                <th>Fecha asignado</th>
                                <td><span class="badge badge-primary">{!! $bono->fecha!!}</span></td>
                            </tr>
                            <tr>
                                <th>Motivo del Bono</th>
                                <td>{{ $bono->motivo }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="button-container ">
                        <a href="{{ route('bonos.index') }}" class="btn btn-warning  btn-twitter mr-2"> Volver </a>
                     
                    </div>
                </div>
                <div>

                </div>
            </div>
        </div>
</section>




@endsection