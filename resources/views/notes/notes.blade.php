@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Anotaciones/Observaciones Sobre el Cliente: {{$customer->name}}
@endsection

@section('contentheader_title')
    Anotaciones/Observaciones Sobre el Cliente: {{$customer->name}}
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customersDetails',$customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="margin-bottom:30px;color:white" href="{{route('customers.index')}}" class="btn btn-primary"><strong>Clientes</strong></a>
@endsection

@section('main-content')
   <a style="margin-bottom:30px"class="btn btn-primary btn-lg" href="{{route('notesCreate',$customer->id)}}">Agregar Nota</a>

   <div class="panel panel">
      <div class="panel-heading bg-primary">
         <strong>Enviar Email</strong>
      </div>

      <div class="panel-body">
         <table class="table">
            <th>Titulo:</th>
            <th>Contenido:</th>
            <th>Autor:</th>
            <th>Fecha:</th>
            <tbody>
               @foreach ($notes as $n)
                  <tr>
                     <td>{{$n->title}}</td>
                     <td>{{$n->content}}</td>
                     <td>{{$n->Autor}}</td>
                     <td>{{$n->created_at->format('d-m-Y')}}</td>
                     <td><a onclick="confirm('¿Esta Segur@ de Querer eliminar esta Nota?')" data-toggle="tooltip" data-placement="top" title="Eliminar Nota"  class="btn btn-danger btn-sm" href="{{route('notesDestroy',$n->id)}}"><i class="far fa-times-circle"></i></a></td>
                  </tr>
               @endforeach

            </tbody>
            <tfoot>
               <td colspan="5">{{$notes->links()}}</td>
            </tfoot>
         </table>

      </div>


</div>


@endsection
