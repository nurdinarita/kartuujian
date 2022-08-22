<link rel="stylesheet" href="{{ asset('front/css/hasil-ujian.css') }}">

<div class="container py-4 px-0 px-lg-4">
	<!-- HEAD MODAL -->
	<div class="row lg-px-4 mb-3">
		<div class="col-lg-12 d-flex align-items-center justify-content-between">
			<h5 class="modal-title">Soal Nomor {{ $answer->question_number }}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 1.51071L13.4893 0L7.5 5.98929L1.51071 0L0 1.51071L5.98929 7.5L0 13.4893L1.51071 15L7.5 9.01071L13.4893 15L15 13.4893L9.01071 7.5L15 1.51071Z" fill="#363636" fill-opacity="0.5"/>
				</svg>
			</button>
		</div>
	</div>
	<!-- BODY MODAL: SOAL & JAWABAN -->
	<div class="row lg-pl-4 padding-right mb-4">
		<div class="col-lg-12">
			<!-- SOAL -->
			<div class="modal-soal">
				<p>{{ $question->question }}</p>
			</div>
			<!-- JAWABAN -->
			@foreach($answers as $k => $v)
			<div class="modal-jawaban">
				<strong>{{ chr(65 + $k) }}</strong>
				<p @if($answer->answer == $v->answer) class="modal-jawaban-benar" @endif>{{ $v->answer }}</p>
			</div>
			@endforeach
		</div>
	</div>
	<div class="modal-line mb-4"></div>
	<!-- SOLUSI -->
	<div class="row pl-lg-4 padding-right">
		<div class="col-lg-12 mb-4 pembahasan-tryout">
			@if($answer->correct == 1)
			<span class="status-benar">Benar</span>
			@else
			<span class="status-salah">Salah</span>
			@endif
		</div>
		<div class="col-lg-12 mb-4">
			<h6 class="modal-solusi">Solusi</h6>
		</div>
		<div class="col-lg-12">
			<pre class="solusi-data">{{ $question->solution }}</pre>
		</div>
	</div>
</div>
