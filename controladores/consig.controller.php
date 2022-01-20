<?php


  class ConsigController {


  	public function ctrConsigQuotation(){

  		if(isset($_POST["new-payment-type"])){


  			$payment_type_id = $_POST["new-payment-type"];

  			 $productList = json_decode($_POST["input-array"], true);
          
          foreach ($productList as $key => $value){
              

              $table = "purchases_quotation_order_items";
              $data1= $_POST["consig-id"];
              $data2 = $value["product_id"];
              $data3 = $value["quantity"];
              $data4 = floatVal($value["price_list"]);
              
              $answer = quotingModel::mdlUpdateQuotationItems($table,$data1,$data2,$data3,$data4);
            }

            if ($answer = "ok"){


            	$tabla = "purchases_quotation_order";
            	$item1 = "payment_type_id";
            	$value1 = $payment_type_id;
            	$item2 = "quotation_order_id";
            	$value2 = $_POST["consig-id"];


            	$update = quotingModel::mdlUpdateQuotationConsig($tabla,$item1,$value1,$item2,$value2);

            }

            if ($update = "ok"){

            	echo '<script>
    
              swal({
    
                type: "success",
                title: "¡La consignacion ha ajustado correctamente!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
    
              }).then(function(result){
    
                if(result.value){
                
                  window.location= "index.php?ruta=inicio";
    
                }
    
              });
            
    
              </script>';

            }else{

              echo '<script>
      
                swal({
      
                  type: "error",
                  title: "¡Error al ajustar la consignacion!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
      
                }).then(function(result){
      
                  if(result.value){
                  
                    window.location= "index.php?ruta=inicio";
      
                  }
      
                });
              
      
              </script>';
            }


            }



  		}


  	}







  