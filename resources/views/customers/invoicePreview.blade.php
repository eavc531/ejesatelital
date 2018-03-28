@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Factura del Periodo:{{$invoices->invoiceperiod}} / {{$invoices->customer->name}}
@endsection

@section('contentheader_title')
   Factura del Periodo:{{$invoices->invoiceperiod}} / {{$invoices->customer->name}}
@endsection
NOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
@section('contentheader-button')
   <a class="btn btn-default" href="{{route('invoiceList',$invoices->customer_id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')

   @if(isset($invoices->estate) and $invoices->estate == 'Pago Realizado' and Auth::user()->role != 'Cliente')
      <div class="panel panel" style="color:rgb(17, 103, 44)">
         <div class="panel-heading bg-success">
            <h4>
               {{$invoices->customer->name}} a Confirmado el Pago de la Factura: {{$invoices->invoiceperiod}}</h4>
         </div>
         <div class="panel-body bg-success">
            <div class="row">
               <div class="col-sm-6">
                  <p><strong>Fecha del Pago:</strong>
                   {{\Carbon\Carbon::parse($mConfirm->dateConfirmPayment)->format('d-m-Y')}}</p>
                   @isset($mConfirm->dateConfirmPayment)
                      <input type="hidden" name="" value="{{$mConfirm->dateConfirmPayment}}" id="dateConfirmPaymentinput">
                   @endisset

                  <p><strong>Medio de Pago:</strong> {{$mConfirm->medioPayment}}</p>
                  @isset($mConfirm->dateConfirmPayment)
                     <input type="hidden" name="" value="{{$mConfirm->medioPayment}}" id="medioPaymentInput">
                  @endisset

               </div>
               <div class="col-sm-6">
                  <p><strong>Banco:</strong> @if(isset($mConfirm->Banco)) {{$mConfirm->Banco}} @else "Sin Detalles" @endif</p>
                  <p><strong>Numero de Referencia:</strong> @if(isset($mConfirm->nroReferencia)) {{$mConfirm->nroReferencia}} @else "Sin Detalles" @endif</p>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-7">
                     <p><strong>Mensaje Adicional:</strong> @if(isset($mConfirm->mensaje)) {{$mConfirm->mensaje}} @else "Sin Detalles"</p> @endif
               </div>
               <div class="col-sm-5">
                  <button style="background:rgba(28, 135, 45, 0.85);margin-top:30px" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal5">
                 <strong>Marcar Factura Como Pagada</strong>
               </button>

               </div>
            </div>
         </div>
      </div>
   @endif

   <div class="panel panel-default">
      <div class="panel-heading" style="height:50px">
         @if(Auth::user()->role == 'Cliente' and $invoices->estate != 'Pago Realizado' and $customer->userState == 'Habilitado')

            <a href="{{route('invoiceConfirmCustomerView',$invoices->id)}}" class="btn btn-success"><strong>Enviar Confirmación de Pago</strong></a>
         @endif
         <a style="margin-top:-5" data-toggle="tooltip" data-placement="top" title="Descargar en Formato PDF" class="btn btn-default" href="{{route('invoicePdf',$invoices->id)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>

         @if(Auth::user()->role == 'Administrador')

            <button data-placement="top" title="Enviar por Correo" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
               <strong><i class="fa fa-paper-plane" aria-hidden="true"></i></strong>
            </button>
            <a data-toggle="tooltip" data-placement="top" title="Exportar Datos a Archivo Excel" class="btn btn-default btn" href="{{route('excelExport',$invoices->id)}}"><i class="fa fa-table" aria-hidden="true"></i></a>

            @if($invoices->estate != 'Pago Confirmado' and $invoices->estate != 'Pago Realizado')
               <button style="background:rgba(28, 135, 45, 0.85);" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal5">
              <strong>Marcar Factura Como Pagada</strong>
            </button>
            @endif
         @endif
         <div class="pull-right" style="font-size:18px">
            @if($invoices->estate == 'Pago Confirmado')
               <strong>Estado: </strong><strong>{{'Factura Cancelada'}}</strong>
            @elseif($invoices->estate == 'Pago Realizado')
               <strong>Estado: </strong><strong style="color:rgb(2, 117, 2)"> {{$invoices->estate}}/Por Confirmar</strong>
            @elseif(\Carbon\Carbon::parse($invoices->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
               )
               <strong style="padding:6px;">Estado:</strong><strong style="color:rgb(195, 32, 42)">{{$invoices->estate.'/Fecha Limite Sobrepasada'}}</strong>
            @elseif($invoices->paymentTimely < \Carbon\Carbon::now()->addDays(-1))
               <strong style="padding:6px;">Estado:</strong> <strong style="color:rgb(195, 32, 42)">{{$invoices->estate.'/Pago Retrasado'}}</strong>

            @elseif($invoices->estate == 'Sin Enviar' and Auth::User()->role != 'Cliente')
               <strong style="padding:6px;">Estado:</strong> <strong style="color:rgb(150, 29, 215)">{{$invoices->estate}}/Pendiente</strong>
            @elseif(Auth::User()->role == 'Cliente' and $invoices->estate != 'Pago Confirmado')
               <strong style="padding:6px;">Estado:</strong> <strong style="background:rgb(22, 171, 64);color:white;padding:2px;border-radius:10px;">Pago Pendiente</strong>
            @elseif($invoices->estate == 'Enviada/Pendiente')
               <strong style="padding:6px;">Estado:</strong> <strong style="color:rgb(34, 36, 237)">{{$invoices->estate}}</strong>
            @endif
         </div>
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

            </div>
            <div class="col-sm-6">
               <table class="table table-sm">
                  <tr>
                     <th>Fecha de Elaboración</th>
                     <th>{{\Carbon\Carbon::parse($invoices->dateIni)->format('d-m-Y')}}</th>
                  </tr>
                  <tr>
                     <th>Periodo de Facturacion</th>
                     <th > <span style="background:red">{{$invoices->invoiceperiod}}</span>
                     </th>
                  </tr>
                  <tr>
                     <th style="color:red">Pago Oportuno Antes de:</th>
                     <th style="color:red">{{\Carbon\Carbon::parse($invoices->paymentTimely)->format('d-m-Y')}}</th>
                  </tr>
                  @if(isset($mConfirm->dateConfirmPayment) and $invoices->estate == "Pago Confirmado")
                  <tr>
                     <th style="color:blue">Pago Realizado:</th>
                     <th style="color:blue">
                        {{\Carbon\Carbon::parse($mConfirm->dateConfirmPayment)->format('d-m-Y')}}
                     </th>
                  </tr>
                  @endif
               </table>
            </div>
         </div>
         <div style="margin-top:10px;">
            <div class="col-sm-6">

               <h3>Descripción</h3>
            </div>
            <div class="col-sm-6">
               <a href="{{route('addDetailInvoice',$invoices->id)}}" class="btn btn-primary btn-lg pull-right"><strong>Añadir Servicio</strong></a>
            </div>
         </div>

         <table class="table table-bordered table-striped">
            <thead>
               <tr style="background:rgb(77, 189, 179); color:white">
                  <th class="qty"><strong>Placa:<s/trong></th>
                     <th class="service"><strong>Tipo de Servicio:</strong></th>
                     <th class="desc"><strong>Descripción:</strong></th>
                     <th><strong>Valor:</strong></th>
                     <th><strong>Monto:</strong></th>
                  </tr>
               </thead>
               <input type="hidden" name="" value="{{$sum=0}}">
               <tbody>
                  @foreach ($invoiceDetails as $id)
                     <tr>
                        <td class="unit">{{$id->plate}}</td>
                        <td class="unit">{{$id->type}}</td>
                        <td class="unit">{{$id->description}}</td>
                        @if($id->type == 'Descuento')
                        <td class="unit">-{{$id->payment}}

                        </td>
                        <input type="hidden" name="" value="{{$sum-=$id->payment}}">
                        @elseif($id->type == 'Adicional')
                        <td class="unit">{{$id->payment}}

                        </td>
                        <input type="hidden" name="" value="{{$sum+=$id->payment}}">
                        @else
                        <td class="unit">{{$id->payment}} x {{$invoices->months}} Mes(es)</td>
                        @endif

                        @if($id->type == 'Descuento')
                        <td class="unit">-{{$id->payment}}
                           <a href="{{route('deleteDF',$id->id)}}" onclick="return confirm('¿Esta Segur@ de Eliminar esta fila de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>
                        </td>
                        <input type="hidden" name="" value="{{$sum-=$id->payment}}">
                        @elseif($id->type == 'Adicional')
                        <td class="unit">{{$id->payment}}
                           <a href="{{route('deleteDF',$id->id)}}" onclick="return confirm('¿Esta Segur@ de Eliminar esta fila de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>
                        </td>
                        <input type="hidden" name="" value="{{$sum+=$id->payment}}">
                        @else
                        <td class="unit">{{$id->payment * $invoices->months}}</td>
                        @endif

                     </tr>
                  @endforeach
               </tbody>
               <tfoot>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td style="text-align:right"><strong >TOTAL:</strong></td>
                     <td><strong>{{$invoices->total}}</strong></td>
                  </tr>
               </tfoot>
            </table>

         </div>

      </div>
   </div>

   @include('customers.modalServices')
   @include('customers.modalInvoiceSend')
   @include('customers.modalConfirmPayment')
@endsection
