  <!-- box 1 -->

  <?php 

  $item = null;
  $value = null;

  $requisiciones = InicioController::ctrInicioRequisiciones($item,$value);


  ?>


  <div class="col-lg-3 col-6">

    <div class="small-box bg-info">
      
      <div class="inner">

        <h3><?php echo $requisiciones[0]; ?></h3>

        <p>Requisiciones Abiertas</p>

      </div>
      
      <div class="icon">

        <i class=" "></i>

      </div>

   
    
    </div>

  </div>

   <?php 

  $item = null;
  $value = null;


  $cotizaciones = InicioController::ctrInicioCotizaciones($item,$value);


  ?>
<!-- INICIA BOX 2 -->

  <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
      
      <div class="inner">
        
        <h3><?php echo $cotizaciones[0]; ?></h3>

        <p>Cotizaciones Abiertas</p>
     
      </div>

      <div class="icon">

        <i class="ion ion-stats-bars"></i>
      
      </div>

    </div>
  
  </div>

 <?php 

  $item = null;
  $value = null;


  $cotizaciones2 = InicioController::ctrInicioCotizacionesAprobadas($item,$value);


  ?>
<!-- INICIA BOX 3 -->

  <div class="col-lg-3 col-6">

    <div class="small-box bg-success">

      <div class="inner">

        <h3><?php echo $cotizaciones2[0]; ?></h3>

        <p>Cotizaciones Aprobadas</p>

      </div>

      <div class="icon">

        <i class="ion ion-person-add"></i>

      </div>

    </div>

  </div>

  <?php 

  $item = null;
  $value = null;


  $cotizaciones3 = InicioController::ctrInicioCotizacionesRechazadas($item,$value);


  ?>

 <!-- INICIA BOX 4 -->

  <div class="col-lg-3 col-6">

    <div class="small-box bg-danger">

      <div class="inner">
        
        <h3><?php  echo $cotizaciones3[0]; ?></h3>

        <p>Cotizaciones Rechazadas</p>

      </div>

      <div class="icon">
        
        <i class="ion ion-pie-graph"></i>
     
      </div>

    </div>

  </div>
