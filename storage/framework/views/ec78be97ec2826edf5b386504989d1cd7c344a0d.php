<?php $__env->startSection('htmlheader_title'); ?> <?php echo e($invoice->invoiceperiod); ?>

   Agregar Detalle a factura:
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Agregar Detalle a factura: <?php echo e($invoice->invoiceperiod); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

   <div class="panel" style="max-width:800px">
      <div class="panel-heading bg-primary">
         <strong>Añadir Servicos Adicionales</strong>
      </div>
      <div class="panel-body row">
            <?php echo Form::open(['route'=>'addDetailInvoiceStore', 'method'=>'POST']); ?>

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
               <?php echo Form::submit('Agregar',['class'=>'btn btn-primary','style'=>'margin-top:20px']); ?>

               <a style="margin-top:20px"class="btn btn-default" href="<?php echo e(route('customersServices',$invoice->id)); ?>">Cancelar</a>
            </div>
            <?php echo Form::hidden('id',$invoice->id); ?>

            <?php echo Form::close(); ?>

         </div>
      </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>