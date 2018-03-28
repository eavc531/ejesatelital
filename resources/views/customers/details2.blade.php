@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Cliente: {{$customer->name}}
@endsection

@section('contentheader_title')
   Cliente: <strong>{{$customer->name}}</strong>@if($customer->stateUser == 'Deshabilitado') <span style="color:rgb(236, 54, 29)">/Deshabilitado</span> @endif
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i><strong>Inicio</strong>
   </a>

@endsection

@section('main-content')
   <div class="row">
      <div class="" style="margin-bottom:20px">
         <div class="col-sm-6">
            <div class="panel" style="border-radius:15px">
               <div class="panel-heading bg-primary">
                  <strong style="text-align: center;">Datos Personales</strong>
               </div>
               <div class="panel-body">
                  <ul style="list-style:none;padding:10px">
                     <li><strong>Nombres:</strong> {{$customer->name}}</li>
                     <li><strong>Cedula:</strong> {{$customer->idNumber}}</li>
                     <li><strong>Teléfono 1:</strong> {{$customer->phone1}}</li>
                     <li><strong>Teléfono 2:</strong> {{$customer->phone2}}</li>
                     <li><strong>Correo:</strong> {{$customer->email}}</li>
                     <li><strong>Ciudad:</strong> {{$customer->city}}</li>
                     <li><strong>Dirección:</strong> {{$customer->address}}</li>
                  </ul>
               </div>
            </div>
            <div class="panel" style="padding:15px">

               @if($customer->stateUser == 'Deshabilitado')
                  <strong style="color:red">Cuenta Deshabilitada</strong>
               @else
                  <a style="" data-toggle="tooltip" data-placement="top" title="Facturas" class="btn btn-success btn-lg" href="{{route('invoiceList',$customer->id)}}"><i class="fas fa-list-alt"></i></a>
                  <a style="" data-toggle="tooltip" data-placement="top" title="Documentos" class="btn btn-default btn-lg" href="{{route('listDocuments',$customer->id)}}"><i class="far fa-folder-open"></i></a>
                  <a style="" data-toggle="tooltip" data-placement="top" title="Contactanos" class="btn btn-warning btn-lg" href="{{route('contact')}}"><i class="fa fa-envelope" aria-hidden="true"></i></a>
               @endif
            </div>

            <div class="panel panel" style="border-radius:15px">
               <div class="panel-heading bg-primary">
                  <strong style="text-align:center">Servicios Afiliados:</strong>
               </div>
               <div class="panel-body">
                  <div class="panel-body row">
                     <div class="col-sm-10">
                        <ul style="padding:10px">
                           @if($services_vehiclesCount > 0)
                           <ul style="list-style:none;padding:5px">
                              @foreach ($services_vehicles as $sv)
                                 <li><strong>{{$sv->services->name}}</strong> Asociado al Vehiculo: <strong>{{$sv->vehicles->name}}</strong> Con un Pago Mensual de: <strong>{{$sv->services->payment}}</strong></li>
                              @endforeach
                           </ul>
                           @else
                              Sin Servicios Afiliados
                           @endif
                        </ul>
                     </div>
                     <div class="col-sm-2">
                        @if(Auth::user()->role != 'Cliente')
                        <a style="margin-top:20px" data-toggle="tooltip" data-placement="top" title="Pagos Pendientes" class="btn btn-warning btn-lg pull-right" href="{{route('customersServices',$customer->id)}}"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a>
                        @endif


                     </div>
                  </div>
               </div>
            </div>


         </div>
         <div class="col-sm-6">
            <div class="panel" style="border-radius:15px">
               <div class="panel-heading bg-primary">
                  <strong style="text-align: center;">Vehículos Afiliados</strong>
               </div>
               <div class="panel-body">
                  <div class="panel-body row">
                     <div class="col-sm-10">

                        @if($services_vehiclesCount > 0)
                        <ul style="list-style:none;padding:5px">
                              @foreach ($vehicles as $v)
                                 <li><strong>{{$v->name}}:</strong> Año: <strong>{{$v->year}}</strong>, Placa:<strong>{{$v->plate}}</strong></li>
                              @endforeach
                        </ul>
                        @else
                           Sin Servicios Afiliados
                        @endif
                     </div>
                     <div class="col-sm-2">
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
                        @if($invoicesCount > 0)
                           @foreach ($invoices as $invoice)
                              @if($invoice->type != 'Occasional')
                                 <a href="{{route('invoiceDetails',$invoice->id)}}"><li style="">Factura del Periodo: <strong>{{$invoice->invoiceperiod}}</strong>,Nro: <strong>{{str_pad($invoice->number, 3, "0", STR_PAD_LEFT)}}</strong>, Estado: @if($invoice->statePayment == 'Pago Confirmado')
                                    <strong>{{'Factura Cancelada'}}</strong>
                                 @elseif($invoice->stateSend == 'Pago Realizado')
                                    <strong style="color:rgb(2, 117, 2)"> Confirmacion de Pago Enviada</strong>
                                 @elseif(\Carbon\Carbon::parse($invoice->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                                    )
                                    <strong style="color:rgb(195, 32, 42)">Retraso</strong>
                                 @elseif($invoice->paymentTimely < \Carbon\Carbon::now()->addDays(-1))
                                    <strong style="color:rgb(195, 32, 42)">{{$invoice->statePayment   }}</strong>

                                 @elseif ($invoice->statePayment == 'Pendiente')
                                    <strong style="color:gb(22, 171, 64)"><span style="color:rgb(235, 141, 0)">Pago Pendiente:</span></strong>
                                 @endif

                                 @if($invoice->stateSend == 'Sin Enviar' and $invoice->statePayment != 'Pago Confirmado' and auth::user()->role != 'Cliente')
                                    <strong style="color:rgba(230, 178, 20, 0.92)">    / {{$invoice->stateSend}}</strong>
                                 @endif,
                                 Monto: <strong>{{$invoice->total}}</strong></li></a>
                              @else
                                    <a href="{{route('invoiceOccasionalDetails',$invoice->id)}}"><li style="">Factura del Periodo: <strong>{{$invoice->invoiceperiod}}</strong>,Nro: <strong>{{str_pad($invoice->number, 3, "0", STR_PAD_LEFT)}}</strong>, Estado: @if($invoice->statePayment == 'Pago Confirmado')
                                       <strong>{{'Factura Cancelada'}}</strong>
                                    @elseif($invoice->stateSend == 'Pago Realizado')
                                       Confirmacion de Pago Enviada
                                    @elseif(\Carbon\Carbon::parse($invoice->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                                       )
                                       <strong style="color:rgb(195, 32, 42)">{{$invoice->statePayment   }}</strong>
                                    @elseif($invoice->paymentTimely < \Carbon\Carbon::now()->addDays(1))
                                       <strong style="color:rgb(195, 32, 42)">{{$invoice->statePayment   }}</strong>

                                    @elseif(Auth::User()->role == 'Cliente' and $invoice->statePayment != 'Pago Confirmado')
                                       <strong style="color:gb(22, 171, 64)">Pago Pendiente:</strong>
                                    @elseif ($invoice->statePayment == 'Pendiente')
                                       <strong style="color:rgb(9, 145, 55)">{{$invoice->statePayment}}</strong>
                                    @endif,
                                    Monto: <strong>{{$invoice->total}}</strong></li></a>
                              @endif

                           @endforeach
                        @else
                           No existen Facturas Pendientes
                        @endif
                     </ul>

                     @if(isset($invoice->estate) and $invoice->estate == 'Pago Realizado')
                     <div class="bg-info">
                        <p>El cliente ha confirmado el pago de la ultima factura</p>
                        <a href="{{route('invoiceDetails',$invoice->id)}}" class="btn btn-info">Verificar</a>
                     </div>
                     @endif
                  </div>
                  <div class="col-sm-2">
                     <a style="margin-top:30px;" data-toggle="tooltip" data-placement="top" title="Facturas" class="btn btn-success btn-lg" href="{{route('invoiceList',$customer->id)}}"><i class="fas fa-list-alt"></i></a>
                  </div>

               </div>
                  @if(isset($invoice->estate) and $invoice->estate != 'Pago Confirmado' and Auth::user()->role == 'Cliente' and $invoice->estate != 'Pago Realizado')
               <div class="panel-footer">
                     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalconfirm"><strong>Confirmar Pago de Ultima Factura </strong></button>
               </div>
               @endif
            </div>
         </div>


      </div>
      <div class="col-md-6">


      </div>
      <div class="">
         <div class="" style="margin-top:30px">
         </div>
      </div>

      </div>



@endsection
