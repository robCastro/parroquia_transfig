$(document).on("click", ".open", function () {
    var datosFila = $(this).data('id');
   $(".modal-body #txtAlumnosPresentes").val( datosFila.split('|')[4] );
   $(".modal-body #txtCapacidad").val( datosFila.split('|')[5] );
   $(".modal-body #txtIdAula").val( datosFila.split('|')[0] );
    $(".modal-body #txtAula").val( datosFila.split('|')[1] );
   $(".modal-body #txtBloque").val( datosFila.split('|')[2] +"-" + datosFila.split('|')[3]);
   $('#modal-default-aulas').modal('show');
});

function valida(e){
   tecla = (document.all) ? e.keyCode : e.which;

   //Tecla de retroceso para borrar, siempre la permite
   if (tecla==8){
       return true;
   }

   // Patron de entrada, en este caso solo acepta numeros
   patron =/[0-9]/;
   tecla_final = String.fromCharCode(tecla);
   return patron.test(tecla_final);
}