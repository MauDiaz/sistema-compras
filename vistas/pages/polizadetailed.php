<div class="content-wrapper" style="min-height: 1462.8px;">

    <!-- CONTENT HEADER -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="card col-12">


              <?php
    
                  if (isset($_GET["poliza"])){
                      $poliza = $_GET["poliza"];
                         
                  }else{
                      $poliza = '';
                          } 
              ?>

            <?php
           
           
            echo'<!-- TITULO DE LA TARJETA -->

                <div class="card-header">
                    <h3 class="card-title">DETALLE DE POLIZA-</h3><h3 class="card-title text-primary text-lowercase">#'.$poliza.'</h3> <h3 class="card-title text-primary text-lowercase" id=""></h3>  
                </div>

                <!-- /.card-header -->';
            ?>

                <!-- CUERPO DE LA TARJETA -->

                <div class="card-body">
          
                    <div class="row">
                     
                      <div class="col-12 col-sm-7">

                        <?php

                        $item = "poliza_id";
                        $value = $poliza;
                        $answer = polizasController::ctrShowPolizas($item,$value); 
                      
                        ?>

                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Poliza # :</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm bg-info" name="poliza-id" <?php echo'value="'.$answer["poliza_id"].'"';?>readonly>
                            </div>
                        </div>
 
                      
                        <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Orden de Compra # :</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" id="req-type" name="quot-id"<?php echo'value="'.$answer["quotation_order_id"].'"';?>readonly>
                            </div>
                        </div>
                  
                  <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label class="mr-2"for="next-approver">Cotizo :</label>
                        <div class="input-group-prepend input-group-sm">
                          <?php
                          if ($answer["staff_photo"] == ""){
                          echo'<img src="img/users/default/anonymous.png" alt="" id="next-approber" style="width: 31px; height: 31px">';
                        }else{
                          echo'<img src="'.$answer["staff_photo"].'" alt="" id="next-approber" style="width: 31px; height: 31px">';
                        };
                          ?>
                          <input type="text" style="width: 100%" class="form-control" id="approver1" name="staff-name"<?php echo'value="'.$answer["staff_name"].'"';?> readonly>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" name="staff-id" <?php echo'value="'.$answer["quoter_id"].'"';?>hidden>
                        </div>
                    </div>
                  </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm  col-sm-12">
                         <label class="mr-2" for="company">Debe :</label>
                                <input type="text" style="width: 100%"class="form-control" id="cost-prev" name="cost-prev" <?php echo'value="'.$answer["cost_prev"].'"';?> readonly>
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12" >
                          <label class="mr-2" for="departament">Haber :</label>
                          <input type="text" style="width: 100%" class="form-control" id="cost-after" name="cost-after" <?php echo'value="'.$answer["cost_after"].'"';?> pattern="[0-9]*\.?[0-9]*" readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2" for="placed-date">Fecha de disposicion del recurso:</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" name="date-placed" <?php echo'value="'.$answer["date"].'"';?> readonly>
                        </div>
                      </div>

                      
               </div>

                
                    <div class="col-12 col-sm-4  text-center align-self-center box-approval">
                        <h3 class="">BALANCE DE POLIZA DE EGRESOS</h3>
                        
                     
                    </div>
     
                </div>
                <!-- /.CUERPO DE LA TARJETA -->
               
            </div>
            <!-- /.TARJETA -->
           
 