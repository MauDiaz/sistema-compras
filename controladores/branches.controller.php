<?php

  class branchController {

    static public function ctrShowBranch($itembran, $valuebran){
        
        $table = "purchases_branches";
        $answer = branchModels::mdlShowBranch($table,$itembran,$valuebran);
        return $answer;
    }
    
    static public function ctrCreateBranch(){

      if (isset($_POST["br-name"])){
      
        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["br-rfc"])){
          
          $table = "purchases_branches";
          $data = array("branch_name" => $_POST["br-name"],
                        "branch_pn" => $_POST["br-pn"],
                        "branch_email" => $_POST["br-email"],
                        "branch_address" => $_POST["br-address"],
                        "branch_rfc" => $_POST["br-rfc"],
                        "quoter_id" => $_POST["quoter-id"],
                        "approver_id" => $_POST["approver-id"]
                      );  
            $answer = branchModels::mdlCreateBranch($table,$data);
               
            if ($answer == "ok"){

              echo'<script>

          swal({
              type: "success",
              title: "La Sucursal ha sido guardada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "index.php?ruta=branches";

                  }
                })

          </script>';
        }else{

          echo'<script>

          swal({
              type: "error",
              title: "¡El RFC no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {

              window.location = "index.php?ruta=branches";

              }
            })

          </script>';
        }
        }else{ //else del pregmatch

        }
      }else{ // else del isset

      }
    }

      //remove Branch
    
      static public function ctrRemoveBranch($item,$value){

        $table = "purchases_branches";
        $answer = branchModels::mdlRemoveBranch($table,$item,$value);
        return $answer;
        
      }

        /*=============================================
          SHOW ALL APPROVERs
        =============================================*/
        
        static public function ctrShowApprover($item,$value){

          $table = "purchases_staffs";

          $answer = branchModels::mdlShowApprover($table,$item,$value);
          return $answer;
        }

        /*=============================================
          SHOW Branch approver
        =============================================*/
        
        static public function ctrShowBranchApprover($item,$value){

          $table = "purchases_branches";

          $answer = branchModels::mdlShowBranchApprover($table,$item,$value);
          return $answer;
        }

         /*=============================================
          SHOW Branch quoter
        =============================================*/
        
        static public function ctrShowBranchQuoter($item,$value){

          $table = "purchases_branches";

          $answer = branchModels::mdlShowBranchQuoter($table,$item,$value);
          return $answer;
        }
  }