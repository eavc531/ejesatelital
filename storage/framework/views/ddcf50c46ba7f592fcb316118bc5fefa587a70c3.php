<?php $__env->startSection('htmlheader_title'); ?>
   Dispositivos del Vehiculo: <?php echo e($vehicle->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Dispositivos del Vehiculo: <?php echo e($vehicle->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a class="btn btn-default" href="<?php echo e(route('customersVehicles',$vehicle->customer->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="color:white" class="btn btn-primary" href="<?php echo e(route('customersDetails',$vehicle->customer->id)); ?>"data-toggle="tooltip" data-placement="top" title="Detalles de Usuario"><strong>Detalles Usuario</strong></a>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('main-content'); ?>
   <div class="row">
      <div class="col-md-3">
         <div class="panel" style="max-width:250px">
            <div class="panel-heading bg-primary">
               <strong>Agregar Dispositivo</strong>
            </div>
            <div class="panel-body">
                     <?php echo Form::open(['route'=>'devices.store', 'method'=>'POST']); ?>

                  <div class="form-group">

                     <?php echo Form::label('Nombre:'); ?>

                     <?php echo Form::text('name',null,['class'=>'form-control',    'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>


                     <?php echo Form::label('SIM:'); ?>

                     <?php echo Form::text('sim',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>


                     <?php echo Form::label('IMEI:'); ?>

                     <?php echo Form::text('imei',null,['class'=>'form-control','style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']); ?>

                     <?php echo Form::hidden('vehicle_id',$vehicle->id); ?>


                     <?php echo Form::label('Pertenencia:'); ?>

                     <?php echo Form::select('membership',['Propio'=>'Propio','Conmodato'=>'Conmodato'],null,['class'=>'form-control','style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','placeholder'=>'Opcion']); ?>

                     <?php echo Form::hidden('vehicle_id',$vehicle->id); ?>

                  </div>
                  <div class="form-group" style="margin-top:20px">
                     <?php echo Form::submit('Agregar',['class'=>'btn btn-primary']); ?>

                     <?php echo Form::close(); ?>

                  </div>
               </div>
         </div>
      </div>


      <div class="col-md-9">
         <div class="panel">
            <div class="panel-heading bg-primary">
               Dispositivos Instalados
            </div>
            <div class="panel-body">
               <table class="table table-striped">
                  <thead class="bg-default">
                     <th>Nombre:</th>
                     <th>SIM:</th>
                     <th>IMEI:</th>
                     <th>Perntenencia:</th>
                     <th>Inicio:</th>
                     <?php if(Auth::user()->role == 'Administrador'): ?>
                     <th>Acciones:</th>
                     <?php endif; ?>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($d->name); ?></td>
                           <td><?php echo e($d->sim); ?></td>
                           <td><?php echo e($d->imei); ?></td>
                           <td><?php echo e($d->membership); ?></td>
                           <td><?php echo e($d->created_at->format('d-m-Y')); ?></td>
                           <?php if(Auth::user()->role == 'Administrador'): ?>
                           <td>
                           <a data-toggle="tooltip" data-placement="top" title="Editar Dispositivo" href="<?php echo e(route('devices.edit',$d->id)); ?>" class="btn btn-success"><i class="far fa-edit"></i></a>

                           <button type="button" class="btn btn-danger" data-toggle="modal" data-placement="top" title="Eliminar Dispositivo" data-target="#exampleModal" OnClick="deleteDevice(<?php echo e($d->id); ?>)">
                             <i class="fas fa-times-circle"></i></button>
                           </td>
                           <?php endif; ?>
                        </tr>

                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
               </table>
            </div>
         </div>


         <div class="panel">
            <div class="panel-heading" style="color:white;background:rgb(184, 63, 71)">
               Dispositivos Desinstalados
            </div>
            <div class="panel-body">
               <table class="table table-striped">
                  <thead class="bg-default">
                     <th>Nombre:</th>
                     <th>SIM:</th>
                     <th>IMEI:</th>
                     <th>Desinstalación:</th>
                  </thead>
                  <tbody>
                     <?php $__currentLoopData = $devicesUninstalled; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $du): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($du->name); ?></td>
                           <td><?php echo e($du->sim); ?></td>
                           <td><?php echo e($du->imei); ?></td>
                           <td><?php echo e($du->created_at->format('d-m-Y')); ?></td>
                        </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
               </table>
            </div>
         </div>

      </div>


   </div>
   <!--col-2-->






<!--Modal-->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="color:white;background:rgba(212, 10, 4, 0.78)">
        <h5 class="modal-title" id="exampleModalLabel"><strong>!Atencion¡</strong></h5>
        </button>
      </div>
      <div class="modal-body">
         <strong>¿Esta Segur@ de Querer Eliminar este Dispositivo?</strong>
      </div>
      <div class="modal-footer">


            <?php echo Form::open(['route'=>'deviceDestroy', 'method'=>'POST']); ?>

            <?php echo Form::hidden('device_id',null,['id'=>'deviceDestroy']); ?>

            <?php echo Form::submit('Acepta',['class'=>'btn btn-danger pull-right']); ?>

           <?php echo Form::close(); ?>

           <button style="margin-top:-14px;margin-right:10px" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>



      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scriptpersonal'); ?>
   <script type="text/javascript">


   function deleteDevice(device_id){
      $('#deviceDestroy').val(device_id);
   }
   </script>
<?php echo $__env->yieldSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>