<?php

require_once "../controladores/request.controller.php";
require_once "../modelos/request.model.php";

class fetchRequesting{


  public $requestId;


    public function fetchShowRequesting(){

    	$reqItem = "request_order_id";
    	$reqValue = $this -> requestId;
    	$answer = requestController::ctrShowResquestingPlaced($reqItem,$reqValue);
    	echo json_encode($answer);

    }


}


  if(isset($_POST["requestId"])){
    $requestId = new fetchRequesting();
    $requestId -> requestId = $_POST["requestId"];
    $requestId -> fetchShowRequesting();
   }