<?php

require_once "../controladores/quoting.controller.php";
require_once "../modelos/quoting.model.php";

class fetchApprovals{
    
    public $quotationId;
    public $statusValue;

    public $quotId;
    public $prodId;


    public function fetchRejectQuotation(){

        $table = "purchases_quotation_order";
        $item1 = "quotation_order_status";
        $value1 = $this -> statusValue;
        $item2 = "quotation_order_id";
        $value2 = $this -> quotationId;    
        $answer = quotingModel::mdlUpdateQuotationStatus($table,$item1,$value1,$item2,$value2);
        echo ($answer);
        
    }


    public function fetchDeleteProduct(){

        $table = "purchases_quotation_order_items";
        $data1 = $this -> quotId;
        $data2 = $this -> prodId;
        $answer = quotingModel::mdlDeleteQuotationItems($table,$data1,$data2);
        echo($answer);
    }
}

// Generar Objeto de $status

if(isset($_POST["quotationId"])){

    $quotationId = new fetchApprovals();
    $quotationId -> quotationId = $_POST["quotationId"];
    $quotationId -> statusValue = $_POST["statusValue"];
    $quotationId -> fetchRejectQuotation();

} 

/*=============================================
ELIMINAR ARTICULO DE LA LISTA DE COTIZACION ANTES DE CERRARLA
=============================================*/ 

if(isset($_POST["quotId"])){

    $quotId = new fetchApprovals();
    $quotId -> quotId = $_POST["quotId"];
    $quotId -> prodId = $_POST["prodId"];
    $quotId -> fetchDeleteProduct(); 

}
