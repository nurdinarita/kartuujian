<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  @stack('meta')
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kartu Ujian</title>
  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
  <!-- SWIPER CSS -->
  <link rel="stylesheet" href="{{ asset('front/css/swiper-bundle.min.css') }}">
  <!-- HOME CSS -->
  <link rel="stylesheet" href="{{ asset('front/css/home.css') }}">
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  @stack('css')
</head>
<body>
  <!-- NAV "MOBILE" -->
  <aside id="nav-right">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mb-4 text-right">
          <button type="button" name="navClose" class="nav-close">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15 1.51071L13.4893 0L7.5 5.98929L1.51071 0L0 1.51071L5.98929 7.5L0 13.4893L1.51071 15L7.5 9.01071L13.4893 15L15 13.4893L9.01071 7.5L15 1.51071Z" fill="#2D6187"/>
            </svg>
          </button>
        </div>
        <div class="col-lg-12">
          <a class="nav-right-link nav-right-link-active" href="{{ url('/') }}">Home</a>
          <a class="nav-right-link" href="{{ url('leaderboard') }}">Leaderboard</a>
          <a class="nav-right-link" href="{{ url('tryout') }}">Tryout</a>
          <!-- <a class="nav-right-link" href="{{ url('blog') }}">Blog</a> -->
          <a class="nav-right-link" href="{{ url('cart') }}">Keranjang</a>
          @guest
          <div class="d-flex mt-3">
            <a class="nav-right-link nav-right-link-login" href="{{ url('login') }}">Masuk</a>
            <a class="nav-right-link nav-right-link-registrasi" href="{{ url('register') }}">Daftar</a>
          </div>
          @endguest
        </div>
      </div>
    </div>
  </aside>
  <!-- NAV -->
  <nav id="nav">
    <div class="container-cpns h-100">
      <div class="row h-100">
        <div class="col-9 col-md-4 col-lg-4 d-flex align-items-center order-1">
          <a href="{{ url('/') }}">
            <img style="height:50px;" src="{{ asset('front/images/website/tryout-cpns.png') }}" alt="#">
          </a>
        </div>
        <div class="col-md-8 col-lg-8 d-none d-md-flex align-items-center justify-content-end order-3">
          <a class="nav-top-link nav-active" href="{{ url('/') }}">Home</a>
          <a class="nav-top-link" href="{{ url('leaderboard') }}">Leaderboard</a>
          <a class="nav-top-link" href="{{ url('tryout') }}">Tryout</a>
          <!-- <a class="nav-top-link" href="{{ url('blog') }}">Blog</a> -->
          <a class="nav-top-link" href="{{ url('cart') }}">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0)">
                <path d="M9.72656 19.3948H25.6057C25.9989 19.3948 26.3438 19.1348 26.4503 18.7571L29.9661 6.45221C30.0417 6.18693 29.9899 5.90198 29.8235 5.68156C29.6569 5.46184 29.3978 5.33206 29.1213 5.33206H7.69753L7.06924 2.50491C6.97998 2.10231 6.62292 1.81644 6.21094 1.81644H0.878906C0.393219 1.81644 0 2.20966 0 2.69534C0 3.18126 0.393219 3.57425 0.878906 3.57425H5.50552L8.67943 17.8565C7.74559 18.2625 7.08984 19.192 7.08984 20.2737C7.08984 21.7276 8.27271 22.9104 9.72656 22.9104H25.6057C26.0916 22.9104 26.4846 22.5174 26.4846 22.0315C26.4846 21.5458 26.0916 21.1526 25.6057 21.1526H9.72656C9.24248 21.1526 8.84766 20.7587 8.84766 20.2737C8.84766 19.7887 9.24248 19.3948 9.72656 19.3948Z" fill="#363636" fill-opacity="0.7"/>
                <path d="M8.84766 25.5471C8.84766 27.0012 10.0305 28.1838 11.4846 28.1838C12.9385 28.1838 14.1213 27.0012 14.1213 25.5471C14.1213 24.0932 12.9385 22.9104 11.4846 22.9104C10.0305 22.9104 8.84766 24.0932 8.84766 25.5471Z" fill="#363636" fill-opacity="0.7"/>
                <path d="M21.2112 25.5471C21.2112 27.0012 22.394 28.1838 23.8479 28.1838C25.302 28.1838 26.4846 27.0012 26.4846 25.5471C26.4846 24.0932 25.302 22.9104 23.8479 22.9104C22.394 22.9104 21.2112 24.0932 21.2112 25.5471Z" fill="#363636" fill-opacity="0.7"/>
              </g>
              <defs>
                <clipPath id="clip0">
                  <rect width="30" height="30" fill="white"/>
                </clipPath>
              </defs>
            </svg>
          </a>
          @guest
          <a class="nav-login ml-md-4 ml-lg-5" href="{{ url('login') }}">Login</a>
          @endguest
          @auth
          <a class="nav-login ml-md-4 ml-lg-5" href="#" onclick="$('#form-logout').submit()">Log out</a>
          <form method="post" action="{{ url('logout') }}" style="display: none;" id="form-logout">
              @csrf
          </form>
          @endauth
        </div>
        <div class="col-3 d-flex d-md-none align-items-center justify-content-end order-2">
          <button type="button" name="navOpen" class="nav-hamburger">
            <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0H23V2.55556H0V0ZM0 6.38889H23V8.94444H0V6.38889ZM0 12.7778H23V15.3333H0V12.7778Z" fill="#2D6187"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer id="footer">
    <div class="container-cpns">
      <div class="row justify-content-between mb-5">
        <div class="footer-tentang mb-5 mb-md-0">
          <h4 class="footer-title mb-4">Tentang</h4>
          <ul class="footer-nav">
            <li class="footer-item">
              <a href="#" class="footer-item-link">Tentang Kami</a>
              <a href="#" class="footer-item-link">Kontak Kami</a>
            </li>
            <li class="footer-item">
              <a href="#" class="footer-item-link">Bantuan</a>
              <a href="#" class="footer-item-link">Karir</a>
            </li>
            <li class="footer-item">
              <a href="#" class="footer-item-link">Jadi Mitra</a>
            </li>
          </ul>
        </div>
        <!-- <div class="footer-lainnya mb-5 mb-md-0">
          <h4 class="footer-title mb-4">Lainnya</h4>
          <ul class="footer-nav">
            <li class="footer-item">
              <a href="#" class="footer-item-link">Syarat dan Ketentuan</a>
              <a href="#" class="footer-item-link">For Enterprise</a>
            </li>
            <li class="footer-item">
              <a href="#" class="footer-item-link">Kebijakan Privasi</a>
              <a href="#" class="footer-item-link">Career Mentoring</a>
            </li>
            <li class="footer-item">
              <a href="#" class="footer-item-link">Press Kit</a>
              <a href="#" class="footer-item-link">Rekomendasi Instruktur</a>
            </li>
            <li class="footer-item">
              <a href="#" class="footer-item-link">Verifikasi Sertifikat</a>
            </li>
          </ul>
        </div> -->
        <!-- <div class="footer-sertifikat mb-5 mb-md-0">
          <h4 class="footer-title mb-4">Sertifikat</h4>
          <div class="text-center text-md-left">
            <img class="img-sertifikat" src="{{ asset('front/images/website/sertifikat.png') }}" alt="#">
          </div>
        </div> -->
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-6 d-flex align-items-center justify-content-center justify-content-md-start order-2 order-md-1">
          <h5 class="footer-copyright">©{{ Date('Y') }} Kartu Ujian Dot Com</h5>
        </div>
        <!-- <div class="col-md-6 col-lg-6 d-none d-md-flex align-items-center justify-content-end order-1 order-md-2 text-center text-md-right d-none">
          <span href="#" class="footer-number mx-2 mx-md-0 ml-0 ml-md-3">+62 000 0000 0000 (10:00-17:00)</span>
          <a href="#" class="mx-2 mx-md-0 ml-0 ml-md-3">
            <span class="footer-social-media"></span>
          </a>
          <a href="#" class="mx-2 mx-md-0 ml-0 ml-md-3">
            <span class="footer-social-media"></span>
          </a>
        </div> -->
      </div>
    </div>
  </footer>
  <!-- JQUERY -->
  <script src="{{ asset('front/js/jquery-3.5.1.min.js') }}"></script>
  <!-- BOOTSTRAP JS -->
  <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
  <!-- SWIPER JS -->
  <script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
  <!-- HOME JS -->
  <script src="{{ asset('front/js/home.js') }}"></script>
  @stack('js')
</body>
</html>