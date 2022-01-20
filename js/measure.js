   
   // Eliminar Unidad del Catalogo

   let unit = document.getElementsByClassName('btn-remove-unit')
   for( let i=0; i < unit.length; i++){
       let idUnit = unit[i]
       idUnit.addEventListener('click', removeUnit)
         
      }

      // remove unit row from catalog

    function removeUnit(event){

        item = event.target;
        unitId = item.parentElement.parentElement.parentElement.children[0].innerText
        let datos = new FormData()
        datos.append('unitId', unitId)
        
        fetch('fetch/fetch.measure.php',{
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
                    title: "La unidad ha sido borrada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                              if (result.value) {

                              window.location = "index.php?ruta=measureunits";

                              }
                          })
            }
        }

    }