
// BOTON PARA CONSULTA DE ARTICULOS POR NUMERO DE ARTICULO

let inputByNumber = document.getElementsByClassName('input-number') 
  inputByNumber[0].addEventListener('keyup', function(e){
      if (e.keyCode === 13){
    document.getElementsByClassName('sel-item-btn')[0].click()
    
    }
  })

 let item = document.getElementsByClassName('sel-item-btn')
 for( let i=0; i < item.length; i++){
     let idItem = item[i]
     idItem.addEventListener('click', selItemByNumber)
   }

// BOTON PARA CONSULTA DE ARTICULOS POR NOMBRE DE ARTICULO

let inputByName = document.getElementsByClassName('input-name') 
inputByName[0].addEventListener('keyup', function(e){
    if (e.keyCode === 13){
  document.getElementsByClassName('nom-item-btn')[0].click()
  
  }
})

let itemByName = document.getElementsByClassName('nom-item-btn')
  for( let i=0; i < itemByName.length; i++){
       let idItemByName = itemByName[i]
      idItemByName.addEventListener('click', selItemByName)
}

// BOTON PARA CANCELAR LA REQUISICION

 let cancelRequestButton = document.getElementsByClassName('btn-cancel-req') //getting cancel request button from all posibles in the DOM 

 for (let i=0; i<cancelRequestButton.length; i++){
     let cancelReq = cancelRequestButton[i]
     cancelReq.addEventListener('click',cancelRequest)
     }

// BOTON PARA REALIZAR LA REQUISICION  

let submitRequestButton = document.getElementsByClassName('btn-submit-req') //getting submit request button from all posibles in the DOM 

for (let i=0; i<submitRequestButton.length; i++){
    let submitReq = submitRequestButton[i]
    submitReq.addEventListener('click',submitRequest)
    }

//METODOS

      // FUNCION PARA CONSULTA DE ARTICULOS POR NUMERO DE ARTICULO

        function selItemByNumber(event){
  
          let itemToSel = event.target
          let itemId = itemToSel.parentElement.parentElement.children[0].value
          let content = document.querySelector("#product-list-item")
          let datos = new FormData()
          datos.append('itemId',itemId)
  
          fetch('fetch/fetch.products.php',{
              method: 'POST',
              body: datos
          })
          .then(res => res.json())
          .then (_data => {
              fill(_data);
          })    
  
          function fill(_data){
            
              content.innerHTML = ''
              for (let value of _data){
  
                  content.innerHTML += 
                  `<tr class="item-row text-center">
                  <td class="d-none">${value.product_id}</td>
                  <td><strong>${value.product_name}</strong></td>
                  <td><input type="number" value="1"name="" min="1" id=""></td>
                  <td>${value.meassure_unit_name}</td>
                  <td class="d-flex justify-content-around"><button type="button" class="reqBtn1 btn btn-sm btn-outline-primary">+</button></td>
                  </tr>`
             
                }

                let requestButton2 = document.getElementsByClassName('reqBtn1')
                    for (let i=0; i<requestButton2.length; i++){                  
                    let reqButton2 = requestButton2[i]
                    reqButton2.addEventListener('click',rowRequest2)
                    }

                    function rowRequest2(event){

                        let reqBtn = event.target
                        let productId = reqBtn.parentNode.parentNode.cells[0].innerText
                        let product = reqBtn.parentNode.parentNode.cells[1].innerText
                        let quantity = reqBtn.parentNode.parentNode.cells[2].children[0].value
                        let unit = reqBtn.parentNode.parentNode.cells[3].innerText

                        let table = document.querySelector('#requesting-list')
                        let proDesc = table.getElementsByClassName('pro-desc')

                        for(let i =0; i< proDesc.length; i++){

                            if (proDesc[i].innerText === product){
                                
                                swal({
                                type: "warning",
                                title: "El articulo ya ha sido seleccionado previamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                })
                                return
                            }

                        }

                        reqBtn.classList.remove('btn-outline-primary')
                        reqBtn.classList.add('btn-outline-success')
                        reqBtn.textContent = 'Added'
                        reqBtn.parentNode.parentNode.cells[2].children[0].setAttribute('disabled',true)
                        reqBtn.parentNode.parentNode.classList.add('disabled')
                        reqBtn.style.pointerEvents='none'
                        
                            table.innerHTML +=              // appendig request list from product list async mode
                            `<tr class="items">
                            <td class="text-center">
                            <input type="number" min="1" name="" id="" value="${quantity}">
                            </td>
                            <td class="d-none">${productId}</td>
                            <td class="pro-desc">${product}</td>
                            <td>${unit}</td>
                            <td>N/A</td>
                            <td>
                            <div class= "btn-group btn-group-sm">
                                <button class="btn btn-danger btn-flat btn-del-prod-req"  style="font-size: 0.7em">Eliminar</button>
                            </div>
                            </td>
                            </tr>`
                           let removeProductButton = table.getElementsByClassName('btn-del-prod-req')
                           for (i = 0; i < removeProductButton.length; i++){
                            let remProd = removeProductButton[i]
                            remProd.addEventListener('click', removeProduct)
                           }

                }

          }
  
        }
          

    // FUNCION PARA CONSULTA DE ARTICULOS POR NOMBRE DE ARTICULO

  
        function selItemByName(event){
  
          let itemToSel = event.target
          let itemIdbyName = itemToSel.parentElement.parentElement.children[0].value
          
          if(itemIdbyName != ""){

          let content = document.querySelector("#product-list-item-2")
          let datos = new FormData()
          datos.append('itemIdbyName',itemIdbyName)
  
          fetch('fetch/fetch.products.php',{
              method: 'POST',
              body: datos
          })
          .then(res => res.json())
          .then (_data => {
              fill(_data);
          })    
  
          function fill(_data){
            
              content.innerHTML = ''
              for (let value of _data){
  
                  content.innerHTML += 
                  `<tr class="item-row text-center">
                  <td class="d-none">${value.product_id}</td>
                  <td><strong>${value.product_name}</strong></td>
                  <td><input type="number" value="1"name="" min="1" id=""></td>
                  <td>${value.meassure_unit_name}</td>
                  <td class="d-flex justify-content-around"><button type="button" class="reqBtn2 btn btn-sm btn-outline-primary">+</button></td>
                  </tr>`
             
                }

                let requestButton2 = document.getElementsByClassName('reqBtn2')
                    for (let i=0; i<requestButton2.length; i++){                  
                    let reqButton2 = requestButton2[i]
                    reqButton2.addEventListener('click',rowRequest3)
                    }

                    function rowRequest3(event){

                        let reqBtn = event.target
                        let productId = reqBtn.parentNode.parentNode.cells[0].innerText
                        let product = reqBtn.parentNode.parentNode.cells[1].innerText
                        let quantity = reqBtn.parentNode.parentNode.cells[2].children[0].value
                        let unit = reqBtn.parentNode.parentNode.cells[3].innerText

                        let table = document.querySelector('#requesting-list')
                        let proDesc = table.getElementsByClassName('pro-desc')

                        for(let i =0; i< proDesc.length; i++){

                            if (proDesc[i].innerText === product){
                                
                                swal({
                                type: "warning",
                                title: "El articulo ya ha sido seleccionado previamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                })

                                return
                            }

                        }


                        reqBtn.classList.remove('btn-outline-primary')
                        reqBtn.classList.add('btn-outline-success')
                        reqBtn.textContent = 'Added'
                        reqBtn.parentNode.parentNode.cells[2].children[0].setAttribute('disabled',true)
                        reqBtn.parentNode.parentNode.classList.add('disabled')
                        reqBtn.style.pointerEvents='none'
                        
                            table.innerHTML +=              // appendig request list from product list async mode
                            `<tr class="items">
                            <td class="text-center">
                            <input type="number" min="1" name="" id="" value="${quantity}">
                            </td>
                            <td class="d-none">${productId}</td>
                            <td class="pro-desc">${product}</td>
                            <td>${unit}</td>
                            <td>N/A</td>
                            <td>
                            <div class= "btn-group btn-group-sm">
                                <button class="btn btn-danger btn-flat btn-del-prod-req" style="font-size: 0.7em">Eliminar</button>
                            </div>
                            </td>
                            </tr>`

                            let removeProductButton = table.getElementsByClassName('btn-del-prod-req')
                           for (i = 0; i < removeProductButton.length; i++){
                            let remProd = removeProductButton[i]
                            remProd.addEventListener('click', removeProduct)
                           }
                                       
                    }
             
            }

          }else{
                    swal({
                    type: "warning",
                    title: "No puede Haber consultas vacias",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    })

                    return
          }
  
        }
               
    
    function cancelRequest(event){    // cancel request order by click event

        cancelButton = event.target
        window.location = "index.php?ruta=rostatus"
    }
    
    function submitRequest(event){

        submitRequest = event.target   // getting items to be inserted in request_order_table_items

        let prodArr = []
        
        let prodToSubmit = document.getElementsByClassName('items')


        for (let i=0; i<prodToSubmit.length; i++){

        let quan = parseInt(prodToSubmit[i].cells[0].children[0].value)
        let prodId = prodToSubmit[i].cells[1].innerText
           
        prodArr.push({
                   
                    "product_id": prodId,
                    "quantity": quan,

                        })
        }
        if(prodArr == ""){
            
            event.preventDefault()
            
            swal({
                    type: "warning",
                    title: "Por favor elige al menos un articulo",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    })

                    return
        }else{
        
        let inputArray = document.createElement('input')
        inputArray.classList.add('d-none')
        inputArray.setAttribute('name','input-array')
        inputArray.value = JSON.stringify(prodArr)
        let newArrayInput = document.getElementById('product-array')
        newArrayInput.append(inputArray)

        }
    }

    // FUNCION QUE ELIMINA UN PRODUCTO AL HACER CLICK EN EL BOTON ELIMINAR DE LA LISTA

    function removeProduct(event){

       rem = event.target
       rem.parentElement.parentElement.parentElement.remove()
    }


