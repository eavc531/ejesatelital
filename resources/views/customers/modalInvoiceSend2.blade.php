<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="color:white;background:rgb(44, 97, 176)">
        <span style="font-size:20px"id="exampleModalLabel">Enviar Factura a: {{$invoices->nameCustomer}}</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         {!!Form::open(['route'=>'invoiceSends','method'=>'post'])!!}
         <div class="form-group">
            <label for=""><strong>Correo:</strong></label>
             {!!Form::email('email',$invoices->customer->email,['class'=>'form-control' ])!!}
         </div>
         <div class="form-group">
             {!!Form::text('message',null,['class'=>'form-control','placeholder'=>'Ingrese Un Mensaje Adicional'])!!}
         </div>
            {!!Form::hidden('invoice_id',$invoices->id)!!}
           {!!Form::submit('Enviar',['class'=>'btn btn-success'])!!}
           {!!Form::close()!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>


      </div>
    </div>
  </div>
</div>
