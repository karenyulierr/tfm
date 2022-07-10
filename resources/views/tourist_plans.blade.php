@extends('layouts.header')

@section('styles')
<link rel="stylesheet" href="css/tourist_plans.css">

@endsection

@section('contendido')

<div class="planes">
    @foreach($plans as $key => $value)
    <div class="card primer_card mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 col-sm-12 image_card">
                <img src="{{asset('soportes/img_main/'. $value->main_image )}}" alt="{{  $value->name  }}" class="img-fluid">
            </div>
            <div class=" col-md-6 col-sm-12 card-body">
                <span class="disponible">Disponible</span>
                <br>
                <span class="card-title title_plan">{{ $value->name }}</span>
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
                <p class="card-text text_plans">{{ $value->description }}</p>
            </div>
            <div class="col-md-3 col-sm-12 valor_card">
                <p class="value_card">$ {{ $value->value }}</p>
                <a href="/detail_plans?_id={{ $value->id }}" class="btn btn_card">Ver</a>
            </div>
        </div>
    </div>
    @endforeach

    {{ $plans->withQueryString()->links() }}

 
</div>
@endsection

@section('script')

@endsection
