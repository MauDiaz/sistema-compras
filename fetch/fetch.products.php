<?php

require_once "../controladores/product.controller.php";
require_once "../modelos/product.model.php";

  class fetchProducts{

    public $itemId;

    public function fetchShowProduct(){

        $item = "product_id";
        $value = $this -> itemId;
        $answer = productController::ctrShowProducts($item,$value);
        echo json_encode($answer);
    }

    public $itemIdbyName;

    public function fetchShowProductByName(){

        $item = "product_name";
        $value = $this -> itemIdbyName;
        $answer = productController::ctrShowProductsByName($item,$value);
        echo json_encode($answer);
    }

    public $productActiveId;
    public $productStatus;

      public function fetchActiveProduct(){

      $table = "purchases_products";
      $item1 = "active";
      $value1 = $this -> productStatus;
      $item2 = "product_id";
      $value2 = $this -> productActiveId;
      $answer = productModel::mdlUpdateActiveProduct($table, $item1, $value1, $item2, $value2);
      echo ($answer);
    }

    public $valProduct;

    public function fetchValidateProducts(){

      $table = "purchases_products";
      $item = "product_name";
      $value = $this -> valProduct;
      $answer = productModel::mdlShowProduct($table,$item,$value);
      echo json_encode($answer); 
    }

  }

/*=============================================
DECLARING OBJECTS TO VALIDATE ITEM BY ID
=============================================*/


   if(isset($_POST["itemId"])){
    $itemId = new fetchProducts();
    $itemId -> itemId = $_POST["itemId"];
    $itemId -> fetchShowProduct();
   }

/*=============================================
DECLARING OBJECTS TO VALIDATE ITEM BY NAME
=============================================*/


   if(isset($_POST["itemIdbyName"])){
    $itemIdbyName = new fetchProducts();
    $itemIdbyName -> itemIdbyName = $_POST["itemIdbyName"];
    $itemIdbyName -> fetchShowProductByName();
   }


/*=============================================
DECLARING OBJECTS TO ACTIVATE OR DEACTIVATE PRODUCTS
=============================================*/


   if(isset($_POST["productActiveId"])){
    $productActiveId = new fetchProducts();
    $productActiveId -> productActiveId = $_POST["productActiveId"];
    $productActiveId -> productStatus = $_POST["productStatus"];
    $productActiveId -> fetchActiveProduct();
   }

/*=============================================
DECLARING OBJECTS TO VALIDATE DUPLICATED PRODUCT 
=============================================*/

 if(isset($_POST["valProduct"])){
    $valProduct = new fetchProducts();
    $valProduct -> valProduct = $_POST["valProduct"];
    $valProduct -> fetchValidateProducts(); 
   }
