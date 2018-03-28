@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Notificaciones Vistas
@endsection

@section('contentheader_title')
    Notificaciones Vistas
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customers.index')}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')


   <div class="panel panel">
      <div class="panel-heading bg-primary" style="height:52px">
         <strong>Notificaciones</strong>
         <a class="btn btn-default pull-right" href="{{route('notifications')}}"><strong>Notificaciones</strong></a>
      </div>

      <div class="panel-body">
         <table class="table table-striped" style="background:white">
            <thead>
               <th>Notificacion:</th>
               <th>Descripcion:</th>

               <th>Fecha:</th>

            </thead>

            <tbody>
               @foreach ($notifications as $n)
                  <tr>
                     <td>
                        @if($n->notification == 'Nueva Nota Agregada')
                           <strong style="color:rgb(6, 193, 181)">{{$n->notification}}</strong>
                        @elseif($n->notification == 'Nuevo Documento Agregado')
                           <strong style="color:rgb(114, 142, 161)">{{$n->notification}}</strong>
                        @elseif($n->notification == 'Documento Confirmado')
                           <strong style="color:rgb(1, 154, 71)">{{$n->notification}}</strong>
                        @elseif($n->notification == 'Nuevo Usuario Agregado')
                           <strong style="color:rgb(0, 76, 224)">{{$n->notification}}</strong>
                        @elseif ($n->notification == 'Documento rechazado')
                           <strong style="color:rgb(215, 47, 47)">{{$n->notification}}</strong>
                        @endif
                     </td>
                     <td><strong>{{$n->execute}}</strong></td>
                     
                     <td>{{$n->created_at->format('d-m-Y')}}</td>
                  </tr>
               @endforeach

            </tbody>
            <tfoot>
               <td colspan="5">{{$notifications->links()}}</td>
            </tfoot>
         </table>

      </div>

</div>


@endsection
