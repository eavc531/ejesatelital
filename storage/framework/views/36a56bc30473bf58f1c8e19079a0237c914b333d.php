<?php $__env->startSection('htmlheader_title'); ?>
   Factura Nro: <?php echo e(str_pad($invoices->number, 3, "0", STR_PAD_LEFT)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Factura Nro: <?php echo e(str_pad($invoices->number, 3, "0", STR_PAD_LEFT)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a class="btn btn-default" href="<?php echo e(route('invoiceList',$invoices->customer_id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="color:white" class="btn btn-primary" href="<?php echo e(route('customersDetails',$customer->id)); ?>"data-toggle="tooltip" data-placement="top" title="Detalles de Usuario"><strong>Detalles Usuario</strong></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>


   <?php if(Auth::user()->role == 'Cliente' and $invoices->stateSend != 'Pago Realizado' and $customer->userState != 'Deshabilitado'): ?>

      <a style="margin-bottom:30px" href="<?php echo e(route('invoiceConfirmCustomerView',$invoices->id)); ?>" class="btn btn-success"><strong>Enviar Confirmación de Pago</strong></a>
   <?php endif; ?>

   <?php if(isset($invoices->stateSend) and $invoices->stateSend == 'Pago Realizado' and Auth::user()->role != 'Cliente'): ?>
      <div class="panel panel" style="color:rgb(17, 103, 44)">
         <div class="panel-heading bg-success">
            <h4>
               <?php echo e($invoices->customer->name); ?> a Confirmado el Pago de la Factura: <?php echo e($invoices->invoiceperiod); ?></h4>
         </div>
         <div class="panel-body bg-success">
            <div class="row">
               <div class="col-sm-6">
                  <p><strong>Fecha del Pago:</strong>
                   <?php echo e(\Carbon\Carbon::parse($mConfirm->dateConfirmPayment)->format('d-m-Y')); ?></p>
                   <?php if(isset($mConfirm->dateConfirmPayment)): ?>
                      <input type="hidden" name="" value="<?php echo e($mConfirm->dateConfirmPayment); ?>" id="dateConfirmPaymentinput">
                   <?php endif; ?>

                  <p><strong>Medio de Pago:</strong> <?php echo e($mConfirm->medioPayment); ?></p>
                  <?php if(isset($mConfirm->dateConfirmPayment)): ?>
                     <input type="hidden" name="" value="<?php echo e($mConfirm->medioPayment); ?>" id="medioPaymentInput">
                  <?php endif; ?>

               </div>
               <div class="col-sm-6">
                  <p><strong>Banco:</strong> <?php if(isset($mConfirm->Banco)): ?> <?php echo e($mConfirm->Banco); ?> <?php else: ?> "Sin Detalles" <?php endif; ?></p>
                  <p><strong>Numero de Referencia:</strong> <?php if(isset($mConfirm->nroReferencia)): ?> <?php echo e($mConfirm->nroReferencia); ?> <?php else: ?> "Sin Detalles" <?php endif; ?></p>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-7">
                     <p><strong>Mensaje Adicional:</strong> <?php if(isset($mConfirm->mensaje)): ?> <?php echo e($mConfirm->mensaje); ?> <?php else: ?> "Sin Detalles"</p> <?php endif; ?>
               </div>
               <div class="col-sm-5">
                  <button style="background:rgba(28, 135, 45, 0.85);margin-top:30px" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal5">
                 <strong>Marcar Factura Como Pagada</strong>

               </button>

               </div>
            </div>
         </div>
      </div>
   <?php endif; ?>

   <div class="panel panel-default">
      <div class="panel-heading" style="height:60px">
         <?php if(Auth::user()->role == 'Cliente' and $invoices->statePayment != 'Pago Realizado' and $customer->userState == 'Habilitado'): ?>

            <a href="<?php echo e(route('invoiceConfirmCustomerView',$invoices->id)); ?>" class="btn btn-success"><strong>Enviar Confirmación de Pago</strong></a>
         <?php endif; ?>
         <a data-toggle="tooltip" data-placement="top" title="Descargar en Formato PDF" class="btn btn-default btn-lg" href="<?php echo e(route('invoicePdf',$invoices->id)); ?>"><i class="far fa-file-pdf"></i></a>

         <?php if(Auth::user()->role == 'Administrador' and $invoices->statePayment != 'Pago Confirmado'): ?>


            <?php if(\Carbon\Carbon::parse($invoices->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
               ): ?>
               <button data-placement="top" title="Aviso de Suspensión" type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#alertinvoice8">
                  <i class="fas fa-comment"></i>
               </button>
            <?php elseif($invoices->paymentTimely < \Carbon\Carbon::now()->addDays(-1)): ?>
               <button data-placement="top" title="Mensaje Recordatoiro" type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#alertinvoice6">
             <i class="fas fa-comment"></i>
               </button>
            <?php else: ?>
               <button data-placement="top" title="Enviar Aviso" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#alertinvoice7">
                  <i class="fas fa-comment"></i></strong>
               </button>
            <?php endif; ?>

            <button data-placement="top" title="Enviar por Correo" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal">
               <strong><i class="far fa-envelope-open"></i></strong>
            </button>




         <?php endif; ?>

         <div class="pull-right" style="font-size:18px">
            <?php if($invoices->statePayment == 'Pago Confirmado'): ?>
               <strong>Estado: </strong><strong><?php echo e('Factura Cancelada'); ?></strong>
            <?php elseif($invoices->stateSend == 'Pago Realizado'): ?>
               <strong>Estado: </strong><strong style="color:rgb(2, 117, 2)"> <?php echo e($invoices->statePayment); ?>/Por Confirmar</strong>
            <?php elseif(\Carbon\Carbon::parse($invoices->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
               ): ?>
               <strong style="padding:6px;">Estado:</strong><strong style="color:rgb(195, 32, 42)">Retraso</strong>
            <?php elseif($invoices->paymentTimely < \Carbon\Carbon::now()->addDays(-1)): ?>
               <strong style="padding:6px;">Estado:</strong> <strong style="color:rgb(195, 32, 42)"><?php echo e($invoices->statePayment); ?></strong>
            <?php elseif($invoices->statePayment == 'Pendiente'): ?>
               <strong style="padding:6px;">Estado:</strong> <strong style="color:rgb(34, 36, 237)"><?php echo e($invoices->statePayment); ?></strong>
            <?php endif; ?>

            <?php if($invoices->stateSend == 'Sin Enviar' and $invoices->statePayment != 'Pago Confirmado' and auth::user()->role != 'Cliente'): ?>
               <strong style="color:rgba(230, 178, 20, 0.92)">    / <?php echo e($invoices->stateSend); ?></strong>
            <?php endif; ?>

            <?php if($invoices->statePayment != 'Pago Confirmado' and $invoices->statePayment != 'Pago Realizado' and Auth::user()->role == 'Administrador'): ?>
               <button data-placement="top" title="Marcar Factura Como Pagada"style="margin-left:10px" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#exampleModal5">
                 <i class="far fa-check-circle"></i>
            </button>
            <?php endif; ?>
         </div>
      </div>
      <div class="panel-body">
         <div class="row">
            <div class="col-sm-6">
               <p>Eje Satelital Cra 10 No. 14-71</p>
               <p>Centro Comercial Éxito Local 102A</p>
               <p>Pereira - Risaralda</p>
               <p>NIT: 34066000-8</p>

               <p style="margin-top:30px"><strong>CLIENTE</strong></p>
               <p>Nombre: <?php echo e($invoices->nameCustomer); ?></p>
               <p>Cedula: <?php echo e($invoices->idNumberCustomer); ?></p>
               <p>Dirección: <?php echo e($invoices->customer->address); ?></p>

            </div>
            <div class="col-sm-6">
               <table class="table table-sm">
                  <tr>
                     <th>Fecha de Elaboración</th>
                     <th><?php echo e(\Carbon\Carbon::parse($invoices->dateIni)->format('d-m-Y')); ?></th>
                  </tr>
                  <tr>
                     <th>Periodo de Facturacion</th>
                     <th>Mes(es): <?php echo e($invoices->invoiceperiod); ?>

                     </th>
                  </tr>
                  <tr>
                     <th style="color:rgb(219, 126, 3)">Pago Oportuno Antes de:</th>
                     <th style="color:rgb(219, 126, 3)"><?php echo e(\Carbon\Carbon::parse($invoices->paymentTimely)->format('d-m-Y')); ?></th>
                  </tr>
                  <tr>
                     <th style="color:red">Fecha Limite:</th>
                     <th style="color:red"><?php echo e(\Carbon\Carbon::parse($invoices->paymentTimely)->addDays(5)->format('d-m-Y')); ?></th>
                  </tr>
                  <?php if(isset($invoices->paymentDate)): ?>
                     <tr>
                        <th>Pago Realizado:</th>
                        <th>
                           <?php echo e(\Carbon\Carbon::parse($invoices->datepayment)->format('d-m-Y')); ?>

                        </th>
                     </tr>
                  <?php endif; ?>
                  <?php if(isset($invoices->paymentMethod)): ?>
                     <tr>
                        <th >Metodo Utilizado:</th>
                        <th >
                           <?php echo e($invoices->paymentMethod); ?>

                        </th>
                     </tr>
                  <?php endif; ?>
               </table>
            </div>
         </div>
         <div style="margin-top:10px;">
            <div class="col-sm-6">

               <h3>Descripción</h3>
            </div>
            <div class="col-sm-6">
               <?php if(Auth::user()->role == 'Administrador'): ?>
               <a href="<?php echo e(route('addDetailInvoice',$invoices->id)); ?>" class="btn btn-primary btn-lg pull-right"><strong>Añadir Servicio</strong></a>
               <?php endif; ?>
            </div>
         </div>

         <table class="table table-bordered table-striped">
            <thead>
               <tr style="background:rgb(77, 189, 179); color:white">
                     <th class="qty"><strong>Placa:<s/trong></th>
                     <th class="service"><strong>Servicio:</strong></th>
                     <th class="desc"><strong>Descripción:</strong></th>
                     <th><strong>Valor Mensual:</strong></th>
                     <th><strong>Monto:</strong></th>
                  </tr>
               </thead>
               <input type="hidden" name="" value="<?php echo e($sum=0); ?>">
               <tbody>
                  <?php $__currentLoopData = $invoiceDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td class="unit"><?php echo e($id->plate); ?></td>
                        <td class="unit"><?php echo e($id->type); ?></td>
                        <td class="unit"><?php echo e($id->description); ?></td>
                        <?php if($id->type == 'Descuento'): ?>
                        <td class="unit">-<?php echo e($id->payment); ?>


                        </td>
                        <input type="hidden" name="" value="<?php echo e($sum-=$id->payment); ?>">
                        <?php elseif($id->type == 'Adicional'): ?>
                        <td class="unit"><?php echo e($id->payment); ?>


                        </td>
                        <input type="hidden" name="" value="<?php echo e($sum+=$id->payment); ?>">
                        <?php else: ?>
                        <td class="unit"><?php echo e($id->payment); ?> x <?php echo e($invoices->months); ?> Mes(es)</td>
                        <?php endif; ?>

                        <?php if($id->type == 'Descuento' and auth::user()->role == 'Administrador'): ?>
                        <td class="unit">-<?php echo e($id->payment); ?>

                           <a href="<?php echo e(route('deleteDF',$id->id)); ?>" onclick="return confirm('¿Esta Segur@ de Eliminar esta fila de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>
                        </td>
                        <input type="hidden" name="" value="<?php echo e($sum-=$id->payment); ?>">
                        <?php elseif($id->type == 'Adicional' and auth::user()->role == 'Administrador'): ?>
                        <td class="unit"><?php echo e($id->payment); ?>

                           <a href="<?php echo e(route('deleteDF',$id->id)); ?>" onclick="return confirm('¿Esta Segur@ de Eliminar esta fila de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>
                        </td>
                        <input type="hidden" name="" value="<?php echo e($sum+=$id->payment); ?>">
                        <?php else: ?>
                        <td class="unit"><?php echo e($id->payment * $invoices->months); ?></td>
                        <?php endif; ?>

                     </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </tbody>
               <tfoot>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td style="text-align:right"><strong >TOTAL:</strong></td>
                     <td><strong><?php echo e($invoices->total); ?></strong></td>
                  </tr>
               </tfoot>
            </table>

         </div>

      </div>

   <input id="route2" type="hidden" name="" value="<?php echo e(route('invoiceList',$invoices->customer_id)); ?>">
   <input type="hidden" name="" value="<?php echo e(\Carbon\Carbon::parse($invoices->paymentTimely)->format('m-d-Y')); ?>" id="paymentTimely">
   <input type="hidden" name="" value="<?php echo e($invoices->total); ?>" id="invoiceTotal">


   <?php echo $__env->make('customers.modalServices', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php echo $__env->make('customers.modalInvoiceSend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php echo $__env->make('customers.modalConfirmPayment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scriptpersonal'); ?>

      <script type="text/javascript">

      function cerrar(){
         $('#msg-success2').hide();
         $('#msg-success').hide();
      }

      function act(){
         $('#msg-success2').hide();
         $('#msg-send').html('Mensaje Enviado');
        $('#msg-success').show();
      }

         function sendReminder(){

            $('#msg-success').hide();
            $('#msg-success2').hide();


              $('#alertinvoice6').modal('toggle');

              $('#msg-send2').html('Se esta Enviando el Mesaje por Favor Espere.');
             $('#msg-success2').show();
           var number = $('#numberPhone').val();//el numero q se toma de un input
           var message = $('#message').val();//el mensaje q se toma de un input

           route = "http://138.128.162.82:8081//mensaje/envia.php?user=juanks&password=juanks&text="+message+"&to="+number;

           ventana = window.open(route,'Envio de Mensaje',"directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=300, height=300");
           setTimeout(function(){
             ventana.close();
          }, 4000);

             setInterval("act()",3000);

             clearInterval()
         }

////////////////////////////////////////////
         function sendMessageMail(){

            $('#msg-success').hide();
            $('#msg-success2').hide();

            $('#msg-send2').html('Se estan Enviando los Mensajes, Espere un momento Por Favor.');
            $('#msg-success2').show();

             $('#exampleModal').modal('toggle');
           var number = $('#numberPhone2').val();//el numero q se toma de un input
           var paymentTimely = $('#paymentTimely').val();
           var invoiceTotal = $('#invoiceTotal').val();;
           var message = 'Su factura Eje Satelital se envio a su email principal por valor de'+invoiceTotal+' con Fecha de Pago Oportuno antes de: '+paymentTimely;
//el mensaje q se toma de un input

           route = "http://138.128.162.82:8081//mensaje/envia.php?user=juanks&password=juanks&text="+message+"&to="+number;

           $('#msg-send2').html('Se esta Enviando el Mensaje Por Favor espere.');
          $('#msg-success2').show();

           ventana = window.open(route,'Envio de Mensaje',"directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=300, height=300");
           setTimeout(function(){
             ventana.close();
          }, 4000);

          var routeMail = "<?php echo e(route('invoiceSends')); ?>";
           var email = $('#email').val();
          var messageMail = $('#messageMail').val();
          var invoice_id = $('#invoice_id').val();

             $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'post',
                url:routeMail,
                data:{email:email,message:messageMail,envio:'json',invoice_id:invoice_id},
                error:function(error){
                   $.each(error.responseJSON.errors, function(index, val){
                   errormsj+='<li>'+val+'</li>';
                   });
                   $('#text-error-e').html(errormsj);
                   $('#alert-error-e').fadeIn();
                   console.log(error);
                   },
                success:function(result){
                   console.log(result.user);
                  $('#msg-success2').hide();
                 $('#msg-send').html('Se a enviado la factura por Email y una Notificaión al teléfono de: '+result.user);
                $('#msg-success').show();

                }
             });

         }

         function sendNotification(){
            $('#alertinvoice7').modal('toggle');
             $('#msg-success').hide();
           var number = $('#numberPhone3').val();//el numero q se toma de un input
           var message = $('#message3').val();//el mensaje q se toma de un input

           route = "http://138.128.162.82:8081//mensaje/envia.php?user=juanks&password=juanks&text="+message+"&to="+number;
           $('#msg-send2').html('Se esta Enviando el Mensaje Por Favor espere.');
          $('#msg-success2').show();

           ventana = window.open(route,'Envio de Mensaje',"directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=300, height=300");
           var cerrar = setTimeout(function(){
             ventana.close();
             act();
          }, 4000);



         }

         function sendAlert(){
            $('#alertinvoice8').modal('toggle');
             $('#msg-success').hide();
           var number = $('#numberPhone4').val();//el numero q se toma de un input
           var message = $('#message4').val();//el mensaje q se toma de un input

           route = "http://138.128.162.82:8081//mensaje/envia.php?user=juanks&password=juanks&text="+message+"&to="+number;
           $('#msg-send2').html('Se esta Enviando el Mensaje Por Favor espere.');
          $('#msg-success2').show();

           ventana = window.open(route,'Envio de Mensaje',"directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=300, height=300");
           setTimeout(function(){
             ventana.close();
          }, 4000);
          setInterval("act()",3000);

          clearInterval()
         }

      </script>
<?php echo $__env->yieldSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>