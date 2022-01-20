// BOTON PARA ABRIR DETALLE DE CONSIGNACION POR ID

let consigButton = document.getElementsByClassName('consig-btn')
for (let i = 0; i< consigButton.length; i++){
    let consigB = consigButton[i]
    consigB.addEventListener('click', consigDetails)
}

// BOTON PARA ABRIR CANCELAR CONSIGNACION Y REGRESAR AL INICIO

let consigRejectButton = document.getElementsByClassName('btn-reject-consig')

for (let i = 0; i< consigRejectButton.length; i++){
    let consigReject = consigRejectButton[i]
    consigReject.addEventListener('click', consigRejectDet)
}

// FUNCION QUE ABRE DETALLE DE APROBACION

function consigDetails(event){

    consigId = event.target
    consig = consigId.innerText
    window.location = "index.php?ruta=consigdetails&consig="+consig
} 


function consigRejectDet(event){

	reject = event.target

                swal({
                    type: "success",
                    title: "Ajuste cancelado, por favor ajuste la orden de compra en otro momento",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=inicio";

                              }
                          })
}