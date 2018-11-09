function prueba(){
  altura = Math.max(document.documentElement.clientHeight, window.innerHeight);
  document.getElementById('contenedorG').style.height = altura+'px';
}
window.addEventListener('resize', prueba, true);
window.addEventListener('load', prueba, true);
window.addEventListener('orientationchange', prueba, true);
window.addEventListener('scroll', prueba, true);

function despliega(){
  planes=document.getElementById('menuCO');
  opciones=document.getElementsByClassName("opciones");

  console.log();
  if(planes.style.height != "120px"){
    planes.style.height="120px";
    for (var i = 0; i < opciones.length; i++) {
      opciones[i].classList.add("pos");
    }
  }else{
    for (var i = 0; i < opciones.length; i++) {
      opciones[i].classList.remove("pos");
    }
    planes.style.height="0px";
  }
}

function ok(idDiv){
  fondo = document.getElementById("fondo");
  si = document.getElementById(idDiv);
  console.log(si);
  if(si.style.display != "block"){
    si.style.display ="block";
    fondo.style.display="block";
    console.log(idDiv);
  }
}
function cerrarModal(idDiv){
  fondo = document.getElementById("fondo");
  si = document.getElementById(idDiv);
  fondo.style.display = "none";
  si.style.display = "none";
  console.log(idDiv);
}




/*Funcion para desplegar los elementos en el menu izquierdo*/
$(document).ready(function(){
  $('.menu li:has(ul)').click(function(e){
    /*e.preventDefault();*/
    if($(this).hasClass('activado')){
      $(this).removeClass('activado');
      $(this).children('ul').slideUp();
    }else{
      $('.menu li ul').slideUp();
      $('.menu li').removeClass('activado');
      $(this).addClass('activado');
      $(this).children('ul').slideDown();
    }
  });
});

$('#result').hide();

function suggetion() {

     $('#sug_input').keyup(function(e) {

         var formData = {
             'product_name' : $('input[name=title]').val()
         };
        //console.log(formData);
         if(formData['product_name'].length >= 1){

           // process the form
           $.ajax({
               type        : 'POST',
               url         : 'ajax.php',
               data        : formData,
               dataType    : 'json',
               encode      : true
           })
               .done(function(data) {
                   //console.log(data);
                   $('#result').html(data).fadeIn();
                   $('#result h4').click(function() {

                     $('#sug_input').val($(this).text());
                     $('#result').fadeOut(500);

                   });

                   $("#sug_input").blur(function(){
                     $("#result").fadeOut(500);
                   });

               });

         } else {
           console.log(data);
           $("#result").hide();

         };

         e.preventDefault();
     });

 }
  $('#sug-form').submit(function(e) {
      var formData = {
          'p_name' : $('input[name=title]').val()
      };
        // process the form
        $.ajax({
            type        : 'POST',
            url         : 'ajax.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        })
            .done(function(data) {
                console.log(data);
                $('#product_info').html(data).show();
                total();

            }).fail(function() {
                $('#product_info').html(data).show();
            });
      e.preventDefault();
  });
  function total(){
    $('#product_info input').change(function(e)  {
            var price = +$('input[name=price]').val() || 0;
            var qty   = +$('input[name=quantity]').val() || 0;
            var total = qty * price ;
                $('input[name=total]').val(total.toFixed(2));
    });
  }



  $(document).ready(function() {

    //Productos Desplegables
    suggetion();
    // Cantidad total a pagar por unidad
    total();

  });