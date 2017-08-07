<header>
        <!-- Sidebar navigation -->
        <ul id="slide-out" class="side-nav fixed sn-bg-1 custom-scrollbar">

            <!-- Logo -->
            <li>
                <div class="logo-wrapper sn-ad-avatar-wrapper">
                    <img src="{{ asset('img/avatar/'.$user->foto.'.png') }}" class="img-fluid rounded-circle">
                    <div class="rgba-stylish-strong">
                        <p class="user black-text">{{$user->nombre}} {{$user->apellidos}}</p>
                    </div>
                </div>
            </li>
            <!--/. Logo -->
            <br>
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="waves-effect" href="{{ route('perfil') }}">
                            <i class="fa fa-user"></i> Mi perfil
                        </a>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-list-ul"></i>Inventario<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('productos') }}" class="waves-effect">Productos</a>
                                </li>
                                <li><a href="{{ route('servicios') }}" class="waves-effect">Servicios</a>
                                </li>
                                <li><a href="{{ route('paquetes') }}" class="waves-effect">Paquetes</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-gear"></i>Administración<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('reportes') }}" class="waves-effect">Reportes</a>
                                </li>
                                <li><a href="{{ route('pagos') }}" class="waves-effect">Solicitud de pagos</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-envelope"></i>Comunicación<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('notificaciones') }}" class="waves-effect">Notificaciones</a>
                                </li>
                                <li><a href="{{ route('comentarios') }}" class="waves-effect">Comentarios</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <!--/. Side navigation links -->
            <div class="sidenav-bg mask-strong"></div>
        </ul>
        <!--/. Sidebar navigation -->

        <!--Navbar-->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar double-nav">

            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            </div>

            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                <p>Portal de proveedor</p>
            </div>

            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item">
                    <a class="nav-link"> <span class="badge red z-depth-1">2</span> <i class="fa fa-envelope"></i> <span class="hidden-sm-down">Notificaciones</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> <span class="hidden-sm-down">{{$user->nombre}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesi&oacute;n</a>
                        <a class="dropdown-item" href="#">Mi perfil</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!--/.Navbar-->
    </header>