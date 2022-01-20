<?php


  class approvalController {

    /* 
         ACTUALIZAR PRECIOS Y CANTIDADES PARA CERRAR COTIZACIONES
                                                            */

         static public function ctrApprovalQuotation(){

          if(isset($_POST["quot-id"])){

          $company = $_POST["company"];
          $departmentName = $_POST["department"];
          $staffName = $_POST["staff"];
          $supplierName = $_POST["supplier"];
          $reqId = $_POST["req-id"];


          $productList = json_decode($_POST["input-array"], true);
          
          foreach ($productList as $key => $value){
              

              $table = "purchases_quotation_order_items";
              $data1= $_POST["quot-id"];
              $data2 = $value["product_id"];
              $data3 = $value["quantity"];
              $data4 = floatVal($value["price_list"]);
              
              $answer = quotingModel::mdlUpdateQuotationItems($table,$data1,$data2,$data3,$data4);
            }

            if ($answer = "ok"){

              $table = "purchases_quotation_order";
              $item1 = "quotation_order_status";
              $value1 = 4;
              $item2 =  "quotation_order_id";
              $value2 = $_POST["quot-id"]; 
              
              $answerUpdateStatus = quotingModel::mdlUpdateQuotationStatus($table,$item1,$value1,$item2,$value2);
            }

            if ($answerUpdateStatus = "ok"){


               function getSslPage3($url){

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_REFERER, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $result = curl_exec($ch);
                curl_close($ch);
                return $result;
              }


              $apiToken = "1627935872:AAFSyya9t43ndXaVVbQk81ejij7kJltPf9k";

              $data = [
              'chat_id' => '@comprasPall',
              'text' => "El Sr. ".$_SESSION["name"]." aprobo la cotizacion de compra del Sr. ".$staffName." de la compañia ".$company." para el departamento ".$departmentName. " con el proveedor " .$supplierName.""
              ];

              $response = getSslPage3("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

               // $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );



              echo '<script>
    
              swal({
    
                type: "success",
                title: "¡La orden de compra se creo correctamente!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
    
              }).then(function(result){
    
                if(result.value){
                
                  window.location= "index.php?ruta=aostatus";
    
                }
    
              });
            
    
              </script>';

            }else{

              echo '<script>
      
                swal({
      
                  type: "error",
                  title: "¡Error al crear orden de compra!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
      
                }).then(function(result){
      
                  if(result.value){
                  
                    window.location= "index.php?ruta=aostatus";
      
                  }
      
                });
              
      
              </script>';
            }
         }

     }

   }