<?php

require_once "../controladores/categories.controller.php";
require_once "../modelos/categories.model.php";

  class fetchCategories{

    public $categoryId;

    public function fetchRemoveCategory(){

        $item = "category_id";
        $value = $this -> categoryId;
        $answer = categoriesController::ctrRemoveCategory($item,$value);
        echo ($answer);
    }

  }



   if(isset($_POST["categoryId"])){
    $categoryId = new fetchCategories();
    $categoryId -> categoryId = $_POST["categoryId"];
    $categoryId -> fetchRemoveCategory();
   }