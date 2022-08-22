@extends('layouts.auth')

@section('content')
<div class="row">
  <!-- IMAGE & DESCRIPTION -->
  <div class="col-lg-12 text-center mb-4">
    <img src="{{ asset('front/images/website/tryout-cpns.png') }}" alt="Try Out">
    <p class="main-description">Masuk untuk mengerjakan try out gratis dan memilih<br /> program belajar lainnya.</p>
  </div>
  <!-- FORM -->
  <div class="col-lg-12 mb-3 mb-md-4">
   <form class="main-form" action="{{ url('login') }}" method="POST">

    @include('includes.notif')

    @csrf
    <div class="row mb-3">
      <div class="col">
       <label for="email">Email</label>
       <input type="text" class="form-control" id="email" placeholder="Masukan email kamu" name="name">
       @error('email')
       <p class="text-danger">{{ $message }}</p>
       @enderror
       @error('name')
       <p class="text-danger">{{ $message }}</p>
       @enderror
       @error('phone')
       <p class="text-danger">{{ $message }}</p>
       @enderror
     </div>
   </div>
   <div class="row mb-2">
    <div class="col">
     <label for="password">Kata Sandi</label>
     <input type="password" class="form-control" id="password" placeholder="Masukan kata sandi kamu" name="password">
     @error('password')
     <p class="text-danger">{{ $message }}</p>
     @enderror
   </div>
 </div>
 <div class="row mb-4">
  <div class="col text-right">
   <a class="main-forgot" href="{{ url('forgot-password') }}">Lupa kata sandi?</a>
 </div>
</div>
<div class="row">
  <div class="col">
   <button class="main-button" type="submit" name="submit">Masuk</button>
 </div>
</div>
</form>
</div>
<div class="col-lg-12 mb-4 mb-md-5 text-center">
 <p class="main-text-bottom">Belum punya akun? <a href="{{ url('register') }}">Daftar sekarang</a></p>
</div>
<!-- LOGIN WITH -->
<div class="col-lg-12">
 <div class="main-login-with">
  <!-- TEXT -->
  <div class="text-login-with mb-4 mb-md-5">
    <!-- <span class="login-line"></span> -->
    <!-- <p>Atau Login Dengan</p> -->
    <!-- <span class="login-line"></span> -->
  </div>
  <!-- GOOGLE & FACEBOOK -->
  <div class="login-social-media">
        <!-- <button type="button" name="google">
           <img width="25" height="25" src="{{ asset('images/icons/login-google.png') }}" alt="#">
           <span class="pl-3">Google</span>
       </button>
       <button type="button" name="facebook">
           <img width="25" height="25" src="{{ asset('images/icons/login-facebook.png') }}" alt="#">
           <span class="pl-3">Facebook</span>
         </button> -->
       </div>
     </div>
   </div>
 </div>
 @endsection
