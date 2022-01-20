<?php

  class departmentController {

    static public function ctrShowDepartment($itemdep, $valuedep){
        
        $table = "purchases_branch_departments";
        $answer = departmentModels::mdlShowDepartment($table,$itemdep,$valuedep);
        return $answer;
    } 

    static public function ctrCreateDepartment(){

      if(isset($_POST["new-department"])){

        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["new-department"])){

          $table = "purchases_branch_departments";
          $data = $_POST["new-department"];
          $answer = departmentModels::mdlCreatedepartment($table,$data);
          var_dump($answer);
          if($answer == "ok"){

            echo'<script>
  
            swal({
                type: "success",
                title: "El departamento ha sido guardada correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
  
                    window.location = "index.php?ruta=departments";
  
                    }
                  })
  
            </script>';
          }else{
  
            echo'<script>
  
            swal({
                type: "error",
                title: "¡El departamento no puede ir vacío o llevar caracteres especiales!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                if (result.value) {
  
                window.location = "index.php?ruta=departments";
  
                }
              })
  
            </script>';
          }

        }
      }

    }

  // REMOVE DEPARTMENT FOR CATALOG

    static public function ctrRemoveDepartment($item,$value){

      $table = "purchases_branch_departments";
      $answer = departmentModels::mdlRemoveDepartment($table,$item,$value);
      return $answer;
    }

  }