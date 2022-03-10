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
                                        @php
                                        use App\Models\Departamento;
                                        $cant_areas = Departamento::count();
                                        @endphp
                                        <h2 class="text-center"><i class="fa fa-user-lock f-left"></i><span>{{$cant_areas}}</span></h2>
                                        <p class="m-b-0 text-center"><a href="/roles" class="text-white">Areas</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-pink order-card text-white bg-info mb-3">
                                    <div class="card-block border-success mb-3">
                                        <h6>&nbsp</h6>
                                        @php
                                        use App\Models\Sucursal;
                                        $cant_sucursales = Sucursal::count();
                                        @endphp
                                        <h2 class="text-center"><i class="fa fa-car"></i><span> {{$cant_sucursales}}</span></h2>
                                        <p class="m-b-0 text-center"><a href="{{ route('proveedores.index') }}" class="text-white">Sucursales</a></p>
                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <div class="card-block border-success mb-3">
                            <div id='producto'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>
    var chart = Highcharts.chart('producto', {

chart: {
type: 'column'
},

title: {
text: 'Productos registrados'
},

subtitle: {
text: 'Productos activos en el sistema'
},

legend: {
align: 'right',
verticalAlign: 'middle',
layout: 'vertical'
},

xAxis: {
categories: ['Salsas', 'Saborizantes', 'Enlatado'],
labels: {
    x: -10
}
},

yAxis: {
allowDecimals: false,
title: {
    text: 'Cantidad'
}
},

series: [{
name: 'Aceite Sabrosa',
data: [1, 4, 3]
}, {
name: 'Champiñones en lata',
data: [6, 9, 2]
},{
name: 'Deli Arroz',
data: [8, 2, 3]
},{
name: 'Caldos Magui',
data: [3, 2, 7]
} 
],

responsive: {
rules: [{
    condition: {
        maxWidth: 500
    },
    chartOptions: {
        legend: {
            align: 'center',
            verticalAlign: 'bottom',
            layout: 'horizontal'
        },
        yAxis: {
            labels: {
                align: 'left',
                x: 0,
                y: -5
            },
            title: {
                text: null
            }
        },
        subtitle: {
            text: null
        },
        credits: {
            enabled: false
        }
    }
}]
}
});

document.getElementById('small').addEventListener('click', function () {
chart.setSize(400);
});

document.getElementById('large').addEventListener('click', function () {
chart.setSize(600);
});

document.getElementById('auto').addEventListener('click', function () {
chart.setSize(null);
});

</script>

@endsection
