@extends('layouts.dashboard')

@section('content')

<div class="card">
	<div class="card-body">
		<h5>{{ $title }}</h5>

		<div class="text-right">
			<a href="{{ url('admin/tryout/tryout/create') }}" class="btn btn-primary">Tambah Tryout</a>
		</div>

		<form class="row mt-3" action="{{ url()->current() }}">
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="input-group">
					<input type="text" name="q" placeholder="Cari Tryout..." class="form-control" value="{{ $search['q'] }}">
					<div class="input-group-append">
						<button class="btn btn-primary">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</div>
		</form>

		<table class="table table-bordered mt-3">
			<thead>
				<tr>
					<th>No</th>
					<th>Tryout</th>
					<th>Waktu</th>
					<th>Soal</th>
					<th>Publikasi</th>
					<th>Harga</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if(count($datas) == 0)
				<tr>
					<td colspan="6" class="text-center">Belum Ada Tryout</td>
				</tr>
				@else
				@foreach($datas as $k => $v)
				<tr>
					<td>{{ $k+1 }}</td>
					<td>{{ $v->title }}</td>
					<td>{{ $v->duration }} mnt</td>
					<td>{{ $v->question }} soal
						<a href="{{ url('admin/tryout/tryout/'.$v->id.'/question') }}" class="btn btn-primary btn-sm">
							<i class="fas fa-plus"></i>
						</a>
					</td>
					<td>
						@if($v->published)
						<span class="text-success">
							<i class="fas fa-check"></i>
						</span>
						@else
						<span class="text-danger">
							<i class="fas fa-times"></i>
						</span>
						@endif
					</td>
					<td>
						{{ $v->price ?? 'Gratis' }}
					</td>
					<td>
						@if($v->published)
						<a href="{{ url('admin/tryout/tryout/'.$v->id.'/publish') }}" class="btn btn-warning btn-sm">
							<i class="fas fa-times"></i>
						</a>
						@else
						<a href="{{ url('admin/tryout/tryout/'.$v->id.'/publish') }}" class="btn btn-success btn-sm">
							<i class="fas fa-check"></i>
						</a>
						@endif
						<a href="{{ url('admin/tryout/tryout/'.$v->id.'/edit') }}" class="btn btn-warning btn-sm">
							<i class="fas fa-edit"></i>
						</a>
						<button class="btn-delete-trigger btn btn-danger btn-sm" data-id="{{ $v->id }}">
							<i class="fas fa-trash"></i>
						</button>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>

	</div>
</div>

@endsection

@push('js')
<div class="modal" id="modal-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Yakin ingin menghapus data ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-delete">Hapus</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<form method="post" id="form-delete">
	@csrf
	<input type="hidden" name="_method" value="DELETE">
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$(".btn-delete-trigger").on("click", function(){
			var id = $(this).data('id');
			$("#form-delete").attr('action', '{{ url("admin/tryout/tryout") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endpush