<?php $__env->startSection('htmlheader_title'); ?>
    Notificaciones Vistas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Notificaciones Vistas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('customers.index')); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>


   <div class="panel panel">
      <div class="panel-heading bg-primary" style="height:52px">
         <strong>Notificaciones</strong>
         <a class="btn btn-default pull-right" href="<?php echo e(route('notifications')); ?>"><strong>Notificaciones</strong></a>
      </div>

      <div class="panel-body">
         <table class="table table-striped" style="background:white">
            <thead>
               <th>Notificacion:</th>
               <th>Descripcion:</th>

               <th>Fecha:</th>

            </thead>

            <tbody>
               <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                     <td>
                        <?php if($n->notification == 'Nueva Nota Agregada'): ?>
                           <strong style="color:rgb(6, 193, 181)"><?php echo e($n->notification); ?></strong>
                        <?php elseif($n->notification == 'Nuevo Documento Agregado'): ?>
                           <strong style="color:rgb(114, 142, 161)"><?php echo e($n->notification); ?></strong>
                        <?php elseif($n->notification == 'Documento Confirmado'): ?>
                           <strong style="color:rgb(1, 154, 71)"><?php echo e($n->notification); ?></strong>
                        <?php elseif($n->notification == 'Nuevo Usuario Agregado'): ?>
                           <strong style="color:rgb(0, 76, 224)"><?php echo e($n->notification); ?></strong>
                        <?php elseif($n->notification == 'Documento rechazado'): ?>
                           <strong style="color:rgb(215, 47, 47)"><?php echo e($n->notification); ?></strong>
                        <?php endif; ?>
                     </td>
                     <td><strong><?php echo e($n->execute); ?></strong></td>
                     
                     <td><?php echo e($n->created_at->format('d-m-Y')); ?></td>
                  </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
            <tfoot>
               <td colspan="5"><?php echo e($notifications->links()); ?></td>
            </tfoot>
         </table>

      </div>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>