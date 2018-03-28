<?php $__env->startSection('htmlheader_title'); ?>
   Vehiculos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Vehículos del Usuario: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('customersDetails',$customer->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
   <div class="row">
      <div class="col-lg-3 col-md-3">
         <div class="panel">
            <div class="panel-heading bg-primary">
               <strong>Agregar Vehiculos</strong>
            </div>
            <div class="panel-body">
               <?php echo Form::open(['route'=>'storeVehicles', 'method'=>'POST']); ?>

               <div class="form-group">
                  <div class="form-group">
                     <?php echo Form::label('Nombre:'); ?>

                     <?php echo Form::text('name',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                  </div>

                  <div class="form-group">
                     <?php echo Form::label('Placa:'); ?>

                     <?php echo Form::text('plate',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                  </div>
               <div class="form-group">
                     <?php echo Form::label('Año:'); ?>

                     <?php echo Form::text('year',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                     <?php echo Form::hidden('customer_id',$customer->id); ?>

                  </div>

               </div>
               <div class="form-group">
                  <?php echo Form::submit('Agregar Vehiculo',['class'=>'btn btn-primary']); ?>


                  <?php echo Form::close(); ?>

               </div>

            </div>
         </div>
      </div>

      <div class="col-lg-9 col-md-9">
         <div class="panel">
            <div class="panel-heading bg-primary">
               <strong>Vehículos del Usuario: <?php echo e($customer->name); ?></strong>
            </div>
            <div class="panel-body">
               <table class="table table-striped">
                  <thead>
                     <th>Nombre:</th>
                     <th>Placa:</th>
                     <th>Año:</th>
                     <th>Inicio</th>
                     <th>Acciones</th>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($v->name); ?></td>
                           <td><?php echo e($v->plate); ?></td>
                           <td><?php echo e($v->year); ?></td>
                           <td><?php echo e($v->created_at->format('m-d-Y')); ?></td>
                           <td><a data-toggle="tooltip" data-placement="top" title="Agregar Servicios" class="btn btn-primary" href="<?php echo e(route('addService',$v->id)); ?>"> <i class="fa fa-wrench" aria-hidden="true"></i></a>
                           <a data-toggle="tooltip" data-placement="top" title="Administrar Dispositivos" class="btn btn-info" href="<?php echo e(route('devicesList',$v->id)); ?>"><i class="fa fa-microchip" aria-hidden="true"></i></a>
                           <?php if(Auth::user()->role == 'Administrador'): ?>
                           <a onclick="confirm('¿Esta Segur@ de Eliminar este Vehículo?')"data-toggle="tooltip" data-placement="top" title="Eliminar Vehículo"href="<?php echo e(route('vehicleDestroy',$v->id)); ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i></a>
                           <?php endif; ?>
                           </td>

                        </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </table>
            </div>
         </div>

      </div>
   </div>






   <?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>