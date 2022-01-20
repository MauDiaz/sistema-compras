<?php

require_once "connection.php";

 class InicioModel {


	/*========================= ====================
     Muestra el  numero de requisiciones abiertas
	=============================================*/

	static public function mdlInicioRequisiciones($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(request_order_id) 
            										   FROM  $table
            										   WHERE request_order_status = 1");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }


    /*========================= ====================
     Muestra el  numero de requisiciones cerradas
	=============================================*/

	static public function mdlInicioRequisicionesCerradas($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(request_order_id) 
            										   FROM  $table
            										   WHERE request_order_status = 3");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }



  /*========================= ====================
     Muestra el  numero de cotizaciones abiertas
	=============================================*/


		static public function mdlInicioCotizaciones($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(quotation_order_id) 
            										   FROM  $table
            										   WHERE quotation_order_status = 1");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }

     /*========================= ====================
     Muestra el  numero de cotizaciones cerradas
	=============================================*/


		static public function mdlInicioCotizacionesCerradas($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(quotation_order_id) 
            										   FROM  $table
            										   WHERE quotation_order_status = 2");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }


     /*========================= ====================
     Muestra el  numero de cotizaciones aprobadas
	=============================================*/


		static public function mdlInicioCotizacionesAprobadas($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(quotation_order_id) 
            										   FROM  $table
            										   WHERE quotation_order_status = 4");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }

       /*========================= ====================
     Muestra el  numero de cotizaciones aprobadas - Consignacion
	=============================================*/


		static public function mdlInicioCotizacionesAprobadasConsignacion($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(quotation_order_id) 
            										   FROM  $table
            										   WHERE quotation_order_status = 4
            										   AND payment_type_id = 3");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }

     /*========================= ====================
     Muestra el  numero de cotizaciones rechazadas
	=============================================*/


		static public function mdlInicioCotizacionesRechazadas($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(quotation_order_id) 
            										   FROM  $table
            										   WHERE quotation_order_status = 3");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }


      /*========================= ====================
     Muestra el  numero de ordenes de compra en consignacion
	=============================================*/


		static public function mdlInicioCotizacionesConsignacion($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(quotation_order_id) 
            										   FROM  $table
            										   WHERE quotation_order_status = 4
            										   AND payment_type_id = 3");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }

  /*========================= ====================
     Muestra el  numero de ordenes de compra en transferencia
	=============================================*/


		static public function mdlInicioCotizacionesTransferencia($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(quotation_order_id) 
            										   FROM  $table
            										   WHERE quotation_order_status = 4
            										   AND payment_type_id = 2");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }

      /*========================= ====================
     Muestra el  numero de ordenes de compra en efectivo
	=============================================*/


		static public function mdlInicioCotizacionesEfectivo($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(quotation_order_id) 
            										   FROM  $table
            										   WHERE quotation_order_status = 4
            										   AND payment_type_id = 1");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }


      /*========================= ====================
     Muestra el  numero de empresas
	=============================================*/


		static public function mdlInicioEmpresas($table,$item,$value){
        
		if($item != null){ 
            
            

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT COUNT(branch_id) 
            										   FROM  $table");
			$stmt -> execute();
			return $stmt -> fetch();
		}
		
		$stmt -> close();
		$stmt = null;
    }


    /*=============================================
			MOSTRAR ORDENES DE REQUISICION 
		=============================================*/

		static public function mdlShowRequest($table,$item,$value){

			if ($item == null){

				$stmt = connection::getConnect()-> prepare("SELECT $table.request_order_id,
																   $table.staff_id,			
																   $table.request_order_number,
																   $table.request_order_date,
																   $table.request_order_status,
																   purchases_branches.branch_name,
																   purchases_branch_departments.department_name,
																   purchases_staffs.staff_name,
																   SUM(purchases_request_order_items.quantity) AS quantity
															FROM $table
															INNER JOIN purchases_branches
															ON $table.branch_id = purchases_branches.branch_id
															INNER JOIN purchases_staffs
															ON $table.staff_id = purchases_staffs.staff_id
															INNER JOIN purchases_request_order_items
															ON purchases_request_order_items.request_order_id = $table.request_order_id 
															INNER JOIN purchases_branch_departments
															ON $table.department_id = purchases_branch_departments.department_id 
															GROUP BY $table.request_order_id
															ORDER BY $table.request_order_id DESC
															LIMIT 7");
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt -> fetchAll();
	
	
			}else{
	
				$stmt = connection::getConnect()-> prepare("SELECT $table.request_order_id,
																   $table.staff_id,			
																   $table.request_order_number,
																   $table.request_order_date,
																   $table.request_order_required_date,
																   purchases_branches.branch_name,
																   purchases_branch_departments.department_name,
																   purchases_staffs.staff_name,
																   SUM(purchases_request_order_items.quantity) AS quantity
																   -- SUM(purchases_request_order_items.quantity * purchases_request_order_items.price_list) AS costo
															FROM $table
															INNER JOIN purchases_branches
															ON $table.branch_id = purchases_branches.branch_id
															INNER JOIN purchases_staffs
															ON $table.staff_id = purchases_staffs.staff_id
															INNER JOIN purchases_request_order_items
															ON purchases_request_order_items.request_order_id = $table.request_order_id 
															INNER JOIN purchases_branch_departments
															ON $table.department_id = purchases_branch_departments.department_id 
															WHERE $item = :$item  GROUP BY $table.request_order_id
															ORDER BY $table.request_order_id DESC");
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt -> fetchAll();
			}
	
			$stmt -> close();
			$stmt = null;
		}


 }