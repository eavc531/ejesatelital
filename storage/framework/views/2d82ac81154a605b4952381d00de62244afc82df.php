<?php $__env->startSection('htmlheader_title'); ?>
   Servicios del Vehiculo: <?php echo e($vehicle->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Servicios del Vehiculo: <?php echo e($vehicle->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style=""class="btn btn-default" href="<?php echo e(route('customersVehicles',$vehicle->customer->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="color:white" class="btn btn-primary" href="<?php echo e(route('customersDetails',$vehicle->customer->id)); ?>"data-toggle="tooltip" data-placement="top" title="Detalles de Usuario"><strong>Detalles Usuario</strong></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

   <div class="panel" style="max-width:600px">
      <div class="panel-heading bg-primary">
         <strong>Añadir Servicio a: <?php echo e($vehicle->name); ?></strong>

      </div>
      <div class="panel-body">
            <?php echo Form::open(['route'=>'vehiclesServices.store', 'method'=>'POST']); ?>

            <div class="col-sm-10">
                  <?php echo Form::select('services_id',$serviceslist, null,['class'=>'form-control','placeholder'=>'Seleccione un Servicio', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px; color: #000;']); ?>

                  <?php echo Form::hidden('vehicles_id',$vehicle->id); ?>

                  <?php echo Form::hidden('customers_id',$vehicle->customer_id); ?>

            </div>

            <div class="col-sm-2">
               <?php echo Form::submit('Agregar',['class'=>'btn btn-primary']); ?>


            </div>
            <?php echo Form::close(); ?>



      </div>
   </div>
   <div class="panel">
      <div class="panel-heading bg-primary">
         <strong>Servicios del Vehiculo: <?php echo e($vehicle->name); ?></strong>
      </div>
      <div class="panel-body">
         <table class="table table-striped">
            <thead>
               <th>Nombre:</th>
               <th>Pago:</th>
               <th>Descripción:</th>
               <?php if(Auth::user()->role == 'Administrador'): ?>
               <th>Acciones:</th>
               <?php endif; ?>
            </thead>
            <tbody>
               <?php $__currentLoopData = $serviceVehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                     <td><?php echo e($s->services->name); ?></td>
                     <td><?php echo e($s->services->payment); ?></td>
                     <td><?php echo e($s->services->description); ?></td>
                     <?php if(Auth::user()->role == 'Administrador'): ?>
                     <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-placement="top" title="Eliminar Servicio" data-target="#deleteServiceV" OnClick="servicioDestroy(<?php echo e($s->services_id); ?>)">
                     <i class="fas fa-times-circle"></i></button>
                  </td>
                     <?php endif; ?>
                  </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </table>
      </div>
      </div>
   </div>


   <!-- Modal -->
   <div class="modal fade" id="deleteServiceV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header" style="color:white;background:rgba(212, 10, 4, 0.78)">
           <h5 class="modal-title" id="exampleModalLabel"><strong>!Atencion¡</strong></h5>
           </button>
         </div>
         <div class="modal-body">
            <strong>¿Esta Segur@ de Querer Eliminar este servicio?</strong>
         </div>
         <div class="modal-footer">


               <?php echo Form::open(['route'=>'serviceVDestroy', 'method'=>'POST']); ?>

               <?php echo Form::hidden('service_id',null,['id'=>'serviceDestroy']); ?>

               <?php echo Form::hidden('vehicle_id',$vehicle->id); ?>

               <?php echo Form::submit('Acepta',['class'=>'btn btn-danger pull-right']); ?>


              <?php echo Form::close(); ?>

              <button style="margin-right:10px;margin-top:-13px" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

         </div>
       </div>
     </div>
   </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scriptpersonal'); ?>
   <script type="text/javascript">


   function servicioDestroy(device_id){

      $('#serviceDestroy').val(device_id);
   }
   </script>
<?php echo $__env->yieldSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>