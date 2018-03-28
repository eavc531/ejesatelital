<?php $__env->startSection('htmlheader_title'); ?>
	Crear Nuevo Usuario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
	Crear Nuevo Usuario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('users.index')); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

	<div class="panel" style="max-width:500px;margin: 0 auto;border-radius:15px">
		<div class="panel-heading bg-primary">
			<strong>Crear Nuevo Usuario</strong>
		</div>
		<div class="panel-body">
			<?php echo Form::open(['route'=>'users.store','method'=>'POST']); ?>

            <div class="form-group">
               <?php echo Form::label('name','Nombre:',['style'=>'font-weight: bold']); ?>

               <?php echo Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Usuario']); ?>

            </div>
				<div class="form-group">
               <?php echo Form::label('Email','email:',['style'=>'font-weight: bold']); ?>

               <?php echo Form::email('email',null,['class'=>'form-control','placeholder'=>'Email del usuario']); ?>

            </div>
				<div class="form-group">
               <?php echo Form::label('password','Contraseña:',['style'=>'font-weight: bold']); ?>

               <?php echo Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña']); ?>

            </div>
				<div class="form-group">
               <?php echo Form::label('role','Rol:',['style'=>'font-weight: bold']); ?>

               <?php echo Form::select('role',['Vendedor' => 'Vendedor','Administrador' => 'Administrador'],null,['class'=>'form-control']); ?>

            </div>
            <div class="form-group">
               <?php echo Form::submit('Agregar',['class'=>'btn btn-primary']); ?>

					<a href="<?php echo e(route('users.index')); ?>" class="btn btn-default">Cancelar</a>
            </div>
         <?php echo Form::close(); ?>

		</div>
	</div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>