<?php $__env->startSection('htmlheader_title'); ?>
    Anotaciones/Observaciones Sobre el Cliente: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Anotaciones/Observaciones Sobre el Cliente: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('customersDetails',$customer->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="margin-bottom:30px;color:white" href="<?php echo e(route('customers.index')); ?>" class="btn btn-primary"><strong>Clientes</strong></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
   <a style="margin-bottom:30px"class="btn btn-primary btn-lg" href="<?php echo e(route('notesCreate',$customer->id)); ?>">Agregar Nota</a>

   <div class="panel panel">
      <div class="panel-heading bg-primary">
         <strong>Enviar Email</strong>
      </div>

      <div class="panel-body">
         <table class="table">
            <th>Titulo:</th>
            <th>Contenido:</th>
            <th>Autor:</th>
            <th>Fecha:</th>
            <tbody>
               <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                     <td><?php echo e($n->title); ?></td>
                     <td><?php echo e($n->content); ?></td>
                     <td><?php echo e($n->Autor); ?></td>
                     <td><?php echo e($n->created_at->format('d-m-Y')); ?></td>
                     <td><a onclick="confirm('¿Esta Segur@ de Querer eliminar esta Nota?')" data-toggle="tooltip" data-placement="top" title="Eliminar Nota"  class="btn btn-danger btn-sm" href="<?php echo e(route('notesDestroy',$n->id)); ?>"><i class="far fa-times-circle"></i></a></td>
                  </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
            <tfoot>
               <td colspan="5"><?php echo e($notes->links()); ?></td>
            </tfoot>
         </table>

      </div>


</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>