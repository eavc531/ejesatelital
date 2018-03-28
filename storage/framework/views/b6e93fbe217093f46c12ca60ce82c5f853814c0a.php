<?php $__env->startSection('htmlheader_title'); ?>
   Facturas: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Facturas: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style=""class="btn btn-default" href="<?php echo e(route('customersDetails',$customer->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <?php if(Auth::user()->role != 'Cliente'): ?>
   <a style="color:white" data-toggle="tooltip" data-placement="top" title="Pagos Pendientes" class="btn btn-warning" href="<?php echo e(route('customersServices',$customer->id)); ?>"></i><strong>Pagos Pendienes</strong></a>
   <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

   <div class="panel panel">
      <div class="panel-heading bg-primary">
         <strong>Facturas: <?php echo e($customer->name); ?></strong>
      </div>
      <div class="panel-body">
         <table class="table table-striped">
            <thead class="">

               <th>Cliente:</th>
               <th>Fecha de Elaboracion:</th>
               <th>Periodo de Facturacion:</th>
               <th>Pago Oportuno:</th>
               <th>Estado:</th>
               <th>Acciones:</th>
            </thead>
            <tbody>

               <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>

                     <td><?php echo e($invoice->customer->name); ?></td>
                     <td><?php echo e(\Carbon\Carbon::parse($invoice->dateIni)->format('d-m-Y')); ?></td>
                     <td><?php echo e($invoice->invoiceperiod); ?></td>
                     <td><?php echo e(\Carbon\Carbon::parse($invoice->paymentTimely)->format('d-m-Y')); ?></td>
                     <td>

                        <?php if($invoice->statePayment == 'Pago Confirmado'): ?>
                           <strong><?php echo e('Factura Cancelada'); ?></strong>
                        <?php elseif($invoice->statePayment == 'Pago Realizado'): ?>
                           <strong style="color:rgb(2, 117, 2)"> <?php echo e($invoice->statePayment); ?>/Por Confirmar</strong>
                        <?php elseif(\Carbon\Carbon::parse($invoice->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                           ): ?>
                           <strong style="color:rgb(195, 32, 42)">Retrazo</strong>
                        <?php elseif($invoice->paymentTimely < \Carbon\Carbon::now()->addDays(1)): ?>
                           <strong style="color:rgb(195, 32, 42)"><?php echo e($invoice->statePayment); ?></strong>
                        <?php elseif($invoice->statePayment == 'Pendiente'): ?>
                           <strong style="color:rgb(9, 145, 55)"><?php echo e($invoice->statePayment); ?></strong>
                        <?php endif; ?>

                        <?php if($invoice->stateSend == 'Sin Enviar' and $invoice->statePayment != 'Pago Confirmado' and Auth::user()->role != 'Cliente'): ?>
                           <strong style="color:rgba(230, 178, 20, 0.92)"> / <?php echo e($invoice->stateSend); ?></strong>
                        <?php endif; ?>
                     </td>
                     <td>
                        <?php if($invoice->type != 'Occasional'): ?>
                           <a class="btn btn-primary" href="<?php echo e(route('invoiceDetails',$invoice->id)); ?>"><i class="fas fa-sign-in-alt"></i></a>
                        <?php else: ?>
                           <a class="btn btn-primary" href="<?php echo e(route('invoiceOccasionalDetails',$invoice->id)); ?>"><i class="fas fa-sign-in-alt"></i></a>
                        <?php endif; ?>
                     </td>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
         </table>
      </div>
      <div class="panel-footer">
         <?php echo e($invoices->links()); ?>

      </div>
      </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>