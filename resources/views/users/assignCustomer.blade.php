@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Asignar Cliente: {{$customer->name}} a un Nuevo Vendedor
@endsection

@section('contentheader_title')
   Asignar Cliente: {{$customer->name}} a un Nuevo Vendedor
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('userClients',$user->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')


<div class="panel" style="max-width:800px;margin: 0 auto;border-radius:15px">
	<div class="panel-heading" style="background:rgb(32, 191, 105);color:white">
		<strong>Seleccione el Vendedor que Asignara a: {{$customer->name}}</strong>
	</div>
	<div class="panel-body">
		<table class="table table-striped" style="background:white">
			<thead class="bg-default">
				<th>Nombre del Vendedor:</th>
				<th>Correo:</th>
            <th>Seleccionar:</th>
			</thead>
				<tbody>
					@foreach ($users as $user)
                  @if($user->role != 'Cliente')
						<tr>

							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>

							<td style="display:flex;flex-direction:row;">
                        {{Form::open(['route'=>'assign','method'=>'POST'])}}
                        {{Form::hidden('customer_id',$customer->id)}}
                        {{Form::hidden('user_id',$user->id)}}
                        <button type="submit" class="btn btn-sm btn-primary"name="button"><i class="fas fa-check"></i></button>
                        {{Form::close()}}
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
