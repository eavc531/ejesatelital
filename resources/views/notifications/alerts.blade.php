@if(Session::Has('success'))

      <div class="alert alert-success alert-dismissible" role="alert" style="max-width:700px">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         {{Session::get('success')}}
      </div>


   @endif

   @if(Session::Has('warning'))

         <div class="alert alert-warning alert-dismissible" role="alert" style="max-width:700px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('warning')}}
         </div>

      @endif

   @if(Session::Has('danger'))

         <div class="alert alert-danger alert-dismissible" role="alert" style="max-width:700px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('danger')}}
         </div>

      @endif

   @if (count($errors) > 0)

         <div class="alert alert-warning" style="max-width:700px">
             {{ trans('adminlte_lang::message.someproblems') }}<br>
             <button type="button" name="button" class="close" data-dismiss="alert">
                &times;
             </button>
             <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
             </ul>
         </div>

  @endif

  <div id="alert-success" class="alert alert-warning alert-dismissible fade show" role="alert" style="display:none">
     <strong>ERROR: </strong><span id="text-error-e"></span>
 </div>

 <div id="msg-success" class="alert alert-success alert-dismissible" role="alert" style="display:none;max-width:700px" >
    <button type="button" name="button" class="close" onclick="cerrar()">
      &times;
   </button>
    <span id="msg-send">dfdfs</span>
</div>

<div id="msg-success2" class="alert" role="alert" style="display:none;max-width:700px;color:white;background:rgb(12, 80, 182);">
   <button type="button" name="button" class="close" onclick="cerrar()">
     &times;
  </button>
   <span id="msg-send2">dfdfs</span>
</div>
