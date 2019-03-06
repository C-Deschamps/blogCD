@extends('template')

@section('nav')

@include('layout.navForum')

@endsection

@section('contenu')

<div class="container">
 <div class="py-3">
  <div id="sujet-header">
   <h2>{{ $title }}</h2>
 </div>
</div>
<div class="mb-5">

<div class="float-right">
   <form method="POST" action="{{ action('CommentsController@navPost', $sujet->id) }}" accept-charset="UTF-8">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <label for="numNav">Page :</label>
      <input type="number" name="numNav" min="1" max="{{ $nbrPages }}" value="{{ $numPage }}">/ {{ $nbrPages }}

      <input class="btn btn-sm btn-outline-info pull-right" type="submit" value="Go !">
    </form>
</div>

</div>
<!-- Blog Entries Column -->

<div class="col-md-10">
@if($nbrMessages == 0)
<div class="mx-auto text-center">
  <p class="lead">Poste le premier commentaire de ce sujet !</p>
</div>
@endif
  <!-- Blog Post -->
  @foreach ($listComment as $comment)

  <div class="card mb-4">
    <div class="row no-gutters">
      <div class="col">
        <div class="card">
          <div class="card-horizontal">
            <div  class="card-header nomComment">
              <div class="img-square-wrapper">
                <img class="card-img-bottom rounded scale" src="{{ URL::asset($comment->pdp['photo']) }}">
              </div>
              <h4>Posté par <a href="/userInfo/{{ $comment->idUser }}">{{ $comment->auteur['name'] }}</a></h4>
            </div>

            <div class="card-body showComment" >
              @if ($comment->reponse != null)
              <p class="card-text"><i>{!! nl2br(e($comment->answer)) !!}</i></p>
              @endif
              @if ($comment->debut != null)
              <div class="debut{{ $comment->id }}">
                <p class="card-text" style="font-size: 120%; font-color: solid black">{!! nl2br(e($comment->debut)) !!}</p>
                <div class="float-right">
                  <a class="btn btn-primary btn-md" onClick="showMore({{ $comment->id }})">Voir plus</a>
                </div>
              </div>

              <div class="all{{ $comment->id }}" style="display: none;">
               <p class="card-text" style="font-size: 120%; font-color: solid black">{!! nl2br(e($comment->text)) !!}</p>
                <div class="float-right">
                  <a class="btn btn-primary btn-md" onClick="showMore({{ $comment->id }})">Réduire</a>
                </div>
             </div>
            @else
             <p class="card-text" style="font-size: 120%; font-color: solid black">{!! nl2br(e($comment->text)) !!}</p>
             @endif
           </div>
         </div>
         <div class="card-footer text-muted">
          Poster le {{ $comment->created_at }}
          @auth
          <div class="float-right">
            <a class="btn btn-primary btn-md" href="{{ action('CommentsController@answer', $comment->id) }}" >Répondre </a>
          </div>
          @endauth
        </div>

      </div>
    </div>
  </div>
</div>
@endforeach


<!-- Pagination -->
@if ($nbrPages != 1)
  @if ($numPage == 1)

  <ul class="pagination justify-content-center mb-4">
    <li class="page-item disabled">
     <a class="page-link" href="#">&larr; Retour</a>
   </li>
   <li class="page-item">
     <a class="page-link" href="/showOneSujet/{{ $sujet->id }}/{{ $numPage + 1 }}">Suivant &rarr;</a>
   </li>
  </ul>

  @elseif ($numPage == $nbrPages)

  <ul class="pagination justify-content-center mb-4">
    <li class="page-item">
     <a class="page-link" href="/showOneSujet/{{ $sujet->id }}/{{ $numPage - 1 }}">&larr; Retour</a>
   </li>
   <li class="page-item disabled">
     <a class="page-link" href="#">Suivant &rarr;</a>
   </li>
  </ul>

  @else

  <ul class="pagination justify-content-center mb-4">
    <li class="page-item">
     <a class="page-link" href="/showOneSujet/{{ $sujet->id }}/{{ $numPage - 1 }}">&larr; Retour</a>
   </li>
   <li class="page-item">
     <a class="page-link" href="/showOneSujet/{{ $sujet->id }}/{{ $numPage + 1 }}">Suivant &rarr;</a>
   </li>
  </ul>

  @endif
@endif

</div>

<div class="py-3">
 @auth
 @if ($text == null) {{-- si le user a fait répondre on affiche pas ce bouton --}}
 <div class="row">
  <div class="col-lg-2">
   <a id="commentBtn" class="btn btn-primary btn-lg" onClick="newComment()" class="btnedit"><i class="far fa-comments" style="font-size:20px;color:white;"></i></a>
 </div>
</div>
@endif


<div class="row">
  <div id="newComment" class="col-lg-8">


    <form method="POST" action="{{ action('CommentsController@newCommentPost', $sujet->id) }}" accept-charset="UTF-8">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <textarea class="form-control" placeholder="Votre commentaire:" maxlength="2000" name="text" cols="50" rows="10" id="newComment"></textarea>
      <span class="hint" id="textarea_message"></span>

      <div class="float-right">
        <input class="btn btn-primary pull-right" type="submit" value="Envoyer !">
      </div>
    </form>

  </div>

</div>

@if ($text != null)
<div class="row"> {{-- Reponse à un commentaire --}}
  <div id="answerComment" class="col-lg-8">

    <form method="POST" action="{{ action('CommentsController@newCommentPost', $sujet->id) }}" accept-charset="UTF-8">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <label for="text" id="label"><p>{{ $text }}</p></label>
      <textarea class="form-control" maxlength="2000" name="text" cols="50" rows="10" id="answer">

      </textarea>

      <span class="hint" id="textarea_message"></span>

      <div class="float-right">
        <input class="btn btn-primary pull-right" type="submit" value="Envoyer !">
      </div>
    </form>

  </div>

</div>
@endif
@else
<small class="alertGuest">
  Vous devez être
  <a href="{{ route('login') }}" style="color:#17a2b8">connecter </a>
  pour répondre à ce post
</small>

@endauth

<div class="row">
  <div class="col-lg-2 bottomPage">
   <a href="/forum" class="btn btn-primary btn-md" id="navReturn">Retour à la navigation</a>
 </div>
</div>
{{-- end container --}}
</div>
</div>
@endsection

@section('script')
@include('layout.script')

<script>
  //Script qui détecte la variable text qui correspond au faite qu'un user à utiliser "répondre"
  var text = {!! json_encode($text) !!};
  if( text != null) {
    $(document).ready(function () {
     window.location = '#answerComment';
   });
  }

</script>



<script src="{{ URL::asset('js/comment.js') }}"></script>

@endsection
