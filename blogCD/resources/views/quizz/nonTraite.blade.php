@extends('template')

@section('nav')

@include('layout.navForum')

@endsection

@section('contenu')
<div class="container">
   <div class="my-4 ">
   <div class="col-lg-2 offset-lg-3">
      <div class="card text-center text-white bg-danger" style="width: 30rem; height: auto;">
         <div class="card-header">
            <h2>Attention ! </h2>
         </div>
         <div class="card-body">
            Vous n'avez pas remplie le(s) question(s) : <br>

               @foreach ($listNoRep as $key => $value)
               <div class="chiffre">
              <a href="/showQuizz/{{ $idQuizz}}/{{ $value}}" style="color: white;"> - {{ $value }}</a>
              </div>
              @endforeach


         </div>
         <div class="card-footer">
         <div class="float-right">
            <a class="btn btn-success btn-md" href="{{ action('PossibilitesController@correction', [$idQuizz, '1']) }}" >Continuer </a>
          </div>
          </div>
      </div>
      </div>
</div>
</div>


@endsection

@section('script')
@include('layout.script')


@endsection
