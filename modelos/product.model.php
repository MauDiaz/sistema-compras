<?php

  require_once "connection.php";

   class productModel{

   /*=============================================
    CONSULTA DE PRODUCTOS POR ID
    =============================================*/

    static public function mdlShowProducts($table1,$table3,$item,$value){   

        if($item != null){

            $stmt = connection::getConnect()->prepare("SELECT 
                                                        $table1.product_id,
                                                        $table1.product_name,
                                                        $table1.meassure_unit_id,
                                                        $table1.active,
                                                        $table3.meassure_unit_name
                                                        FROM $table1
                                                        INNER JOIN $table3 ON $table3.meassure_unit_id = $table1.meassure_unit_id
                                                        WHERE $table1.$item = :$item
                                                        ");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
      $stmt -> execute();

			return $stmt -> fetchAll();

		}else{

            $stmt = connection::getConnect()->prepare("SELECT 
                                                        $table1.product_id,
                                                        $table1.product_name,
                                                        $table1.category_id,
                                                        $table1.meassure_unit_id,
                                                        $table1.active,
                                                        $table3.meassure_unit_name
                                                        FROM $table1
                                                        INNER JOIN $table3 ON $table3.meassure_unit_id = $table1.meassure_unit_id
                                                        ");
			$stmt -> execute();
			return $stmt -> fetchALL();
		}
		
		$stmt -> close();
		$stmt = null;
    }

  /*=============================================
    CONSULTA DE PRODUCTOS POR NOMBRE
    =============================================*/

    static public function mdlShowProductsByName($table1,$table3,$item,$value){

        if($item != null){

            $stmt = connection::getConnect()->prepare("SELECT 
                                                        $table1.product_id,
                                                        $table1.product_name,
                                                        $table1.meassure_unit_id,
                                                        $table3.meassure_unit_name
                                                        FROM $table1
                                                        INNER JOIN $table3 ON $table3.meassure_unit_id = $table1.meassure_unit_id
                                                        WHERE $table1.$item LIKE '%$value%'
                                                        ");

      $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
      $stmt -> execute();

      return $stmt -> fetchAll();

    }else{

            $stmt = connection::getConnect()->prepare("SELECT 
                                                        $table1.product_id,
                                                        $table1.product_name,
                                                        $table1.category_id,
                                                        $table1.meassure_unit_id,
                                                        $table3.meassure_unit_name
                                                        FROM $table1
                                                        INNER JOIN $table3 ON $table3.meassure_unit_id = $table1.meassure_unit_id
                                                        ");
      $stmt -> execute();
      return $stmt -> fetchALL();
    }
    
    $stmt -> close();
    $stmt = null;
    }

    // SHOW MAX PRODUCT ID

    static public function mdlShowMaxProductId($table,$item,$value){

      if($item != null){
        
        $stmt = connection::getConnect()-> prepare("SELECT MAX($table.$item)FROM $table");
        
        $stmt->execute();
        return $stmt -> fetchALL();


      }else{

         
      }

      $stmt -> close();
      $stmt = null;
      
    }

    static public function mdlCreateProduct($table, $data){

      $stmt = connection::getConnect()->prepare("INSERT INTO $table(product_name,product_desc,meassure_unit_id,
                                    category_id)
                                   VALUES (:product_name, :product_desc, :meassure_unit_id,
                                    :category_id)");
  
      $stmt->bindParam(":product_name", $data["product_name"], PDO::PARAM_STR);
      $stmt->bindParam(":product_desc", $data["product_desc"], PDO::PARAM_STR);
      $stmt->bindParam(":meassure_unit_id", $data["meassure_unit_id"], PDO::PARAM_STR);
      $stmt->bindParam(":category_id", $data["category_id"], PDO::PARAM_STR);
         
      if($stmt->execute()){
  
        return "ok";	
  
      }else{
  
        return "error";
      
      }
  
      $stmt->close();
      
      $stmt = null;
  
    }

    static public function mdlCreateDetailProSupp($table, $data){

      $stmt = connection::getConnect()->prepare("INSERT INTO $table(product_id, supplier_id, product_price_list)
                                   VALUES (:product_id, :supplier_id, :product_price_list)");
  
      $stmt->bindParam(":product_id", $data["product_id"], PDO::PARAM_STR);
      $stmt->bindParam(":supplier_id", $data["supplier_id"], PDO::PARAM_STR);
      $stmt->bindParam(":product_price_list", $data["product_price_list"], PDO::PARAM_STR);
         
      if($stmt->execute()){
  
        return "ok";	
  
      }else{
  
        return "error";
      
      }
  
      $stmt->close();
      
      $stmt = null;
  
    }


    /*=============================================
  UPDATE PRODUCTO ACTIVO
  =============================================*/

  static public function mdlUpdateActiveProduct($table, $item1, $value1, $item2, $value2){

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

   /*=============================================
    CONSULTA DE PRODUCTO PARA VALIDAR DUPLICADO
    =============================================*/

    static public function mdlShowProduct($table,$item,$value){   

        if($item != null){

            $stmt = connection::getConnect()->prepare("SELECT 
                                                        $table.product_name
                                                        FROM $table
                                                        WHERE $table.$item = :$item
                                                        ");

      $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
      $stmt -> execute();

      return $stmt -> fetch();

    }else{

            $stmt = connection::getConnect()->prepare("
                                                        ");
      $stmt -> execute();
      return $stmt -> fetchALL();
    }
    
    $stmt -> close();
    $stmt = null;
    }



   }