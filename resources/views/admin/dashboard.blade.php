@extends('layouts.dashboard')

@section('content')

<div class="row stats-row">
	<div class="col-lg-4 col-md-12">
		<div class="card card-transparent stats-card">
			<div class="card-body">
				<div class="stats-info">
					<h5 class="card-title">{{ $question }}</h5>
					<p class="stats-text">Soal tersedia</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-12">
		<div class="card card-transparent stats-card">
			<div class="card-body">
				<div class="stats-info">
					<h5 class="card-title">{{ $tryout }}</h5>
					<p class="stats-text">Tryout Siap</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-12">
		<div class="card card-transparent stats-card">
			<div class="card-body">
				<div class="stats-info">
					<h5 class="card-title">{{ $student }}<h5>
						<p class="stats-text">Pendaftar Aktif</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endsection