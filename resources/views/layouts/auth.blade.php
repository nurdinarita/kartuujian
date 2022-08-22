<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="#">
  <meta name="keywords" content="#">
  <meta name="author" content="#">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
  <!-- LOGIN CSS -->
  <link rel="stylesheet" href="{{ asset('front/css/login.css') }}">
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
 <!-- MAIN PAGE -->
 <main id="main">
  <article class="container">
   @yield('content')
 </article>
</main>
<!-- FOOTER -->
<footer id="footer">
  <div class="container-cpns h-100">
   <div class="row align-items-center h-100">
     <div class="col-lg-6 col-md-6 order-2 order-md-1 text-center text-md-left">
      <h5 class="footer-copyright">©{{ Date('Y') }} Kartu Ujian Dot Com All RIghts Reserved</h5>
    </div>
    <div class="col-lg-6 col-md-6 order-1 order-md-2 text-center text-md-right d-none d-sm-block mb-sm-3 mb-md-0">
      <a href="#" class="footer-link mx-2 mx-md-0 ml-0 ml-md-4">Syarat & Ketentuan</a>
      <a href="#" class="footer-link mx-2 mx-md-0 ml-0 ml-md-4">Kebijakan Privasi</a>
      <a href="#" class="footer-link mx-2 mx-md-0 ml-0 ml-md-4">Bantuan</a>
    </div>
  </div>
</div>
</footer>
<!-- JQUERY -->
<script src="{{ asset('front/js/jquery-3.5.1.min.js') }}"></script>
<!-- BOOTSTRAP JS -->
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>