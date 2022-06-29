@extends('layouts.header')

@section('styles')
<link rel="stylesheet" href="css/categoryviewdetail.css">
@endsection

@section('contendido')
<div class="categoryviewdetail">
    <div class="row detail_planes_title">
        <div class="img_title">
            <img src="{{asset('soportes/img_main/'. $touristSite[0]->main_image )}}" alt="">
            <span>{{ $touristSite[0]->name }}</span>
        </div>
    </div>
    <div class="barra_detail">
        <div class="clasificacion">
            <span class="">
                <label class="estrellas" for="radio1">★</label>
                <label class="horario" for="">4.5</label>
            </span>
        </div>
    </div>
    <br><br>
    <div class="detail_imagenes">
        <div class="row fila1">
            <div class=" col image1">
                <img class="img-fluid" src="img/planes_2.JPG" alt="">
            </div>
            <div class="fila1 col image2">
                <img class="img-fluid" src="img/planes_3.JPG" alt="">
            </div>
            <div class=" col image3">
                <img class="img-fluid" src="img/planes_1.JPG" alt="">
            </div>
            <div class="col image4">
                <img class="img-fluid" src="img/planes_4.JPG" alt="">
            </div>
        </div>
        <br><br>
        <a href="#" class="ver_fotos">Ver todas las fotos</a>

    </div>
    <br><br>
    <hr>
    <br><br>
    <div class="description_detail_plans">
        <div class="deatil_description">
            <div>
                <img src="img/descripcion.png" alt="">
                <span class="descrip_plan_turi ml-3">Descripción del lugar</span>
            </div>

            <p class=" texto_detail_turismo ml-5">{{ $touristSite[0]->description }}</p>
            <a href="#" class="ver_fotos ml-5">Ver más</a>
        </div>


    </div>
    <br><br>
    <hr>
    <br><br>
    <div class="description_detail_plans">
        <div class="deatil_description">
            <div>
                <img src="img/Frame.png" alt="">
                <span class="descrip_plan_turi ml-3">Lo que este lugar ofrece</span>
            </div>
            <div class="services">
                @if(count($getServiceTourisSite)>0)
                <div class="fila">
                    @foreach($getServiceTourisSite as $key => $service)

                    @if($service->name=='Wifi')
                    <div class="box">
                        <img src="img/wifi.png" alt="">
                        {{ $service->name}}
                    </div>
                    @elseif($service->name=='Cocina')
                    <div class="box">
                        <img src="img/cocina.png" alt="">
                        {{ $service->name}}
                    </div>
                    @elseif($service->name==='Estacionamiento gratuito en las instalaciones')
                    <div class="box">
                        <img src="img/estacionamiento.png" alt="">
                        {{ $service->name}}
                    </div>
                    @elseif($service->name=='Jacuzzi')
                    <div class="box">
                        <img src="img/jacuzzi.png" alt="">
                        {{ $service->name}}
                    </div>
                    @elseif($service->name=='Lavadora')
                    <div class="box">
                        <img src="img/lavadora.png" alt="">
                        {{ $service->name}}
                    </div>
                    @elseif($service->name=='Piscina')
                    <div class="box">
                        <img src="img/piscina.png" alt="">
                        {{ $service->name}}
                    </div>
                    @elseif($service->name==='Televisor con cable')
                    <div class="box">
                        <img src="img/televisor.png" alt="">
                        {{ $service->name}}
                    </div>
                    @elseif($service->name==='Patio y balcón')
                    <div class="box">
                        <img src="img/patio.png" alt="">
                        {{ $service->name}}
                    </div>
                    @else
                    <div class="box">
                        <img src="img/patio.png" alt="">
                        {{ $service->name}}
                    </div>
                    @endif

                    @endforeach
                </div>
                @else
                <div class="fila">
                    <p class="no_service">No se han agregado servicios</p>
                </div>
                @endif

            </div>
        </div>


    </div>
    <br><br>
    <hr>
    <br><br>
    <div class="description_detail_plans">
        <div class="deatil_description">
            <div>
                <img src="img/ubicacion.png" alt="">
                <span class="descrip_plan_turi ml-3">Como puedes llegar</span>
            </div>
            <div class="mapa">
                <iframe  width="100%" height="279px" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB0-LsNwVbOtS8KQ8W__y-cnbEswQe1B6U&q=Space+Needle,Seattle+WA">
                </iframe>
            </div>
      
            <span class=" mt-4 texto_detail_turismo ml-5">Zonas muy tranquilas. </span><br>
            <span class=" texto_detail_turismo ml-5"> Ideal para montar en bicicleta o salir a hacer deporte.</span>

        </div>
    </div>
    <br><br>
    <hr>
    <br><br>
    <div class="description_detail_plans">
        <div class="deatil_description">
            <div>
                <img src="img/reglas.png" alt="">
                <span class="descrip_plan_turi ml-3">Reglas que debes seguir</span>
            </div>
            <div class="services">
                @if(count($getRules)>0)
                <div class="fila">
                    @foreach($getRules as $key => $rules)
                    <div class="box">
                        {{ $rules->name}}
                    </div>
                    @endforeach
                </div>
                @else
                <div class="fila">
                    <p class="no_service">No se han agregado reglas</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <br><br>
    <hr>
    <br><br>
    <div class="description_detail_plans">
        <div class="deatil_description">
            <div>
                <img src="img/resena.png" alt="">
                <span class="descrip_plan_turi ml-3">Reseñas</span>
                <br>
                <div class="clasificacion_resena">
                    <span class="ml-5">
                        <label class="estrellas_resena" for="radio1">★</label>
                        <label class="estrellas_resena" for="radio2">★</label>
                        <label class="estrellas_resena" for="radio3">★</label>
                        <label class="estrellas_resena" for="radio4">★</label>
                        <label class="estrellas_resena" for="radio5">★</label>
                        <label class="ml-3 resena">4.5</label>
                    </span>
                </div>
            </div>
            <div class="detail_resena">
                <div class="resena_card row">
                    <div class=" card col-12 col-sm-5 col-md-5">
                        <div class="title_card mt-3">
                            <span class="ml-3 avantar">J</span>
                            <span class="ml-2">Juan David Ortiz</span>
                        </div>
                        <div class="clasificacion_detail_resena">
                            <span class="">
                                <label class="estrellas_detail_resena" for="radio1">★</label>
                                <label class="estrellas_detail_resena" for="radio2">★</label>
                                <label class="estrellas_detail_resena" for="radio3">★</label>
                                <label class="estrellas_detail_resena" for="radio4">★</label>
                                <label class="estrellas_detail_resena" for="radio5">★</label>
                            </span>
                        </div>
                        <div class="m-3">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class=" card col-12 col-sm-5 col-md-5">
                        <div class="title_card mt-3">
                            <span class="ml-3 avantar">J</span>
                            <span class="ml-2">Juan David Ortiz</span>
                        </div>
                        <div class="clasificacion_detail_resena">
                            <span class="">
                                <label class="estrellas_detail_resena" for="radio1">★</label>
                                <label class="estrellas_detail_resena" for="radio2">★</label>
                                <label class="estrellas_detail_resena" for="radio3">★</label>
                                <label class="estrellas_detail_resena" for="radio4">★</label>
                                <label class="estrellas_detail_resena" for="radio5">★</label>
                            </span>
                        </div>
                        <div class="m-3">
                            <p class="card-text">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                        </div>
                    </div>
                </div>
                <div class=" mt-5 mr-5 btn_resena_content">
                    <button type="button" class="btn_resena">Añadir reseña</button>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>
@endsection

@section('script')

@endsection
