<?php

require_once "connection.php";

class positionModels{

/*========================= ====================
	    SHOW JOB POSITION GENERAL DATA FROM DEPARMENT-STAFF TABLE
	=============================================*/

	static public function mdlShowposition($table, $itempos, $valuepos){
        
		if($itempos != null){
            
            $stmt = connection::getConnect()->prepare("SELECT * 
                                                        FROM $table 
                                                        WHERE $itempos = :$itempos");

			$stmt -> bindParam(":".$itempos, $valuepos, PDO::PARAM_STR);
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







}

