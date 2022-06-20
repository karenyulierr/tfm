<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <title> {{ config('app.name', 'TURIAPP') }} </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!-- Fonts and icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });

    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
    <style>
        .turi {
            color: #00d6c9;
            font-style: normal;
            font-weight: 800;
            font-size: 35px;
            /* line-height: 35px; */
            /* letter-spacing: 0.01em; */
            text-transform: uppercase;
        }
        .app {
            color: #fff;
            font-style: normal;
            font-weight: 800;
            font-size: 35px;
            /* line-height: 35px; */
            /* letter-spacing: 0.01em; */
            text-transform: uppercase;
        }
        .navbar{
            color: white !important;
            background: linear-gradient(180deg, #2B2A2A 0%, rgba(32, 32, 32, 0.760417) 100%);
        }
        .clr-font{
            color: white !important;
        }
    </style>
</head>

<body>
<div class="wrapper">
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" style="background: linear-gradient(180deg, #2B2A2A 0%, rgba(32, 32, 32, 0.760417) 100%);">

            <a href="/home" class="logo">
                <img src="{{ asset('img/logo_welcome.png') }}" >
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg">

            <div class="container-fluid">

                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center clr-font">

                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="{{ asset('img/user.png') }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img src="{{ asset('img/user.png') }}" alt="image profile" class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4>{{ Auth::user()->name }}</h4>
                                            <p class="text-muted">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        {{ csrf_field() }}
                                        <button class="dropdown-item" type="submit">
                                            Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>
    <div class="sidebar sidebar-style-2" id="sidebar_left" style="background: #2B2A2A; color: white !important;">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-primary clr-font">

                    @canany('Ver administración')
                        <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fas fa-layer-group clr-font" ></i>
                        </span>
                            <h4 class="text-section clr-font" >Administración</h4>
                        </li>
                        <li class="nav-item clr-font" >
                        @can('Gestión roles')
                            <li class="nav-item">
                                <a href="/user">
                                    <i class="fas fa-user clr-font"></i>
                                    <span class="clr-font" >Usuarios</span>
                                </a>
                            </li>
                        @endcan
                        @can('Gestión usuarios')
                            <li class="nav-item">
                                <a href="/roles">
                                    <i class="fas fa-key clr-font"></i>
                                    <span class="clr-font">Roles</span>
                                </a>
                            </li>
                            @endcan
                        </li>
                    @endcanany
                        <hr style="background-color: whitesmoke">
                        @can('Ver categorias')

                            <li class="nav-item">
                                <a href="/category" >
                                    <i class="fas fa-layer-group clr-font"></i>
                                    <span class="clr-font">Categorias</span>
                                </a>
                            </li>
                        @endcan
                        @can('Ver servicios')
                            <li class="nav-item">
                                <a href="/service" >
                                    <i class="fas fa-list clr-font" ></i>
                                    <span class="clr-font">Servicios</span>
                                </a>
                            </li>
                        @endcan
                        @can('Ver sitios turísticos')
                            <li class="nav-item">
                                <a href="/home" >
                                    <i class="fa  fa-map-pin clr-font"></i>
                                    <span class="clr-font">Sitios turísticos</span>
                                </a>
                            </li>
                        @endcan
                        @can('Ver planes turísticos')
                            <li class="nav-item">
                                <a href="/" >
                                    <i class="fas fa-route clr-font"></i>
                                    <span class="clr-font">Planes turísticos</span>
                                </a>
                            </li>
                        @endcan

                </ul>
            </div>
        </div>
    </div>

    @yield('content')
</div>

<script>
    @auth
        window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
    @else
        window.Permissions = [];
    @endauth
</script>

<!--   Core JS Files   -->
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('leaflet/leaflet.js') }}"></script>

<script src="{{ asset('vendors/bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/bootstrap-fileinput/js/plugins/purify.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/bootstrap-fileinput/themes/fas/theme.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/bootstrap-fileinput/js/locales/es.js') }}" type="text/javascript"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<!-- Atlantis JS -->
<script src="{{ asset('js/atlantis.min.js') }}"></script>

@yield('js')

</body>
</html>
