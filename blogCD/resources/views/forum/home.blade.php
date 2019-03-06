@extends('template')

@section('nav')

@include('layout.navForum')

@endsection

@section('contenu')

<div class="container">
   <div class="py-5">
      <div class="table-responsive">
         <table class="table table-hover">
            <caption>Liste des sujets</caption>
            <thead class="thead-light">
               <tr class="d-flex">
                  <th scope="col" class="col-3">Auteur</th>
                  <th scope="col" class="col-7">Nom du sujet</th>
                  <th scope="col" class="col-2">Nombre de messages</th>
                  {{-- <th scope="col">Dernier message</th> --}}
               </tr>
            </thead>
            <tbody>
               @foreach ($listSujet as $sujets)
               <tr class="d-flex">
                  <td class="col-3">{{ $name[$j]->name }}</td>
                  <th class="col-7"><a href="/showOneSujet/{{ $sujets->id }}" >{{ $sujets->title }}</a></th>
                  <td class="col-2"> {{ $sujets->nbrMessages }}</td>

               </tr>
                <?php $j++; ?>
               @endforeach
            </tbody>
         </table>
      </div>

      @auth
      <div class="row justify-content-center"style="margin-top: 2%;">
        <div class="col-md-12">
         <a class="btn btn-primary btn-md" class="btnedit" href="/newSujet">Créer un nouveau sujet</a>
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
