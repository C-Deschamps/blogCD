@extends('template')

@section('nav')

@include('layout.navDefault')

@endsection

@section('contenu')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-top: 2%; margin-bottom: 1%;">
            <div class="card">

                <div class="card-header" >Vous êtez maintenant connecté</div>

                <div class="card-body" >
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    Bienvenue {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
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
