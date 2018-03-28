<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo e('Factura:_'.$invoices->nameCustomer.'_Nro_'.$invoices->number); ?></title>

  <style media="screen">
           li {
         margin: 0px;
         padding: 0px;

         }
         ul {
         margin: 0px;
         padding: 0px;
         }


    </style>
  </head>
  <body>

    <header class="">
      <div class="" style="text-align:center">

      </div>

      <table>
         <tr>
            <td class="left">
               <ul style="list-style:none">
                  <li>Eje Satelital Cra 10 No. 14-71</li>
                  <li>Centro Comercial Éxito Local 102A</li>
                  <li>Pereira - Risaralda</li>
                  <li>NIT: 34066000-8</li>

                  <li style="margin-top:30px"><strong>CLIENTE</strong></li>
                  <li><strong>Nombre: </strong><?php echo e($invoices->nameCustomer); ?></li>
                  <li><strong>Cédula: </strong><?php echo e($invoices->idNumberCustomer); ?></li>
                  <li><strong>Dirección: </strong><?php echo e($invoices->customer->address); ?></li>
                  <li><strong>Factura Nro: </strong><?php echo e(str_pad($invoices->number, 3, "0", STR_PAD_LEFT)); ?></li>
               </ul>
            </td>
            <td class="service">
               <table style="margin-left:100px">
                  <tr>
                     <th><img style="margin-top:-30px" src="<?php echo e(asset('img/eje.png')); ?>" alt="icono"></th>
                  </tr>
                  <tr>
                     <th>Fecha de Elaboración:
                     <?php echo e(\Carbon\Carbon::parse($invoices->dateIni)->format('d-m-Y')); ?></th>
                  </tr>
                  <tr>
                     <th style="color:rgb(223, 147, 0)">Pago Oportuno Antes de:
                     <strong><?php echo e(\Carbon\Carbon::parse($invoices->paymentTimely)->format('d-m-Y')); ?></strong></th>
                  </tr>
                  <tr>
                     <th style="color:red">Fecha Limite:
                     <?php echo e(\Carbon\Carbon::parse($invoices->paymentTimely)->addDays(5)->format('d-m-Y')); ?></th>
                  </tr>

               </table>
               </div>

            </td>
         </tr>
      </table>
      <div class="" style="font-size:18px;text-align:right;padding:5px;">
         <strong style="padding:10px;background:rgb(142, 201, 235);">TOTAL A PAGAR:   $    <?php echo e($invoices->total); ?></strong>
      </div>

      <div class="" style="font-size:18px;padding:3px;background:rgb(142, 201, 235);width:150px">
         <strong>DESCRIPCIÓN</strong>
      </div>

    </header>
    <main>
      <table class="tabla" style="width:100%;border-collapse: collapse;">
        <thead>
          <tr style="background:rgb(142, 201, 235)">
            <th  style="border: 1px solid black;"  ><strong>Placa</strong></th>
            <th style="border: 1px solid black;"   ><strong>Servicio</strong></th>
            <th  style="border: 1px solid black;"  class="desc" width="30%"><strong>Descripción</strong></th>
            <th style="border: 1px solid black;"   ><strong>Valor</strong></th>
          </tr>
        </thead>
        <tbody>
           <?php $__currentLoopData = $invoiceDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr>
                 <td  style="border: 1px solid black;"class=""><?php echo e($id->plate); ?></td>
                 <td style="border: 1px solid black;" class=""><?php echo e($id->type); ?></td>
                 <td style="border: 1px solid black;" lass="qty" width="30%"><?php echo e($id->description); ?></td>
                    <?php if($id->type == 'Descuento'): ?>
                       <td class="unit" style="border: 1px solid black;">-<?php echo e($id->payment); ?>


                       </td>

                    <?php elseif($id->type == 'Adicional'): ?>
                       <td class="unit" style="border: 1px solid black;"><?php echo e($id->payment); ?>


                       </td>
                    <?php endif; ?>

             </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <tr>
             <td colspan="2" style='border: inset 0pt;border-collapse:inherit'></td>
            <td  style="border: 1px solid black;" class="grand total"><strong>TOTAL:</strong></td>
            <td style="border: 1px solid black;" class="grand total"><strong><?php echo e($invoices->total); ?></strong></td>
          </tr>
        </tbody>

      </table>

      <div class="" style="margin-top:30px;margin-bottom:20px">

         <div class="" style="float:left;width:130px;">
            <img style="margin-top:15px;margin-left:10px" src="<?php echo e(asset('img/apostar.png')); ?>" alt="icono">
         </div>





         <div class="" style="width:700px;word-wrap:break-word;text-align:justify;">
            <p style="color:red;">Lo invitamos a que pague en cualquier sucursal Apostar de Risaralda indicando
               pago de "Eje Satelital" y usando cedula/NIT de suscriptor como referencia de pago
            </p>
         </div>
      </div>



<table>
   <tr>
      <td style="right"><div class="">
         <p>Att.</p>
         <img style="margin-top:-10px;margin-left:10px" src="<?php echo e(asset('img/firma.png')); ?>" alt="icono">
         <p style="margin-top:-20px">_______________________</p>
         <p>C.C. 34.066.000</p>
         <p>Representante Legal - Eje Satelital</p>
      </div></td>
      <td style="text-align: justify;border: double 1 px rgb(79, 79, 79);padding:5">
         <div class="">
            <p>Para inscripcion de pago en linea mensual a continuacion incluimos cuenta bancaria del representante legal:</p>
            <ul style="list-style:none">
               <li>Numero de Cuenta: 864654</li>
               <li>Tipo de Cuenta: Ahorros</li>
               <li>Entidad:	Bancolombia</li>
               <li>Titular:	Jennifer Montoya Blandon</li>
               <li>C.C. 654654</li>
            </ul>


         </div>
      </td>
   </tr>
</table>







  </body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Factura</title>

  <style media="screen">
           li {
         margin: 0px;
         padding: 0px;

         }
         ul {
         margin: 0px;
         padding: 0px;
         }


    </style>
  </head>
  <body>
     <img src="<?php echo e(asset('img/logo.png')); ?>" alt="icono">
    <header class="">
      <div class="" style="text-align:center">
         <h1>Eje Satelital</h1>

      </div>

      <table>
         <tr>
            <td class="left">
               <ul style="list-style:none">
                  <li>Eje Satelital Cra 10 No. 14-71</li>
                  <li>Centro Comercial Éxito Local 102A</li>
                  <li>Pereira - Risaralda</li>
                  <li>NIT: 34066000-8</li>

                  <li style="margin-top:30px"><strong>CLIENTE</strong></li>
                  <li><strong>Nombre: </strong><?php echo e($invoices->nameCustomer); ?></li>
                  <li><strong>Cédula: </strong><?php echo e($invoices->idNumberCustomer); ?></li>
                  <li><strong>Dirección: </strong><?php echo e($invoices->customer->address); ?></li>
               </ul>
            </td>
            <td class="service">
               <table style="margin-top:-100px;margin-left:160px">
                  <tr>
                     <th>Fecha de Elaboración:</th>
                     <th><?php echo e(\Carbon\Carbon::parse($invoices->dateIni)->format('d-m-Y')); ?></th>
                  </tr>
                  <?php if($invoices->type == 'Recurrente'): ?>
                  <tr>
                     <th>Periodo de Facturacion:</th>
                     <th>mes:<?php echo e($invoices->invoiceperiod); ?>

                     </th>
                  </tr>
                  <?php endif; ?>
                  <tr>
                     <th style="color:rgb(223, 147, 0)">Pago Oportuno Antes de:</th>
                     <th style="color:red"><strong><?php echo e(\Carbon\Carbon::parse($invoices->paymentTimely)->format('d-m-Y')); ?></strong></th>
                  </tr>
                  <tr>
                     <th style="color:red">Fecha Limite:</th>
                     <th style="color:red"><?php echo e(\Carbon\Carbon::parse($invoices->paymentTimely)->addDays(5)->format('d-m-Y')); ?></th>
                  </tr>
                  <?php if(isset($mConfirm->dateConfirmPayment) and $invoices->estate == "Pago Confirmado"): ?>
                  <tr>
                     <th style="color:blue">Pago Realizado:</th>
                     <th style="color:blue">
                        <?php echo e(\Carbon\Carbon::parse($mConfirm->dateConfirmPayment)->format('d-m-Y')); ?>

                     </th>
                  </tr>
                  <?php endif; ?>
               </table>
               </div>

            </td>
         </tr>
      </table>
      <div class="" style="font-size:18px;text-align:right;padding:5px;">
         <strong style="padding:10px;background:rgb(142, 201, 235);">TOTAL A PAGAR:   $    <?php echo e($invoices->total); ?></strong>
      </div>

      <div class="" style="font-size:18px;padding:3px;background:rgb(142, 201, 235);width:150px">
         <strong>DESCRIPCIÓN</strong>
      </div>

    </header>
    <main>
      <table class="tabla" style="width:100%;border-collapse: collapse;">
        <thead>
          <tr style="background:rgb(142, 201, 235)">
            <th  style="border: 1px solid black;"  ><strong>Placa</strong></th>
            <th style="border: 1px solid black;"   ><strong>Servicio</strong></th>
            <th  style="border: 1px solid black;"  class="desc" width="30%"><strong>Descripción</strong></th>
            <th style="border: 1px solid black;"   ><strong>Monto</strong></th>
          </tr>
        </thead>
        <tbody>
           <?php $__currentLoopData = $invoiceDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr>
                 <td  style="border: 1px solid black;"class=""><?php echo e($id->plate); ?></td>
                 <td style="border: 1px solid black;" class=""><?php echo e($id->type); ?></td>
                 <td style="border: 1px solid black;" lass="qty" width="30%"><?php echo e($id->description); ?></td>
                 <td style="border: 1px solid black;" class="total"><?php echo e($id->payment); ?></td>
             </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <tr>
             <td colspan="2" style='border: inset 0pt;border-collapse:inherit'></td>
            <td  style="border: 1px solid black;" class="grand total"><strong>TOTAL:</strong></td>
            <td style="border: 1px solid black;" class="grand total"><strong><?php echo e($invoices->total); ?></strong></td>
          </tr>
        </tbody>

      </table>

      <p style="text-align: justify;
    text-justify: inter-word;color:red">Lo invitamos a que pague en cualquier sucursal Apostar de Risaralda indicando
pago de "Eje Satelital" y usando cedula/NIT de suscriptor como referencia de pago
</p>

<table>
   <tr>
      <td style="right"><div class="">
         <p>Att., Jennifer Montoya B.</p>
         <p>C.C. 34.066.000</p>
         <p>Representante Legal - Eje Satelital</p>
      </div></td>
      <td style="text-align: justify;border: double 1 px rgb(79, 79, 79);padding:5">
         <div class="">
            <p>Para inscripcion de pago en linea mensual a continuacion incluimos cuenta bancaria del representante legal:</p>
            <ul style="list-style:none">
               <li>Numero de Cuenta: 864654</li>
               <li>Tipo de Cuenta: Ahorros</li>
               <li>Entidad:	Bancolombia</li>
               <li>Titular:	Jennifer Montoya Blandon</li>
               <li>C.C. 654654</li>
            </ul>


         </div>
      </td>
   </tr>
</table>







  </body>
</html>
