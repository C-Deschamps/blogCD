@extends('template')

@section('nav')

@include('layout.navForum')

@endsection

@section('contenu')
<div class="container">
 <div class="my-4">
  <div class="row">

    <div class="col-lg-4">
     <div class="card" >
      <div class="card-header text-center">
       <h2>{{ Auth::user()->name }}</h2>
     </div>
     <div class="card-body">
       <img class="card-img-bottom" src="{{ URL::asset(Auth::user()->photo) }}">
       <div>
       Nombre de messages : {{ $nbrCommentaire }}</br>
       Nombre de Quizz complétés : {{ $nbrQuizzFini }}</br>
       Nombre de tentative total : {{ $nbrTentative }}
       </div>
     </div>
   </div>
   </div>

 <div class="offset-2 col-lg-5">
   <div class="card">
    <div class="card-header text-center">
         Vos derniers résultats
    </div>
        <div class="card-body">
         <div class="table-responsive">
          <table class="table table-hover">

            <thead>
              <tr>
               <th scope="col">Nom</th>
               <th scope="col">Score</th>
               <th scope="col">Tentative</th>

             </tr>
           </thead>
           <tbody>
             @foreach ($lastScores as $score)
             <tr>
             <th scope="row" class="col-5"><a href="/showCorrection/{{ $score->idQuizz }}/{{ $score->numTentative }}/{{ $score->idUser }}"> {{ $score->nomQuizz}}</a></th>
              <td class="col-3">{{ $score->score }}/{{ $score->nbrQuestion }}</td>
              <td class="col-4">{{ $score->numTentative }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

 </div>

<div class="row" style="padding: 15px;">
  <div class="card" style="width: 100%">
    <div class="card-header text-center" >Vos dernier Messages
    </div>
   <div class="card-body">
         <div class="table-responsive">
          <table class="table table-hover">

            <thead>
              <tr>
               <th scope="col">Nom</th>
               <th scope="col">Score</th>
               <th scope="col">Tentative</th>

             </tr>
           </thead>
           <tbody>
             @foreach ($lastScores as $score)
             <tr>
             <th scope="row" class="col-5"><a href="/showCorrection/{{ $score->idQuizz }}/{{ $score->numTentative }}/{{ $score->idUser }}"> {{ $score->nomQuizz}}</a></th>
              <td class="col-3">{{ $score->score }}/{{ $score->nbrQuestion }}</td>
              <td class="col-4">{{ $score->numTentative }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
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
