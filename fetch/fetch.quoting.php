<?php

require_once "../controladores/quoting.controller.php";
require_once "../modelos/quoting.model.php";


 class fetchQuoting{

 	public $quotationId;
 	public $quantity;
 	public $productId;
 	public $priceList;
 	public $emailId;

 	public $quotId;
 	public $prodId;

 	public function fetchUpdateProduct(){


 		$table = "purchases_quotation_order_items";
 		$data1 = $this -> quotationId;
 		$data2 = $this -> productId;
 		$data3 = $this -> quantity;
 		$data4 = $this -> priceList;
 		$answer = quotingModel::mdlUpdateQuotationItems($table,$data1,$data2,$data3,$data4);
 		echo($answer);
 	}

 	public function fetchDeleteProduct(){

 		$table = "purchases_quotation_order_items";
 		$data1 = $this -> quotId;
 		$data2 = $this -> prodId;
 		$answer = quotingModel::mdlDeleteQuotationItems($table,$data1,$data2);
 		echo($answer);
 	}

 		public function fetchEmail(){

 		$table = "purchases_quotation_order";
 		$item = "quotation_order_id";
 		$value = $this -> emailId;
 		$answer = quotingModel::mdlEmailQuotation($table,$item,$value);
 		echo json_encode($answer);
 	}



 }

/*=============================================
ACTUALIZAR PRECIO Y CANTIDAD POR ARTICULO
=============================================*/	

if(isset($_POST["quotationId"])){

	$quotationId = new fetchQuoting();
	$quotationId -> quotationId = $_POST["quotationId"];
	$quotationId -> quantity = $_POST["quantity"];
	$quotationId -> productId = $_POST["productId"];
	$quotationId -> priceList = $_POST["priceList"];
	$quotationId -> fetchUpdateProduct();

}

/*=============================================
ELIMINAR ARTICULO DE LA LISTA DE COTIZACION ANTES DE CERRARLA
=============================================*/	

if(isset($_POST["quotId"])){

	$quotId = new fetchQuoting();
	$quotId -> quotId = $_POST["quotId"];
	$quotId -> prodId = $_POST["prodId"];
	$quotId -> fetchDeleteProduct(); 

}

/*=============================================
CONOCER EL EMAIL DEL PROVEEDOR
=============================================*/	

if(isset($_POST["emailId"])){

	$emailId = new fetchQuoting();
	$emailId -> emailId = $_POST["emailId"];
	$emailId -> fetchEmail(); 

}
