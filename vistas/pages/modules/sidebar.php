<aside class="main-sidebar sidebar-dark-orange elevation-4 fixed"> 
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="img/principal/logo.png" alt="ComprasLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> Modulo de Compras </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar fixed">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
          if ($_SESSION["photo"] == ""){
          echo'<img src="img/users/default/anonymous.png" class="img-circle elevation-2" alt="User Image">';
          }
          else {
            echo'<img src="'.$_SESSION["photo"].'" class="img-circle elevation-2" alt="User Image">';
          };
          ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["name"]?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent text-sm flex-column" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open display-block">
                                  <a href="inicio" class="nav-link">
                                  <i class="icon ion-ios-pulse"></i>
                                    <p>
                                      Dashboard
                                    </p>
                                  </a>
                               
           </li>
           <?php                                  
            if($_SESSION["role"] != 6){
                echo'<li class="nav-item">
                  <a href="rostatus" class="nav-link">
                    <i class="icon ion-ios-add-circle-outline nav-icon"></i>
                    <p>Requisiciones</p>
                  </a> 
                </li>';}
                ?>
                <?php
                if(($_SESSION["position"] == 7 && $_SESSION["role"] == 4) ||
                  ($_SESSION["position"] == 5 && $_SESSION["role"] == 4) ||
                ($_SESSION["position"] == 1 && $_SESSION["role"] == 1)){
                
          echo'<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-item has-treeview menu-close">
            <a href="quotating" class="nav-link ">
              <i class="icon ion-ios-cash nav-icon"></i>
              <p>
                Cotizar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="quoting" class="nav-link">
                  <i class="icon ion-ios-add-circle-outline nav-icon"></i>
                  <p>Cotizar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="quostatus" class="nav-link">
                  <i class="icon ion-ios-add-circle-outline nav-icon"></i>
                  <p>Lista Cotizaciones.</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="consigstatus" class="nav-link">
                  <i class="icon ion-ios-add-circle-outline nav-icon"></i>
                  <p>Ajuste de Consignaciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="products" class="nav-link">
                  <i class="icon ion-ios-checkmark nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="prodCategories" class="nav-link">
                  <i class="icon ion-ios-checkmark nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="suppliers" class="nav-link">
                  <i class="icon ion-ios-checkmark nav-icon"></i>
                  <p>Proveedores</p>
                </a>
              </li>
          </li>
            </ul>
              </ul>';}
                ?>
            <?php    
            if(($_SESSION["position"] == 2 && $_SESSION["role"] == 3) || 
               ($_SESSION["position"] == 3 && $_SESSION["role"] == 3) ||
               ($_SESSION["position"] == 1 && $_SESSION["role"] == 1)){
                echo'<li class="nav-item">
                  <a href="aostatus" class="nav-link">
                    <i class="icon ion-ios-checkmark-circle-outline nav-icon"></i>
                    <p>Aprobaciones</p>
                  </a>
                </li>';}
                ?>
                <?php
                if(($_SESSION["position"] == 7 && $_SESSION["role"] == 4) ||
                  ($_SESSION["position"] == 5 && $_SESSION["role"] == 4) ||
                ($_SESSION["position"] == 1 && $_SESSION["role"] == 1)){
                echo'<li class="nav-item">
                  <a href="postatus" class="nav-link">
                    <i class="icon ion-ios-cart nav-icon"></i>
                    <p>Compras</p>
                  </a>
                </li>';}
                ?>
                <?php
                 if(($_SESSION["position"] == 3 && $_SESSION["role"] == 6) ||
                ($_SESSION["position"] == 1 && $_SESSION["role"] == 1)){
                // if(($_SESSION["position"] == 4 && $_SESSION["role"] == 5)
                //    || ($_SESSION["position"] == 5 && $_SESSION["role"] == 5)
                //    || ($_SESSION["position"] == 7 && $_SESSION["role"] == 5)
                //    || ($_SESSION["position"] == 1 && $_SESSION["role"] == 1))
                // {
                echo'<li class="nav-item">
                  <a href="dostatus" class="nav-link">
                    <i class="icon ion-ios-document nav-icon"></i>
                    <p>Crear Poliza</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="polizas" class="nav-link">
                    <i class="icon ion-ios-document nav-icon"></i>
                    <p>Polizas de Egresos</p>
                  </a>
                </li>

                ';}
              // }
                ?>
                 <?php
                // if(($_SESSION["position"] == 4 && $_SESSION["role"] == 5)
                //    || ($_SESSION["position"] == 5 && $_SESSION["role"] == 5)
                //    || ($_SESSION["position"] == 7 && $_SESSION["role"] == 5)
                //    || ($_SESSION["position"] == 1 && $_SESSION["role"] == 1))
                // {
                // echo'<li class="nav-item">
                //   <a href="inventory" class="nav-link">
                //     <i class="icon ion-ios-barcode nav-icon"></i>
                //     <p>Inventario</p>
                //   </a>
                // </li>';}
                ?>
                <!-- <li class="nav-item">
                  <a href="reporting" class="nav-link">
                    <i class="icon ion-ios-list nav-icon"></i>
                    <p>Reportes</p>
                  </a>
                </li> -->
        </ul>
        <?php
        if($_SESSION["position"] == 1 && $_SESSION["role"] = 1){
        echo'<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link ">
              <i class="icon ion-ios-cog nav-icon"></i>
              <p>
                Administracion
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="users" class="nav-link active">
                  <i class="icon ion-ios-checkmark nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="products" class="nav-link">
                  <i class="icon ion-ios-checkmark nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="prodCategories" class="nav-link">
                  <i class="icon ion-ios-checkmark nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="branches" class="nav-link">
                  <i class="icon ion-ios-checkmark nav-icon"></i>
                  <p>Empresas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="departments" class="nav-link">
                  <i class="icon ion-ios-checkmark nav-icon"></i>
                  <p>Departamentos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="suppliers" class="nav-link">
                  <i class="icon ion-ios-checkmark nav-icon"></i>
                  <p>Proveedores</p>
                </a>
              </li>
              

              </ul>
            </ul>';}
            ?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>