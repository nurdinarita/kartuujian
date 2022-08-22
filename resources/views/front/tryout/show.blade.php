@extends('layouts.app')

@push('meta')
	<meta name="description" content="{{ $data->title }}">
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('front/css/deskripsi-ujian.css') }}">
@endpush

@section('content')
<main id="main">
	<div class="container-cpns">
		<div class="row">
			<div class="col-lg-12 col-lg-11 mx-auto">
				<div class="row align-items-start">
					<article class="col-md-8 col-lg-9">
						@include('includes.notif')
						<div class="mb-4">
							@if($data->featured)
							<img class="main-primary-img" src="{{ asset('storage/'.$data->featured) }}" alt="#">
							<img class="main-primary-img-mobile" src="{{ asset('storage/'.$data->featured) }}" alt="#">
							@else
							<img class="main-primary-img" src="{{ asset('front/images/articles/tryout-ecom.png') }}" alt="#">
							<img class="main-primary-img-mobile" src="{{ asset('front/images/articles/tryout-ecom.png') }}" alt="#">
							@endif
						</div>
						@if($result)
						<div class="alert alert-primary">
							<p>Anda sudah pernah mengerjakan ujian ini, <a href="{{ url('/result/'.$slug) }}">klik untuk melihat hasil ujian</a></p>
						</div>
						@endif
						<!-- PRICE & LOVE -->
						<div class="mb-2 d-flex d-md-none align-items-center justify-content-between px-3 px-md-0">
							<div class="main-box-price">
								<strong>Rp {{ number_format($data->price, 0, ',', '.') }}</strong>
							</div>
							<div>
								<button type="button" class="bg-transparent">
									<svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M12.5 22.9375L10.6875 21.2875C4.25 15.45 0 11.5875 0 6.875C0 3.0125 3.025 0 6.875 0C9.05 0 11.1375 1.0125 12.5 2.6C13.8625 1.0125 15.95 0 18.125 0C21.975 0 25 3.0125 25 6.875C25 11.5875 20.75 15.45 14.3125 21.2875L12.5 22.9375Z" fill="#363636" fill-opacity="0.5"/>
									</svg>
								</button>
							</div>
						</div>
						<section class="mb-4 mb-md-5 px-3 px-md-0">
							<h1>{{ $data->title }}</h1>
						</section>
						<div class="mb-4 mb-md-5 d-flex justify-content-between align-items-center px-3 px-md-0">
							<div class="d-flex align-items-center">
								<img class="img-profile" src="{{ asset('front/images/website/ujian-image.png') }}" alt="#">
								<span class="user-profile ml-3">Tryout</span>
							</div>
							<div class="d-none d-md-flex align-items-center">
								<!-- <button class="btn-heart-share">
									<svg class="mr-2" width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.25613 12.7112L8.17439 12.7929L8.08447 12.7112C4.20164 9.18801 1.63488 6.85831 1.63488 4.49591C1.63488 2.86104 2.86104 1.63488 4.49591 1.63488C5.75477 1.63488 6.98093 2.45232 7.41417 3.56403H8.93461C9.36785 2.45232 10.594 1.63488 11.8529 1.63488C13.4877 1.63488 14.7139 2.86104 14.7139 4.49591C14.7139 6.85831 12.1471 9.18801 8.25613 12.7112ZM11.8529 0C10.4305 0 9.0654 0.662125 8.17439 1.70027C7.28338 0.662125 5.91826 0 4.49591 0C1.9782 0 0 1.97003 0 4.49591C0 7.57766 2.77929 10.1035 6.9891 13.921L8.17439 15L9.35967 13.921C13.5695 10.1035 16.3488 7.57766 16.3488 4.49591C16.3488 1.97003 14.3706 0 11.8529 0Z" fill="#363636"/>
									</svg>
									<span>Wishlist</span>
								</button> -->
								<!-- LINE -->
								<!-- <span class="line-heart-share"></span>
								<button class="btn-heart-share">
									<svg class="mr-2" width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M18 7L11 0V4C4 5 1 10 0 15C2.5 11.5 6 9.9 11 9.9V14L18 7Z" fill="#363636"/>
									</svg>
									<span>Bagikan</span>
								</button> -->
							</div>
						</div>
						<!-- LINE MOBILE -->
						<div class="line-mobile-7px mb-4 px-3 px-md-0"></div>
						<div class="nav-description mb-5 px-3 px-md-0">
							<button type="button" class="btn-tab btn-active" data-button="deskripsi">Deskripsi</button>
							<button type="button" class="btn-tab" data-button="syarat">Syarat & Ketentuan</button>
						</div>
						<div class="data-description px-3 px-md-0">
							<!-- DESKRIPSI -->
							<div class="data-description-deskripsi">
								<h5 class="d-block d-md-none">Deskripsi Tryout</h5>
								<p>{{ $data->description ?? '-' }}</p>
							</div>
							<!-- MOBILE VERSION MULAI TRYOUT -->
							<div class="d-md-none">
								<!-- BELI TRYOUT -->
								<form method="post" class="my-3 d-flex d-md-none align-items-center justify-content-between">
									@csrf
									<input type="hidden" name="id" value="{{ $data->id }}">
									<button class="plus-keranjang w-100">Beli Tryout</button>
								</form>

								<p class="text-center main-box-text-bottom">Sudah punya token ?</p>
								<!-- MULAI TRYOUT -->
								<form action="{{ url()->current().'/token' }}" method="post" class="my-3 d-md-none align-items-center justify-content-between">
									@csrf
									<input type="hidden" name="id" value="{{ $data->id }}">
									<input type="text" name="token" class="form-control masukan-kode-token" placeholder="Masukan token disini" required="">
									<button class="mulai-tryout">Mulai Tryout</button>
								</form>
							</div>
							<!-- Syarat & Ketentuan -->
							<div class="data-description-syarat">
								<h5 class="d-block d-md-none">Syarat & Ketentuan</h5>
								<p>{{ $data->privacy_policy ?? '-' }}</p>
							</div>
						</div>
					</article>
					<aside class="col-md-4 col-lg-3 py-4 d-none d-md-block">
						<div class="main-box">
							<div class="mb-4 px-2">
								<h2>{{ $data->title }}</h2>
							</div>
							<div class="main-box-list mb-2 px-2">
								<svg class="mr-2" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.5 15.3C12.24 15.3 15.3 12.24 15.3 8.5C15.3 4.76 12.24 1.7 8.5 1.7C4.76 1.7 1.7 4.76 1.7 8.5C1.7 12.24 4.76 15.3 8.5 15.3ZM8.5 0C13.175 0 17 3.825 17 8.5C17 13.175 13.175 17 8.5 17C3.825 17 0 13.175 0 8.5C0 3.825 3.825 0 8.5 0ZM8.925 4.25V8.67L6.63 12.75L5.525 12.07L7.65 8.33V4.25H8.925Z" fill="#363636"/>
								</svg>
								<span>Durasi selama {{ $data->duration }} menit</span>
							</div>
							<div class="main-box-list mb-2 px-2">
								<svg class="mr-2" width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.5 0H1.7C1.24913 0 0.81673 0.179107 0.497918 0.497918C0.179107 0.81673 0 1.24913 0 1.7V15.3C0 16.2435 0.7565 17 1.7 17H11.9C12.8435 17 13.6 16.2435 13.6 15.3V5.1L8.5 0ZM11.9 15.3H1.7V1.7H7.65V5.95H11.9V15.3ZM9.35 9.35C9.35 10.9565 7.4375 11.1095 7.4375 12.546H6.1625C6.1625 10.472 8.075 10.625 8.075 9.35C8.075 8.653 7.5055 8.075 6.8 8.075C6.0945 8.075 5.525 8.653 5.525 9.35H4.25C4.25 7.9475 5.389 6.8 6.8 6.8C8.211 6.8 9.35 7.9475 9.35 9.35ZM7.4375 13.175V14.45H6.1625V13.175H7.4375Z" fill="#363636"/>
								</svg>
								<span>Jumlah soal {{ $data->question }} buah</span>
							</div>
							<div class="main-box-list mb-2 px-2">
								<svg class="mr-2" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M13.6146 1.68359H10.0578C9.57276 0.356166 8.10919 -0.324563 6.80729 0.151948C6.07551 0.407221 5.53093 0.968823 5.25863 1.68359H1.70182C1.25047 1.68359 0.817606 1.86289 0.498452 2.18204C0.179299 2.50119 0 2.93406 0 3.38541V15.2982C0 15.7495 0.179299 16.1824 0.498452 16.5015C0.817606 16.8207 1.25047 17 1.70182 17H13.6146C14.0659 17 14.4988 16.8207 14.818 16.5015C15.1371 16.1824 15.3164 15.7495 15.3164 15.2982V3.38541C15.3164 2.93406 15.1371 2.50119 14.818 2.18204C14.4988 1.86289 14.0659 1.68359 13.6146 1.68359ZM7.65821 1.68359C7.88388 1.68359 8.10031 1.77324 8.25989 1.93281C8.41947 2.09239 8.50912 2.30882 8.50912 2.5345C8.50912 2.76018 8.41947 2.97661 8.25989 3.13619C8.10031 3.29576 7.88388 3.38541 7.65821 3.38541C7.43253 3.38541 7.2161 3.29576 7.05652 3.13619C6.89694 2.97661 6.80729 2.76018 6.80729 2.5345C6.80729 2.30882 6.89694 2.09239 7.05652 1.93281C7.2161 1.77324 7.43253 1.68359 7.65821 1.68359ZM3.40365 5.08724H11.9128V3.38541H13.6146V15.2982H1.70182V3.38541H3.40365V5.08724ZM11.9128 8.49088H3.40365V6.78906H11.9128V8.49088ZM10.2109 11.8945H3.40365V10.1927H10.2109V11.8945Z" fill="#363636"/>
								</svg>
								<span>Leaderboard</span>
							</div>
							<div class="main-box-list mb-4 px-2">
								<svg class="mr-2" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M3.4 8.5H5.1V10.2H3.4V8.5ZM15.3 3.4V15.3C15.3 15.7509 15.1209 16.1833 14.8021 16.5021C14.4833 16.8209 14.0509 17 13.6 17H1.7C1.24913 17 0.81673 16.8209 0.497918 16.5021C0.179107 16.1833 0 15.7509 0 15.3V3.4C0 2.94913 0.179107 2.51673 0.497918 2.19792C0.81673 1.87911 1.24913 1.7 1.7 1.7H2.55V0H4.25V1.7H11.05V0H12.75V1.7H13.6C14.0509 1.7 14.4833 1.87911 14.8021 2.19792C15.1209 2.51673 15.3 2.94913 15.3 3.4ZM1.7 5.1H13.6V3.4H1.7V5.1ZM13.6 15.3V6.8H1.7V15.3H13.6ZM10.2 10.2V8.5H11.9V10.2H10.2ZM6.8 10.2V8.5H8.5V10.2H6.8ZM3.4 11.9H5.1V13.6H3.4V11.9ZM10.2 13.6V11.9H11.9V13.6H10.2ZM6.8 13.6V11.9H8.5V13.6H6.8Z" fill="#363636"/>
								</svg>
								<span>{{ Date('d/m/Y', strtotime($data->date)) }}</span>
							</div>
							<div class="main-box-price mb-4 px-2">
								<strong>{{ $data->price > 0 ? 'Rp'.number_format($data->price, 0, ',', '.') : 'Gratis' }}</strong>
							</div>
							<div>
								<div class="row mb-3">
									<div class="col">
										<form action="{{ url()->current().'/token' }}" method="post" class="px-2">
											@csrf
											<input type="hidden" name="id" value="{{ $data->id }}">
											<input type="text" class="form-control" placeholder="Masukan Token" name="token" required="">
											<button class="w-100 mt-2" type="submit">Mulai Ujian</button>
										</form>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col">
										<form method="post" class="px-2">
											@csrf
											<input type="hidden" name="id" value="{{ $data->id }}">
											<p class="main-box-text-bottom text-center">Belum punya token?</p>
											<button class="w-100 mt-2">Beli Tryout</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@push('js')
<script src="{{ asset('front/js/tryout.js') }}"></script>
@endpush