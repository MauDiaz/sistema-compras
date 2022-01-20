
// BOTON PARA ABRIR EL CORREO ELECTRONICO

let mailButton = document.getElementsByClassName('btn-quot-email')
for (let i = 0; i< mailButton.length; i++){
    let mailB = mailButton[i]
    mailB.addEventListener('click', mailCompose)
}

// BOTON PARA ABRIR DETALLE DE COTIZACION POR ID

let quotedButton = document.getElementsByClassName('quoted-btn')
for (let i = 0; i< quotedButton.length; i++){
    let quotedB = quotedButton[i]
    quotedB.addEventListener('click', quotedId)
}

// BOTON PARA CERRAR UNA COTIZACION Y ENVIARLA PARA SU APROBACION

let closeQuotationButton = document.getElementsByClassName('btn-close-quot')
    closeQuotationButton[0].addEventListener('click', closeQuotation)

// BOTON PARA ACTUALIZAR PRECIO Y CANTIDAD POR ARTICULO ANTES DE CERRAR LA COTIZACION

let prodUpdateButton = document.getElementsByClassName('btn-update-prod')
for (let i = 0; i< prodUpdateButton.length; i++){
    let updateB = prodUpdateButton[i]
    updateB.addEventListener('click', updateProduct)
}

// BOTON PARA ELIMINAR ARTICULO ANTES DE CERRAR LA COTIZACION

let prodDeleteButton = document.getElementsByClassName('btn-delete-prod')
for (let i = 0; i< prodDeleteButton.length; i++){
    let deleteB = prodDeleteButton[i]
    deleteB.addEventListener('click', deleteProduct)
}

// BOTONES PARA ACTUALIZAR EL COSTO TOTAL DE MANERA ASINCRONA EN LA LISTA DE COTIZACION

let updateForQuantity = document.getElementsByClassName('update-quantity-row')
     for( let i=0; i < updateForQuantity.length; i++){
         let updateSeleccion = updateForQuantity[i]
         updateSeleccion.addEventListener('change', updateQuantity)
        }

 let updateForPrice = document.getElementsByClassName('update-price-row')
     for( let i=0; i < updateForPrice.length; i++){
         let update = updateForPrice[i]
         update.addEventListener('change', updatePrice)
        }

// 
//  FUNCIONES 
// 

// FUNCION QUE ABRE DETALLE DE COTIZACION POR ID
function quotedId(event){

    quotedId = event.target
    quoted = quotedId.innerText
    window.location = "index.php?ruta=quodetails&quoted="+quoted
} 

// FUNCION QUE CIERRA UNA COTIZACION PARA ENVIARLA A SU APROBACION

  function closeQuotation(event){

  	let closeQuotationBtn = event.target
  	let productsArray = []

  	let productsInArray = document.getElementsByClassName('quo-det-list')

  	 for (let i=0; i<productsInArray.length; i++){

        let quan = parseInt(productsInArray[i].cells[0].children[0].value)
        let prodId = productsInArray[i].cells[1].innerText
        let price = parseFloat(productsInArray[i].cells[5].children[0].value)
        let priceInput = productsInArray[i].cells[5].children[0]

    if (price == 0 || price == ""){

    		event.preventDefault()
                
        swal({
            type: "warning",
            title: "Para cerrar una cotizacion se deben capturar los precios de todos los productos",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          })

        priceInput.style.borderColor = "red"
        priceInput.focus()
        return
        
    	}else{

    		productsArray.push({
                   
                    "product_id": prodId,
                    "quantity": quan,
                    "price_list": price

                        })
        }
    	}
		let inputArray = document.createElement('input')
        inputArray.classList.add('d-none')
        inputArray.setAttribute('name','input-array')
        inputArray.value = JSON.stringify(productsArray)
        let newArrayInput = document.getElementById('quoted-array')
        newArrayInput.append(inputArray)
    }

    // FUNCION PARA ACTUALIZAR PRECIO Y CANTIDAD POR ARTICULO ANTES DE CERRAR COTIZACION


      function updateProduct(event){

      	let updateButton = event.target
      	let quotationId = document.getElementById("quot-id").value
      	let quantity = updateButton.parentElement.parentElement.parentElement.cells[0].children[0].value
      	let productId = updateButton.parentElement.parentElement.parentElement.cells[1].innerText
      	let priceList = updateButton.parentElement.parentElement.parentElement.cells[5].children[0].value

      	let datos = new FormData()
      	datos.append("quotationId",quotationId)
      	datos.append("quantity",quantity)
      	datos.append("productId",productId)
      	datos.append("priceList",priceList)
      	
      	fetch('fetch/fetch.quoting.php',{
            method: 'POST',
            body: datos
        })
        .then(res => res.text())
        .then (data => {
            update(data);
        })  
 			
 			function update(data){

            if(data = "ok"){

                swal({
                    type: "success",
                    title: "Articulo actualizado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                             
                          })
            }
        }

      }

       // FUNCION PARA ELIMINAR ARTICULO ANTES DE CERRAR COTIZACION


      function deleteProduct(event){

      	let updateButton = event.target
      	let quotId = document.getElementById("quot-id").value
      	let prodId = updateButton.parentElement.parentElement.parentElement.cells[1].innerText

         let table = document.getElementById('quotation-table')

         let rows = table.tBodies[1].rows.length

         if (rows == 1){

              swal({
                    type: "error",
                    title: "Solo queda un articulo, por favor cancela la cotizacion",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){

                         if (result.value) {

                              document.getElementById('btn-cancel-quoted').focus()

                              }
                             
                          })

            }else {

            swal({

            title: 'Esta seguro de eliminar el articulo?',
            text: "Si no lo esta puede cancelar la accion!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar articulo!'
            }).then(function(result){

               if (result.value) {

                   let datos = new FormData()
                       datos.append("quotId",quotId)
                       datos.append("prodId",prodId)
                        
                       fetch('fetch/fetch.quoting.php',{
                            method: 'POST',
                            body: datos
                        })
                        .then(res => res.text())
                        .then (data => {
                            update(data);
                        })  
                      
                      function update(data){

                            if(data = "ok"){

                                swal({
                                    type: "success",
                                    title: "Articulo eliminado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result){

                                      if (result.value) {

                                              location.reload();

                                              }
                                             
                                          })
                            }
                        }

                  }


            })


          }

    
      }

// FUNCION PARA ACTUALIZAR EL COSTO TOTAL CUANDO SE MODIFICA LA CANTIDAD

  function updateQuantity(event){

    let item = event.target
    let quantity = item.value
    let price = item.parentElement.parentElement.cells[5].children[0].value
    if (price != ""){

        let total = quantity * price
        let realTotal = total.toFixed(2)
        item.parentElement.parentElement.cells[6].innerText = realTotal
    }else{

        item.parentElement.parentElement.cells[6].innerText = 0.00

    }
  }


  // FUNCION PARA ACTUALIZAR EL COSTO TOTAL CUANDO SE MODIFICA EL PRECIO

  function updatePrice(event){

    let item = event.target
    let price = item.value
    let quantity = item.parentElement.parentElement.cells[0].children[0].value
    if (price != ""){

        let total = quantity * price
        let realTotal = total.toFixed(2)
        item.parentElement.parentElement.cells[6].innerText = realTotal
        item.value = price
    }else{

        item.parentElement.parentElement.cells[6].innerText = 0.00

    }
  }


// FUNCION PARA COMPONER EL EMAIL

function mailCompose(event){

  let email = event.target

  let emailId = email.parentElement.parentElement.parentElement.children[0].children[0].innerText

  let datos = new FormData()
  datos.append("emailId",emailId)

  fetch('fetch/fetch.quoting.php',{
      method: 'POST',
      body: datos
  })
  .then(res => res.json())
  .then (data => {
      emailing(data);
  }) 

  function emailing(data){
    document.getElementById('receiver').value = data.supplier_email
  } 
}


