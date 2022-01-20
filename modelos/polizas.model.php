<?php

  require_once "connection.php";

  class polizasModel {

  	/*=============================================
	MOSTRAR POLIZA
	=============================================*/


  	static public function mdlShowPoliza($table,$item,$value,$item1,$value1){


  		  if ($item == null){

			
        }else{

            $stmt = connection::getConnect()-> prepare("SELECT *
                                                        FROM $table
                                                        WHERE $item = :$item AND $item1 = :$item1");
            
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
            $stmt -> bindParam(":".$item1, $value1, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt -> fetch();
        }

        $stmt -> close();
        $stmt = null;
  	} 

  	/*=============================================
	INSERTAR POLIZA
	=============================================*/

	static public function mdlInsertPoliza($table, $data){

		$stmt = connection::getConnect()->prepare("INSERT INTO $table(quotation_order_id, quoter_id,cost_prev)
										    	 		  VALUES (:quotation_order_id, :quoter_id, :cost_prev)");

		$stmt->bindParam(":quotation_order_id", $data["quotation_order_id"], PDO::PARAM_INT);
		$stmt->bindParam(":quoter_id", $data["quoter_id"], PDO::PARAM_INT);
		$stmt->bindParam(":cost_prev", $data["cost_prev"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

		/*=============================================
	MOSTRAR POLIZAS
	=============================================*/


  	static public function mdlShowPolizas($table,$item,$value){


  		  if ($item == null){

  		  	$stmt = connection::getConnect()-> prepare("SELECT $table.poliza_id,$table.quotation_order_id,$table.quoter_id,$table.cost_prev,$table.cost_after,$table.date, purchases_staffs.staff_name
                                                        FROM $table
                                                        INNER JOIN purchases_staffs
                                                        ON $table.quoter_id = purchases_staffs.staff_id");
            
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt -> fetchAll();

			
        }else{


  		  	$stmt = connection::getConnect()-> prepare("SELECT $table.poliza_id,$table.quotation_order_id,$table.quoter_id,$table.cost_prev,$table.cost_after,$table.date, purchases_staffs.staff_name, purchases_staffs.staff_photo
                                                        FROM $table
                                                        INNER JOIN purchases_staffs
                                                        ON $table.quoter_id = purchases_staffs.staff_id
                                                        WHERE $table.$item = :$item");
            
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt -> fetch();


        }

        $stmt -> close();
        $stmt = null;
  	} 

/*=============================================
ACTUALIZAR BALANCE DE LA POLIZA DE EGRESO
=============================================*/

static public function mdlUpdatePoliza($table,$data,$data1,$data2,$data3,$data4,$data5){


		$stmt = connection::getConnect()-> prepare("UPDATE $table SET cost_prev = :cost_prev, cost_after = :cost_after, poliza_status = :poliza_status WHERE quotation_order_id = :quotation_order_id AND quoter_id = :quoter_id");

		$stmt -> bindParam(":cost_prev", $data3, PDO::PARAM_STR);
		$stmt -> bindParam(":cost_after", $data4, PDO::PARAM_STR);
		$stmt -> bindParam(":poliza_status", $data5, PDO::PARAM_INT);
		$stmt -> bindParam(":quotation_order_id", $data1, PDO::PARAM_INT);
		$stmt -> bindParam(":quoter_id", $data2, PDO::PARAM_INT);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

		/*=============================================
	MOSTRAR POLIZAS POR ESTADO
	=============================================*/


  	static public function mdlShowPolizasStatus($table,$item,$value){


  		  if ($item == null){

  		  	

			
        }else{


  		  	$stmt = connection::getConnect()-> prepare("SELECT $table.poliza_id,$table.quotation_order_id,$table.quoter_id,$table.cost_prev,$table.cost_after,$table.date, purchases_staffs.staff_name, purchases_staffs.staff_photo
                                                        FROM $table
                                                        INNER JOIN purchases_staffs
                                                        ON $table.quoter_id = purchases_staffs.staff_id
                                                        WHERE $table.$item = :$item
                                                        ORDER BY $table.poliza_id DESC");
            
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt -> fetchAll();


        }

        $stmt -> close();
        $stmt = null;
  	} 

    /*=============================================
  CHECAR POLIZAS SI HAN SIDO PAGADAS POR EL COTIZADOR
  =============================================*/


    static public function mdlCheckPoliza($table,$item,$value){


        if ($item != null){

            $stmt = connection::getConnect()-> prepare("SELECT $table.date, 
                                                        $table.quoter_id
                                                        FROM $table
                                                        WHERE $table.$item = :$item
                                                        ");
            
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt -> fetchAll();

          

      
        }else{


        


        }

        $stmt -> close();
        $stmt = null;
    } 



  }