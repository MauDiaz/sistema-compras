<?php

  class roleController {

    static public function ctrShowRole($itemrol,$valuerol){

        $table = "purchases_roles";
        $answer = roleModels::mdlShowRole($table,$itemrol,$valuerol);
        return $answer;
    }
  }