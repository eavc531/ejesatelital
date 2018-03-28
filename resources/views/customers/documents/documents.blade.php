@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Documentos de: {{$customer->name}}
@endsection

@section('contentheader_title')
   Documentos de: {{$customer->name}}
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customersDetails',$customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="margin-bottom:30px;color:white" href="{{route('customers.index')}}" class="btn btn-primary"><strong>Clientes</strong></a>
@endsection

@section('main-content')

   <div class="panel panel" style="max-width:650px">
      <div class="panel-heading bg-primary">
         <strong>Subir Archivo</strong>
      </div>
      <div class="panel-body row">
         {!!Form::open(['route'=>'documents.store','method'=>'POST','files' => true])!!}
            <div class="form-group col-sm-6">
               {!!Form::label('name','Nombre:',['style'=>'font-weight: bold'])!!}
               {!!Form::text('name',null,['class'=>'form-control','style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;','placeholder'=>'Nombre del Archivo'])!!}
            </div>

            <div class="form-group col-sm-6">
               {!!Form::file('archivo',['class'=>'btn btn defautl','style'=>'margin-top:30px'])!!}
            </div>
            <div class="form-group" style="margin-left:20px">
               {!!Form::hidden('customer_id',$customer->id)!!}
               {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}
               <a style=""class="btn btn-default" href="{{route('customersDetails',$customer->id)}}"><strong>Cancelar</strong>
               </a>
               {!!Form::close()!!}
            </div>
      </div>
   </div>


   @if(Auth::user()->role == 'Administrador' and $countEnable > 0)

   <div class="panel">
      <div class="panel-heading" style="color:white; background:rgb(92, 153, 9)">
         <strong>Documentos de: {{$customer->name}} Por Confirmar</strong>
      </div>
      <div class="panel-body">

            <table class="table table-striped panel">
               <thead>
                  <th>
                     Nombre:
                  </th>
                  <th>Fecha de Subida:</th>
                  <th>Extension:</th>
                  <th>Acciones:</th>
               </thead>
               <tbody>
                     @foreach ($documents as $d)
                        @if($d->state == 'disabled')
                           <tr>
                              <td>
                                 {{$d->name}}
                              </td>
                              <td>{{$d->created_at->format('d-m-Y')}}</td>
                              <td>{{$d->format}}</td>
                              <td><a data-toggle="tooltip" data-placement="top" title="Descargar Docuemnto" href="{{route('documentsDonwload',$d->id)}}" class="btn btn-default"><i class="fa fa-download" aria-hidden="true"></i></a>

                              <a href="{{route('confirmDocument',$d->id)}}" data-toggle="tooltip" data-placement="top" title="Aprobar Docuemnto" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>

                              <a href="{{route('documentDelete2',$d->id)}}" onclick="return confirm('¿Al Rechazar este Docuemtno sera eliminado del Sistema, esta Segur@ de Continuar?')" class="btn btn-danger"><i class="far fa-times-circle"></i></a>
                              </td>
                           </tr>
                        @endif
                  @endforeach
               </tbody>

            </table>
      </div>
      <div class="panel-footer">
         {{ $documents->links() }}
      </div>
   </div>

      <!-- Modal -->
      <div class="modal fade" id="deletedocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="color:white;background:rgba(212, 10, 4, 0.78)">
              <h5 class="modal-title" id="exampleModalLabel"><strong>!Atencion¡</strong></h5>
              </button>
            </div>
            <div class="modal-body">
               <strong>¿Esta Segur@ de Querer Eliminar este Documento?</strong>
            </div>
            <div class="modal-footer">

                  {!!Form::open(['route'=>'documentDestroy', 'method'=>'POST'])!!}
                  {!!Form::hidden('id',null,['id'=>'dDestroy'])!!}
                  {!!Form::submit('Acepta',['class'=>'btn btn-danger pull-right'])!!}
                 {!!Form::close()!!}
                 <button style="margin-right:10px;margin-top:-13px" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

            </div>
          </div>
        </div>
      </div>
      @endif



   <div class="panel">
      <div class="panel-heading bg-primary">
         Documentos de: {{$customer->name}}
      </div>
      <div class="panel-body">

            <table class="table table-striped panel">
               <thead>
                  <th>
                     Nombre:
                  </th>
                  <th>Fecha de Subida:</th>
                  <th>Extension:</th>
                  <th>Acciones:</th>
               </thead>
               <tbody>
                     @foreach ($documents as $d)
                        @if($d->state == 'enable')
                           <tr>
                              <td>
                                 {{$d->name}}
                              </td>
                              <td>{{$d->created_at->format('d-m-Y')}}</td>
                              <td>{{$d->format}}</td>
                              <td><a data-toggle="tooltip" data-placement="top" title="Descargar Docuemnto" href="{{route('documentsDonwload',$d->id)}}" class="btn btn-default"><i class="fa fa-download" aria-hidden="true"></i></a>
                              @if(Auth::user()->role == 'Administrador')
                                 <a href="{{route('documentDelete',$d->id)}}" onclick="return confirm('¿Esta Segur@ de Eliminar este Documento?')" class="btn btn-danger"><i class="far fa-times-circle"></i></a>


                              @endif
                              </td>
                           </tr>
                        @endif
                  @endforeach
               </tbody>

            </table>
      </div>
      <div class="panel-footer">
         {{ $documents->links() }}
      </div>
   </div>


@endsection

@section('scriptpersonal')
   <script type="text/javascript">


   function documentDestroy(device_id){
      $('#dDestroy').val(device_id);
   }
   </script>
@show
