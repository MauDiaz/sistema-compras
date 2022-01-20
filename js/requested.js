// BOTON PARA ABRIR DETALLE DE REQUISICION POR ID

let requestedButton = document.getElementsByClassName('requested-btn')
for (let i = 0; i< requestedButton.length; i++){
    let requestedB = requestedButton[i]
    requestedB.addEventListener('click', requestedId)
}

// BOTON PARA ACTIVAR REQUISICION

let toActiveButton = document.getElementsByClassName('btn-to-active')
for (let i = 0; i< toActiveButton.length; i++){
    let activeButton = toActiveButton[i]
    activeButton.addEventListener('click', toActiveRequesting)
}

// BOTON PARA DESACTIVAR REQUISICION

let toInactiveButton = document.getElementsByClassName('btn-to-inactive')
for (let i = 0; i< toInactiveButton .length; i++){
    let inactiveButton = toInactiveButton [i]
    inactiveButton.addEventListener('click', InactiveRequesting)
}


// FUNCION QUE ABRE DETALLE DE REQUISICION
function requestedId(event){

    requestedId = event.target
    requested = requestedId.innerText
    window.location = "index.php?ruta=rodetails&requested="+requested
} 

// FUNCION QUE ACTIVA UNA REQUISICION CERRADA

function toActiveRequesting(event){

	active = event.target
	orderIdA = active.parentElement.parentElement.parentElement.children[0].innerText
	
	let datos = new FormData()
	datos.append("orderIdA",orderIdA)

	fetch('fetch/fetch.statuses.php',{
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
                    title: "La requisicion se activo correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=rostatus";

                              }
                          })
            }
        }
}

// FUNCION QUE DESACTIVA UNA REQUISICION ABIERTA

function InactiveRequesting(event){

	inactive = event.target
	orderIdI = inactive.parentElement.parentElement.parentElement.children[0].innerText
	
	
	let datos = new FormData()
	datos.append("orderIdI",orderIdI)

	fetch('fetch/fetch.statuses.php',{
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
                    title: "La requisicion se cerro correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=rostatus";

                              }
                          })
            }
        }
}

 

