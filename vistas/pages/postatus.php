<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="card col-12">
                <div class="card-header">
                    <h1 class="card-title">Ordenes de Compra.</h1>
                        <div class="card-tools">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
  
                                <a class="nav-link active" id="open-tab" data-toggle="tab" href="#open" role="tab" aria-controls="open" aria-selected="true">Orden de Compra</a>
                            </li>
                    
                        </ul>
                        
                        </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="tab-content" id="myTabContent">                      
                        <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">                                        
                        <h5>Ordenes de Compra.</h5>
                     
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
                           $value = 4 ;
                           $answer = quotingController::ctrShowQuotationStatus($item,$value);
                           foreach ($answer as $key => $value) {
                              $costo = number_format($value["costo"],2); 
                               echo' 
                               <td><button class="btn  btn-warning btn-sm text-color-white po-btn"><i class="icon ion-ios-paper"></i>'.$value["quotation_order_id"].'</button></td>
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