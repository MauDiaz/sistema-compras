<?php

require_once "connection.php";

class orderTypeModels{

	/*=============================================
	                SHOW ORDER TYPES
	=============================================*/

	static public function mdlShowOrderType($table, $item, $value){

		if($item != null){

            $stmt = connection::getConnect()->prepare("SELECT * FROM $table WHERE $table.$item = :$item");
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT * FROM $table");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;
    }
}