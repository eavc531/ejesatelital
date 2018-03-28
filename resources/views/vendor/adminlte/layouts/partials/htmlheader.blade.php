<head>
    <meta charset="UTF-8">
    <title>@yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Assistant|Noticia+Text|Patua+One|Vidaloka|Vollkorn" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Adamina|Assistant|Noticia+Text|Patua+One|Vidaloka|Vollkorn" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <style media="screen">
       body{
          font-size: 15px;
          font-family: 'Patua One', cursive;
            font-family: 'Vollkorn', serif;
            font-family: 'Noticia Text', serif;
            font-family: 'Vidaloka', serif;
            font-family: 'Assistant', sans-serif;


          color:rgb(42, 42, 42);
       }

       h1{

          font-family: 'Patua One', cursive;
         font-family: 'Vollkorn', serif;
         font-family: 'Noticia Text', serif;
         font-family: 'Vidaloka', serif;
         font-family: 'Assistant', sans-serif;
         font-family: 'Adamina', serif;

       }

       #logo{
          border-radius: 15px;
       }

     .table-striped>tbody>tr:nth-child(odd)>td,
     .table-striped>tbody>tr:nth-child(odd)>th {
      background-color: rgba(226, 246, 255, 0.32);
     }


    </style>
    @yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>

        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
</head>
