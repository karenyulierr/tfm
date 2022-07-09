<link rel="stylesheet" href="css/footer.css">

<footer>
    <div class="row row_principal">
        <div class="col-md-5 mt-5 mb-5 ">
            {{-- <a href="/" class="">
                <span class="turi_footer">turi</span><span class="app_footer">app</span>
            </a> --}}
            {{-- <p class="text-footer"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius corrupti quidem soluta adipisci tempora blanditiis expedita</p> --}}
            <img src="img/logo.png" alt="">
            <br>
            <br>
            <p>Copyright © 2022</p>
            <p>Términos & Condiciones</p>
        </div>
        <div class="col-md-5 mt-5 mb-5">
            <div class="row_item">
                <div class="col ">
                    <p class="Servicios mb-1"> Categorias</p>
                    @foreach($category as $key => $value)
                    <div class="link">
                        <a href="/categoryview?category_id={{ $value->id }}"">{{ $value->name }}</a>
                        </div>

                    @endforeach
                   
                    
                </div>
                <div class=" col ">
                    <p class=" Siguenos mt-2 mb-2"> Síguenos</p>
                            <div class="row">
                                <div class="col-1 logo_siguenos">
                                    <img src="img/facebook.svg" alt="CoolBrand">
                                </div>
                                <div class="col link">
                                    <a href="#">Facebook</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1 logo_siguenos">
                                    <img src="img/twitter.svg" alt="CoolBrand">
                                </div>
                                <div class="col link">
                                    <a href="#">Twitter</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1 logo_siguenos">
                                    <img src="img/instagram.svg" alt="CoolBrand">
                                </div>
                                <div class="col link">
                                    <a href="#">Instagram</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</footer>
