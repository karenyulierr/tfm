@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/login.css">
<!-- CSS only -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

<div class="container">
    <div class="row">
        <div class="volver col-2 text-left">
            <a href="/"><img src="img/volver.svg" alt="Volver"></a>
        </div>
    </div>
    <div class="row">

        <div class=" col-sm-6 col-md-6 col-lg-6 col-xl-6 info_login">
            <div class="card">
                <span class="bienvenido">bienvenido a</span>
                <span class="inicio"> <span class="turi">turi</span><span class="app">app</span></span>
                <br>
                <span class="ingresa_tus_datos">Ingresa tus datos</span>
                <br>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="col-md-12 col-form-label text-md-left color_gris">Correo electrónico: </label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="password" class="col-md-12 col-form-label text-md-left color_gris">Contraseña: </label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!--<div class="text-right">
                        @if (Route::has('password.request'))
                        <a class="text-right color_gris" href="{{ route('password.request') }}">
                            Olvide contraseña?
                        </a>
                        @endif
                    </div>-->
                    <br>
                    <button type="submit" class="btn color_btn  ml-3 shadow">
                        Ingresar
                    </button>
                </form>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 img_login">
            <img class="img-fluid" src="img/img_iniciar_sesion.png" alt="Iglesia de rivera">
        </div>
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="js/login.js"></script>
@endsection
