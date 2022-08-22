<link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/css/hasil-ujian.css') }}">

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Soal</th>
			<th>Jawaban Anda</th>
			<th>Jawaban Benar</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@if(count($questions) == 0)
		<tr>
			<td colspan="5" class="text-center">Tidak Ada Soal</td>
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
		</tr>
		@endforeach
		@endif
	</tbody>
</table>

<script type="text/javascript">
	window.print();
</script>