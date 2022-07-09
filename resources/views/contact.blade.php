@extends('layouts.header')

@section('styles')
<link rel="stylesheet" href="css/contact.css">
@endsection

@section('contendido')
<div class="contacto">
    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row contenido_contact">
        <div class="col-6 formulario">
            <div class="text_contact">
                <p class="dudas">si tienes dudas no dudes</p>
                <p class="en_contact mb-5">En comunicarte</p>
            </div>
            <form action={{route('contact-us')}} method="POST" class="form_contac ml-5 mr-5">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="" name='name' placeholder="Nombre completo" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="" name="email" placeholder="Correo electrónico" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="" rows="5" placeholder="Mensaje" name="msg" required></textarea>
                </div>
                <button type="submit" class="btn btn_contact shadow">
                    Enviar
                </button>
            </form>
        </div>
        <div class="col-6 imagenes">
            <div class="row justify-content-start">
                <div class="col-4 imagen_uno">
                    <img src="img/contact2.JPG" class="img-fluid rounded " alt="">
                </div>
            </div>
            <div class="row card_2 justify-content-end">
                <div class="col-8 imagen_dos">
                    <img src="img/contact1.JPG" class="img-fluid rounded  float-right" alt="">
                </div>
            </div>
            <div class="row justify-content-start">
                <div class="col-5 imagen_tres">
                    <img src="img/contact3.JPG" class="img-fluid rounded " alt="">
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
