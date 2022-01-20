<?php


  class polizasController{

  	static public function ctrInsertPoliza($value,$value1,$value2){

  		$table = "purchases_polizas";

  		$data = array("quotation_order_id" => $value,
  					  "quoter_id" => $value1,
  					  "cost_prev" => $value2);
  		
  		$answer = polizasModel::mdlInsertPoliza($table,$data);

  		return $answer;
  	}

  	 /* 
         MUESTRA POLIZAS
                                                            */

  	static public function ctrShowPolizas($item,$value){

  		$table = "purchases_polizas";

  		$answer = polizasModel::mdlShowPolizas($table,$item,$value);

  		return $answer;
  	}
 
 /* 
         MUESTRA POLIZAS POR ESTADO
                                                            */

  	static public function ctrShowPolizasStatus($item,$value){

  		$table = "purchases_polizas";

  		$answer = polizasModel::mdlShowPolizasStatus($table,$item,$value);

  		return $answer;
  	}

  	 /* 
         ACTUALIZAR BALANCE DE POLIZA
                                                            */

  	public function ctrApprovalPoliza(){

  		if (isset($_POST["poliza-id"])){


  			$table = "purchases_polizas";

  			$data1 = $_POST["quot-id"];
  			$data2 = $_POST["staff-id"];
  			$data3 = $_POST["cost-prev"];
  			$data4 = $_POST["cost-after"];
  			$data5 = 2;

  			$answer = polizasModel::mdlUpdatePoliza($table,$data,$data1,$data2,$data3,$data4,$data5);

  			if ($answer == "ok") {

  				$table = "purchases_staffs";
  				$item1 = "active";
  				$value1 = 1;
  				$item2 = "staff_id";
  				$value2 = $_POST["staff-id"];

  				$answerUpdateStaff = staffModels::mdlUpdateUserLogin($table, $item1, $value1, $item2, $value2);

  				if ($answerUpdateStaff == "ok") {
  					
	 echo '<script>
    
              swal({
    
                type: "success",
                title: "¡El balance se creo correctamente!",
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
                  title: "¡Error al crear el balance!",
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

      static public function ctrCheckPoliza($item, $value){
        
        $table = "purchases_polizas";

        $answer = polizasModel::mdlCheckPoliza($table,$item,$value);


        if ($answer != []){

        date_default_timezone_set('America/Mexico_City');

        $fechaActual = date('Y-m-d');

          for ($i = 0 ; $i < count($answer); $i++){

          $fechaComparar = date('Y-m-d',strtotime($answer[$i]["date"]."+ 2 days"));

          if($fechaComparar == $fechaActual){
        
          $table = "purchases_staffs";
          $item1 = "active";
          $value1 = 3;
          $item2 = "staff_id";
          $value2 = (int)$answer[$i]["quoter_id"];

          $answer2 = staffModels::mdlUpdateUserLogin($table, $item1, $value1, $item2, $value2);

          return $answer2;

          }
          }


        }else{


          return "Array vacio";
        }


       
        
      } 
  	
  }	