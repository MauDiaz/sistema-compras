<?php

  class categoriesController{

    static public function ctrShowCategories($item,$value){


        $table = "purchases_prod_categories";

        $answer = categoriesModel::mdlShowCategories($table,$item,$value);

        return $answer;

    }

    static public function ctrCreateCategory(){

    if(isset($_POST["new-category"])){

      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["new-category"])){

        $table ="purchases_prod_categories";
        $data = $_POST["new-category"];
        $answer = categoriesModel::mdlCreateCategory($table,$data);
        if($answer == "ok"){

          echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "index.php?ruta=prodCategories";

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

							window.location = "index.php?ruta=prodCategories";

							}
						})

			  	</script>';
        }

      }else{ // else del pregmatch

      }
    }else{ //else del isset


    }


    }

// ELIMINAR CATEGORIA

    static public function ctrRemoveCategory($item,$value){
     
      $table ="purchases_prod_categories";
      $answer = categoriesModel::mdlRemoveCategory($table,$item,$value);
      return $answer;
    }

  }