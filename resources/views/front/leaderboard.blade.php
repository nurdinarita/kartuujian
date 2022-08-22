@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('front/css/leaderboard.css') }}">
@endpush

@section('content')
<header id="header">
	<div class="container-cpns">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1 class="mb-0 mb-sm-4">Top Leaderboard</h1>
				<!-- <h3 class="d-none d-sm-block">10,000 peserta yang telah mengikuti tryout di Kartu Ujian Dot Com</h3> -->
			</div>
		</div>
	</div>
</header>
<!-- MAIN -->
<main id="main">
	<div class="container-cpns">
		<div class="row mb-4">
			<div class="col-lg-12">
				<form method="GET" class="d-flex flex-wrap align-items-center justify-content-between" id="form-filter">
					<div class="position-relative order-2 order-md-1">
						<select id="typeujian" class="form-control" name="t">
							<option value="">Pilih Tryout</option>
							@foreach($tryouts as $k => $v)
							<option @if($tryout == $k) selected="" @endif value="{{ $k }}">{{ $v }}</option>
							@endforeach
						</select>
						<svg class="typeujian-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.41 0L6 4.59L10.59 0L12 1.42L6 7.42L0 1.42L1.41 0Z" fill="#363636" fill-opacity="0.7"/>
						</svg>
					</div>
					<div class="input-group-cpns mb-3 mb-md-0 order-1 order-md-2">
						<button type="buttom">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M7.42857 0C9.39875 0 11.2882 0.782651 12.6814 2.17578C14.0745 3.56891 14.8571 5.45839 14.8571 7.42857C14.8571 9.26857 14.1829 10.96 13.0743 12.2629L13.3829 12.5714H14.2857L20 18.2857L18.2857 20L12.5714 14.2857V13.3829L12.2629 13.0743C10.9149 14.2249 9.20081 14.857 7.42857 14.8571C5.45839 14.8571 3.56891 14.0745 2.17578 12.6814C0.782651 11.2882 0 9.39875 0 7.42857C0 5.45839 0.782651 3.56891 2.17578 2.17578C3.56891 0.782651 5.45839 0 7.42857 0ZM7.42857 2.28571C4.57143 2.28571 2.28571 4.57143 2.28571 7.42857C2.28571 10.2857 4.57143 12.5714 7.42857 12.5714C10.2857 12.5714 12.5714 10.2857 12.5714 7.42857C12.5714 4.57143 10.2857 2.28571 7.42857 2.28571Z" fill="#363636" fill-opacity="0.5"/>
							</svg>
						</button>
						<input type="text" class="form-control" id="nama" placeholder="Cari Nama Peserta..." name="q" value="{{ $query }}">
					</div>
				</form>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Peringkat</th>
								<th>Nama Peserta</th>
								<th>TWK</th>
								<th>TIU</th>
								<th>TKP</th>
								<th>Total Nilai</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							@if(count($datas) == 0)
							<tr>
								<td colspan="7" class="text-center">Belum Ada Peserta</td>
							</tr>
							@endif
							@foreach($datas as $k => $v)
							<tr>
								<td class="table-peringkat">{{ $k+1 }}</td>
								<th>{{ $v->student->name }}</th>
								<td>{{ $v->twk_score ?? 0 }}</td>
								<td>{{ $v->tiu_score ?? 0 }}</td>
								<td>{{ $v->tkp_score ?? 0 }}</td>
								<td>{{ $v->total_score ?? 0 }}</td>
								@if($v->is_graduated)
								<td class="table-keterangan-success">Lulus</td>
								@else
								<td class="table-keterangan-failed">Tidak Lulus</td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		@if(count($datas) > 0)
		{!!  $datas->links() !!}
		@endif
		<!-- <div class="row">
			<div class="col-lg-12 d-flex align-items-center justify-content-end">
				<button class="btn-next-prev">
					<svg class="rotate-180 mr-2" width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11.4224L4.94467 6.47773L0 1.52227L1.52227 0L8 6.47773L1.52227 12.9555L0 11.4224Z" fill="white"/>
					</svg>
					<span>Prev 50</span>
				</button>
				<button class="btn-next-prev ml-4">
					<span>Next 50</span>
					<svg class="ml-2" width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 11.4224L4.94467 6.47773L0 1.52227L1.52227 0L8 6.47773L1.52227 12.9555L0 11.4224Z" fill="white"/>
					</svg>
				</button>
			</div>
		</div> -->
	</div>
</main>
@endsection

@push('js')
<script type="text/javascript">
	$(document).ready(function(){
		$("#typeujian").on("change", function(){
			$("#form-filter").submit();
		})
	})
</script>
@endpush