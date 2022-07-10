@extends('layouts.header')

@section('styles')
<link rel="stylesheet" href="css/categoryview.css">
@endsection

@section('contendido')
<div class="categoryview">
    <div class="row categories ">
        <div class="col-12 list_category">
            @foreach($category as $key => $value)
            @if($value->id ==$active_link)
            <a class="opcion_category text-center color_active" href="/categoryview?category_id={{ $value->id }}">{{ $value->name }}</a>
            @else
            <a class="opcion_category text-center" href="/categoryview?category_id={{ $value->id }}">{{ $value->name }}</a>
            @endif
            @endforeach
        </div>
    </div>

    @foreach($touristSiteService as $key => $value)
    <div class="categories_card">
        <div class="card primer_card mt-5 mb-5">
            <div class="row tamaño_fijo">
                <div class="col-md-3 col-sm-12 image_card">
                    <img src={{asset('soportes/img_main/'. $value->main_image )}} class="img-fluid" alt="{{ $value->name }}">
                </div>
                {{-- src="{{asset('images/teacher_avatar.png')}}" --}}
                <div class=" col-md-6 col-sm-12 card-body">
                    <span class="disponible">{{ $value->category }}</span>
                    <br>
                    <span class="card-title title_plan">{{ $value->name }} </span>
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
                    <a href="/categoryviewdetail?_id={{ $value->id }}" class="btn btn_card">Ver</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{ $touristSiteService->withQueryString()->links() }}
</div>
@endsection

@section('script')

@endsection
