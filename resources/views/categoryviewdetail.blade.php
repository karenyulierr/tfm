@extends('layouts.header')

@section('styles')
    <link rel="stylesheet" href="css/categoryviewdetail.css">
    <link rel="stylesheet" href="css/botonWhatsapp.css">
@endsection

@section('contendido')
    <div class="categoryviewdetail">
        @if (Session::has('mensaje'))
            <br><br>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row detail_planes_title">
            <div class="img_title">
                <img src="{{ asset('soportes/img_main/' . $touristSite[0]->main_image) }}"
                    alt="{{ $touristSite[0]->name }}">
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
                @if (count($getImages) > 0)
                    @foreach ($getImages as $key => $image)
                        @if ($image->id % 2 == 0)
                            <div class=" col image1">
                                <img class="img-fluid" src="{{ asset('soportes/img_site/' . $image->name) }}"
                                    alt="{{ $image->name }}">
                            </div>
                        @else
                            <div class=" col image2">
                                <img class="img-fluid" src="{{ asset('soportes/img_site/' . $image->name) }}"
                                    alt="{{ $image->name }}">
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="no_service">No se han agregado imagenes</p>
                @endif

            </div>
            <br><br>
            @if (count($getImages) > 0)
                <a href="#" class="ver_fotos" data-toggle="modal" data-target="#exampleModal">Ver todas las fotos</a>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $touristSite[0]->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @forelse($getImagesTotal as $key => $images)
                                            <li data-target="#carouselExampleIndicators"
                                                data-slide-to="{{ $key }}" class="active"></li>
                                        @empty
                                        @endforelse
                                    </ol>
                                    <div class="carousel-inner">
                                        @forelse($getImagesTotal as $key => $images)
                                            <div class="carousel-item  @if ($key == 0) active @endif">
                                                <img class="img-fluid"
                                                    src="{{ asset('soportes/img_site/' . $images->name) }}"
                                                    class="d-block w-100" alt=".{{ $images->name }}">

                                            </div>
                                        @empty
                                        @endforelse
                                    </div>

                                    <button class="carousel-control-prev" type="button"
                                        data-target="#carouselExampleIndicators" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-target="#carouselExampleIndicators" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <hr>
        <br><br>


        <div class="description_detail_plans">
            <div class="deatil_description">
                <div>
                    <img src="img/descripcion.png" alt="Logo descripcion">
                    <span class="descrip_plan_turi ml-3">Descripción del lugar</span>
                </div>

                <p class=" texto_detail_turismo ml-5">{{ $touristSite[0]->description }}</p>
                {{-- <a href="#" class="ver_fotos ml-5">Ver más</a> --}}
            </div>


        </div>
        <br><br>
        <hr>
        <br><br>
        <div class="description_detail_plans">
            <div class="deatil_description">
                <div>
                    <img src="img/Frame.png" alt="Logo servicios">
                    <span class="descrip_plan_turi ml-3">Lo que este lugar ofrece</span>
                </div>
                <div class="services">
                    @if (count($getServiceTourisSite) > 0)
                        <div class="fila">
                            @foreach ($getServiceTourisSite as $key => $service)
                                @if ($service->name == 'Wifi')
                                    <div class="box">
                                        <img src="img/wifi.png" alt="Icono servicio">
                                        {{ $service->name }}
                                    </div>
                                @elseif($service->name == 'Cocina')
                                    <div class="box">
                                        <img src="img/cocina.png" alt="Icono servicio">
                                        {{ $service->name }}
                                    </div>
                                @elseif($service->name === 'Estacionamiento gratuito en las instalaciones')
                                    <div class="box">
                                        <img src="img/estacionamiento.png" alt="Icono servicio">
                                        {{ $service->name }}
                                    </div>
                                @elseif($service->name == 'Jacuzzi')
                                    <div class="box">
                                        <img src="img/jacuzzi.png" alt="Icono servicio">
                                        {{ $service->name }}
                                    </div>
                                @elseif($service->name == 'Lavadora')
                                    <div class="box">
                                        <img src="img/lavadora.png" alt="Icono servicio">
                                        {{ $service->name }}
                                    </div>
                                @elseif($service->name == 'Piscina')
                                    <div class="box">
                                        <img src="img/piscina.png" alt="Icono servicio">
                                        {{ $service->name }}
                                    </div>
                                @elseif($service->name === 'Televisor con cable')
                                    <div class="box">
                                        <img src="img/televisor.png" alt="Icono servicio">
                                        {{ $service->name }}
                                    </div>
                                @elseif($service->name === 'Patio y balcón')
                                    <div class="box">
                                        <img src="img/patio.png" alt="Icono servicio">
                                        {{ $service->name }}
                                    </div>
                                @else
                                    <div class="box">
                                        <img src="img/patio.png" alt="Icono servicio">
                                        {{ $service->name }}
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
                    <img src="img/ubicacion.png" alt="Logo ubicacion">
                    <span class="descrip_plan_turi ml-3">Como puedes llegar</span>
                </div>

                <div id="map"> </div>

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
                    <img src="img/reglas.png" alt="Logo reglas">
                    <span class="descrip_plan_turi ml-3">Reglas que debes seguir</span>
                </div>
                <div class="services">
                    @if (count($getRules) > 0)
                        <div>
                            <ul class="fila">
                                @foreach ($getRules as $key => $rules)
                                    <div class="box">
                                        <li> {{ $rules->name }} </li>

                                    </div>
                                @endforeach
                            </ul>
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
                    <img src="img/resena.png" alt="Logo reseñas">
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
                        @if (count($getReviews) > 0)
                            @foreach ($getReviews as $key => $reviews)
                                <div class=" card col-12 col-sm-5 col-md-5">
                                    <div class="title_card mt-3">
                                        <span
                                            class="ml-3 avantar">{{ ucfirst(substr($reviews->name_person, 0, 1)) }}</span>
                                        <span class="ml-2">{{ $reviews->name_person }}</span>
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
                                        <p class="card-text">{{ $reviews->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no_service">No se han agregado reseñas</p>
                        @endif

                    </div>
                    <br><br>
                    {{ $getReviews->withQueryString()->links() }}
                    <div class=" mt-5 mr-5 btn_resena_content">
                        <button type="button" class="btn_resena" data-toggle="modal"
                            data-target="#exampleModal2">Añadir reseña</button>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar reseña</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('reviewCreate') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="tourist_sities_id"
                                            value="    {{ $touristSite[0]->id }}">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput0">Nombre completo</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput0"
                                                name="name_person" placeholder="Juan Camilo Torrez" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1"> correo electrónico</label>
                                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                                name="email" placeholder="juantorres@example.com" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Tu calificación </label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="stars"
                                                required>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Reseña o comentario</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" required></textarea>
                                        </div>
                                        <input type="hidden" name="created_at" value="{{ date('Y-m-d H:i:s') }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <input type="submit" class="btn btn-primary" value="Guardar">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <a href="https://api.whatsapp.com/send?phone=+57{{ $touristSite[0]->phone }}&text=Hola, te estas comunicando con {{ $touristSite[0]->name }}, Escríbenos y en pocos minutos respondemos todas tu dudas."
            class="float" target="_blank">
            <i class="fa fa-whatsapp my-float"></i>
        </a>
    </div>




@endsection

@section('script')
    {{-- <script type="module" src="js/maps_api.ts"></script> --}}
    <script type="module">
        let map;
        let latitude = {!! $touristSite[0]->latitude !!}
        let longitude = {!! $touristSite[0]->longitude !!}

        function initMap() {

            let point = {
                lat: latitude,
                lng: longitude
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: point,
                zoom: 18,

            });

            const marker = new google.maps.Marker({
                map,
                position: point
            });

            marker.addListener("click", () => {
                infowindow.open(map, marker);
            });
        }

        window.initMap = initMap;
    </script>


    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0-LsNwVbOtS8KQ8W__y-cnbEswQe1B6U&callback=initMap&v=weekly"
        defer></script>
@endsection
