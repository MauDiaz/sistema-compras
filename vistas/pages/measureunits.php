<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <h3 class="text-info ml-3">Administrador de Unidades de Medida</h3>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <button class="btn btn-flat btn-success ml-5" data-toggle="modal" data-target="#AddMeasureModal">+ Unidad de Medida</button>
        <!-- /.row -->
      </div>

      <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-center">
                                            <th>ID</th>
                                            <th>Unidad de Medida</th>
                                            <th>Accion</th>
                                        </thead>
                                        <tbody>
                                            
                                                <?php
                                            $item = null;
                                            $value = null;
                                           $measure = measureController::ctrShowMeasure($item,$value);
                                          foreach ($measure as $key => $value){
                                                echo'<tr>
                                                <td class="text-center">'.$value["meassure_unit_id"].'</td>
                                                <td class="text-center">'.$value["meassure_unit_name"].'</td>';
                                                echo'<td>
                                                <div class= "btn-group btn-group-sm text-center">
                                                <button class="btn btn-warning btn-flat btn-edit-unit"><i class="icon ion-ios-create"></i></button>
                                                <button class="btn btn-danger btn-flat btn-remove-unit"><i class="icon ion-ios-cut"></i></button>
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
<!--=====================================
MODAL AGREGAR CATEGORIA
======================================-->

<div id="AddMeasureModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--===================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="color:grey">
          <h4 class="modal-title text-center">Agregar Unidad de Medida</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
          <div class="row mt-3">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Nombre de la unidad.</label>
                <input type="text" class="form-control" name="unit-name" required>
              </div>
            </div>
          </div>
        
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar Unidad</button>
        </div>        
      <?php
      $createMeasure = new measureController();
      $createMeasure -> ctrCreateMeasure();
      
      ?>
      </form>
    </div>
  </div>
</div>