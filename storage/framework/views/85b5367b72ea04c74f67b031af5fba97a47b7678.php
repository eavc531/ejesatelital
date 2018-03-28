<?php $__env->startSection('htmlheader_title'); ?>
	Clientes Asignados a: <?php echo e($user->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Clientes Asignados a: <?php echo e($user->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('users.index')); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>


<div class="panel" style="max-width:1200px">
	<div class="panel-heading bg-primary">
		<strong>Usuarios</strong>
	</div>
	<div class="panel-body">
		<table class="table table-striped" style="background:white">
			<thead class="bg-default">
				<th>Nombre de Cliente:</th>
				<th>Correo:</th>

			</thead>
				<tbody>
					<?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

						<tr>
							<td><?php echo e($c->name); ?></td>
							<td><?php echo e($c->email); ?></td>

							<td style="display:flex;flex-direction:row;">
								<a data-toggle="tooltip" data-placement="top" title="Asignar a Otro Vendedor" class="btn btn-success" href="<?php echo e(route('assignCustomer',$c->id)); ?>"><i class="fas fa-exchange-alt"></i></a>

							</td>
						</tr>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			<tfoot>


			</tfoot>
		</table>
	</div>
	<div class="panel-footer">
		<?php echo e($customers->links()); ?>

	</div>
</div>







<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>