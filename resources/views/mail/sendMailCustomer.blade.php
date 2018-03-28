@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Enviar Email a: {{$customer->name}}
@endsection

@section('contentheader_title')
   Enviar Email a: {{$customer->name}}
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customersDetails',$customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')
   <div class="panel panel" style="max-width:600px">
      <div class="panel-heading bg-primary">
         <strong>Enviar Email</strong>
      </div>

      <div class="panel-body">
         {!!Form::model($customer,['route'=>['sendMessageCustomer',$customer], 'method'=>'POST'])!!}

         <label for="email"> <strong>Correo:</strong></label>
         {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese un Correo Electronico', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

         <label for="subject"> <strong>Asunto:</strong></label>
         {!!Form::text('subject',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

         <label for="mensaje"> <strong>Mensaje:</strong></label>
         {!!Form::textarea('mensaje',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

         {!!Form::hidden('id',$customer->id)!!}

         <div class="form-group" style="margin-top:20px">
            {!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
         </div>


         {!!Form::close()!!}

      </div>


</div>


@endsection
