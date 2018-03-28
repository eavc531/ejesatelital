@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Notificaciones
@endsection

@section('contentheader_title')
    Notificaciones
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customers.index')}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')


   <div class="panel panel">
      <div class="panel-heading bg-primary" style="height:52px">
         <strong>Notificaciones</strong>
         <a class="btn btn-default pull-right" href="{{route('notificationsViewed')}}"><strong>Notificaciones Vistas</strong></a>
      </div>

      <div class="panel-body">
         <table class="table table-striped" style="background:white">
            <thead>
               <th>Notificacion:</th>
               <th>Descripcion:</th>
               
               <th>Fecha:</th>
               <th>Acciones:</th>
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
                     <td>{{$n->execute}}</td>

                     <td>{{$n->created_at->format('d-m-Y')}}</td>
                     <td>
                     @if($n->notification == 'Nueva Nota Agregada')
                        <a href="{{route('VerifiednotificationNewNote',['note_id'=>$n->id,'seller_id'=>$n->seller_id,'customer_id'=>$n->customer_id])}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Nota Agregada"><i class="fas fa-eye"></i></a>
                     @elseif($n->notification == 'Nuevo Documento Agregado')
                        <a href="{{route('VerifiednotificationNewDocu',['note_id'=>$n->id,'seller_id'=>$n->seller_id,'customer_id'=>$n->customer_id])}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Documento Agregado"><i class="fas fa-eye"></i></a>
                     @elseif($n->notification == 'Documento Confirmado')
                        <a href="{{route('VerifiednotificationNewDocu',['note_id'=>$n->id,'seller_id'=>$n->seller_id,'customer_id'=>$n->customer_id])}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Documento"><i class="fas fa-eye"></i></a>
                     @elseif($n->notification == 'Nuevo Usuario Agregado')
                        <a href="{{route('VerifiednotificationNewUser',['note_id'=>$n->id,'seller_id'=>$n->seller_id,'customer_id'=>$n->customer_id])}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Usuario"><i class="fas fa-eye"></i></a>
                     @elseif ($n->notification == 'Documento rechazado')

                     @endif

                     @if($n->notification != 'Nuevo Documento Agregado')
                        <a href="{{route('verifiednotification',$n->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Marcar Notificación como vista"><i class="fas fa-check"></i></a></td>
                     @endif
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
