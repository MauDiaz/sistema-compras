<?php

require_once "../controladores/product.controller.php";
require_once "../modelos/product.model.php";

class fetchProducts{
    
    public $catSelect;

    public function fetchShowProductList(){

        $item = "category_id";
        $value = $this -> catSelect;    
        $answer = productController::ctrShowProducts($item,$value);
        echo json_encode($answer);
        
    }
}

// Generar Objeto de $catSelect

if(isset($_POST["catSelect"])){

    $catSelect = new fetchProducts();
    $catSelect -> catSelect = $_POST["catSelect"];
    $catSelect -> fetchShowProductList();

} 
