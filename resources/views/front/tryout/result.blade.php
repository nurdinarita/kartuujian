@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('front/css/hasil-ujian.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
@endpush

@section('content')
<header id="header">
	<div class="container-cpns">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Terima Kasih<br class="d-block d-md-none" /> Atas Partisipasi Anda</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 d-flex flex-wrap justify-content-between">
				<div class="header-user-info order-2 order-md-1">
					<div>
						<span class="header-user-info-left">Nama Ujian</span>
						<span class="header-user-info-right">: {{ $tryout->title }}</span>
					</div>
					<div>
						<span class="header-user-info-left">Nama Lengkap</span>
						<span class="header-user-info-right">: {{ $user->account()->name }}</span>
					</div>
					<div>
						<span class="header-user-info-left">Alamat Email</span>
						<span class="header-user-info-right">: {{ $user->email }}</span>
					</div>
					<div>
						<span class="header-user-info-left">Hari/Tanggal</span>
						<span class="header-user-info-right">: {{ Date('D, d F Y', strtotime($studentTryout->finish_at)) }}</span>
					</div>
				</div>
				<div class="header-user-hasil order-1 order-md-2">
					@if($studentTryout->twk_score >= $tryout->twk_passing_grade and $studentTryout->tui_score >= $tryout->tiu_passing_grade and $studentTryout->tkp_score >= $tryout->tkp_passing_grade)
					<div class="header-user-hasil-data hasil-data-lulus">
						<div class="mr-2">
							<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9 0C4.05 0 0 4.05 0 9C0 13.95 4.05 18 9 18C13.95 18 18 13.95 18 9C18 4.05 13.95 0 9 0ZM7.2 13.5L2.7 9L3.969 7.731L7.2 10.953L14.031 4.122L15.3 5.4L7.2 13.5Z" fill="#00AF50"/>
							</svg>
						</div>
						<div>
							<strong>Selamat</strong>
							<p>Selamat Anda Memenuhi Passing Grade.</p>
						</div>
					</div>
					@else
					<div class="header-user-hasil-data hasil-data-gak-lulus">
						<div class="mr-2">
							<i class="fas fa-times-circle text-danger"></i>
						</div>
						<div>
							<strong>Mohon Maaf</strong>
							<p>Nilai Anda Belum Memenuhi Passing Grade.</p>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</header>
<!-- MAIN -->
<main id="main">
	<div class="container-cpns">
		<div class="row">
			<div class="main-cover-hasil col-lg-12 d-flex flex-wrap justify-content-between">
				<div>
					<p>Total Soal yang<br />Dijawab</p>
					<strong>{{ $counters['answered'] }}/{{ $counters['questions'] }}</strong>
				</div>
				<div>
					<p>Tes Wawasan<br />Kebangsaan</p>
					<strong>{{ $studentTryout->twk_score ?? 0 }}</strong>
				</div>
				<div>
					<p>Tes Intelejisia<br />Umum</p>
					<strong>{{ $studentTryout->tui_score ?? 0 }}</strong>
				</div>
				<div>
					<p>Tes Karakteristik<br />Pribadi</p>
					<strong>{{ $studentTryout->tkp_score ?? 0 }}</strong>
				</div>
				<div>
					<p>Total Nilai</p>
					<strong>{{ $studentTryout->total_score ?? 0 }}</strong>
				</div>
				<div>
					<p>Waktu yang<br />Dibutuhkan</p>
					<strong>{{ $timer }}</strong>
				</div>
			</div>
		</div>
		<!-- DATA HASIL: CHARTJS -->
		<div class="row">
			<div class="col-md-12 col-lg-10 d-flex flex-wrap justify-content-center align-items-center mx-auto">
				<!-- PIE DATA -->
				<div id="canvas-holder" class="mx-auto mr-sm-4 mr-md-3 mr-lg-5 mb-0 mb-sm-4 mb-md-0">
					<canvas id="chart-area" width="100" height="100"></canvas>
				</div>
				<!-- KUBUS -->
				<div class="main-hasil-kubus">
					<div class="mb-3 mb-md-4 d-flex align-items-center">
						<div class="jawaban-benar"></div>
						<span>Jawaban Benar</span>
					</div>
					<div class="mb-3 mb-md-4 d-flex align-items-center">
						<div class="jawaban-salah"></div>
						<span>Jawaban Salah</span>
					</div>
					<div class="mb-3 mb-md-4 d-flex align-items-center">
						<div class="tidak-dijawab"></div>
						<span>Tidak Dijawab</span>
					</div>
				</div>
				<!-- LIST DATA -->
				<div class="main-hasil-data">
					<table class="table">
						<tbody>
							<tr>
								<th>Jumlah Soal</th>
								<td>{{ $counters['questions'] }}</td>
							</tr>
							<tr>
								<th>Total Soal yang Dijawab</th>
								<td>{{ $counters['answered'] }}</td>
							</tr>
							<tr>
								<th>Jawaban Benar</th>
								<td>{{ $counters['correct'] }}</td>
							</tr>
							<tr>
								<th>Jawaban Salah</th>
								<td>{{ $counters['wrong'] }}</td>
							</tr>
							<tr>
								<th>Tidak Dijawab</th>
								<td>{{ $counters['notAnswered'] }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- PEMBAHASAN SOAL-->
		<div class="row pembahasan-tryout">
			<div class="col-lg-12 d-flex flex-wrap justify-content-between align-items-center mb-4">
				<form class="tes-wawasan-download mb-3 mb-md-0" id="form-filter">
					<div class="position-relative">
						<select id="soal" class="form-control" name="type">
							<option @if($type == 'twk') selected="" @endif value="twk">Tes Wawasan Kebangsaan</option>
							<option @if($type == 'tiu') selected="" @endif value="tiu">Tes Intelejisia Umum</option>
							<option @if($type == 'tkp') selected="" @endif value="tkp">Tes Karakteristik Pribadi</option>
						</select>
						<svg class="domisili-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.41 0L6 4.59L10.59 0L12 1.42L6 7.42L0 1.42L1.41 0Z" fill="#363636" fill-opacity="0.7"/>
						</svg>
					</div>
				</form>
				<div class="tes-wawasan-download">
					<a href="{{ url()->current().'/download' }}" class="download-pembahasan" target="_blank">
						<svg class="mr-3" width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 10H2V15H18V10H20V15C20 16.11 19.11 17 18 17H2C1.46957 17 0.960859 16.7893 0.585786 16.4142C0.210714 16.0391 0 15.5304 0 15V10ZM10 13L15.55 7.54L14.13 6.13L11 9.25V0H9V9.25L5.88 6.13L4.46 7.55L10 13Z" fill="#2D6187"/>
						</svg>
						<span>Download Pembahasan</span>
					</a>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Soal</th>
								<th>Jawaban Anda</th>
								<th>Jawaban Benar</th>
								<th>Status</th>
								<th>Kunci</th>
							</tr>
						</thead>
						<tbody>
							@if(count($questions) == 0)
							<tr>
								<td colspan="6" class="text-center">Tidak Ada Soal</td>
							</tr>
							@else
							@foreach($questions as $k => $v)
							<tr>
								<td class="pembahasan-no">{{ $v->myAnswer->question_number }}</td>
								<td class="pembahasan-soal">{{ $v->question }}</td>
								<td class="pembahasan-jawaban-anda">{{ ($v->myAnswer) ? $v->myAnswer->answer : '-' }}</td>
								<td class="pembahasan-jawaban-benar">{{ ($v->answer) ? $v->answer->answer : '-' }}</td>
								<td class="pembahasan-status">
									<?php $status = ($v->myAnswer) ? ($v->myAnswer->correct == 1 ? 'Benar' : 'Salah') : '-'; ?>
									@if($status == 'Benar')
									<span class="status-benar">Benar</span>
									@else
									<span class="status-salah">Salah</span>
									@endif
								</td>
								<td class="pembahasan-kunci">
									<button type="button" data-id="{{ $v->myAnswer->id }}" name="modal-open" data-toggle="modal" data-target="#pembahasanModal">Lihat</button>
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>
<!-- MODAL -->
<div class="modal fade" id="pembahasanModal" tabindex="-1" aria-labelledby="pembahasanModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-body" id="m-body">
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
<script type="text/javascript">
	// CART PIE
	let jawabanBenar = {{ $counters['correct'] }};
	let jawabanSalah = {{ $counters['wrong'] }};
	let tidakDiJawab = {{ $counters['notAnswered'] }};
</script>
<script src="{{ asset('front/js/chart-2.9.4.js') }}"></script>
<!-- ULTIS CART JS -->
<script src="{{ asset('front/js/ultis-chart.js') }}"></script>
<!-- HASIL UJIAN JS -->
<script src="{{ asset('front/js/hasil-ujian.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		// PINDAH DATA KE MODAL
		$('.pembahasan-tryout').on('click', '.pembahasan-kunci button', function() {
			let loading = '<div class="text-center p-4"><h3><i class="fas fa-spin fa-spinner"></i></h3></div>';
			let id = $(this).data('id');

			$("#m-body").html(loading);
			$("#pembahasanModal").modal("show");

			$.ajax({
				url: '{{ url()->current()."/answer" }}' + "/" + id,
				success: function(d){
					if(d.success){
						$("#m-body").html(d.data);
					}else{
						$("#m-body").html(d.message);
					}
				},
				error: function(e){
					console.log(e);
					$("#m-body").html("Gagal memuat kunci jawaban");
				}
			})
		});

		$("#soal").on("change", function(){
			$("#form-filter").submit();
		})
	})
</script>
@endpush