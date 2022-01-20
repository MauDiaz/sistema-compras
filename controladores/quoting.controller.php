<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

  class quotingController {

   static public function ctrShowMaxQuotationId($item_quot,$value_quot){

        $table_quot = "purchases_quotation_order";
        $answer_quot = quotingModel::mdlShowMaxQuotationId($table_quot,$item_quot,$value_quot);
        return $answer_quot;
    } 
    


    // INSERT REQUEST METHOD COPIA PARA COTIZACIONES//  

     static public function ctrInsertQuotation(){ 
       
      if (isset($_POST['request-id'])){

        // if(preg_match('/^[0-9]+$/', $_POST["company"])){
          
                 
          /*  SETTING DATA TO BE INSERTED IN QUOTATION_ORDER  */

          $table = "purchases_quotation_order"; // table name to insert 
          $request = $_POST["request-id"];
          $supplier = $_POST["supplier-id"]; // 
          $payment = $_POST["payment-id"];
          $quoter = $_SESSION["id"];
          $approver = $_POST["approver-id"];


            /* PASSING DATA TO ARRAY */

          $data = array( "request_order_id"=> $request,
                         "supplier_id"=> $supplier,
                         "payment_type_id"=> $payment,
                         "quoter_id"=> $quoter,
                         "approver_id"=> $approver
                        ); 
                         
            /* CALLING INSERT REQUEST FUNCTION MODEL */             
         
          $answerQuotOrder = quotingModel::mdlInsertQuotation($table,$data);


          if($answerQuotOrder == 'ok'){

            $productList = json_decode($_POST["input-array"], true);
            $item_quot = null;
            $value_quot = null;
            $anwserQuotationId = quotingController::ctrShowMaxQuotationId($item_quot,$value_quot);
            $quotId = $anwserQuotationId[0][0];
            foreach ($productList as $key => $value){
              

              $table = "purchases_quotation_order_items";
              $data1= $quotId;
              $data2 = $value["product_id"];
              $data3 = $value["quantity"];
                         
              $answerQuotOrderItems = quotingModel::mdlInsertQuotationItems($table,$data1,$data2,$data3);
            }
            if ($answerQuotOrderItems == 'ok'){ 
              
       echo '<script>

                    swal({
                    type: "success",
                    title: "Cotizacion Guardada Correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=inicio";

                              }
                          })


              </script>';

            }else{
              
            echo '<script>

               swal({
                    type: "error",
                    title: "Error al guardar la cotizacion",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=inicio";

                              }
                          })

               </script>';

            }
          }else{

               echo '<script>

               swal({
                    type: "error",
                    title: "Error al guardar la cotizacion",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=inicio";

                              }
                          })

               </script>';

          }
      
      }else{
          // echo '<script> alert("Datos Incorrectos")</script>';
          // echo '<script> window.location = "requesting";</script>';
      }

     }


      // MUESTRA LAS COTIZACIONES POR ESTADO
                                    
     static public function ctrShowQuotationStatus($item,$value){   

          $table = "purchases_quotation_order";
          $answer = quotingModel::mdlShowQuotationStatus($table,$item,$value);
          return $answer;
     } 

      // MUESTRA LAS COTIZACIONES POR ROL DE APROBACION
                                    
     static public function ctrShowQuotationStatusRole($item,$value,$item1,$value1){   

          $table = "purchases_quotation_order";
          $answer = quotingModel::mdlShowQuotationStatusRole($table,$item,$value,$item1,$value1);
          return $answer;
     } 

   // MUESTRA LAS COTIZACIONES POR ESTADO QUE SEAN CONSIGNACION
                                    
     static public function ctrShowQuotationStatusConsig($item,$value,$item1,$value1){   

          $table = "purchases_quotation_order";
          $answer = quotingModel::mdlShowQuotationStatusConsig($table,$item,$value,$item1,$value1);
          return $answer;
     } 

     // MUESTRA LAS COTIZACIONES POR ESTADO QUE SEAN CONSIGNACION PARA CADA COTIZADOR
                                    
     static public function ctrShowQuotationStatusConsig2($item,$value,$item1,$value1,$item2,$value2){   

          $table = "purchases_quotation_order";
          $answer = quotingModel::mdlShowQuotationStatusConsig2($table,$item,$value,$item1,$value1,$item2,$value2);
          return $answer;
     } 

 // MUESTRA LAS COTIZACIONES POR ID
                                    
     static public function ctrShowQuotation($item,$value){    

          $table = "purchases_quotation_order";
          $answer = quotingModel::mdlShowQuotation($table,$item,$value);
          return $answer;
     } 

       /* 
         CONSULTA ARTICULOS DE COTIZACION 
                                                            */

      static public function ctrShowQuotedItemList($itemList,$valueList){

        $tableList = "purchases_quotation_order_items";
        $answerList = quotingModel::mdlShowQuotedItemList($tableList,$itemList,$valueList);
        return $answerList;
      } 


 /* 
         ACTUALIZAR PRECIOS Y CANTIDADES PARA CERRAR COTIZACIONES
                                                            */

         static public function ctrCloseQuotation(){

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
            	$value1 = 2;
            	$item2 =  "quotation_order_id";
            	$value2 = $_POST["quot-id"]; 
            	
            	$answerUpdateStatus = quotingModel::mdlUpdateQuotationStatus($table,$item1,$value1,$item2,$value2);
            }
            if ($answerUpdateStatus = "ok"){

              function getSslPage2($url){

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
              'text' => "El Sr. ".$_SESSION["name"]." cotizo la requisicion de compra del Sr. ".$staffName." de la compañia ".$company." para el departamento ".$departmentName. " con el proveedor " .$supplierName.""
              ];

              $response = getSslPage2("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

               // $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );


            	echo '<script>
    
              swal({
    
                type: "success",
                title: "¡La requisicion se cerro correctamente!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
    
              }).then(function(result){
    
                if(result.value){
                
                  window.location= "index.php?ruta=quostatus";
    
                }
    
              });
            
    
              </script>';
            }else{

            	echo '<script>
      
                swal({
      
                  type: "error",
                  title: "¡Error al cerrar la requisicion!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
      
                }).then(function(result){
      
                  if(result.value){
                  
                    window.location= "index.php?ruta=quostatus";
      
                  }
      
                });
              
      
              </script>';
            }
         }

     }

 /* 
    CONSULTAR EL TIPO DE PAGO
                                                            */
      static public function ctrShowPaymentType($item, $value){

          $table = "purchases_payment_type";

          $answer = quotingModel::mdlShowPaymentType($table,$item, $value);

          return $answer;

      }

       /* 
         CONSULTA CABECERA DE REQUISICION 
                                               */

      static public function ctrShowQuotingPlaced($quotItem, $quotValue){

        $quotTable = "purchases_quotation_order";
        $answer = quotingModel::mdlShowQuotingPlaced($quotTable,$quotItem,$quotValue);
        return $answer;
      } 

      /* 
         FUNCION QUE ENVIA EMAIL
                                               */

         public function ctrCreateEmail(){

          if(isset($_POST["receiver"])){

            $mail = new PHPMailer;


              try {
                  //Server settings
                  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                  $mail->isSMTP();                                            //Send using SMTP
                  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                  $mail->Username   = $_POST["sender"];                     //SMTP username
                  $mail->Password   = 'Master01!@#';                               //SMTP password
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                  $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                  //Recipients
                  $mail->setFrom($_POST["sender"], 'Mauricio Diaz');
                  $mail->addAddress($_POST["receiver"]);               //Name is optional
                  
                  $file_name =  $_FILES["file"]["name"];
                  move_uploaded_file($_FILES["file"]["tmp_name"], $file_name);
                  //Attachments
                  $mail->addAttachment($file_name);         //Add attachments

                  //Content
                  $mail->isHTML(true);                                  //Set email format to HTML
                  $mail->Subject = $_POST["subject"];
                  $mail->Body    = $_POST["message"];

                  $mail->send();
                  echo '<script>
    
                              swal({
                    
                                type: "success",
                                title: "¡El correo se envio correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                    
                              }).then(function(result){
                    
                                if(result.value){
                                
                                  window.location= "index.php?ruta=quostatus";
                    
                                }
                    
                              });
                            
                    
                              </script>';
              } catch (Exception $e) {
                  echo '<script>
      
                swal({
      
                  type: "error",
                  title: "¡Error al enviar el correo!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
      
                }).then(function(result){
      
                  if(result.value){
                  
                    window.location= "index.php?ruta=quostatus";
      
                  }
      
                });
              
      
              </script>';
              }
          
           }
         }

  }
