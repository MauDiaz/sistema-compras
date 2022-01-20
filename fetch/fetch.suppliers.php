<?php

require_once "../controladores/suppliers.controller.php";
require_once "../modelos/suppliers.model.php";

  class fetchSupplier{

    public $supplierId;

    public function fetchRemoveSupplier(){

        $item = "supplier_id";
        $value = $this -> supplierId; 
        $answer = supplierController::ctrRemoveSupplier($item,$value);
        echo ($answer);
    }

    public $suppId;

    public function fetchShowSupplier(){

        $item = "supplier_id";
        $value = $this -> suppId;
        $answer = supplierController::ctrShowSupplier($item,$value);
        echo json_encode($answer);
    }
  }

   if(isset($_POST["supplierId"])){
    $supplierId = new fetchSupplier();
    $supplierId -> supplierId = $_POST["supplierId"];
    $supplierId -> fetchRemoveSupplier();
   }

   if(isset($_POST["suppId"])){
    $suppId = new fetchSupplier();
    $suppId -> suppId = $_POST["suppId"];
    $suppId -> fetchShowSupplier();
   }