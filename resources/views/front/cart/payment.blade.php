@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('front/css/keranjang.css') }}">
@endpush

@section('content')
<header id="header">
	<div class="container-cpns">
		<div class="row">
			<div class="col-lg-12 d-flex justify-content-center align-items-center">
				<a href="#" class="header-nav-link"><span>1.</span> Pilih tryout</a>
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
				<a href="#" class="header-nav-link header-nav-active"><span>3.</span> Metode pembayaran</a>
			</div>
		</div>
	</div>
</header>
<!-- MAIN -->
<main id="main">
	<div class="container-cpns">
		<div class="row">
			<div class="col-md-12 col-lg-11 mx-auto">
				<div class="row align-items-start">
					<article class="col-md-8 col-lg-8 mb-5 mb-md-0">
						<section>
							<h3 class="mb-4">Metode Pembayaran</h3>
						</section>
						<div class="main-box">
							@include('includes.notif')
							<!-- VIRTUAL ACCOUNT -->
							@if(isset($methods['instant']))
							<div class="pb-3">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<strong class="tryout-keranjang">Virtual Account</strong>
									<button type="button" class="lihat-semua-pembayaran toggle-payment" data-target="#instant">
										<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1.41 0L6 4.59L10.59 0L12 1.42L6 7.42L0 1.42L1.41 0Z" fill="black"/>
										</svg>
									</button>
								</div>
								<div class="payment-section" id="instant">
									<div class="d-flex justify-content-between align-items-center flex-wrap">
										@foreach($methods['instant'] as $k => $v)
										<div class="payment-virtual-account" data-payment="{{ $v->request_code }}">
											<img src="{{ asset($v->icon) }}" alt="#">
											<strong>{{ $v->service_name }}</strong>
										</div>
										@endforeach
									</div>
								</div>
							</div>
							@endif
							<!-- QRIS -->
							@if(isset($methods['ewallet']))
							<div class="border-t-1px py-3">
								<div class="d-flex align-items-center justify-content-between">
									<strong class="tryout-keranjang">QRIS</strong>
									<button type="button" class="lihat-semua-pembayaran toggle-payment" data-target="#ewallet">
										<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1.41 0L6 4.59L10.59 0L12 1.42L6 7.42L0 1.42L1.41 0Z" fill="black"/>
										</svg>
									</button>
								</div>
								<div class="payment-section" id="ewallet">
									<div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
										@foreach($methods['ewallet'] as $k => $v)
										<div class="payment-virtual-account" data-payment="{{ $v->request_code }}">
											<img src="{{ asset($v->icon) }}" alt="#">
											<strong>{{ $v->service_name }}</strong>
										</div>
										@endforeach
									</div>
								</div>
							</div>
							@endif
							<!-- MINIMARKET -->
							@if(isset($methods['stores']))
							<div class="border-t-1px py-3">
								<div class="d-flex align-items-center justify-content-between">
									<strong class="tryout-keranjang">Minimarket</strong>
									<button type="button" class="lihat-semua-pembayaran toggle-payment" data-target="#stores">
										<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1.41 0L6 4.59L10.59 0L12 1.42L6 7.42L0 1.42L1.41 0Z" fill="black"/>
										</svg>
									</button>
								</div>
								<div class="payment-section" id="stores">
									<div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
										@foreach($methods['stores'] as $k => $v)
										<div class="payment-virtual-account" data-payment="{{ $v->request_code }}">
											<img src="{{ asset($v->icon) }}" alt="#">
											<strong>{{ $v->service_name }}</strong>
										</div>
										@endforeach
									</div>
								</div>
							</div>
							@endif
						</div>
					</article>
					<aside class="col-md-4 col-lg-4">
						<section>
							<h3 class="mb-4">Ringkasan</h3>
						</section>
						<form class="main-box" action="{{ url('cart/payment') }}" method="post">
							@csrf
							<!-- <div class="border-b-1px pb-3">
								<button type="button" class="btn-tambah-kode" data-button-voucher="off">Tambahkan kode promo</button>
								<input id="voucher-input" type="text" class="form-control" placeholder="Tambahkan kode promo">
							</div> -->
							<div class="border-b-1px py-3">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<strong class="subtotal-admin">Subtotal<span>({{ count($datas) }})</span></strong>
									<span class="subtotal-admin">Rp {{ $total }}</span>
								</div>
								<div class="d-flex align-items-center justify-content-between mb-3">
									<strong class="subtotal-admin">Admin</strong>
									<span class="subtotal-admin" id="subtotal-admin">Rp 0</span>
								</div>
								<!-- <div class="d-flex align-items-center justify-content-between mb-3">
									<strong class="subtotal-admin">Voucher</strong>
									<span class="subtotal-admin subtotal-admin-voucher">-Rp50.000</span>
								</div> -->
							</div>
							<div class="pt-3">
								<div class="d-flex align-items-center justify-content-between mb-3">
									<strong class="total-title">Total</strong>
									<span class="total-price" id="total-price">Rp {{ $total }}</span>
								</div>
								<p class="mb-4">Dengan membeli tryout ini, Saya menyetujui <a href="#">syarat dan ketentuan yang berlaku.</a></p>
								<input type="hidden" name="payment" id="payment">
								<button type="submit" class="btn-beli btn-beli-active py-2">Beli Try Out</button>
							</div>
						</form>
					</aside>
				</div>
			</div>
		</div>
	</div>
</main>

@include('includes.loading')
@endsection

@push('js')
<script type="text/javascript">
	var fee = 0;

	$(".payment-section").hide();
	$("#instant").show();

	$(document).ready(function(){
		$(".payment-virtual-account").on("click", function(){
			$(".payment-virtual-account.payment-virtual-account-active").removeClass("payment-virtual-account-active");
			$(this).addClass("payment-virtual-account-active");

			let data = $(this).data('payment');
			$("#payment").val(data);

			$(".overflow").css('display', 'flex');
			$.ajax({
				url: '{{ url("payment/fee") }}',
				method: 'POST',
				data: {
					_token: '{{ csrf_token() }}',
					payment_code: data.split("-")[1],
					total: {{ $total }},
				},
				success: function(d){
					if(d){
						console.log(d);
						$("#subtotal-admin").html("Rp " + d);
						$("#total-price").html("Rp " + (parseInt({{ $total }}) + parseInt(d)));
					}
					$(".overflow").css('display', 'none');
				},
				error: function(e){
					console.log(e);
					$(".overflow").css('display', 'none');
				}
			});

		})

		$(".toggle-payment").on("click", function(){
			let target = $(this).data('target');

			$(".payment-section").hide();
			$(target).show();
		});
	})
</script>
@endpush