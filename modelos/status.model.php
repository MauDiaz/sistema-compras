<?php

  require_once "connection.php";
 
    class statusModel{

        static public function mdlShowStatus($table,$item,$value){

            if($item != null){


            }else{

                $stmt = Connection::getConnect()->prepare("SELECT * FROM $table");

                $stmt -> execute();
                return $stmt -> fetchAll();
            }
            $stmt -> close();
            $stmt = null;
        }

// MODELO PARA ACTUALIZAR EL ESTADO DE UNA REQUISICION

    static public function mdlUpdateRequestStatus($table,$item,$item2,$value,$value2){

            $stmt=Connection::getConnect() -> prepare("UPDATE $table 
                                                        SET $item2 = :$item2 
                                                        WHERE $item = :$item");

            $stmt-> bindparam(":".$item2, $value2, PDO::PARAM_STR);
            $stmt-> bindparam(":".$item, $value, PDO::PARAM_STR);
            

            if($stmt -> execute()){

                return "ok";
            }

            else{

                return "error";

                }

                $stmt -> close();
                $stmt = null;
        }
        
    } 