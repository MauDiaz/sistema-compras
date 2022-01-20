<?php

require_once "../controladores/measure.controller.php";
require_once "../modelos/measure.model.php";

  class fetchMeasures{

    public $unitId;

    public function fetchRemoveUnit(){

        $item = "meassure_unit_id";
        $value = $this -> unitId;
        $answer = measureController::ctrRemoveUnit($item,$value);
        echo ($answer);
    }

  }

   if(isset($_POST["unitId"])){
    $unitId = new fetchMeasures();
    $unitId -> unitId = $_POST["unitId"];
    $unitId -> fetchRemoveUnit();
   }