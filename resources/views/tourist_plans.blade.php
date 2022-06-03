@extends('layouts.header')

@section('styles')
<link rel="stylesheet" href="css/tourist_plans.css">
@endsection

@section('contendido')
<div class="planes">
    <div class="card primer_card mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 col-sm-12 image_card">
                <img src="img/planes_1.JPG" class="img-fluid" alt="...">
            </div>
            <div class=" col-md-6 col-sm-12 card-body">
                <span class="disponible">Disponible</span>
                <br>
                <span class="card-title title_plan">la riviera</span>
                <br>
                <span class="clasificacion">
                    {{-- <input id="radio1" type="radio" name="estrellas" value="5"> --}}
                    <label class="estrellas" for="radio1">★</label>
                    {{-- <input id="radio2" type="radio" name="estrellas" value="4"> --}}
                    <label class="estrellas" for="radio2">★</label>
                    {{-- <input id="radio3" type="radio" name="estrellas" value="3"> --}}
                    <label class="estrellas" for="radio3">★</label>
                    {{-- <input id="radio4" type="radio" name="estrellas" value="2"> --}}
                    <label class="estrellas" for="radio4">★</label>
                    {{-- <input id="radio5" type="radio" name="estrellas" value="1"> --}}
                    <label class="estrellas" for="radio5">★</label>
                </span>
                <p class="card-text text_plans">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut hic provident ab vel? Inventore recusandae eum ex! Perferendis eius officia commodi numquam beatae quaerat deleniti expedita iusto? Cum, omnis quod?</p>
            </div>
            <div class="col-md-3 col-sm-12 valor_card">
                <p class="value_card">$ 120.000</p>
                <a href="#" class="btn btn_card">Ver</a>
            </div>
        </div>
    </div>
    <div class="card primer_card mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 col-sm-12 image_card">
                <img src="img/planes_2.JPG" class="img-fluid" alt="...">
            </div>
            <div class=" col-md-6 col-sm-12 card-body">
                <span class="disponible">Disponible</span>
                <br>
                <span class="card-title title_plan">la riviera</span>
                <br>
                <span class="clasificacion">
                    {{-- <input id="radio1" type="radio" name="estrellas" value="5"> --}}
                    <label class="estrellas" for="radio1">★</label>
                    {{-- <input id="radio2" type="radio" name="estrellas" value="4"> --}}
                    <label class="estrellas" for="radio2">★</label>
                    {{-- <input id="radio3" type="radio" name="estrellas" value="3"> --}}
                    <label class="estrellas" for="radio3">★</label>
                    {{-- <input id="radio4" type="radio" name="estrellas" value="2"> --}}
                    <label class="estrellas" for="radio4">★</label>
                    {{-- <input id="radio5" type="radio" name="estrellas" value="1"> --}}
                    <label class="estrellas" for="radio5">★</label>
                </span>
                <p class="card-text text_plans">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut hic provident ab vel? Inventore recusandae eum ex! Perferendis eius officia commodi numquam beatae quaerat deleniti expedita iusto? Cum, omnis quod?</p>
            </div>
            <div class="col-md-3 col-sm-12 valor_card">
                <p class="value_card">$ 120.000</p>
                <a href="#" class="btn btn_card">Ver</a>
            </div>
        </div>
    </div>
    <div class="card primer_card mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 col-sm-12 image_card">
                <img src="img/planes_3.JPG" class="img-fluid" alt="...">
            </div>
            <div class=" col-md-6 col-sm-12 card-body">
                <span class="disponible">Disponible</span>
                <br>
                <span class="card-title title_plan">la riviera</span>
                <br>
                <span class="clasificacion">
                    {{-- <input id="radio1" type="radio" name="estrellas" value="5"> --}}
                    <label class="estrellas" for="radio1">★</label>
                    {{-- <input id="radio2" type="radio" name="estrellas" value="4"> --}}
                    <label class="estrellas" for="radio2">★</label>
                    {{-- <input id="radio3" type="radio" name="estrellas" value="3"> --}}
                    <label class="estrellas" for="radio3">★</label>
                    {{-- <input id="radio4" type="radio" name="estrellas" value="2"> --}}
                    <label class="estrellas" for="radio4">★</label>
                    {{-- <input id="radio5" type="radio" name="estrellas" value="1"> --}}
                    <label class="estrellas" for="radio5">★</label>
                </span>
                <p class="card-text text_plans">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut hic provident ab vel? Inventore recusandae eum ex! Perferendis eius officia commodi numquam beatae quaerat deleniti expedita iusto? Cum, omnis quod?</p>
            </div>
            <div class="col-md-3 col-sm-12 valor_card">
                <p class="value_card">$ 120.000</p>
                <a href="#" class="btn btn_card">Ver</a>
            </div>
        </div>
    </div>
    <div class="card primer_card mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 col-sm-12 image_card">
                <img src="img/planes_4.JPG" class="img-fluid" alt="...">
            </div>
            <div class=" col-md-6 col-sm-12 card-body">
                <span class="disponible">Disponible</span>
                <br>
                <span class="card-title title_plan">la riviera</span>
                <br>
                <span class="clasificacion">
                    {{-- <input id="radio1" type="radio" name="estrellas" value="5"> --}}
                    <label class="estrellas" for="radio1">★</label>
                    {{-- <input id="radio2" type="radio" name="estrellas" value="4"> --}}
                    <label class="estrellas" for="radio2">★</label>
                    {{-- <input id="radio3" type="radio" name="estrellas" value="3"> --}}
                    <label class="estrellas" for="radio3">★</label>
                    {{-- <input id="radio4" type="radio" name="estrellas" value="2"> --}}
                    <label class="estrellas" for="radio4">★</label>
                    {{-- <input id="radio5" type="radio" name="estrellas" value="1"> --}}
                    <label class="estrellas" for="radio5">★</label>
                </span>
                <p class="card-text text_plans">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut hic provident ab vel? Inventore recusandae eum ex! Perferendis eius officia commodi numquam beatae quaerat deleniti expedita iusto? Cum, omnis quod?</p>
            </div>
            <div class="col-md-3 col-sm-12 valor_card">
                <p class="value_card">$ 120.000</p>
                <a href="#" class="btn btn_card">Ver</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
