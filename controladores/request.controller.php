<?php

  class requestController{

    static public function ctrShowMaxRequestId($item_req,$value_req){

        $table_req = "purchases_request_order";
        $answer_req = requestModel::mdlShowMaxRequestId($table_req,$item_req,$value_req);
        return $answer_req;
    } 

     // INSERT REQUEST METHOD //

     static public function ctrInsertRequest(){
       
      if (isset($_POST['company'])){

        // if(preg_match('/^[0-9]+$/', $_POST["company"])){
          
          /*  GETTING ORDER TYPE ID FROM TABLE ORDER_TYPE*/
          $item = "order_type";
          $value = $_POST["req-type"];
          $otAnswer = orderTypeController::ctrShowOrderType($item,$value);
          $orderId = $otAnswer[0]; // order type id
         
          /*  SETTING DATA TO BE INSERTED IN REQUEST_ORDER  */

          $table = "purchases_request_order"; // table name to insert 
          $orderNumber = $_POST["req-no"]; // request_order_number Value
          $orderStatus = 1; // order status burn data -- first insert will be number 1 for pending status
          $reqDate = date('Y-m-d',strtotime($_POST["requirement-date"])); //request order required date
          $branch = $_SESSION["branch"]; // branch id session variable 
          $staff = $_SESSION["id"]; // staff id session variable
          $department = $_POST["department-id"]; // department-id
          $company = $_POST["company"];
          $departmentName = $_POST["departament"];
          $staffName = $_POST["staff"];
          $approverId = $_POST["approver-id"];
          $quoterId = $_POST["quoter-id"];


            /* PASSING DATA TO ARRAY */

          $data = array( "request_order_number"=> $orderNumber,
                         "request_order_status"=> $orderStatus,
                         "request_order_required_date" => $reqDate,
                         "branch_id" => $branch,
                         "staff_id" => $staff,
                         "order_type_id" => intval($orderId[0]),
                         "department_id" => $department,
                         "quoter_id" => $quoterId,
                         "approver_id" => $approverId); 
                         
            /* CALLING INSERT REQUEST FUNCTION MODEL */             
         
          $answerReqOrder = requestModel::mdlInsertRequest($table,$data);

          if($answerReqOrder == 'ok'){

            $productList = json_decode($_POST["input-array"], true);
            $item_req = null;
            $value_req = null;
            $anwserRequestId = requestController::ctrShowMaxRequestId($item_req,$value_req);
            $reqId = $anwserRequestId[0][0];
            foreach ($productList as $key => $value){
              
              $table = "purchases_request_order_items";
              $data1= $reqId;
              $data2 = $value["product_id"];
              $data3 = $value["quantity"];
              
              $answerReqOrderItems = requestModel::mdlInsertRequestItems($table,$data1,$data2,$data3);
            }
            if ($answerReqOrderItems == 'ok'){


              function getSslPage($url){

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
              'text' => "El Sr. ".$staffName." ha realizado una requisicion de compra de la compañia ".$company." para el departamento ".$departmentName.""
              ];

              $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

               // $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

              echo '<script>

                    swal({
                    type: "success",
                    title: "Requisicion Guardada Correctamente",
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
                    title: "Error al guardar Requisicion",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=inicio";

                              }
                          })

               </script>';
            
            }
          }
        // }else{
          // echo '<script> alert("Datos Incorrectos")</script>';
          // echo '<script> window.location = "requesting";</script>';
        // }
      }else{
          // echo '<script> alert("Datos Incorrectos")</script>';
          // echo '<script> window.location = "requesting";</script>';
      }

     }  

      /* 
         MUESTRA LAS REQUESICIONES POR ESTADO
                                    */
     static public function ctrShowRequestStatus($item,$value){   

          $table = "purchases_request_order";
          $answer = requestModel::mdlShowRequestStatus($table,$item,$value); 
          return $answer;
     } 

           /* 
         MUESTRA LAS REQUESICIONES POR ESTADO PARA CADA COTIZADOR
                                    */
     static public function ctrShowRequestStatus2($item,$value,$item2,$value2){   

          $table = "purchases_request_order";
          $answer = requestModel::mdlShowRequestStatus2($table,$item,$value,$item2,$value2); 
          return $answer;
     } 

       /* 
         MUESTRA LAS REQUESICIONES POR ESTADO y ID DEL STAFF
                                    */
      static public function ctrShowRequestStatusStaff($item,$value,$item2,$value2){

        $table = "purchases_request_order";
        $answer = requestModel::mdlShowRequestStatusStaff($table,$item,$value,$item2,$value2);
        return $answer;
    }

     /* 
         CONSULTA CABECERA DE REQUISICION 
                                               */

      static public function ctrShowResquestingPlaced($reqItem, $reqValue){

        $reqTable = "purchases_request_order";
        $answer = requestModel::mdlShowRequestingPlaced($reqTable,$reqItem,$reqValue);
        return $answer;
      } 
      
     /* 
         CONSULTA ARTICULOS DE REQUISICION 
                                                            */

      static public function ctrShowRequestedItemList($itemList,$valueList){

        $tableList = "purchases_request_order_items";
        $answerList = requestModel::mdlShowRequestedItemList($tableList,$itemList,$valueList); 
        return $answerList;
      } 

      /* 
         CONSULTA EL DEPARTAMENTO DE QUIEN REQUISITO
                                                            */
        static public function ctrShowDepartment($itemStaff,$valueStaff){

          $tableStaff = "purchases_staffs";
          $answer = requestModel::mdlShowDepartment($tableStaff,$itemStaff,$valueStaff);
          return $answer;
        }

         
  }