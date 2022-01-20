<nav class="main-header navbar navbar-expand navbar-white navbar-light">
   
    <!-- Links a la izquierda -->

    <ul class="navbar-nav">

    <!-- SideBar collapsing bars -->

      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

      <!-- request-type dropdown dat-toggle-->
      
      <li class="nav-item dropdown">
        <a id="subMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"> <i class="icon ion-ios-add"></i> Agregar Requisicion </a>
        <ul aria-labelledby="subMenu1" class="dropdown-menu border-0 shadow">

        <!-- Select from ORDER TYPE table dinamically -->

        <?php

            $item= null;
            $value= null;
            $orderType = orderTypeController::ctrShowOrderType($item,$value);

            foreach ($orderType as $key => $value){

              $orderName = $value["order_type"];

          echo'<li><a href="#" class="dropdown-item request-type">'.$orderName.'</a></li>';
        }    
        ?>
        </ul>
      </li>   
    </ul>

       <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
         <li class="nav-item">
        <a class="nav-link"  data-slide="true" href="logout-page"><i class="fas fa-th-large"></i> Salir</a>
      </li>
    </ul>
  </nav>