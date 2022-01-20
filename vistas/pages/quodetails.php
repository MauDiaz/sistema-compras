<div class="content-wrapper" style="min-height: 1462.8px;">

    <!-- CONTENT HEADER -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="card col-12">


              <?php
    
                  if (isset($_GET["quoted"])){
                      $quoted = $_GET["quoted"];
                         
                  }else{
                      $quoted = '';
                          } 
              ?>

            <?php
           
           
            echo'<!-- TITULO DE LA TARJETA -->

                <div class="card-header">
                    <h3 class="card-title">DETALLE DE COTIZACION  </h3><h3 class="card-title text-primary text-lowercase"> # '.$quoted.'</h3> <h3 class="card-title text-primary text-lowercase" id=""></h3>  
                </div>

                <!-- /.card-header -->';
            ?>

                <!-- CUERPO DE LA TARJETA -->

                <div class="card-body">  
                  <form method="post">
                    <div class="row">
                     
                      <div class="col-12 col-sm-2" style="border-top: dashed .1px;border-left: dashed .1px;border-bottom: dashed .1px;">

                        <?php

                        $item = "quotation_order_id";
                        $value = $quoted;
                        $answer = quotingController::ctrShowQuotation($item,$value);
                        $date = substr($answer["request_order_date"],0,-8);

                        ?>

                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Requisición #:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm bg-info" name="req-id" <?php echo'value="'.$answer["request_order_id"].'"';?>readonly>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" id="quot-id" name="quot-id" <?php echo'value="'.$quoted.'"';?>hidden>
                            </div>
                        </div>
 
                      
                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Requisicion Tipo:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" id="req-type" name=""<?php echo'value="'.$answer["order_type"].'"';?>readonly>
                            </div>
                        </div>
                  
                  <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label class="mr-2"for="next-approver">Nombre del Emp:</label>
                        <div class="input-group-prepend input-group-sm">
                          <?php
                          if ($answer["staff_photo"] == ""){
                         echo '<img src="img/users/default/anonymous.png" alt="" id="next-approber" style="width: 31px; height: 31px">';
                       }else{
                        echo '<img src="'.$answer["staff_photo"].'" alt="" id="next-approber" style="width: 31px; height: 31px">';
                      };
                          ?>
                          <input type="text" style="width: 100%" class="form-control" id="approver1" name="staff"<?php echo'value="'.$answer["staff_name"].'"';?> readonly>
                        </div>
                    </div>
                  </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm  col-sm-12">
                         <label class="mr-2" for="company">Empresa</label>
                                <input type="text" style="width: 100%"class="form-control" id="company" name="company" <?php echo'value="'.$answer["branch_name"].'"';?> readonly>
                        </div>
                      </div>

                    
               </div>

                    <div class="col-12 col-sm-2" style="border-top: dashed .1px;border-right: dashed .1px;border-bottom: dashed .1px;">
                     
                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12" >
                          <label class="mr-2" for="departament">Departamento</label>
                          <input type="text" style="width: 100%" class="form-control" id="department" name="department" <?php echo'value="'.$answer["department_name"].'"';?> readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2" for="placed-date">Fecha-Requisición</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" id="placed-date" name="" <?php echo'value="'.$date.'"';?> readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2"for="requirement-date">Fecha-Estimada</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" id="requirement-date" name=""<?php echo'value="'.$answer["request_order_required_date"].'"';?>readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2"for="payment-type">Tipo de pago</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm bg-info" id="payment-type" name=""<?php echo'value="'.$answer["payment_type_name"].'"';?>readonly>
                        </div>
                      </div>

                      
          

            </div>
                                
                <div class="col-12 col-sm-3 ml-2" style="border: dashed .1px;">
                  
               <!-- INICIA INFORMACION DEL PROVEEDOR -->
                       
                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="">Proveedor:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm bg-info"  name="supplier" <?php echo'value="'.$answer["supplier_name"].'"';?>value=""readonly>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Direccion:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" name="" <?php echo'value="'.$answer["supplier_address"].'"';?>readonly>
                            </div>
                        </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm  col-sm-12">
                         <label class="mr-2" for="company">Telefono</label>
                                <input type="text" style="width: 100%"class="form-control"  name="" <?php echo'value="'.$answer["supplier_pn"].'"';?>readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12" >
                          <label class="mr-2" for="departament">Correo Electronico</label>
                          <input type="text" style="width: 100%" class="form-control" name="" <?php echo'value="'.$answer["supplier_email"].'"';?>readonly>
                        </div>
                      </div>
                      
               </div>

    <!-- TERMINA INFO PROVEEDOR -->
                    
                <div class="form-group " id="quoted-array"></div>
                
                    <div class="col-12 col-sm-4  text-center align-self-center box-approval">
                        <h3 class="">¿CERRAR COTIZACION?</h3>
                        <h6>POR FAVOR CONFIRME HACIENDO</h6><h6 class="text-success  m-3">CLICK</h6> 
                        <div class="button-group m-3">
                            <button type="button" class="btn btn-danger mr-3 btn-cancel-quoted" id="btn-cancel-quoted"><i class="icon ion-ios-thumbs-down"></i> Cancelar</button>
                            <button type="submit" class="btn btn-success btn-close-quot"><i class="icon ion-ios-thumbs-up"></i> Cerrar</button>

                              <?php

                              $closeQuoting = new quotingController();
                              $closeQuoting ->ctrCloseQuotation();  
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
                    <div class="card-tools"></div>
                </div>
                <!-- /.card-header -->
              <div class="card-body">
                <table id="quotation-table" class="table table-bordered table-striped table-sm quotation-table">
                  <thead class="text-center">
                    <tr>
                      <th class="text-center">Cantidad</th>
                      <td class="d-none">Id producto</td>
                      <th>Artículo</th>
                      <th>Unidad</th>
                      <th>Enlace</th>
                      <th>Precio Unitario</th>
                      <th>Costo Total</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                  <?php
                        $itemList = "quotation_order_id";
                        $valueList = $quoted;
                        $answerList = quotingController::ctrShowQuotedItemList($itemList,$valueList);
                        foreach ($answerList as $key => $value){
                          $costo = number_format($value["quantity"] * $value["price_list"],2);
                         echo '<tr class="quo-det-list">
                            <td class="text-center update-quantity-row">
                            <input type="number" min="1" name="" id="" value="'.$value["quantity"].'">
                            </td>
                            <td class="d-none">'.$value["product_id"].'</td>
                            <td>'.$value["product_name"].'</td>
                            <td>'.$value["meassure_unit_name"].'</td>
                            <td>'.$value["enlace"].'</td>
                            <td class="text-center update-price-row"><input type="number" step="0.01" min="0" name="" id="quot-price" value="'.$value["price_list"].'"></td>
                            <td>'.$costo.'</td>
                            <td>
                              <div class= "btn-group btn-group-sm">
                                <button class="btn btn-warning btn-flat btn-update-prod"><i class="icon ion-ios-create "></i></button>
                                <button class="btn btn-danger btn-flat btn-delete-prod"><i class="icon ion-ios-remove "></i></button>
                              </div>
                            </td> 
                            </tr>';};
                        ?>
                </table>
              </div> <!-- /.CUERPO DE LA TARJETA -->
            </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> <!-- /.content-header -->
   
  

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