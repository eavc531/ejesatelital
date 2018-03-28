@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Nuevo Usuario
@endsection

@section('contentheader_title')
	Crear Nuevo Usuario
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('users.index')}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')

	<div class="panel" style="max-width:500px;margin: 0 auto;border-radius:15px">
		<div class="panel-heading bg-primary">
			<strong>Crear Nuevo Usuario</strong>
		</div>
		<div class="panel-body">
			{!!Form::open(['route'=>'users.store','method'=>'POST'])!!}
            <div class="form-group">
               {!!Form::label('name','Nombre:',['style'=>'font-weight: bold'])!!}
               {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Usuario'])!!}
            </div>
				<div class="form-group">
               {!!Form::label('Email','email:',['style'=>'font-weight: bold'])!!}
               {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email del usuario'])!!}
            </div>
				<div class="form-group">
               {!!Form::label('password','Contraseña:',['style'=>'font-weight: bold'])!!}
               {!!Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña'])!!}
            </div>
				<div class="form-group">
               {!!Form::label('role','Rol:',['style'=>'font-weight: bold'])!!}
               {!!Form::select('role',['Vendedor' => 'Vendedor','Administrador' => 'Administrador'],null,['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
               {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}
					<a href="{{route('users.index')}}" class="btn btn-default">Cancelar</a>
            </div>
         {!!Form::close()!!}
		</div>
	</div>




@endsection
