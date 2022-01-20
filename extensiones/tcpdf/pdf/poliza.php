<?php

	 require_once "../../../controladores/quoting.controller.php";
	 require_once "../../../modelos/quoting.model.php";

  class printDoc {

    public $docId;

    public function printDocument(){

		$itemList = "quotation_order_id";
		$valueList = $this-> docId;
		$itemList = quotingController::ctrShowQuotedItemList($itemList,$valueList);
	
		$quotItem = "quotation_order_id";
		$quotValue = $this-> docId;
		$detPurchaseorder = quotingController::ctrShowQuotingPlaced($quotItem,$quotValue);


		$date = substr($detPurchaseorder["request_order_date"],0,-8);
		$requiredDate = $detPurchaseorder["request_order_required_date"];

		date_default_timezone_set('America/Mexico_City');

		$fechaActual = date('Y-m-d');


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
            <td style="background-color:white; width:115px; text-align:center; color:red"><br><br>Poliza No.<br>$detPurchaseorder[quotation_order_id]</td>
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
		
			<td style="border: doted .5px #e7efe3; background-color:white; width:180px">Poliza de Egreso</td>

			<td style="border: none; background-color:white; width:180px"></td>

			<td style="border: doted .5px #e7efe3; background-color:white; width:180px">Fecha: $fechaActual</td>
			
			
		</tr>

		<tr>
			
			<td style="width:540px"><img src="images/backFact2.jpg"></td>
		
		</tr>

		<tr style="">
		
			<td style="border: doted .5px #e7efe3; background-color:white; width:540px; height: 200px">Insertar copia del cheque o comprobante de transferencia</td>

			<td style="border: none; background-color:white; width:360px"></td>
			
			
		</tr>


		<tr>
			
			<td style="width:540px"><img src="images/backFact2.jpg"></td>
		
		</tr>

		<tr style="">
		
			<td style="border: doted .5px #e7efe3; background-color:white; width:340px; height: 100px">Concepto de Pago: Compra de insumos para el departamento $detPurchaseorder[department_name] de la empresa $detPurchaseorder[branch_name] requeridos por $detPurchaseorder[staff_name] el dia $date</td>

			<td style="border: none; border-right: doted .5px #e7efe3;  background-color:white; width:20px"></td>

			<td style="border: doted .5px #e7efe3; background-color:white; width:180px; height: 100px ">Firma cheque recibido:</td>
			
			
		</tr>

		<tr>
			
			<td style="width:540px"><img src="images/backFact2.jpg"></td>
		
		</tr>
		

	</table>

EOF;

$pdf->writeHTML($block2, false, false, false, false, '');

// ---------------------------------------------------------


$block3 = <<<EOF

	<table style="font-size:8.5px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #d7efe3; background-color:white; width:90px; text-align:center">Cuenta</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:90px; text-align:center">Subcuenta</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:165px; text-align:center">Nombre(Cuenta)</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">Parcial</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">Debe</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">Haber</td>
	
		</tr>

	</table>

EOF;

$pdf->writeHTML($block3, false, false, false, false, '');

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


$block4 = <<<EOF

	<table style="font-size:7.5px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #d7efe3; background-color:white; width:90px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:90px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:165px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">$ $gTotal</td>
	
		</tr>

		<tr>
		
		<td style="border: 1px solid #d7efe3; background-color:white; width:90px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:90px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:165px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center"></td>
	
		</tr>

	</table>


EOF;

$pdf->writeHTML($block4, false, false, false, false, '');

$block5 = <<<EOF


	<table style="font-size:7.5px; padding:5px 10px;">

	<tr>
		
		<td style="border: none; background-color:white; width:90px; text-align:center"></td>
		<td style="border: none; background-color:white; width:90px; text-align:center"></td>
		<td style="border: none; background-color:white; width:165px; text-align:center"></td>
		<td style="border: none; background-color:white; width:65px; text-align:center">Total</td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center"></td>
		<td style="border: 1px solid #d7efe3; background-color:white; width:65px; text-align:center">$ $gTotal</td>
	
		</tr>	


	</table>

EOF;

$pdf->writeHTML($block5, false, false, false, false, '');

$block6 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/backFact2.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:7.5px; padding:5px 10px;">
	
		<tr>
		
			<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; height: 1px; color:blue"><strong>
				Hecho por:</strong>
			</td>
			<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; color:blue"><strong>
				Revisado:</strong>
			</td>
			<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; color:blue"><strong>
				Autorizado:</strong>
			</td>
			<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; color:blue"><strong>
				Auxiliares:</strong>
			</td>
			<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; color:blue"><strong>
				Diario:</strong>
			</td>
			<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; color:blue"><strong>
				Poliza No:</strong>
			</td>

		</tr>
		<tr>
		
		<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; height:50px">
			</td>
		<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; height:50px">
			</td>
		<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; height:50px">
			</td>
		<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; height:50px">
			</td>
		<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; height:50px">
			</td>
		<td style=" border: doted .5px #e7efe3; background-color:white; width:90px; height:50px">
			</td>
		

		</tr>

	</table>

EOF;

$pdf->writeHTML($block6, false, false, false, false, '');

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('POLIZA_'.$detPurchaseorder["order_type"].' No '.$_GET["docId"].'.pdf' , 'I');

	}
}

if (isset($_GET["docId"])){

$docId = new printDoc;
$docId -> docId = $_GET["docId"];
$docId -> printDocument();

}
//============================================================+
// END OF FILE
//============================================================+

?>