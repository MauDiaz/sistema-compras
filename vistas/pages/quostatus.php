<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="card col-12">
                <div class="card-header">
                    <h1 class="card-title">Cotizaciones.</h1>
                        <div class="card-tools">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">

                                <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Abiertas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Cerradas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">Rechazadas</a>
                            </li>
                     
                        </ul>
                        
                        </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="tab-content" id="myTabContent">                      
                        <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">                                        
                        <h5>Cotizaciones Abiertas.</h5>
                     
                      <table id="quotation-table" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                            <th>Cot. Id</th>
                            <th>Proveedor</th>
                            <th>#Articulos</th>
                            <th>Fecha de Req.</th>
                            <th>Fecha de Sum.</th>
                            <th>Req. por:</th>
                            <th>Empresa</th>
                            <th>Departamento</th>
                            <th>Costo Total</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                        <?php
                        
                           $item = 'quotation_order_status';
                           $value = 1 ;
                           $answer = quotingController::ctrShowQuotationStatus($item,$value);
                           foreach ($answer as $key => $value) {
                              $costo = number_format($value["costo"],2);
                               echo' 
                               <td><button class="btn  btn-warning btn-sm text-color-white quoted-btn" id="quoted-btn"><i class="icon ion-ios-paper"></i>'.$value["quotation_order_id"].'</button></td>
                               <td>'.$value["supplier_name"].'</td>
                               <td>'.$value["quantity"].'</td>
                               <td>'.$value["request_order_date"].'</td>
                               <td>'.$value["request_order_required_date"].'</td>
                               <td>'.$value["staff_name"].'</td> 
                               <td>'.$value["branch_name"].'</td>
                               <td>'.$value["department_name"].'</td> 
                               <td>'.$costo.'</td>
                               <td>
                                  <div class= "btn-group btn-group-sm">
                                  <button class="btn btn-secondary btn-flat btn-quot-print"><i class="icon ion-ios-print printer"></i></button>
                                  <button class="btn btn-info btn-flat btn-quot-email" data-toggle="modal"data-target="#emailModal"><i class="icon ion-ios-send"></i></button>
                                  </div>
                                  </td>   
                               </tr>';

                           };
                        
                           ?>

                        </tbody>
                    </table>
                        </div>
                        <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                        <h5>Cotizaciones Cerradas.</h5>
                     
                     <table id="quotation-table-2" class="table table-bordered table-striped table-sm">
                       <thead>
                           <tr>
                            <th>Cot. Id</th>
                            <th>Proveedor</th>
                            <th>#Articulos</th>
                            <th>Fecha de Req.</th>
                            <th>Fecha de Sum.</th>
                            <th>Req. por:</th>
                            <th>Empresa</th>
                            <th>Departamento</th>
                            <th>Costo Total</th>
                            <th>Acciones</th>
                            </tr>
                       </thead>
                       <tbody>
                           <tr>
                           <?php
                        
                           $item = 'quotation_order_status';
                           $value = 2 ;
                           $answer = quotingController::ctrShowQuotationStatus($item,$value);
                           foreach ($answer as $key => $value) {
                              $costo = number_format($value["costo"],2);
                               echo' 
                               <td>'.$value["quotation_order_id"].'</td>
                               <td>'.$value["supplier_name"].'</td>
                               <td>'.$value["quantity"].'</td>
                               <td>'.$value["request_order_date"].'</td>
                               <td>'.$value["request_order_required_date"].'</td>
                               <td>'.$value["staff_name"].'</td> 
                               <td>'.$value["branch_name"].'</td>
                               <td>'.$value["department_name"].'</td>
                               <td>'.$costo.'</td>
                               <td>
                                  <div class= "btn-group btn-group-sm">
                                  <button class="btn btn-secondary btn-flat btn-quot-print"><i class="icon ion-ios-print printer"></i></button>
                                  </div>
                                  </td>   
                               </tr>';

                           };
                        
                           ?>

                       </tbody>
                   </table>
                        
                        
                        </div>
                        <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                        
                        <h5>Requisiciones Rechazadas.</h5>
                     
                     <table id="quotation-table-3" class="table table-bordered table-striped table-sm">
                       <thead>
                           <tr>
                            <th>Cot. Id</th>
                            <th>Proveedor</th>
                            <th>#Articulos</th>
                            <th>Fecha de Req.</th>
                            <th>Fecha de Sum.</th>
                            <th>Req. por:</th>
                            <th>Empresa</th>
                            <th>Departamento</th>
                            <th>Costo Total</th>
                            <th>Acciones</th>
                            </tr>
                       </thead>
                       <tbody>
                           <tr>
                           <?php
                        
                           $item = 'quotation_order_status';
                           $value = 3 ;
                           $answer = quotingController::ctrShowQuotationStatus($item,$value);
                           foreach ($answer as $key => $value) {
                              $costo = number_format($value["costo"],2);
                               echo' 
                               <td>'.$value["quotation_order_id"].'</td>
                               <td>'.$value["supplier_name"].'</td>
                               <td>'.$value["quantity"].'</td>
                               <td>'.$value["request_order_date"].'</td>
                               <td>'.$value["request_order_required_date"].'</td>
                               <td>'.$value["staff_name"].'</td> 
                               <td>'.$value["branch_name"].'</td>
                               <td>'.$value["department_name"].'</td>
                               <td>'.$costo.'</td>
                               <td>
                                  <div class= "btn-group btn-group-sm">
                                  <button class="btn btn-secondary btn-flat btn-quot-print"><i class="icon ion-ios-print printer"></i></button>
                                  </div>
                                  </td>   
                               </tr>';

                           };
                        
                           ?>

                       </tbody>
                   </table>
                        
                        
                        </div>

                        <div class="tab-pane fade" id="purchased" role="tabpanel" aria-labelledby="purchased-tab">...</div>
                        <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">...</div>
                        <div class="tab-pane fade" id="out-of-date" role="tabpanel" aria-labelledby="out-of-date-tab">...</div>
                        </div>
                </div>
            </div>   
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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


<!--=====================================
MODAL EDITAR USUARIOS
======================================-->
<!-- Modal -->

<div id="emailModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog  mw-100 w-75 mh-100 h-75">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
 
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="color:grey">
          <h4 class="modal-title text-center">Enviar Email</h4>
          <button type="button" class="close float-left" data-dismiss="modal">&times;</button>
        </div>


        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Escribir Mensaje</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <form action="post" enctype="multipart/form-data">
                <div class="form-group">
               <input class="form-control" name="receiver" id="receiver" value="" required>
               <?php echo '<input type="hidden" value="'.$_SESSION["email"].'" name="sender">';?>

                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" placeholder="Subject:" required>
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px" required>
                      
                    </textarea>
                </div>
                <div class="form-group">
                  <div class="panel">Adjuntar</div>
                    <i class="fas fa-paperclip"></i>
                    <input type="file" name="file">
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
              </div>
              </form>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
       
        </div>
       
        <?php
          $emailSupplier = new quotingController();
          $emailSupplier -> ctrCreateEmail();
          ?>     
      </form>
    </div>
  </div>
</div>