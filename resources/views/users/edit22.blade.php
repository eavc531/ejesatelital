@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Usuario
@endsection

@section('title')
	Editar Usuario
@endsection

@section('main-content')
   <div class="row" style="margin-top:30px;margin-left:20px">
      <div class="col-sm-8 panel" style="padding:15px">

         {!!Form::model($user,['route'=>['users.update',$user],'method'=>'PUT'])!!}
            <div class="form-group">
               {!!Form::label('name','Nombre:',['style'=>'font-weight: bold'])!!}
               {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Usuario'])!!}
            </div>
				<div class="form-group">
               {!!Form::label('Email','email:',['style'=>'font-weight: bold'])!!}
               {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email del usuario'])!!}
            </div>
				<div class="form-group">
               {!!Form::label('rol','Rol:',['style'=>'font-weight: bold'])!!}
               {!!Form::select('rol',['admin' => 'Administrador', 'member' => 'Mienbro'],null,['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
               {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}
            </div>
         {!!Form::close()!!}

      </div>
   </div>

@endsection
