<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>

            <!-- Optionally, you can add icons to the links -->
            <li class=""><a href="{{route('home')}}"><i style="margin-right:15px" class="fa fa-home" aria-hidden="true"></i><span>Inicio</span></a></li>
            @if (Auth::user()->role == 'Cliente')
               <li class="active"><a href="{{route('customersDetails',Auth::user()->customer_id)}}"><i style="margin-right:10px" class="far fa-user"></i><span>Mi Cuenta</span></a></li>
               <li class=""><a href="{{route('contact')}}"><i class="far fa-envelope"></i> <span>Contacto</span></a></li>
            @endif

            @if(Auth::user()->role != 'Cliente')
               <li class=""><a href="{{route('customers.index')}}"><i style="margin-right:10px" class="fa fa-users" aria-hidden="true"></i> <span>Clientes</span></a></li>
            @endif

            @if(Auth::user()->role == 'Administrador')
            <li class="treeview">

              <li><a href="{{route('users.index')}}"><i style="margin-right:15px" class="fa fa-user" aria-hidden="true"></i>Usuarios</a></li>
              <li><a href="{{route('services.index')}}"><i style="margin-right:15px" class="fa fa-wrench" aria-hidden="true"></i>Servicios</a></li>

         @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
