<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TuriApp
    </title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/welcome.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-1">

            <a href="/" class="nav-link">
                {{-- <span class="turi">turi</span><span class="app">app</span> --}}
                <img src="img/logo_welcome.png" alt="">
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
                    </li>
                    @else
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false" style="color: #fff;  font-weight: 500;   font-size: 20px;">
                            Categorias
                        </a>


                        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Fincas</a>
                            <a class="dropdown-item" href="#">Termales</a>
                            <a class="dropdown-item" href="#">Miradores</a>
                            <a class="dropdown-item" href="#">Hoteles</a>
                            <a class="dropdown-item" href="#">Restaurantes</a>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a style="color: #fff;  font-weight: 500;font-size: 20px;" class="nav-link" href="/meet_rivera">Conoce a Rivera</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #fff;  font-weight: 500;font-size: 20px;" class="nav-link" href="/tourist_plans">Planes turísticos</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: #fff;  font-weight: 500;font-size: 20px;" class="nav-link" href="/contact">Contactanos</a>
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
        <div class="textos">
            <p class="lugares">Lugares</p>
            <p class="que_enamoran">Que Enamoran</p>
            <p class="text">Explora la magia y la belleza que ofrecen cada</p>
            <p class="text">rincon de nuestros paisajes</p>
        </div>
    </header>

    <main>

    </main>
    @include('layouts.footer')


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="js/welcome.js"></script>


</body>
</html>
