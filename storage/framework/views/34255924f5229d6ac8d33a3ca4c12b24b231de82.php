<?php $__env->startSection('htmlheader_title'); ?>
	Administración de Usuarios
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Administración de Usuarios
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('home')); ?>"><i class="fa fa-home" aria-hidden="true"></i><strong>Inicio</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

	<a style="margin-bottom:10px" href="<?php echo e(route('users.create')); ?>" class="btn btn-primary btn-lg"><strong>Crear nuevo Usuario</strong></a>

<div class="panel" style="max-width:1200px">
	<div class="panel-heading bg-primary">
		<strong>Usuarios</strong>
	</div>
	<div class="panel-body">
		<table class="table table-striped" style="background:white">
			<thead class="bg-default">
				<th>Nombre</th>
				<th>Correo</th>
				<th>Rol</th>
				<th>Acciones</th>
			</thead>
				<tbody>
					<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($user->role != 'Cliente'): ?>
						<tr>
							<td><?php echo e($user->name); ?></td>
							<td><?php echo e($user->email); ?></td>
							<td><?php echo e($user->role); ?></td>
							<td style="display:flex;flex-direction:row;">
								<a data-toggle="tooltip" data-placement="top" title="Editar Usuario" class="btn btn-success" href="<?php echo e(route('users.edit',$user->id)); ?>"><i class="fas fa-edit"></i></a>
									<a style="margin-left:5px" data-toggle="tooltip" data-placement="top" title="Clientes Asignados" class="btn btn-info" href="<?php echo e(route('userClients',$user->id)); ?>"><i class="fa fa-users" aria-hidden="true"></i></a>
								 <?php echo Form::open(['route'=>['users.destroy',$user->id],'method'=>'DELETE']); ?>


									 <button  style="margin-left:5px" class='btn btn-danger' type='submit' value='submit' onclick="return confirm('¿Esta Segur@ de Eliminar este Usuario?')" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Eliminar Usuario">
										 <i class="fas fa-times-circle"></i>

									</button>


								 <?php echo Form::close(); ?>



							</td>
						</tr>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			<tfoot>
			</tfoot>
		</table>
	</div>
	<div class="panel-footer">
		<?php echo e($users->links()); ?>

	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>