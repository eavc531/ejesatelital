
<!-- Modal -->
<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="color:white;background:rgb(23, 94, 159)">
       <h5 class="modal-title" id="exampleModalLabel"> <strong>Confirmar el Pago de Factura: <?php echo e(str_pad($invoices->number, 3, "0", STR_PAD_LEFT)); ?></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <?php if(isset($mConfirm->dateConfirmPayment)): ?>
             <input type="hidden" name="" value="<?php echo e($dateConfirmPaymenthidden = \Carbon\Carbon::parse($mConfirm->dateConfirmPayment)); ?>">
         <?php else: ?>
             <input type="hidden" name="" value="<?php echo e($dateConfirmPaymenthidden = \Carbon\Carbon::now()); ?>">
          <?php endif; ?>
         <?php echo Form::open(['route'=>['invoicesConfirm',$invoices->id],'method'=>'post']); ?>

         <label for="medioPayment">Medio de Pago:</label>
         <?php if(isset($mConfirm->medioPayment)): ?>
             <?php echo Form::text('medioPayment',$mConfirm->medioPayment,['id'=>'medioPayment','class'=>'form-control']); ?>

          <?php else: ?>
             <?php echo Form::text('medioPayment',null,['id'=>'medioPayment','class'=>'form-control']); ?>

          <?php endif; ?>
       <div class="form-group">

          <label for="">Fecha</label>
           <?php echo Form::date('dateConfirmPayment',$dateConfirmPaymenthidden,['class'=>'form-control','placeholder'=>'Opcional']); ?>

           <div style="margin-top:30px" class="modal-footer">
             <?php echo Form::submit('Marcar Factura Como Pagada',['class'=>'btn btn-success']); ?>

             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
             <?php echo Form::close(); ?>

           </div>

       </div>
      </div>

    </div>
  </div>
</div>
