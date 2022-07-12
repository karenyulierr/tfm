<link rel="stylesheet" href="css/footer.css">

<footer>
    <div class="row row_principal">
        <div class="col-md-5 mt-5 mb-5 ">
            {{-- <a href="/" class="">
                <span class="turi_footer">turi</span><span class="app_footer">app</span>
            </a> --}}
            {{-- <p class="text-footer"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius corrupti quidem soluta adipisci tempora blanditiis expedita</p> --}}
            <img src="img/logo.png" alt="Logo TuriApp">
            <br>
            <br>
            <p>Copyright © 2022</p>
            <p>Términos & Condiciones</p>
        </div>
        <div class="col-md-5 mt-5 mb-5">
            <div class="row_item">
                <div class="col ">
                    <span class="Servicios  "> Categorias</span>
                    @foreach($category as $key => $value)
                    <div class="link">
                        <a href="/categoryview?category_id={{ $value->id }}"">{{ $value->name }}</a>
                        </div>

                    @endforeach
                   
                    
                </div>
                <div class=" col ">
                    <span class=" Siguenos "> Síguenos</span>
                            <div class=" row">
                            <div class="logo_siguenos">
                                <img src="img/facebook.svg" alt="Icono facebook">
                            </div>&nbsp
                            <div class="link">
                                <a href="#">Facebook</a>
                            </div>
                    </div>
                    <div class="row">
                        <div class="logo_siguenos">
                            <img src="img/twitter.svg" alt="Icono Twitter">
                        </div>&nbsp
                        <div class="link">
                            <a href="#">Twitter</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="logo_siguenos">
                            <img src="img/instagram.svg" alt="Icono Instagram">
                        </div>&nbsp
                        <div class="link">
                            <a href="#">Instagram</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
