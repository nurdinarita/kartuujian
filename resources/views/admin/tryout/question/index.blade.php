@extends('layouts.dashboard')

@section('content')

<div class="card">
	<div class="card-body">
		<h5>{{ $title }}</h5>

		<div class="text-right">
			<a href="{{ url('admin/tryout/question/create') }}" class="btn btn-primary">Tambah Soal</a>
		</div>

		<form class="row mt-3" action="{{ url()->current() }}">
			<div class="col-md-4">
				<select class="form-control" name="category">
					<option value=""></option>
					<option @if($search['category'] == 'twk') selected @endif value="twk">TWK</option>
					<option @if($search['category'] == 'tiu') selected @endif value="tiu">TIU</option>
					<option @if($search['category'] == 'tkp') selected @endif value="tkp">TKP</option>
				</select>
			</div>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="input-group">
					<input type="text" name="q" placeholder="Cari Soal..." class="form-control" value="{{ $search['q'] }}">
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
					<th>Soal</th>
					<th>Jawaban</th>
					<th>Point</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if(count($datas) == 0)
				<tr>
					<td colspan="5" class="text-center">Belum Ada Soal</td>
				</tr>
				@else
				@foreach($datas as $k => $v)
				<tr>
					<td>{{ $k+1 }}</td>
					<td>{{ $v->question }} <span class="badge badge-warning">{{ $v->category }}</span></td>
					<td>
						@if($v->answer)
						<ul style="padding-left: 17px">
							@foreach($v->answer as $answer)
							<li @if($answer->correct and $v->category != 'tkp') class="text-success" @endif>{{ $answer->answer }} @if($v->category == 'tkp')<span class="badge badge-success">( {{ $answer->point }} poin )</span> @endif</li>
							@endforeach
						</ul>
						@endif
					</td>
					<td>@if($v->category == 'tkp') - @else <span class="badge badge-success">{{$v->point}}</span>@endif</td>
					<td>
						<a href="{{ url('admin/tryout/question/'.$v->id.'/edit') }}" class="btn btn-warning btn-sm">
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

		@if(count($datas) > 0)
		{!! $datas->links() !!}
		@endif
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
			$("#form-delete").attr('action', '{{ url("admin/tryout/question") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endpush