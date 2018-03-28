<?php $__env->startSection('htmlheader_title'); ?>
   Agregar Cliente
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Agregar Cliente
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('customers.index')); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
<div class="panel panel" style="max-width:800px">
   <div class="panel-heading bg-primary">
      <strong>Agregar Nuevo Cliente</strong>
   </div>
   <div class="panel-body">
      <?php echo Form::open(['route'=>'customers.store', 'method'=>'POST']); ?>

         <div class="row">
            <div class="form-group col-sm-6">
               <div class="form-group">
                  <label for="idNumber"> <strong>Cédula:</strong></label>
                  <?php echo Form::text('idNumber',null,['class'=>'form-control','placeholder'=>'Ingrese el Numero de Cédula', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>

               <div class="form-group">
                  <label for="name"> <strong>Nombre Completo:</strong></label>
                  <?php echo Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese Nombres y Apellidos', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>
               <div class="form-group">
                  <label for="phone1"> <strong>Telefono 1:</strong></label>
                  <?php echo Form::text('phone1',null,['class'=>'form-control','placeholder'=>'Ingrese un numero Teléfonico', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>
               <div class="form-group">
                  <label for="phone2"> <strong>Telefono 2:</strong></label>
                  <?php echo Form::text('phone2',null,['class'=>'form-control','placeholder'=>'Ingrese un segundo numero Teléfonico Opcional', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>
            </div>
            <div class="form-group col-sm-6">
               <div class="form-group">
                  <label for="email"> <strong>Correo:</strong></label>
                  <?php echo Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese un Correo Electronico', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>
               <div class="form-group">
                  <label for="email2"> <strong>Correo Opcional:</strong></label>
                  <?php echo Form::email('email2',null,['class'=>'form-control','placeholder'=>'Ingrese un Correo Electronico Opcional', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>
                  <div class="form-group">
                     <label for="password"> <strong>Clave:</strong></label>
                     <?php echo Form::password('password',['class'=>'form-control','placeholder'=>'Ingrese una Contraseña para el Cliente', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                  </div>

               <div class="form-group">
                  <label for="address"> <strong>Dirección:</strong></label>
                  <?php echo Form::text('address',null,['class'=>'form-control','placeholder'=>'Ingrese una Dirección del Cliente', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>
               <div class="form-group">
                  <label for="city"> <strong>Ciudad:</strong></label>
                  <?php echo Form::text('city',null,['class'=>'form-control','placeholder'=>'Ingrese la Ciudad del Cliente', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>
            </div>
            <div style="margin-top:-40px" class="form-group col-sm-12">
               <?php echo Form::hidden('seller_id',Auth::user()->id); ?>

               <?php echo Form::submit('Agregar',['class'=>'btn btn-primary']); ?>

               <a style=""class="btn btn-default" href="<?php echo e(route('customers.index')); ?>"><strong>Cancelar</strong>
               </a>
            </div>
      <?php echo Form::close(); ?>


   </div>


</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>