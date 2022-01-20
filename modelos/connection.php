<?php
        
  class connection {

    // puublic method to establish database con

    public static function getConnect(){

        // instance PDO conn with parameters and asign to Link Variable
            
        $link = new PDO ("mysql:host=localhost;dbname=palladiumpurchases","root","");

        //   exceuting link Variable add data formatting

        $link -> exec ("set names utf8");

        // returning conecction 

        return $link;
    }
  }