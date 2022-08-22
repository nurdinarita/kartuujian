@extends('layouts.dashboard')

@section('content')

<div class="card">
	<div class="card-body">
		<h5>{{ $title }}</h5>

		<form class="row mt-3" action="{{ url()->current() }}" id="form-search">
			<div class="col-md-4">
				<select class="form-control" name="status" id="status">
					<option value="">Semua</option>
					<option @if($status == 0 and $status != "") selected @endif value="0">Belum Dikerjakan</option>
					<option @if($status == 1) selected @endif value="1">Dikerjakan</option>
					<option @if($status == 2) selected @endif value="2">Selesai</option>
				</select>
			</div>
			<div class="col-md-4">
				<input type="date" id="date" name="date" min="0" required="" value="{{ $date }}" class="form-control">
			</div>
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
					<th>Status</th>
					<th>Dimulai Pada</th>
					<th>Sisa Waktu</th>
					<th>Kode Akses</th>
					<th>Action</th>
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
					<td class="text text-{{ $v->status()['type'] }}">{{ $v->status()['status'] }}</td>
					<td>{{ $v->start_at }}</td>
					<td>{{ $v->remaining_time }} dtk</td>
					<td>{{ $v->key }}</td>

				<?php
					$message = "Selamat, pembayaran tryout anda telah berhasil. Silahkan gunakan token dibawah ini untuk tryout yang anda pesan.%0a%0a";
					$message .= "Tryout : ".$v->tryout->title."%0a";
					$message .= "Token : *".$v->key."*%0a";
					$message .= "Link : ".(url('tryout/'.$v->tryout->slug))."%0a%0a";
					$phone = $v->student->phone;
					$whatsapp = "";


					if($phone[0] == '+'){
						$whatsapp = str_replace('+', '', $phone);
					}
			
					if($phone[0] == 0){
						$whatsapp = '62'.substr($phone, 1, strlen($phone));
					}else{
						$whatsapp = $phone;
					}
				?>
					<td align="center"><a href="https://wa.me/{{ $whatsapp}}?text={{$message}}" target="_blank"><img class="img-fluid" src="{{asset('images/whatsapp.png')}}" /></a></td>
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

		$("#date").on("change", function(){
			$("#form-search").submit();
		})
	})
</script>
@endpush