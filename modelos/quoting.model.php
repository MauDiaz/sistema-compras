<?php
 
  require_once "connection.php";

  class quotingModel {

	static public function mdlShowMaxQuotationId($table_quot,$item_quot,$value_quot){

        if ($item_quot == null){

			$stmt = connection::getConnect()-> prepare("SELECT MAX($table_quot.quotation_order_id)
                                                        FROM $table_quot
                                                        ");
            $stmt->execute();
            return $stmt -> fetchALL();


        }else{

            // $stmt = connection::getConnect()-> prepare("");
            
            // $stmt -> bindParam(":".$item_req, $value_req, PDO::PARAM_STR);
            // $stmt->execute();
            // return $stmt -> fetchALL();
        }

        $stmt -> close();
        $stmt = null; 
    }

  	 /*=============================================
	      INSERT QUOTATION HEADER
	=============================================*/

	static public function mdlInsertQuotation($table, $data){

		$stmt = connection::getConnect()->prepare("INSERT INTO $table (
																   request_order_id,
                                                                   supplier_id,
                                                                   payment_type_id,
                                                                   quoter_id,
                                                                   approver_id) 
                                                                   VALUES (
																   :request_order_id,
                                                                   :supplier_id,
                                                               	   :payment_type_id,
                                                               	   :quoter_id,
                                                               	   :approver_id)");

		$stmt->bindParam(":request_order_id", $data["request_order_id"], PDO::PARAM_INT);
		$stmt->bindParam(":supplier_id", $data["supplier_id"], PDO::PARAM_INT);
		$stmt->bindParam(":payment_type_id", $data["payment_type_id"], PDO::PARAM_INT);
		$stmt->bindParam(":quoter_id", $data["quoter_id"], PDO::PARAM_INT);
		$stmt->bindParam(":approver_id", $data["approver_id"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

  }

	/*=============================================
		INSERTAR ITEMS DE COTIZACION
		=============================================*/

	static public function mdlInsertQuotationItems($table,$data1,$data2,$data3){

		$stmt = Connection::getConnect()->prepare("INSERT INTO $table(quotation_order_id,product_id,quantity) 
												   VALUES (:quotation_order_id,:product_id,:quantity)");

		$stmt->bindParam(":quotation_order_id", $data1, PDO::PARAM_INT);
		$stmt->bindParam(":product_id", $data2, PDO::PARAM_INT);
		$stmt->bindParam(":quantity", $data3, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
/*=============================================
	MOSTRAR ORDENES DE COTIZACION POR ESTADO
=============================================*/

		static public function mdlShowQuotationStatus($table,$item,$value){ 	 

			if ($item == null){
	
	
			}else{
	
				$stmt = connection::getConnect()-> prepare("SELECT $table.quotation_order_id,
																   $table.request_order_id,
																   $table.quoter_id,
																   purchases_request_order.request_order_date,
																   purchases_request_order.request_order_required_date,
																   purchases_suppliers.supplier_name,
																   purchases_branches.branch_name,
																   purchases_staffs.staff_name,
																   purchases_branch_departments.department_name,
																   SUM(purchases_quotation_order_items.quantity) AS quantity,
																   SUM(purchases_quotation_order_items.quantity * purchases_quotation_order_items.price_list) AS costo
															FROM $table
															INNER JOIN purchases_request_order
															ON $table.request_order_id  = purchases_request_order.request_order_id
															INNER JOIN purchases_suppliers
															ON $table.supplier_id  = purchases_suppliers.supplier_id
															INNER JOIN purchases_branch_departments
															ON purchases_request_order.department_id = purchases_branch_departments.department_id
															INNER JOIN purchases_branches
															ON purchases_request_order.branch_id = purchases_branches.branch_id
															INNER JOIN purchases_staffs
															ON purchases_request_order.staff_id = purchases_staffs.staff_id
															INNER JOIN purchases_quotation_order_items
															ON purchases_quotation_order_items.quotation_order_id = $table.quotation_order_id  
															WHERE $item = :$item  GROUP BY $table.quotation_order_id
															ORDER BY $table.quotation_order_id DESC"); 
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt -> fetchAll();
			}
	
			$stmt -> close();
			$stmt = null;
		}

		/*=============================================
	MOSTRAR ORDENES DE COTIZACION POR ESTADO POR ROL DE APROBACION
=============================================*/

		static public function mdlShowQuotationStatusRole($table,$item,$value,$item1,$value1){ 	 

			if ($item == null){
	
	
			}else{
	
				$stmt = connection::getConnect()-> prepare("SELECT $table.quotation_order_id,
																   $table.request_order_id,
																   purchases_request_order.request_order_date,
																   purchases_request_order.request_order_required_date,
																   purchases_suppliers.supplier_name,
																   purchases_branches.branch_name,
																   purchases_staffs.staff_name,
																   purchases_branch_departments.department_name,
																   SUM(purchases_quotation_order_items.quantity) AS quantity,
																   SUM(purchases_quotation_order_items.quantity * purchases_quotation_order_items.price_list) AS costo
															FROM $table
															INNER JOIN purchases_request_order
															ON $table.request_order_id  = purchases_request_order.request_order_id
															INNER JOIN purchases_suppliers
															ON $table.supplier_id  = purchases_suppliers.supplier_id
															INNER JOIN purchases_branch_departments
															ON purchases_request_order.department_id = purchases_branch_departments.department_id
															INNER JOIN purchases_branches
															ON purchases_request_order.branch_id = purchases_branches.branch_id
															INNER JOIN purchases_staffs
															ON purchases_request_order.staff_id = purchases_staffs.staff_id
															INNER JOIN purchases_quotation_order_items
															ON purchases_quotation_order_items.quotation_order_id = $table.quotation_order_id  
															WHERE $table.$item1 = :$item1 AND $table.$item = :$item GROUP BY $table.quotation_order_id
															ORDER BY $table.quotation_order_id DESC");
				
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
				$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt -> fetchAll();
			}
	
			$stmt -> close();
			$stmt = null;
		}

		/*=============================================
	MOSTRAR ORDENES DE COTIZACION POR ESTADO POR CONSIGNACION
=============================================*/

		static public function mdlShowQuotationStatusConsig($table,$item,$value,$item1,$value1){

			if ($item == null){
	
	
			}else{
	
				$stmt = connection::getConnect()-> prepare("SELECT $table.quotation_order_id,
																   $table.request_order_id,
																   purchases_request_order.request_order_date,
																   purchases_request_order.request_order_required_date,
																   purchases_suppliers.supplier_name,
																   purchases_branches.branch_name,
																   purchases_staffs.staff_name,
																   purchases_branch_departments.department_name,
																   SUM(purchases_quotation_order_items.quantity) AS quantity,
																   SUM(purchases_quotation_order_items.quantity * purchases_quotation_order_items.price_list) AS costo
															FROM $table
															INNER JOIN purchases_request_order
															ON $table.request_order_id  = purchases_request_order.request_order_id
															INNER JOIN purchases_suppliers
															ON $table.supplier_id  = purchases_suppliers.supplier_id
															INNER JOIN purchases_branch_departments
															ON purchases_request_order.department_id = purchases_branch_departments.department_id
															INNER JOIN purchases_branches
															ON purchases_request_order.branch_id = purchases_branches.branch_id
															INNER JOIN purchases_staffs
															ON purchases_request_order.staff_id = purchases_staffs.staff_id
															INNER JOIN purchases_quotation_order_items
															ON purchases_quotation_order_items.quotation_order_id = $table.quotation_order_id  
															WHERE $item = :$item AND $item1 = :$item1 GROUP BY $table.quotation_order_id
															ORDER BY $table.quotation_order_id DESC");
				
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
				$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt -> fetchAll();
			}
	
			$stmt -> close();
			$stmt = null;
		}

			/*=============================================
	MOSTRAR ORDENES DE COTIZACION POR ESTADO POR CONSIGNACION POR CADA COTIZADOR
=============================================*/

		static public function mdlShowQuotationStatusConsig2($table,$item,$value,$item1,$value1,$item2,$value2){

			if ($item == null){
	
	
			}else{
	
				$stmt = connection::getConnect()-> prepare("SELECT $table.quotation_order_id,
																   $table.request_order_id,
																   purchases_request_order.request_order_date,
																   purchases_request_order.request_order_required_date,
																   purchases_suppliers.supplier_name,
																   purchases_branches.branch_name,
																   purchases_staffs.staff_name,
																   purchases_branch_departments.department_name,
																   SUM(purchases_quotation_order_items.quantity) AS quantity,
																   SUM(purchases_quotation_order_items.quantity * purchases_quotation_order_items.price_list) AS costo
															FROM $table
															INNER JOIN purchases_request_order
															ON $table.request_order_id  = purchases_request_order.request_order_id
															INNER JOIN purchases_suppliers
															ON $table.supplier_id  = purchases_suppliers.supplier_id
															INNER JOIN purchases_branch_departments
															ON purchases_request_order.department_id = purchases_branch_departments.department_id
															INNER JOIN purchases_branches
															ON purchases_request_order.branch_id = purchases_branches.branch_id
															INNER JOIN purchases_staffs
															ON purchases_request_order.staff_id = purchases_staffs.staff_id
															INNER JOIN purchases_quotation_order_items
															ON purchases_quotation_order_items.quotation_order_id = $table.quotation_order_id  
															WHERE $table.$item = :$item AND $table.$item1 = :$item1 AND $table.$item2 = :$item2
															GROUP BY $table.quotation_order_id
															ORDER BY $table.quotation_order_id DESC");
				
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
				$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_INT);
				$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt -> fetchAll();
			}
	
			$stmt -> close();
			$stmt = null;
		}
/*=============================================
	MOSTRAR ORDENES DE COTIZACION POR ID
=============================================*/

		static public function mdlShowQuotation($table,$item,$value){

			if ($item == null){
	
	
			}else{
	
				$stmt = connection::getConnect()-> prepare("SELECT $table.quotation_order_id,
																   $table.request_order_id,
																   purchases_payment_type.payment_type_name,
																   purchases_request_order.request_order_date,
																   purchases_request_order.request_order_required_date,
																   purchases_suppliers.supplier_name,
																   purchases_suppliers.supplier_address,
																   purchases_suppliers.supplier_pn,
																   purchases_suppliers.supplier_email,
																   purchases_branches.branch_name,
																   purchases_staffs.staff_name,
																   purchases_staffs.staff_photo,
																   purchases_branch_departments.department_name,
																   purchases_order_type.order_type
															FROM $table
															INNER JOIN purchases_request_order
															ON $table.request_order_id  = purchases_request_order.request_order_id
															INNER JOIN purchases_suppliers
															ON $table.supplier_id  = purchases_suppliers.supplier_id
															INNER JOIN purchases_branch_departments
															ON purchases_request_order.department_id = purchases_branch_departments.department_id
															INNER JOIN purchases_branches
															ON purchases_request_order.branch_id = purchases_branches.branch_id
															INNER JOIN purchases_staffs
															ON purchases_request_order.staff_id = purchases_staffs.staff_id
															INNER JOIN purchases_order_type
															ON purchases_request_order.order_type_id = purchases_order_type.order_type_id
															INNER JOIN purchases_payment_type
															ON $table.payment_type_id = purchases_payment_type.payment_type_id
															WHERE $item = :$item  GROUP BY $table.quotation_order_id
															ORDER BY $table.quotation_order_id DESC");
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt -> fetch();
			}
	
			$stmt -> close();
			$stmt = null;
		}

		/*=============================================
			CONSULTA ARTICULOS DE COTIZACION
		=============================================*/
		public static function mdlShowQuotedItemList($tableList,$itemList,$valueList){

			if ($itemList == null){
	
	
			}else{

				$stmt = connection::getConnect()-> prepare("SELECT 
															$tableList.quotation_order_id,
															$tableList.product_id,
															purchases_products.product_name,
															purchases_products.enlace,
															purchases_munit.meassure_unit_name,
															$tableList.quantity,
															$tableList.price_list
															FROM $tableList
															INNER JOIN purchases_products
															ON $tableList.product_id = purchases_products.product_id 
															INNER JOIN purchases_munit
															ON purchases_products.meassure_unit_id = purchases_munit.meassure_unit_id 
															WHERE $itemList = :$itemList
															GROUP BY purchases_products.product_name");
				
				$stmt -> bindParam(":".$itemList, $valueList, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt -> fetchAll(); 
			}
	
			$stmt -> close();
			$stmt = null;
		}
/*=============================================
ACTUALIZAR PRECIOS Y NUMERO ARTICULOS PARA CERRAR COTIZACION
=============================================*/

static public function mdlUpdateQuotationItems($table,$data1,$data2,$data3,$data4){


		$stmt = connection::getConnect()-> prepare("UPDATE $table SET quantity = :quantity, price_list = :price_list WHERE quotation_order_id = :quotation_order_id AND product_id = :product_id");

		$stmt -> bindParam(":quantity", $data3, PDO::PARAM_INT);
		$stmt -> bindParam(":price_list", $data4, PDO::PARAM_STR); 
		$stmt -> bindParam(":quotation_order_id", $data1, PDO::PARAM_INT);
		$stmt -> bindParam(":product_id", $data2, PDO::PARAM_INT);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
ACTUALIZAR ESTADO DE COTIZACION A CERRRADA
=============================================*/

static public function mdlUpdateQuotationStatus($table, $item1, $value1, $item2, $value2){

		$stmt = connection::getConnect()-> prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_INT);
		$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok"; 
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
ACTUALIZAR TIPO DEPAGO DE CONSIGNACION A TRANSFERENCIA O EFECTIVO
=============================================*/

static public function mdlUpdateQuotationConsig($table, $item1, $value1, $item2, $value2){

		$stmt = connection::getConnect()-> prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_INT);
		$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok"; 
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


/*=============================================
ELIMINAR ARTICULOS ANTES DE CERRAR COTIZACION
=============================================*/

static public function mdlDeleteQuotationItems($table,$data1,$data2){


		$stmt = connection::getConnect()-> prepare("DELETE FROM $table WHERE quotation_order_id = :quotation_order_id AND product_id = :product_id");

		$stmt -> bindParam(":quotation_order_id", $data1, PDO::PARAM_INT);
		$stmt -> bindParam(":product_id", $data2, PDO::PARAM_INT);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlShowPaymentType($table,$item,$value){

        if ($item == null){

			$stmt = connection::getConnect()-> prepare("SELECT *
                                                        FROM $table
                                                        ");
            $stmt->execute();
            return $stmt -> fetchALL();


        }else{

        	// SOMETHING ELSE

        }

        $stmt -> close();
        $stmt = null; 
    }


    	/*=============================================
			CONSULTA CABECERA DE COTIZACION
		=============================================*/
		public static function mdlShowQuotingPlaced($quotTable, $quotItem,$quotValue){

			if ($quotItem == null){
	
	
			}else{
	
				$stmt = connection::getConnect()-> prepare("SELECT 

																$quotTable.quotation_order_id,
																$quotTable.quoter_id,
																purchases_request_order.request_order_date,
																purchases_request_order.request_order_required_date,
																purchases_staffs.staff_name,
																purchases_branches.branch_name,
																purchases_branch_departments.department_name,
																purchases_order_type.order_type,
																purchases_suppliers.supplier_name
																
																FROM $quotTable
																INNER JOIN purchases_request_order
																ON $quotTable.request_order_id = purchases_request_order.request_order_id
																INNER JOIN purchases_staffs
																ON purchases_request_order.staff_id = purchases_staffs.staff_id 
																INNER JOIN purchases_branches
																ON purchases_request_order.branch_id = purchases_branches.branch_id
																INNER JOIN purchases_branch_departments
																ON purchases_request_order.department_id = purchases_branch_departments.department_id
																INNER JOIN purchases_order_type
																ON purchases_request_order.order_type_id = purchases_order_type.order_type_id
																INNER JOIN purchases_suppliers
																ON $quotTable.supplier_id =
																purchases_suppliers.supplier_id
																WHERE $quotItem = :$quotItem");
				
				$stmt -> bindParam(":".$quotItem, $quotValue, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt -> fetch();
			}
	
			$stmt -> close();
			$stmt = null;
		}

/*=============================================
	MOSTRAR EMAIL DEL PROVEEDOR Y DEL COTIZADOR PARA ENVIAR EMAIL
=============================================*/

		static public function mdlEmailQuotation($table,$item,$value){

			if ($item == null){
	
	
			}else{
	
				$stmt = connection::getConnect()-> prepare("SELECT 
																   purchases_suppliers.supplier_name,
																   purchases_suppliers.supplier_email

															FROM $table
															INNER JOIN purchases_suppliers
															ON $table.supplier_id  = purchases_suppliers.supplier_id
															WHERE $item = :$item");
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt -> fetch();
			}
	
			$stmt -> close();
			$stmt = null;
		}




  }