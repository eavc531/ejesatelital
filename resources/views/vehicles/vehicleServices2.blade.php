@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Servicios del Vehiculo: {{$vehicle->name}}
@endsection

@section('contentheader_title')
   Servicios del Vehiculo: {{$vehicle->name}}
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customersDetails',$vehicle->customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="color:white" class="btn btn-primary" href="{{route('customersDetails',$customer->id)}}"data-toggle="tooltip" data-placement="top" title="Detalles de Usuario"><strong>Detalles Usuario</strong></a>
@endsection

@section('main-content')

   <div class="panel">
      <div class="panel-heading">
         Añadir Servicio a: {{$vehicle->name}}

      </div>
      <div class="panel-body row">
            {!!Form::open(['route'=>'vehiclesServices.store', 'method'=>'POST'])!!}
            <div class="col-sm-6">
                  {!!Form::select('services_id',$serviceslist, null,['class'=>'form-control','placeholder'=>'Seleccione un Servicio', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px; color: #000;'])!!}
                  {!!Form::hidden('vehicles_id',$vehicle->id)!!}
                  {!!Form::hidden('customers_id',$vehicle->customer_id)!!}
            </div>

            <div class="col-sm-6">
               {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}

            </div>
            {!!Form::close()!!}


      </div>
   </div>
      <table class="table table-striped" style="margin-top:30px">
         <thead class="bg-primary">
            <th>Nombre:</th>
            <th>Pago:</th>
            <th>Descripción:</th>
         </thead>
         <tbody>
            @foreach ($serviceVehicle as $s)
               <tr>
                  <td>{{$s->services->name}}</td>
                  <td>{{$s->services->payment}}</td>
                  <td>{{$s->services->description}}</td>
               </tr>
            @endforeach
      </table>
   </div>


@endsection
