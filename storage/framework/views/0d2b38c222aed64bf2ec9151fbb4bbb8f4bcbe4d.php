<?php $__env->startSection('htmlheader_title'); ?>
   Confirmar Pago de Factura: <?php echo e(str_pad($invoice->number, 3, "0", STR_PAD_LEFT)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Confirmar Pago de Factura: <?php echo e(str_pad($invoice->number, 3, "0", STR_PAD_LEFT)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('invoiceDetails',$invoice->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

   <div class="panel" style="max-width:700px;margin: 0 auto">

      <div class="panel-heading bg-primary">
         <strong>Confirmar Pago de Factura: <?php echo e(str_pad($invoice->number, 3, "0", STR_PAD_LEFT)); ?></strong>
      </div>

      <div class="panel-body" style="padding:40px">

            <?php echo Form::open(['route'=>['invoiceConfirmCustomer'], 'method'=>'POST']); ?>

            <label for="medioPayment"> <strong>Medio de Pago:</strong></label>
            <?php echo Form::text('medioPayment',null,['class'=>'form-control','placeholder'=>'Ejemplo: Transferencia, Deposito, etc...', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>




         <div  style="margin-top:20px">
            <label for="dateConfirmPayment"> <strong>Fecha del Pago:</strong></label>
            <?php echo Form::date('dateConfirmPayment',\Carbon\Carbon::now(),   ['class'=>'form-control','style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

         </div>

         <label for="Banco" style="margin-top:20px"> <strong>Banco: (Opcional)</strong></label>
         <?php echo Form::text('Banco',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>


         <label for="NroReferencia" style="margin-top:20px"> <strong>Nro. de Referencia (Opcional)</strong></label>
         <?php echo Form::text('nroReferencia',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>



         <label for="msg" style="margin-top:20px"> <strong>Mensaje: (Opcional)</strong></label>
         <?php echo Form::textarea('mensaje',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;height:130px']); ?>


         <?php echo Form::hidden('invoice_id',$invoice->id); ?>

         <?php echo Form::hidden('invoiceperiod',$invoice->invoiceperiod); ?>

            <?php echo Form::hidden('customer_id',$invoice->customer_id); ?>

         <div class="form-group" style="margin-top:40px">
            <?php echo Form::submit('Enviar Confirmacion de Pago',['class'=>'btn btn-primary','style'=>'"margin-top:40px;font-weight:bold']); ?>

            <a style="margin-top:0px"class="btn btn-default" href="<?php echo e(route('invoiceDetails',$invoice->id)); ?>"><strong>Cancelar</strong>
            </a>
         </div>

         <?php echo Form::close(); ?>


      </div>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>