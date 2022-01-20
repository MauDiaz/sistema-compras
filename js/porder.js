// BOTON PARA ABRIR DETALLE DE LA ORDEN DE COMPRA POR ID

let poButton = document.getElementsByClassName('po-btn')
for (let i = 0; i< poButton.length; i++){
    let poB = poButton[i]
    poB.addEventListener('click', poDetails)
}


// FUNCION QUE ABRE DETALLE DE LA ORDEN DE COMPRA POR ID

function poDetails(event){

    poId = event.target
    po = poId.innerText
    window.location = "index.php?ruta=podetails&po="+po
}