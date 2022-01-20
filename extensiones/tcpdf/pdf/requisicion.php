<?php

	 // require_once "../../../controladores/approvals.controller.php";
	 // require_once "../../../modelos/approvals.model.php";
	 require_once "../../../controladores/request.controller.php";
	 require_once "../../../modelos/request.model.php";

  class printReq {

    public $reqId;
    
    public function printRequesting(){

		$itemList = "request_order_id";
		$valueList = $this->reqId;
		$itemList = requestController::ctrShowRequestedItemList($itemList,$valueList);

		$reqItem = "request_order_id";
		$reqValue = $this->reqId;
		$detPurchaseorder = requestController::ctrShowResquestingPlaced($reqItem,$reqValue);

		$date = substr($detPurchaseorder["request_order_date"],0,-8);
		$requiredDate = $detPurchaseorder["request_order_required_date"];

		
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf -> startPageGroup();

$pdf -> AddPage();

$block1 = <<<EOF
   
<table>
		
		<tr>
			<td style="width:100px"><img src="images/pal-logo.jpg" style="width:100px"></td>
			<td style="background-color:white; width:160px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Branch: Palladium Discotheque
					<br>
					Dirección: AV. ESCENICA S/N FRACC. GUITARRON
				</div>
			</td>

			<td style="background-color:white; width:160px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Teléfono: 744 446 5490
					<br>
					Email: palladium@correo.com
				</div>
				
			</td>
            <td style="background-color:white; width:115px; text-align:center; color:red"><br><br>Requisicion No.<br>$detPurchaseorder[request_order_number]</td>
			</tr>
	</table>


EOF;

$pdf->writeHTML($block1, false, false, false, false, '');

// ---------------------------------------------------------
$block2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/backFact2.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:8.5px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: doted .5px #e7efe3; background-color:white; width:180px">Sol: $detPurchaseorder[staff_name]</td>

			<td style="border: doted .5px #e7efe3; background-color:white; width:180px">Emp: $detPurchaseorder[branch_name]</td>
			
			<td style="border: doted .5px #e7efe3; background-color:white; width:180px">Dep: $detPurchaseorder[department_name]</td>

		</tr>

		<tr>
		
		<td style=" border: doted .5px #e7efe3; background-color:white; width:180px; color:blue">
				R. tipo: $detPurchaseorder[order_type]
			</td>

			<td style=" border: doted .5px #e7efe3; background-color:white; width:180px; text-align:left">
			
				F. Emision: $date

			</td>

			<td style=" border: doted .5px #e7efe3; background-color:white; width:180px; text-align:left">
			
				F. Entrega	: $requiredDate

			</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #e7efe3; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($block2, false, false, false, false, '');

// ---------------------------------------------------------


$block3 = <<<EOF

	<table style="font-size:8.5px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:210px; text-align:center">Articulo</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:200px; text-align:center">Proveedor</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">Check</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($block3, false, false, false, false, '');

foreach ($itemList as $key => $value){


$block4 = <<<EOF

	<table style="font-size:7.5px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:65px; text-align:center">
			$value[quantity]
			</td>

			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:210px; text-align:center">
			$value[product_name]	
			</td>

			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:200px; text-align:center">
			</td>
			

			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:65px; text-align:center">[ ] 
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($block4, false, false, false, false, '');

}



$block5 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/backFact2.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:7.5px; padding:5px 10px;">
	
		<tr>
		
			<td style=" border: doted .5px #e7efe3; background-color:white; width:270px; color:blue"><strong>
				Solicitado por: $detPurchaseorder[staff_name]</strong>
			</td>

			<td style=" border-bottom: doted .5px #e7efe3; background-color:white; width:270px; text-align:left"></td>
		</tr>
		<tr>
		
		<td style="border-bottom: 1px solid #e7efe3; background-color:white; width:270px"></td>
		<td style="border-bottom: 1px solid #e7efe3; background-color:white; width:270px; text-align:center"> 
		Firma
		</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($block5, false, false, false, false, '');

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('REQUISICION_'.$detPurchaseorder["order_type"].' No '.$_GET["reqId"].'.pdf' , 'I');

	}
}


$reqId = new printReq;
$reqId -> reqId = $_GET["reqId"];
$reqId -> printRequesting();


//============================================================+
// END OF FILE
//============================================================+

?>