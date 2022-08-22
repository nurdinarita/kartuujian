@extends('layouts.dashboard')

@section('content')

<div class="card">
	<div class="card-body">
		<h5>{{ $title }}</h5>

		<div class="text-right">
			<a href="{{ url('admin/member/export') }}" class="btn btn-primary">Export Ke Excel</a>
		</div>

		<table class="table table-bordered mt-3">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Lengkap</th>
					<th>Tanggal Lahir</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Domisili</th>
					<th>Tanggal Daftar</th>
				</tr>
			</thead>
			<tbody>
				@if(count($datas) == 0)
				<tr>
					<td colspan="7" class="text-center">Belum Member</td>
				</tr>
				@else
					@foreach($datas as $k => $v)
					<tr>
						<td>{{ $k+1 }}</td>
						<td>{{ $v->name }}</td>
						<td>{{ date("d/m/Y", strtotime($v->birth_date))  }}</td>
						<td>{{ $v->email }}</td>
						<td>{{ $v->phone }}</td>
						<td>{{ $v->domisili }}</td>
						<td>{{ $v->created_at }}</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{!!  $datas->links() !!}
	</div>
</div>
@endsection