// BOTON PARA ABRIR DETALLE DE APROBACION POR ID

let aprovedButton = document.getElementsByClassName('aproved-btn')
for (let i = 0; i< aprovedButton.length; i++){
    let aprovedB = aprovedButton[i]
    aprovedB.addEventListener('click', aprovalDetails)
}

// BOTON PARA RECHAZAR UNA COTIZACION

let rejectButton = document.getElementsByClassName('btn-reject-quot')
for (let i = 0; i< rejectButton.length; i++){
    let rejectB = rejectButton[i]
    rejectB.addEventListener('click', rejectQuotation)
}

// BOTON PARA ACEPTAR UNA COTIZACION Y CREAR UNA ORDEN DE COMPRA

let approvalButton = document.getElementsByClassName('btn-approval-quot')
for (let i = 0; i< approvalButton.length; i++){
    let approvalB = approvalButton[i]
    approvalB.addEventListener('click', approvalQuotation) 
}

// BOTONES PARA ACTUALIZAR EL COSTO TOTAL DE MANERA SINCRONA EN LA LISTA DE APROBACION
let updateForQuantity2 = document.getElementsByClassName('update-quantity-row-2')
     for( let i=0; i < updateForQuantity2.length; i++){
         let updateSeleccion2 = updateForQuantity2[i]
         updateSeleccion2.addEventListener('change', updateQuantity2)
        }

// BOTON PARA ELIMINAR ARTICULO ANTES DE APROBAR LA COTIZACION

let prodDeleteApprovalButton = document.getElementsByClassName('btn-delete-appro-prod')
for (let i = 0; i< prodDeleteApprovalButton.length; i++){
    let deleteApprovalB = prodDeleteApprovalButton[i]
    deleteApprovalB.addEventListener('click', deleteProductApproval)
}


// FUNCION QUE ABRE DETALLE DE APROBACION

function aprovalDetails(event){

    aprovedId = event.target
    aproved = aprovedId.innerText
    window.location = "index.php?ruta=aodetails&aproved="+aproved
} 

// FUNCION QUE RECHAZA UNA COTIZACION

function rejectQuotation(event){

    let reject = event.target
    let quotationId = document.getElementById("appr-id").value
    let statusValue = 3

    let datos = new FormData()
    datos.append("quotationId",quotationId)
    datos.append("statusValue",statusValue)

    fetch('fetch/fetch.approvals.php',{
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
                    title: "Cotizacion Rechazada Correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=aostatus";

                              }
                          })
            }
        }
}

     // FUNCION PARA ELIMINAR ARTICULO ANTES DE APROBAR COTIZACION


      function deleteProductApproval(event){

            let table = document.getElementById('aprobation-table')

            let rows = table.tBodies[1].rows.length 

            if (rows == 1){

              swal({
                    type: "error",
                    title: "Solo queda un articulo, por favor rechaza la cotizacion",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){

                         if (result.value) {

                              document.getElementById('btn-reject-quot').focus()

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
            
        let updateButton = event.target
        let quotId = document.getElementById("appr-id").value
        let prodId = updateButton.parentElement.parentElement.parentElement.cells[1].innerText

        let datos = new FormData()
        datos.append("quotId",quotId)
        datos.append("prodId",prodId)
        
        fetch('fetch/fetch.approvals.php',{
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

// FUNCION QUE APRUEBA UNA COTIZACION Y CREA UNA ORDEN DE COMPRA.


function approvalQuotation(event){

    let approval = event.target
    let productsArray = []

    let productsInArray = document.getElementsByClassName('appr-det-list')

     for (let i=0; i<productsInArray.length; i++){

        let quan = parseInt(productsInArray[i].cells[0].children[0].value)
        let prodId = productsInArray[i].cells[1].innerText
        let price = parseFloat(productsInArray[i].cells[5].innerText)

            productsArray.push({
                   
                    "product_id": prodId,
                    "quantity": quan,
                    "price_list": price

                        })
        }
        
        let inputArray = document.createElement('input')
        inputArray.classList.add('d-none')
        inputArray.setAttribute('name','input-array')
        inputArray.value = JSON.stringify(productsArray)
        let newArrayInput = document.getElementById('aproved-array')
        newArrayInput.append(inputArray)
    }

    // FUNCION PARA ACTUALIZAR EL COSTO TOTAL CUANDO SE MODIFICA LA CANTIDAD

  function updateQuantity2(event){

    let item = event.target
    let quantity = item.value
    let price = item.parentElement.parentElement.cells[5].innerText
    if (price != ""){

        let total = quantity * price
        let realTotal = total.toFixed(2)
        item.parentElement.parentElement.cells[6].innerText = realTotal
    }else{

        item.parentElement.parentElement.cells[6].innerText = 0.00

    }
  }


 
