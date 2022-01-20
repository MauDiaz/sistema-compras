<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <h3 class="text-info ml-3">Administrador de Empresas</h3>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <button class="btn  btn-success ml-5"data-toggle="modal" data-target="#AddBranchModal">+ Sucursal</button>
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
                                            <th>R.F.C.</th>
                                            <th>Aprobador</th>
                                            <th>Cotizador</th>
                                            <th>Accion</th>
                                        </thead>
                                        <tbody>
                                            
                                                <?php
                                            $itembran = null;
                                            $valuebran = null;
                                           $bran = branchController::ctrShowBranch($itembran,$valuebran);
                                          foreach ($bran as $key => $value){
                                            $item2 = "staff_id";
                                            $value2 = $value["quoter_id"];
                                            $quoter = staffController::ctrShowStaff($item2,$value2); 
                                         
                                                echo'<tr>
                                                <td>'.$value["branch_id"].'</td>
                                                <td>'.$value["branch_name"].'</td>
                                                <td>'.$value["branch_address"].'</td>
                                                <td>'.$value["branch_pn"].'</td>
                                                <td>'.$value["branch_email"].'</td>
                                                <td>'.$value["branch_rfc"].'</td>
                                                <td>'.$value["approver"].'</td>
                                                <td>'.$quoter["staff_name"].'</td>';
                                                echo'<td>
                                                <div class= "btn-group btn-group-sm">
                                                <button class="btn btn-warning btn-flat btn-edit-branch"><i class="icon ion-ios-create"></i></button>
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
MODAL AGREGAR BRANCH
======================================-->

<div id="AddBranchModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

        <!--===================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="color:grey">
          <h4 class="modal-title text-center">Agregar Sucursal</h4>
          <button type="button" class="close " data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="form-group">
              <label class="bmd-label-floating">Nombre de la sucursal.</label>
              <input type="text" class="form-control" name="br-name" minlength="4" maxlength="35" pattern="[A-Za-z ]{4,35}" required>
              <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">El nombre debe terner minimo 4 caracteres sin numeros.</div>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="bmd-label-floating">Direccion de la sucursal.</label>
            <input type="text" class="form-control" name="br-address"  minlength="4" maxlength="70" pattern="[A-Za-z0-9#/. ]{4,70}" required>
            <div class="valid-feedback">Valido!</div>
            <div class="invalid-feedback">La direccion debe terner minimo 4 caracteres.</div>
          </div>
        </div>
        </div>
        <div class="row">
           <div class="col-md-12">
            <div class="form-group">
              <label class="bmd-label-floating">Email.</label>
              <input type="email" class="form-control" name="br-email" required>
               <div class="valid-feedback">Valido!</div>
               <div class="invalid-feedback">Por favor elige un correo valido! </div>
            </div>
        </div>  


        </div>

        <div class="row mt-1">
          <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Telefono.</label>
              <input type="text" class="form-control" name="br-pn" maxlength="10" pattern="[0-9]{10}" required>
               <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un numero de telefono valido! </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">RFC.</label>
              <input type="text" class="form-control" name="br-rfc" maxlength="12" pattern="[A-Z0-9]{12}" required>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor utiliza MAYUSCULAS y elige un RFC valido! </div>
            </div>
          </div>
        </div>
        
        <div class="row mt-1">

          <div class="col-md-12">
        
          <div class="form-group" >

            <label>Seleccionar Cotizador</label>

            <select class="form-control form-control-sm select2" id="quoter-selector" name="quoter-id" style="width: 100%;" required>
            
             <option value="">Sel. Cotizador</option> 

             <?php

            $item = "role_id";
            $value = 4;
            $quoter = branchController::ctrShowApprover($item, $value);
            
            foreach ($quoter as $key => $quoter) {
              echo '<option value="'.$quoter["staff_id"].'">'.$quoter["staff_name"].'</option>';}

            ?>

           </select>
          
         </div>

        </div>

        </div>

         <div class="row mt-1">

          <div class="col-md-12">
        
          <div class="form-group" >

            <label>Seleccionar Aprobador</label>

            <select class="form-control form-control-sm select2" id="approver-selector" name="approver-id" style="width: 100%;" required>
            
             <option value="">Sel. Aprobador</option> 

             <?php

            $item = "role_id";
            $value = 3;
            $approver = branchController::ctrShowApprover($item, $value);
            
            foreach ($approver as $key => $approver) {
              echo '<option value="'.$approver["staff_id"].'">'.$approver["staff_name"].'</option>';}

            ?>

           </select>
          
         </div>

        </div>

        </div>



        </div>  <!-- cierra modal body -->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar Sucursal</button>
        </div>        
          <?php
          $createBranch = new branchController();
          $createBranch -> ctrCreateBranch();
          ?>                                  
      </form>
    </div>
  </div>
</div>