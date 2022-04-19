@extends('layouts.app', ['activePage' => 'compras', 'titlePage' => 'Compras'])

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Nuevo Compra</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('compras.store') }}" method="POST" class="form-horizontal"
                                id="formulario">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_actual">Fecha Actual</label>
                                            <input type="date" class="form-control" name="fecha_actual"
                                                value="{{ $fecha_actual }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tipo_comprobante">Tipo de Comprobante</label>
                                            <select name="tipo_comprobante" id="tipo_comprobante" class="form-select">
                                                <option value="factura">Factura</option>
                                                <option value="recibo">Recibo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" id="div_nro_factura" name="div_nro_factura">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nro_factura">Nro de Factura</label>
                                                <input type="text" name="nro_factura" class="form-control" value=""
                                                    placeholder="Nro de Factura...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nro_autorizacion">Nro de Autorizacion</label>
                                                <input type="text" name="nro_autorizacion" class="form-control" value=""
                                                    placeholder="Nro de Autorizacion...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cod_control">Codigo Control</label>
                                                <input type="text" name="cod_control" class="form-control" value=""
                                                    placeholder="Codigo Control...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="div_nro_recibo" name="div_nro_recibo">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nro_recibo">Nro de Recibo</label>
                                                <input type="text" name="nro_recibo" class="form-control" value=""
                                                    placeholder="Nro de Recibo...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a class="btn btn-danger" href="{{ route('bonos.index') }}">Volver</a>
                                </div> --}}
                            </form>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="proveedor">Proveedor<span class="required">*</span></label>
                                        <select name="proveedor" id="proveedor" class="form-select">
                                            <option> Seleccionar Proveedor</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="producto">Producto<span class="required">*</span></label>
                                        <select name="producto" id="producto" class="form-select">
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="nombre_productos" name="nombre_productos" class="form-control" value="">
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="cantidad">Cantidad*</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control" value=""
                                        placeholder="Cantidad...">
                                </div>
                                <div class="col-md-3">
                                    <label for="precio">Precio</label>
                                    <input type="number" id="precio" name="precio" class="form-control" value=""
                                        placeholder="Bs" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="precio">Subtotal</label>
                                    <input type="number" id="subtotal" name="subtotal" class="form-control" value=""
                                        placeholder="Bs" readonly>
                                </div>
                                <div class="col-md-2 pt-4">
                                    <button id="agregar_detalle" class="btn btn-primary ">Agregar Producto</button>
                                </div>
                                <div class="col-md-1 pt-4">
                                    <button id="" class="btn btn-warning ">Limpiar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-resposive">
                                <table class="table table-bordered table-md" id="table">
                                    <thead>
                                        <th style="text-align: center;">Producto</th>
                                        <th style="text-align: center;">Costo Unitario</th>
                                        <th style="text-align: center;">Cantidad</th>
                                        <th style="text-align: center;">Sub Total</th>
                                        <th style="text-align: center;">Opciones</th>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <script>
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        let proveedor = document.getElementById("proveedor");
        let nombre_producto = document.getElementById("nombre_producto");
        proveedor.addEventListener("change", (e) => {
            //console.log(proveedor.value);
            fetch('{{ route('compras.obtenerproductos') }}', {
                method: 'POST',
                body: JSON.stringify({
                    proveedor_id: e.target.value
                }),
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            }).then(response => {
                return response.json()
            }).then(data => {
                //console.log(data.lista);
                
                var opciones = '<option> Seleccionar Producto</option>';
                for (let i in data.lista) {
                    opciones += '<option value="' + data.lista[i].id + '">' + data.lista[i].nombre +'</option>';
                    
                }

                document.getElementById("producto").innerHTML = opciones;
            }).catch(error => console.error(error));
        })
    </script>
    <script>
        let producto = document.getElementById("producto");
        producto.addEventListener("change", (e) => {
            //console.log(producto.value);
            fetch('{{ route('compras.obtenerprecios') }}', {
                method: 'POST',
                body: JSON.stringify({
                    producto_id: e.target.value
                }),
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            }).then(response => {
                return response.json()
            }).then(data => {
                console.log(data.precio);
                var opciones = "";
                /* for (let i in data.lista) {
                    opciones += '<option value="' + data.lista[i].id + '">' + data.lista[i].nombre +
                        '</option>';
                } */
                var precio = document.getElementById("precio").value = data.precio[0].precio;
            }).catch(error => console.error(error));
        })
    </script>
    <script>
        let cantidad = document.getElementById("cantidad");
        let subtotal = document.getElementById("subtotal");
        let precio = document.getElementById("precio");

        cantidad.addEventListener("keyup", (e) => {
            subtotal.value = cantidad.value * precio.value;
        })

        let agregar_detalle = document.getElementById("agregar_detalle");
        //console.log(nombre_productos);
        agregar_detalle.addEventListener("click", (e) => {
            fetch('{{ route('compras.guardarDetalle') }}', {
                method: 'POST',
                body: JSON.stringify({
                    detalleCompra: {
                        "cantidad": cantidad.value,
                        "subtotal": subtotal.value,
                        "precio": precio.value,
                        "producto_id": producto.value,

                    }
                }),
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            }).then(response => {
                return response.json()
            }).then(data => {

                var opciones = '';
                for (let i in data.lista_compra) {
                    //console.log(data.lista_compra);
                    opciones += '<tr>'
                    opciones += '<td style="text-align: center;">' + data.lista_compra[i].producto_nombre+
                        '</td>';
                    opciones += '<td style="text-align: center;">' + data.lista_compra[i].precio + '</td>';
                    opciones += '<td style="text-align: center;">' + data.lista_compra[i].cantidad +
                    '</td>';
                    opciones += '<td style="text-align: center;">' + data.lista_compra[i].subtotal +
                    '</td>';
                    opciones += '<td style="text-align: center;">' +
                        '<button class="btn btn-warning">Editar</button>' + '&nbsp' +
                        '<button class="btn btn-danger">Eliminar</button>' + '</td>';
                    opciones += '</tr>'

                }

                document.getElementById("tbody").innerHTML = opciones;

            }).catch(error => console.error(error));

        });
    </script>
@endsection

@section('scripts')
    <!-- <script>
        $('#table').DataTable({
           
            language: {
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ registros",
                sZeroRecords: "No se encontraron resultados",
                sEmptyTable: "Ningun dato disponible en esta tabla",
                sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                sInfoPostFix: "",
                sSearch: "Buscar:",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: "Cargando...",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Ãšltimo",
                    sNext: "Siguiente",
                    sPrevious: "Anterior"
                },
                oAria: {
                    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending: ": Activar para ordenar la columna de manera descendente"
                }
            },
            columnDefs: [{
                    orderable: false,
                    targets: 4
                }

            ]
        });
    </script> -->

    <script>
        $("#div_nro_recibo").hide();

        let tipo_comprobante = document.getElementById("tipo_comprobante");
        contador = 0;
        tipo_comprobante.addEventListener("change", e => {
            if (tipo_comprobante.value === "recibo") {
                $("#div_nro_factura").hide();
                $("#div_nro_recibo").show();
            } else {
                $("#div_nro_recibo").hide();
                $("#div_nro_factura").show();
            }
        });
    </script>
@endsection
