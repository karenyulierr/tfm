@extends('layouts.header')

@section('styles')
<link rel="stylesheet" href="css/detail_plans.css">
<link rel="stylesheet" href="css/botonWhatsapp.css">
@endsection

@section('contendido')
<div class="detail_planes">
    <div class="row detail_planes_title">
        <div class="img_title">
            <img src="{{asset('soportes/img_main/'. $plan_info[0]->main_image )}}" alt="" class="img-fluid">
            <span>{{ $plan_info[0]->name }}</span>
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
        @if(count($getImagesPlan)>0)
        <div class="row fila1">
            <div class=" col-4 image1">
                <img class="img-fluid" src="{{asset('soportes/img_plan/'. $getImagesPlan[0]->name )}}" alt="">
            </div>
            <div class="fila1 col-8 image2">
                <img class="img-fluid" src="{{asset('soportes/img_plan/'. $getImagesPlan[1]->name )}}" alt="">
            </div>
        </div>
        <br>
        <div class="row fila2">
            <div class=" col-4 image1">
                <img class="img-fluid" src="{{asset('soportes/img_plan/'. $getImagesPlan[2]->name )}}" alt="">
            </div>
            <div class=" col-4 image2">
                <img class="img-fluid" src="{{asset('soportes/img_plan/'. $getImagesPlan[3]->name )}}" alt="">
            </div>
            <div class=" col-4 image3">
                <img class="img-fluid" src="{{asset('soportes/img_plan/'. $getImagesPlan[4]->name )}}" alt="">
            </div>
        </div>
        <br>
        <div class="row fila3">
            <div class=" col-4 image1">
                <img class="img-fluid" src="{{asset('soportes/img_plan/'. $getImagesPlan[5]->name )}}" alt="">
            </div>
            <div class="col-8 image2">
                <img class="img-fluid" src="{{asset('soportes/img_plan/'. $getImagesPlan[6]->name )}}" alt="">
            </div>
        </div>
        <br><br>
        <a href="#" class="ver_fotos" data-toggle="modal" data-target="#exampleModal">Ver todas las fotos</a>
        <br><br>
        <hr>
        @else
        <p class="no_service">No se han agregado imagenes</p>
        @endif
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$plan_info[0]->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @forelse($getImagesTotalPlan as $keys => $images)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $keys}}" class="active"></li>
                                @empty
                                @endforelse
                            </ol>
                            <div class="carousel-inner">
                                @forelse($getImagesTotalPlan as $keys => $images)
                                <div class="carousel-item  @if($keys==0)active @endif">
                                    <img class="img-fluid" src="{{asset('soportes/img_plan/'. $images->name )}}" class="d-block w-100" alt="...">

                                </div>
                                @empty

                                @endforelse
                            </div>

                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <br><br>
    <div class="description_detail_plans">
        <div class="deatil_description">
            <div>
                <img src="img/descripcion.png" alt="">
                <span class="descrip_plan_turi ml-3">Descripción del plan turustico</span>
            </div>

            <p class=" texto_detail_turismo ml-5">plan_info{{ $plan_info[0]->description }}</p>
            {{-- <a href="#" class="ver_fotos ml-5">Ver más</a> --}}
        </div>
        <div class="valor_detail">
            <span class="valor mr-5">Valor</span> <span class="value">$ {{ $plan_info[0]->value }}</span>
        </div>
    </div>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=+573143960806&text=Hola, te estas comunicando con TuriApp, Escríbenos y en pocos minutos respondemos todas tu dudas." class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>
</div>

@endsection

@section('script')

@endsection
