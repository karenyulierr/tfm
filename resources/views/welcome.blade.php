<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
    <title>TuriApp
    </title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/welcome.css">
    <link rel="stylesheet" href="css/contenido_welcome.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-1">

            <a href="/" class="nav-link">
                {{-- <span class="turi">turi</span><span class="app">app</span> --}}
                <img src="img/logo_welcome.png" alt="" class="img-fluid">
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
                            @foreach($category as $key => $value)
                            <a class="dropdown-item" href="/categoryview?category_id={{ $value->id }}">{{ $value->name }}</a>
                            @endforeach

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
                            Iniciar sesión <img src="img/iniciar_sesion.svg" alt="CoolBrand" class="img-fluid">
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
            <p class="text">rincón de nuestros paisajes</p>
        </div>
    </header>



    <main class="contenido_welcome">
        <div class="color_gris">
            <div>
                <br><br><br>
                <br><br><br>
                <p class="primer">Te una experiencia </p>
                <p class="segundo">Única con nuestros destinos </p>
            </div>

            <div class=" card card_principal">
                <div class="row centar_card">
                    <div class="col-sm-12 col-md-4 mb-4">
                        <div class=" card card_content">
                            <img src="{{asset('soportes/img_main/'. $getReviews[0]->main_image )}}" class="img-fluid">
                            <div class="card-img-overlay card-bajar">
                                <div class=" text_card">
                                    <img src="{{asset('soportes/img_main/'. $getReviews[0]->main_image )}}" class="card-img-top img-fluid">
                                    <br>
                                    <p class="title"> {{ $getReviews[0]->name}}</p>
                                    <P> {{
                                            substr($getReviews[0]->description, 0, 40).'...'
                                                }}</P>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-4">
                        <div class=" card card_content">
                            <img src="{{asset('soportes/img_main/'. $getReviews[1]->main_image )}}" class="img-fluid">
                            <div class="card-img-overlay card-bajar">
                                <div class=" text_card">
                                    <img src="{{asset('soportes/img_main/'. $getReviews[1]->main_image )}}" class="card-img-top img-fluid">
                                    <br>
                                    <p class="title"> {{ $getReviews[1]->name}}</p>
                                    <P> {{
                                            substr($getReviews[1]->description, 0, 40).'...'
                                                }}</P>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class=" card card_content"> <img src="{{asset('soportes/img_main/'. $getReviews[2]->main_image )}}" class="img-fluid">
                            <div class="card-img-overlay card-bajar">
                                <div class=" text_card">
                                    <img src="{{asset('soportes/img_main/'. $getReviews[2]->main_image )}}" class="card-img-top img-fluid">
                                    <br>
                                    <p class="title"> {{ $getReviews[2]->name}}</p>
                                    <P> {{
                                            substr($getReviews[2]->description, 0, 40).'...'
                                                }}</P>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </div>
        <br><br>
        <div class=" reseñas">
            <div class="row conten_reseñas">
                <div class="col-sm-12 col-md-3 title_reseñas mb-4">
                    <span class="uno">Reseñas de</span>
                    <br>
                    <span class="dos">nuestros viajeros</span>
                </div>
                <div class=" col-sm-12 col-md-3 reseñas_cont">
                    <span class=" ml-3 avantar">{{ucfirst(substr($getReviews[0]->name_person,0,1)) }}</span>
                    <br>
                    <span class="name">{{ $getReviews[0]->name_person}}</span>
                    <br>
                    <span class="sitio">{{ $getReviews[0]->name}}</span>
                    <br>
                    <span class="resena_text">{{ substr($getReviews[0]->description, 0, 300).'...' }}</span>
                    <br>
                    <br>
                    {{-- <a href="#" class="ver_fotos">Ver más</a> --}}
                </div>
                <div class=" col-sm-12 col-md-3 reseñas_cont mb-4">
                    <span class=" ml-3 avantar">{{ucfirst(substr($getReviews[1]->name_person,0,1)) }}</span>
                    <br>
                    <span class="name">{{ $getReviews[1]->name_person}}</span>
                    <br>
                    <span class="sitio">{{ $getReviews[1]->name}}</span>
                    <br>
                    <span class="resena_text">{{ substr($getReviews[1]->description, 0, 300).'...' }}</span>
                    <br>
                    <br>
                    {{-- <a href="#" class="ver_fotos">Ver más</a> --}}
                </div>
                <div class=" col-sm-12 col-md-3 reseñas_cont mb-4">
                    <span class=" ml-3 avantar">{{ucfirst(substr($getReviews[2]->name_person,0,1)) }}</span>
                    <br>
                    <span class="name">{{ $getReviews[2]->name_person}}</span>
                    <br>
                    <span class="sitio">{{ $getReviews[2]->name}}</span>
                    <br>
                    <span class="resena_text">{{ substr($getReviews[2]->description, 0, 300).'...' }}</span>
                    <br>
                    <br>
                    {{-- <a href="#" class="ver_fotos">Ver más</a> --}}
                </div>
            </div>
        </div>
        <div class="color_gris">
            <div class="imagenes">
                <div class="text_images">
                    <br><br><br>
                    <span class="image_uno">Lo mejor del momento</span>
                    <br>
                    <span class="image_dos">Destinos destacados</span>

                </div>
                <div class="content_imagenes">
                    <div class="row">
                        <div class="col-9 image_1 mb-4">
                            <img class="img-fluid" src="{{asset('soportes/img_main/'. $getImagesWelcome[0]->main_image )}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-3 image_2">
                            <img class="img-fluid" src="{{asset('soportes/img_main/'. $getImagesWelcome[1]->main_image )}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-2 image_3">
                            <img class="img-fluid" src="{{asset('soportes/img_main/'. $getImagesWelcome[2]->main_image )}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-2 image_3">
                            <img class="img-fluid" src="{{asset('soportes/img_main/'. $getImagesWelcome[3]->main_image )}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-2 image_3">
                            <img class="img-fluid" src="{{asset('soportes/img_main/'. $getImagesWelcome[4]->main_image )}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-2 image_3">
                            <img class="img-fluid" src="{{asset('soportes/img_main/'. $getImagesWelcome[5]->main_image )}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-2 image_3">
                            <img class="img-fluid" src="{{asset('soportes/img_main/'. $getImagesWelcome[6]->main_image )}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-2 image_3">
                            <img class="img-fluid" src="{{asset('soportes/img_main/'. $getImagesWelcome[7]->main_image )}}" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
        </div>
    </main>
    @include('layouts.footer')


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="js/welcome.js"></script>


</body>
</html>
