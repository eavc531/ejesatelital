@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Facturas: {{$customer->name}}
@endsection

@section('contentheader_title')
   Facturas: {{$customer->name}}
@endsection

@section('contentheader-button')
   <a style=""class="btn btn-default" href="{{route('customersDetails',$customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   @if(Auth::user()->role != 'Cliente')
   <a style="color:white" data-toggle="tooltip" data-placement="top" title="Pagos Pendientes" class="btn btn-warning" href="{{route('customersServices',$customer->id)}}"></i><strong>Pagos Pendienes</strong></a>
   @endif

@endsection

@section('main-content')

   <div class="panel panel">
      <div class="panel-heading bg-primary">
         <strong>Facturas: {{$customer->name}}</strong>
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

               @foreach ($invoices as $invoice)
                  <tr>

                     <td>{{$invoice->customer->name}}</td>
                     <td>{{\Carbon\Carbon::parse($invoice->dateIni)->format('d-m-Y')}}</td>
                     <td>{{$invoice->invoiceperiod}}</td>
                     <td>{{\Carbon\Carbon::parse($invoice->paymentTimely)->format('d-m-Y')}}</td>
                     <td>

                        @if($invoice->statePayment == 'Pago Confirmado')
                           <strong>{{'Factura Cancelada'}}</strong>
                        @elseif($invoice->statePayment == 'Pago Realizado')
                           <strong style="color:rgb(2, 117, 2)"> {{$invoice->statePayment}}/Por Confirmar</strong>
                        @elseif(\Carbon\Carbon::parse($invoice->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                           )
                           <strong style="color:rgb(195, 32, 42)">Retrazo</strong>
                        @elseif($invoice->paymentTimely < \Carbon\Carbon::now()->addDays(1))
                           <strong style="color:rgb(195, 32, 42)">{{$invoice->statePayment   }}</strong>
                        @elseif ($invoice->statePayment == 'Pendiente')
                           <strong style="color:rgb(9, 145, 55)">{{$invoice->statePayment}}</strong>
                        @endif

                        @if($invoice->stateSend == 'Sin Enviar' and $invoice->statePayment != 'Pago Confirmado' and Auth::user()->role != 'Cliente')
                           <strong style="color:rgba(230, 178, 20, 0.92)"> / {{$invoice->stateSend}}</strong>
                        @endif
                     </td>
                     <td>
                        @if($invoice->type != 'Occasional')
                           <a class="btn btn-primary" href="{{route('invoiceDetails',$invoice->id)}}"><i class="fas fa-sign-in-alt"></i></a>
                        @else
                           <a class="btn btn-primary" href="{{route('invoiceOccasionalDetails',$invoice->id)}}"><i class="fas fa-sign-in-alt"></i></a>
                        @endif
                     </td>
               @endforeach
            </tbody>
         </table>
      </div>
      <div class="panel-footer">
         {{ $invoices->links() }}
      </div>
      </div>

@endsection
