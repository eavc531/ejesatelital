@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Contactanos
@endsection

@section('contentheader_title')
   Contactanos
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customersDetails',$customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection
 <p>commit test</p>
@section('main-content')

   <div class="panel" style="max-width:600px;">
      <div class="panel-heading bg-primary">
         <strong>Envianos un Email</strong>
      </div>

      <div class="panel-body" style="padding:40px">

         <label for="name"> <strong>Nombres:</strong></label>
         {!!Form::model($customer,['route'=>['sendMessage',$customer], 'method'=>'POST'])!!}
         {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese Nombres y Apellidos', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

         <label for="email"> <strong>Correo:</strong></label>
         {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese un Correo Electronico', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

         <label for="msg"> <strong>Comentario, sugerencia y/o recomendación:</strong></label>
         {!!Form::textarea('msg',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
         <div class="form-group" style="margin-top:20px">
            {!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
         </div>


         {!!Form::close()!!}

      </div>





</div>


@endsection
