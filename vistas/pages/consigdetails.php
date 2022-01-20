<div class="content-wrapper" style="min-height: 1462.8px;">

    <!-- CONTENT HEADER -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="card col-12">


              <?php
    
                  if (isset($_GET["consig"])){
                      $aproved = $_GET["consig"];
                         
                  }else{
                      $aproved = '';
                          } 
              ?>

            <?php
           
           
            echo'<!-- TITULO DE LA TARJETA -->

                <div class="card-header">
                    <h3 class="card-title">DETALLE DE CONSIGNACION-</h3><h3 class="card-title text-primary text-lowercase">#'.$aproved.'</h3> <h3 class="card-title text-primary text-lowercase" id=""></h3>  
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
                        $value = $aproved;
                        $answer = quotingController::ctrShowQuotation($item,$value);
                        $date = substr($answer["request_order_date"],0,-8);

                        ?>

                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Requisición #:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm bg-info" id="req-type" name="req-id" <?php echo'value="'.$answer["request_order_id"].'"';?>readonly>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" id="appr-id" name="consig-id" <?php echo'value="'.$aproved.'"';?>hidden>
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
                          if($answer["staff_photo"] == ""){
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
                          <input type="text" style="width: 100%" class="form-control" id="departament" name="department" <?php echo'value="'.$answer["department_name"].'"';?> readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2" for="placed-date">Fecha-Requisición</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" id="placed-date" name="" <?php echo'value="'.$date.'"';?> readonly>
                        </div>
                      </div>

                      <!-- <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2"for="requirement-date">Fecha-Estimada</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" id="requirement-date" name=""<?php echo'value="'.$answer["request_order_required_date"].'"';?>readonly>
                        </div>
                      </div> -->

                       <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2"for="payment-type">Tipo de pago</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm bg-info" id="payment-type" name=""<?php echo'value="'.$answer["payment_type_name"].'"';?>readonly>
                        </div>
                      </div>

                        <div class="form-group" >
                          <label>Cambio Tipo de pago</label>
                          <select class="form-control form-control-sm select2 bg-danger" id="payment-selector" name="new-payment-type" style="width: 100%;" required>
                            <option value="">Nuevo Tipo de Pago</option> 
                          
                          <?php

                              $item = null;
                              $value = null;
                              $payment = quotingController::ctrShowPaymentType($item, $value);

                             
                                echo '<option value="'.$payment[0]["payment_type_id"].'">'.$payment[0]["payment_type_name"].'</option>';

                                echo '<option value="'.$payment[1]["payment_type_id"].'">'.$payment[1]["payment_type_name"].'</option>';

                              ?>


                          </select>


        
                       </div>
          

            </div>
                                
                <div class="col-12 col-sm-3 ml-2" style="border: dashed .1px;">
                  
               <!-- INICIA INFORMACION DEL PROVEEDOR -->
                       
                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="">Proveedor:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm bg-info" id="" name="supplier" <?php echo'value="'.$answer["supplier_name"].'"';?>value=""readonly>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Direccion:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" id="" name="" <?php echo'value="'.$answer["supplier_address"].'"';?>readonly>
                            </div>
                        </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm  col-sm-12">
                         <label class="mr-2" for="company">Telefono</label>
                                <input type="text" style="width: 100%"class="form-control" id="" name="" <?php echo'value="'.$answer["supplier_pn"].'"';?>readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12" >
                          <label class="mr-2" for="departament">Correo Electronico</label>
                          <input type="text" style="width: 100%" class="form-control" id="" name="" <?php echo'value="'.$answer["supplier_email"].'"';?>readonly>
                        </div>
                      </div>
                      
               </div>

    <!-- TERMINA INFO PROVEEDOR -->
                    
                <div class="form-group " id="aproved-array"></div>
                
                    <div class="col-12 col-sm-4  text-center align-self-center box-approval">
                        <h3 class="">¿AJUSTO CONSIGNACION?</h3>
                        <h6>POR FAVOR CONFIRME HACIENDO</h6><h6 class="text-success m-3">CLICK</h6>
                        <div class="button-group m-3">
                            <button type="button" class="btn btn-danger mr-3 btn-reject-consig" id="btn-reject-consig"><i class="icon ion-ios-thumbs-down"></i> Cancelar</button>
                            <button type="submit" class="btn btn-success btn-approval-quot"><i class="icon ion-ios-thumbs-up"></i> Aprobar</button>

                              <?php

                              $approvalQuoting = new ConsigController();
                              $approvalQuoting ->ctrConsigQuotation();

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
                <table id="aprobation-table" class="table table-bordered table-striped table-sm quotation-table">
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
                        $valueList = $aproved;
                        $answerList = quotingController::ctrShowQuotedItemList($itemList,$valueList);
                        foreach ($answerList as $key => $value){
                          $costo = number_format($value["quantity"] * $value["price_list"],2);
                         echo '<tr class="appr-det-list text-center">
                            <td class="text-center update-quantity-row-2"><input type="number" min="1" name="" id="" value="'.$value["quantity"].'"></td>
                            <td class="d-none">'.$value["product_id"].'</td>
                            <td>'.$value["product_name"].'</td>
                            <td>'.$value["meassure_unit_name"].'</td>
                            <td>'.$value["enlace"].'</td>
                            <td class="text-center update-price-row-2">'.$value["price_list"].'</td>
                            <td>'.$costo.'</td>
                            <td>
                              <div class= "btn-group btn-group-sm">
                                <button class="btn btn-danger btn-flat btn-delete-appro-prod">Eliminar</button>
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