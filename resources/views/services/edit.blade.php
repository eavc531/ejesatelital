@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Editar Servicio
@endsection

@section('contentheader_title')
   Editar Servicio
@endsection

@section('contentheader-button')
   <a d="margin-bottom:30px"class="btn btn-default" href="{{route('services.index')}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>

@endsection


@section('main-content')
<div class="panel panel" style="max-width:450px;margin: 0 auto;border-radius:15px">
   <div class="panel-heading bg-primary">
      Editar Servicio
   </div>
   <div class="panel-body">
      {!!Form::model($services,['route'=>['services.update',$services->id], 'method'=>'PUT'])!!}
         <div class="form-group">
            <div class="form-group">
               {!!Form::label('Nombre:')!!}
               {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Servicio', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
            </div>
            <div class="form-group">
               {!!Form::label('Descripción:')!!}
               {!!Form::text('description',null,['class'=>'form-control','placeholder'=>'Descripción del Servicio', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
            </div>
            <div class="form-group">
               {!!Form::label('Mensualidad:')!!}
               {!!Form::text('payment',null,['class'=>'form-control','placeholder'=>'Precio del Servicio', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
            </div>
            <div class="form-group" style="display:flex;">
               {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}
               <a style="margin-left:5px" class="btn btn-default" href="{{route('services.index')}}"><strong>Cancelar</strong>
               </a>
            </div>

      {!!Form::close()!!}
   </div>
</div>



@endsection
