@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Notas/Observaciones: {{$customer->name}}
@endsection

@section('contentheader_title')
   Notas/Observaciones: {{$customer->name}}
@endsection

@section('contentheader-button')
   <a d="margin-bottom:30px"class="btn btn-default" href="{{route('services.index')}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>

@endsection

@section('main-content')
      <div class="panel" style="max-width:400px">
         <div class="panel-heading bg-primary">
            <strong>Crear nota</strong>
         </div>
         <div class="panel-body">
            {!!Form::open(['route'=>'notes.store', 'method'=>'POST'])!!}
               <div class="form-group">
                  <div class="form-group">
                     <label for=""><strong>Titulo:</strong></label>
                     {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'Titulo de la Nota', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
                  </div>
                  <div class="form-group">
                     <label for=""><strong>Contenido:</strong></label>
                     {!!Form::textarea('content',null,['class'=>'form-control','placeholder'=>'Descripción/Observación ', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
                  </div>
                     <input type="hidden" name="customer_id" value="{{$customer->id}}">
                     <input type="hidden" name="Autor" value="{!!Auth::user()->name!!}">
                     <input type="hidden" name="seller_id" value="{!!Auth::user()->id!!}">
                  <div class="form-group">
                     {!!Form::submit('Crear',['class'=>'btn btn-primary'])!!}
                  </div>
                  {!!Form::close()!!}

         </div>
      </div>

@endsection
