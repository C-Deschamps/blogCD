
@extends('template')

@section('nav')

@include('layout.navDefault')

@endsection

@section('contenu')
<div class="container">
  <div class="row justify-content-center">

    <div class="col-md-8" style="margin-top: 5%; margin-bottom: 5%;">
      <div class="card">
        <div class="card-header">Création de quizz</div>

        <div class="card-body">
          {!! Form::open(array('action' => 'QuizController@postQuizz', 'files' => true)) !!}
          <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Le nom du quizz']) !!}
            {!! $errors->first('title', '<small class="help-block" style="color: red;">:message</small>') !!}
          </div>

          {!! Form::label('numberQT', 'Nombre de questions :') !!}
          <div class="form-group {!! $errors->has('numberQt') ? 'has-error' : '' !!}">

            {!! Form::number('numberQt', 0, ['class' => 'form-control', 'min' => 1, 'id' => 'nbrQt', 'max' => 40 ]) !!}

            {!! $errors->first('numberQt', '<small class="help-block">:message</small>') !!}
          </div>

          @for($i = 1; $i <= 40 ; $i++)
          <div id="question{!! $i!!}" style="display: none;">
            {{-- Choix du type de la question  --}}
            <h5>{!! Form::label('qt' . $i, 'Question n° ' . $i . ':') !!}</h5>
            <div class="form-group {!! $errors->has($i . 'typeQt') ? 'has-error' : '' !!}">
              {!! Form::label($i . 'typeQt', 'Choisissez le type de la question :') !!}
              {!! Form::select($i . 'typeQt', array('Simple' => '1) Taper la réponse', 'QCM' => '2) QCM', 'Bool' => '3) Vrai ou Faux'), 'Simple', ['class' => 'form-control']) !!}

              {!! $errors->first($i . 'typeQt', '<small class="help-block">:message</small>') !!}
            </div>


            <div class="form-group {!! $errors->has($i . 'title') ? 'has-error' : '' !!}" >

              {!! Form::text($i . 'title', null, ['class' => 'form-control', 'placeholder' => 'Entrer l\'énoncé de la question']) !!}

              {!! $errors->first($i . 'title', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has( $i . 'isPicture') ? 'has-error' : '' !!}">
              {!! Form::label( $i . 'isPicture', 'La question à t\'elle une image ?') !!}
              {!! Form::checkbox($i . 'isPicture', '1', false) !!} {{-- , ['class' => 'form-control']  Rend un bouton bizarre--}}
              {!! $errors->first( $i . 'isPicture', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has($i .'_image') ? 'has-error' : '' !!}" id="picture{!! $i !!}" style="display: none;">

              {!! Form::file($i .'_image', ['class' => 'form-control', 'accept' => 'image/*']) !!}
              {!! $errors->first($i .'_image', '<small class="help-block">:message</small>') !!}
            </div>

            {{-- Reponse du Simple --}}
            <div class="form-group {!! $errors->has('answer' . $i) ? 'has-error' : '' !!}" id="simple{!! $i !!}">
              {!! Form::label('answer' . $i, 'La réponse attendu :') !!}
              {!! Form::text('answer' . $i,  null, ['class' => 'form-control']) !!}

              {!! $errors->first('answer' . $i, '<small class="help-block">:message</small>') !!}
            </div>

            {{-- Reponse du Bool --}}
            <div class="form-group {!! $errors->has('answerBool' . $i) ? 'has-error' : '' !!}" style="display: none;" id="bool{!! $i !!}">
              {!! Form::label('answerBool' . $i, 'La réponse attendue :') !!}
              {!! Form::select('answerBool' . $i, array('true' => 'Vrai', 'false' => 'Faux'), ['class' => 'form-control']) !!}

              {!! $errors->first('answerBool' . $i, '<small class="help-block">:message</small>') !!}
            </div>

            {{-- Definition du Qcm --}}

            <div class="form-group {!! $errors->has($i . 'numberAnswer') ? 'has-error' : '' !!}" style="display: none;" id="qcm{!! $i !!}">
              {!! Form::label($i . 'numberAnswer', 'Nombre de possibilités :') !!}
              {!! Form::number($i . 'numberAnswer', null, ['class' => 'form-control', 'min' => 2, 'max' => 8 ]) !!}

              {!! $errors->first($i . 'numberAnswer', '<small class="help-block">:message</small>') !!}

              <div class="form-group" >
                @for ($j = 1; $j <= 8 ; $j ++)
                <div class="col-md-3" style="display: none;" id="qcmAnswer{!! $i . $j !!}">
                  {!! Form::label($i . 'answerQcm' . $j, 'Possibilité n°' . $j) !!}
                  {!! Form::text($i . 'answerQcm' . $j, null, ['class' => 'form-control']) !!}
                  {!! $errors->first($i . 'answerQcm' . $j, '<small class="help-block">:message</small>') !!}
                </div>
                @endfor
              </div>

              <div class="form-group {!! $errors->has($i . 'numberRightAnswer') ? 'has-error' : '' !!}" id="qcmRightAnswer{!! $i !!}">
                {!! Form::label($i . 'numberRightAnswer', 'Nombre de reponses justes:') !!}
                {!! Form::number($i . 'numberRightAnswer', null, ['class' => 'form-control', 'min' => 1, 'max' => 2 ]) !!}

                {!! $errors->first($i . 'numberRightAnswer', '<small class="help-block">:message</small>') !!}
              </div>

              <div class="form-group" >
                @for ($j = 1; $j <= 8 ; $j ++)
                <div class="col-md-3" style="display: none;" id="qcmRightAnswer{!! $i . $j !!}">
                  {!! Form::label($i . 'answerRightQcm' . $j, 'Réponse juste n°' . $j) !!}
                  {!! Form::number($i . 'answerRightQcm' . $j, null, ['class' => 'form-control', 'min' => 1, 'max' => 1]) !!}
                  {!! $errors->first($i . 'answerRightQcm' . $j, '<small class="help-block">:message</small>') !!}
                </div>
                @endfor
              </div>

            </div>
            <div class="form-group">
              {!! Form::label('description' . $i, 'Explication (optionelle)') !!}
              {!! Form::textarea('description' . $i, null, ['class' => 'form-control', 'placeholder' => 'Entrez une explication de la question']) !!}
              {!! $errors->first('description' . $i, '<small class="help-block">:message</small>') !!}
            </div>
          </div>
          @endfor
          {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>

  </div>
</div>

@endsection

@section('script')
@include('layout.script')
<script src="{{ URL::asset('js/createQuizz.js') }}"></script>
@endsection
