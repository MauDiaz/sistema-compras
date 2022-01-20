
let idCategory = document.getElementsByClassName('select-cat')

for( let i=0; i < idCategory.length; i++){
    let category = idCategory[i]
    category.addEventListener('change', catSelected)
      
   }
   
   // Eliminar Categoria del Catalogo

let category = document.getElementsByClassName('btn-remove-category')
for( let i=0; i < category.length; i++){
    let idCategory = category[i]
    idCategory.addEventListener('click', removeCategory)
      
   }
   // Editar Categoria del Catalogo
   

        // Metodo para seleccionar la categoria proceso de solicitud

   function catSelected(event){
        
        let catSelect = event.target.value
        let tableContent = document.querySelector('#product-list');

        if (catSelect != 0){

           let datos = new FormData();
           datos.append('catSelect', catSelect);

             fetch ('fetch/fetch.php',{
                method:'POST',
                body: datos
            })
                .then( res => res.json())
                .then( data => {
                    // console.log(data)
                    table(data)
                })

            function table(data){

                tableContent.innerHTML = ''
                for (let value of data){
                    tableContent.innerHTML += 
                    `<tr>
                    <td class="d-none">${value.product_id}</td>
                    <td>${value.product_name}</td>
                    <td>${value.supplier_name}</td>
                    <td>${value.meassure_unit_name}</td>
                    <td>${value.product_price_list}</td>
                    <td><input type="number" value="1" name="" min="1" id=""></td>
                    <td class="d-flex justify-content-around"><button type="button" class="btn btn-sm btn-outline-primary requestBtn">+</button></td>
                    </tr>`
                    reqItem()
                }

            }

   
        }
        
   }
// remove ctegory from catalog

    function removeCategory(event){

        item = event.target;
        categoryId = item.parentElement.parentElement.parentElement.children[0].innerText
       
        let datos = new FormData()
        datos.append('categoryId', categoryId)
        
        fetch('fetch/fetch.categories.php',{
            method: 'POST',
            body: datos
        })
        .then(res => res.text())
        .then (data => {
            eliminar(data);
        })    

        function eliminar(data){

            if(data = "ok"){

                swal({
                    type: "success",
                    title: "La categoría ha sido borrada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=prod_categories";

                              }
                          })
            }
        }

    }
