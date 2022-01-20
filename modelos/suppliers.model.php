<?php

require_once "connection.php";

class supplierModels{

/*========================= ====================
	    SHOW JOB POSITION GENERAL DATA FROM DEPARMENT-STAFF TABLE
	=============================================*/

	static public function mdlShowSupplier($table, $item, $value){
        
		if($item != null){
            
            $stmt = connection::getConnect()->prepare("SELECT * 
                                                        FROM $table 
                                                        WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{
            $stmt = connection::getConnect()->prepare("SELECT * FROM $table");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;
    }

    /*========================= ====================
	   CREATE SUPPLIERS
	=============================================*/

	static public function mdlCreateSupplier($table,$data){

		

		$stmt = Connection::getConnect()->prepare("INSERT INTO $table
												(supplier_name,supplier_pn,supplier_email,supplier_address,supplier_status)
												VALUES (:supplier_name,:supplier_pn,:supplier_email,:supplier_address,:supplier_status)");
		
		$stmt->bindParam(":supplier_name", $data["supplier_name"], PDO::PARAM_STR);
		$stmt->bindParam(":supplier_pn", $data["supplier_pn"], PDO::PARAM_STR);
		$stmt->bindParam(":supplier_email", $data["supplier_email"], PDO::PARAM_STR);
		$stmt->bindParam(":supplier_address", $data["supplier_address"], PDO::PARAM_STR);
		$stmt->bindParam(":supplier_status", $data["supplier_status"], PDO::PARAM_INT);

		if($stmt->execute()){
  
			return "ok";
		  
		  }else{
		  
			return "error";
		  
		  }
		  
		  $stmt->close();
		  $stmt = null;
	
	}

    /*========================= ====================
	   REMOVE SUPPLIERS
	=============================================*/

	static public function mdlRemoveSupplier($table,$item,$value){

		$stmt = Connection::getConnect()->prepare("DELETE FROM $table WHERE $item = :$item");


		$stmt -> bindParam(":".$item,$value,PDO::PARAM_STR);
		
		if($stmt -> execute()){
	  
			return "ok";
		  
		  }else{
	  
			return "error";	
	  
		  }
	  
		  $stmt -> close();
	  
		  $stmt = null;
	}
}

