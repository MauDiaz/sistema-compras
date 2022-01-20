 <?php

  $item = null;
  $value = null;

  $table = InicioController::ctrShowRequest($item,$value);

 ?>
  
            <div class="card col-md-12 ">
              <div class="card-header border-transparent">
                <h3 class="card-title">Ultimas Requisiciones</h3>

               
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Requisitó</th>
                      <th>Empresa</th>
                      <th>Departamento</th>
                      <th># Items</th>
                      <th>Fecha de requisicion</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 

                      foreach ($table as $key => $value){

                      echo
                    '<tr>
                      <td class="text-info">'.$value["request_order_id"].'</td>
                      <td>'.$value["staff_name"].'</td>
                      <td>'.$value["branch_name"].'</td>
                      <td>'.$value["department_name"].'</td>
                      <td>'.$value["quantity"].'</td>
                      <td>'.$value["request_order_date"].'</td>';
                      if ($value["request_order_status"] == 1) {
                      echo '<td><span class="badge badge-success">Abierta</span></td>';
                    }else if ($value["request_order_status"] == 3){
                     echo '<td><span class="badge badge-danger">Cerrada</span></td>';
                    };
                    echo'</tr>';
                    }

                    ?>
                   
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
             
       
            </div>
