<?php

class orderTypeController{

    // SELECT ORDER TYPE METHOD

    static public function ctrShowOrderType($item,$value){

            $table = "purchases_order_type";
            $answer = orderTypeModels::mdlShowOrderType($table, $item, $value);
            return $answer;
    
    }
}   