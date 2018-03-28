Periodo de Facturacion: Mes de:
   <input type="hidden" name="" value="{{$month = \Carbon\Carbon::now()->addMonth(1)->format('m')}}">
   {!!Form::select('monthPeriod',['1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','7'=>'Julio','8'=>'Agosto','9'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre',],$month,['id'=>'monthPeriod'])!!} del: {!!Form::number('yearPeriod',$today->addMonth()->format('Y'),['style'=>'width:60px','id'=>'yearPeriod'])!!}


   DB::table('users')->insert([
    'name'=>'Franco Ramirez',
    'email'=>'Franco@admin.com',
    'password'=>bcrypt('1234'),
    'role'=>'Vendedor',
    ]);
    DB::table('users')->insert([
    'name'=>'Hector Hernandez',
    'email'=>'HH@admin.com',
    'password'=>bcrypt('1234'),
    'role'=>'Vendedor',
    ]);
    DB::table('users')->insert([
    'name'=>'Victoria Hernandez',
    'email'=>'Victoria@admin.com',
    'password'=>bcrypt('1234'),
    'role'=>'Vendedor',
    ]);
    DB::table('users')->insert([
    'name'=>'Camila Ferrer',
    'email'=>'cami@admin.com',
    'password'=>bcrypt('1234'),
    'role'=>'Vendedor',
    ]);


    DB::table('customers')->insert([
    'name'=>'Estefania Delgado',
    'idNumber'=>19611870,
    'address'=>'Barrio el Cambio',
    'phone1'=>042665250,
    'phone2'=>042675250,
    'email'=>'estefania@hotmail.com',
    'city'=>'Barinas',
    'role'=>'Cliente',
    'password'=>bcrypt('1234'),
    'seller_id'=>6,
    ]);

    DB::table('customers')->insert([
    'name'=>'Maria Delgado',
    'idNumber'=>19611123,
    'address'=>'Barrio Juan Pablo',
    'phone1'=>042665250,
    'phone2'=>042675250,
    'email'=>'MariaD@hotmail.com',
    'city'=>'Barinas',
    'role'=>'Cliente',
    'password'=>bcrypt('1234'),
    'seller_id'=>6,
    ]);

    DB::table('customers')->insert([
    'name'=>'Juan Landaeta',
    'idNumber'=>19611456,
    'address'=>'Hurb. el Placer',
    'phone1'=>042665250,
    'phone2'=>042675250,
    'email'=>'Juan@hotmail.com',
    'city'=>'Barinas',
    'role'=>'Cliente',
    'password'=>bcrypt('1234'),
    'seller_id'=>6,
    ]);

    DB::table('customers')->insert([
    'name'=>'Marco solis',
    'idNumber'=>19911678,
    'address'=>'Barrio el Cambio',
    'phone1'=>042665250,
    'phone2'=>042675250,
    'email'=>'Marco@hotmail.com',
    'city'=>'Barinas',
    'role'=>'Cliente',
    'password'=>bcrypt('1234'),
    'seller_id'=>6,
    ]);

    DB::table('customers')->insert([
    'name'=>'Esteban Delgado',
    'idNumber'=>12311870,
    'address'=>'Hurb. cuatricentenaria',
    'phone1'=>042665250,
    'phone2'=>042675250,
    'email'=>'Esteb@hotmail.com',
    'city'=>'Barinas',
    'role'=>'Cliente',
    'password'=>bcrypt('1234'),
    'seller_id'=>6,
    ]);



    DB::table('services')->insert([
    'name'=>'Vigilancia Satelital',
    'description'=>'vigilancia via satelite',
    'payment'=>'12000'
    ]);
    DB::table('services')->insert([
    'name'=>'Vigilancia de Camiones',
    'description'=>'',
    'payment'=>'22000'
    ]);
    DB::table('services')->insert([
    'name'=>'Vigilancia de Motos',
    'description'=>'',
    'payment'=>'8000'
    ]);
   }
