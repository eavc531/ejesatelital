

<!-- Modal -->
<div class="modal fade" id="alertinvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="color:white;background:rgb(16, 72, 198)">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Exito</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Factura Generada Correctamente.
      </div>
      <div class="modal-footer">

        <a class="btn btn-primary"href="<?php echo e(route('invoiceOccasionalPreview',$customer->id)); ?>">Aceptar</a>

      </div>
    </div>
  </div>
</div>

<!--alert2-->
<div class="modal fade" id="alertinvoice2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"style="color:white;background:rgb(235, 53, 41)">
        <h4 class="modal-title" id="exampleModalLabel"><strong>Atencion</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p id="ti2"></p>
      </div>
      <div class="modal-footer">

         <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>

      </div>
    </div>
  </div>
</div>

<!--alert3-->
<div class="modal fade" id="alertinvoice3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"style="color:white;background:rgb(45, 96, 214)">
        <h4 class="modal-title" id="exampleModalLabel"><strong>Atencion</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p id="ti3"></p>
      </div>
      <div class="modal-footer">

         <a href="<?php echo e(route('confirmCreateInvoice')); ?>" class="btn btn-primary">Aceptar</a>
         <a href="<?php echo e(route('cancelCreateInvoice')); ?>" class="btn btn-default">Cancelar</a>
      </div>
    </div>
  </div>
</div>

<!--alert4-->
<div class="modal fade" id="alertinvoice4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"style="color:white;background:rgb(233, 182, 51)">
        <h4 class="modal-title" id="exampleModalLabel"><strong>Atencion</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <strong>Debe seleccionar La Cantidad de meses (Periodos desde la Fecha de Inicio) correspondientes a la Factura.</strong>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>

      </div>
    </div>
  </div>
</div>
