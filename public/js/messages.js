function cerrar(){
   $('#msg-success2').hide();
   $('#msg-success').hide();
}
function act(){
   $('#msg-success2').hide();

 $('#msg-success').show();
}

function reminder(number){

   $('#msg-success').hide();
   $('#msg-success2').hide();

   $('#msg-send2').html('Se esta Enviando el Mensaje Recordatorio, por Favor Espere.');
   $('#msg-success2').show();
   var number = $('#numberPhone').val();
   var message = 'Apreciado usuario de Eje Satelital, nuestro sistema no registra su pago del mes en curso, cancele hoy en cualquiera de nuestros canales autorizados.';

   route = "http://138.128.162.82:8081//mensaje/envia.php?user=juanks&password=juanks&text="+message+"&to="+number;

   ventana = window.open(route,'Enviando Mensaje',"directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=300, height=300");

   $('#msg-send').html('El Mensaje de Recordatorio ha sido Enviado');

   setTimeout(function(){
      ventana.close();
      act();
   }, 3000);

}

function Aviso(number){

   $('#msg-success').hide();
   $('#msg-success2').hide();

   $('#msg-send2').html('Se esta Enviando el Mensaje de Aviso, por Favor Espere.');
   $('#msg-success2').show();
   var number = $('#numberPhone').val();
   var message = 'AVISO DE SUSPENSION: Estimado usuario, su servicio con Eje Satelital se encuentra en mora, recuerde pagar sus facturas a tiempo y evite desconexiones.';

   route = "http://138.128.162.82:8081//mensaje/envia.php?user=juanks&password=juanks&text="+message+"&to="+number;

   ventana = window.open(route,'Enviando Mensaje',"directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=300, height=300");

   $('#msg-send').html('El Mensaje de Aviso ha sido Enviado');

   setTimeout(function(){
      ventana.close();
      act();
   }, 3000);

}
