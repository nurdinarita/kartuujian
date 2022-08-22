@extends('layouts.dashboard')

@section('content')

<div class="card">
	<div class="card-body">
		<h5>{{ $title }}</h5>

		<form class="row mt-3" action="{{ url()->current() }}" id="form-search">
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<input type="text" name="q" value="{{ $query }}" placeholder="Cari ..." class="form-control">
			</div>
		</form>

		<table class="table table-bordered mt-3">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Lengkap</th>
					<th>Tryout</th>
					<th>Nilai TWK</th>
					<th>Nilai TIU</th>
					<th>Nilai TKP</th>
					<th>Total Nilai</th>
				</tr>
			</thead>
			<tbody>
				@if(count($datas) == 0)
				<tr>
					<td colspan="7" class="text-center">Belum Ada Ujian</td>
				</tr>
				@else
				@foreach($datas as $k => $v)
				<tr>
					<td>{{ $k+1 }}</td>
					<td>{{ $v->student->name }}</td>
					<td>{{ $v->tryout->title }}</td>
					<td>{{ $v->twk_score ?? 0 }}</td>
					<td>{{ $v->tui_score ?? 0 }}</td>
					<td>{{ $v->tkp_score ?? 0 }}</td>
					<td>{{ $v->total_score ?? 0 }}</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
		
		{!!  $datas->links() !!}
	</div>
</div>
@endsection

@push('js')
<script type="text/javascript">
	$(document).ready(function(){
		$("#status").on("change", function(){
			$("#form-search").submit();
		})
	})
</script>
@endpush