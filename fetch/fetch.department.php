<?php

require_once "../controladores/department.controller.php";
require_once "../modelos/department.model.php";

  class fetchDepartment{

    public $departmentId;

    public function fetchRemoveDepartment(){

        $item = "department_id";
        $value = $this -> departmentId;
        $answer = departmentController::ctrRemoveDepartment($item,$value);
        echo ($answer);
    }

  }

   if(isset($_POST["departmentId"])){
    $departmentId = new fetchDepartment();
    $departmentId -> departmentId = $_POST["departmentId"];
    $departmentId -> fetchRemoveDepartment();
   }