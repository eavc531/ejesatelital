@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Factura Ocasional: {{$customer->name}}
@endsection

@section('contentheader_title')
   Factura Ocasional: {{$customer->name}}
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customersDetails',$customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
   <a style="margin-bottom:30px;color:white" href="{{route('customers.index')}}" class="btn btn-primary"><strong>Clientes</strong></a>
@endsection


@section('main-content')

      <div class="panel" style="max-width:800px">
         <div class="panel-heading bg-primary">
            <strong>Añadir Monto</strong>
         </div>
         <div class="panel-body row">
               {!!Form::open(['route'=>['invoiceOccasionalAd',$customer->id], 'method'=>'POST'])!!}
               <div class="col-sm-12 form-inline">
                  {!!Form::label('Servicio:')!!}
                  {!!Form::select('type',['Adicional' =>'Adicional','Descuento' =>'Descuento' ],null,['class'=>'form-control','placeholder'=>'Seleccione una Opcion'])!!}

                  {!!Form::label('Placa:')!!}
                  {!!Form::select('plate',$vehicle,null,['class'=>'form-control','placeholder'=>'Opcional'])!!}

                  {!!Form::label('Monto:')!!}
                  {!!Form::text('payment',null,['class'=>'form-control','placeholder'=>'Precio del Servicio'])!!}
               </div>

               <div class="col-sm-8" style="margin-top:20px">
                  {!!Form::label('Descripción:')!!}
                  {!!Form::text('description',null,['class'=>'form-control','placeholder'=>'Descripción','id'=>'description','style'=>'max-width:600px'])!!}
               </div>

               <div class="col-sm-4" style="margin-top:50px">
                  {!!Form::submit('Agregar',['class'=>'btn btn-primary'])!!}
                  <a class="btn btn-default" href="{{route('invoiceOccasional',$customer->id)}}">Cancelar</a>
                  {!!Form::close()!!}
               </div>

            </div>
         </div>

<!--/////////////////-->
<div class="" style="margin-top:60px">

</div>
   <div class="panel panel-default">
      <div class="panel-heading">
         <strong>Factura Ocasional</strong>

      </div>
      <div class="panel-body">
               <table class="table table-sm">
                  <tr>
                     <th>Fecha de Elaboración:
                        <input type="hidden" name="" value="{{$today = \Carbon\Carbon::now()}}">
                         {!!Form::date('dateIni',$today,['id'=>'dateIni'])!!}
                      </th>
                  </tr>
                  <tr>
                     <input type="hidden" name="" value="{{$paymentTimely = \Carbon\Carbon::now()->addMonth(1)->firstOfMonth()->addDays(4)}}">
                     <th style="color:red">Pago Oportuno Antes de: {!!Form::date('$paymentTimely',$paymentTimely,['id'=>'paymentTimely'])!!}

                     </th>
                  </tr>
               </table>


         <table class="table table-striped table-bordered">
          <thead style="background:rgb(199, 172, 57);color:white">
             <tr>

                 <th class="qty"><strong>Placa:<s/trong></th>
               <th class="service"><strong>Tipo de Servicio:</strong></th>
               <th class="desc"><strong>Descripción:</strong></th>
               <th colspan="2"><strong>VALOR:</strong></th>
             </tr>
          </thead>
          <input type="hidden" name="" value="{{$servicePrice=''}}">
           <input type="hidden" name="" value="{{$sum=0}}">
          <tbody>
             @foreach ($occasionalAd as $o)
                <tr>
                   <td class="unit">{{$o->plate}}</td>
                   <td class="unit">{{$o->type}}</td>
                   <td class="unit">{{$o->description}}</td>

                   @if($o->type == 'Descuento')
                      <td class="unit">- {{$o->payment}}
                        @if(auth::user()->role == 'Administrador')
                        <a href="{{route('deleteAO',$o->id)}}" onclick="return confirm('¿Esta Segur@ de Eliminar este Servicio Adicional de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>
                     </td>
                     @endif

                      <input type="hidden" name="" value="{{$sum-= $o->payment}}">
                   @else

                      <td class="unit">
                        {{$o->payment}}
                        @if(auth::user()->role == 'Administrador')
                        <a href="{{route('deleteAO',$o->id)}}" onclick="return confirm('¿Esta Segur@ de Eliminar este Servicio de la Factura?')" class="pull-right"><span aria-hidden="true" style="color:red">&times;</span></a>


                     </td>
                        @endif
                      <input type="hidden" name="" value="{{$sum+= $o->payment}}">
                   @endif

                   <td></td>
               </tr>
             @endforeach

          </tbody>
          <tfoot>
             <tr>

                <td class="unit"></td>
               <td class="unit"></td>
               <td class="qty" style="text-align:right"><strong>TOTAL:</strong></td>
               <td class="total"><strong>{{$sum}}</strong></td>
             </tr>
          </tfoot>
         </table>

         <div class="pull-right">
            @if(Auth::user()->role == 'Administrador')
               <!-- Button trigger modal -->
               <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal6">
                 <strong>Generar Factura</strong>
               </button>
            @endif
         </div>


        </div>
        <input type="hidden" name="" value="{{$customer->id}}" id="customer_id">
        <input type="hidden" name="" value="{{$sum}}" id="total">

      </div>

   </div>

@include('customers.modalServices')
@include('customers.modalalertcreateinvoice')

@endsection

@section('scriptpersonal')
   <script type="text/javascript">


      function invoiceCreate(){

         $('#exampleModal6').modal('toggle');

         monthPeriod = $('#monthPeriod').val();
         yearPeriod = $('#yearPeriod').val();

         paymentTimely = $('#paymentTimely').val();
         customer_id = $('#customer_id').val();
         total = $('#total').val();
         dateIni = $('#dateIni').val();
         invoiceperiod = monthPeriod + '-' +yearPeriod;



         route = "{{route('invoiceOccasionalStore',$customer->id)}}";
         $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url:route,
            data:{dateIni:dateIni,invoiceperiod:invoiceperiod,paymentTimely:paymentTimely,customer_id:customer_id,total:total},
            error:function(error){
               $.each(error.responseJSON.errors, function(index, val){
               errormsj+='<li>'+val+'</li>';
               });
               $('#text-error-e').html(errormsj);
               $('#alert-error-e').fadeIn();
               console.log(error);
               },
            success:function(result){
               console.log(result);
               if(result.error == 'existe'){
                  $("#ti2").html(result.message);
                  $('#alertinvoice2').modal('toggle');
               }else if(result.error2 == 'FacturaSinConfirmar') {
                  $("#ti3").html(result.msg);
                  $('#alertinvoice3').modal('toggle');

               }else{
                  $('#alertinvoice').modal('toggle');
               }


            }

         });
      }


   </script>
@endsection
