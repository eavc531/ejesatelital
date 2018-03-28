<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>
   <h2>Notificación Eje Satelital</h2>
   <div class="max-width:700px">
      <p style=" text-align: justify;
       text-justify: inter-word;">El Usuario: <strong>{{Auth::user()->name}}</strong> a agregado a un Nuevo Cliente con el Nombre de: <strong>{{$request->name}}</strong> y Cedula: <strong>{{$request->idNumber}}</strong> en la fecha: <strong>{{\Carbon\Carbon::now()->format('m-d-Y')}}</strong></p>


   </div>
</body>
</html>
