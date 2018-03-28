@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Clientes Asignados a: {{$user->name}}
@endsection

@section('contentheader_title')
   Clientes Asignados a: {{$user->name}}
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('users.index')}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')


<div class="panel" style="max-width:1200px">
	<div class="panel-heading bg-primary">
		<strong>Usuarios</strong>
	</div>
	<div class="panel-body">
		<table class="table table-striped" style="background:white">
			<thead class="bg-default">
				<th>Nombre de Cliente:</th>
				<th>Correo:</th>

			</thead>
				<tbody>
					@foreach ($customers as $c)

						<tr>
							<td>{{$c->name}}</td>
							<td>{{$c->email}}</td>

							<td style="display:flex;flex-direction:row;">
								<a data-toggle="tooltip" data-placement="top" title="Asignar a Otro Vendedor" class="btn btn-success" href="{{route('assignCustomer',$c->id)}}"><i class="fas fa-exchange-alt"></i></a>

							</td>
						</tr>

					@endforeach
				</tbody>
			<tfoot>


			</tfoot>
		</table>
	</div>
	<div class="panel-footer">
		{{ $customers->links() }}
	</div>
</div>







@endsection
