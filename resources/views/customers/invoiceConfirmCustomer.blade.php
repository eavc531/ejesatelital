@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Confirmar Pago de Factura: {{str_pad($invoice->number, 3, "0", STR_PAD_LEFT)}}
@endsection

@section('contentheader_title')
   Confirmar Pago de Factura: {{str_pad($invoice->number, 3, "0", STR_PAD_LEFT)}}
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('invoiceDetails',$invoice->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection

@section('main-content')

   <div class="panel" style="max-width:700px;margin: 0 auto">

      <div class="panel-heading bg-primary">
         <strong>Confirmar Pago de Factura: {{str_pad($invoice->number, 3, "0", STR_PAD_LEFT)}}</strong>
      </div>

      <div class="panel-body" style="padding:40px">

            {!!Form::open(['route'=>['invoiceConfirmCustomer'], 'method'=>'POST'])!!}
            <label for="medioPayment"> <strong>Medio de Pago:</strong></label>
            {!!Form::text('medioPayment',null,['class'=>'form-control','placeholder'=>'Ejemplo: Transferencia, Deposito, etc...', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}



         <div  style="margin-top:20px">
            <label for="dateConfirmPayment"> <strong>Fecha del Pago:</strong></label>
            {!!Form::date('dateConfirmPayment',\Carbon\Carbon::now(),   ['class'=>'form-control','style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
         </div>

         <label for="Banco" style="margin-top:20px"> <strong>Banco: (Opcional)</strong></label>
         {!!Form::text('Banco',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

         <label for="NroReferencia" style="margin-top:20px"> <strong>Nro. de Referencia (Opcional)</strong></label>
         {!!Form::text('nroReferencia',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}


         <label for="msg" style="margin-top:20px"> <strong>Mensaje: (Opcional)</strong></label>
         {!!Form::textarea('mensaje',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;height:130px'])!!}

         {!!Form::hidden('invoice_id',$invoice->id)!!}
         {!!Form::hidden('invoiceperiod',$invoice->invoiceperiod)!!}
            {!!Form::hidden('customer_id',$invoice->customer_id)!!}
         <div class="form-group" style="margin-top:40px">
            {!!Form::submit('Enviar Confirmacion de Pago',['class'=>'btn btn-primary','style'=>'"margin-top:40px;font-weight:bold'])!!}
            <a style="margin-top:0px"class="btn btn-default" href="{{route('invoiceDetails',$invoice->id)}}"><strong>Cancelar</strong>
            </a>
         </div>

         {!!Form::close()!!}

      </div>

</div>


@endsection
