<?php

require_once "../controladores/branches.controller.php";
require_once "../modelos/branches.model.php";

  class fetchBranches{

    public $branchId;

    public function fetchRemoveBranch(){

        $item = "branch_id";
        $value = $this -> branchId;
        $answer = branchController::ctrRemoveBranch($item,$value);
        echo ($answer);
    }

  }

   if(isset($_POST["branchId"])){
    $branchId = new fetchBranches();
    $branchId -> branchId = $_POST["branchId"];
    $branchId -> fetchRemoveBranch();
   }