@extends('template')

@section('nav')

@include('layout.navForum')

@endsection

@section('contenu')
<div class="container">
   <div class="my-4">
   <div class="col-lg-4">
      <div class="card" >
         <div class="card-header">
            <h2>{{ Auth::user()->name }}</h2>
         </div>
         <div class="card-body">
            <img class="card-img-bottom" src="{{ URL::asset(Auth::user()->photo) }}">
         </div>
      </div>
      </div>
   </div>

</div>


@endsection

@section('script')
@include('layout.script')


@endsection
