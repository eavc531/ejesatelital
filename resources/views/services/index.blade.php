@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Administrar Servicios
@endsection

@section('contentheader_title')
   Administrar Servicios
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i><strong>Inicio</strong>
   </a>

@endsection

@section('main-content')
   <a style="margin-bottom:20px" class="btn btn-primary btn-lg" href="{{route('services.create')}}">Agregar Servicio</a>
   <div class="panel panel">
      <div class="panel-heading bg-primary">
         Administrar Servicios
      </div>
      <div class="panel-body">
         <table class="table table-striped">
            <thead>
               <th>Nombre:</th>
               <th>Descripción:</th>
               <th>Mensualidad:</th>
               <th>Acciones:</th>
            </thead>
            <tbody>

               @foreach ($services as $s)
                  <tr>
                     <td>{{$s->name}}</td>
                     <td>{{$s->description}}</td>
                     <td>{{$s->payment}}</td>
                     <td style="display:flex">	<a data-toggle="tooltip" data-placement="top" title="Editar Servicio" class="btn btn-success" href="{{route('services.edit',$s->id)}}"><i class="fas fa-edit"></i></a>

                     {!!Form::open(['route'=>['services.destroy',$s->id],'method'=>'DELETE'])!!}
                        <button  aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Eliminar Servicio" style="margin-left:5px" class='btn btn-danger' type='submit' value='submit' onclick="return confirm('Esta Segur@ de Eliminar este Servicio')">
                           <i class="fas fa-times-circle"></i>

                       </button>
                     {!!Form::close()!!}
                  </td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      <div class="panel-footer">
         {{ $services->links() }}
      </div>
      </div>




@endsection
