@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Listado de Clientes Deshabilitados
@endsection

@section('contentheader_title')
   Listado de Clientes Deshabilitados
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('home')}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')
   <a style="margin-bottom: 20px" class="btn btn-primary btn-lg" href="{{route('customerCreate')}}"><strong>Agregar Cliente</strong></a>

   <div class="panel panel">
      <div class="panel-heading" style="height:50px">


         @if(!isset($var))
         <div class="dropdown pull-right" style="margin-left:4px;margin-top:-8px;color:white">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               <strong>Filtrar</strong>
               <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
               <li>
                  <div>
                     <a class="btn btn-success" href="{{route('confirm',['var'=>'Confirm'])}}"><strong>Pago Confirmado</strong></a>
                  </div>
               </li>
               <li role="separator" class="divider"></li>

               <li>
                  <div>
                     <a class="btn btn-warning" href="{{route('Pending',['var'=>'Pending'])}}"><strong>Pago Pendiente</strong></a>
                  </div>
               </li>
               <li role="separator" class="divider"></li>
               <li>
                  <div><a href="{{route('customerDisabled',['x'=>'disabled'])}}" class="btn btn-danger"><strong>Deshabilitados</strong></a></div>
               </li>
            </ul>
         </div>
         @endif
         <a href="{{route('customers.index')}}" class="btn btn-default pull-right" style="margin-top:-8px"><strong>Mostrar Todos</strong></a>
         <div class="pull-right" style="margin-bottom:">
            <div class="form-inline">
               {!!Form::open(['route'=>'customers.index', 'method'=>'GET','class'=>'navbar-form','style'=>'margin-top:-8px'])!!}
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
               <th>Cedula:</th>
               <th>Nombre Completo:</th>
               <th>Estado de Cuenta:</th>
               <th>Estado de Pagos:</th>
               <th>Acciones:</th>
               <th></th>
            </thead>
            <tbody>
               @foreach ($customers as $customer)

                  <tr>
                     <td>{{$customer->idNumber}}</td>
                     <td>{{$customer->name}}</td>
                     <td>{{$customer->stateUser}}</td>
                     <td style="max-width:90px">@if($customer->estatePayment == 'Pago Confirmado')

                     @elseif($customer->estatePayment == 'Pago Realizado')
                        <strong style="background:rgb(242, 124, 0);color:white;padding:2px;border-radius:10px;">{{$customer->estatePayment}}/Por Confirmar</strong>

                     @elseif(isset($customer->paymentTimely) and $customer->paymentTimely > \Carbon\Carbon::now() and \Carbon\Carbon::parse($customer->paymentTimely) < \Carbon\Carbon::now()->addDays(6))
                        <strong style="padding:6px;"></strong> <strong style="background:rgb(131, 175, 5);color:white;padding:2px;border-radius:10px; ">Factura Pendiente</strong>
                     @elseif(isset($customer->paymentTimely) and $customer->paymentTimely < \Carbon\Carbon::now()
                        )
                        <strong style="padding:6px;"></strong> <strong style="background:red;color:white;padding:2px;border-radius:10px; ">Pago Retrasado</strong>
                     @elseif($customer->estatePayment == 'Sin Enviar' and Auth::User()->role != 'Cliente')
                        <strong style="padding:6px;"></strong> <strong style="background:rgb(231, 229, 84);color:rgb(227, 91, 41);padding:2px;border-radius:10px; ">Factura {{$customer->estatePayment}}</strong>
                     @elseif(Auth::User()->role == 'Cliente' and $customer->estatePayment != 'Pago Confirmado')
                        <strong style="padding:6px;"></strong> <strong style="background:rgb(22, 171, 64);color:white;padding:2px;border-radius:10px;">Pago Pendiente</strong>
                     @elseif($customer->estatePayment == 'Enviada/Pendiente')
                        <strong style="padding:6px;"></strong> <strong style="background:rgb(23, 131, 191);color:white;padding:2px;border-radius:10px; ">Factura Pendiente</strong>
                     @endif
                        </td>
                     <td>
                        <a class="btn btn-primary" href="{{route('customersDetails',$customer->id)}}"data-toggle="tooltip" data-placement="top" title="Datos del Cliente"><i class="fa fa-sign-in" aria-hidden="true"></i></a>

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
