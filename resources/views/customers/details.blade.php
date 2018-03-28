@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Cliente: {{$customer->name}}
@endsection

@section('contentheader_title')
   Cliente: <strong>{{$customer->name}}</strong>@if($customer->stateUser == 'Deshabilitado') <span style="color:rgb(236, 54, 29)">/Deshabilitado</span> @endif
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customers.index')}}"><i class="fas fa-backward"></i>

<strong>Atras</strong>
   </a>
@endsection

@section('main-content')


   <div class="row">
      <div class="" style="">
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
                     @isset($customer->seller->name)
                     <li><strong>Vendedor Asignado:</strong> {{$customer->seller->name}}</li>
                     @endisset
                      @if($customer->stateUser == 'Deshabilitado') <li><strong>Estado de Cuenta:</strong> <strong style="color:rgb(236, 54, 29)">Deshabilitada</strong></li> @endif

               </ul>
               </div>
            </div>
            <div class="panel" style="padding:15px">

               @if($customer->stateUser != 'Deshabilitado')
                  <a style="margin-bottom:10px;" data-toggle="tooltip" data-placement="top" title="Pagos Pendientes" class="btn btn-warning btn-lg" href="{{route('customersServices',$customer->id)}}"><i class="far fa-credit-card"></i></a>

                     <a style="margin-bottom:10px;" data-toggle="tooltip" data-placement="top" title="Facturas" class="btn btn-success btn-lg" href="{{route('invoiceList',$customer->id)}}"><i class="fas fa-list-alt"></i></a>
                     @if(Auth::user()->role == 'Administrador')
                        <a style="margin-bottom:10px;background:rgb(118, 154, 41)"data-toggle="tooltip" data-placement="top" title="Factura Ocasional" class="btn btn-primary btn-lg" href="{{route('invoiceOccasional',$customer->id)}}"><i class="far fa-list-alt"></i></a>
                     @endif
                     <a style="margin-bottom:10px;" data-toggle="tooltip" data-placement="top" title="Vehiculos del Cliente" class="btn btn-primary btn-lg" href="{{route('customersVehicles',$customer->id)}}"><i class="fa fa-car" aria-hidden="true"></i></a>



                     <a style="margin-bottom:10px;" data-toggle="tooltip" data-placement="top" title="Documentos" class="btn btn-default btn-lg" href="{{route('listDocuments',$customer->id)}}"><i class="far fa-folder-open"></i>
                     </a>

                     <a style="margin-bottom:10px;background:rgb(176, 174, 179)"data-toggle="tooltip" data-placement="top" title="Anotaciones/Observaciones" class="btn btn-primary btn-lg" href="{{route('notesList',$customer->id)}}"><i class="far fa-clipboard"></i>
                     </a>


               @endif
                  @if(5 == 4)

                     <a style="margin-bottom:10px;background:rgba(31, 55, 108, 0.77)" data-toggle="tooltip" data-placement="top" title="Enviar Mensaje" class="btn btn-lg btn-primary" href="{{route('sendSms',$customer->id)}}"><i class="far fa-comment-alt"></i></a>
                     <a style="margin-bottom:10px;background:rgb(106, 63, 187)"data-toggle="tooltip" data-placement="top" title="Enviar Correo" class="btn btn-primary btn-lg" href="{{route('mailCustomer',$customer->id)}}"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                  @endif
                  <a style="margin-bottom:10px; background:rgba(38, 187, 179, 1)" data-toggle="tooltip" data-placement="top" title="Datos de Usuario" class="btn btn-lg btn-success" href="{{route('customers.edit',$customer->id)}}"><i class="fas fa-user"></i></a>


            </div>



               <div class="panel panel" style="border-radius:15px">
                  <div class="panel-heading bg-primary">
                     <strong style="text-align: center;">Servicios Afiliados:</strong>
                  </div>
                  <div class="panel-body">
                     <div class="panel-body row">
                        <div class="col-sm-10">
                           <ul style="padding:10px">
                              @if($services_vehiclesCount > 0)
                              <ul style="list-style:none;padding:5px">
                                 @foreach ($services_vehicles as $sv)
                                    <li> <strong>{{$sv->services->name}}</strong> Asociado al Vehiculo: <strong>{{$sv->vehicles->plate}}</strong> Con un Pago Mensual de: <strong>{{$sv->services->payment}}</strong></li>
                                 @endforeach
                              </ul>
                              @else
                                 Sin Servicios Afiliados
                              @endif
                           </ul>
                        </div>
                        <div class="col-sm-2">
                           @if($customer->stateUser != 'Deshabilitado')
                           <a style="margin-top:20px;" data-toggle="tooltip" data-placement="top" title="Pagos Pendientes" class="btn btn-warning btn-lg" href="{{route('customersServices',$customer->id)}}"><i class="far fa-credit-card"></i></a>
                           @endif
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
                           @if($vehiclesCount > 0)
                           <ul style="list-style:none;padding:5px">
                                 @foreach ($vehicles as $v)
                                    <li><strong>{{$v->name}}: </strong> Año:  <strong>{{$v->year}}</strong>, Placa: <strong>{{$v->plate}}</strong>,Inicio: <strong>{{$v->created_at->format('d-m-Y')}}</strong></li>
                                 @endforeach
                           </ul>
                           @else
                              <p>Sin Vehículos Afiliados</p>
                           @endif
                        </ul>
                     </div>
                     <div class="col-sm-2">
                        @if($customer->stateUser != 'Deshabilitado')
                        <a style="margin-top:20px" data-toggle="tooltip" data-placement="top" title="Vehiculos del Cliente" class="btn btn-primary btn-lg pull-right" href="{{route('customersVehicles',$customer->id)}}"><i class="fa fa-car" aria-hidden="true"></i></a>
                        @endif
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
                                 <a href="{{route('invoiceDetails',$invoice->id)}}"><li style="">Factura del Periodo: <strong>{{$invoice->invoiceperiod}}</strong>, Nro: <strong>{{str_pad($invoice->number, 3, "0", STR_PAD_LEFT)}}</strong>, Estado: @if($invoice->statePayment == 'Pago Confirmado')
                                    <strong>{{'Factura Cancelada'}}</strong>
                                 @elseif($invoice->stateSend == 'Pago Realizado')
                                    <strong style="color:white;background:rgb(56, 214, 0);padding:1px;border-radius:5px"> {{$invoice->statePayment}} / Pago Realizado</strong>
                                 @elseif(\Carbon\Carbon::parse($invoice->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                                    )
                                    <strong style="color:rgb(195, 32, 42)">Retrazo</strong>
                                 @elseif($invoice->paymentTimely < \Carbon\Carbon::now()->addDays(-1))
                                    <strong style="color:rgb(195, 32, 42)">{{$invoice->statePayment   }}</strong>

                                 @elseif(Auth::User()->role == 'Cliente' and $invoice->statePayment != 'Pago Confirmado')
                                    <strong style="background:rgb(22, 171, 64);color:white;padding:2px;border-radius:10px;">Pago Pendiente</strong>
                                 @elseif ($invoice->statePayment == 'Pendiente')
                                    <strong style="color:rgb(9, 145, 55)">{{$invoice->statePayment}}</strong>
                                 @endif

                                 @if($invoice->stateSend == 'Sin Enviar' and $invoice->statePayment != 'Pago Confirmado' )
                                    <strong style="color:rgba(230, 178, 20, 0.92)">    / {{$invoice->stateSend}}</strong>
                                 @endif,
                                 Monto: <strong>{{$invoice->total}}</strong></li></a>
                              @else
                                    <a href="{{route('invoiceOccasionalDetails',$invoice->id)}}"><li style="">Factura del Periodo: <strong>{{$invoice->invoiceperiod}}</strong>,Nro:<strong>{{str_pad($invoice->number, 3, "0", STR_PAD_LEFT)}}</strong>, Estado: @if($invoice->statePayment == 'Pago Confirmado')
                                       <strong>{{'Factura Cancelada'}}</strong>
                                    @elseif($invoice->stateSend == 'Pago Realizado')
                                       <strong style="color:white;background:rgb(56, 214, 0);padding:1px;border-radius:5px"> {{$invoice->statePayment}} / Pago Realizado</strong>
                                    @elseif(\Carbon\Carbon::parse($invoice->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                                       )
                                       <strong style="color:rgb(195, 32, 42)">Retrazo</strong>
                                    @elseif($invoice->paymentTimely < \Carbon\Carbon::now()->addDays(1))
                                       <strong style="color:rgb(195, 32, 42)">{{$invoice->statePayment   }}</strong>

                                    @elseif(Auth::User()->role == 'Cliente' and $invoice->statePayment != 'Pago Confirmado')
                                       <strong style="background:rgb(22, 171, 64);color:white;padding:2px;border-radius:10px;">Pago Pendiente</strong>
                                    @elseif ($invoice->statePayment == 'Pendiente')
                                       <strong style="color:rgb(9, 145, 55)">{{$invoice->statePayment}}</strong>
                                    @endif

                                    @if($invoice->stateSend == 'Sin Enviar' and $invoice->statePayment != 'Pago Confirmado' )
                                       <strong style="color:rgba(230, 178, 20, 0.92)">    / {{$invoice->stateSend}}</strong>
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
               @if(isset($invoice->invoiceperiod))
              <span style="font-size:20px"id="exampleModalLabel">Confirmacion del Pago de factura: {{$invoice->invoiceperiod}}</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <strong>!Atencion¡</strong>
               <p>Al Presionar el boton Aceptar estara Confirmando, que a Cancelado el Monto Total de la Factura del Periodo: <strong>{{$invoice->invoiceperiod}}</strong></p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <a href="{{route('invoiceConfirmCustomer',$invoice->id)}}" class="btn btn-primary">Aceptar</a>
              @endif
            </div>
          </div>
        </div>
      </div>
@endsection
