<?php $__env->startSection('htmlheader_title'); ?>
   Datos del Cliente: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Datos del Cliente: <?php echo e($customer->name); ?><?php if($customer->stateUser == 'Deshabilitado'): ?> <span style="color:rgb(236, 54, 29)">/Deshabilitado</span> <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('customersDetails',$customer->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
<div class="panel panel" style="max-width:800px">
   <div class="panel-heading bg-primary">
      <strong>Editar Datos del Cliente: <?php echo e($customer->name); ?></strong>
   </div>
   <div class="panel-body">
      <?php if(Auth::user()->role == 'Administrador'): ?>
      <?php echo Form::model($customer,['route'=>['customers.update',$customer], 'method'=>'PUT']); ?>

         <div class="row">
            <div class="form-group col-sm-6">
               <div class="form-group">
                  <label for="idNumber"> <strong>Cédula:</strong></label>
                  <?php echo Form::text('idNumber',null,['class'=>'form-control','placeholder'=>'Ingrese el Numero de Cédula', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','readOnly']); ?>

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
               <div class="form-group">
                  <label for="Agregado Por:"> <strong>Agregado Por:</strong></label>
                  <?php echo Form::text('addFor',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;', 'readOnly' ]); ?>

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
                     <?php echo Form::password('password',['class'=>'form-control','placeholder'=>'Ingresar Clave solo si desea Cambiarla', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                  </div>

               <div class="form-group">
                  <label for="address"> <strong>Dirección:</strong></label>
                  <?php echo Form::text('address',null,['class'=>'form-control','placeholder'=>'Ingrese una Dirección del Cliente', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>
               <div class="form-group">
                  <label for="city"> <strong>Ciudad:</strong></label>
                  <?php echo Form::text('city',null,['class'=>'form-control','placeholder'=>'Ingrese la Ciudad del Cliente', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

               </div>
               <div class="form-group">
                  <?php if(isset($customer->created_at)): ?>
                     <input type="hidden" value="<?php echo e($create = $customer->created_at->format('d-m-Y')); ?>">
                     <label for="fecha"> <strong>Fecha de Inicio</strong></label>
                     <?php echo Form::text('fecha',$create,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;', 'readOnly' ]); ?>

                  <?php endif; ?>
               </div>
            </div>
            <div class="form-group col-sm-12">
               <?php echo Form::hidden('seller_id',Auth::user()->id); ?>

               <?php if($customer->stateUser != 'Deshabilitado'): ?>
               <?php echo Form::submit('Guardar Cambios',['class'=>'btn btn-primary']); ?>

               <?php endif; ?>
               <a class="btn btn-default "href="<?php echo e(route('customersDetails',$customer->id)); ?>">Cancelar</a>
               <?php if($customer->stateUser != 'Deshabilitado'): ?>
               <a href="<?php echo e(route('disabled',$customer->id)); ?>" class="btn btn-danger pull-right" onclick="confirm('¿Esta segur@ de deshabilitar este Usuario?')">Deshabilitar</a>
               <?php endif; ?>
               <?php if($customer->stateUser == 'Deshabilitado'): ?>
                  <a href="<?php echo e(route('enableUser',$customer->id)); ?>" class="btn btn-success pull-right" onclick="confirm('¿Esta segur@ de Habilitar este Usuari@?')"><strong>Habilitar</strong></a>
               <?php endif; ?>
            </div>
      <?php echo Form::close(); ?>



      <?php elseif(Auth::user()->role == 'Vendedor'): ?>
         <p style="color:red">Debes Inicar Como administador para editar Estos Datos.</p>
         <?php echo Form::model($customer,['route'=>['customers.update',$customer], 'method'=>'PUT']); ?>

            <div class="row">
               <div class="form-group col-sm-6">
                  <div class="form-group">
                     <label for="idNumber"> <strong>Cédula:</strong></label>
                     <?php echo Form::text('idNumber',null,['class'=>'form-control','placeholder'=>'Ingrese el Numero de Cédula', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','readOnly']); ?>

                  </div>

                  <div class="form-group">
                     <label for="name"> <strong>Nombre Completo:</strong></label>
                     <?php echo Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese Nombres y Apellidos', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','readOnly']); ?>

                  </div>
                  <div class="form-group">
                     <label for="phone1"> <strong>Telefono 1:</strong></label>
                     <?php echo Form::text('phone1',null,['class'=>'form-control','placeholder'=>'Ingrese un numero Teléfonico', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','readOnly']); ?>

                  </div>
                  <div class="form-group">
                     <label for="phone2"> <strong>Telefono 2:</strong></label>
                     <?php echo Form::text('phone2',null,['class'=>'form-control','placeholder'=>'Ingrese un segundo numero Teléfonico Opcional', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','readOnly']); ?>

                  </div>
                  <div class="form-group">
                     <label for="Agregado Por:"> <strong>Agregado Por:</strong></label>
                     <?php echo Form::text('addFor',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;', 'readOnly','readOnly' ]); ?>

                  </div>
               </div>

               <div class="form-group col-sm-6">
                  <div class="form-group">
                     <label for="email"> <strong>Correo:</strong></label>
                     <?php echo Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese un Correo Electronico', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','readOnly']); ?>

                  </div>
                     <div class="form-group">
                        <label for="password"> <strong>Clave:</strong></label>
                        <?php echo Form::password('password',['class'=>'form-control','placeholder'=>'', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','readOnly']); ?>

                     </div>

                  <div class="form-group">
                     <label for="address"> <strong>Dirección:</strong></label>
                     <?php echo Form::text('address',null,['class'=>'form-control','placeholder'=>'Ingrese una Dirección del Cliente', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','readOnly']); ?>

                  </div>
                  <div class="form-group">
                     <label for="city"> <strong>Ciudad:</strong></label>
                     <?php echo Form::text('city',null,['class'=>'form-control','placeholder'=>'Ingrese la Ciudad del Cliente', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','readOnly']); ?>

                  </div>
                  <div class="form-group">
                     <?php if(isset($customer->created_at)): ?>
                        <input type="hidden" value="<?php echo e($create = $customer->created_at->format('d-m-Y')); ?>">
                        <label for="fecha"> <strong>Fecha de Inicio</strong></label>
                        <?php echo Form::text('fecha',$create,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;', 'readOnly' ]); ?>

                     <?php endif; ?>
                  </div>
               </div>
               <div class="form-group col-sm-12">
                  <?php echo Form::hidden('seller_id',Auth::user()->id); ?>

                  <?php if($customer->stateUser != 'Deshabilitado' and Auth::user()->role == 'Administrador'): ?>
                  <?php echo Form::submit('Guardar Cambios',['class'=>'btn btn-primary']); ?>

                  <?php endif; ?>
                  <a class="btn btn-default "href="<?php echo e(route('customersDetails',$customer->id)); ?>">Cancelar</a>
                  <?php if($customer->stateUser != 'Deshabilitado' and Auth::user()->role == 'Administrador'): ?>
                  <a href="<?php echo e(route('disabled',$customer->id)); ?>" class="btn btn-danger pull-right" onclick="confirm('¿Esta segur@ de deshabilitar este Usuario?')">Deshabilitar</a>
                  <?php endif; ?>
                  <?php if($customer->stateUser == 'Deshabilitado' and Auth::user()->role == 'Administrador'): ?>
                     <a href="<?php echo e(route('enableUser',$customer->id)); ?>" class="btn btn-success pull-right" onclick="confirm('¿Esta segur@ de Habilitar este Usuari@?')"><strong>Habilitar</strong></a>
                  <?php endif; ?>
               </div>
         <?php echo Form::close(); ?>

      <?php endif; ?>
   </div>


</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>