<?php

require_once "../controladores/quoting.controller.php";
require_once "../controladores/polizas.controller.php";
require_once "../controladores/staff.controller.php";

require_once "../modelos/quoting.model.php";
require_once "../modelos/polizas.model.php";
require_once "../modelos/staff.model.php";





	class fetchPolizas{

/*=============================================
CONSULTAR SI EXISTE EL ROW EN LA TABLA
=============================================*/ 

		public $quotId;
		public $quoterId;

		public function fetchShowPoliza(){


			$table = "purchases_polizas";
			$item = "quotation_order_id";
			$value = $this -> quotId;
			$item1 = "quoter_id";
			$value1 = $this-> quoterId;

			$answer = polizasModel::mdlShowPoliza($table,$item,$value,$item1,$value1);

			echo json_encode($answer);


		}

/*=============================================
INSERTA UNA NUEVA POLIZA
=============================================*/ 

		public $quotId2;
		public $quoterId2;
		public $costo;


		public function fetchInsertPoliza(){

			$value = $this -> quotId2;
			$value1 = $this -> quoterId2;
			$value2 = $this -> costo;

			$answer2 = polizasController::ctrInsertPoliza($value,$value1,$value2);
			
			echo ($answer2);
		}

		public $status;

		public function fetchCheckPoliza(){

			$item = "poliza_status";
			$value = $this -> status;

			$answer = polizasController::ctrCheckPoliza($item, $value); 
			echo json_encode($answer);
		}

	}


/*=============================================
CONSULTAR SI EXISTE EL ROW EN LA TABLA
=============================================*/ 

if(isset($_POST["quotId"])){

    $quotId = new fetchPolizas();
    $quotId -> quotId = $_POST["quotId"];
    $quotId -> quoterId = $_POST["quoterId"];
    $quotId -> fetchShowPoliza(); 

}

/*=============================================
INSERTA UNA NUEVA POLIZA
=============================================*/ 

if(isset($_POST["quotId2"])){

    $quotId2 = new fetchPolizas();
    $quotId2 -> quotId2 = $_POST["quotId2"];
    $quotId2 -> quoterId2 = $_POST["quoterId2"];
    $quotId2 -> costo = $_POST["costo"];
    $quotId2 -> fetchInsertPoliza(); 

}


/*=============================================
CHECHAR PAGO DE POLIZA POR PARTE DEL COTIZADOR 
=============================================*/ 

if(isset($_POST["status"])){

    $status = new fetchPolizas();
    $status -> status = $_POST["status"];
    $status -> fetchCheckPoliza(); 

}

