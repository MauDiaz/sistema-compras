   
   // Eliminar proveedor del Catalogo

   let supplier = document.getElementsByClassName('btn-remove-supplier')
   for( let i=0; i < supplier.length; i++){
       let idsupplier = supplier[i]
       idsupplier.addEventListener('click', removeSupplier)
         
      }

      // GUARDAR EL VALOR DEL SELECTOR EN VARIABLE PARA DISPARAR EVENTO

      let selector = document.getElementById('select-supplier')
      selector.addEventListener('change', selectDataSupplier) 

      // remove unit row from catalog

    function removeSupplier(event){

        item = event.target;
        supplierId = item.parentElement.parentElement.parentElement.children[0].innerText
        
        let datos = new FormData()
        datos.append('supplierId', supplierId)
        
        fetch('fetch/fetch.suppliers.php',{
            method: 'POST',
            body: datos
        })
        .then(res => res.text())
        .then (_data => {
            eliminar(_data);
        })    

        function eliminar(_data){

            if(data = "ok"){

                swal({
                    type: "success",
                    title: "El proveedor ha sido eliminado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=suppliers";

                              }
                          })
            }
        }

     }


     // BUSCAR DATA DE PROVEEDORES DE MANERA ASINCRONA 

function selectDataSupplier(event){

  let suppId = event.target.value
  let supplierDiv = document.querySelector('#div-supp')

  let datos = new FormData()
      datos.append('suppId', suppId)
        
        fetch('fetch/fetch.suppliers.php',{
            method: 'POST',
            body: datos
        })
        .then(res => res.json())
        .then (_data => {
            fill(_data);
        })  

        function fill(_data){

          supplierDiv.innerHTML = ''

          supplierDiv.innerHTML +=`

                       <div class="form-group">
                            <div class="input-group input-group-sm col-sm-12">
                              <label class="mr-2"for="req-type">Direccion:</label>
                              <input type="text" style="width: 100%" class="form-control form-control-sm" id="" name="" value="${_data.supplier_address}"readonly>
                            </div>
                        </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm  col-sm-12">
                         <label class="mr-2" for="company">Telefono</label>
                                <input type="text" style="width: 100%"class="form-control" id="" name="" value="${_data.supplier_pn}"readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group input-group-sm col-sm-12" >
                          <label class="mr-2" for="departament">Correo Electronico</label>
                          <input type="text" style="width: 100%" class="form-control" id="" name="" value="${_data.supplier_email}"readonly>
                        </div>
                      </div>

          `
        }  
  
}