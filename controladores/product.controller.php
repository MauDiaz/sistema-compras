<?php

  class productController{

     /*=============================================
        CONSULTA DE PRODUCTOS POR ID
        =============================================*/

    static public function ctrShowProducts($item, $value){

        $table1 = "purchases_products";
        $table3 = "purchases_munit";
        
        $answer = productModel::mdlShowProducts($table1,$table3,$item,$value);
        return $answer; 
    }


       /*=============================================
        CONSULTA DE PRODUCTOS POR NOMBRE
        =============================================*/

    static public function ctrShowProductsByName($item, $value){

        $table1 = "purchases_products";
        $table3 = "purchases_munit";
        
        $answer = productModel::mdlShowProductsByName($table1,$table3,$item,$value);
        return $answer; 
    }

       /*=============================================
        SHOW MAX PRODUCT ID
	      =============================================*/

        static public function ctrShowMaxProductId($item,$value){

          $table = "purchases_products";
          $answer = productModel::mdlShowMaxProductId($table,$item,$value);
          return $answer;
        }
 
    /*=============================================
	 CREATE PRODUCT
	=============================================*/

	static public function ctrCreateProduct(){

		if(isset($_POST["prod-name"])){
     
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["prod-cat-id"])){
       
          $table = "purchases_products";
          $data = array("product_name" => $_POST["prod-name"],
                       "product_desc" => $_POST["prod-desc"],
                       "meassure_unit_id" => $_POST["prod-unit-id"],
                       "category_id" => $_POST["prod-cat-id"]);
          
      $answer = productModel::mdlCreateProduct($table,$data);
       
      if($answer == "ok"){

            $item = "product_id";
            $value = null;
            $productId = productController::ctrShowMaxProductId($item,$value);
            $product = $productId[0][0];
            
            $table = "detail_product_supplier";
            $data = array("product_id" => $product,
                          "supplier_id" => $_POST["prod-supp-id"],
                          "product_price_list" => $_POST["prod-price"]);
            
            $answer = productModel::mdlCreateDetailProSupp($table,$data);
            
            if ($answer = "ok"){
              echo '<script>
    
              swal({
    
                type: "success",
                title: "¡El producto ha sido guardado correctamente!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
    
              }).then(function(result){
    
                if(result.value){
                
                  window.location= "index.php?ruta=products";
    
                }
    
              });
            
    
              </script>';
    
    
            }else{
  
              echo '<script>
      
                swal({
      
                  type: "error",
                  title: "¡El producto no puede ir vacío o llevar caracteres especiales!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
      
                }).then(function(result){
      
                  if(result.value){
                  
                    window.location= "index.php?ruta=products";
      
                  }
      
                });
              
      
              </script>';
      
            }
         
          }    
    
    } // else del preg match


    } // else del isset

  } //else del methodo

}  // else de la clase
    
         
      
 
           
               





  
