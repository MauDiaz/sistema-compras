  
// BOTONES

   ////// BOTON PARA IMPRIMIR REQUISICIONES //////.

    let printReqOrder = document.getElementsByClassName('btn-req-print')
    for (let i = 0; i< printReqOrder.length; i++){
        let printReqBtn = printReqOrder[i]
        printReqBtn.addEventListener('click', printReq) 
    }

    ////// BOTON PARA IMPRIMIR COTIZACIONES //////.

    let printQuotOrder = document.getElementsByClassName('btn-quot-print')
    for (let i = 0; i< printQuotOrder.length; i++){
        let printQuotBtn = printQuotOrder[i]
        printQuotBtn.addEventListener('click', printQuot) 
    }
 

 // FUNCIONES

 	 ////// FUNCION PARA MANDAR A IMPRIMIR REQUISICIONES //////.

 function printReq(event){

    printRequesting = event.target

    let reqId = printRequesting.parentElement.parentElement.parentElement.children[0].innerText

     window.open("extensiones/tcpdf/pdf/requisicion.php?reqId="+reqId, "_blank")   
} 

 ////// FUNCION PARA MANDAR A IMPRIMIR COTIZACIONES //////.

 function printQuot(event){

    printQuoting = event.target

    let quotId = printQuoting.parentElement.parentElement.parentElement.children[0].innerText

     window.open("extensiones/tcpdf/pdf/cotizacion.php?quotId="+quotId, "_blank")   
} 

 