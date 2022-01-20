<?php
 
  require_once "connection.php";

  class porderModel {

    static public function mdlShowCotizacion($table,$item,$value){ 

        if ($item == null){

			$stmt = connection::getConnect()-> prepare("SELECT MAX($table.request_order_id)
                                                        FROM $table
                                                        ");
            $stmt->execute();
            return $stmt -> fetchALL();


        }else{

            $stmt = connection::getConnect()-> prepare("SELECT $table.purchase_order_id, purchases_purchase_order_items.quantity,purchases_products.product_name,
                                                        $table.purchase_required_order_date, purchases_purchase_order_items.price_list, purchases_suppliers.supplier_name,
                                                        purchases_purchase_order_items.product_id,purchases_purchase_order_items.supplier_id
                                                        FROM $table
                                                        INNER JOIN purchases_purchase_order_items
                                                        ON $table.purchase_order_id = purchases_purchase_order_items.purchase_order_id
                                                        INNER JOIN purchases_products
                                                        ON purchases_purchase_order_items.product_id = purchases_products.product_id
                                                        INNER JOIN purchases_suppliers
                                                        ON purchases_purchase_order_items.supplier_id = purchases_suppliers.supplier_id
                                                        WHERE $item = :$item");
            
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetchALL();
        }

        $stmt -> close();
        $stmt = null;
    }

    /*=============================================
	      INSERT REQUEST
	=============================================*/

	static public function mdlInsertPurchase($table, $data){

		$stmt = connection::getConnect()->prepare("INSERT INTO $table (
																   purchase_order_id,
                                                                   purchase_required_order_date) 
                                                                   VALUES (
																   :purchase_order_id,
                                                                   :purchase_required_order_date)");

		$stmt->bindParam(":purchase_order_id", $data["purchase_order_id"], PDO::PARAM_STR);
		$stmt->bindParam(":purchase_required_order_date", $data["purchase_required_order_date"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

  }
  

    // MOSTRAR MAX COMPRA ID

    static public function mdlShowMaxCompraId($table,$item,$value){

        if ($item == null){

			$stmt = connection::getConnect()-> prepare("SELECT MAX($table.compras_id)
                                                        FROM $table
                                                        ");
            $stmt->execute();
            return $stmt -> fetchALL();


        }else{

            $stmt = connection::getConnect()-> prepare("");
            
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetchALL();
        }

        $stmt -> close();
        $stmt = null;
    }

        /*=============================================
		INSERTAR ITEMS DE COMPRA
		=============================================*/

	static public function mdlInsertPurchaseItems($table,$data1,$data2,$data3,$data4,$data5){

		$stmt = Connection::getConnect()->prepare("INSERT INTO $table(compras_id,product_id,supplier_id,quantity,price_list) 
												   VALUES (:compras_id,:product_id,:supplier_id,:quantity,:price_list)");

		$stmt->bindParam(":compras_id", $data1, PDO::PARAM_INT);
		$stmt->bindParam(":product_id", $data2, PDO::PARAM_INT);
		$stmt->bindParam(":supplier_id", $data3, PDO::PARAM_INT);
		$stmt->bindParam(":quantity", $data4, PDO::PARAM_INT);
		$stmt->bindParam(":price_list", $data5, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
    
    /*=============================================
	BORRAR ITEMS COMPRA
	=============================================*/

	static public function mdlDeletePurchaseItems($tablePo,$datos){

        $stmt = Connection::getConnect()->prepare("DELETE FROM $tablePo 
                                               WHERE purchase_order_id = :purchase_order_id
                                               AND supplier_id = :supplier_id");

		$stmt -> bindParam(":purchase_order_id", $datos["purchase_order_id"], PDO::PARAM_INT);
		$stmt -> bindParam(":supplier_id", $datos["supplier_id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

    }
    
    /*=============================================
	MOSTRAR ORDENES DE COMPRA
    =============================================*/
    
    static public function mdlShowOrdenCompra($table,$item,$value){

        if ($item == null){
	
            $stmt = connection::getConnect()-> prepare("SELECT $table.compras_id,
                                                        SUM(purchases_orden_compras_items.quantity) AS quan,
                                                        SUM(purchases_orden_compras_items.quantity * purchases_orden_compras_items.price_list) AS costo,
                                                        $table.purchase_required_order_date
                                                        FROM $table
                                                        INNER JOIN purchases_orden_compras_items
                                                        ON $table.compras_id = purchases_orden_compras_items.compras_id
                                                        GROUP BY $table.compras_id
                                                        ORDER BY $table.compras_id DESC");
        
        $stmt->execute();
        return $stmt -> fetchAll();

        }else{

            
        }

        $stmt -> close();
        $stmt = null;
    }
    
    //MOSTRAR ALL PROVEEDOR PARA CABECERA DE PDF
    static public function mdlShowProveedorItems($table,$item,$value){

        if ($item != null){
	
        $stmt = connection::getConnect()-> prepare("SELECT $table.compras_id,
                                                    purchases_suppliers.supplier_id, purchases_suppliers.supplier_name,
                                                    purchases_suppliers.supplier_pn, purchases_suppliers.supplier_email,
                                                    purchases_suppliers.supplier_address
                                                    FROM $table
                                                    INNER JOIN purchases_suppliers
                                                    ON $table.supplier_id = purchases_suppliers.supplier_id
                                                    WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt -> fetch();

        }else{

            
        }

        $stmt -> close();
        $stmt = null;
    }

    //MOSTRAR ITEMS DE LA ORDEN DE COMPRA
    static public function mdlShowCompraItemList($table,$item,$value){

        if ($item != null){
	
        $stmt = connection::getConnect()-> prepare("SELECT $table.compras_id,
                                                    $table.quantity, $table.price_list,
                                                    purchases_products.product_name,
                                                     purchases_suppliers.supplier_name
                                                    FROM $table
                                                    INNER JOIN purchases_products
                                                    ON $table.product_id = purchases_products.product_id
                                                    INNER JOIN purchases_suppliers
                                                    ON $table.supplier_id = purchases_suppliers.supplier_id
                                                    WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt -> fetchAll();

        }else{

            
        }

        $stmt -> close();
        $stmt = null;
    }

}