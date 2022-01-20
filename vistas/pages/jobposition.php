<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <h3 class="text-info ml-3">Administrador de Puestos de Trabajo</h3>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <button class="btn btn-flat btn-success ml-5">+ Puesto</button>
        <!-- /.row -->
      </div>

      <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-center">
                                            <th>ID</th>
                                            <th>Puesto de Trabajo</th>
                                            <th>Accion</th>
                                        </thead>
                                        <tbody>
                                            
                                                <?php
                                            $itempos = null;
                                            $valuepos = null;
                                           $position = positionController::ctrShowposition($itempos,$valuepos);
                                          foreach ($position as $key => $value){
                                                echo'<tr>
                                                <td class="text-center">'.$value["position_id"].'</td>
                                                <td class="text-center">'.$value["position_name"].'</td>';
                                                echo'<td>
                                                <div class= "btn-group btn-group-sm text-center">
                                                <button class="btn btn-warning btn-flat btn-edit-user"><i class="icon ion-ios-create"></i></button>
                                                <button class="btn btn-danger btn-flat btn-remove-user"><i class="icon ion-ios-cut"></i></button>
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
