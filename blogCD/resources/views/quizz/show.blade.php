@extends('template')

@section('nav')

@include('layout.navForum')

@endsection

@section('contenu')

<div class="container">
   <div class="py-5">
      <div class="table-responsive">
         <table class="table table-hover">
            <caption>Liste des quizz</caption>
            <thead class="thead-light">
               <tr class="d-flex">
                  <th scope="col" class="col-3">Auteur</th>
                  <th scope="col" class="col-7">Nom du Quizz</th>
                  <th scope="col" class="col-2">Nombre de questions</th>
                  {{-- <th scope="col">Dernier message</th> --}}
               </tr>
            </thead>
            <tbody>

               @foreach ($quizz as $quiz)
               @if ($quiz->available == 'user_down')
               <tr class="d-flex">
                  <td class="col-3 ">{{ $quiz->autheur }}</td>

                  <th class="col-7 "><a href="#" class="isDisabled" id="user" data-toggle="modal" data-target="#exampleModal{{ $quiz->id }}">{{ $quiz->name }} </a> </th>
                  <td class="col-2 no-hover"> {{ $quiz->nbrQuestion }}</td>
                   </tr>

                  @elseif ($quiz->available == 'admin_down')
                  <tr class="d-flex">
                  <td class="col-3 ">{{ $quiz->autheur }}</td>


                  <th class="col-7"><a href="#" class="isDisabled" id="admin">{{ $quiz->name }} </a></th>
                  <td class="col-2"> {{ $quiz->nbrQuestion }}</td>

                   </tr>
                  @else
            <tr class="d-flex no-hover">
                  <td class="col-3">{{ $quiz->autheur }}</td>

                  <th class="col-7"><a href="/showQuizz/{{ $quiz->id }}/1" >{{ $quiz->name }}</a></th>

                  <td class="col-2"> {{ $quiz->nbrQuestion }}</td>


               </tr>
                  @endif


<div class="modal fade" id="exampleModal{{ $quiz->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Impossible !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Vous avez déjà fait ce quizz
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Retour aux quizz</button>
         <a href="/newTentative/{{ $quiz->id }}" class="btn btn-danger btn-sm">Démarrer une nouvelle tentative</a>
      </div>
    </div>
  </div>
</div>


               @endforeach

            </tbody>
         </table>
      </div>

      @auth
      <div class="row justify-content-center"style="margin-top: 2%;">
        <div class="col-md-12">
         <a class="btn btn-primary btn-md" class="btnedit" href="/createQuizz">Créer un nouveau quizz</a>
      </div>
   </div>
   @endauth
</div>
</div>

@endsection

@section('script')
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- animsition.js -->
<script src="js/animsition.min.js"></script>

<script src="js/fade.js"></script>


@endsection
