<?php $__env->startSection('htmlheader_title'); ?>
   Agregar Servicio
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Agregar Servicio
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a d="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('services.index')); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
      <div class="panel" style="max-width:400px">
         <div class="panel-heading bg-primary">
            <strong>Agregar Servicio</strong>
         </div>
         <div class="panel-body">
            <?php echo Form::open(['route'=>'services.store', 'method'=>'POST']); ?>

               <div class="form-group">
                  <div class="form-group">
                     <?php echo Form::label('Nombre:'); ?>

                     <?php echo Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Servicio', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                  </div>
                  <div class="form-group">
                     <?php echo Form::label('Descripción:'); ?>

                     <?php echo Form::text('description',null,['class'=>'form-control','placeholder'=>'Descripción del Servicio', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                  </div>
                  <div class="form-group">
                     <?php echo Form::label('Mensualidad:'); ?>

                     <?php echo Form::text('payment',null,['class'=>'form-control','placeholder'=>'Precio del Servicio', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                  </div>
                  <div class="form-group" style="display:flex;">
                     <?php echo Form::submit('Agregar',['class'=>'btn btn-primary']); ?>

                     <a style="margin-left:5px" class="btn btn-default" href="<?php echo e(route('services.index')); ?>"><strong>Cancelar</strong>
                     </a>
                  </div>
            <?php echo Form::close(); ?>


         </div>
      </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>