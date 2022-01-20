<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <h3 class="text-info ml-3">Administrador de Usuarios</h3>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid"> 
        <div class="row">
        <button class="btn  btn-success ml-5" data-toggle="modal" data-target="#AddUserModal">+ Usuario</button>

        <!-- /.row -->
      </div>

      <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-sm table-striped nowrap" id="table-catalogue">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Departamento</th>
                        <th>Puesto</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Ultimo Login</th>
                        <th>Accion</th>
                    </thead>
                    <tbody>
                        
                            <?php
                        $item = null;
                        $value = null;
                       $staffs = staffController::ctrShowStaff($item,$value);
                      foreach ($staffs as $key => $value){
                            echo'<tr>
                            <td>'.$value["staff_id"].'</td>
                            <td>'.$value["staff_name"].'</td>';
                          $itembran = "branch_id";
                          $valuebran = $value["branch_id"];
                          $branch = branchController::ctrShowBranch($itembran,$valuebran);
                          echo'<td>'.$branch["branch_name"].'</td>';
                            $itemdep = "department_id";
                            $valuedep = $value["department_id"];
                            $department = departmentController::ctrShowDepartment($itemdep,$valuedep);
                            echo'<td>'.$department["department_name"].'</td>';
                            $itempos = "position_id";
                            $valuepos = $value["position_id"];
                            $position = positionCOntroller::ctrShowPosition($itempos,$valuepos);
                            echo'<td class="text-center">'.$position["position_name"].'</td>
                            <td class="text-center">'.$value["staff_email"].'</td>
                            <td <td><img src="'.$value["staff_photo"].'" class ="img-thumbnail" width= "40px" ></td>';
                            if ($value["active"] == 1){
                            echo'<td><button class= "btn btn-success btn-flat btn-sm btn-active" staff-id="'.$value["staff_id"].'" staff-status="2" >Activo</button>';
                            }else{
                            echo'<td><button class= "btn btn-danger btn-flat btn-sm btn-active" staff-id="'.$value["staff_id"].'"staff-status="1">Inactivo</button>';
                            }
                            echo'<td>'.$value["last_login"].'</td>
                            <td>
                            <div class= "btn-group btn-group-sm">
                            <button class="btn btn-warning btn-flat btn-edit-user" id-user="'.$value["staff_id"].'" data-toggle="modal" data-target="#EditUserModal"><i class="icon ion-ios-create"></i></button>
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
MODAL AGREGAR USUARIOS
======================================-->

<div id="AddUserModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog  mw-100 w-75 mh-100 h-75">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
 
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="color:grey">
          <h4 class="modal-title text-center">Agregar Usuario</h4>
          <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
        <div class="row mt-3">

          <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Nombre del Usuario.</label>
              <input type="text" class="form-control" name="user-name" minlength="4" maxlength="35" pattern="[A-Za-z ]{4,35}" required>
              <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">El nombre debe terner minimo 4 caracteres sin numeros.</div>
            </div>
          </div>
          
          <div class="col-md-3">
          <div class="form-group">
            <label class="bmd-label-floating">Password(Min 8 digitos).</label>
            <input type="password" class="form-control" name="user-pass" minlength="8" required pattern="[A-Za-z0-9]{8,}">
              <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">La debe terner minimo 8 caracteres solo letras y numeros.</div>
          </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
              <label class="bmd-label-floating">Pin(4 digitos).</label>
              <input type="password" class="form-control" name="user-pin" maxlength="4" pattern="[0-9]{4}"required>
               <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">La debe terner minimo 4 caracteres solo numeros.</div>
            </div>
          </div>
        </div>                                         

        <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label class="bmd-label-floating">Email.</label>
            <input type="email" class="form-control" name="user-email" id="user-email" required> 
             <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un correo valido! </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label class="bmd-label-floating">Telefono.</label>
            <input type="text" class="form-control" name="user-pn"  maxlength="10" pattern="[0-9]{10}"required>
            <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un telefono valido! </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Empresa.</label>
              <select class="form-control select2 form-control-sm" name="user-company" style="width: 100%;" required>
              <option value="">Seleccione Empresa</option>
              <?php
              $itembran = null;
              $valuebran = null;
              $branch = branchController::ctrShowBranch($item,$value);
              foreach($branch as $key => $value){
              echo'<option value="'.$value["branch_id"].'">'.$value["branch_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige una empresa valida! </div>
            </div>
          </div>  
      </div>

        <div class="row mt-1">
          <div class="col-md-3">
            <div class="form-group">
              <label class="bmd-label-floating">Departamento.</label>
              <select class="form-control select2 form-control-sm" name="user-department" style="width: 100%;" required>
              <option value="">Seleccione Departamento</option>
              <?php
              $itemdep = null;
              $valuedep = null;
              $dep = departmentController::ctrShowDepartment($item,$value);
              foreach($dep as $key => $value){
              echo'<option value="'.$value["department_id"].'">'.$value["department_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un departamento valido!</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="bmd-label-floating">Puesto.</label>
              <select class="form-control select2 form-control-sm" name="user-job" style="width: 100%;" required>
              <option value="">Seleccione Puesto</option>
              <?php
              $itempos = null;
              $valuepos = null;
              $position = positionController::ctrShowPosition($item,$value);
              foreach($position as $key => $value){
              echo'<option value="'.$value["position_id"].'">'.$value["position_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un puesto valido! </div>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group">
              <label class="bmd-label-floating">Rol</label>
              <select class="form-control select2 form-control-sm" name="user-rol" style="width: 100%;" required>
              <option value="">Seleccione Rol</option>
              <?php
              $itemrol = null;
              $valuerol = null;
              $role = roleController::ctrShowRole($itemrol,$valuerol);
              foreach($role as $key => $value){
              echo'<option value="'.$value["role_id"].'">'.$value["role_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un rol valido! </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label class="bmd-label-floating">Status</label>
              <select class="form-control select2 form-control-sm" name="user-status" style="width: 100%;" required>
              <option value="">Seleccione Status</option>
              <?php
              $item = null;
              $valkue = null;
              $status = statusController::ctrShowStatus($item,$value);
              foreach($status as $key => $value){
              echo'<option value="'.$value["id_status"].'">'.$value["status_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">Por favor elige un estado valido! </div>
            </div>
         

          </div>
          </div>
          <div class="form-group">
          <div class="panel">SUBIR FOTO</div>
            <input type="file" class="user-photo" id="user-photo" name="user-photo">
            <p class="help-block">Peso máximo de la foto 2MB</p>
            <img src="" class="img-thumbnail preview" id="preview" width="100px">
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success" id="btn-save-user">Guardar Usuario</button>
        </div>        
          <?php
          $createUser = new staffController();
          $createUser -> ctrCreateStaff();
          ?>      
      </form>
    </div>
  </div>
</div>

  <!--=====================================
MODAL EDITAR USUARIOS
======================================-->
<!-- Modal -->

<div id="EditUserModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog  mw-100 w-75 mh-100 h-75">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
 
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="color:grey">
          <h4 class="modal-title text-center">Editar Usuario</h4>
          <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
        <div class="row mt-3">

          <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Nombre del Usuario.</label>
              <input type="text" class="form-control" value="" id="user-edit-name" name="user-edit-name" minlength="4" maxlength="35" pattern="[A-Za-z ]{4,35}" required readonly>
              <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">El nombre debe terner minimo 4 caracteres sin numeros.</div>
            </div>
          </div>
          
          <div class="col-md-3">
          <div class="form-group">
            <label class="bmd-label-floating">Password(Min 8 digitos).</label>
            <input type="password" class="form-control" placeholder="Escriba la nueva contraseña" name="user-edit-pass" minlength="8" required pattern="[A-Za-z0-9]{8,}">
              <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">La debe terner minimo 8 caracteres solo letras y numeros.</div>
          </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
              <label class="bmd-label-floating">Pin(4 digitos).</label>
              <input type="password" class="form-control" placeholder="Nuevo PIN" name="user-edit-pin" maxlength="4" pattern="[0-9]{4}"required>
               <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">La debe terner minimo 4 caracteres solo numeros.</div>
            </div>
          </div>
        </div>                                         

        <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label class="bmd-label-floating">Email.</label>
            <input type="email" class="form-control" name="user-edit-email" id="user-edit-email" required>
             <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un correo valido! </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label class="bmd-label-floating">Telefono.</label>
            <input type="text" class="form-control" name="user-edit-pn" id="user-edit-pn"  maxlength="10" pattern="[0-9]{10}"required>
            <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un telefono valido! </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Empresa.</label>
              <select class="form-control select2 form-control-sm" name="user-edit-company" style="width: 100%;" required>
              <option value="" id="user-edit-company"></option>
              <?php
              $itembran = null;
              $valuebran = null;
              $branch = branchController::ctrShowBranch($item,$value);
              foreach($branch as $key => $value){
              echo'<option value="'.$value["branch_id"].'">'.$value["branch_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige una empresa valida! </div>
            </div>
          </div>  
      </div>

        <div class="row mt-1">
          <div class="col-md-3">
            <div class="form-group">
              <label class="bmd-label-floating">Departamento.</label>
              <select class="form-control select2 form-control-sm" name="user-edit-department" style="width: 100%;" required>
              <option value="" id="user-edit-department"></option>
              <?php
              $itemdep = null;
              $valuedep = null;
              $dep = departmentController::ctrShowDepartment($item,$value);
              foreach($dep as $key => $value){
              echo'<option value="'.$value["department_id"].'">'.$value["department_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un departamento valido!</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label class="bmd-label-floating">Puesto.</label>
              <select class="form-control select2 form-control-sm" name="user-edit-job" style="width: 100%;" required>
              <option value="" id="user-edit-job"></option>
              <?php
              $itempos = null;
              $valuepos = null;
              $position = positionController::ctrShowPosition($item,$value);
              foreach($position as $key => $value){
              echo'<option value="'.$value["position_id"].'">'.$value["position_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un puesto valido! </div>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group">
              <label class="bmd-label-floating">Rol</label>
              <select class="form-control select2 form-control-sm" name="user-edit-rol" style="width: 100%;" required>
              <option value="" id="user-edit-rol"></option>
              <?php
              $itemrol = null;
              $valuerol = null;
              $role = roleController::ctrShowRole($itemrol,$valuerol);
              foreach($role as $key => $value){
              echo'<option value="'.$value["role_id"].'">'.$value["role_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige un rol valido! </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label class="bmd-label-floating">Status</label>
              <select class="form-control select2 form-control-sm" name="user-edit-status" style="width: 100%;" required>
              <option value="" id="user-edit-status"></option>
              <?php
              $item = null;
              $valkue = null;
              $status = statusController::ctrShowStatus($item,$value);
              foreach($status as $key => $value){
              echo'<option value="'.$value["id_status"].'">'.$value["status_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">Por favor elige un estado valido! </div>
            </div>
          </div>
          </div>
          <div class="form-group">
          <div class="panel">SUBIR FOTO</div>
            <input type="file" class="user-photo" id="user-edit-photo" name="user-edit-photo">
            <p class="help-block">Peso máximo de la foto 2MB</p>
            <img src="" class="img-thumbnail preview" id="preview2" width="100px">
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success" id="btn-edit-save-user">Modificar Usuario</button>
        </div>        
         <?php
         ?>
      </form>
    </div>
  </div>
</div>