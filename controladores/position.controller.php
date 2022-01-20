<?php

  class positionController {

    static public function ctrShowPosition($itempos, $valuepos){
        
        $table = "purchases_staff_position";
        $answer = positionModels::mdlShowPosition($table,$itempos,$valuepos);
        return $answer;
    } 

  }