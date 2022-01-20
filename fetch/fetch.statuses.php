<?php

require_once "../controladores/status.controller.php";
require_once "../modelos/status.model.php";

class fetchStatuses{
    
    public $orderIdA;

    public function fetchUpdateRequestStatusActive(){

        $item = "request_order_id";
        $value = $this -> orderIdA;    
        $answer = statusController::ctrUpdateRequestStatusActive($item,$value);
        echo ($answer);
        
    }

    public $orderIdI;

    public function fetchUpdateRequestStatusInactive(){

        $item = "request_order_id";
        $value = $this -> orderIdI;    
        $answer = statusController::ctrUpdateRequestStatusInactive($item,$value);
        echo ($answer);
        
    }
}

// Generar Objeto de $status

if(isset($_POST["orderIdA"])){

    $orderIdA = new fetchStatuses();
    $orderIdA -> orderIdA = $_POST["orderIdA"];
    $orderIdA -> fetchUpdateRequestStatusActive();

} 

// Generar Objeto de $status2

if(isset($_POST["orderIdI"])){

    $orderIdI = new fetchStatuses();
    $orderIdI -> orderIdI = $_POST["orderIdI"];
    $orderIdI -> fetchUpdateRequestStatusInactive();

} 