<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="card col-12">
                <div class="card-header">
                    <h1 class="card-title">Polizas de Egresos.</h1>
                        <div class="card-tools">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                           
                            <li class="nav-item">
                                <a class="nav-link active" id="open-tab" data-toggle="tab" href="#open" role="tab" aria-controls="open" aria-selected="true">Abiertas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#closed" role="tab" aria-controls="rejected" aria-selected="false">Cerradas</a>
                            </li>
                            
             
                        </ul>
                        
                        </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="tab-content" id="myTabContent">                      
                        <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">                                        
                        <h5>Polizas de Egreso Abiertas.</h5>
                     
                      <table id="quotation-table" class="table table-bordered table-striped table-sm text-center">
                       
                        <thead>
                            <tr>
                            <th>Poliza. Id</th>
                            <th>Cot. Id</th>
                            <th class="d-none">id Cotizador</th>
                            <th>Cotizador</th>
                            <th>Debe</th>
                            <th>Haber</th>
                            <th>Fecha de Disposicion del Recurso</th>
                           </tr>
                        </thead>
                        
                        <tbody>
                           

                        <?php
                        
                           $item = "poliza_status";
                           $value = 1;
                           $answer = polizasController::ctrShowPolizasStatus($item,$value);

                          
                           foreach ($answer as $key => $value) {

                               echo'  <tr>
                               <td><button class="btn  btn-warning btn-sm text-color-white btn-poliza "><i class="icon ion-ios-paper"></i>'.$value["poliza_id"].'</button></td>
                               <td>'.$value["quotation_order_id"].'</td>
                               <td class="d-none">'.$value["quoter_id"].'</td>
                               <td>'.$value["staff_name"].'</td>
                               <td>'.$value["cost_prev"].'</td> 
                               <td>'.$value["cost_after"].'</td>
                               <td>'.$value["date"].'</td>
                               </tr>';

                           };
                        
                           ?>

                        </tbody>
                    </table>

                  </div>

                  <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="rejected-tab">

                   <h5>Polizas de Egreso Cerradas.</h5>
                     
                     <table id="quotation-table-2" class="table table-bordered table-striped table-sm text-center">
                      
                       <thead>
                            <tr>
                            <th>Poliza. Id</th>
                            <th>Cot. Id</th>
                            <th class="d-none">id Cotizador</th>
                            <th>Cotizador</th>
                            <th>Debe</th>
                            <th>Haber</th>
                            <th>Fecha de Disposicion del Recurso</th>
                           </tr>
                        </thead>

                        <tbody>

                        <?php
                        
                           $item = "poliza_status";
                           $value = 2;
                           $answer = polizasController::ctrShowPolizasStatus($item,$value);

                          
                           foreach ($answer as $key => $value) {

                               echo'  <tr>
                               <td><button class="btn  btn-warning btn-sm text-color-white btn-poliza-2 "><i class="icon ion-ios-paper"></i>'.$value["poliza_id"].'</button></td>
                               <td>'.$value["quotation_order_id"].'</td>
                               <td class="d-none">'.$value["quoter_id"].'</td>
                               <td>'.$value["staff_name"].'</td>
                               <td>'.$value["cost_prev"].'</td> 
                               <td>'.$value["cost_after"].'</td>
                               <td>'.$value["date"].'</td>
                               </tr>';

                           };
                        
                           ?>

                        </tbody>
                    </table>


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