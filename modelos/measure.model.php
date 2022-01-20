<?php

require_once "connection.php";

class measureModels{

/*========================= ====================
	    SHOW MEASURE UNITS TABLE 
	=============================================*/

	static public function mdlShowMeasure($table, $item, $value){
        
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
	    CREATE NEW MEASURE ROW TABLE 
	=============================================*/

	public static function mdlCreateMeasure($table, $data){

		$stmt = Connection::getConnect()-> prepare("INSERT INTO $table(meassure_unit_name) 
													VALUES (:meassure_unit_name)" );
  
		$stmt->bindParam(":meassure_unit_name", $data, PDO::PARAM_STR);
  
  if($stmt->execute()){
  
	return "ok";
  
  }else{
  
	return "error";
  
  }
  
  $stmt->close();
  $stmt = null;
	 
}
  /*========================= ====================
	    REMOVE SELECTED MEASURE ROW 
	=============================================*/

  static public function mdlRemoveUnit($table,$item,$value){

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



