<?php
  
   require_once "connection.php";

   class roleModels{


      static public function mdlShowRole($table,$itemrol,$valuerol){

         if($itemrol != null){


         }else{

            $stmt = Connection::getConnect()->prepare("SELECT * FROM $table");

            $stmt -> execute();
            return $stmt -> fetchAll();
         }

        $stmt -> close();
		$stmt = null;
      }
   }