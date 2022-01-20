<?php

require_once "connection.php";

class branchModels{

/*========================= ====================
	    SHOW JOB POSITION GENERAL DATA FROM DEPARMENT-STAFF TABLE
	=============================================*/

	static public function mdlShowBranch($table, $itembran, $valuebran){ 
        
		if($itembran != null){ 
            
            $stmt = connection::getConnect()->prepare("SELECT * 
                                                        FROM $table 
                                                        WHERE $itembran = :$itembran");

			$stmt -> bindParam(":".$itembran, $valuebran, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT $table.*, 
            										   purchases_staffs.staff_name AS approver
            										   FROM $table
            										   INNER JOIN purchases_staffs
            										   ON $table.approver_id = purchases_staffs.staff_id
        										      ");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;
    }

/*========================= ====================
	   CREATE BRANCHES
	=============================================*/

	static public function mdlCreateBranch($table,$data){

		

		$stmt = Connection::getConnect()->prepare("INSERT INTO $table
												(branch_name,branch_pn,branch_email,branch_address,branch_rfc, quoter_id, approver_id)
												VALUES 
												(:branch_name,:branch_pn,:branch_email,:branch_address,:branch_rfc, :quoter_id, :approver_id)");
		
		$stmt->bindParam(":branch_name", $data["branch_name"], PDO::PARAM_STR);
		$stmt->bindParam(":branch_pn", $data["branch_pn"], PDO::PARAM_STR);
		$stmt->bindParam(":branch_email", $data["branch_email"], PDO::PARAM_STR);
		$stmt->bindParam(":branch_address", $data["branch_address"], PDO::PARAM_STR);
		$stmt->bindParam(":branch_rfc", $data["branch_rfc"], PDO::PARAM_STR);
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

	//remove Branch

	static public function mdlRemoveBranch($table,$item,$value){

		$stmt = Connection::getConnect()->prepare("DELETE FROM $table WHERE $item = :$item");
			
		$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);

		if ($stmt->execute()){

			return "ok";
		
		}else{

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}


	// SHOW ALL APPROVERSS

	static public function mdlShowApprover($table, $item, $value){
        
		if($item != null){ 
            
            $stmt = connection::getConnect()->prepare("SELECT staff_id, staff_name
                                                        FROM $table 
                                                        WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetchAll();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT purchases_staffs.staff_id,
            												  purchases_staffs.staff_name 
            										   FROM $table
            										   INNER JOIN purchases_staffs
            										   ON $table.approver_id = purchases_staffs.staff_id
            										   WHERE purchases_staffs.role_id = 3");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;
    }

    // SHOW BRANCH-APPROVER

	static public function mdlShowBranchApprover($table, $item, $value){
        
		if($item != null){ 
            
            $stmt = connection::getConnect()->prepare("SELECT purchases_staffs.staff_id,
            												  purchases_staffs.staff_name,
            												  purchases_staffs.staff_photo 
                                                        FROM $table 
                                                        INNER JOIN purchases_staffs
            										   	ON $table.approver_id = purchases_staffs.staff_id
                                                        WHERE $table.$item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT purchases_staffs.staff_id,
            												  purchases_staffs.staff_name 
            										   FROM $table
            										   INNER JOIN purchases_staffs
            										   ON $table.approver_id = purchases_staffs.staff_id
            										   WHERE purchases_staffs.role_id = 3");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;
    }

     // SHOW BRANCH-QUOTER

	static public function mdlShowBranchQuoter($table, $item, $value){
        
		if($item != null){ 
            
            $stmt = connection::getConnect()->prepare("SELECT purchases_staffs.staff_id,
            												  purchases_staffs.staff_name,
            												  purchases_staffs.staff_photo 
                                                        FROM $table 
                                                        INNER JOIN purchases_staffs
            										   	ON $table.quoter_id = purchases_staffs.staff_id
                                                        WHERE $table.$item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

			return $stmt -> fetch();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT purchases_staffs.staff_id,
            												  purchases_staffs.staff_name 
            										   FROM $table
            										   INNER JOIN purchases_staffs
            										   ON $table.quoter_id = purchases_staffs.staff_id
            										   WHERE purchases_staffs.role_id = 3");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		
		$stmt -> close();
		$stmt = null;
    }



}

