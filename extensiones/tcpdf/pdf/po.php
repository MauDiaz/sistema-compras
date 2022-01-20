<?php

	 require_once "../../../controladores/approvals.controller.php";
	 require_once "../../../modelos/approvals.model.php";
	 require_once "../../../controladores/request.controller.php";
	 require_once "../../../modelos/request.model.php";

  class printPO {

    public $orderId;
    
    public function printPurchaseOrder(){

		$itemList = "request_order_id";
		$valueList = $this->orderId;
		$itemList = requestController::ctrShowRequestedItemList($itemList,$valueList);
		
		$reqItem = "request_order_id";
		$reqValue = $this->orderId;
		$detPurchaseorder = requestController::ctrShowOrderPlaced($reqItem,$reqValue);

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
            <td style="background-color:white; width:115px; text-align:center; color:red"><br><br>Compra No.<br>$detPurchaseorder[request_order_number]</td>
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

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style=" border: doted .5px #e7efe3; background-color:white; width:180px; color:blue">
				Requisicion tipo: $detPurchaseorder[order_type]
			</td>

			<td style=" border: doted .5px #e7efe3; background-color:white; width:180px; text-align:left">
			
				Fecha Captura: $date

			</td>

			<td style=" border: doted .5px #e7efe3; background-color:white; width:180px; text-align:left">
			
				Fecha Limite: $requiredDate

			</td>

		</tr>

		<tr>
		
			<td style="border: doted .5px #e7efe3; background-color:white; width:270px">Solicitado por: $detPurchaseorder[staff_name]</td>
			<td style="border: doted .5px #e7efe3; background-color:white; width:270px">Departamento: Bares</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #e7efe3; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($block2, false, false, false, false, '');

// ---------------------------------------------------------


$block3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #d7efe3; background-color:white; width:210px; text-align:center">Articulo</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:135px; text-align:center">Proveedor</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">Precio U.</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">C. Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($block3, false, false, false, false, '');

foreach ($itemList as $key => $value){

$total = number_format(($value["quantity"] * $value["price_list"]), 2);
$priceList = number_format(($value["price_list"]),2);
$block4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:210px; text-align:center">
			$value[product_name]	
			</td>

			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:135px; text-align:center">
			$value[supplier_name]	
			</td>
			
			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:65px; text-align:center">
			$value[quantity]
			</td>

			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:65px; text-align:center">$ 
			$priceList	
			</td>

			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:65px; text-align:center">$ 
			$total
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($block4, false, false, false, false, '');

}

$netTotal = 0;
$tax = 0;
$grandTotal = 0;


foreach ($itemList as $key => $value){

	$total = $value["quantity"] * $value["price_list"];

		$grandTotal +=$total;
	}

	$tax = number_format(($grandTotal * 0.16), 2);
	$netTotal = number_format(($grandTotal - $tax), 2);
	$gTotal = number_format(($grandTotal),2);
$block5 = <<<EOF


	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:345px; text-align:center"></td>

			<td style="border-bottom: 1px solid #d7efe3; background-color:white; width:97.5px; text-align:center"></td>

			<td style="border-bottom: 1px solid #d7efe3; color:#333; background-color:white; width:97.5px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #d7efe3; color:#333; background-color:white; width:345px; text-align:center"></td>

			<td style="border: 1px solid #d7efe3;  background-color:white; width:97.5px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:97.5px; text-align:center">
				$ $netTotal
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #d7efe3; color:#333; background-color:white; width:345px; text-align:center"></td>

			<td style="border: 1px solid #d7efe3; background-color:white; width:97.5px; text-align:center">
				Impuesto:
			</td>
				
			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:97.5px; text-align:center">
				$ $tax
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #d7efe3; color:#333; background-color:white; width:345px; text-align:center"></td>

			<td style="border: 1px solid #d7efe3; background-color:white; width:97.5px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #d7efe3; color:#333; background-color:white; width:97.5px; text-align:center">
				$ $gTotal
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($block5, false, false, false, false, '');

$block6 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/backFact1.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style=" border: doted .5px #e7efe3; background-color:white; width:270px; color:blue"><strong>
				Autorizado por: $detPurchaseorder[staff_name]</strong>
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

$pdf->writeHTML($block6, false, false, false, false, '');

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('PURCHASE ORDER_'.$detPurchaseorder["order_type"].' No '.$_GET["orderId"].'.pdf' , 'I');

	}
}


$orderId = new printPO;
$orderId -> orderId = $_GET["orderId"];
$orderId -> printPurchaseOrder();


//============================================================+
// END OF FILE
//============================================================+

?>