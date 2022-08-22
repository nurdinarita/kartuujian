@extends('layouts.auth')

@section('content')

<div class="row">
    <!-- IMAGE & DESCRIPTION -->
    <div class="col-lg-12 text-center mb-4">
        <img src="{{ asset('front/images/website/tryout-cpns.png') }}" alt="Try Out">
        <p class="main-description">Daftar dan nikmati belajar dengan soal-soal CPNS yang<br class="d-none d-md-block" /> kami sediakan.</p>
    </div>
    <!-- FORM -->
    <div class="col-lg-12 mb-3 mb-md-4">
        <form class="main-form" action="{{ url('register') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukan nama lengkap kamu" name="name" value="{{ old('name') }}">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="domisili">Domisili</label>
                    <input type="text" class="form-control" id="domisili" placeholder="Domisili" name="domisili" value="{{ old('domisili') }}">
                    @error('domisili')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukan email kamu" name="email" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="whatsapp">Nomor WhatsApp</label>
                    <input type="text" class="form-control" id="whatsapp" placeholder="Masukan nomor whatsapp kamu" name="phone" value="{{ old('phone') }}">
                    <small class="main-text-small mt-2">Pastikan email dan nomor WA kamu aktif untuk menerima notifikasi mengenai tryout</small>
                    @error('phone')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-4 mb-md-5">
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="tanggal">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="Pilih tanggal lahir kamu" name="birth_date" value="{{ old('birth_date') }}">
                    @error('birth_date')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="password-1">Kata Sandi</label>
                        <input type="password" class="form-control" id="password-1" placeholder="Masukan kata sandi kamu" name="password">
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password-2">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control" id="password-2" placeholder="Konfirmasi kata sandi kamu" name="password_confirmation">
                        @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button class="main-button" type="submit" name="submit">Daftar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-12 mb-4 mb-md-5 text-center">
        <p class="main-text-bottom">Sudah punya akun? <a href="{{ url('login') }}">Masuk sekarang</a></p>
    </div>
    <!-- LOGIN WITH -->
    <div class="col-lg-12">
        <div class="main-login-with">
            <!-- TEXT -->
            <!-- <div class="text-login-with mb-4 mb-md-5">
                <span class="login-line"></span>
                <p>Atau Daftar Dengan</p>
                <span class="login-line"></span>
            </div> -->
            <!-- GOOGLE & FACEBOOK -->
            <!-- <div class="login-social-media">
                <button type="button" name="google">
                    <img width="25" height="25" src="{{ asset('assets/CPNS/assets/icons/login-google.png') }}" alt="#">
                    <span class="pl-3">Google</span>
                </button>
                <button type="button" name="facebook">
                    <img width="25" height="25" src="{{ asset('assets/CPNS/assets/icons/login-facebook.png') }}" alt="#">
                    <span class="pl-3">Facebook</span>
                </button>
            </div> -->
        </div>
    </div>
</div>
@endsection