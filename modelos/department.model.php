<?php

require_once "connection.php";

class departmentModels{

/*========================= ====================
	    SHOW DEPARTMENT GENERAL DATA FROM DEPARMENT-STAFF TABLE
	=============================================*/

	static public function mdlShowdepartment($table, $itemdep, $valuedep){
        
		if($itemdep != null){
            
            $stmt = connection::getConnect()->prepare("SELECT * 
                                                        FROM $table 
                                                        WHERE $itemdep = :$itemdep");

			$stmt -> bindParam(":".$itemdep, $valuedep, PDO::PARAM_STR);
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
	   CREATE DEPARTMENT ROW IN CATALOG
	=============================================*/

	 ////////// MODELO PARA CREAR CATEGORIA

	 public static function mdlCreateDepartment($table, $data){

		$stmt = Connection::getConnect()-> prepare("INSERT INTO $table(department_name) 
													VALUES (:department_name)" );
  
		$stmt->bindParam(":department_name", $data, PDO::PARAM_STR);
  
  if($stmt->execute()){
  
	return "ok";
  
  }else{
  
	return "error";
  
  }
  
  $stmt->close();
  $stmt = null;
	  }

	    // //// ELIMINAR DEPARTMENT

		static public function mdlRemoveDepartment($table,$item,$value){

			$stmt = Connection::getConnect()->prepare("DELETE FROM $table WHERE $item = :$item");
			
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
	  
	  
			if($stmt -> execute()){
	  
			  return "ok";
			
			}else{
		
			  return "error";	
		
			}
		
			$stmt -> close();
		
			$stmt = null;
	  
		  }

}

