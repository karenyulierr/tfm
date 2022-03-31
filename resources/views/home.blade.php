@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content">
        <div id="app"></div>
    </div>
</div>

@endsection
@section('js')
    <script src="{{ mix('js/panel.js') }}"></script>
@stop
