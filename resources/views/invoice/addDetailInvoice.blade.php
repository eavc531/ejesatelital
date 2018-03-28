@extends('adminlte::layouts.app')

@section('htmlheader_title') {{$invoice->invoiceperiod}}
   Agregar Detalle a factura:
@endsection

@section('contentheader_title')
   Agregar Detalle a factura: {{$invoice->invoiceperiod}}
@endsection

@section('main-content')

   <div class="panel" style="max-width:800px">
      <div class="panel-heading bg-primary">
         <strong>Añadir Servicos Adicionales</strong>
      </div>
      <div class="panel-body row">
            {!!Form::open(['route'=>'addDetailInvoiceStore', 'method'=>'POST'])!!}
            <div class="col-sm-12 form-inline">
               {!!Form::label('Servicio:')!!}
               {!!Form::select('type',['Adicional' =>'Adicional','Descuento' =>'Descuento' ],null,['class'=>'form-control','placeholder'=>'Seleccione una Opcion'])!!}

               {!!Form::label('Placa:')!!}
               {!!Form::select('plate',$vehicle,null,['class'=>'form-control','placeholder'=>'Opcional'])!!}

               {!!Form::label('Monto:')!!}
               {!!Form::text('payment',null,['class'=>'form-control','placeholder'=>'Precio del Servicio'])!!}
            </div>

            <div class="col-sm-8" style="margin-top:20px">
               {!!Form::label('Descripción:')!!}
               {!!Form::text('description',null,['class'=>'form-control','placeholder'=>'Descripción','id'=>'description','style'=>'max-width:600px'])!!}
            </div>

            <div class="col-sm-4" style="margin-top:50px">
               {!!Form::submit('Agregar',['class'=>'btn btn-primary','style'=>'margin-top:20px'])!!}
               <a style="margin-top:20px"class="btn btn-default" href="{{route('customersServices',$invoice->id)}}">Cancelar</a>
            </div>
            {!!Form::hidden('id',$invoice->id)!!}
            {!!Form::close()!!}
         </div>
      </div>

@endsection
