<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="color:white;background:rgb(44, 97, 176)">
        <span style="font-size:20px"id="exampleModalLabel">Enviar Factura a: <?php echo e($invoices->nameCustomer); ?></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <?php echo Form::open(['route'=>'invoiceSends','method'=>'post']); ?>

         <div class="form-group">
            <label for=""><strong>Correo:</strong></label>
             <?php echo Form::select('email',[$invoices->customer->email=>$invoices->customer->email,$invoices->customer->email2=>$invoices->customer->email2],$invoices->customer->email,['class'=>'form-control','id'=>'email' ]); ?>

             <label for="numberPhone"><strong>Numero teléfonico:</strong></label>
            <?php echo Form::select('numberPhone',[$customer->phone1 =>$customer->phone1,$customer->phone2=>$customer->phone2],$customer->phone1,['class'=>'form-control','id'=>'numberPhone2']); ?>

         </div>
         <div class="form-group">
             <?php echo Form::textarea('message',"Estimad@ ". $invoices->nameCustomer.", adjunto a este email encontrara  el cobro de Rastreo Satelital correspondiente al perido: " .$invoices->invoiceperiod. " por el valor total de: ". $invoices->total.", recuerde si realiza la consignacion a traves de la cuenta de Ahorros Bancolombia No. 89646991235, debera confirmarla a vuelta de este correo o por cualquiera de nuestros canales de comunicacion, si realiza el pago a traves de cualquier sucursal Apostar de Risaralda debera informar que va a pagar Eje Satelital incluyendo el numero de su Cedula o NIT (".$invoices->idNumberCustomer.") como referencia de pago. EL PRESENTE ES UN MENSAJE AUTOMATICO!",['class'=>'form-control','placeholder'=>'Ingrese un Mensaje','id'=>'messageMail']); ?>

         </div>
         <div class="form-group" style="padding:10px">

         </div>
            <button onclick="sendMessageMail()" type="button" name="button" class="btn btn-success">Enviar Sms y Correo</button>
            <?php echo Form::hidden('invoice_id',$invoices->id,['id'=>'invoice_id']); ?>

           <?php echo Form::submit('Enviar Correo',['class'=>'btn btn-primary']); ?>

           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
           <?php echo Form::close(); ?>


      </div>

    </div>
  </div>
</div>

<!--modal notificacion mensaje envio factura-->
<div class="modal fade" id="alertinvoice7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"style="color:white;background:rgb(27, 97, 191)">
        <h4 class="modal-title" id="exampleModalLabel">Enviar Notificación a: <strong> <?php echo e($invoices->nameCustomer); ?></strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-inline">
            <label for="numberPhone"><strong>Numero teléfonico:</strong></label>
            <?php echo Form::select('numberPhone',[$customer->phone1 =>$customer->phone1,$customer->phone2=>$customer->phone2],null,['class'=>'form-control','style'=>'width:120px;margin-left:20px;','id'=>'numberPhone3']); ?>

         </div>
         <input type="hidden" name="" value="<?php echo e($paymentTimely = \Carbon\Carbon::parse($invoices->paymentTimely)->format('d-m-Y')); ?>">
         <label for="" style="margin-top:20px"><strong>Mensaje:</strong></label>
         <?php echo Form::textarea('message','Su factura Eje Satelital se envio a su email principal por valor de '.$invoices->total.' Fecha de Pago Oportuno antes de: '.$paymentTimely,['class'=>'form-control','style'=>'height:100px','id'=>'message3']); ?>

      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" onclick="sendNotification()">Enviar</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

      </div>
    </div>
  </div>
</div>


<!--modal recordatorio-->
<div class="modal fade" id="alertinvoice6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"style="color:white;background:rgb(233, 182, 51)">
        <h4 class="modal-title" id="exampleModalLabel">Enviar recordatorio a: <strong> <?php echo e($invoices->nameCustomer); ?></strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-inline">
            <label for="numberPhone"><strong>Numero teléfonico:</strong></label>
            <?php echo Form::select('numberPhone',[$customer->phone1 =>$customer->phone1,$customer->phone2=>$customer->phone2],null,['class'=>'form-control','style'=>'width:120px;margin-left:20px;','id'=>'numberPhone']); ?>

         </div>
         <label for="" style="margin-top:20px"><strong>Mensaje:</strong></label>
         <?php echo Form::textarea('message','Apreciado usuario de Eje Satelital, nuestro sistema no registra su pago del mes en curso, cancele hoy en cualquiera de nuestros canales autorizados.',['class'=>'form-control','style'=>'height:100px','id'=>'message']); ?>

      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" onclick="sendReminder()">Enviar</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

      </div>
    </div>
  </div>
</div>

<!--modal suspension-->
<div class="modal fade" id="alertinvoice8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"style="color:white;background:rgba(205, 42, 42, 0.96)">
        <h4 class="modal-title" id="exampleModalLabel">Enviar recordatorio a: <strong> <?php echo e($invoices->nameCustomer); ?></strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-inline">
            <label for="numberPhone"><strong>Numero teléfonico:</strong></label>
            <?php echo Form::select('numberPhone',[$customer->phone1 =>$customer->phone1,$customer->phone2=>$customer->phone2],null,['class'=>'form-control','style'=>'width:120px;margin-left:20px;','id'=>'numberPhone4']); ?>

         </div>
         <label for="" style="margin-top:20px"><strong>Mensaje:</strong></label>
         <?php echo Form::textarea('message','AVISO DE SUSPENSION: Estimado usuario, su servicio con Eje Satelital se encuentra en mora, recuerde pagar sus facturas a tiempo y evite desconexiones.
',['class'=>'form-control','style'=>'height:100px','id'=>'message4']); ?>

      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" onclick="sendAlert()">Enviar</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

      </div>
    </div>
  </div>
</div>
