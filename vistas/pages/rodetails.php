<div class="content-wrapper" style="min-height: 1462.8px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

<?php
    
    if (isset($_GET["requested"])){
        $requested = $_GET["requested"];
           
    }else{
        $requested = '';
            } 
?>
            
            <div class="card col-12">
                <div class="card-header">
                    <h3 class="card-title">DETALLES DE REQUISICION # <?php echo $requested?></h3>
                        <div class="card-tools">
                        </div>
                </div>
                <!-- /.card-header -->
        <div class="card-body">

            <?php

            $reqItem = "request_order_id";
            $reqValue = $requested;
            $detPurchaseorder = requestController::ctrShowResquestingPlaced($reqItem,$reqValue);
            $date = substr($detPurchaseorder["request_order_date"],0,-8);

            ?>

                <div class="row">
                    <div class="form-group">
                        <div class="input-group  input-group-sm  col-sm-12">
                            <div class="input-group-prepend">
                                <label for="basic-addon1" class="mr-3">Req por:</label>
                                <?php
                                if ($detPurchaseorder["staff_photo"] == ""){
                               echo '<img src="img/users/default/anonymous.png" alt="" id="basic-addon1" style="width: 31x; height: 31px">';
                           }else{
                            echo '<img src="'.$detPurchaseorder["staff_photo"].'" alt="" id="basic-addon1" style="width: 31x; height: 31px">';
                           };
                                ?>
                           
                            </div>
                            <input type="text" class="form-control"  <?php echo'value="'.$detPurchaseorder["staff_name"].'"';?> aria-label="Username" aria-describedby="basic-addon1" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group  input-group-sm  col-sm-12">
                            <div class="input-group-prepend">
                                <label for="basic-addon2" class="mr-3">Req.tipo:</label>
                            </div>
                            <input type="text" class="form-control" <?php echo'value="'.$detPurchaseorder["order_type"].'"';?>  aria-label="req-type" aria-describedby="basic-addon2" readonly="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group  input-group-sm  col-sm-12">
                            <div class="input-group-prepend">
                                <label for="basic-addon2" class="mr-3">Empresa:</label>
                            </div>
                            <input type="text" class="form-control" <?php echo'value="'.$detPurchaseorder["branch_name"].'"';?> aria-label="Companyname" aria-describedby="basic-addon2"readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group  input-group-sm col-sm-12" style="width: 100%;">
                            <div class="input-group-prepend">
                                <label for="basic-addon3" class="mr-3">Departamento:</label>
                            </div>
                            <input type="text" class="form-control" <?php echo'value="'.$detPurchaseorder["department_name"].'"';?> aria-label="Companyname" aria-describedby="basic-addon3" readonly="">
                        </div>
                    </div>
          
                    <div class="form-group">
                        <div class="input-group  input-group-sm mb-1 col-sm-12">
                            <div class="input-group-prepend">
                                <label for="basic-addon4" class="mr-3">Fecha de Req:</label>
                            </div>
                            <input type="text" class="form-control" <?php echo'value="'.$date.'"';?> aria-label="req-date" aria-describedby="basic-addon4" readonly="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group  input-group-sm mb-1 col-sm-12">
                            <div class="input-group-prepend">
                                <label for="basic-addon5" class="mr-3">F. Entrega:</label>
                            </div>
                            <input type="text" class="form-control" <?php echo'value="'.$detPurchaseorder["request_order_required_date"].'"';?> aria-label="req-due" aria-describedby="basic-addon5" readonly>
                        </div>
                    </div>
                </div>

                <hr>
                    
                    <h5>Articulos Requisitados.</h5>
                    <table id="quotation-table" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                            <th>Cantidad</th>
                            <th>Articulo</th>
                            <th>Unidad</th>
                            <th>Enlace</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <?php

                        $itemList = "request_order_id";
                        $valueList = $requested;
                        $answerList = requestController::ctrShowRequestedItemList($itemList,$valueList);
                        foreach ($answerList as $key => $value){ 
                         echo '  
                            <td>'.$value["quantity"].'</td>
                            <td>'.$value["product_name"].'</td>
                            <td>Piezas</td>
                            <td>N/A</td>
                            </tr>';};
                        ?>
                        </tbody>
                   </table>
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