<?php

  class poController{

    static public function ctrShowCotizacion($item,$value){ 

        $table = "purchases_purchase_order";
        $answer = porderModel::mdlShowCotizacion($table,$item,$value);
        return $answer;
    }

    static public function ctrShowMaxCompraId($item,$value){

      $table = "purchases_orden_compras";
      $answer = porderModel::mdlShowMaxCompraId($table,$item,$value);
      return $answer;
  } 
  
    static public function ctrInsertPurchase(){

      if (isset($_POST['po-id'])){

        $purchase_order_id = $_POST['po-id'];
        $purchase_required_order_date = $_POST['po-rod'];
        $supplier_id = $_POST['po-sid'];

        // creando arreglo para insertar
        $table = "purchases_orden_compras"; //tabla a insertar
        $data = array("purchase_order_id" => $purchase_order_id,
                      "purchase_required_order_date" => $purchase_required_order_date
                    );

        $answer = porderModel::mdlInsertPurchase($table,$data);
        
        if ($answer == 'ok'){

          $item_list = json_decode($_POST["po-array"], true);
          $item = null;
          $value = null;
          $answerCompraId = poController::ctrShowMaxCompraId($item,$value);
          $compra_id = $answerCompraId[0][0];

          foreach($item_list as $key => $value){

            $table = "purchases_orden_compras_items";
            $data1 = $compra_id;
            $data2 = $value["product_id"];
            $data3 = $value["supplier_id"];
            $data4 = $value["quantity"];
            $data5 = floatVal($value["price_list"]);

            $answerCompraItems = porderModel::mdlInsertPurchaseItems($table,$data1,$data2,$data3,$data4,$data5);

          }
          if ($answerCompraItems == "ok"){

            $tablePo = "purchases_purchase_order_items";
            $datos = array("purchase_order_id" => $purchase_order_id,
                           "supplier_id" => $supplier_id); 
            $answerDelete = porderModel::mdlDeletePurchaseItems($tablePo,$datos);
          
          }
          if ($answerDelete == "ok"){

            echo'<script>

						swal({
							  type: "success",
							  title: "La Orden de Compra ha sido creada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "inicio";

										}
									})

						</script>';
          }else{
            echo'<script>

            swal({
                type: "error",
                title: "¡Error al crear la orden de compra !",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                if (result.value) {
  
                window.location = "postatus";
  
                }
              })
  
            </script>';
          }
        }
    }
  
  }

  // MOSTRAR ORDENES DE COMPRA.

  static public function ctrShowOrdenCompra($item,$value){

      $table = "purchases_orden_compras";
      $answer = porderModel::mdlShowOrdenCompra($table,$item,$value);
      return $answer;
  }

  // MOSTRAR ALL PROVEEDOR PARA CABECERA DEL PDF.

  static public function ctrShowProveedorItems($item,$value){

    $table = "purchases_orden_compras_items";
    $answer = porderModel::mdlShowProveedorItems($table,$item,$value);
    return $answer;
  }

  // MOSTRAR ITEMS DE LA ORDEN DE COMPRA.

  static public function ctrShowCompraItemList($item,$value){

    $table = "purchases_orden_compras_items";
    $answer = porderModel::mdlShowCompraItemList($table,$item,$value);
    return $answer;
  }

}