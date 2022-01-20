let requestButton = document.getElementsByClassName('request-type')
for (let i = 0; i< requestButton.length; i++){
    let requestB = requestButton[i]
    requestB.addEventListener('click', requestType)
}

function requestType(event){

    requestType = event.target
    request = requestType.innerText
    window.location = "index.php?ruta=requesting&request="+request
} 
