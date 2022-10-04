<div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
              <div class="card-tools">
              
            </div>
                
                  <div class="row">
                      <div class="col-lg-2">
                          <div class="form-group">
                              <label for="" class="col-form-label">N. Diario</label>
                              <input type="text" class="form-control" placeholder="N# Diario" aria-label="Recipient's username" aria-describedby="basic-addon2" id="txtDiario">
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                              <label for="" class="col-form-label">Cod. Sucursal</label>
                              <select class="form-control select2" id="cmbSucursal" name="cmbSucursal"> </select>
                          </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="form-group" style="margin-top:35px;">
                              <button  id="btnBuscar" class="btn btn-success">Buscar</button>
                        </div>
                      </div>
                      
                          
                  </div>
</div>
              
            <!-- /.card-header -->
            <div class="card-body" style=" overflow-x: scroll; height:650px">
              <table id="tblDiario" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                <thead>
                <tr>
                  <th>No. Consecutivo</th>
                  <th>Cod Sucursal</th>
                  <th>Efectivo Cordoba</th>
                  <th>Efectivo Dolar</th>
                  <th>Cheque Cordoba</th>
                  <th>Cheque Dolar</th>
                  <th>Otros</th>
                  <th>Tipo Cambio</th>
                  <th>Retencion</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>No. Consecutivo</th>
                  <th>Cod Sucursal</th>
                  <th>Efectivo Cordoba</th>
                  <th>Efectivo Dolar</th>
                  <th>Cheque Cordoba</th>
                  <th>Cheque Dolar</th>
                  <th>Otros</th>
                  <th>Tipo Cambio</th>
                  <th>Retencion</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>


        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 1350px!important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                 <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detalle del Diario</h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body" style=" overflow-x: scroll; height="250px"">
            <form id="frmDetalleRei" name="frmDetalleRei" method="post">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Banco Emisor</label>
                            <select class="form-control select2" id="cmbBancoEmisor" name="cmbBancoEmisor"> </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Banco Receptor</label>
                            <select class="form-control select2" id="cmbBancoReceptor" name="cmbBancoReceptor"> </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="" class="col-form-label">Fecha Cierre</label>
                            <input type="date" class="form-control" id="dtpFechaCierre" name="dtpFechaCierre">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="" class="col-form-label"># Diario</label>
                            <input type="text" disabled class="form-control" id="txtNumDiario" name="txtNumDiario">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="" class="col-form-label">Nombre Cliente</label>
                            <input type="text" class="form-control" id="txtNombreCliente" name="txtNombreCliente">
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="" class="col-form-label">Monto</label>
                            <input type="text" class="form-control" id="txtMonto" name="txtMonto">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="" class="col-form-label">Moneda</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rdbEsDol" id="inlineRadio1" value="dol">
                            <label class="form-check-label" for="inlineRadio1">Dolar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rdbEsDol" id="inlineRadio2" value="cor">
                            <label class="form-check-label" for="inlineRadio2">Cordoba</label>
                        </div>
                            <button id="btnAddDetalle" class="btn btn-success">Agregar</button>
                        
                    </div>
                    
                </div>
            </form>
              <table id="tblDetalleDiario" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                <thead>
                <tr>
                  <th>Linea</th>
                  <th>Cod Sucursal</th>
                  <th>No. Consecutivo</th>
                  <th>Tipo Pago</th>
                  <th>Banco Emisor</th>
                  <th>No. Documento</th>
                  <th>Cliente</th>
                  <th>Banco Receptor</th>
                  <th>No. Deposito</th>
                  <th>M. Cordoba</th>
                  <th>M.Dolar</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Linea</th>
                  <th>Cod Sucursal</th>
                  <th>No. Consecutivo</th>
                  <th>Tipo Pago</th>
                  <th>Banco Emisor</th>
                  <th>No. Documento</th>
                  <th>Cliente</th>
                  <th>Banco Receptor</th>
                  <th>No. Deposito</th>
                  <th>M. Cordoba</th>
                  <th>M.Dolar</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>
               
                             
            </div>
            <div id="progresSave"></div>
            <div class="modal-footer">

                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div> 