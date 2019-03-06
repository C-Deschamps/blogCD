@include('layout.headForm')

<body>
   <div class="col-sm-offset-3 col-sm-6">
    <br>
    <br>
      <div class="panel panel-info">
         <div class="panel-heading">Nouveau sujet </div>
         <div class="panel-body">

            {!! Form::open(array('action' => 'SujetsController@post',)) !!}
               <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                  {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Le nom du sujet']) !!}
                  {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
               </div>

               {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
            {!! Form::close() !!}
         </div>
      </div>
   </div>

@include('layout.script')

</body>

</html>
