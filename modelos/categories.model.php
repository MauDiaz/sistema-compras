<?php

require_once "connection.php";

  class categoriesModel{

    public static function mdlShowCategories($table,$item,$value){

        if ($item != null){ 

          $stmt = connection::getConnect()->prepare("SELECT * 
                                                    FROM $table
                                                    WHERE $item = :$item");
          
          $stmt -> bindParam(":".$item, $value, PDO::PARAM_INT);
          $stmt -> execute();
          return $stmt -> fetch();
  

        }else {

            $stmt = Connection::getConnect()-> prepare("SELECT 
                                                        $table.category_name,
                                                        $table.category_id
                                                        FROM $table");
                                                        
            $stmt -> execute();
            return $stmt -> fetchAll();
        }

        $stmt -> close();
        $stmt = null;
    }

    ////////// MODELO PARA CREAR CATEGORIA

    public static function mdlCreateCategory($table, $data){

      $stmt = Connection::getConnect()-> prepare("INSERT INTO $table(category_name) 
                                                  VALUES (:category_name)" );

      $stmt->bindParam(":category_name", $data, PDO::PARAM_STR);

if($stmt->execute()){

  return "ok";

}else{

  return "error";

}

$stmt->close();
$stmt = null;
    }


    // //// ELIMINAR CATEGORIA

    static public function mdlRemoveCategory($table,$item,$value){

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