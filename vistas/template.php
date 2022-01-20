<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de Compras</title>
    <link rel="icon" href="img/principal/compras-ico.png">

    <!-- VINCULOS CSS -->

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/css/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <!-- <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="plugins/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Boostrap 4.0 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/css/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/css/datatables/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- summernotes -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
     <!-- select 2 -->
     <link rel="stylesheet" href="plugins/select2/select2.min.css">

    
    <!-- VINCULOS JS -->
    
    <!-- jQuery -->
    <script src="plugins/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="plugins/js/adminlte.js"></script>
    <!-- Popper-->
    <script src="plugins/js/popper.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/js/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/js/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/js/datatables/dataTables.responsive.min.js"></script>
    <script src="plugins/js/datatables/responsive.bootstrap4.min.js"></script>
    <!-- sweet alert -->
    <script src="extensiones/sweetalert2/sweetalert2.all.js"></script>
    <!-- select 2 -->
    <script src="plugins/select2/select2.min.js"></script>
     <!-- summernotes -->
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

</head>

<body class="hold-transition sidebar-mini sidebar-collapse text-xs layout-fixed layout-navbar-fixed">



    <?php

    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

      echo'<div class="wrapper"> ';
        /*=============================================
        =            INICIA HEADER           =
        =============================================*/
      
        include "vistas/pages/modules/header.php";
  
   
          /*=============================================
          =            INICIA SIDEBAR        =
          =============================================*/
       
          include "vistas/pages/modules/sidebar.php";

          /*=============================================
          =            INICIA CONTENIDO DINAMICO        =
          =============================================*/
        
        
        
          if(isset($_GET["ruta"])){

          
  
            if (  
                  //Landing Pages
                  $_GET["ruta"] == "MainDashboard" ||
                  $_GET["ruta"] == "login-page" ||
                  $_GET["ruta"] == "logout-page" ||
                  //Manageables
                  $_GET["ruta"] == "users" ||
                  $_GET["ruta"] == "suppliers" ||
                  $_GET["ruta"] == "jobposition" ||
                  $_GET["ruta"] == "prodCategories" ||
                  $_GET["ruta"] == "measureunits" ||
                  $_GET["ruta"] == "departments" ||
                  $_GET["ruta"] == "branches" ||
                  $_GET["ruta"] == "products" ||
                  $_GET["ruta"] == "inicio" ||
  
                  //Requesting Page Group
                  $_GET["ruta"] == "requesting" ||
                  $_GET["ruta"] == "rostatus" || 
                  $_GET["ruta"] == "rodetails" ||
                  //Quotating Page Group
                  $_GET["ruta"] == "quoting" ||
                  $_GET["ruta"] == "quostatus" || 
                  $_GET["ruta"] == "quodetails" ||
                   //Approving Page Group
                  $_GET["ruta"] == "aostatus" ||
                  $_GET["ruta"] == "aodetails" ||
                   //Purchasing Page Group
                  $_GET["ruta"] == "postatus" ||
                  $_GET["ruta"] == "podetails" ||
                   //Receiving Page Group
                  $_GET["ruta"] == "poreceivingstatus" ||
                  $_GET["ruta"] == "poreceivingdetail" ||  
                   //Purchase document page
                  $_GET["ruta"] == "dostatus" ||
                  $_GET["ruta"] == "polizas" ||
                  $_GET["ruta"] == "polizadetails" ||
                  $_GET["ruta"] == "polizadetailed" ||
                   //Reporting Page Group
                  $_GET["ruta"] == "reporting" || 
                   //Settings Page Group
                  $_GET["ruta"] == "settings" ||
                  //Consgi Page Gruop
                  $_GET["ruta"] == "consigstatus" ||
                  $_GET["ruta"] == "consigdetails" ||
                   //Exiting Page.
                  $_GET["ruta"] == "exit"
  
                  
    
                ){
                    
    
                  include "vistas/pages/".$_GET["ruta"].".php";
    
                }
    
                else{
               
                  include "vistas/pages/404.php";
         
                    }
          }
        }else{
           
  
                include "vistas/pages/login-page.php";
     
             }
  
        /*=============================================
            =            INICIA FOOTER       =
         =============================================*/

  
          echo '</div>';
  
    
    ?>

</div>



<script src="js/template.js"></script>
<script src="js/header.js"></script>
<script src="js/datatables.js"></script>
<script src="js/products.js"></script>
<script src="js/categories.js"></script>
<script src="js/requesting.js"></script>
<script src="js/quoting.js"></script>
<script src="js/requested.js"></script>
<script src="js/quoted.js"></script>
<script src="js/approval.js"></script>
<script src="js/porder.js"></script>
<script src="js/measure.js"></script>
<script src="js/departments.js"></script>
<script src="js/suppliers.js"></script>
<script src="js/branches.js"></script>
<script src="js/users.js"></script>
<script src="js/print.js"></script>
<script src="js/consig.js"></script>
<script src="js/poliza.js"></script>
<script src="js/date.js"></script>
</body>
</html>