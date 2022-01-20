<?php

require_once "connection.php";

  class approvalsModel {

            static public function mdlUpdateRequestStatus($table,$item,$item2,$value,$value2){

            $stmt=Connection::getConnect() -> prepare("UPDATE $table 
                                                        SET $item2 = :$item2 
                                                        WHERE $item = :$item");

            $stmt-> bindparam(":".$item2, $value2, PDO::PARAM_STR);
            $stmt-> bindparam(":".$item, $value, PDO::PARAM_STR);
            

            if($stmt -> execute()){

                return "ok";
            }

            else{

                return "error";

                }

                $stmt -> close();
                $stmt = null;
        }

        static public function mdlShowMaxApprovalId($table_req,$item_req,$value_req){

        if ($item_req == null){

			$stmt = connection::getConnect()-> prepare("SELECT MAX($table_req.purchase_order_id)
                                                        FROM $table_req
                                                        ");
            $stmt->execute();
            return $stmt -> fetchALL();


        }else{

            $stmt = connection::getConnect()-> prepare("SELECT COUNT($table_req.purchase_order_id)
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

	static public function mdlInsertApproval($table, $data){


		$stmt = connection::getConnect()->prepare("INSERT INTO $table (
																   purchase_order_no,
                                                                   purchase_order_status,
                                                                   purchase_required_order_date,
                                                                   request_order_id,
                                                                   order_type_id) 
                                                                   VALUES (
																   :purchase_order_no,
                                                                   :purchase_order_status,
                                                                   :purchase_required_order_date,
                                                                   :request_order_id,
                                                                   :order_type_id)");

		$stmt->bindParam(":purchase_order_no", $data["purchase_order_no"], PDO::PARAM_INT);
		$stmt->bindParam(":purchase_order_status", $data["purchase_order_status"], PDO::PARAM_INT);
		$stmt->bindParam(":purchase_required_order_date", $data["purchase_required_order_date"], PDO::PARAM_STR);
		$stmt->bindParam(":request_order_id", $data["request_order_id"], PDO::PARAM_INT);
		$stmt->bindParam(":order_type_id", $data["order_type_id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

  }

  
  		/*=============================================
		INSERTAR ITEMS A LA ORDEN DE COMPRA
		=============================================*/

	static public function mdlInsertApprovalItems($table,$data1,$data2,$data3,$data4,$data5){

		$stmt = Connection::getConnect()->prepare("INSERT INTO $table(purchase_order_id,product_id,supplier_id,quantity,price_list) 
												   VALUES (:purchase_order_id,:product_id,:supplier_id,:quantity,:price_list)");

		$stmt->bindParam(":purchase_order_id", $data1, PDO::PARAM_INT);
		$stmt->bindParam(":product_id", $data2, PDO::PARAM_INT);
		$stmt->bindParam(":supplier_id", $data3, PDO::PARAM_INT);
		$stmt->bindParam(":quantity", $data4, PDO::PARAM_INT);
		$stmt->bindParam(":price_list", $data5, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

}