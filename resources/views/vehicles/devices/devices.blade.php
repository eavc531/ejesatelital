@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Dispositivos del Vehiculo: {{$vehicle->name}}
@endsection

@section('contentheader_title')
   Dispositivos del Vehiculo: {{$vehicle->name}}
@endsection

@section('contentheader-button')
   <a class="btn btn-default" href="{{route('customersVehicles',$vehicle->customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="color:white" class="btn btn-primary" href="{{route('customersDetails',$vehicle->customer->id)}}"data-toggle="tooltip" data-placement="top" title="Detalles de Usuario"><strong>Detalles Usuario</strong></a>
@endsection


@section('main-content')
   <div class="row">
      <div class="col-md-3">
         <div class="panel" style="max-width:250px">
            <div class="panel-heading bg-primary">
               <strong>Agregar Dispositivo</strong>
            </div>
            <div class="panel-body">
                     {!!Form::open(['route'=>'devices.store', 'method'=>'POST'])!!}
                  <div class="form-group">

                     {!!Form::label('Nombre:')!!}
                     {!!Form::text('name',null,['class'=>'form-control',    'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

                     {!!Form::label('SIM:')!!}
                     {!!Form::text('sim',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

                     {!!Form::label('IMEI:')!!}
                     {!!Form::text('imei',null,['class'=>'form-control','style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
                     {!!Form::hidden('vehicle_id',$vehicle->id)!!}

                     {!!Form::label('Pertenencia:')!!}
                     {!!Form::select('membership',['Propio'=>'Propio','Conmodato'=>'Conmodato'],null,['class'=>'form-control','style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','placeholder'=>'Opcion'])!!}
                     {!!Form::hidden('vehicle_id',$vehicle->id)!!}
                  </div>
                  <div class="form-group" style="margin-top:20px">
                     {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}
                     {!!Form::close()!!}
                  </div>
               </div>
         </div>
      </div>


      <div class="col-md-9">
         <div class="panel">
            <div class="panel-heading bg-primary">
               Dispositivos Instalados
            </div>
            <div class="panel-body">
               <table class="table table-striped">
                  <thead class="bg-default">
                     <th>Nombre:</th>
                     <th>SIM:</th>
                     <th>IMEI:</th>
                     <th>Perntenencia:</th>
                     <th>Inicio:</th>
                     @if(Auth::user()->role == 'Administrador')
                     <th>Acciones:</th>
                     @endif
                  </thead>
                  <tbody>
                     @foreach ($devices as $d)
                        <tr>
                           <td>{{$d->name}}</td>
                           <td>{{$d->sim}}</td>
                           <td>{{$d->imei}}</td>
                           <td>{{$d->membership}}</td>
                           <td>{{$d->created_at->format('d-m-Y')}}</td>
                           @if(Auth::user()->role == 'Administrador')
                           <td>
                           <a data-toggle="tooltip" data-placement="top" title="Editar Dispositivo" href="{{route('devices.edit',$d->id)}}" class="btn btn-success"><i class="far fa-edit"></i></a>

                           <button type="button" class="btn btn-danger" data-toggle="modal" data-placement="top" title="Eliminar Dispositivo" data-target="#exampleModal" OnClick="deleteDevice({{$d->id}})">
                             <i class="fas fa-times-circle"></i></button>
                           </td>
                           @endif
                        </tr>

                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>


         <div class="panel">
            <div class="panel-heading" style="color:white;background:rgb(184, 63, 71)">
               Dispositivos Desinstalados
            </div>
            <div class="panel-body">
               <table class="table table-striped">
                  <thead class="bg-default">
                     <th>Nombre:</th>
                     <th>SIM:</th>
                     <th>IMEI:</th>
                     <th>Desinstalación:</th>
                  </thead>
                  <tbody>
                     @foreach ($devicesUninstalled as $du)
                        <tr>
                           <td>{{$du->name}}</td>
                           <td>{{$du->sim}}</td>
                           <td>{{$du->imei}}</td>
                           <td>{{$du->created_at->format('d-m-Y')}}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>

      </div>


   </div>
   <!--col-2-->






<!--Modal-->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="color:white;background:rgba(212, 10, 4, 0.78)">
        <h5 class="modal-title" id="exampleModalLabel"><strong>!Atencion¡</strong></h5>
        </button>
      </div>
      <div class="modal-body">
         <strong>¿Esta Segur@ de Querer Eliminar este Dispositivo?</strong>
      </div>
      <div class="modal-footer">


            {!!Form::open(['route'=>'deviceDestroy', 'method'=>'POST'])!!}
            {!!Form::hidden('device_id',null,['id'=>'deviceDestroy'])!!}
            {!!Form::submit('Acepta',['class'=>'btn btn-danger pull-right'])!!}
           {!!Form::close()!!}
           <button style="margin-top:-14px;margin-right:10px" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>



      </div>
    </div>
  </div>
</div>

@endsection

@section('scriptpersonal')
   <script type="text/javascript">


   function deleteDevice(device_id){
      $('#deviceDestroy').val(device_id);
   }
   </script>
@show
