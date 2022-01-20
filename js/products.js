
       // BOTON PARA ACTIVAR Y DESCONTINUAR PRODUCTOS


      let productActivatedId = document.getElementsByClassName('btn-prod-active')
        for( let i=0; i < productActivatedId.length; i++){
          let productActivated = productActivatedId[i]
           productActivated.addEventListener('click', activeProduct)
       
      }

        // FUNCION PARA ACTIVAR O DESACTIVAR PRODUCTOS

       function activeProduct(event){

        let item = event.target
        let productActiveId = item.getAttribute("product-id")
        let productStatus = item.getAttribute("product-status")

        let datos = new FormData()
        datos.append("productActiveId", productActiveId)
        datos.append("productStatus", productStatus)

            fetch('fetch/fetch.products.php',{
            method: 'POST',
            body: datos
        })

            .then(res => res.text())
            .then (_data => {
            activate(_data);
        })  


            function activate(_data){
                
                if (_data = "ok"){


                   if (productStatus == 2){

                    item.classList.remove("btn-success")
                    item.classList.add("btn-danger")
                    item.innerHTML = "Inactivo"
                    item.setAttribute("product-status", 1)

                   }else{

                    item.classList.add("btn-success")
                    item.classList.remove("btn-danger")
                    item.innerHTML = "Activo"
                    item.setAttribute("product-status", 2)


                   }
        
                }
            }
       }
       

/*=============================================
AVOIDING CREATE DUPLICATED PRODUCTS
=============================================*/
       
        
 let dupProduct = document.getElementById('product-name')
 dupProduct.addEventListener("change", checkinDuplicateProduct) 

  function checkinDuplicateProduct(event){

    let saveButton = document.getElementById('btn-save-product')
    $('.alert-rem').remove();
    saveButton.disabled = false;

     let productInput = event.target
    let product = event.target.value

    let datos = new FormData()
    datos.append("valProduct", product)

            fetch('fetch/fetch.products.php',{
            method: 'POST',
            body: datos
        })

            .then(res => res.text())
            .then (_data => {
            validating(_data);
        })

         function validating(_data){

               if(_data != "false"){

                let newNode = document.createElement('div')
                newNode.classList.add("alert")
                newNode.classList.add("alert-warning")
                newNode.classList.add("alert-rem")
                newNode.innerHTML = "<Strong>Este producto ya existe en la base de datos.</strong>"
                productInput.parentElement.after(newNode);
                productInput.value =  " ";
                saveButton.disabled = true;

            }
        }  

  }