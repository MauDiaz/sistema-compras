  // EJECUTAR FUNCION CADA 24 HRS PARA VER SI LA POLIZA HA SIDO PAGADA ///////


 
    window.onload = function (){

        setTimeout('funcionProgramada()', damehora());
       
    }

    function damehora(){


        horaActual = new Date();
        horaProgramada = new Date();
        horaProgramada.setHours(23);
        horaProgramada.setMinutes(0);
        horaProgramada.setSeconds(0);
        return horaProgramada.getTime() - horaActual.getTime();  
        

    }

    function funcionProgramada(){

    let status = 1
    let datos = new FormData()
    datos.append("status",status)

    fetch('fetch/fetch.poliza.php',{
            method: 'POST',
            body: datos
        })
        .then(res => res.text())
        .then (data => {
            console.log(data)
          // denote(data);
        }) 

        

    }



    ///// BOTON PARA CANCELAR EL BALANCE DE LAS POLIZAS //////

let cancelPolizaButton = document.getElementsByClassName('btn-reject-poliza') 

 for (let i=0; i<cancelPolizaButton.length; i++){
     let cancelPol = cancelPolizaButton[i]
     cancelPol.addEventListener('click',cancelPoliza)
     }


     ////// BOTON PARA IMPRIMIR POLIZAS DE EGRESOS //////.

    let printDocOrder = document.getElementsByClassName('btn-doc-print')

    for (let i = 0; i < printDocOrder.length; i++){
        let printDocBtn = printDocOrder[i]
        printDocBtn.addEventListener('click', printDoc) 
    }

    	 ////// BOTON PARA IMPRIMIR POLIZAS DE EGRESOS //////.

    let polizaBtn = document.getElementsByClassName('btn-poliza')

    for (let i = 0; i < polizaBtn.length; i++){
        let polBtn = polizaBtn[i]
        polBtn.addEventListener('click', poliza) 
    }


     ////// BOTON PARA ABRIR POLIZAS DE EGRESOS CERRADAS //////.

    let polizaBtn2 = document.getElementsByClassName('btn-poliza-2')

    for (let i = 0; i < polizaBtn2.length; i++){
        let polBtn2 = polizaBtn2[i]
        polBtn2.addEventListener('click', poliza2) 
    }


 // FUNCIONES


 ////// FUNCION PARA MANDAR A IMPRIMIR POLIZAS DE EGRESOS//////.

 function printDoc(event){

    printDocument = event.target

    let docId = printDocument.parentElement.parentElement.parentElement.children[0].innerText
    let quoterId =  printDocument.parentElement.parentElement.parentElement.children[8].innerText
    let costo = printDocument.parentElement.parentElement.parentElement.children[10].innerText

    let datos = new FormData()
    datos.append("quotId",docId)
    datos.append("quoterId",quoterId)


 	fetch('fetch/fetch.poliza.php',{
            method: 'POST',
            body: datos
        })
        .then(res => res.json())
        .then (data => {
        	console.log(data)
          response(data);
        })  

     function response(data){

     	if (data === false){

     		let datosToInsert = new FormData()
     		datosToInsert.append("quotId2", docId)
     		datosToInsert.append("quoterId2", quoterId)
     		datosToInsert.append("costo", costo)

		fetch('fetch/fetch.poliza.php',{
            method: 'POST',
            body: datosToInsert
        })
        .then(res => res.text())
        .then (_data => {
            console.log(_data)
          insert(_data);

        })

        function insert(_data){

        	if (_data === "ok"){

			 swal({
	            type: "success",
	            title: "Poliza creada Correctamente",
	            showConfirmButton: true,
	            confirmButtonText: "Cerrar"
	            }).then(function(result){
	                      
	                      if (result.value) {

	                      window.open("extensiones/tcpdf/pdf/poliza.php?docId="+docId, "_blank")  

	                      }
	                  })
        	}

        }

     	}
     	else{

     		window.open("extensiones/tcpdf/pdf/poliza.php?docId="+docId, "_blank")   
     	}
     }
} 

function poliza(event){

	let poliza = event.target.innerText
	window.location = "index.php?ruta=polizadetails&poliza="+poliza
}

function poliza2(event){

	let poliza = event.target.innerText
	window.location = "index.php?ruta=polizadetailed&poliza="+poliza
}


//////// EDITAR EL HABER y DEBER EN LA POLIZA DE EGRESOS////////


 const haber = document.getElementById('cost-after')
 haber.addEventListener('keypress', function (e){
 		  if ( e.which == 13 ) e.preventDefault();
 	})
 haber.addEventListener('change', balance)


 function balance(event){

 	bal = event.target.value
 	
 	let debe = document.getElementById('cost-prev').value
 	
 	let total = debe - bal
 	
 	document.getElementById('balance').value = total.toFixed(2)

 }

//// cancel Poliza by click event ///////

 function cancelPoliza(event){    

        cancelButton = event.target
        window.location = "index.php?ruta=polizas"
    }


  