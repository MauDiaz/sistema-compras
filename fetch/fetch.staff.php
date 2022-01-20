<?php

require_once "../controladores/staff.controller.php";
require_once "../modelos/staff.model.php";

  class fetchStaff{

    public $staffId;
    public $staffStatus;
    public $valEmail;
    public $idBtn;
    // public function fetchRemoveUser(){

    //     $item = "staff_id";
    //     $value = $this -> staffId;
    //     $answer = staffController::ctrRemoveStaff($item,$value);
    //     echo ($answer);
    // }

    public function fetchActiveUser(){

      $table = "purchases_staffs";
      $item1 = "active";
      $value1 = $this -> staffStatus;
      $item2 = "staff_id";
      $value2 = $this -> staffId;
      $answer = staffModels::mdlUpdateUserLogin($table, $item1, $value1, $item2, $value2);
      echo ($answer);
    }

    public function fetchValidateEmail(){

      $table = "purchases_staffs";
      $item = "staff_email";
      $value = $this -> valEmail;
      $answer = staffModels::mdlShowStaff($table,$item,$value);
      echo json_encode($answer); 
    }

    public function fetchEditUser(){

      $table = "purchases_staffs";
      $item = "staff_id";
      $value = $this -> idBtn;
      $answer = staffModels::mdlShowStaffComplete($table,$item,$value);
      echo json_encode($answer);
    }

  }

   // if(isset($_POST["staffId"])){
   //  $staffId = new fetchStaff();
   //  $staffId -> staffId = $_POST["staffId"];
   //  $staffId -> fetchRemoveUser();
   // }

/*=============================================
DECLARING OBJECTS TO ACTIVATE OR DEACTIVATE USERS
=============================================*/


   if(isset($_POST["staffId"])){
    $staffId = new fetchStaff();
    $staffId -> staffId = $_POST["staffId"];
    $staffId -> staffStatus = $_POST["staffStatus"];
    $staffId -> fetchActiveUser();
   }

/*=============================================
DECLARING OBJECTS TO VALIDATE DUPLICATED EMAIL 
=============================================*/

 if(isset($_POST["valEmail"])){
    $valEmail = new fetchStaff();
    $valEmail -> valEmail = $_POST["valEmail"];
    $valEmail -> fetchValidateEmail(); 
   }


/*=============================================
DECLARING OBJECTS TO GET USER INFO 
=============================================*/

 if(isset($_POST["idBtn"])){
    $editUser = new fetchStaff();
    $editUser -> idBtn = $_POST["idBtn"];
    $editUser -> fetchEditUser();
   }