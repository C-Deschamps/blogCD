@extends('template')
@section('nav')

@include('layout.navDefault')

@endsection

@section('contenu')
<div class="container">
<div class="py-5">
<!--Carousel Wrapper-->
<div id="video-carousel-example2" class="carousel slide" data-ride="carousel">
  <!--Indicators-->
  <ol class="carousel-indicators">
    <li data-target="#video-carousel-example2" data-slide-to="0" class="active"></li>
    <li data-target="#video-carousel-example2" data-slide-to="1"></li>
    <li data-target="#video-carousel-example2" data-slide-to="2"></li>
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    <!-- First slide -->
    <div class="carousel-item active">
      <!--Mask color-->
      <div class="view flex-center">
        <!--Video source-->

          {!! Youtube::getVideoInfo($listId['0'])->player->embedHtml !!}

        <div class="mask rgba-black-light"></div>
      </div>

      <!--Caption-->
      <div class="carousel-caption" >
        <div class="animated fadeInDown">

        </div>
      </div>
      <!--Caption-->
    </div>
    <!-- /.First slide -->

    <!-- Second slide -->
    <div class="carousel-item">
      <!--Mask color-->
      <div class="view flex-center">
        <!--Video source-->

          {!! Youtube::getVideoInfo($listId['1'])->player->embedHtml !!}


        <div class="mask rgba-black-light"></div>
      </div>

      <!--Caption-->
      <div class="carousel-caption">
        <div class="animated fadeInDown">

        </div>
      </div>
      <!--Caption-->
    </div>
    <!-- /.Second slide -->

    <!-- Third slide -->
    <div class="carousel-item">
      <!--Mask color-->
      <div class="view flex-center">
        <!--Video source-->


          {!! Youtube::getVideoInfo($listId['2'])->player->embedHtml !!}

        <div class="mask rgba-black-light"></div>
      </div>

      <!--Caption-->
      <div class="carousel-caption">
        <div class="animated fadeInDown">

        </div>
      </div>
      <!--Caption-->
    </div>
    <!-- /.Third slide -->
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#video-carousel-example2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="false"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#video-carousel-example2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
</div>
</div>


@endsection

@section('script')
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <!-- animsition.js -->
  <script src="js/animsition.min.js"></script>

  <script src="js/fade.js"></script>
    <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>

@endsection
