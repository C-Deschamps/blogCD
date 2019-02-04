<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Mon Blog</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/welcome.css" rel="stylesheet">

  <!-- animsition.css -->
  <link rel="stylesheet" href="css/animsition.min.css">

</head>

<body>
  <div class="animsition" data-animsition-in-class="fade-in-up"
  data-animsition-in-duration="800"
  data-animsition-out-class="fade-out-down"
  data-animsition-out-duration="600">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link animsition-link" href="/">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link animsition-link" href="#">Contact</a>
          </li>

          <li class="nav-item">
            <a class="nav-link animsition-link" href="/extra" >Extra</a>
          </li>
          <li class="nav-item">
            <a class="nav-link animsition-link" href="/animation">Animation</a>
          </li>
        </ul>
        </div>
      </div>

  </nav>

  @yield('contenu')

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>
</div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <!-- animsition.js -->
  <script src="js/animsition.min.js"></script>

  <script src="js/fade.js"></script>


</body>

</html>
