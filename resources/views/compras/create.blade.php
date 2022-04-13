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
                            <form action="{{ route('compras.store') }}" method="POST" class="form-horizontal">
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
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" name="cantidad" class="form-control" value=""
                                        placeholder="Cantidad...">
                                </div>
                                <div class="col-md-3">
                                    <label for="precio">Precio</label>
                                    <input type="number" name="precio" class="form-control" value="" placeholder="Bs"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="subtotal">Subtotal</label>
                                    <input type="number" name="subtotal" class="form-control" value="" placeholder="Bs"
                                        readonly>
                                </div>
                                <div class="col-md-3 pt-4">
                                    <button class="btn btn-primary ">Agregar Producto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-resposive">
                                <table class="table table-bordered table-md" id="table">
                                    <thead>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Unidad de Medida</th>
                                        <th>Costo Unitario</th>
                                        <th>Cantidad</th>
                                        <th>Sub Total</th>
                                        <th>Opciones</th>
                                    </thead>
                                    <tbody>
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
        proveedor.addEventListener("change", (e) => {
            console.log(proveedor.value);

            fetch('{{ route("compras.obtenerproductos") }}', {
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
                console.log(data.lista);
                var opciones = "";
                for (let i in data.lista) {
                    opciones += '<option value="' + data.lista[i].id + '">' + data.lista[i].id +
                        '</option>';
                }
                document.getElementById("producto").innerHTML = opciones;
            }).catch(error => console.error(error));
        })

    </script>
@endsection

@section('scripts')
 
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
