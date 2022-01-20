<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="card col-12">
                <div class="card-header">
                    <h1 class="card-title">Requisiciones.</h1>
                        <div class="card-tools">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">



                                <a class="nav-link active" id="open-tab" data-toggle="tab" href="#open" role="tab" aria-controls="open" aria-selected="true">Abiertas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">Cerradas</a>
                            </li>

                        </ul>
                        
                        </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="tab-content" id="myTabContent">                      
                        <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">                                        
                        <h5>Requisiciones Abiertas.</h5>
                     
                      <table id="quotation-table" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                            <th>Cot. Id</th>
                            <th>#Articulos</th>
                            <th>Fecha de Req.</th>
                            <th>Fecha de Suministro.</th>
                            <th>Req. por:</th>
                            <th>Empresa</th>
                            <th>Departamento</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                        <?php
                            if($_SESSION["role"] == 1){
                           $item = 'request_order_status';
                           $value = 1 ;
                           $answer = requestController::ctrShowRequestStatus($item,$value); 
                           foreach ($answer as $key => $value) {
                               echo' 
                               <td><button class="btn  btn-warning btn-sm text-color-white requested-btn">'.$value["request_order_id"].'</button></td>
                               <td>'.$value["quantity"].'</td>
                               <td>'.$value["request_order_date"].'</td>
                               <td>'.$value["request_order_required_date"].'</td>
                               <td>'.$value["staff_name"].'</td> 
                               <td>'.$value["branch_name"].'</td>
                               <td>'.$value["department_name"].'</td> 
                               <td>
                                  <div class= "btn-group btn-group-sm">
                                  <button class="btn btn-danger btn-flat btn-to-inactive"><i class="icon ion-ios-close-circle "></i></button>
                                  <button class="btn btn-secondary btn-flat btn-req-print"><i class="icon ion-ios-print printer"></i></button>
                                  </div>
                                  </td>   
                               </tr>';

                           };
                        }else if ($_SESSION["role"] == 4){
                           $item = 'request_order_status';
                           $value = 1 ;
                           $item2 = "quoter_id";
                           $value2 = $_SESSION["id"];
                           $answer = requestController::ctrShowRequestStatus2($item,$value,$item2,$value2); 
                           foreach ($answer as $key => $value) {
                               echo' 
                               <td><button class="btn  btn-warning btn-sm text-color-white requested-btn">'.$value["request_order_id"].'</button></td>
                               <td>'.$value["quantity"].'</td>
                               <td>'.$value["request_order_date"].'</td>
                               <td>'.$value["request_order_required_date"].'</td>
                               <td>'.$value["staff_name"].'</td> 
                               <td>'.$value["branch_name"].'</td>
                               <td>'.$value["department_name"].'</td> 
                               <td>
                                  <div class= "btn-group btn-group-sm">
                                  <button class="btn btn-danger btn-flat btn-to-inactive"><i class="icon ion-ios-close-circle "></i></button>
                                  <button class="btn btn-secondary btn-flat btn-req-print"><i class="icon ion-ios-print printer"></i></button>
                                  </div>
                                  </td>   
                               </tr>';

                           };


                        }else{

                          $item = 'request_order_status';
                           $value = 1 ;
                           $item2 = "staff_id";
                           $value2 = $_SESSION["id"];
                           $answer = requestController::ctrShowRequestStatusStaff($item,$value,$item2,$value2);
                           foreach ($answer as $key => $value) {
                               echo' 
                               <td><button class="btn  btn-warning btn-sm text-color-white requested-btn">'.$value["request_order_id"].'</button></td>
                               <td>'.$value["quantity"].'</td>
                               <td>'.$value["request_order_date"].'</td>
                               <td>'.$value["request_order_required_date"].'</td>
                               <td>'.$value["staff_name"].'</td> 
                               <td>'.$value["branch_name"].'</td>
                               <td>'.$value["department_name"].'</td>
                               </tr>';

                        };

                      };
                           ?>

                        </tbody>
                    </table>
                        </div>
                        <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                           <h5>Requisiciones Cerradas.</h5>
                     
                      <table id="quotation-table-2" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                            <th>Cot. Id</th>
                            <th>#Articulos</th>
                            <th>Fecha de Req.</th>
                            <th>Fecha de Suministro.</th>
                            <th>Req. por:</th>
                            <th>Empresa</th>
                            <th>Departamento</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                        <?php
                            if($_SESSION["role"] == 1){
                           $item = 'request_order_status';
                           $value = 3 ;
                           $answer = requestController::ctrShowRequestStatus($item,$value);
                           foreach ($answer as $key => $value) {
                               echo' 
                               <td><button class="btn  btn-warning btn-sm text-color-white requested-btn">'.$value["request_order_id"].'</button></td>
                               <td>'.$value["quantity"].'</td>
                               <td>'.$value["request_order_date"].'</td>
                               <td>'.$value["request_order_required_date"].'</td>
                               <td>'.$value["staff_name"].'</td> 
                               <td>'.$value["branch_name"].'</td>
                               <td>'.$value["department_name"].'</td>
                               <td>
                                  <div class= "btn-group btn-group-sm">
                                  <button class="btn btn-success btn-flat btn-to-active"><i class="icon ion-ios-checkmark-circle "></i></button>
                                  <button class="btn btn-secondary btn-flat btn-req-print"><i class="icon ion-ios-print printer"></i></button>
                                  </div>
                                  </td>   
                               </tr>';

                           };
                        }else if ($_SESSION["role"] == 4){

                           $item = 'request_order_status';
                           $value = 3 ;
                           $item2 = "quoter_id";
                           $value2 = $_SESSION["id"];
                           $answer = requestController::ctrShowRequestStatus2($item,$value,$item2,$value2); 
                           foreach ($answer as $key => $value) {
                               echo' 
                               <td><button class="btn  btn-warning btn-sm text-color-white requested-btn">'.$value["request_order_id"].'</button></td>
                               <td>'.$value["quantity"].'</td>
                               <td>'.$value["request_order_date"].'</td>
                               <td>'.$value["request_order_required_date"].'</td>
                               <td>'.$value["staff_name"].'</td> 
                               <td>'.$value["branch_name"].'</td>
                               <td>'.$value["department_name"].'</td> 
                               <td>
                                  <div class= "btn-group btn-group-sm">
                                  <button class="btn btn-success btn-flat btn-to-active"><i class="icon ion-ios-close-circle "></i></button>
                                  <button class="btn btn-secondary btn-flat btn-req-print"><i class="icon ion-ios-print printer"></i></button>
                                  </div>
                                  </td>   
                               </tr>';

                           };

                        }else{

                          $item = 'request_order_status';
                           $value = 3 ;
                           $item2 = "staff_id";
                           $value2 = $_SESSION["id"];
                           $answer = requestController::ctrShowRequestStatusStaff($item,$value,$item2,$value2);
                           foreach ($answer as $key => $value) {
                               echo' 
                               <td><button class="btn  btn-warning btn-sm text-color-white requested-btn">'.$value["request_order_id"].'</button></td>
                               <td>'.$value["quantity"].'</td>
                               <td>'.$value["request_order_date"].'</td>
                               <td>'.$value["request_order_required_date"].'</td>
                               <td>'.$value["staff_name"].'</td> 
                               <td>'.$value["branch_name"].'</td>
                               <td>'.$value["department_name"].'</td>
                               </tr>';

                        };

                      };
                           ?>

                        </tbody>
                    </table>


                        </div>
                      <!--   <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                        </div>
                        <div class="tab-pane fade" id="purchased" role="tabpanel" aria-labelledby="purchased-tab">...</div>
                        <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">...</div>
                        <div class="tab-pane fade" id="out-of-date" role="tabpanel" aria-labelledby="out-of-date-tab">...</div>
                        </div> -->
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