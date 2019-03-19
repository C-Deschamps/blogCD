@extends('template')

@section('nav')

@include('layout.navDefault')

@endsection

@section('contenu')
<div class="container">
<div class="privew">
    <div class="questionsBox">
        <div class="questions">Este es una cuestionario y aqui va la primera pregunta</div>
        <div class="funkyradio">
        <div class="funkyradio-default">
            <input type="radio" name="radio" id="radio1" />
            <label for="radio1">First Option default</label>
        </div>
        <div class="funkyradio-primary">
            <input type="radio" name="radio" id="radio2" checked/>
            <label for="radio2">Second Option primary</label>
        </div>
        <div class="funkyradio-success">
            <input type="radio" name="radio" id="radio3" />
            <label for="radio3">Third Option success</label>
        </div>
        <div class="funkyradio-danger">
            <input type="radio" name="radio" id="radio4" />
            <label for="radio4">Fourth Option danger</label>
        </div>
        <div class="funkyradio-warning">
            <input type="radio" name="radio" id="radio5" />
            <label for="radio5">Fifth Option warning</label>
        </div>
        <div class="funkyradio-info">
            <input type="radio" name="radio" id="radio6" />
            <label for="radio6">Sixth Option info</label>
        </div>
    </div>
        <div class="questionsRow"><a href="#" class="button" id="nextquestions">Siguiente</a> <a href="#" class="button" id="skipquestions">Saltar</a><span>1/5</span></div>
    </div>
</div>
</div>
@endsection

@section('script')
@include('layout.script')
@endsection
