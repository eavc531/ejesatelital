@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Servicios del Vehiculo: {{$vehicle->name}}
@endsection

@section('contentheader_title')
   Servicios del Vehiculo: {{$vehicle->name}}
@endsection

@section('contentheader-button')
   <a style=""class="btn btn-default" href="{{route('customersVehicles',$vehicle->customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="color:white" class="btn btn-primary" href="{{route('customersDetails',$vehicle->customer->id)}}"data-toggle="tooltip" data-placement="top" title="Detalles de Usuario"><strong>Detalles Usuario</strong></a>
@endsection

@section('main-content')

   <div class="panel" style="max-width:600px">
      <div class="panel-heading bg-primary">
         <strong>Añadir Servicio a: {{$vehicle->name}}</strong>

      </div>
      <div class="panel-body">
            {!!Form::open(['route'=>'vehiclesServices.store', 'method'=>'POST'])!!}
            <div class="col-sm-10">
                  {!!Form::select('services_id',$serviceslist, null,['class'=>'form-control','placeholder'=>'Seleccione un Servicio', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px; color: #000;'])!!}
                  {!!Form::hidden('vehicles_id',$vehicle->id)!!}
                  {!!Form::hidden('customers_id',$vehicle->customer_id)!!}
            </div>

            <div class="col-sm-2">
               {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}

            </div>
            {!!Form::close()!!}


      </div>
   </div>
   <div class="panel">
      <div class="panel-heading bg-primary">
         <strong>Servicios del Vehiculo: {{$vehicle->name}}</strong>
      </div>
      <div class="panel-body">
         <table class="table table-striped">
            <thead>
               <th>Nombre:</th>
               <th>Pago:</th>
               <th>Descripción:</th>
               @if(Auth::user()->role == 'Administrador')
               <th>Acciones:</th>
               @endif
            </thead>
            <tbody>
               @foreach ($serviceVehicle as $s)
                  <tr>
                     <td>{{$s->services->name}}</td>
                     <td>{{$s->services->payment}}</td>
                     <td>{{$s->services->description}}</td>
                     @if(Auth::user()->role == 'Administrador')
                     <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-placement="top" title="Eliminar Servicio" data-target="#deleteServiceV" OnClick="servicioDestroy({{$s->services_id}})">
                     <i class="fas fa-times-circle"></i></button>
                  </td>
                     @endif
                  </tr>
               @endforeach
         </table>
      </div>
      </div>
   </div>


   <!-- Modal -->
   <div class="modal fade" id="deleteServiceV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header" style="color:white;background:rgba(212, 10, 4, 0.78)">
           <h5 class="modal-title" id="exampleModalLabel"><strong>!Atencion¡</strong></h5>
           </button>
         </div>
         <div class="modal-body">
            <strong>¿Esta Segur@ de Querer Eliminar este servicio?</strong>
         </div>
         <div class="modal-footer">


               {!!Form::open(['route'=>'serviceVDestroy', 'method'=>'POST'])!!}
               {!!Form::hidden('service_id',null,['id'=>'serviceDestroy'])!!}
               {!!Form::hidden('vehicle_id',$vehicle->id)!!}
               {!!Form::submit('Acepta',['class'=>'btn btn-danger pull-right'])!!}

              {!!Form::close()!!}
              <button style="margin-right:10px;margin-top:-13px" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

         </div>
       </div>
     </div>
   </div>
@endsection

@section('scriptpersonal')
   <script type="text/javascript">


   function servicioDestroy(device_id){

      $('#serviceDestroy').val(device_id);
   }
   </script>
@show
