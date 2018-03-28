<?php $__env->startSection('htmlheader_title'); ?>
   Cliente: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Cliente: <strong><?php echo e($customer->name); ?></strong><?php if($customer->stateUser == 'Deshabilitado'): ?> <span style="color:rgb(236, 54, 29)">/Deshabilitado</span> <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('customers.index')); ?>"><i class="fas fa-backward"></i>

<strong>Atras</strong>
   </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>


   <div class="row">
      <div class="" style="">
         <div class="col-sm-6">
            <div class="panel" style="border-radius:15px">
               <div class="panel-heading bg-primary">
                  <strong style="text-align: center;">Datos Personales</strong>
               </div>
               <div class="panel-body">
                  <ul style="list-style:none;padding:10px">
                     <li><strong>Nombres:</strong> <?php echo e($customer->name); ?></li>
                     <li><strong>Cedula:</strong> <?php echo e($customer->idNumber); ?></li>
                     <li><strong>Teléfono 1:</strong> <?php echo e($customer->phone1); ?></li>
                     <li><strong>Teléfono 2:</strong> <?php echo e($customer->phone2); ?></li>
                     <li><strong>Correo:</strong> <?php echo e($customer->email); ?></li>
                     <li><strong>Ciudad:</strong> <?php echo e($customer->city); ?></li>
                     <li><strong>Dirección:</strong> <?php echo e($customer->address); ?></li>
                     <?php if(isset($customer->seller->name)): ?>
                     <li><strong>Vendedor Asignado:</strong> <?php echo e($customer->seller->name); ?></li>
                     <?php endif; ?>
                      <?php if($customer->stateUser == 'Deshabilitado'): ?> <li><strong>Estado de Cuenta:</strong> <strong style="color:rgb(236, 54, 29)">Deshabilitada</strong></li> <?php endif; ?>

               </ul>
               </div>
            </div>
            <div class="panel" style="padding:15px">

               <?php if($customer->stateUser != 'Deshabilitado'): ?>
                  <a style="margin-bottom:10px;" data-toggle="tooltip" data-placement="top" title="Pagos Pendientes" class="btn btn-warning btn-lg" href="<?php echo e(route('customersServices',$customer->id)); ?>"><i class="far fa-credit-card"></i></a>

                     <a style="margin-bottom:10px;" data-toggle="tooltip" data-placement="top" title="Facturas" class="btn btn-success btn-lg" href="<?php echo e(route('invoiceList',$customer->id)); ?>"><i class="fas fa-list-alt"></i></a>
                     <?php if(Auth::user()->role == 'Administrador'): ?>
                        <a style="margin-bottom:10px;background:rgb(118, 154, 41)"data-toggle="tooltip" data-placement="top" title="Factura Ocasional" class="btn btn-primary btn-lg" href="<?php echo e(route('invoiceOccasional',$customer->id)); ?>"><i class="far fa-list-alt"></i></a>
                     <?php endif; ?>
                     <a style="margin-bottom:10px;" data-toggle="tooltip" data-placement="top" title="Vehiculos del Cliente" class="btn btn-primary btn-lg" href="<?php echo e(route('customersVehicles',$customer->id)); ?>"><i class="fa fa-car" aria-hidden="true"></i></a>



                     <a style="margin-bottom:10px;" data-toggle="tooltip" data-placement="top" title="Documentos" class="btn btn-default btn-lg" href="<?php echo e(route('listDocuments',$customer->id)); ?>"><i class="far fa-folder-open"></i>
                     </a>

                     <a style="margin-bottom:10px;background:rgb(176, 174, 179)"data-toggle="tooltip" data-placement="top" title="Anotaciones/Observaciones" class="btn btn-primary btn-lg" href="<?php echo e(route('notesList',$customer->id)); ?>"><i class="far fa-clipboard"></i>
                     </a>


               <?php endif; ?>
                  <?php if(5 == 4): ?>

                     <a style="margin-bottom:10px;background:rgba(31, 55, 108, 0.77)" data-toggle="tooltip" data-placement="top" title="Enviar Mensaje" class="btn btn-lg btn-primary" href="<?php echo e(route('sendSms',$customer->id)); ?>"><i class="far fa-comment-alt"></i></a>
                     <a style="margin-bottom:10px;background:rgb(106, 63, 187)"data-toggle="tooltip" data-placement="top" title="Enviar Correo" class="btn btn-primary btn-lg" href="<?php echo e(route('mailCustomer',$customer->id)); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                  <?php endif; ?>
                  <a style="margin-bottom:10px; background:rgba(38, 187, 179, 1)" data-toggle="tooltip" data-placement="top" title="Datos de Usuario" class="btn btn-lg btn-success" href="<?php echo e(route('customers.edit',$customer->id)); ?>"><i class="fas fa-user"></i></a>


            </div>



               <div class="panel panel" style="border-radius:15px">
                  <div class="panel-heading bg-primary">
                     <strong style="text-align: center;">Servicios Afiliados:</strong>
                  </div>
                  <div class="panel-body">
                     <div class="panel-body row">
                        <div class="col-sm-10">
                           <ul style="padding:10px">
                              <?php if($services_vehiclesCount > 0): ?>
                              <ul style="list-style:none;padding:5px">
                                 <?php $__currentLoopData = $services_vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li> <strong><?php echo e($sv->services->name); ?></strong> Asociado al Vehiculo: <strong><?php echo e($sv->vehicles->plate); ?></strong> Con un Pago Mensual de: <strong><?php echo e($sv->services->payment); ?></strong></li>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                              <?php else: ?>
                                 Sin Servicios Afiliados
                              <?php endif; ?>
                           </ul>
                        </div>
                        <div class="col-sm-2">
                           <?php if($customer->stateUser != 'Deshabilitado'): ?>
                           <a style="margin-top:20px;" data-toggle="tooltip" data-placement="top" title="Pagos Pendientes" class="btn btn-warning btn-lg" href="<?php echo e(route('customersServices',$customer->id)); ?>"><i class="far fa-credit-card"></i></a>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>










         </div>
         <div class="col-sm-6">
            <div class="panel" style="border-radius:15pxs">
               <div class="panel-heading bg-primary">
                  <strong style="text-align: center;">Vehiculos Afiliados</strong>
               </div>
               <div class="panel-body">
                  <div class="panel-body row">
                     <div class="col-sm-10">
                        <ul style="list-style:none;padding:5px">
                           <?php if($vehiclesCount > 0): ?>
                           <ul style="list-style:none;padding:5px">
                                 <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><strong><?php echo e($v->name); ?>: </strong> Año:  <strong><?php echo e($v->year); ?></strong>, Placa: <strong><?php echo e($v->plate); ?></strong>,Inicio: <strong><?php echo e($v->created_at->format('d-m-Y')); ?></strong></li>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </ul>
                           <?php else: ?>
                              <p>Sin Vehículos Afiliados</p>
                           <?php endif; ?>
                        </ul>
                     </div>
                     <div class="col-sm-2">
                        <?php if($customer->stateUser != 'Deshabilitado'): ?>
                        <a style="margin-top:20px" data-toggle="tooltip" data-placement="top" title="Vehiculos del Cliente" class="btn btn-primary btn-lg pull-right" href="<?php echo e(route('customersVehicles',$customer->id)); ?>"><i class="fa fa-car" aria-hidden="true"></i></a>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>

            </div>
            <div class="panel" style="border-radius:15px">
               <div class="panel-heading bg-primary">
                  <strong style="text-align: center;">Facturas Penientes:</strong>
               </div>
               <div class="panel-body row">
                  <div class="col-sm-10">
                     <ul style="padding:10px;margin-left:18px">
                        <?php if($invoicesCount > 0): ?>
                           <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($invoice->type != 'Occasional'): ?>
                                 <a href="<?php echo e(route('invoiceDetails',$invoice->id)); ?>"><li style="">Factura del Periodo: <strong><?php echo e($invoice->invoiceperiod); ?></strong>, Nro: <strong><?php echo e(str_pad($invoice->number, 3, "0", STR_PAD_LEFT)); ?></strong>, Estado: <?php if($invoice->statePayment == 'Pago Confirmado'): ?>
                                    <strong><?php echo e('Factura Cancelada'); ?></strong>
                                 <?php elseif($invoice->stateSend == 'Pago Realizado'): ?>
                                    <strong style="color:white;background:rgb(56, 214, 0);padding:1px;border-radius:5px"> <?php echo e($invoice->statePayment); ?> / Pago Realizado</strong>
                                 <?php elseif(\Carbon\Carbon::parse($invoice->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                                    ): ?>
                                    <strong style="color:rgb(195, 32, 42)">Retrazo</strong>
                                 <?php elseif($invoice->paymentTimely < \Carbon\Carbon::now()->addDays(-1)): ?>
                                    <strong style="color:rgb(195, 32, 42)"><?php echo e($invoice->statePayment); ?></strong>

                                 <?php elseif(Auth::User()->role == 'Cliente' and $invoice->statePayment != 'Pago Confirmado'): ?>
                                    <strong style="background:rgb(22, 171, 64);color:white;padding:2px;border-radius:10px;">Pago Pendiente</strong>
                                 <?php elseif($invoice->statePayment == 'Pendiente'): ?>
                                    <strong style="color:rgb(9, 145, 55)"><?php echo e($invoice->statePayment); ?></strong>
                                 <?php endif; ?>

                                 <?php if($invoice->stateSend == 'Sin Enviar' and $invoice->statePayment != 'Pago Confirmado' ): ?>
                                    <strong style="color:rgba(230, 178, 20, 0.92)">    / <?php echo e($invoice->stateSend); ?></strong>
                                 <?php endif; ?>,
                                 Monto: <strong><?php echo e($invoice->total); ?></strong></li></a>
                              <?php else: ?>
                                    <a href="<?php echo e(route('invoiceOccasionalDetails',$invoice->id)); ?>"><li style="">Factura del Periodo: <strong><?php echo e($invoice->invoiceperiod); ?></strong>,Nro:<strong><?php echo e(str_pad($invoice->number, 3, "0", STR_PAD_LEFT)); ?></strong>, Estado: <?php if($invoice->statePayment == 'Pago Confirmado'): ?>
                                       <strong><?php echo e('Factura Cancelada'); ?></strong>
                                    <?php elseif($invoice->stateSend == 'Pago Realizado'): ?>
                                       <strong style="color:white;background:rgb(56, 214, 0);padding:1px;border-radius:5px"> <?php echo e($invoice->statePayment); ?> / Pago Realizado</strong>
                                    <?php elseif(\Carbon\Carbon::parse($invoice->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                                       ): ?>
                                       <strong style="color:rgb(195, 32, 42)">Retrazo</strong>
                                    <?php elseif($invoice->paymentTimely < \Carbon\Carbon::now()->addDays(1)): ?>
                                       <strong style="color:rgb(195, 32, 42)"><?php echo e($invoice->statePayment); ?></strong>

                                    <?php elseif(Auth::User()->role == 'Cliente' and $invoice->statePayment != 'Pago Confirmado'): ?>
                                       <strong style="background:rgb(22, 171, 64);color:white;padding:2px;border-radius:10px;">Pago Pendiente</strong>
                                    <?php elseif($invoice->statePayment == 'Pendiente'): ?>
                                       <strong style="color:rgb(9, 145, 55)"><?php echo e($invoice->statePayment); ?></strong>
                                    <?php endif; ?>

                                    <?php if($invoice->stateSend == 'Sin Enviar' and $invoice->statePayment != 'Pago Confirmado' ): ?>
                                       <strong style="color:rgba(230, 178, 20, 0.92)">    / <?php echo e($invoice->stateSend); ?></strong>
                                    <?php endif; ?>,
                                    Monto: <strong><?php echo e($invoice->total); ?></strong></li></a>
                              <?php endif; ?>

                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                           No existen Facturas Pendientes
                        <?php endif; ?>
                     </ul>

                     <?php if(isset($invoice->estate) and $invoice->estate == 'Pago Realizado'): ?>
                     <div class="bg-info">
                        <p>El cliente ha confirmado el pago de la ultima factura</p>
                        <a href="<?php echo e(route('invoiceDetails',$invoice->id)); ?>" class="btn btn-info">Verificar</a>
                     </div>
                     <?php endif; ?>
                  </div>
                  <div class="col-sm-2">
                     <a style="margin-top:30px;" data-toggle="tooltip" data-placement="top" title="Facturas" class="btn btn-success btn-lg" href="<?php echo e(route('invoiceList',$customer->id)); ?>"><i class="fas fa-list-alt"></i></a>
                  </div>

               </div>
                  <?php if(isset($invoice->estate) and $invoice->estate != 'Pago Confirmado' and Auth::user()->role == 'Cliente' and $invoice->estate != 'Pago Realizado'): ?>
               <div class="panel-footer">
                     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalconfirm"><strong>Confirmar Pago de Ultima Factura </strong></button>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>

      <div class="">
         <div class="" style="margin-top:30px">
         </div>
      </div>

      </div>


      <!-- Modal -->
      <div class="modal fade" id="modalconfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="color:white;background:rgb(44, 97, 176)">
               <?php if(isset($invoice->invoiceperiod)): ?>
              <span style="font-size:20px"id="exampleModalLabel">Confirmacion del Pago de factura: <?php echo e($invoice->invoiceperiod); ?></span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <strong>!Atencion¡</strong>
               <p>Al Presionar el boton Aceptar estara Confirmando, que a Cancelado el Monto Total de la Factura del Periodo: <strong><?php echo e($invoice->invoiceperiod); ?></strong></p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <a href="<?php echo e(route('invoiceConfirmCustomer',$invoice->id)); ?>" class="btn btn-primary">Aceptar</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>