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
       text-justify: inter-word;">El Usuario: <strong><?php echo e(Auth::user()->name); ?></strong> a agregado a un Nuevo Cliente con el Nombre de: <strong><?php echo e($request->name); ?></strong> y Cedula: <strong><?php echo e($request->idNumber); ?></strong> en la fecha: <strong><?php echo e(\Carbon\Carbon::now()->format('m-d-Y')); ?></strong></p>


   </div>
</body>
</html>
