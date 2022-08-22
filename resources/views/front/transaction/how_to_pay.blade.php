@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('front/css/keranjang.css') }}">
@endpush

@section('content')
<!-- MAIN -->
<header id="header">
</header>
<div id="main">
	@csrf
	<div class="container-cpns mb-5">
		<div class="row">
			<div class="col-md-12 col-lg-11 mx-auto">
				<div class="row align-items-start">
					<article class="col-md-8 col-lg-8 mb-5 mb-md-0">
						<section>
							<h3 class="mb-4">Instruksi Pembayaran</h3>
						</section>

						@include('includes.notif')

						<div class="main-box">
							
						</div>
					</article>
					<aside class="col-md-4 col-lg-4">
						<section>
							<h3 class="mb-4">Ringkasan</h3>
						</section>
						<div class="main-box"></div>
					</aside>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@push('js')
@endpush