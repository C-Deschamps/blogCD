@extends('template')

@section('nav')

@include('layout.navDefault')

@endsection

@section('contenu')



<div class="container">
    <div class="privew">
        <div class="questionsBox">
            @if ($questions[0]->picture == null)
            <div class="questions">{{ $questions[0]->title }}
            </div>
            @else

            <div id="background-image" class="questions" style="background-image: url({!! URL::asset($picture) !!});background-repeat: no-repeat; background-position: center;background-size: contain;/*1000px 500px;*/ ">{{ $questions[0]->title }}
            </div>

            @endif
            <form method="POST" action="{{ action('PossibilitesController@postQt', [$quizz->id, $questions[0]->NumQuestion]) }}">
                @csrf
                {{-- Si la question est un QCM : --}}

                <div class="funkyradio">
                    @if($questions[0]->type == 'QCM')
                    @foreach($questions as $question)
                    <div class="funkyradio-primary">
                        @if (isset($repQCM))
                        @if (in_array($question->id, $repQCM))
                        <input type="checkbox" name="{{ $question->id}}" id="radio{{ $question->id}}" checked />
                        @endif
                        @else
                        <input type="checkbox" name="{{ $question->id}}" id="radio{{ $question->id}}" />
                        @endif
                        <label for="radio{{ $question->id}}">{{ $question->reponse }}</label>
                    </div>
                    @endforeach

                    @endif

             {{-- Si la question est un Bool --}}
             @if ($questions[0]->type == 'Bool')

                @if (isset($reponse[0]->reponseSimple))
                    @if($reponse[0]->reponseSimple == 'true')
                    <div class="funkyradio-info">

                       <input type="radio" name="{{ $questions[0]->id}}" id="radio{{ $questions[0]->id}}" value="true" checked />
                        <label for="radio{{ $questions[0]->id}}">Vrai</label>
                    </div>

                    <div class="funkyradio-info">
                        <input type="radio" name="{{ $questions[0]->id}}" id="radi{{ $questions[0]->id}}" value="false" />
                        <label for="radi{{ $questions[0]->id}}">Faux</label>
                    </div>
                    @elseif ($reponse[0]->reponseSimple == 'false')
                    <div class="funkyradio-info">

                       <input type="radio" name="{{ $questions[0]->id}}" id="radio{{ $questions[0]->id}}" value="true" />
                        <label for="radio{{ $questions[0]->id}}">Vrai</label>
                    </div>

                    <div class="funkyradio-info">
                        <input type="radio" name="{{ $questions[0]->id}}" id="radi{{ $questions[0]->id}}" value="false" checked/>
                        <label for="radi{{ $questions[0]->id}}">Faux</label>
                    </div>
                        @endif
                    @else
                    <div class="funkyradio-info">

                       <input type="radio" name="{{ $questions[0]->id}}" id="radio{{ $questions[0]->id}}" value="true" />
                        <label for="radio{{ $questions[0]->id}}">Vrai</label>
                    </div>

                    <div class="funkyradio-info">
                        <input type="radio" name="{{ $questions[0]->id}}" id="radi{{ $questions[0]->id}}" value="false" />
                        <label for="radi{{ $questions[0]->id}}">Faux</label>
                    </div>
                    @endif
             @endif


             @if ($questions[0]->type == 'Simple')
                    @if (isset($reponse[0]->reponseSimple))
                    <input id="reponseSimple" type="text" class="form-control{{ $errors->has('reponseSimple') ? ' is-invalid' : '' }}" name="reponseSimple" placeholder="Votre réponse" value="{{ $reponse[0]->reponseSimple }}" autofocus style="margin-bottom: .5rem;n">
                    @else
                    <input id="reponseSimple" type="text" class="form-control{{ $errors->has('reponseSimple') ? ' is-invalid' : '' }}" name="reponseSimple" placeholder="Votre réponse" autofocus style="margin-bottom: .5rem;n">

                    @endif
             @endif

{{--         <div class="funkyradio-primary">
            <input type="checkbox" name="radio" id="radio2" checked/>
            <label for="radio2">Second Option primary</label>

            <input type="checkbox" name="radio" id="radio3" />
            <label for="radio3">Third Option success</label>
        </div>
        <div class="funkyradio-success">
            <input type="radio" name="radio" id="radio3" />
            <label for="radio3">Third Option success</label>
        </div>
        <div class="funkyradio-danger">
            <input type="radio" name="radio{{ $questions[0]->id}}" id="radio4" />
            <label for="radio4">Fourth Option danger</label>
        </div>
        <div class="funkyradio-warning">
            <input type="radio" name="radio" id="radio5" />
            <label for="radio5">Fifth Option warning</label>
        </div>
        <div class="funkyradio-info">
            <input type="radio" name="radio" id="radio6" />
            <label for="radio6">Sixth Option info</label>
        </div> --}}
    </div>

    <div class="questionsRow">
        @if($questions[0]->NumQuestion != 1)
        <button type="submit" class="button" name="submitbutton" value="prevQt"><</button>
        @else
        <button type="submit" class="button" name="submitbutton" style="opacity: 0;" disabled><</button>
        @endif
        @if($questions[0]->NumQuestion != $quizz->nbrQuestion)
        <button type="submit" class="button" name="submitbutton" value="nextQt">></button>
        @else

         <button type="button" class="button" data-toggle="modal" data-target="#exampleModalCenter">
        Finir le quizz
         </button> {{-- Le bouton final de fin de quizz --}}
        @endif
         <button type="button" class="button" name="showNav" id="showNav" value="prevQt">>></button>
        <span>{{ $questions[0]->NumQuestion }}/{{ $quizz->nbrQuestion }}</span>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez-vous soumettre vos réponse ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Revenir au quizz</button>
        <button type="submit" class="button" name="submitbutton" value="final">Finir le quizz</button>
      </div>
    </div>
  </div>
</div>

</form>
</div>
</div>
</div>

<div class="sidebar-overlay none hide">
</div>

<div class="sidebar-wrapper hide">
    <div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#" id="sidebar-allQst"><i class="fas fa-list" ></i> Toutes les questions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" id="sidebar-unansweredQst"><i class="fas fa-times" style="color: red;"></i> Pas répondu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" id="sidebar-answerQst"><i class="fas fa-check" style="color: green;"></i> répondu</a>
      </li>
    </ul>
  </div>
  <div class="card-body" id="allQst">
    <div class="sidebar-list">
        @foreach ($allQuestions as $qst)

        <div>
            <a href="/showQuizz/{{ $quizz->id }}/{{$qst->NumQuestion }}" class="sidebar-one">
                <input type="button" name="{{$qst->NumQuestion }}" class="sidebar-number" value="{{$qst->NumQuestion }}"></input>
                <span class="sidebar-titleQst" style="color: rgb(0, 0, 0);font-size: ">{{$qst->title }}</span>
            </a>
        </div>
        @endforeach

    </div>
  </div>

  <div class="card-body none" id="unansweredQst">
    <h5 class="card-title">2</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>

  <div class="card-body none" id="answerQst">
    <h5 class="card-title">3</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  </div>
</div>

@endsection

@section('script')
@include('layout.script')
  <script src="{{ URL::asset('js/showOneQuizz.js') }}"></script>
@endsection
