<!-- Form del Modal Anular Facturas-->
<div class="modal fade " id="modalAnulacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header bg-light">
                <h6 class="modal-title"> <i class="		fas fa-arrow-alt-circle-down icon" aria-hidden="true"></i> Anulacion de Factura: {{$ventas[0]->numero_factura}} </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        
                            
                            <label for="user_id"> Seleccione Motivo Anulacion <span class="required">*</span></label>
                            <div class="selectric-hide-select">
                                <select name="user_id" class="form-control selectric">
                                    @foreach ($motivos_anulaciones as $motivo_anulacion)
                                        <option value="{{$motivo_anulacion->codigo_clasificador}}">{{ $motivo_anulacion->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        
                       
                       {{--  <tr>
                            <th scope="row">Numero Factura:</th>
                            <td> {{$ventas[0]->numero_factura}} </td>
                        </tr>
                        <br> --}}
                    </div>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-success" data-dismiss="modal"> <a href="anulacion_facturas.test_anulacion_factura"></a> Anular </button>
                <button type="button"  class="btn btn-warning" data-dismiss="modal">Cerrar </button>
            </div>
        </div>
    </div>
</div>
