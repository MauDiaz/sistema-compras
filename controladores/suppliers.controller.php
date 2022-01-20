<?php

  class supplierController {

    //show Suppliers

    static public function ctrShowSupplier($item, $value){ 
        
        $table = "purchases_suppliers";
        $answer = supplierModels::mdlShowSupplier($table,$item,$value);
        return $answer;
    } 

    //create supplier  

    static public function ctrCreateSupplier(){

        if(isset($_POST["supp-name"])){

          if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["supp-name"])){

            $table = "purchases_suppliers";
            $data = array("supplier_name" => $_POST["supp-name"],
                          "supplier_pn" => $_POST["supp-pn"],
                          "supplier_email" => $_POST["supp-email"],
                          "supplier_address" => $_POST["supp-address"],
                          "supplier_status" => $_POST["supp-status-id"] 
                      );  

              $answer = supplierModels::mdlCreateSupplier($table,$data);

                  if ($answer == "ok"){

                echo'<script>
  
            swal({
                type: "success",
                title: "El proveedor ha sido guardado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {
  
                    window.location = "index.php?ruta=suppliers";
  
                    }
                  })
  
            </script>';
          }else{
  
            echo'<script>
  
            swal({
                type: "error",
                title: "¡El nombre del proveedor no puede ir vacío o llevar caracteres especiales!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                if (result.value) {
  
                window.location = "index.php?ruta=suppliers";
  
                }
              })
  
            </script>';
          }

              

          }else{ // else del preg_match

          }

        }else{ //else del isset

        }


    }

    /// REMOVE SUPPLIER

    static public function ctrRemoveSupplier($item,$value){

      $table = "purchases_suppliers";
      $answer = supplierModels::mdlRemoveSupplier($table,$item,$value);
      return $answer;

    }


  }