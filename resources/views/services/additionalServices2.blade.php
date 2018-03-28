@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Servicios Adicionales
@endsection

@section('contentheader_title')
   Servicios Adicionales
@endsection

@section('main-content')


   <div class="panel">
      <div class="panel-heading bg-primary">
         <strong>Añadir Servicos Adicionales</strong>
      </div>
      <div class="panel-body row">
            {!!Form::open(['route'=>'additionalServicesStore', 'method'=>'POST'])!!}
            <div class="col-sm-4">
               {!!Form::label('Servicio:')!!}
               {!!Form::select('type',['Adicional' =>'Adicional','Descuento' =>'Descuento'],null,['class'=>'form-control','placeholder'=>'Seleccione una Opcion'])!!}
            </div>

            <div class="col-sm-8">
               {!!Form::label('Descripción:')!!}
               {!!Form::text('description',null,['class'=>'form-control','placeholder'=>'Descripción','id'=>'description'])!!}
            </div>

            <div class="col-sm-5" style="margin-top:20px">
               {!!Form::label('Placa:')!!}
               {!!Form::select('plate',$vehicle,null,['class'=>'form-control','placeholder'=>'Opcional'])!!}
            </div>

            <div class="col-sm-4" style="margin-top:20px">
               {!!Form::label('Monto:')!!}
               {!!Form::text('payment',null,['class'=>'form-control','placeholder'=>'Precio del Servicio'])!!}
               {!!Form::submit('Agregar',['class'=>'btn btn-primary','style'=>'margin-top:20px'])!!}
               <a style="margin-top:20px"class="btn btn-default" href="{{route('customersServices',$customer_id)}}">Cancelar</a>
            </div>
            {!!Form::hidden('customer_id',$customer_id)!!}
            {!!Form::close()!!}
         </div>
      </div>
@endsection
