
let department = document.getElementsByClassName('btn-remove-department')

for (i=0; i< department.length; i++){
    let departmentId = department[i]
    departmentId.addEventListener("click", removeDepartment)
}

// REMOVE DEPARTMENT METHOD

  function removeDepartment(event){

    let item = event.target
    let departmentId = item.parentElement.parentElement.parentElement.children[0].innerText

    let datos = new FormData()
    datos.append('departmentId',departmentId)

    fetch('fetch/fetch.department.php',{
        method:'POST',
        body: datos
    })
    .then(res => res.text())
    .then(data => { 
        remove(data);
    })

    function remove(data){

        if(data = "ok"){

            swal({
                type: "success",
                title: "El departamento ha sido eliminado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                          if (result.value) {

                          window.location = "index.php?ruta=departments";

                          }
                      })
        }
    }
  }