<?php

require_once "connection.php";

class staffModels{

	/*========================= ====================
	    SHOW STAFF DATA "DEPARTMENT"
	=============================================*/

	static public function mdlShowStaffCoDep($table, $item, $value){

		if($item != null){

            $stmt = connection::getConnect()->prepare("SELECT $table.branch_id,
                                                              $table.department_id, 
                                                              purchases_branches.branch_name,
                                                              purchases_branch_departments.department_name
                                                       FROM $table 
                                                       INNER JOIN purchases_branches 
                                                       ON purchases_branches.branch_id = $table.branch_id
                                                       INNER JOIN purchases_branch_departments
                                                       ON purchases_branch_departments.department_id = $table.department_id
                                                       WHERE $table.$item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
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
	    SHOW STAFF GENERAL DATA FROM STAFF TABLE
	=============================================*/

	static public function mdlShowStaff($table, $item, $value){

		if($item != null){

			$stmt = connection::getConnect()->prepare("SELECT * FROM $table 
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
	    SHOW STAFF COMPLETE DATA FROM STAFF TABLE
	=============================================*/

	static public function mdlShowStaffComplete($table, $item, $value){

		if($item != null){

            $stmt = connection::getConnect()->prepare("SELECT $table.branch_id,
                                                              $table.department_id,
                                                              $table.staff_name, 
                                                              $table.staff_pnumber,
                                                              $table.staff_email,
                                                              $table.staff_photo,
                                                              $table.position_id,
                                                              $table.role_id,
                                                              $table.active,
                                                              purchases_roles.role_name,
                                                              purchases_staff_position.position_name,
                                                              purchases_status.status_name,
                                                              purchases_branches.branch_name,
                                                              purchases_branch_departments.department_name
                                                       FROM $table 
                                                       INNER JOIN purchases_branches 
                                                       ON purchases_branches.branch_id = $table.branch_id
                                                       INNER JOIN purchases_branch_departments
                                                       ON purchases_branch_departments.department_id = $table.department_id
                                                       INNER JOIN purchases_roles
                                                       ON purchases_roles.role_id = $table.role_id
                                                       INNER JOIN purchases_staff_position
                                                       ON purchases_staff_position.position_id = $table.position_id
                                                       INNER JOIN purchases_status
                                                       ON purchases_status.id_status = $table.active
                                                       WHERE $table.$item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
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
	
	/*=============================================
	CREATE USER STAFF
	=============================================*/

	static public function mdlCreateStaff($table, $data){

		$stmt = connection::getConnect()->prepare("INSERT INTO $table(staff_name, staff_pnumber, staff_email,
																  branch_id, position_id, active,password,pin_number,
																  staff_photo,department_id,role_id)
										    	 		  VALUES (:staff_name,:staff_pnumber,:staff_email,
																  :branch_id, :position_id, :active, :password, :pin_number,
																  :staff_photo, :department_id, :role_id)");

		$stmt->bindParam(":staff_name", $data["staff_name"], PDO::PARAM_STR);
		$stmt->bindParam(":staff_pnumber", $data["staff_pnumber"], PDO::PARAM_STR);
		$stmt->bindParam(":staff_email", $data["staff_email"], PDO::PARAM_STR);
		$stmt->bindParam(":branch_id", $data["branch_id"], PDO::PARAM_STR);
		$stmt->bindParam(":position_id", $data["position_id"], PDO::PARAM_STR);
		$stmt->bindParam(":active", $data["active"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":pin_number", $data["pin_number"], PDO::PARAM_STR);
		$stmt->bindParam(":staff_photo", $data["staff_photo"], PDO::PARAM_STR);
		$stmt->bindParam(":department_id", $data["department_id"], PDO::PARAM_STR);
		$stmt->bindParam(":role_id", $data["role_id"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
					    REMOVING USER
	=============================================*/

	static public function mdlRemoveStaff($table,$item,$value){

		$stmt = connection::getConnect()->prepare("DELETE FROM $table WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		}else{

			return "error";
		}
	
		$stmt -> close();
		$stmt = null; 
	}

	/*=============================================
	UPDATE LAST LOGIN USER
	=============================================*/

	static public function mdlUpdateUserLogin($table, $item1, $value1, $item2, $value2){

		$stmt = connection::getConnect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


}