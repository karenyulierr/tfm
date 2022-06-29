@extends('layouts.header')

@section('styles')
<link rel="stylesheet" href="css/detail_plans.css">
@endsection

@section('contendido')
<div class="detail_planes">
    <div class="row detail_planes_title">
        <div class="img_title">
            <img src="img/planes_1.JPG" alt="">
            <span>la rivera</span>
        </div>
    </div>
    <div class="barra_detail">
        <div class="clasificacion">
            <span class="">
                <label class="estrellas" for="radio1">★</label>
                <label class="estrellas" for="radio2">★</label>
                <label class="estrellas" for="radio3">★</label>
                <label class="estrellas" for="radio4">★</label>
                <label class="estrellas" for="radio5">★</label>
            </span>
            <div>
                <span class="horario">Horario: </span><span class="text_detail_plans">Todos los dias</span>
            </div>
        </div>
    </div>
    <br><br>
    <div class="detail_imagenes">
        <div class="row fila1">
            <div class=" col-4 image1">
                <img class="img-fluid" src="img/planes_2.JPG" alt="">
            </div>
            <div class="fila1 col-8 image2">
                <img class="img-fluid" src="img/planes_3.JPG" alt="">
            </div>
        </div>
        <br>
        <div class="row fila2">
            <div class=" col-4 image1">
                <img class="img-fluid" src="img/planes_4.JPG" alt="">
            </div>
            <div class=" col-4 image2">
                <img class="img-fluid" src="img/planes_1.JPG" alt="">
            </div>
            <div class=" col-4 image3">
                <img class="img-fluid" src="img/planes_2.JPG" alt="">
            </div>
        </div>
        <br>
        <div class="row fila3">
            <div class=" col-4 image1">
                <img class="img-fluid" src="img/planes_3.JPG" alt="">
            </div>
            <div class="col-8 image2">
                <img class="img-fluid" src="img/planes_4.JPG" alt="">
            </div>
        </div>
        <br><br>
        <a href="#" class="ver_fotos">Ver todas las fotos</a>
        <br><br>
        <hr>
    </div>
    <br><br>
    <div class="description_detail_plans">
        <div class="deatil_description">
            <div>
                <img src="img/descripcion.png" alt="">
                <span class="descrip_plan_turi ml-3">Descripción del plan turustico</span>
            </div>

            <p class=" texto_detail_turismo ml-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis commodi adipisci ipsa, eligendi iusto placeat dolorem doloribus facilis exercitationem voluptas, obcaecati molestias vel rerum quas aliquid quam vitae numquam deserunt!</p>
            <a href="#" class="ver_fotos ml-5">Ver más</a>
        </div>
        <div class="valor_detail">
            <span class="valor mr-5">Valor</span> <span class="value">$ 120.000</span>
        </div>
    </div>

</div>

@endsection

@section('script')

@endsection
