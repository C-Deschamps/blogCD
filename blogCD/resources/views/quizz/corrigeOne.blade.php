@extends('template')

@section('nav')

@include('layout.navForum')

@endsection

@section('contenu')

<div class="container">
    <div class="privew">
        <div class="questionsBox">
            @if ($questions[0]->picture == null)
            <div class="questions">{{ $questions[0]->title }}
            </div>
            @else

            <div id="background-image" class="questions" style="background-image: url({!! URL::asset($questions[0]->picture) !!});background-repeat: no-repeat; background-position: center;background-size: contain;/*1000px 500px;*/ ">{{ $questions[0]->title }}
            </div>

            @endif

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
                    @if($reponse[0]->isRight == 1) {{-- Si la question est juste --}}
                        @if($reponse[0]->reponseSimple == 'true')
                <div class="funkyradio-info">

                 <input type="radio" name="{{ $questions[0]->id}}" id="radio{{ $questions[0]->id}}" value="true" checked disabled/>
                 <label for="radio{{ $questions[0]->id}}" class="juste">Vrai</label>
             </div>

             <div class="funkyradio-info">
                <input type="radio" name="{{ $questions[0]->id}}" id="radi{{ $questions[0]->id}}" value="false" disabled/>
                <label for="radi{{ $questions[0]->id}}">Faux</label>
            </div>
                    @elseif ($reponse[0]->reponseSimple == 'false')
            <div class="funkyradio-info">

             <input type="radio" name="{{ $questions[0]->id}}" id="radio{{ $questions[0]->id}}" value="true" disabled/>
             <label for="radio{{ $questions[0]->id}}">Vrai</label>
         </div>

         <div class="funkyradio-info">
            <input type="radio" name="{{ $questions[0]->id}}" id="radi{{ $questions[0]->id}}" value="false" checked disabled/>
            <label for="radi{{ $questions[0]->id}}" class="juste">Faux</label>
        </div>
                    @endif
                @else {{-- Si la question est fausse --}}
                     @if($reponse[0]->reponseSimple == 'true')
                <div class="funkyradio-info">

                 <input type="radio" name="{{ $questions[0]->id}}" id="radio{{ $questions[0]->id}}" value="true" checked disabled/>
                 <label for="radio{{ $questions[0]->id}}" class="faux">Vrai</label>
             </div>

             <div class="funkyradio-info">
                <input type="radio" name="{{ $questions[0]->id}}" id="radi{{ $questions[0]->id}}" value="false" disabled/>
                <label for="radi{{ $questions[0]->id}}" class="juste">Faux</label>
            </div>
                    @elseif ($reponse[0]->reponseSimple == 'false')
            <div class="funkyradio-info">

             <input type="radio" name="{{ $questions[0]->id}}" id="radio{{ $questions[0]->id}}" value="true" disabled/>
             <label for="radio{{ $questions[0]->id}}" class="juste">Vrai</label>
         </div>

         <div class="funkyradio-info">
            <input type="radio" name="{{ $questions[0]->id}}" id="radi{{ $questions[0]->id}}" value="false" checked disabled/>
            <label for="radi{{ $questions[0]->id}}" class="faux">Faux</label>
        </div>

                    @endif
                @endif
         @else {{-- Si ya pas de reponse  --}}
            @if ($questions[0]->reponse == 'true') {{-- Si la rep est Vrai --}}
        <div class="funkyradio-info">

         <input type="radio" name="{{ $questions[0]->id}}" id="radio{{ $questions[0]->id}}" value="true" disabled />
         <label for="radio{{ $questions[0]->id}}" class="juste">Vrai</label>
     </div>

     <div class="funkyradio-info">
        <input type="radio" name="{{ $questions[0]->id}}" id="radi{{ $questions[0]->id}}" value="false" disabled/>
        <label for="radi{{ $questions[0]->id}}">Faux</label>
    </div>
            @else
            <div class="funkyradio-info">

         <input type="radio" name="{{ $questions[0]->id}}" id="radio{{ $questions[0]->id}}" value="true" disabled />
         <label for="radio{{ $questions[0]->id}}" >Vrai</label>
     </div>

     <div class="funkyradio-info">
        <input type="radio" name="{{ $questions[0]->id}}" id="radi{{ $questions[0]->id}}" value="false" disabled/>
        <label for="radi{{ $questions[0]->id}}" class="juste">Faux</label>
    </div>
            @endif
    <div>
        <p>Vous n'avez pas répondu à cette question</p>
    </div>

         @endif
    @endif


    @if ($questions[0]->type == 'Simple')
        @if (isset($reponse[0]->reponseSimple))
            @if ($reponse[0]->isRight == 1)
    <input id="reponseSimple" type="text" class="form-control{{ $errors->has('reponseSimple') ? ' is-invalid' : '' }} juste" name="reponseSimple" placeholder="Votre réponse" value="{{ $reponse[0]->reponseSimple }}" autofocus style="margin-bottom: .5rem;background-color: #00c851;" disabled>

            @else{{--  SI la rep est fausse --}}
        <input id="reponseSimple" type="text" class="form-control{{ $errors->has('reponseSimple') ? ' is-invalid' : '' }} faux" name="reponseSimple" placeholder="Votre réponse" value="{{ $reponse[0]->reponseSimple }}" autofocus style="margin-bottom: .5rem;background-color: #ff1b30;" disabled>
        <p>La réponse était : <span style="font-weight: bold">{{ $questions[0]->reponse }}</span></p>
            @endif
        @else {{-- Si il n'y a pas de réponse --}}
    <input id="reponseSimple" type="text" class="form-control{{ $errors->has('reponseSimple') ? ' is-invalid' : '' }}" name="reponseSimple" placeholder="Votre réponse" autofocus style="margin-bottom: .5rem;" value="Vous n'avez rien répondu" disabled>
    <p>La réponse était : <span style="font-weight: bold">{{ $questions[0]->reponse }}</span></p>
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
        <a href="/corrigeOne/{{ $idQuizz }}/{{ $numQuestion - 1}}/{{ $numTentative }}"  class="button"><</button>
        @else
        <a href="/corrigeOne/{{ $idQuizz }}/{{ $numQuestion - 1}}/{{ $numTentative }}"  class="button" style="opacity: 0;" disabled><</a>
        @endif
        @if($questions[0]->NumQuestion != $quizz->nbrQuestion)
        <a href="/corrigeOne/{{ $idQuizz }}/{{ $numQuestion + 1}}/{{ $numTentative }}"  class="button">></a>
        @else

        <a href="/quizz" class="button">
            Retour au quizz
        </a> {{-- Le bouton final de fin de quizz --}}
        @endif
        <span>{{ $questions[0]->NumQuestion }}/{{ $quizz->nbrQuestion }}</span>
    </div>

</div>
</div>
</div>


@endsection

@section('script')
@include('layout.script')
@endsection
