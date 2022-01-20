<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <h3 class="text-info ml-3">Administrador de Productos</h3>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <button class="btn btn-flat btn-success ml-5" data-toggle="modal" data-target="#AddProductsModal">+ Producto</button>
        <!-- /.row -->
      </div>

      <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-sm table-striped nowrap" id="table-catalogue">
                                        <thead>
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Unidad</th>
                                            <th>Status</th>
                                            <th>Categoria</th>
                                            <th>Accion</th>
                                        </thead>
                                        <tbody>
                                            
                                                <?php
                                            $item = null;
                                            $value = null;
                                           $product = productController::ctrShowProducts($item,$value);
                                          foreach ($product as $key => $value){
                                                echo'<tr>
                                                <td>'.$value["product_id"].'</td>
                                                <td>'.$value["product_name"].'</td>
                                                <td>'.$value["meassure_unit_name"].'</td>';


                                                if ($value["active"] == 1){
                                                echo'<td><button class= "btn btn-success btn-flat btn-sm btn-prod-active" product-id="'.$value["product_id"].'" product-status="2" >Activo</button>';
                                                }else{
                                                echo'<td><button class= "btn btn-danger btn-flat btn-sm btn-prod-active" product-id="'.$value["product_id"].'"product-status="1">Inactivo</button>';
                                                }
                                                $item = "category_id";
                                                $value = $value["category_id"];
                                                $category = categoriesController::ctrShowCategories($item,$value);
                                                                                      
                                                echo'<td>'.$category["category_name"].'</td>
                                                ';
                                               
                                                echo'<td>
                                                <div class= "btn-group btn-group-sm">
                                                <button class="btn btn-warning btn-flat btn-edit-product"><i class="icon ion-ios-create"></i></button>
                                                </div>
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
MODAL AGREGAR PRODUCTOS
======================================-->

<div id="AddProductsModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog  mw-100 w-75 mh-100 h-75">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" >
          <h4 class="modal-title">Agregar Producto</h4>
          <button type="button" class="close align-self-start" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
        <div class="row mt-3">

          <div class="col-md-4">
            <div class="form-group">
              <label class="bmd-label-floating">Nombre del Producto.</label>
              <input type="text" class="form-control" name="prod-name" minlength="4" maxlength="35" pattern="[A-Za-z0-9 .]{4,35}" id="product-name" required>
               <div class="valid-feedback">Valido!</div>
              <div class="invalid-feedback">El nombre debe terner minimo 4 caracteres sin numeros.</div>
            </div>
          </div>
          
          <div class="col-md-6">
          <div class="form-group">
            <label class="bmd-label-floating">Descripcion.</label>
            <input type="text" class="form-control" name="prod-desc" required>
             <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">La descripcion debe terner minimo 4 caracteres sin numeros.</div>
          </div>
        </div>

       <!--  <div class="col-md-2">
            <div class="form-group">
              <label class="bmd-label-floating">Precio de Compra</label>
              <input type="text" class="form-control" name="prod-price" required>
            </div>
          </div> -->

        </div>                                         

        <div class="row">
        <div class="col-md-4">
            <div class="form-group">
              <label class="bmd-label-floating">Categoria.</label>
              <select class="form-control select2 form-control-sm" name="prod-cat-id" style="width: 100%;" required>
              <option value="">Seleccione Categoria</option>
              <?php
              $item = null;
              $value = null;
              $category = categoriesController::ctrShowCategories($item,$value);
              foreach($category as $key => $value){
              echo'<option value="'.$value["category_id"].'">'.$value["category_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige una categoria valida! </div>
            </div>
          </div>  
     
               <div class="col-md-4">
            <div class="form-group">
              <label class="bmd-label-floating">Unida de Medida.</label>
              <select class="form-control select2 form-control-sm" name="prod-unit-id" style="width: 100%;" required>
              <option value="">Seleccione Unidad</option>
              <?php
              $item = null;
              $value = null;
              $unit = measureController::ctrShowMeasure($item,$value);
              foreach($unit as $key => $value){
              echo'<option value="'.$value["meassure_unit_id"].'">'.$value["meassure_unit_name"].'</option>';}
              ?>
              </select>
              <div class="valid-feedback">Valido!</div>
             <div class="invalid-feedback">Por favor elige una unidad de medida valida! </div>
              </div>
          </div>
        <!--   <div class="col-md-4">
            <div class="form-group">
              <label class="bmd-label-floating">Proveedor.</label>
              <select class="form-control select2 form-control-sm" name="prod-supp-id" style="width: 100%;" required>
              <option value="">Seleccione Proveedor</option>
              <?php
              $item = null;
              $vallue = null;
              $supplier = supplierController::ctrShowSupplier($item,$value);
              foreach($supplier as $key => $value){
              echo'<option value="'.$value["supplier_id"].'">'.$value["supplier_name"].'</option>';}
              ?>
              </select>
            </div>
          </div> -->
        
          </div>
        
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success" id="btn-save-product">Guardar Producto</button>
        </div>        
          <?php
          $createProduct =  new productController();
          $createProduct -> ctrCreateProduct();
          ?>      
      </form>
    </div>
  </div>
</div>
        