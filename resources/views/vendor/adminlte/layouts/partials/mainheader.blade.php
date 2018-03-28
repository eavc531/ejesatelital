<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="http://login.ejesatelital.com/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">E.S.</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img id="logo" src="{{asset('img/eje.png')}}" alt="" width="200px" height="35px" style="margin-left:-10px;border-radius:2;padding:1px;margin-top:2px"></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="" class="btn btn-primary btn-lg" style="margin-top:5px"data-toggle="offcanvas" role="button">
          <i class="fas fa-arrows-alt-h"></i>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Tasks Menu -->

                @if (Auth::guest())

                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                    <!-- User Account Menu -->
                    <li><form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="submit" value="logout" style="display: none;">
                    </form>
                     </li>
                    <li class="dropdown user user-menu" id="user_menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>

                    </li>
                    <li>
                       <a href="{{ url('/logout') }}" class="link" id="logout">
                           salir
                       </a>
                    </li>
                @endif

                <!-- Control Sidebar Toggle Button -->
                <li>

                </li>
            </ul>
        </div>
    </nav>
</header>
