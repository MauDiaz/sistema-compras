<?php

 class InicioController{

	/*========================= ====================
     Muestra el  numero de requisiciones abiertas
	=============================================*/

 	static public function ctrInicioRequisiciones($item,$value){

 	$table = "purchases_request_order";

 	$answer =  InicioModel::mdlInicioRequisiciones($table,$item,$value);

 	return $answer;

  }
  /*========================= ====================
     Muestra el  numero de requisiciones cerradas
  =============================================*/

  static public function ctrInicioRequisicionesCerradas($item,$value){

  $table = "purchases_request_order";

  $answer =  InicioModel::mdlInicioRequisicionesCerradas($table,$item,$value);

  return $answer;

  }


  /*========================= ====================
     Muestra el  numero de cotizaciones abiertas
	=============================================*/

  static public function ctrInicioCotizaciones($item,$value){


  	$table = "purchases_quotation_order";

  	$answer =  InicioModel::mdlInicioCotizaciones($table,$item,$value);

  	return $answer;
  }

   /*========================= ====================
     Muestra el  numero de cotizaciones abiertas
  =============================================*/

  static public function ctrInicioCotizacionesCerradas($item,$value){


    $table = "purchases_quotation_order";

    $answer =  InicioModel::mdlInicioCotizacionesCerradas($table,$item,$value);

    return $answer;
  }

  /*========================= ====================
     Muestra el  numero de cotizaciones aprobadas
	=============================================*/

  static public function ctrInicioCotizacionesAprobadas($item,$value){


  	$table = "purchases_quotation_order";

  	$answer =  InicioModel::mdlInicioCotizacionesAprobadas($table,$item,$value);

  	return $answer;
  }

   /*========================= ====================
     Muestra el  numero de cotizaciones consignacion
  =============================================*/

  static public function ctrInicioCotizacionesAprobadasConsignacion($item,$value){


    $table = "purchases_quotation_order";

    $answer =  InicioModel::mdlInicioCotizacionesAprobadasConsignacion($table,$item,$value);

    return $answer;
  }

    /*========================= ====================
     Muestra el  numero de cotizaciones rechazadas
	=============================================*/

  static public function ctrInicioCotizacionesRechazadas($item,$value){


  	$table = "purchases_quotation_order";

  	$answer =  InicioModel::mdlInicioCotizacionesRechazadas($table,$item,$value);

  	return $answer;
  }

   /*========================= ====================
     Muestra el  numero de orden de compra en consignacion
	=============================================*/

  static public function ctrInicioCotizacionesConsignacion($item,$value){


  	$table = "purchases_quotation_order";

  	$answer =  InicioModel::mdlInicioCotizacionesConsignacion($table,$item,$value);

  	return $answer;
  }
   /*========================= ====================
     Muestra el  numero de orden de compra en Transferencia
	=============================================*/

  static public function ctrInicioCotizacionesTransferencia($item,$value){


  	$table = "purchases_quotation_order";

  	$answer =  InicioModel::mdlInicioCotizacionesTransferencia($table,$item,$value);

  	return $answer;
  }

  /*========================= ====================
     Muestra el  numero de orden de compra en Efectivo
	=============================================*/

  static public function ctrInicioCotizacionesEfectivo($item,$value){


  	$table = "purchases_quotation_order";

  	$answer =  InicioModel::mdlInicioCotizacionesEfectivo($table,$item,$value);

  	return $answer;
  }

   /*========================= ====================
     Muestra el  numero de empresas
	=============================================*/

  static public function ctrInicioEmpresas($item,$value){


  	$table = "purchases_branches";

  	$answer =  InicioModel::mdlInicioEmpresas($table,$item,$value);

  	return $answer;
  }

   static public function ctrShowRequest($item,$value){   

          $table = "purchases_request_order";
          $answer = InicioModel::mdlShowRequest($table,$item,$value);
          return $answer;
     } 


 }