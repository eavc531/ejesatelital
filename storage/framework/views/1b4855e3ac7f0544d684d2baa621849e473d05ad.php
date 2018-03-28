<?php $__env->startSection('htmlheader_title'); ?>
   Administrar Servicios
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Administrar Servicios
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('home')); ?>"><i class="fa fa-home" aria-hidden="true"></i><strong>Inicio</strong>
   </a>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
   <a style="margin-bottom:20px" class="btn btn-primary btn-lg" href="<?php echo e(route('services.create')); ?>">Agregar Servicio</a>
   <div class="panel panel">
      <div class="panel-heading bg-primary">
         Administrar Servicios
      </div>
      <div class="panel-body">
         <table class="table table-striped">
            <thead>
               <th>Nombre:</th>
               <th>Descripción:</th>
               <th>Mensualidad:</th>
               <th>Acciones:</th>
            </thead>
            <tbody>

               <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                     <td><?php echo e($s->name); ?></td>
                     <td><?php echo e($s->description); ?></td>
                     <td><?php echo e($s->payment); ?></td>
                     <td style="display:flex">	<a data-toggle="tooltip" data-placement="top" title="Editar Servicio" class="btn btn-success" href="<?php echo e(route('services.edit',$s->id)); ?>"><i class="fas fa-edit"></i></a>

                     <?php echo Form::open(['route'=>['services.destroy',$s->id],'method'=>'DELETE']); ?>

                        <button  aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Eliminar Servicio" style="margin-left:5px" class='btn btn-danger' type='submit' value='submit' onclick="return confirm('Esta Segur@ de Eliminar este Servicio')">
                           <i class="fas fa-times-circle"></i>

                       </button>
                     <?php echo Form::close(); ?>

                  </td>
                  </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
         </table>
      </div>
      <div class="panel-footer">
         <?php echo e($services->links()); ?>

      </div>
      </div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>