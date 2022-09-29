<div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
              <div class="card-tools">
              
            </div>
                
                  <div class="row">
                      <div class="col-lg-2">
                          <div class="form-group">
                              <label for="" class="col-form-label">N.Documento</label>
                              <input type="text" class="form-control" placeholder="N# Documento" aria-label="Recipient's username" aria-describedby="basic-addon2" id="txtDocumento">
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                              <label for="" class="col-form-label">Cod. Sucursal</label>
                              <select class="form-control select2" id="cmbSucursal" name="cmbSucursal"> </select>
                          </div>
                      </div>
                      <div class="col-lg-3">
                          <div class="form-group">
                              <label for="" class="col-form-label">Cod. Cliente</label>
                              
                              <select class="form-control select2" id="cmbCliente" name="cmbCliente"> 

                              </select>
                          </div>
                      </div>
                      <button id="btnBuscar" class="btn btn-success">Buscar</button>
                          
                  </div>
              
            <!-- /.card-header -->
            <div class="card-body" style=" overflow-x: scroll; height:650px">
              <table id="tblDocumenetoCC" class="table table-bordered table-striped" cellspacing="0" width="100%" >
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Cod. Cliente</th>
                  <th>Cod. Sucursal</th>
                  <th>Documento</th>
                  <th>Plazo</th>
                  <th>Vencimiento</th>
                  <th>Vencimiento Var.</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Cod. Cliente</th>
                  <th>Cod. Sucursal</th>
                  <th>Documento</th>
                  <th>Plazo</th>
                  <th>Vencimiento</th>
                  <th>Vencimiento Var.</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>