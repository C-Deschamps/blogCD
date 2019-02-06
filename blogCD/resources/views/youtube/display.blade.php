@extends('template')
@section('nav')

@include('layout.navYoutube')

@endsection

@section('contenu')
 <div class="row">
   <div class="col-lg-8">
      <h1 class="page-header">Dashboard</h1>

    <h2 class="sub-header">Latest YT Data</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Channel-ID</th>
                <th>Title</th>
                <th>AllViews</th>
                <th>Subscribers</th>
                <th>Comments</th>
                <th>Videos</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$data['id']}}</td>
                <td>{{$data['title']}}</td>
                <td>{{$data['viewcount']}}</td>
                <td>{{$data['subscribers']}}</td>
                <td>{{$data['comments']}}</td>
                <td>{{$data['videos']}}</td>
            </tr>
            </tbody>
        </table>
    </div>
   </div>
  </div>
  <div class="row">


         @foreach ($listId as $idVid)
         <div class="col-lg-4">
         <div class="embed-responsive embed-responsive-21by9">
         {!! Youtube::getVideoInfo($idVid)->player->embedHtml !!}
         </div>
      </div>
         @endforeach
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
