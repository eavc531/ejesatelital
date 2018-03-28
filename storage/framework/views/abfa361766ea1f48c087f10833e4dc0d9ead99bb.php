<?php $__env->startSection('htmlheader_title'); ?>
   Factura Ocasional: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Factura Ocasional: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('customersDetails',$customer->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="margin-bottom:30px;color:white" href="<?php echo e(route('customers.index')); ?>" class="btn btn-primary"><strong>Clientes</strong></a>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('main-content'); ?>

      <div class="panel" style="max-width:800px">
         <div class="panel-heading bg-primary">
            <strong>Añadir Monto</strong>
         </div>
         <div class="panel-body row">
               <?php echo Form::open(['route'=>['invoiceOccasionalAd',$customer->id], 'method'=>'POST']); ?>

               <div class="col-sm-12 form-inline">
                  <?php echo Form::label('Servicio:'); ?>

                  <?php echo Form::select('type',['Adicional' =>'Adicional','Descuento' =>'Descuento' ],null,['class'=>'form-control','placeholder'=>'Seleccione una Opcion']); ?>


                  <?php echo Form::label('Placa:'); ?>

                  <?php echo Form::select('plate',$vehicle,null,['class'=>'form-control','placeholder'=>'Opcional']); ?>


                  <?php echo Form::label('Monto:'); ?>

                  <?php echo Form::text('payment',null,['class'=>'form-control','placeholder'=>'Precio del Servicio']); ?>

               </div>

               <div class="col-sm-8" style="margin-top:20px">
                  <?php echo Form::label('Descripción:'); ?>

                  <?php echo Form::text('description',null,['class'=>'form-control','placeholder'=>'Descripción','id'=>'description','style'=>'max-width:600px']); ?>

               </div>

               <div class="col-sm-4" style="margin-top:50px">
                  <?php echo Form::submit('Agregar',['class'=>'btn btn-primary']); ?>

                  <a class="btn btn-default" href="<?php echo e(route('invoiceOccasional',$customer->id)); ?>">Cancelar</a>
                  <?php echo Form::close(); ?>

               </div>

            </div>
         </div>

<!--/////////////////-->
<div class="" style="margin-top:60px">

</div>
   <div class="panel panel-default">
      <div class="panel-heading">
         <strong>Factura Ocasional</strong>

      </div>
      <div class="panel-body">
               <table class="table table-sm">
                  <tr>
                     <th>Fecha de Elaboración:
                        <input type="hidden" name="" value="<?php echo e($today = \Carbon\Carbon::now()); ?>">
                         <?php echo Form::date('dateIni',$today,['id'=>'dateIni']); ?>

                      </th>
                  </tr>
                  <tr>
                     <input type="hidden" name="" value="<?php echo e($paymentTimely = \Carbon\Carbon::now()->addMonth(1)->firstOfMonth()->addDays(4)); ?>">
                     <th style="color:red">Pago Oportuno Antes de: <?php echo Form::date('$paymentTimely',$paymentTimely,['id'=>'paymentTimely']); ?>


                     </th>
                  </tr>
               </table>


         <table class="table table-striped table-bordered">
          <thead style="background:rgb(199, 172, 57);color:white">
             <tr>

                 <th class="qty"><strong>Placa:<s/trong></th>
               <th class="service"><strong>Tipo de Servicio:</strong></th>
               <th class="desc"><strong>Descripción:</strong></th>
               <th colspan="2"><strong>VALOR:</strong></th>
             </tr>
          </thead>
          <input type="hidden" name="" value="<?php echo e($servicePrice=''); ?>">
           <input type="hidden" name="" value="<?php echo e($sum=0); ?>">
          <tbody>
             <?php $__currentLoopData = $occasionalAd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                   <td class="unit"><?php echo e($o->plate); ?></td>
                   <td class="unit"><?php echo e($o->type); ?></td>
                   <td class="unit"><?php echo e($o->description); ?></td>

                   <?php if($o->type == 'Descuento'): ?>
                      <td class="unit">- <?php echo e($o->payment); ?>

                        <?php if(auth::user()->role == 'Administrador'): ?>
                        <a href="<?php echo e(route('deleteAO',$o->id)); ?>" onclick="return confirm('¿Esta Segur@ de Eliminar este Servicio Adicional de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>
                     </td>
                     <?php endif; ?>

                      <input type="hidden" name="" value="<?php echo e($sum-= $o->payment); ?>">
                   <?php else: ?>

                      <td class="unit">
                        <?php echo e($o->payment); ?>

                        <?php if(auth::user()->role == 'Administrador'): ?>
                        <a href="<?php echo e(route('deleteAO',$o->id)); ?>" onclick="return confirm('¿Esta Segur@ de Eliminar este Servicio de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>


                     </td>
                        <?php endif; ?>
                      <input type="hidden" name="" value="<?php echo e($sum+= $o->payment); ?>">
                   <?php endif; ?>

                   <td></td>
               </tr>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </tbody>
          <tfoot>
             <tr>

                <td class="unit"></td>
               <td class="unit"></td>
               <td class="qty" style="text-align:right"><strong>TOTAL:</strong></td>
               <td class="total"><strong><?php echo e($sum); ?></strong></td>
             </tr>
          </tfoot>
         </table>

         <div class="pull-right">
            <?php if(Auth::user()->role == 'Administrador'): ?>
               <!-- Button trigger modal -->
               <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal6">
                 <strong>Generar Factura</strong>
               </button>
            <?php endif; ?>
         </div>


        </div>
        <input type="hidden" name="" value="<?php echo e($customer->id); ?>" id="customer_id">
        <input type="hidden" name="" value="<?php echo e($sum); ?>" id="total">

      </div>

   </div>

<?php echo $__env->make('customers.modalServices', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('customers.modalalertcreateinvoice', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scriptpersonal'); ?>
   <script type="text/javascript">


      function invoiceCreate(){

         $('#exampleModal6').modal('toggle');

         monthPeriod = $('#monthPeriod').val();
         yearPeriod = $('#yearPeriod').val();

         paymentTimely = $('#paymentTimely').val();
         customer_id = $('#customer_id').val();
         total = $('#total').val();
         dateIni = $('#dateIni').val();
         invoiceperiod = monthPeriod + '-' +yearPeriod;



         route = "<?php echo e(route('invoiceOccasionalStore',$customer->id)); ?>";
         $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url:route,
            data:{dateIni:dateIni,invoiceperiod:invoiceperiod,paymentTimely:paymentTimely,customer_id:customer_id,total:total},
            error:function(error){
               $.each(error.responseJSON.errors, function(index, val){
               errormsj+='<li>'+val+'</li>';
               });
               $('#text-error-e').html(errormsj);
               $('#alert-error-e').fadeIn();
               console.log(error);
               },
            success:function(result){
               console.log(result);
               if(result.error == 'existe'){
                  $("#ti2").html(result.message);
                  $('#alertinvoice2').modal('toggle');
               }else if(result.error2 == 'FacturaSinConfirmar') {
                  $("#ti3").html(result.msg);
                  $('#alertinvoice3').modal('toggle');

               }else{
                  $('#alertinvoice').modal('toggle');
               }


            }

         });
      }


   </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>