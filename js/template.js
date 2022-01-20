
$(document).ready(function() {
    var table = $('#table-catalogue').DataTable( {
        responsive: false
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );



////// FUNCION PARA VALIDAR FORMULARIOS EN BOOSTRAP //////.


(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');

    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


$(document).ready(function() {
  $('#compose-textarea').summernote();
});


////// FUNCION PARA HACER EL QUERY SELECT 2 //////.

$(document).ready(function() {
    $('.select3').select2();
});


////// FUNCION PARA HACER EL QUERY SELECT 2 //////.


/** add active class and stay opened when selected */
var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.nav-sidebar a').filter(function() {
    return this.href == url;
}).addClass('active');

// for treeview
$('ul.nav-treeview a').filter(function() {
    return this.href == url;
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');