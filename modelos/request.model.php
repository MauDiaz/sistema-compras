<?php
 
  require_once "connection.php";

  class requestModel {

    static public function mdlShowMaxRequestId($table_req,$item_req,$value_req){

        if ($item_req == null){

			$stmt = connection::getConnect()-> prepare("SELECT MAX($table_req.request_order_id)
                                                        FROM $table_req
                                                        ");
            $stmt->execute();
            return $stmt -> fetchALL(); 


        }else{

            $stmt = connection::getConnect()-> prepare("SELECT COUNT($table_req.request_order_id)
                                                        FROM $table_req
                                                        INNER JOIN purchases_order_type
                                                        ON $table_req.order_type_id = purchases_order_type.order_type_id
                                                        WHERE $item_req = :$item_req");
            
            $stmt -> bindParam(":".$item_req, $value_req, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetchALL();
        }

        $stmt -> close();
        $stmt = null; 
    }

  /*=============================================
	      INSERT REQUEST
	=============================================*/

	static public function mdlInsertRequest($table, $data){

		$stmt = connection::getConnect()->prepare("INSERT INTO $table (
																   request_order_number,
                                                                   request_order_status,
                                                                   request_order_required_date,
                                                                   branch_id,
                                                                   staff_id,
                                                                   order_type_id,
                                                                   department_id,
                                                                   quoter_id,
                                                                   approver_id) 
                                                                   VALUES (
																   :request_order_number,
                                                                   :request_order_status,
                                                                   :request_order_required_date,
                                                                   :branch_id,
                                                                   :staff_id,
                                                                   :order_type_id,
                                                                   :department_id,
                                                                   :quoter_id,
                                                               	   :approver_id)");

		$stmt->bindParam(":request_order_number", $data["request_order_number"], PDO::PARAM_STR);
		$stmt->bindParam(":request_order_status", $data["request_order_status"], PDO::PARAM_STR);
		$stmt->bindParam(":request_order_required_date", $data["request_order_required_date"], PDO::PARAM_STR);
		$stmt->bindParam(":branch_id", $data["branch_id"], PDO::PARAM_INT);
		$stmt->bindParam(":staff_id", $data["staff_id"], PDO::PARAM_INT);
		$stmt->bindParam(":order_type_id", $data["order_type_id"], PDO::PARAM_INT);
		$stmt->bindParam(":department_id", $data["department_id"], PDO::PARAM_INT);
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
		INSERTAR ITEMS DE REQUISICION
		=============================================*/

	static public function mdlInsertRequestItems($table,$data1,$data2,$data3){

		$stmt = Connection::getConnect()->prepare("INSERT INTO $table(request_order_id,product_id,quantity) 
												   VALUES (:request_order_id,:product_id,:quantity)");

		$stmt->bindParam(":request_order_id", $data1, PDO::PARAM_INT);
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
			MOSTRAR ORDENES DE REQUISICION POR ESTADO
		=============================================*/

		static public function mdlShowRequestStatus($table,$item,$value){

			if ($item == null){
	
	
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
	/*=============================================
			MOSTRAR ORDENES DE REQUISICION POR ESTADO PARA CADA COTIZADOR
		=============================================*/

		static public function mdlShowRequestStatus2($table,$item,$value,$item2,$value2){

			if ($item == null){
	
	
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
															WHERE  $table.$item2 = :$item2 AND $table.$item = :$item  
															GROUP BY $table.request_order_id
															ORDER BY $table.request_order_id DESC");
				
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt -> fetchAll(); 
			}
	
			$stmt -> close();
			$stmt = null;
		}
		/*=============================================
			MOSTRAR ORDENES DE REQUISICION POR ESTADO PARA CADA USUARIO
		=============================================*/

		static public function mdlShowRequestStatusStaff($table,$item,$value,$item2,$value2){

			if ($item == null){
	
	
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
															FROM $table
															INNER JOIN purchases_branches
															ON $table.branch_id = purchases_branches.branch_id
															INNER JOIN purchases_staffs
															ON $table.staff_id = purchases_staffs.staff_id
															INNER JOIN purchases_request_order_items
															ON purchases_request_order_items.request_order_id = $table.request_order_id 
															INNER JOIN purchases_branch_departments
															ON $table.department_id = purchases_branch_departments.department_id  
															WHERE  $table.$item2 = :$item2 AND $table.$item = :$item 
															GROUP BY $table.request_order_id
															ORDER BY $table.request_order_id  Desc");

				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt -> fetchAll();
			}
	
			$stmt -> close();
			$stmt = null;
		}

		/*=============================================
			CONSULTA CABECERA DE REQUISICION
		=============================================*/
		public static function mdlShowRequestingPlaced($reqTable, $reqItem,$reqValue){

			if ($reqItem == null){
	
	
			}else{
	
				$stmt = connection::getConnect()-> prepare("SELECT 
																$reqTable.request_order_number, 
																purchases_order_type.order_type,
																$reqTable.approver_id,
																$reqTable.staff_id,
																purchases_staffs.staff_name,
																purchases_staffs.staff_photo,
																$reqTable.branch_id,
																purchases_branches.branch_name,
																$reqTable.request_order_date,
																$reqTable.request_order_required_date,
																purchases_branch_departments.department_name
																FROM $reqTable
																INNER JOIN purchases_order_type
																ON $reqTable.order_type_id = purchases_order_type.order_type_id
																INNER JOIN purchases_staffs
																ON $reqTable.staff_id = purchases_staffs.staff_id
																INNER JOIN purchases_branches
																ON $reqTable.branch_id = purchases_branches.branch_id
																INNER JOIN purchases_branch_departments
																ON $reqTable.department_id = purchases_branch_departments.department_id
																WHERE $reqItem = :$reqItem");
				
				$stmt -> bindParam(":".$reqItem, $reqValue, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt -> fetch();
			}
	
			$stmt -> close();
			$stmt = null;
		}
		/*=============================================
			CONSULTA ARTICULOS DE REQUISICION
		=============================================*/
		public static function mdlShowRequestedItemList($tableList,$itemList,$valueList){

			if ($itemList == null){
	
	
			}else{

				$stmt = connection::getConnect()-> prepare("SELECT 
															$tableList.request_order_id,
															$tableList.product_id,
															$tableList.quantity,
															purchases_products.product_name
															FROM $tableList
															INNER JOIN purchases_products
															ON $tableList.product_id = purchases_products.product_id 
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
			MOSTRAR DEPARTAMENTO QUE REQUISITA
		=============================================*/
		
		public static function mdlShowDepartment($tableStaff,$itemStaff,$valueStaff){

			if ($itemStaff == null){
	
	
			}else{

				$stmt = connection::getConnect()-> prepare("SELECT 
															purchases_branch_departments.department_name
															FROM $tableStaff
															INNER JOIN purchases_branch_departments
															ON $tableStaff.department_id = purchases_branch_departments.department_id
															WHERE $itemStaff = :$itemStaff");
				
				$stmt -> bindParam(":".$itemStaff, $valueStaff, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt -> fetch();
			}
	
			$stmt -> close();
			$stmt = null;
		}

}
