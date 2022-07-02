<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TuriApp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css">
    @yield('styles')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-1">

            <a href="/" class="nav-link">
                <span class="turi">turi</span><span class="app">app</span>
            </a>

            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-navicon"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        @if (Route::has('login'))

                        @auth
                        <a class="nav-link" href="{{ url('#') }}">Inicio</a>
                    </li>
                    @else
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false" style="color: #fff;  font-weight: 500;   font-size: 20px;">
                            Categorias
                        </a>


                        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                            @foreach($category as $key => $value)
                            <a class="dropdown-item"  href="/categoryview?category_id={{ $value->id }}">{{ $value->name }}</a>
                            @endforeach
                            {{-- <a class="dropdown-item" href="#">Fincas</a>
                            <a class="dropdown-item" href="#">Termales</a>
                            <a class="dropdown-item" href="#">Miradores</a>
                            <a class="dropdown-item" href="#">Hoteles</a>
                            <a class="dropdown-item" href="#">Restaurantes</a> --}}

                        </div>
                    </li>
                    <li class="nav-item">
                        <a style="color: #fff;  font-weight: 500;font-size: 20px;" class="nav-link" href="/meet_rivera">Conoce a Rivera</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #fff;  font-weight: 500;font-size: 20px;" class="nav-link" href="/tourist_plans">Planes turísticos</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #fff;  font-weight: 500;font-size: 20px;" class="nav-link" href="/contact">Contáctanos</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link" style="color: #fff;  font-weight: 500;font-size: 20px;">
                            Iniciar sesión <img src="img/iniciar_sesion.svg" alt="CoolBrand">
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    </li> --}}
                </ul>
                {{-- @endif --}}
                @endif
                @endauth

            </div>
        </nav>

    </header>

    @yield('contendido')

    @include('layouts.footer')


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    @yield('script')
</body>
</html>
