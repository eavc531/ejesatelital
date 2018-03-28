@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Listado de Clientes
@endsection

@section('contentheader_title')
   Listado de Clientes
@endsection

@section('contentheader-button')
   <a class="btn btn-default" href="{{route('home')}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>


@endsection

@section('main-content')
   <a style="margin-bottom: 20px" class="btn btn-primary btn-lg" href="{{route('customerCreate')}}"><strong>Agregar Cliente</strong></a>
   <div class="panel panel">
      <div class="panel-heading" style="height:50px">
         <div class="pull-right" style=";margin-left:5px;margin-top:-8px">
            @if($notifications > 0)
               <a class="btn btn-warning btn-lg" data-toggle="tooltip" data-placement="top" title="Notificaciones" href="{{route('notifications')}}"><strong> <i class="fas fa-exclamation"></i></strong>
               </a>
            @else
               <a class="btn btn-default btn-lg" data-toggle="tooltip" data-placement="top" title="Notificaciones" href="{{route('notifications')}}"><strong> <i class="fas fa-exclamation"></i></strong>
               </a>
            @endif
         </div>

         @if(!isset($var))
         <div class="dropdown pull-right" style="margin-left:4px;margin-top:-8px;color:white;">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               <strong>Filtrar</strong>
               <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
               <li>
                  <div>
                     <a class="btn btn-success btn-block" href="{{route('confirm',['var'=>'Confirm'])}}"><strong>Pago Confirmado</strong></a>
                  </div>
               </li>
               <li role="separator" class="divider"></li>

               <li>
                  <div>
                     <a class="btn btn-warning btn-block" href="{{route('Pending',['var'=>'Pending'])}}"><strong>Pago Pendiente</strong></a>
                  </div>
               </li>
               <li role="separator" class="divider"></li>
               <li>
                  <div><a href="{{route('customerDisabled',['x'=>'disabled'])}}" class="btn btn-danger btn-block"><strong>Deshabilitados</strong></a></div>
               </li>
            </ul>
         </div>
         @endif

         <a href="{{route('customers.index')}}" class="btn btn-default pull-right" style="margin-top:-8px"><strong>Mostrar Todos</strong></a>
         <div class="pull-right" style="margin-bottom:">
            <div class="form-inline">
               {!!Form::open(['route'=>'customerSearch', 'method'=>'GET','class'=>'navbar-form','style'=>'margin-top:-8px'])!!}
               {!!Form::select('select',['cedula'=>'Buscar Por Cedula:','nombre'=>'Buscar Por Nombre:'],null,['class'=>'form-control'])!!}

               {!!Form::text('variable',null,['class'=>'form-control','placeholder'=>'', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
               <button class="btn btn-primary" type="submit" name="button"><i class="fa fa-search" aria-hidden="true"></i></button>
               {!!Form::close()!!}

            </div>

         </div>

      </div>
      <div class="panel-heading bg-primary">
         <strong>Listado de Clientes</strong>
      </div>
      <div class="panel-body">
         <table class="table table-striped">
            <thead class="bg-default">
               <th style="width:20%">Cedula:</th>
               <th style="width:25%">Nombre Completo:</th>
               <th style="width:25%">Estado:</th>
               <th style="width:30%">Acciones:</th>
               <th></th>
            </thead>
            <tbody>
               @foreach ($customers as $customer)

                  <tr>
                     <td>{{$customer->idNumber}}</td>
                     <td>{{$customer->name}}</td>

                     <td style="max-width:90px">
                     @if($customer->stateUser == 'Deshabilitado')
                        <strong style="color:red">Deshabilitad@</strong>
                     @elseif($customer->statePayment == 'Pago Confirmado' or $customer->statePayment == null)
                        <strong style="color:rgb(110, 110, 110)">Sin Pagos Pendientes</strong>
                     @elseif($customer->statePayment == 'SFP' or $customer->statePayment == null)
                        <strong style="color:rgb(110, 110, 110)">Sin Pagos Pendientes</strong>
                     @elseif($customer->statePayment == 'Pago Realizado')
                        <strong style="color:rgb(2, 117, 2)"> Pago Realizado</strong>
                     @elseif(\Carbon\Carbon::parse($customer->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                        )
                        <strong style="color:rgb(195, 32, 42)">Retraso</strong>
                     @elseif($customer->paymentTimely < \Carbon\Carbon::now()->addDays(-1))
                        <strong style="color:rgb(195, 32, 42)">{{$customer->statePayment   }}</strong>
                     @elseif($customer->statePayment == 'Pendiente')
                        <strong style="color:rgb(34, 36, 237)">{{$customer->statePayment}}</strong>
                     @endif
                        </td>
                     <td>
                        <a class="btn btn-primary btn-sm" href="{{route('customersDetails',$customer->id)}}"data-toggle="tooltip" data-placement="top" title="Cuenta"><i class="fas fa-sign-in-alt"></i></a>

                        @if($customer->stateUser != 'Deshabilitado')
                           @if(Auth::user()->role == 'Administrador' and $customer->statePayment == 'Pendiente')

                                 @if(\Carbon\Carbon::parse($customer->paymentTimely)->addDays(5) < \Carbon\Carbon::now()
                                    )
                                    <a data-toggle="tooltip" data-placement="top" title="Enviar Aviso de Suspensión" class="btn btn-danger btn-sm" onclick="Aviso({{$customer->phone1}})"><i class="far fa-comment-alt"></i></a>
                                 @elseif($customer->paymentTimely < \Carbon\Carbon::now()->addDays(-1))
                                    <a data-toggle="tooltip" data-placement="top" title="Enviar Mensaje Recordatorio" class="btn btn-info btn-sm" onclick="reminder({{$customer->phone1}})"><i class="far fa-comment-alt"></i></a>
                                 @endif


                           @endif

                           <a style="" data-toggle="tooltip" data-placement="top" title="Pagos Pendientes" class="btn btn-warning btn-sm" href="{{route('customersServices',$customer->id)}}"><i class="far fa-credit-card"></i></a>
                           @if(Auth::user()->role == 'Administrador')
                              <a style="background:rgb(118, 154, 41)"data-toggle="tooltip" data-placement="top" title="Factura Ocasional" class="btn btn-primary btn-sm" href="{{route('invoiceOccasional',$customer->id)}}"><i class="far fa-list-alt"></i></a>
                           @endif
                           <a style="margin-" data-toggle="tooltip" data-placement="top" title="Documentos" class="btn btn-default btn-sm" href="{{route('listDocuments',$customer->id)}}"><i class="far fa-folder-open"></i>
                           </a>

                           <a style="background:rgb(176, 174, 179)"data-toggle="tooltip" data-placement="top" title="Anotaciones/Observaciones" class="btn btn-primary btn-sm" href="{{route('notesList',$customer->id)}}"><i class="far fa-clipboard"></i>
                           </a>
                           <a style="" data-toggle="tooltip" data-placement="top" title="Facturas" class="btn btn-success btn-sm" href="{{route('invoiceList',$customer->id)}}"><i class="fas fa-list-alt"></i></a>
                        @endif
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>
         <div class="panel-footer">
            {{ $customers->links() }}
         </div>
      </div>
@endsection

@section('scriptpersonal')
   <script src="{{asset('js/messages.js')}}" type="text/javascript" >

   </script>
@show
