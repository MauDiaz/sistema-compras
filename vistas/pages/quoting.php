<div class="content-wrapper" style="min-height: 1462.8px;">

    <!-- CONTENT HEADER -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="card col-12">
           
         <!-- TITULO DE LA TARJETA -->

                <div class="card-header">
                    <h3 class="card-title">NUEVA COTIZACION</h3><h3 class="card-title text-primary text-lowercase"></h3><h3 class="card-title text-primary text-lowercase" id=""></h3>  
                 </div>

                <!-- /.card-header -->

              <!-- CUERPO DE LA TARJETA -->

                <div class="card-body"> 
                  <form method="post">
                    <div class="row">
                     
                      <div class="col-12 col-sm-2" style="border-top: dashed .1px;border-left: dashed .1px;border-bottom: dashed .1px;">
                   
                        <div class="form-group">
                          <label>Seleccionar Requisicion</label>
                          <select class="form-control form-control-sm select2 bg-info" id="requesting-selector" name="request-id"style="width: 100%;" required>
                            <option value="">Sel. Requisicion</option>
                <?php

                      if($_SESSION["role"] == 1){

                      $item = "request_order_status";
                      $value = 1;
                      $requesting = requestController::ctrShowRequestStatus($item, $value);

                      foreach ($requesting as $key => $value) {
                        echo '<option value="'.$value["request_order_id"].'">'.$value["request_order_id"].'</option>';}
                      
                      }else if ($_SESSION["role"] == 4) {
                      $item = "request_order_status";
                      $value = 1;
                      $item2 = "quoter_id";
                      $value2 = $_SESSION["id"];
                      $requesting = requestController::ctrShowRequestStatus2($item, $value,$item2,$value2);

                      foreach ($requesting as $key => $value) {
                        echo '<option value="'.$value["request_order_id"].'">'.$value["request_order_id"].'</option>';}

                      }

                  ?>

                          </select>
                        </div>
  <div id="div-req1">                      
                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Requisicion Tipo:</label> 
                              <input type="text" style="width: 100%" class="form-control form-control-sm" id="req-type" name=""readonly>
                            </div>
                        </div>
                  
                  <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label class="mr-2"for="next-approver">Nombre del Emp:</label>
                        <div class="input-group-prepend input-group-sm">
                          <img src="img/users/default/anonymous.png" alt="" id="next-approber" style="width: 31px; height: 31px">
                          <input type="text" style="width: 100%" class="form-control " value="" id="approver1" name=""readonly>
                        </div>
                    </div>
                  </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm  col-sm-12">
                         <label class="mr-2" for="company">Empresa</label>
                                <input type="text" style="width: 100%"class="form-control" id="company" name="" value=""readonly>
                        </div>
                      </div>

  </div>                    
               </div>  
               

                    <div class="col-12 col-sm-2" style="border-top: dashed .1px;border-right: dashed .1px;border-bottom: dashed .1px;">
 <div id="div-req2">                     
                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12" >
                          <label class="mr-2" for="departament">Departamento</label>
                          <input type="text" style="width: 100%" class="form-control" id="departament" name="" value=""readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2" for="placed-date">Fecha-Requisición</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" value=""id="placed-date" name=""readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2"for="requirement-date">Fecha-Estimada</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" value=""id="requirement-date" name=""readonly>
                        </div>
                      </div>

  </div>                
                 
                        <div class="form-group" >
                          <label>Seleccionar Tipo de pago</label>
                          <select class="form-control form-control-sm select2 bg-info" id="payment-selector" name="payment-id" style="width: 100%;" required>
                            <option value="">Sel. Tipo de Pago</option> 

                               <?php

                              $item = null;
                              $value = null;
                              $payment = quotingController::ctrShowPaymentType($item, $value);
                              
                              foreach ($payment as $key => $value) {
                                echo '<option value="'.$value["payment_type_id"].'">'.$value["payment_type_name"].'</option>';}

                              ?>

                          </select>

        
                       </div>

            </div>

                <div class="col-12 col-sm-3 ml-2" style="border: dashed .1px;">
                  
               <!-- INICIA INFORMACION DEL PROVEEDOR -->

                        <div class="form-group">
                          <label>Seleccionar Proveedor</label>
                          <select class="form-control form-control-sm select3 bg-info" id="select-supplier" name="supplier-id" style="width: 100%;" required>
                            <option value="">Sel. Proveedor</option>
                 <?php

                      $item = null;
                      $value = null;
                      $supplier = supplierController::ctrShowSupplier($item, $value);

                      foreach ($supplier as $key => $value) {
                        echo '<option value="'.$value["supplier_id"].'">'.$value["supplier_name"].'</option>';}

                  ?>
                         </select>
                        </div>
<div id="div-supp">
                        
                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Direccion:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" id="" name="" value=""readonly>
                            </div>
                        </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm  col-sm-12">
                         <label class="mr-2" for="company">Telefono</label>
                                <input type="text" style="width: 100%"class="form-control" id="" name="" value=""readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12" >
                          <label class="mr-2" for="departament">Correo Electronico</label>
                          <input type="text" style="width: 100%" class="form-control" id="" name="company-mail" value=""readonly>
                        </div>
                      </div>
                      
</div>
               </div>



    <!-- TERMINA INFO PROVEEDOR -->
                    
                <div class="form-group " id="quoting-array"></div>
                
                    <div class="col-12 col-sm-4  text-center box-approval">
                        <h3 class="">¿GUARDAR COTIZACION?</h3>
                        <h6>POR FAVOR CONFIRME HACIENDO</h6><h6 class="text-success m-3">CLICK</h6>
                        <div class="button-group m-3">
                            <button type="button" class="btn btn-danger mr-3 btn-cancel-quot"><i class="icon ion-ios-thumbs-down"></i> Declinar</button>
                            <button type="submit" class="btn btn-success btn-submit-quot"><i class="icon ion-ios-thumbs-up"></i> Guardar</button>

                              <?php

                              $inQuoting = new quotingController();
                              $inQuoting ->ctrInsertQuotation();

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
                      <!-- <th class="text-right">Precio Unitario</th> -->
                      <!-- <th class="text-right">Costo Total</th> -->
                      <th class="text-center">Accion</th>>
                    </tr>
                  </thead>
                  <tbody id="quotation-list"></tbody>
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
                <input type="text" class="form-control input-name-quot">
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat nom-item-btn-2">Buscar</button>
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
                <input type="text" class="form-control input-number-quot">
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat sel-item-btn-2">Buscar</button>
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