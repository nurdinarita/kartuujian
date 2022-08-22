@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('front/css/tryout.css') }}">
@endpush

@section('content')
<header id="header">
	<div class="container-cpns">
		@if(count($newest) > 0)
		<div class="row mb-4 mb-md-5">
			<section class="col-lg-12 d-flex align-items-end">
				<h1>Kejar Try Out Terbaru</h1>
				<!-- <p class="ml-3 d-none d-md-block">Berakhir Tanggal <strong>22 Februari 2021</strong></p> -->
			</section>
		</div>
		<div class="row">
			<div class="article-container">
				@foreach($newest as $k => $v)
				<article class="article-data">
					<div class="mb-2">
						<a href="{{ url('tryout/'.$v->slug) }}">
							@if($v->featured)
							<img class="article-img" src="{{ asset('storage/'.$v->featured) }}" alt="#">
							@else
							<img class="article-img" src="{{ asset('front/images/articles/tryout-ecom.png') }}" alt="#">
							@endif
						</a>
					</div>
					<div class="mb-3 px-3">
						<h2><a href="{{ url('tryout/'.$v->slug) }}">{{ $v->title }}</a></h2>
					</div>
					<div class="d-flex mb-3 px-3">
						@if(in_array('terbaru', $v->tags))
						<span class="badge-article badge-terbaru">Terbaru</span>
						@endif
						@if(in_array('gratis', $v->tags))
						<span class="badge-article badge-gratis">Gratis</span>
						@endif
						@if(in_array('best seller', $v->tags))
						<span class="badge-article badge-best">Best Seller</span>
						@endif
						@if(in_array('populer', $v->tags))
						<span class="badge-article badge-populer">Populer</span>
						@endif
					</div>
					{{-- <div class="mb-2 px-3 d-flex align-items-center">
						<img class="article-user-img" src="{{ asset('front/images/website/ujian-image.png') }}" alt="#">
						<strong class="article-user-name">TryoutCPNS</strong>
					</div> --}}
					<div class="px-3">
						<strong class="article-price">{{ $v->price > 0 ? 'Rp '.number_format($v->price, 0 ,',', '.') : 'Gratis' }}</strong>
					</div>
				</article>
				@endforeach
			</div>
		</div>
		@endif
	</div>
</header>
@endsection