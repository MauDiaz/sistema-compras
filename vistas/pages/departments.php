<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <h3 class="text-info ml-3">Administrador de Departamentos</h3>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <button class="btn btn-flat btn-success ml-5" data-toggle="modal" data-target="#AddDepartmentModal">+ Departamento</button>
        <!-- /.row -->
      </div>
 
      <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-sm table-striped nowrap" id="table-catalogue">
                                        <thead class="text-center">
                                            <th>ID</th>
                                            <th>Nombre del Departamento</th>
                                            <th>Accion</th>
                                        </thead>
                                        <tbody>
                                            
                                                <?php
                                            $itemdep = null;
                                            $valuedep = null;
                                           $depa = departmentController::ctrShowDepartment($itemdep,$valuedep);
                                          foreach ($depa as $key => $value){
                                                echo'<tr>
                                                <td class="text-center">'.$value["department_id"].'</td>
                                                <td class="text-center">'.$value["department_name"].'</td>';
                                                echo'<td>
                                                <div class= "btn-group btn-group-sm text-center">
                                                <button class="btn btn-warning btn-flat btn-edit-department"><i class="icon ion-ios-create"></i></button>
                                                <button class="btn btn-danger btn-flat btn-remove-department"><i class="icon ion-ios-cut"></i></button>
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
MODAL AGREGAR DEPARTMENTS
======================================-->

<div id="AddDepartmentModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

        <!--===================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="color:grey">
          <h4 class="modal-title text-center">Agregar Departamenti</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
          <div class="row mt-3">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Nombre del departamento.</label>
                <input type="text" class="form-control" name="new-department" minlength="4" maxlength="35" pattern="[A-Za-z ]{4,35}" required>
                 <div class="valid-feedback">Valido!</div>
                 <div class="invalid-feedback">El nombre debe terner minimo 4 caracteres sin numeros.</div>
              </div>
            </div>
          </div>
        
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar Departamento</button>
        </div>        
         <?php
         $createDepartment = new departmentController();
         $createDepartment -> ctrCreateDepartment();
         ?>                                   
      </form>
    </div>
  </div>
</div>