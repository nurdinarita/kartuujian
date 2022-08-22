@extends('layouts.dashboard')

@push('css')
<link href="{{ asset('dashboard/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="card">
	<div class="card-body">
		<h5 class="mb-3">{{ $title }}</h5>

		<a href="{{ url('admin/tryout/tryout') }}" class="btn btn-warning btn-sm">Kembali</a>

		<div class="table-responsive mt-4">
			<table class="table table-striped">
				<thead>
					<tr>
						<td class="no-sort"><input type="checkbox" id="selectall"></td>
						<td>Soal</td>
						<td>Kategori</td>
						<td>Poin</td>
					</tr>
				</thead>
			</table>
		</div>		
	</div>
</div>
@endsection

@push('js')
<script src="{{ asset('dashboard/plugins/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript">
	var token = '{{ csrf_token() }}';
	$(document).ready(function(){
		$(".table").dataTable({ 
			"columnDefs": [{
				"targets": 'no-sort',
				"orderable": false,
			}],
			"fnDrawCallback": function( oSettings ) {
				$("#selectall").prop('checked', true);
				$('.check-question').each(function() {
					let checked = $(this).prop('checked');
					if(!checked){
						$("#selectall").prop('checked', false);
						return false;
					}
				});
			},
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "{{ url('admin/tryout/tryout/'.$data->id.'/question/data') }}",
				"type": "POST",
				"data": {
					"_token": token,
				},
			},
		});

		$(document).on("click", "#selectall", function(){

			let selectallchecked = $(this).prop('checked');

			$('.check-question').each(function() {
				let elem = $(this);
				let checked = $(this).prop('checked');
				let id = $(this).data('id');
				elem.prop('disabled', true);

				$.ajax({
					method: 'POST',
					url: '{{ url("admin/tryout/tryout/".$data->id."/question") }}',
					data: {
						_token: token,
						check: selectallchecked,
						id: id
					},
					success: function(d){
						if(!d){
							elem.prop('checked', !checked);
						}else{
							elem.prop('checked', selectallchecked);
						}
						elem.prop('disabled', false);
					},
					error: function(e){
						console.log(e);
						elem.prop('checked', !checked);
						elem.prop('disabled', false);
					}
				})
				// var value = currentElement.val(); // if it is an input/select/textarea field
				// TODO: do something with the value
			});
		});

		$(document).on("click", ".check-question", function(){
			let elem = $(this);
			let checked = $(this).prop('checked');
			let id = $(this).data('id');
			elem.prop('disabled', true);

			$.ajax({
				method: 'POST',
				url: '{{ url("admin/tryout/tryout/".$data->id."/question") }}',
				data: {
					_token: token,
					check: checked,
					id: id
				},
				success: function(d){
					if(!d){
						elem.prop('checked', !checked);
					}
					elem.prop('disabled', false);
				},
				error: function(e){
					console.log(e);
					elem.prop('checked', !checked);
					elem.prop('disabled', false);
				}
			})
		});
	})
</script>
@endpush