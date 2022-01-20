//BOTON PARA CANCELAR COTIZACION

let cancelQuotationButton = document.getElementsByClassName('btn-cancel-quot') 

 for (let i=0; i<cancelQuotationButton.length; i++){
     let cancelQuot = cancelQuotationButton[i]
     cancelQuot.addEventListener('click',cancelQuotation)
     }

//BOTON PARA CREAR COTIZACION
 
 let submitQuotationButton = document.getElementsByClassName('btn-submit-quot') //getting submit request button from all posibles in the DOM 

for (let i=0; i<submitQuotationButton.length; i++){
    let submitQuot = submitQuotationButton[i]
    submitQuot.addEventListener('click',submitQuotation)
    }


 // BOTON PARA CONSULTA DE ARTICULOS POR NUMERO DE ARTICULO PARA COTIZACION

 let inputByNumber2 = document.getElementsByClassName('input-number-quot') 
  inputByNumber2[0].addEventListener('keyup', function(e){
      if (e.keyCode === 13){
    document.getElementsByClassName('sel-item-btn-2')[0].click()
    
    }
  })

     let item2 = document.getElementsByClassName('sel-item-btn-2')
     for( let i=0; i < item2.length; i++){
         let idItem2 = item2[i]
         idItem2.addEventListener('click', selItemByNumber2)
        }

          // BOTON PARA CONSULTA DE ARTICULOS POR NOMBRE DE ARTICULO
    
    let inputByName2 = document.getElementsByClassName('input-name-quot') 
      inputByName2[0].addEventListener('keyup', function(e){
      if (e.keyCode === 13){
      document.getElementsByClassName('nom-item-btn-2')[0].click()
    
  }
})

     let item3 = document.getElementsByClassName('nom-item-btn-2')
     for( let i=0; i < item3.length; i++){
         let idItem3 = item3[i]
         idItem3.addEventListener('click', selItemByName2)
       }

    // GUARDA EL SELECT PARA CONSULTAR LA INFO DE LA REQUISICION DE MANERA ASINCRONA

    let reqSelector = document.getElementById('requesting-selector')
    reqSelector.addEventListener('change', selectDataRequesting) 


// methods

    
   

   function selItemByNumber2(event){
  
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
                  <td class="d-flex justify-content-around"><button type="button" class="reqBtn3 btn btn-sm btn-outline-primary">+</button></td>
                  </tr>`
             
                }

                let requestButton2 = document.getElementsByClassName('reqBtn3')
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

                        let table = document.querySelector('#quotation-list')
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
                            `<tr class="quot-items">
                            <td class="text-center"><input type="number" name="" min="1" id="" value="${quantity}"></td>
                            <td class="d-none">${productId}</td>
                            <td class="pro-desc">${product}</td>
                            <td>${unit}</td>
                            <td>N/A</td>
                            <td>
                            <div class= "btn-group btn-group-sm">
                                <button class="btn btn-danger btn-flat btn-del-prod-quot" style="font-size: 0.7em">Eliminar</button>
                            </div>
                            </td>
                            </tr>`

                             let removeProductButton = table.getElementsByClassName('btn-del-prod-quot')
                               for (i = 0; i < removeProductButton.length; i++){
                                  let remProd = removeProductButton[i]
                                      remProd.addEventListener('click', removeProduct)
                                }

                             // <td class="text-center"><input type="number" step="0.01" min="0" name="" id="" value=""></td>
                            // <td class="text-right">0.00</td>
 
              }
             
          }
  
        }

// FUNCION PARA CONSULTA DE ARTICULOS POR NOMBRE DE ARTICULO PARA COTIZACION

  
        function selItemByName2(event){
  
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
                  <td class="d-flex justify-content-around"><button type="button" class="reqBtn4 btn btn-sm btn-outline-primary">+</button></td>
                  </tr>`
             
                }

                let requestButton2 = document.getElementsByClassName('reqBtn4')
                    for (let i=0; i<requestButton2.length; i++){                  
                    let reqButton2 = requestButton2[i]
                    reqButton2.addEventListener('click',rowRequest4)
                    }

                    function rowRequest4(event){

                        let reqBtn = event.target
                        let productId = reqBtn.parentNode.parentNode.cells[0].innerText
                        let product = reqBtn.parentNode.parentNode.cells[1].innerText
                        let quantity = reqBtn.parentNode.parentNode.cells[2].children[0].value
                        let unit = reqBtn.parentNode.parentNode.cells[3].innerText

                        let table = document.querySelector('#quotation-list')
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
                             `<tr class="quot-items">
                            <td class="text-center"><input type="number" min="1" name="" id="" value="${quantity}"></td>
                            <td class="d-none">${productId}</td>
                            <td class="pro-desc">${product}</td>
                            <td>${unit}</td>
                            <td>N/A</td>
                            <td>
                            <div class= "btn-group btn-group-sm">
                                <button class="btn btn-danger btn-flat btn-del-prod-quot" style="font-size: 0.7em">Eliminar</button>
                            </div>
                            </td>
                            </tr>`

                               let removeProductButton = table.getElementsByClassName('btn-del-prod-quot')
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

 function cancelQuotation(event){    // cancel request order by click event

        cancelButton = event.target
        window.location = "index.php?ruta=quoting"
    }
    
    function submitQuotation(event){

        submitQuotation = event.target   // getting items to be inserted in request_order_table_items

        let prodArr = []
        
        let prodToSubmit = document.getElementsByClassName('quot-items')


        for (let i=0; i<prodToSubmit.length; i++){

        let quan = parseInt(prodToSubmit[i].cells[0].children[0].value)
        let prodId = prodToSubmit[i].cells[1].innerText
        // let price = parseFloat(prodToSubmit[i].cells[5].children[0].value)
           
        prodArr.push({
                   
                    "product_id": prodId,
                    "quantity": quan,
                    // "price_list": price

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
        let newArrayInput = document.getElementById('quoting-array')
        newArrayInput.append(inputArray)

        }
    }

    // BUSCAR DATA DE REQUISICION DE MANERA ASINCRONA 

function selectDataRequesting(event){

  let requestId = event.target.value
  let reqDiv1 = document.querySelector('#div-req1')
  let reqDiv2 = document.querySelector('#div-req2')

  let datos = new FormData()
      datos.append('requestId', requestId)
        
        fetch('fetch/fetch.requesting.php',{
            method: 'POST', 
            body: datos
        })
        .then(res => res.json()) 
        .then (_data => {
            fill(_data);
        })  

        function fill(_data){

          reqDiv1.innerHTML = ''

          reqDiv1.innerHTML +=`

       <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Requisicion Tipo:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" value="${_data.order_type}" id="req-type" name="req-type"readonly>
                            </div>
                        </div>
                  
                  <div class="form-group">
                    <div class="input-group col-sm-12">
                        <label class="mr-2"for="next-approver">Nombre del Emp:</label>
                        <div class="input-group-prepend input-group-sm">

                          <img src="${_data.staff_photo}" alt="" id="next-approber" style="width: 31px; height: 31px">
                          <input type="text" style="width: 100%" class="form-control " value="${_data.staff_name}" id="approver1" name="approver1"readonly>
                        </div>
                    </div>
                  </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm  col-sm-12">
                         <label class="mr-2" for="company">Empresa</label>
                                <input type="text" style="width: 100%"class="form-control" id="company" name="company" value="${_data.branch_name}"readonly>
                        </div>
                      </div>                  

          `
        
         reqDiv2.innerHTML = ''

         reqDiv2.innerHTML +=`

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12" >
                          <label class="mr-2" for="departament">Departamento</label>
                          <input type="text" style="width: 100%" class="form-control" id="departament" name="departament" value="${_data.department_name}"readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2" for="placed-date">Fecha-Requisición</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" value="${_data.request_order_date}"id="placed-date" name="placed-date"readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12">
                          <label class="mr-2"for="requirement-date">Fecha-Estimada</label>
                          <input type="text" style="width: 100%" class="form-control form-control-sm" value="${_data.request_order_required_date}"id="requirement-date" name="requirement-date"readonly>
                          <input type="hidden" name="approver-id" value="${_data.approver_id}">

                        </div>
                      </div>

         `


        }  
  
}

