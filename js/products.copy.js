
     // BOTON PARA CONSULTA DE ARTICULOS POR NUMERO DE ARTICULO

     let item = document.getElementsByClassName('sel-item-btn')
     for( let i=0; i < item.length; i++){
         let idItem = item[i]
         idItem.addEventListener('click', selItem)
       }

        // BOTON PARA CONSULTA DE ARTICULOS POR NOMBRE DE ARTICULO

     let itemByName = document.getElementsByClassName('nom-item-btn')
     for( let i=0; i < itemByName.length; i++){
         let idItemByName = itemByName[i]
         idItemByName.addEventListener('click', selItemByName)
       }

     // FUNCION PARA CONSULTA DE ARTICULOS POR NUMERO DE ARTICULO

  
        function selItem(event){
  
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
                  `<tr class="item-row">
                  <td class="d-none">${value.product_id}</td>
                  <td><strong>${value.product_name}</strong></td>
                  <td class="d-none">${value.supplier_id}</td>
                  <td>${value.supplier_name}</td>
                  <td>${value.meassure_unit_name}</td>
                  <td>${value.product_price_list}</td>
                  <td><input type="number" value="1"name="" min="1" id=""></td>
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
                        let quantity = reqBtn.parentNode.parentNode.cells[6].children[0].value
                        let price_list = parseFloat(reqBtn.parentNode.parentNode.cells[5].innerText).toFixed(2)
                        let unit = reqBtn.parentNode.parentNode.cells[4].innerText
                        let vendor = reqBtn.parentNode.parentNode.cells[3].innerText
                        let vendorId = reqBtn.parentNode.parentNode.cells[2].innerText
                        let product = reqBtn.parentNode.parentNode.cells[1].innerText
                        let productId = reqBtn.parentNode.parentNode.cells[0].innerText
                        let total = (price_list * quantity)
                        let table = document.querySelector('#requesting-list')
                        reqBtn.classList.remove('btn-outline-primary')
                        reqBtn.classList.add('btn-outline-success')
                        reqBtn.textContent = 'Added'
                        reqBtn.parentNode.parentNode.cells[6].children[0].setAttribute('disabled',true)
                        reqBtn.parentNode.parentNode.classList.add('disabled')
                        reqBtn.style.pointerEvents='none'
                        
                            table.innerHTML +=              // appendig request list from product list async mode
                            `<tr class="items">
                            <td class="text-center">${quantity}</td>
                            <td class="d-none">${productId}</td>
                            <td>${product}</td>
                            <td>${unit}</td>
                            <td class="d-none">${vendorId}</td>
                            <td>${vendor}</td>
                            <td>N/A</td>
                            <td class="text-right">${price_list}</td>
                            <td class="text-right">${total}</td>
                            </tr>`
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
                  `<tr class="item-row">
                  <td class="d-none">${value.product_id}</td>
                  <td><strong>${value.product_name}</strong></td>
                  <td class="d-none">${value.supplier_id}</td>
                  <td>${value.supplier_name}</td>
                  <td>${value.meassure_unit_name}</td>
                  <td>${value.product_price_list}</td>
                  <td><input type="number" value="1"name="" min="1" id=""></td>
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
                        let quantity = reqBtn.parentNode.parentNode.cells[6].children[0].value
                        let price_list = parseFloat(reqBtn.parentNode.parentNode.cells[5].innerText).toFixed(2)
                        let unit = reqBtn.parentNode.parentNode.cells[4].innerText
                        let vendor = reqBtn.parentNode.parentNode.cells[3].innerText
                        let vendorId = reqBtn.parentNode.parentNode.cells[2].innerText
                        let product = reqBtn.parentNode.parentNode.cells[1].innerText
                        let productId = reqBtn.parentNode.parentNode.cells[0].innerText
                        let total = (price_list * quantity)
                        let table = document.querySelector('#requesting-list')
                        reqBtn.classList.remove('btn-outline-primary')
                        reqBtn.classList.add('btn-outline-success')
                        reqBtn.textContent = 'Added'
                        reqBtn.parentNode.parentNode.cells[6].children[0].setAttribute('disabled',true)
                        reqBtn.parentNode.parentNode.classList.add('disabled')
                        reqBtn.style.pointerEvents='none'
                        
                            table.innerHTML +=              // appendig request list from product list async mode
                            `<tr class="items">
                            <td class="text-center">${quantity}</td>
                            <td class="d-none">${productId}</td>
                            <td>${product}</td>
                            <td>${unit}</td>
                            <td class="d-none">${vendorId}</td>
                            <td>${vendor}</td>
                            <td>N/A</td>
                            <td class="text-right">${price_list}</td>
                            <td class="text-right">${total}</td>
                            </tr>`
                                        }
             
          }

          }else{

            alert("NO PUEDE HABER CONSULTAS VACIAS")
          }
  
        }
                

       
       
       
        
        
       
  
        
  