@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-7">
		<div class="card">
			<div class="card-body">
				<h5>{{ $title }}</h5>

				<form method="post" action="{{ isset($data) ? url('admin/tryout/tryout/'.$data->id) : url('admin/tryout/tryout') }}" enctype="multipart/form-data">
					@csrf
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif

					<div class="form-group">
						<label>Judul Tryout</label>
						<input type="text" name="title" min="0" required="" class="form-control" value="{{ isset($data) ? $data->title : old('title') }}">
						@error('title')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>Gambar Pendukung</label>
						<input type="file" name="featured" class="form-control">
						@error('featured')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>Deksripsi</label>
						<textarea required="" class="form-control" name="description">{{ isset($data) ? $data->description : old('description') }}</textarea>
						@error('description')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>Syarat & Ketentuan</label>
						<textarea required="" class="form-control" name="privacy_policy">{{ isset($data) ? $data->privacy_policy : old('privacy_policy') }}</textarea>
						@error('privacy_policy')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>Durasi (dalam menit)</label>
						<input type="number" min="0" name="duration" min="0" required="" class="form-control" value="{{ isset($data) ? $data->duration : old('duration') }}">
						@error('duration')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>Tanggal Pelaksanaan</label>
						<input type="date" name="date" min="0" required="" class="form-control" value="{{ isset($data) ? $data->date : old('date') }}">
						@error('date')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>Harga (kosongi untuk tryout gratis)</label>
						<input type="number" min="0" name="price" class="form-control" value="{{ isset($data) ? $data->price : old('price') }}">
						@error('price')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>TWK Passing Grade</label>
						<input type="number" min="0" name="twk_passing_grade" min="0" required="" class="form-control" value="{{ isset($data) ? $data->twk_passing_grade : old('twk_passing_grade') }}">
						@error('twk_passing_grade')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>TIU Passing Grade</label>
						<input type="number" min="0" name="tiu_passing_grade" min="0" required="" class="form-control" value="{{ isset($data) ? $data->tiu_passing_grade : old('tiu_passing_grade') }}">
						@error('tiu_passing_grade')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>TKP Passing Grade</label>
						<input type="number" min="0" name="tkp_passing_grade" min="0" required="" class="form-control" value="{{ isset($data) ? $data->tkp_passing_grade : old('tkp_passing_grade') }}">
						@error('tkp_passing_grade')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label for="exampleFormControlSelect2">Tags</label>
						<p>
							<input type="checkbox" name="tags[0]" value="terbaru" @if(isset($data) && in_array('terbaru', $data->tags)) checked @endif> Terbaru
						</p>
						<p>
							<input type="checkbox" name="tags[1]" value="best seller" @if(isset($data) && in_array('best seller', $data->tags)) checked @endif> Best Seller
						</p>
						<p>
							<input type="checkbox" name="tags[2]" value="populer" @if(isset($data) && in_array('populer', $data->tags)) checked @endif> Populer
						</p>
						<p>
							<input type="checkbox" name="tags[3]" value="gratis" @if(isset($data) && in_array('gratis', $data->tags)) checked @endif> Gratis
						</p>
					</div>

					<hr>

					<div>
						<button class="btn btn-primary">Simpan</button>
						<a href="{{ url('admin/tryout/tryout') }}" class="btn btn-warning">Kembali</a>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection