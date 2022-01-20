               <?php 

              $item = null;
              $value = null;

             $empresas = InicioController::ctrInicioEmpresas($item,$value);

             ?>

              <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Numero de Empresas</span>
                <span class="info-box-number"><?php echo $empresas[0]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

            <?php 

              $item = null;
              $value = null;

             $transferencia = InicioController::ctrInicioCotizacionesTransferencia($item,$value);


             ?>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-credit-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">COMPRAS EN TRASFERENCIA</span>
                <span class="info-box-number"><?php echo $transferencia[0]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

            <?php 

              $item = null;
              $value = null;

             $efectivo = InicioController::ctrInicioCotizacionesEfectivo($item,$value);


             ?>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-barcode"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">COMPRAS EN EFECTIVO</span>
                <span class="info-box-number"><?php echo $efectivo[0]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <?php 

              $item = null;
              $value = null;

             $consignacion = InicioController::ctrInicioCotizacionesConsignacion($item,$value);


             ?>


              <div class="info-box-content">
                <span class="info-box-text">COMPRAS EN CONSIGNACION</span>
                <span class="info-box-number"><?php echo $consignacion[0]; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
