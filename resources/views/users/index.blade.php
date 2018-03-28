@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Administración de Usuarios
@endsection

@section('contentheader_title')
   Administración de Usuarios
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i><strong>Inicio</strong>
   </a>
@endsection

@section('main-content')

	<a style="margin-bottom:10px" href="{{route('users.create')}}" class="btn btn-primary btn-lg"><strong>Crear nuevo Usuario</strong></a>

<div class="panel" style="max-width:1200px">
	<div class="panel-heading bg-primary">
		<strong>Usuarios</strong>
	</div>
	<div class="panel-body">
		<table class="table table-striped" style="background:white">
			<thead class="bg-default">
				<th>Nombre</th>
				<th>Correo</th>
				<th>Rol</th>
				<th>Acciones</th>
			</thead>
				<tbody>
					@foreach ($users as $user)
						@if($user->role != 'Cliente')
						<tr>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->role}}</td>
							<td style="display:flex;flex-direction:row;">
								<a data-toggle="tooltip" data-placement="top" title="Editar Usuario" class="btn btn-success" href="{{route('users.edit',$user->id)}}"><i class="fas fa-edit"></i></a>
									<a style="margin-left:5px" data-toggle="tooltip" data-placement="top" title="Clientes Asignados" class="btn btn-info" href="{{route('userClients',$user->id)}}"><i class="fa fa-users" aria-hidden="true"></i></a>
								 {!!Form::open(['route'=>['users.destroy',$user->id],'method'=>'DELETE'])!!}

									 <button  style="margin-left:5px" class='btn btn-danger' type='submit' value='submit' onclick="return confirm('¿Esta Segur@ de Eliminar este Usuario?')" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Eliminar Usuario">
										 <i class="fas fa-times-circle"></i>

									</button>


								 {!!Form::close()!!}


							</td>
						</tr>
						@endif
					@endforeach
				</tbody>
			<tfoot>
			</tfoot>
		</table>
	</div>
	<div class="panel-footer">
		{{ $users->links() }}
	</div>
</div>

@endsection
