<?php

  // CONTROLLER FILES REQUIERED

require_once "controladores/template.controller.php";
require_once "controladores/ordertype.controller.php";
require_once "controladores/staff.controller.php";
require_once "controladores/product.controller.php";
require_once "controladores/categories.controller.php";
require_once "controladores/request.controller.php";
require_once "controladores/quoting.controller.php";
require_once "controladores/approvals.controller.php";
require_once "controladores/department.controller.php";
require_once "controladores/position.controller.php";
require_once "controladores/suppliers.controller.php";
require_once "controladores/branches.controller.php";
require_once "controladores/measure.controller.php";
require_once "controladores/status.controller.php";
require_once "controladores/role.controller.php";
require_once "controladores/porder.controller.php";
require_once "controladores/consig.controller.php";
require_once "controladores/inicio.controller.php";
require_once "controladores/polizas.controller.php";



  // MODEL FILES REQUIERED

  require_once "modelos/ordertype.model.php";
  require_once "modelos/staff.model.php";
  require_once "modelos/product.model.php";
  require_once "modelos/categories.model.php";
  require_once "modelos/request.model.php";
  require_once "modelos/quoting.model.php";
  require_once "modelos/approvals.model.php";
  require_once "modelos/department.model.php";
  require_once "modelos/position.model.php";
  require_once "modelos/suppliers.model.php";
  require_once "modelos/branches.model.php";
  require_once "modelos/measure.model.php";
  require_once "modelos/status.model.php";
  require_once "modelos/role.model.php";
  require_once "modelos/porder.model.php";
  require_once "modelos/inicio.model.php";
  require_once "modelos/polizas.model.php";

  require_once "extensiones/vendor/autoload.php";


$template = new controllerTemplate();
$template -> ctrTemplate();