
//BOTON PARA EDITAR USUARIO

  let userEditBtn = document.getElementsByClassName("btn-edit-user")
  for (i =  0; i < userEditBtn.length; i++){
    let userEdit = userEditBtn[i]
    userEdit.addEventListener('click', editUser)
  }


/*=============================================
EDIT USER
=============================================*/

 function editUser(event){

    idBtn = event.target.getAttribute("id-user")

     let datos = new FormData()
     datos.append("idBtn", idBtn)

        fetch('fetch/fetch.staff.php',{
            method: 'POST',
            body: datos
        })

            .then(res => res.json())
            .then (_data => {
            Edit(_data);
        })  

        function Edit(_data){

            console.log(_data)

           document.getElementById("user-edit-name").value = _data["staff_name"]
           document.getElementById("user-edit-email").value = _data["staff_email"]
           document.getElementById("user-edit-pn").value = _data["staff_pnumber"]
           // document.getElementById("user-edit-company").innerHTML = _data["branch_id"]
           document.getElementById("user-edit-company").innerHTML = _data["branch_name"]

           // document.getElementById("user-edit-department").innerHTML = _data["department_id"]
           document.getElementById("user-edit-department").innerHTML = _data["department_name"]

           // document.getElementById("user-edit-job").innerHTML = _data["position_id"]
           document.getElementById("user-edit-job").innerHTML = _data["position_name"]
           
           // document.getElementById("user-edit-rol").innerHTML = _data["role_id"]
           document.getElementById("user-edit-rol").innerHTML = _data["role_name"]

           // document.getElementById("user-edit-status").innerHTML = _data["active"]
           document.getElementById("user-edit-status").innerHTML = _data["status_name"]


           if(_data["staff_photo"] != "" ){

           document.getElementById('preview2').setAttribute("src", _data["staff_photo"] ) 

     


            }

        }
  
 }




/*=============================================
UPLOADING PHOTO USER
=============================================*/

 let newPhoto = document.getElementById('user-photo')
 let previewImage = document.getElementById('preview')
 newPhoto.addEventListener('change', changePhoto)
    
 function changePhoto(event){

    let image = event.target.files[0];

    //validating image format

    if(image["type"] != "image/jpeg" && image["type"] != "image/png"){

        newPhoto.value = ""

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });

        //   VALIDATING IMAGE SIZE

    }else if(image["size"] > 2000000){

         newPhoto.value = ""

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });
    } else if (image){
         
        const reader = new FileReader();
        reader.readAsDataURL(image);
        
        reader.addEventListener("load",function(){
        previewImage.setAttribute("src",this.result);
        });
        

    }
    
}   	

/*=============================================
REMOVING USER FROM CATALOG
=============================================*/

// let user = document.getElementsByClassName('btn-remove-user')
//    for( let i=0; i < user.length; i++){
//        let idUser = user[i]
//        idUser.addEventListener('click', removeUser)
         
//       }

//       // remove unit row from catalog

//     function removeUser(event){

//         item = event.target;
//         staffId = item.parentElement.parentElement.parentElement.children[0].innerText
//         let datos = new FormData()
//         datos.append('staffId', staffId)
        
//         fetch('fetch/fetch.staff.php',{
//             method: 'POST',
//             body: datos
//         })
//         .then(res => res.text())
//         .then (_data => {
//             eliminar(_data);
//         })    

//         function eliminar(_data){

//             if(data = "ok"){

//                 swal({
//                     type: "success",
//                     title: "La Usuario ha sido eliminado correctamente",
//                     showConfirmButton: true,
//                     confirmButtonText: "Cerrar"
//                     }).then(function(result){
//                               if (result.value) {

//                               window.location = "index.php?ruta=users";

//                               }
//                           })
//             }
//         }

//     }
/*=============================================
ACTIVATING AND DEACTIVATING USER
=============================================*/

let userId = document.getElementsByClassName('btn-active')
   for( let i=0; i < userId.length; i++){
       let user = userId[i]
       user.addEventListener('click', activeUser)
         
      }

       // active or deactive user

       function activeUser(event){

        let item = event.target
        let staffId = item.getAttribute("staff-id")
        let staffStatus = item.getAttribute("staff-status")

        let datos = new FormData()
        datos.append("staffId", staffId)
        datos.append("staffStatus", staffStatus)

            fetch('fetch/fetch.staff.php',{
            method: 'POST',
            body: datos
        })

            .then(res => res.text())
            .then (_data => {
            activate(_data);
        })  


            function activate(_data){
                
                if (_data = "ok"){


                   if (staffStatus == 2){

                    item.classList.remove("btn-success")
                    item.classList.add("btn-danger")
                    item.innerHTML = "Inactivo"
                    item.setAttribute("staff-status", 1)

                   }else{

                    item.classList.add("btn-success")
                    item.classList.remove("btn-danger")
                    item.innerHTML = "Activo"
                    item.setAttribute("staff-status", 2)


                   }
        
                }
            }
       }

/*=============================================
AVOIDING USER EMAIL DUPLICATED AT CREATE USER STAFF
=============================================*/

 let dupEmail = document.getElementById('user-email')
 dupEmail.addEventListener("change", checkinUserEmail) 
 

function checkinUserEmail(event){

    let saveButton = document.getElementById('btn-save-user')
    $('.alert-rem').remove();
    saveButton.disabled = false;

    let emailInput = event.target
    let email = event.target.value

    let datos = new FormData()
    datos.append("valEmail", email)

            fetch('fetch/fetch.staff.php',{
            method: 'POST',
            body: datos
        })

            .then(res => res.text())
            .then (_data => {
            validate(_data);
        })  

        function validate(_data){


            if(_data != "false"){

                let newNode = document.createElement('div')
                newNode.classList.add("alert")
                newNode.classList.add("alert-warning")
                newNode.classList.add("alert-rem")
                newNode.innerHTML = "<Strong>Este email ya existe en la base de datos.</strong>"
                emailInput.parentElement.after(newNode);
                emailInput.value =  " ";
                saveButton.disabled = true;

            }
        }
}
