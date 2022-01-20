<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <h3 class="text-info ml-3">Administrador de Proveedores</h3>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <button class="btn  btn-success ml-5" data-toggle="modal" data-target="#AddSupplierModal">+ Proveedor</button>
        <!-- /.row -->
      </div>

      <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-sm table-striped nowrap" id="table-catalogue">
                                        <thead>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Direccion</th>
                                            <th>Numero Telefonico</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Accion</th>
                                        </thead>
                                        <tbody>
                                            
                                                <?php
                                            $item = null;
                                            $value = null;
                                           $supplier = supplierController::ctrShowSupplier($item,$value);
                                          foreach ($supplier as $key => $value){
                                                echo'<tr>
                                                <td>'.$value["supplier_id"].'</td>
                                                <td>'.$value["supplier_name"].'</td>
                                                <td>'.$value["supplier_address"].'</td>
                                                <td>'.$value["supplier_pn"].'</td>
                                                <td>'.$value["supplier_email"].'</td>';
                                                
                                                if ($value["supplier_status"]== 1){
                                                echo'<td><button class= "btn btn-success btn-flat btn-sm btnActivar">Activo</button>';
                                                }else{
                                                echo'<td><button class= "btn btn-danger btn-flat btn-sm btnActivar">Inactivo</button>';

                                                }
                                                echo'
                                                <td>
                                                <div class= "btn-group btn-group-sm">
                                                <button class="btn btn-warning btn-flat btn-edit-supplier"><i class="icon ion-ios-create"></i></button>
                                                </td>    
                                                </tr>';}
                                                ?>
                                            
                                    </tbody>
                                    </table>
                                </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  
<!--=====================================
MODAL AGREGAR PROVEEDOR
======================================-->

<div id="AddSupplierModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="color:grey">
          <h4 class="modal-title text-center">Agregar Proveedor</h4>
          <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="form-group">
              <label class="bmd-label-floating">Nombre del Proveedor.</label>
              <input type="text" class="form-control" name="supp-name" minlength="4" maxlength="35" pattern="[A-Za-z ]{4,35}" required>
              <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">El nombre debe terner minimo 4 caracteres sin numeros.</div>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="bmd-label-floating">Direccion del Proveedor.</label>
            <input type="text" class="form-control" name="supp-address" minlength="4" maxlength="70" pattern="[A-Za-z0-9#/. ]{4,70}" required>
            <div class="valid-feedback">Valido!</div>
            <div class="invalid-feedback">La direccion debe terner minimo 4 caracteres.</div>
          </div>
        </div>
        </div>

        <div class="row mt-1">
          <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Telefono.</label>
              <input type="text" class="form-control"name="supp-pn" data-inputmask='"mask": "(999) 999-9999"' data-mask maxlength="10" pattern="[0-9]{10}" required>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un numero de telefono valido! </div>
            </div>
          </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label class="bmd-label-floating">Email.</label>
            <input type="email" class="form-control" name="supp-email"required>
            <div class="valid-feedback">Valido!</div>
            <div class="invalid-feedback">Por favor elige un correo valido! </div>
          </div>
        </div>
        </div>
        
        <div class="row mt-1">
          <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Status.</label>
              <select class="form-control select2 form-control-sm" name="supp-status-id" style="width: 100%;" required>
                    <option value="">Seleccione Status</option>
                    <?php
                    $item = null;
                    $value = null;
                    $status = statusController::ctrShowStatus($item,$value);
                    foreach($status as $key => $value){
                    echo'<option value="'.$value["id_status"].'" name="supp-status-id" >'.$value["status_name"].'</option> ';}
                    ?>
                  </select>
                   <div class="valid-feedback">Valido!</div>
                   <div class="invalid-feedback">Por favor elige un estado valido! </div>
            </div>
          </div>
        </div>
        
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar Proveedor</button>
        </div>        
        <?php
        $createSupplier = new supplierController();
        $createSupplier -> ctrCreateSupplier();
        ?>
      </form>
    </div>
  </div>
</div>
        