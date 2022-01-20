<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <h3 class="text-info ml-3">Administrador de Categoria de Productos</h3>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <button class="btn btn-flat btn-success ml-5"data-toggle="modal" data-target="#AddCategoryModal">+ Categoria</button>
        <!-- /.row -->
      </div>

      <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-sm table-striped nowrap" id="table-catalogue">
                                        <thead class="text-center">
                                            <th>ID</th>
                                            <th>Categoria de Producto</th>
                                            <th>Accion</th>
                                        </thead>
                                        <tbody>
                                            
                                                <?php
                                            $itempos = null;
                                            $valuepos = null;
                                           $position = categoriesController::ctrShowCategories($item,$value);
                                          foreach ($position as $key => $value){
                                                echo'<tr>
                                                <td class="text-center">'.$value["category_id"].'</td>
                                                <td class="text-center">'.$value["category_name"].'</td>';
                                                echo'<td>
                                               <div class= "btn-group btn-group-sm">
                                                <button class="btn btn-warning btn-flat btn-edit-category"><i class="icon ion-ios-create"></i></button>
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

<div id="AddCategoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

        <!--===================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="color:grey">
          <h4 class="modal-title text-center">Agregar Categoria</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
          <div class="row mt-3">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Nombre de la categoria.</label>
                <input type="text" class="form-control" name="new-category" minlength="4" maxlength="35" pattern="[A-Za-z ]{4,35}" required>
                 <div class="valid-feedback">Valido!</div>
                 <div class="invalid-feedback">El nombre debe terner minimo 4 caracteres sin numeros.</div>
              </div>
            </div>
          </div>
        
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar Categoria</button>
        </div>        
      <?php
      $createCategory = new categoriesController();
      $createCategory -> ctrCreateCategory();                                      
      ?>
      </form>
    </div>
  </div>
</div>