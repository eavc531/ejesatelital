@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Cambio de Dispositivo: {{$device->name}}
@endsection

@section('contentheader_title')
   Cambio de Dispositivo: {{$device->name}}sss
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('devicesList',$vehicle->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')
<div class="row">
   <div class="col-sm-4">
      <div class="panel panel-default">
         <div class="panel-heading bg-default">
            <strong>Dispositivo Actual</strong>
         </div>
         <div class="panel-body">

            <div class="form-group">
               {!!Form::label('Nombre:')!!}
               <strong>{{$device->name}}</strong>
            </div>
            <div class="form-group">
               {!!Form::label('SIM:')!!}
               <strong>{{$device->sim}}</strong>
            </div>
            <div class="form-group">
               {!!Form::label('IMEI:')!!}
               <strong>{{$device->imei}}</strong>

            </div>
         </div>
      </div>
   </div>


   <div class="col-sm-4">
      <div class="panel">
         <div class="panel-heading bg-primary">
            Dispositivo Nuevo
         </div>
         <div class="panel-body">

            {!!Form::open(['route'=>['deviceChangeStore',$device->id],'method'=>'POST'])!!}
            <div class="form-group">
               {!!Form::label('Nombre:')!!}
               {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese el Nombre del Nuevo Dispositivo', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
            </div>
            <div class="form-group">
               {!!Form::label('SIM:')!!}
               {!!Form::text('sim',null,['class'=>'form-control','placeholder'=>'Ingrese el Nuevo Codigo IMEI', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
            </div>
            <div class="form-group">
               {!!Form::label('IMEI:')!!}
               {!!Form::text('imei',null,['class'=>'form-control','placeholder'=>'Ingrese el Nuevo Codigo SIM', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

            </div>
            <div class="form-group">
               {!!Form::label('Pertenencia:')!!}
               {!!Form::select('membership',['Propio'=>'Propio','Conmodato'=>'Conmodato'],null,['class'=>'form-control','style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','placeholder'=>'Opcion'])!!}
               {!!Form::hidden('vehicle_id',$vehicle->id)!!}
            </div>
            <div class="form-group">
                  {!!Form::submit('Reemplazar Dispositivo',['class'=>'btn btn-primary'])!!}
               {!!Form::close()!!}
            </div>
         </div>

      </div>
   </div>
</div>




@endsection
