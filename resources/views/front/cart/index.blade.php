@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('front/css/keranjang.css') }}">
@endpush

@section('content')
<header id="header">
	<div class="container-cpns">
		<div class="row">
			<div class="col-lg-12 d-flex justify-content-center align-items-center">
				<a href="#" class="header-nav-link header-nav-active"><span>1.</span> Pilih tryout</a>
				<div class="header-arrow-right">
					<svg width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11.4617L4.96167 6.5L0 1.5275L1.5275 0L8.0275 6.5L1.5275 13L0 11.4617Z" fill="black" fill-opacity="0.25"/>
					</svg>
				</div>
				<a href="#" class="header-nav-link"><span>2.</span> Periksa</a>
				<div class="header-arrow-right">
					<svg width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11.4617L4.96167 6.5L0 1.5275L1.5275 0L8.0275 6.5L1.5275 13L0 11.4617Z" fill="black" fill-opacity="0.25"/>
					</svg>
				</div>
				<a href="#" class="header-nav-link"><span>3.</span> Metode pembayaran</a>
			</div>
		</div>
	</div>
</header>
<!-- MAIN -->
<form method="post" id="main">
	@csrf
	<div class="container-cpns">
		<div class="row">
			<div class="col-md-12 col-lg-11 mx-auto">
				<div class="row align-items-start">
					<article class="col-md-8 col-lg-8 mb-5 mb-md-0">
						<section>
							<h3 class="mb-4">Keranjang</h3>
						</section>

						@if(count($datas) == 0)
						<div class="text-center">
							<h5>Belum Ada Item</h5>
						</div>
						@else
						<div class="main-box">
							@include('includes.notif')
							<div class="d-flex align-items-center pb-3">
								<div class="form-check">
									<input id="pilih-semua-check" class="form-check-input" type="checkbox" value="yes">
									<label class="form-check-label ml-2" for="pilih-semua-check">Pilih Semua</label>
								</div>
							</div>
							@foreach($datas as $k => $v)
							<!-- KERANJANG LIST -->
							<div class="position-relative border-t-1px py-4">
								<div class="form-check">
									<input class="form-check-input form-check-input-item" type="checkbox" name="item[{{$v->id}}]" value="{{ $v->id }}" data-price="{{ $v->item->price }}">
								</div>
								<div class="article-data">
									<div class="article-data-img">
										@if($v->item->featured)
										<img src="{{ asset('storage/'.$v->item->featured) }}" alt="#">
										@else
										<img src="{{ asset('front/images/articles/keranjang-1.png') }}" alt="#">
										@endif
									</div>
									<div class="ml-0 ml-md-3">
										<h2 class="mb-2">
											<a href="#">{{ $v->item->title }}</a>
										</h2>
										<strong>Rp {{ $v->item->price ?? 'Gratis' }}</strong>
									</div>
								</div>
								<a href="{{ url('cart/'.$v->id.'/remove') }}" type="button" class="btn-delete-item">
									<svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M5 0V1H0V3H1V16C1 16.5304 1.21071 17.0391 1.58579 17.4142C1.96086 17.7893 2.46957 18 3 18H13C13.5304 18 14.0391 17.7893 14.4142 17.4142C14.7893 17.0391 15 16.5304 15 16V3H16V1H11V0H5ZM3 3H13V16H3V3ZM5 5V14H7V5H5ZM9 5V14H11V5H9Z" fill="#363636" fill-opacity="0.5"/>
									</svg>
								</a>
							</div>
							@endforeach
						</div>
						@endif
					</article>
					<aside class="col-md-4 col-lg-4">
						<section>
							<h3 class="mb-4">Ringkasan</h3>
						</section>
						<form class="main-box">
							<!-- <div class="border-b-1px pb-3">
								<button type="button" class="btn-tambah-kode" data-button-voucher="off">Tambahkan kode promo</button>
								<input id="voucher-input" type="text" class="form-control" placeholder="Tambahkan kode promo">
							</div> -->
							<div class="border-b-1px py-3">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<strong class="subtotal-admin">Subtotal<span></span></strong>
									<span class="subtotal">Rp0</span>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<strong class="subtotal-admin">Admin</strong>
									<span class="subtotal-admin">-</span>
								</div>
							</div>
							<div class="pt-3">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<strong class="total-title">Total</strong>
									<span class="total-price">-</span>
								</div>
								<p class="mb-4">Dengan membeli tryout ini, Saya menyetujui <a href="#">syarat dan ketentuan yang berlaku.</a></p>
								<button href="{{ url('cart/payment') }}" id="btn-submit-keranjang" type="submit" class="btn-beli py-2" disabled>Beli</button>
							</div>
						</form>
					</aside>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection

@push('js')
<script src="{{ asset('front/js/keranjang.js') }}"></script>
@endpush