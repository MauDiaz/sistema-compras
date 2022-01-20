<?php

  class measureController {

    static public function ctrShowMeasure($item, $value){
        
        $table = "purchases_munit";
        $answer = measureModels::mdlShowMeasure($table,$item,$value);
        return $answer;
    } 

    static public function ctrCreateMeasure(){

      if(isset($_POST["unit-name"])){

        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["unit-name"])){


          $table = "purchases_munit";
          $data = $_POST["unit-name"];
          $answer = measureModels::mdlCreateMeasure($table,$data);

          if($answer = "ok"){

            echo'<script>

            swal({
                type: "success",
                title: "La unidad ha sido guardada correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
  
                    window.location = "index.php?ruta=measureunits";
  
                    }
                  })
  
            </script>';

          }else{

            echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index.php?ruta=prod_measureunits";

							}
						})

			  	</script>';
          }
        }else{//e;se del preg match

        }

      }else{ //else del isset

      }

    }
    //remover unidad
    
    static public function ctrRemoveUnit($item,$value){

      $table = "purchases_munit";

      $answer = measureModels::mdlRemoveUnit($table,$item,$value);
      return $answer;
    }


  }