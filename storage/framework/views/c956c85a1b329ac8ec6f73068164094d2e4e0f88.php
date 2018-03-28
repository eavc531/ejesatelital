<?php $__env->startSection('htmlheader_title'); ?>
	Asignar Cliente: <?php echo e($customer->name); ?> a un Nuevo Vendedor
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Asignar Cliente: <?php echo e($customer->name); ?> a un Nuevo Vendedor
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('userClients',$user->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>


<div class="panel" style="max-width:800px;margin: 0 auto;border-radius:15px">
	<div class="panel-heading" style="background:rgb(32, 191, 105);color:white">
		<strong>Seleccione el Vendedor que Asignara a: <?php echo e($customer->name); ?></strong>
	</div>
	<div class="panel-body">
		<table class="table table-striped" style="background:white">
			<thead class="bg-default">
				<th>Nombre del Vendedor:</th>
				<th>Correo:</th>
            <th>Seleccionar:</th>
			</thead>
				<tbody>
					<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($user->role != 'Cliente'): ?>
						<tr>

							<td><?php echo e($user->name); ?></td>
							<td><?php echo e($user->email); ?></td>

							<td style="display:flex;flex-direction:row;">
                        <?php echo e(Form::open(['route'=>'assign','method'=>'POST'])); ?>

                        <?php echo e(Form::hidden('customer_id',$customer->id)); ?>

                        <?php echo e(Form::hidden('user_id',$user->id)); ?>

                        <button type="submit" class="btn btn-sm btn-primary"name="button"><i class="fas fa-check"></i></button>
                        <?php echo e(Form::close()); ?>

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