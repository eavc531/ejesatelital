@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Vehiculos
@endsection

@section('contentheader_title')
   Vehículos del Usuario: {{$customer->name}}
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customersDetails',$customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')
   <div class="row">
      <div class="col-lg-3 col-md-3">
         <div class="panel">
            <div class="panel-heading bg-primary">
               <strong>Agregar Vehiculos</strong>
            </div>
            <div class="panel-body">
               {!!Form::open(['route'=>'storeVehicles', 'method'=>'POST'])!!}
               <div class="form-group">
                  <div class="form-group">
                     {!!Form::label('Nombre:')!!}
                     {!!Form::text('name',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
                  </div>

                  <div class="form-group">
                     {!!Form::label('Placa:')!!}
                     {!!Form::text('plate',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
                  </div>
               <div class="form-group">
                     {!!Form::label('Año:')!!}
                     {!!Form::text('year',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
                     {!!Form::hidden('customer_id',$customer->id)!!}
                  </div>

               </div>
               <div class="form-group">
                  {!!Form::submit('Agregar Vehiculo',['class'=>'btn btn-primary'])!!}

                  {!!Form::close()!!}
               </div>

            </div>
         </div>
      </div>

      <div class="col-lg-9 col-md-9">
         <div class="panel">
            <div class="panel-heading bg-primary">
               <strong>Vehículos del Usuario: {{$customer->name}}</strong>
            </div>
            <div class="panel-body">
               <table class="table table-striped">
                  <thead>
                     <th>Nombre:</th>
                     <th>Placa:</th>
                     <th>Año:</th>
                     <th>Inicio</th>
                     <th>Acciones</th>
                  </thead>
                  <tbody>
                     @foreach ($vehicles as $v)
                        <tr>
                           <td>{{$v->name}}</td>
                           <td>{{$v->plate}}</td>
                           <td>{{$v->year}}</td>
                           <td>{{$v->created_at->format('m-d-Y')}}</td>
                           <td><a data-toggle="tooltip" data-placement="top" title="Agregar Servicios" class="btn btn-primary" href="{{route('addService',$v->id)}}"> <i class="fa fa-wrench" aria-hidden="true"></i></a>
                           <a data-toggle="tooltip" data-placement="top" title="Administrar Dispositivos" class="btn btn-info" href="{{route('devicesList',$v->id)}}"><i class="fa fa-microchip" aria-hidden="true"></i></a>
                           @if(Auth::user()->role == 'Administrador')
                           <a onclick="confirm('¿Esta Segur@ de Eliminar este Vehículo?')"data-toggle="tooltip" data-placement="top" title="Eliminar Vehículo"href="{{route('vehicleDestroy',$v->id)}}" class="btn btn-danger"><i class="fas fa-times-circle"></i></a>
                           @endif
                           </td>

                        </tr>
                     @endforeach
                  </table>
            </div>
         </div>

      </div>
   </div>






   @endsection
