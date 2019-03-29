@extends('template')

@section('nav')

@include('layout.navForum')

@endsection

@section('contenu')
<div class="container">
 <div class="row">
   <div class="col-lg-10">
     <div class="tile">
       <div class="wrapper">
         <div class="header-title">Vos Résultats :</div>

        <div class="dates">
           <div class="start">
             <strong>Votre score</strong> {{ $scoreQuizz }} / {{ $nbrQst }}
             <span></span>
          </div>
          <div class="ends">
             <strong>Nombre de tentative : </strong> {{ $nbrTent }}
          </div>
       </div>

       <div class="stats">

        <div>
          <strong>INVITED</strong> 3098
       </div>

       <div>
          <strong>JOINED</strong> 562
       </div>

       <div>
          <strong>DECLINED</strong> 182
       </div>

    </div>

    <div class="stats">

     <div>
       <strong>INVITED</strong> 3098
    </div>

    <div>
       <strong>JOINED</strong> 562
    </div>

    <div>
       <strong>DECLINED</strong> 182
    </div>

 </div>

 <div class="stats">

  <div>
    <strong>INVITED</strong> 3098
 </div>

 <div>
    <strong>JOINED</strong> 562
 </div>

 <div>
    <strong>DECLINED</strong> 182
 </div>

</div>

<div class="footer">
  <a href="#" class="Cbtn Cbtn-primary">View</a>
  <a href="/quizz" class="Cbtn Cbtn-danger">Retour aux quizz</a>
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
