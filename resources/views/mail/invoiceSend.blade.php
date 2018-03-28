<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>
   <div class="panel panel-default">
      <div class="panel-heading" style="height:50px">
      </div>
      <div class="panel-body">
         <div class="row">
            <div class="col-sm-6">
               <p>Eje Satelital Cra 10 No. 14-71</p>
               <p>Centro Comercial Éxito Local 102A</p>
               <p>Pereira - Risaralda</p>
               <p>NIT: 34066000-8</p>

               <p style="margin-top:30px"><strong>CLIENTE</strong></p>
               <p>Nombre: {{$invoices->nameCustomer}}</p>
               <p>Cedula: {{$invoices->idNumberCustomer}}</p>
               <p>Dirección: {{$invoices->customer->address}}</p>



            <div class="col-sm-6">
               <table class="table table-sm">
                  <tr>
                     <th>Fecha de Elaboración</th>
                     <th>{{\Carbon\Carbon::parse($invoices->dateIni)->format('d-m-Y')}}</th>
                  </tr>
                  <tr>
                     <th>Periodo de Facturacion</th>
                     <th>mes:{{$invoices->invoiceperiod}}
                     </th>
                  </tr>
                  <tr>
                     <th style="color:red">Pago Oportuno Antes de:</th>
                     <th style="color:red">{{\Carbon\Carbon::parse($invoices->paymentTimely)->format('d-m-Y')}}</th>
                  </tr>

               </table>
            </div>
         </div>
         <h3 class="pull-right">TOTAL A PAGAR:   $    {{$invoices->total}}</h3>
         <h3 style="margin-top:70px">Descripción</h3>
         <table class="table table-bordered table-striped">
            <thead>
               <tr>
                  <th class="service"><strong>Vehicle:</strong></th>
                  <th class="qty"><strong>Placa:<s/trong></th>
                     <th class="service"><strong>Tipo de Servicio:</strong></th>
                     <th class="desc"><strong>Descripción:</strong></th>
                     <th><strong>VALOR:</strong></th>
                  </tr>
               </thead>
               <input type="hidden" name="" value="{{$sum=0}}">
               <tbody>
                  @foreach ($invoiceDetails as $id)
                     <tr>
                        <td class="unit">{{$id->vehicle}}</td>
                        <td class="unit">{{$id->plate}}</td>
                        <td class="unit">{{$id->type}}</td>
                        <td class="unit">{{$id->description}}</td>
                        <td class="unit">{{$id->payment}}</td>
                     </tr>
                  @endforeach
               </tbody>
               <tfoot>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td><strong>TOTAL:</strong></td>
                     <td><strong>{{$invoices->total}}</strong></td>
                  </tr>
               </tfoot>
            </table>

         </div>

      </div>
   </div>

</body>
</html>
