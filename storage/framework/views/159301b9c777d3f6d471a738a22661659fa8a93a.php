<?php $__env->startSection('htmlheader_title'); ?>
   Notas/Observaciones: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Notas/Observaciones: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a d="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('services.index')); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
      <div class="panel" style="max-width:400px">
         <div class="panel-heading bg-primary">
            <strong>Crear nota</strong>
         </div>
         <div class="panel-body">
            <?php echo Form::open(['route'=>'notes.store', 'method'=>'POST']); ?>

               <div class="form-group">
                  <div class="form-group">
                     <label for=""><strong>Titulo:</strong></label>
                     <?php echo Form::text('title',null,['class'=>'form-control','placeholder'=>'Titulo de la Nota', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                  </div>
                  <div class="form-group">
                     <label for=""><strong>Contenido:</strong></label>
                     <?php echo Form::textarea('content',null,['class'=>'form-control','placeholder'=>'Descripción/Observación ', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                  </div>
                     <input type="hidden" name="customer_id" value="<?php echo e($customer->id); ?>">
                     <input type="hidden" name="Autor" value="<?php echo Auth::user()->name; ?>">
                     <input type="hidden" name="seller_id" value="<?php echo Auth::user()->id; ?>">
                  <div class="form-group">
                     <?php echo Form::submit('Crear',['class'=>'btn btn-primary']); ?>

                  </div>
                  <?php echo Form::close(); ?>


         </div>
      </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>