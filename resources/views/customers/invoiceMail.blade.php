<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=<device-width></device-width>, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>

</head>
<body>
<div style="width:700px">
<p style="text-align:justify;">{{$msg}}</p>
   
   <table style="border-collapse: collapse;margin:30px">
      <tr>
         <th style="border: 1px solid black" colspan="2">
            <p>Eje Satelital Cra 10 No. 14-71</p>
            <p>Centro Comercial Éxito Local 102A</p>
            <p>Pereira - Risaralda</p>
            <p>NIT: 34066000-8</p>
         </th>
         <th style="border: 1px solid black" colspan="3">
            <p><strong>CLIENTE</strong></p>
            <p>Nombre: {{$invoices->nameCustomer}}</p>
            <p>Cedula: {{$invoices->idNumberCustomer}}</p>
            <p >Dirección: {{$invoices->customer->address}}</p>

         </th>
      </tr>
      <tr style="border: 1px solid black">

         <td colspan="5" style="text-align:right">Fecha de Elaboración: {{$invoices->dateIni}}</td>

      </tr>
      <tr style="border: 1px solid black">

         <td colspan="5" style="text-align:right">Periodo de Facturacion: Mes: <strong>{{$invoices->invoiceperiod}}</strong></td>
      </tr>
      <tr style="border: 1px solid black">
         <td colspan="5" style="text-align:right"><strong style="color:red">Pago Oportuno Antes de: {{$invoices->paymentTimely}}</strong></td>
      </tr>
      <tr style="border: 1px solid black;background:rgb(103, 184, 236);text-align:right">
         <td colspan="5"><h3>TOTAL A PAGAR: $ {{$invoices->total}}</h3></td>
      </tr>
      <tr style="border: 1px solid black">
         <td colspan="5"><h3>Descripción</h3></td>
      </tr>
         <tr style="border: 1px solid black">
            <td class="service" style="border: 1px solid black"><strong>Vehicle:</strong></td>
            <td style="border: 1px solid black"><strong>Placa:<s/trong></td>
               <td style="border: 1px solid black"><strong>Tipo de Servicio:</strong></td>
               <td style="border: 1px solid black"><strong>Descripción:</strong></td>
               <td style="border: 1px solid black"><strong>VALOR:</strong></td>
            </tr>
         <input type="hidden" name="" value="{{$sum=0}}">
            @foreach ($invoiceDetails as $id)
               <tr style="border: 1px solid black">
                  <td style="border: 1px solid black">{{$id->vehicle}}</td>
                  <td style="border: 1px solid black">{{$id->plate}}</td>
                  <td style="border: 1px solid black">{{$id->type}}</td>
                  <td style="border: 1px solid black">{{$id->description}}</td>
                  <td style="border: 1px solid black">{{$id->payment}}</td>
               </tr>
            @endforeach
         </tbody>
         <tfoot>
         <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black">TOTAL:</td>
            <td style="border: 1px solid black"><strong>{{$invoices->total}}</strong></td>
         </tr>
      </tfoot>
   </table>
</div>


   <!-- Latest compiled and minified JavaScript -->

</body>
</html>
