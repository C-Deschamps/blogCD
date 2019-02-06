@extends('template')

@section('nav')

@include('layout.navExtra')

@endsection

@section('contenu')

  <div class="row justify-content-center"style="margin-top: 2%;">
    <div class="col-md-1">
      <h1>Test</h1>

      <p> De la page</p>
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



