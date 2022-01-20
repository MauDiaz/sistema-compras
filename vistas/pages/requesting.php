<div class="content-wrapper" style="min-height: 1462.8px;">

    <!-- CONTENT HEADER -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="card col-12">
            <?php
            if (isset($_GET["request"])){
              $request = $_GET["request"];
            }else{
              $request = '';
            }
            
            ?>
            <?php
           
            $item_req = "order_type";
            $value_req= $request;
            $answer_req = requestController::ctrShowMaxRequestId($item_req,$value_req);
            if($answer_req[0][0] == null){
              $answer_req = 1;
            }else {
              $answer_req = $answer_req[0][0]+1;
            }
           
            echo'<!-- TITULO DE LA TARJETA -->

                <div class="card-header">
                    <h3 class="card-title">Nueva requisición-</h3><h3 class="card-title text-primary text-lowercase">'.$request.' #</h3> <h3 class="card-title text-primary text-lowercase" id="req-id">'.$answer_req.'</h3>  
                </div>

                <!-- /.card-header -->';
            ?>

                <!-- CUERPO DE LA TARJETA -->

                <div class="card-body">
                  <form method="post">
                    <div class="row">
                      <div class="col-12 col-sm-3">

                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Requisicion Tipo:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" <?php echo'value="'.$request.'"';?>id="req-type" name="req-type"readonly>
                              <input type="text" name="req-no"<?php echo'value="'.$answer_req.'"';?> id="req-no" hidden>
                            </div>
                          </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm  col-sm-12">
                          <?php 
                          $item = "staff_id";
                          $value = $_SESSION["id"];
                          $answer = staffController::ctrShowStaffCoDep($item, $value);
                          $branchId = $answer["branch_id"];
                          $branchName = $answer["branch_name"]; 
                          $departmentName = $answer["department_name"];
                          $departmentId = $answer["department_id"];

                          echo '<label class="mr-2" for="company">Empresa</label>
                                <input type="text" style="width: 100%"class="form-control" id="company" name="company" value="'.$branchName.'"readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12" >
                          <label class="mr-2" for="departament">Departamento</label>
                          <input type="text" style="width: 100%" class="form-control" id="departament" name="departament" value="'.$departmentName.'"readonly>
                          <input type="text" style="width: 100%" class="form-control" id="department-id" name="department-id" value="'.$departmentId.'"hidden>
                        </div>
                      </div>
                    </div>'; 
                        
                        ?>
                        <?php

                        date_default_timezone_set('America/Mexico_City');
                        $date = date('Y-m-d');
                        $time = date('H:i:s');
                        $currentDate = $date;
                      
                  echo'
                    <div class="col-12 col-sm-2">
                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12"">
                          <label class="mr-2" for="placed-date">Fecha-Requisición</label>
                          <input type="date" style="width: 100%" class="form-control form-control-sm" value="'.$currentDate.'"id="placed-date" name="placed-date"readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2"for="requirement-date">Fecha-Estimada</label>
                          <input type="date" style="width: 100%" class="form-control form-control-sm" id="requirement-date" name="requirement-date"required>
                        </div>
                      </div>
                    </div>';
                    ?>
                    
                <div class="col-12 col-sm-3">
                  
                  <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label class="mr-2"for="next-approver">Nombre del Emp:</label>
                        <div class="input-group-prepend input-group-sm">
                          <?php
                          if ($_SESSION["photo"] == ""){
                          echo '<img src="img/users/default/anonymous.png" alt="" id="next-approber" style="width: 31x; height: 31px">';
                          }else{
                          echo '<img src="'.$_SESSION["photo"].'" alt="" id="next-approber" style="width: 31x; height: 31px">';
                          };
                          ?>
                          <input type="text" style="width: 100%" class="form-control " value="<?php echo $_SESSION["name"];?>" id="approver1" name="staff"readonly>

                        </div>
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <div class="input-group  col-sm-12">
                      
                      <?php
                      $item = "branch_id";
                      $value = $branchId;
                      $approver = branchController::ctrShowBranchApprover($item,$value); 
                      $quoter = branchController::ctrShowBranchQuoter($item,$value); 
                      ?>



                      <label class="mr-2" for="next-approver2">Aprobación Final por:</label>
                        <div class="input-group-prepend input-group-sm">
                          <?php
                          if ($approver["staff_photo"] == ""){
                          echo '<img src="img/users/default/anonymous.png" alt="" id="next-approber" style="width: 31x; height: 31px">';
                        }else{
                          echo '<img src="'.$approver["staff_photo"].'" alt="" id="next-approber" style="width: 31x; height: 31px">';
                        };
                          ?>
                          <input type="text" style="width: 100%" class="form-control " value="<?php echo $approver["staff_name"]; ?>" id="approver-name" name="approver-name" placeholder="" readonly>
                          <input type="hidden" value="<?php echo $approver["staff_id"]; ?>" name="approver-id">

                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group  col-sm-12">
                    
                      <label class="mr-2" for="">Cotizacion por:</label>
                        <div class="input-group-prepend input-group-sm">
                          <?php
                          if ($quoter["staff_photo"] == ""){
                          echo '<img src="img/users/default/anonymous.png" alt="" id="next-quoter" style="width: 31x; height: 31px">';
                        }else{
                          echo '<img src="'.$quoter["staff_photo"].'" alt="" id="next-quoter" style="width: 31x; height: 31px">';
                        };
                          ?>
                          <input type="text" style="width: 100%" class="form-control " value="<?php echo $quoter["staff_name"]; ?>" id="quoter-name" name="quoter-name" placeholder="" readonly>
                          <input type="hidden" value="<?php echo $quoter["staff_id"]; ?>" name="quoter-id">

                        </div>
                    </div>
                  </div>
                
                </div>
                
                <div class="form-group " id="product-array"></div>
                
                    <div class="col-12 col-sm-4  text-center align-self-center box-approval">
                        <h3 class="">¿REALIZAR REQUISICIÓN?</h3>
                        <h6>POR FAVOR CONFIRME HACIENDO</h6><h6 class="text-success m-3">CLICK</h6>
                        <div class="button-group m-3">
                            <button type="button" class="btn btn-danger mr-3 btn-cancel-req"><i class="icon ion-ios-thumbs-down"></i> Declinar</button>
                            <button type="submit" class="btn btn-success btn-submit-req"><i class="icon ion-ios-thumbs-up"></i> Realizar</button>

                              <?php

                              $inRequest = new requestController();
                              $inRequest ->ctrInsertRequest();

                              ?>
                        
                        </div>
                    </div>
                </form>
                </div>
                <!-- /.CUERPO DE LA TARJETA -->
               
            </div>
            <!-- /.TARJETA -->
           
            <!-- INICIA TARJETA INFERIOR PARA LISTA DE ARTICULOS -->
           
            <div class="card col-12">
                <div class="card-header">
                    <h3 class="card-title">Lista de Artículos</h3>
                  <div class="card-tools">
                    <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-product-list"> <i class="icon ion-ios-add"></i> Agregar Articulo</button>
                  </div>
                </div>
                <!-- /.card-header -->
              <div class="card-body">
                <table id="quotation-table" class="table table-bordered table-striped table-sm quotation-table">
                  <thead>
                    <tr>
                      <th class="text-center">Cantidad</th>
                      <td class="d-none">Id producto</td>
                      <th>Artículo</th>
                      <th>Unidad</th>
                      <th>Enlace</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody id="requesting-list"></tbody>
                </table>
              </div> <!-- /.CUERPO DE LA TARJETA -->
            </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> <!-- /.content-header -->
   
   <!-- INICIA MODAL PARA SELECCION DE ARTICULOS -->

    <div class="modal fade" id="modal-product-list">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header ">
              <h4 class="modal-title">Agregar Articulo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        
        <!-- PESTANA SUPERIOR DEL MODAL -->

        <div class="modal-tools">
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              
              <li class="nav-item">
                <a class="nav-link active" id="nombre-tab" data-toggle="tab" href="#nombre" role="tab" aria-controls="table" aria-selected="true">Busqueda x Nombre</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" id="numero-tab" data-toggle="tab" href="#numero" role="tab" aria-controls="item" aria-selected="false">Busqueda x Numero</a>
              </li>
            
            </ul>
        
        </div>

          <!--CUERPO DEL MODAL  -->

          <div class="modal-body" style="scroll:overflow;">

            <div class="tab-content" id="myTabContent"> 

              <!-- PRIMER TAB -->

              <div class="tab-pane fade show active" id="nombre" role="tabpanel" aria-labelledby="nombre-tab">                                        

            <div class="row mb-3">
              <div class="input-group input-group-sm col-md-3">
                <input type="text" class="form-control input-name">
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat nom-item-btn">Buscar</button>
                </span>
              </div>
            </div>
            
            <div class="row">
            
              <table id="quotation-table" class="product-list-table table table-bordered table-hover table-sm">
                <thead>
                  <tr class="text-center">
                    <td class="d-none">Id producto</td>
                    <th>Articulo</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Agregar</th>             
                  </tr>
                </thead>
                <tbody id="product-list-item-2"></tbody>
              </table>

            </div>

            <div class="modal-footer justify-content-end">
              
              <button type="submit" data-dismiss="modal" class="btn btn-outline-success add-products">Cerrar Ventana</button>
            
            </div>
       
          </div> <!--FIN PRIMER TAB  -->
              
              <!-- SEGUNDO TAB -->
            
          <div class="tab-pane fade" id="numero" role="tabpanel" aria-labelledby="numero-tab">                                                          
            <div class="row mb-3">
              <div class="input-group input-group-sm col-md-3">
                <input type="text" class="form-control input-number">
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat sel-item-btn">Buscar</button>
                </span>
              </div>
            </div>
            
            <div class="row">
            
              <table id="quotation-table" class="product-list-table table table-bordered table-hover table-sm">
                <thead>
                  <tr class="text-center">
                    <td class="d-none">Id producto</td>
                    <th>Articulo</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Agregar</th>             
                  </tr>
                </thead>
                <tbody id="product-list-item"></tbody> 
              </table>

            </div>

            <div class="modal-footer justify-content-end">
              
              <button type="submit" data-dismiss="modal" class="btn btn-outline-success add-products">Cerrar Ventana</button>
            
            </div>

          </div> <!--FIN SEGUNDO TAB  -->

        </div><!-- /.tab-content- -->
      
      </div><!-- /.modal-card-body -->

           
          </div><!-- /.modal-content -->
          
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  </div>