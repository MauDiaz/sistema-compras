<?php

  class staffController {

   
  /*=============================================
      USER LOGIN
	=============================================*/

	static public function ctrLoginStaff(){

		if(isset($_POST["email-user"])){
			
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["pass-user"]) ){
				
          // $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$table = "purchases_staffs";

				$item = "password";
				$value = $_POST["pass-user"];
				$answer = staffModels::mdlShowStaff($table,$item,$value);
			
				if($answer["staff_email"] == $_POST["email-user"] && $answer["password"] == $_POST["pass-user"]){

					if($answer["active"] == 1){

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $answer["staff_id"];
						$_SESSION["name"] = $answer["staff_name"];
						$_SESSION["email"] = $answer["staff_email"];
						$_SESSION["branch"] = $answer["branch_id"];
						$_SESSION["position"] = $answer["position_id"];
						$_SESSION["photo"] = $answer["staff_photo"];
						$_SESSION["department"] = $answer["department_id"];
						$_SESSION["role"] = $answer["role_id"];
						$_SESSION["rol"] = $answer["role_id"];

						/*=============================================
						CATCHIN' LAST LOGIN 
						=============================================*/

						date_default_timezone_set('America/Mexico_City');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "last_login";
						$value1 = $fechaActual;

						$item2 = "staff_id";
						$value2 = $answer["staff_id"];

						$lastLogin = staffModels::mdlUpdateUserLogin($table, $item1, $value1, $item2, $value2);

						if($lastLogin == "ok"){

							echo '<script>

								window.location = "inicio";

							</script>';

						}				
						
					}elseif ($answer["active"] == 3) {
						

						echo '<br>
							<div class="alert alert-danger">Usuario inactivo por falta de comprobacion de gastos</div>';
					}else{

						echo '<br>
							<div class="alert alert-danger">El usuario inactivo o dado de baja</div>';

					}		

				}else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

			}	

		}

	}

    
    static public function ctrShowStaffCoDep($item, $value){

        $table = "purchases_staffs";
        $answer = staffModels::mdlShowStaffCoDep($table,$item,$value);
        return $answer;
    } 

    static public function ctrShowStaff($item, $value){

        $table = "purchases_staffs";
        $answer = staffModels::mdlShowStaff($table,$item,$value);  
        return $answer;
    } 

  /*=============================================
	 CREATE USER STAFF
	=============================================*/

	static public function ctrCreateStaff(){

		if(isset($_POST["user-name"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["user-name"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["user-pass"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["user-pin"])){

        /*=============================================
				VALIDATING IMAGE
        =============================================*/
          
        $rute = "";

				if(isset($_FILES["user-photo"]["tmp_name"])){
          
          				list($widht, $height) = getimagesize($_FILES["user-photo"]["tmp_name"]);

					$newWidht = 500;
					$newHeight = 500;

					/*=============================================
					CREATING DIRECTORY
					=============================================*/

					$directory = "img/users/".$_POST["user-name"];

					mkdir($directory, 0755);

					/*=============================================
					CHECKING IMAGE JPEG 
					=============================================*/

					if($_FILES["user-photo"]["type"] == "image/jpeg"){          
            
						/*=============================================
						SAVING IMAGE IN DIRECTORY
						=============================================*/

						$random = mt_rand(100,999);

						$rute = "img/users/".$_POST["user-name"]."/".$random.".jpg";

						$source = imagecreatefromjpeg($_FILES["user-photo"]["tmp_name"]);			

						$to = imagecreatetruecolor($newWidht, $newHeight);

						imagecopyresized($to,$source , 0, 0, 0, 0, $newWidht, $newHeight, $widht, $height);

						imagejpeg($to, $rute);

          }

          /*=============================================
					CHECKING IMAGE PNG
          =============================================*/
          
					if($_FILES["user-photo"]["type"] == "image/png"){

						/*=============================================
						SAVING IMAGE ON DIRECTORY
						=============================================*/

						$random = mt_rand(100,999);

						$rute = "img/users/".$_POST["user-name"]."/".$random.".png";

						$source = imagecreatefrompng($_FILES["user-photo"]["tmp_name"]);					

						$to = imagecreatetruecolor($newWidht, $newHeight);

						imagecopyresized($to, $source, 0, 0, 0, 0, $newWidht, $newHeight, $widht, $height);

						imagepng($to, $rute);

          }
          
          $table = "purchases_staffs";

          // $crypting = crypt($_POST["user-pass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
  
          $data = array("staff_name" => $_POST["user-name"],
                       "staff_pnumber" => $_POST["user-pn"],
                       "staff_email" => $_POST["user-email"],
                       "branch_id" => $_POST["user-company"],
                       "position_id" => $_POST["user-job"],
                       "active" => $_POST["user-status"],
                       "password" => $_POST["user-pass"],
                       "pin_number" => $_POST["user-pin"],
                       "staff_photo" => $rute,
                       "department_id" => $_POST["user-department"],
                       "role_id"=>$_POST["user-rol"]);

          $answer = staffModels::mdlCreateStaff($table,$data);

          if($answer == "ok"){
  
            echo '<script>
  
            swal({
  
              type: "success",
              title: "¡El usuario ha sido guardado correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
  
            }).then(function(result){
  
              if(result.value){
              
                window.location= "index.php?ruta=users";
  
              }
  
            });
          
  
            </script>';
  
  
          }else{

            echo '<script>
    
              swal({
    
                type: "error",
                title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
    
              }).then(function(result){
    
                if(result.value){
                
                  window.location= "index.php?ruta=users";
    
                }
    
              });
            
    
            </script>';
    
          }
               
                      } //ELSE DEL PHOTO ISSET

         }else{// else del pregmatch

         }

    }else{ // else del isset



    }


    }
        /*=============================================
          REMOVING USER
        =============================================*/
        
        static public function ctrRemoveStaff($item,$value){

          $table = "purchases_staffs";

          $answer = staffModels::mdlRemoveStaff($table,$item,$value);
          return $answer;
        }

}