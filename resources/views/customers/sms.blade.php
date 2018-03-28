@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Enviar mensaje a:{{$customer->name}}
@endsection

@section('contentheader_title')
   Enviar mensaje a:{{$customer->name}}
@endsection

@section('contentheader-button')
   <a style="margin-bottom:30px"class="btn btn-default" href="{{route('customersDetails',$customer->id)}}"><i class="fa fa-backward" aria-hidden="true"></i><strong>Atras</strong>
   </a>
@endsection


@section('main-content')
   <div class="panel" style="max-width:400px">
      <div class="panel-heading bg-primary">
         <strong>Enviar Mensaje</strong>
      </div>
      <div class="panel-body">
         <div class="form-group">
            <label for="">Numero:</label>
            <select class="form-control" name="" id="number" required>
               <option value="" disabled selected>Selecciona un Numero Teléfonico:</option>
               <option value="{{$customer->phone1}}">{{$customer->phone1}}</option>
               <option value="{{$customer->phone2}}">{{$customer->phone2}}</option>
            </select>
         </div>


        <label for="">Mensaje:</label>
        <div class="form-group">
           <textarea id="message" name="name" rows="8" cols="80" class="form-control" required></textarea>
        </div>

        <button onclick="sendSms()">Enviar</button>
      </div>
   </div>


@endsection

@section('scriptpersonal')
   <script type="text/javascript">
      function sendSms(){
        var number = $('#number').val();
        var message = $('#message').val();
        route = "http://138.128.162.82:8081//mensaje/envia.php?user=juanks&password=juanks&text="+message+"&to="+number;

        window.location.replace(route);
        // setTimeout( window.location.replace('www.google.com'), 3000);
      }

   </script>
@show
