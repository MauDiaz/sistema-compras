<?php

  class statusController{

    static public function ctrShowStatus($item,$value){

        $table = "purchases_status";
        $answer = statusModel::mdlShowStatus($table,$item,$value);
        return $answer;
    }

    // CAMBIAR EL ESTADO DE UNA REQUISICION DE FINALIZADA A ACTIVA

      static public function ctrUpdateRequestStatusActive($item,$value){


        $table = "purchases_request_order";
        $item2 = "request_order_status";
        $value2 = 1;

        $answer = statusModel::mdlUpdateRequestStatus($table,$item,$item2,$value,$value2);

        return $answer;


    }

     // CAMBIAR EL ESTADO DE UNA REQUISICION DE ACTIVA A FINALIZADA

      static public function ctrUpdateRequestStatusInactive($item,$value){


        $table = "purchases_request_order";
        $item2 = "request_order_status";
        $value2 = 3;

        $answer = statusModel::mdlUpdateRequestStatus($table,$item,$item2,$value,$value2);

        return $answer;


    }

  } 