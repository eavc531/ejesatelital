<?php $__env->startSection('htmlheader_title'); ?>
   Pagos Pendientes: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Pagos Pendientes: <?php echo e($customer->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader-button'); ?>
   <a style="margin-bottom:30px"class="btn btn-default" href="<?php echo e(route('customersDetails',$customer->id)); ?>"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="margin-bottom:30px;color:white"class="btn btn-success" href="<?php echo e(route('invoiceList',$customer->id)); ?>"><strong>Facturas</strong>
   </a>
   <a style="margin-bottom:30px;color:white" href="<?php echo e(route('customers.index')); ?>" class="btn btn-primary"><strong>Clientes</strong></a>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('main-content'); ?>

<div class="" style="background:blue">

</div>
   <div class="panel panel-default">
      <div class="panel-heading">
         <a href="<?php echo e(route('additionalServices',$customer->id)); ?>"><button class="btn btn-primary" type="button" name="button"><strong>Añadir Cargo Adicional</strong></button></a>


      </div>
      <div class="panel-body">
               <table class="table table-sm">
                  <tr>
                     <th>Fecha de Elaboración:
                        <input type="hidden" name="" value="<?php echo e($today = \Carbon\Carbon::now()); ?>">
                         <?php echo Form::date('dateIni',$dateIni,['id'=>'dateIni']); ?>

                      </th>

                  </tr>

                  <tr>
                     <th>
                        Meses: <?php echo e(Form::select('months',[0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],null,['id'=>'months'])); ?>

                      </th>
                  </tr>

               </table>


         <table class="table table-striped table-bordered">
          <thead style="background:rgb(90, 157, 182);color:white">
             <tr>
                <th class="service"><strong>Vehicle:</strong></th>
                 <th class="qty"><strong>Placa:</trong></th>
               <th class="service"><strong>Tipo de Servicio:</strong></th>
               <th class="desc"><strong>Descripción:</strong></th>
               <th><strong>VALOR:</strong></th>
             </tr>
          </thead>
          <input type="hidden" name="" value="<?php echo e($servicePrice=''); ?>">
           <input type="hidden" name="" value="<?php echo e($sum1=0); ?>">
           <input type="hidden" name="" value="<?php echo e($sum2=0); ?>">
           <input type="hidden" name="" value="<?php echo e($sum3=0); ?>">
          <tbody>
             <?php $__currentLoopData = $sv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr>
                  <td class="unit"><?php echo e($v->vehicles->name); ?></td>
                  <td class="unit"><?php echo e($v->vehicles->plate); ?></td>
                  <td class="unit"><input type="hidden" name="" value="<?php echo e($servicePrice .= $v->services->name); ?>"><?php echo e($v->services->name); ?></td>
                  <td class="unit"><?php echo e($v->services->description); ?></td>
                  <td class="unit"><input type="hidden" name="" value="<?php echo e($servicePrice .= $v->services->payment.','); ?>"><?php echo e($v->services->payment); ?></td>
                  <input type="hidden" name="" value="<?php echo e($sum1+= $v->services->payment); ?>">
                  <input type="hidden" name="" value="<?php echo e($sum3+= $v->services->payment); ?>">
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

             <?php $__currentLoopData = $servicesads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                   <td class="unit"></td>
                   <td class="unit"><?php echo e($sa->plate); ?></td>
                   <td class="unit"><?php echo e($sa->type); ?></td>
                   <td class="unit"><?php echo e($sa->description); ?></td>

                   <?php if($sa->type == 'Descuento'): ?>
                      <td class="unit">- <?php echo e($sa->payment); ?>

                        <?php if(auth::user()->role == 'Administrador'): ?>
                        <a href="<?php echo e(route('deleteSA',$sa->id)); ?>" onclick="return confirm('¿Esta Segur@ de Eliminar este Servicio Adicional de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>
                     </td>
                     <?php endif; ?>

                      <input type="hidden" name="" value="<?php echo e($sum2-= $sa->payment); ?>">
                       <input type="hidden" name="" value="<?php echo e($sum3-= $sa->payment); ?>">
                   <?php else: ?>

                      <td class="unit">
                        <?php echo e($sa->payment); ?>

                        <?php if(auth::user()->role == 'Administrador'): ?>
                        <a href="<?php echo e(route('deleteSA',$sa->id)); ?>" onclick="return confirm('¿Esta Segur@ de Eliminar este Servicio de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>


                     </td>
                        <?php endif; ?>
                      <input type="hidden" name="" value="<?php echo e($sum2+= $sa->payment); ?>">
                       <input type="hidden" name="" value="<?php echo e($sum3+= $sa->payment); ?>">
                   <?php endif; ?>

                   <td></td>
               </tr>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


          </tbody>
          <tfoot>
             <tr>
                <td class="unit"></td>
                <td class="unit"></td>
               <td class="unit"></td>
               <td class="qty"><strong>TOTAL:</strong></td>
               <td class="total"><strong><?php echo e($sum3); ?></strong></td>
             </tr>
          </tfoot>
         </table>

         <div class="pull-right">
            <?php if(Auth::user()->role == 'Administrador'): ?>
               <!-- Button trigger modal -->
               <button class="btn btn-success" type="button" name="button" onclick="invoiceCreate()"><strong>Generar factura</strong></button>
            <?php endif; ?>
         </div>



        </div>
        <input type="hidden" name="" value="<?php echo e($customer->id); ?>" id="customer_id">
        <input type="hidden" name="" value="<?php echo e($sum1); ?>" id="sumS">
         <input type="hidden" name="" value="<?php echo e($sum2); ?>" id="sumAd">
      </div>

   </div>

<?php echo $__env->make('customers.modalServices', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('customers.modalalertcreateinvoice', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scriptpersonal'); ?>
   <script type="text/javascript">


      function invoiceCreate(){

         //monthPeriod = $('#monthPeriod').val();
         //yearPeriod = $('#yearPeriod').val();

         //paymentTimely = $('#paymentTimely').val();
         sumS = $('#sumS').val();
         sumAd = $('#sumAd').val();
         months = $('#months').val();

         if(months == 0){
            mostrarAlert();

         }else{
               total = parseInt(sumS) * parseInt(months);
               total = parseInt(total) + parseInt(sumAd);

               customer_id = $('#customer_id').val();

               dateIni = $('#dateIni').val();
               months = $('#months').val();
               //invoiceperiod = monthPeriod + '-' +yearPeriod;



               route = "<?php echo e(route('invoice.store')); ?>";
               $.ajax({
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  type:'post',
                  url:route,
                  data:{dateIni:dateIni,months:months,customer_id:customer_id,total:total},
                  error:function(error){
                     $.each(error.responseJSON.errors, function(index, val){
                     errormsj+='<li>'+val+'</li>';
                     });
                     $('#text-error-e').html(errormsj);
                     $('#alert-error-e').fadeIn();
                     console.log(error);
                     },
                  success:function(result){
                     console.log(result);
                     if(result.error == 'existe'){
                        $("#ti2").html(result.message);
                        $('#alertinvoice2').modal('toggle');
                     }else if(result.exito == 'exito'){
                        $("#ti3").html(result.message);
                        $('#alertinvoice3').modal('toggle');
                     }else{
                        $('#alertinvoice').modal('toggle');
                     }


                  }

               });
            }

         }



      function mostrarAlert(){
         $('#alertinvoice4').modal('toggle');
      }

   </script>
<?php echo $__env->yieldSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>