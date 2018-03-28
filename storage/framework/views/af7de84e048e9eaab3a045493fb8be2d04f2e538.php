<?php $__env->startSection('htmlheader_title'); ?>
    Notificaciones
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Notificaciones
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('customers.index')); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>


   <div class="panel panel">
      <div class="panel-heading bg-primary" style="height:52px">
         <strong>Notificaciones</strong>
         <a class="btn btn-default pull-right" href="<?php echo e(route('notificationsViewed')); ?>"><strong>Notificaciones Vistas</strong></a>
      </div>

      <div class="panel-body">
         <table class="table table-striped" style="background:white">
            <thead>
               <th>Notificacion:</th>
               <th>Descripcion:</th>
               
               <th>Fecha:</th>
               <th>Acciones:</th>
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
                     <td><?php echo e($n->execute); ?></td>

                     <td><?php echo e($n->created_at->format('d-m-Y')); ?></td>
                     <td>
                     <?php if($n->notification == 'Nueva Nota Agregada'): ?>
                        <a href="<?php echo e(route('VerifiednotificationNewNote',['note_id'=>$n->id,'seller_id'=>$n->seller_id,'customer_id'=>$n->customer_id])); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Nota Agregada"><i class="fas fa-eye"></i></a>
                     <?php elseif($n->notification == 'Nuevo Documento Agregado'): ?>
                        <a href="<?php echo e(route('VerifiednotificationNewDocu',['note_id'=>$n->id,'seller_id'=>$n->seller_id,'customer_id'=>$n->customer_id])); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Documento Agregado"><i class="fas fa-eye"></i></a>
                     <?php elseif($n->notification == 'Documento Confirmado'): ?>
                        <a href="<?php echo e(route('VerifiednotificationNewDocu',['note_id'=>$n->id,'seller_id'=>$n->seller_id,'customer_id'=>$n->customer_id])); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Documento"><i class="fas fa-eye"></i></a>
                     <?php elseif($n->notification == 'Nuevo Usuario Agregado'): ?>
                        <a href="<?php echo e(route('VerifiednotificationNewUser',['note_id'=>$n->id,'seller_id'=>$n->seller_id,'customer_id'=>$n->customer_id])); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Usuario"><i class="fas fa-eye"></i></a>
                     <?php elseif($n->notification == 'Documento rechazado'): ?>

                     <?php endif; ?>

                     <?php if($n->notification != 'Nuevo Documento Agregado'): ?>
                        <a href="<?php echo e(route('verifiednotification',$n->id)); ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Marcar Notificación como vista"><i class="fas fa-check"></i></a></td>
                     <?php endif; ?>
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