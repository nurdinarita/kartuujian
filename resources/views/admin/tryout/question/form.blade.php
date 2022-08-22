@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-7">
		<div class="card">
			<div class="card-body">
				<h5>{{ $title }}</h5>

				<form method="post" action="{{ isset($data) ? url('admin/tryout/question/'.$data->id) : url('admin/tryout/question') }}" enctype="multipart/form-data">
					@csrf
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif

					<div class="form-group">
						<label>Pertanyaan</label>
						<textarea required="" class="form-control" name="question">{{ isset($data) ? $data->question : old('question') }}</textarea>
						@error('question')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>Gambar Pertanyaan</label>
						@if(isset($data->question_image) and $data->question_image != '')
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <img class="img-fluid" src="{{asset('storage/images/question/'.$data->question_image)}}" />
                            </div>
                        </div>
                        @endif
						<input type="file" accept="image/*" name="question_image" class="custom-file" >
						@error('question_image')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<select required="" name="category" class="form-control" id="category">
							<option value="twk" @if(isset($data) && $data->category == 'twk') selected @endif>TWK</option>
							<option value="tiu" @if(isset($data) && $data->category == 'tiu') selected @endif>TIU</option>
							<option value="tkp" @if(isset($data) && $data->category == 'tkp') selected @endif>TKP</option>
						</select>
						@error('category')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group div-point" style="@if(isset($data->category) && $data->category == 'tkp') display: none; @endif">
						<label>Poin</label>
						<input type="number" name="point" min="0" class="form-control" value="{{ isset($data) ? $data->point : old('point', 0) }}">
						@error('point')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>Solusi</label>
						<textarea required="" class="form-control" name="solution" required="">{{ isset($data) ? $data->solution : old('solution') }}</textarea>
						@error('solution')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>Gambar Solusi</label>
						@if(isset($data->solution_image) and $data->solution_image != '')
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <img class="img-fluid" src="{{asset('storage/images/solution/'.$data->solution_image)}}" />
                            </div>
                        </div>
                        @endif
						<input type="file" accept="image/*" name="solution_image" class="custom-file" >
						@error('solution_image')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label>Jawaban</label>
						@if(isset($data) && count($data->answer) > 0)
							@foreach($data->answer as $k => $v)
							<div class="input-group mb-2 answer-section" data-answer="{{ $k+1 }}">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<input type="hidden" name="answer[{{ $k+1 }}][id]" value="{{ $v->id }}">
										<input type="radio" name="correct" required="" value="{{ $k+1 }}" @if($v->correct) checked @endif>
									</div>
								</div>
								<input type="text" name="answer[{{ $k+1 }}][answer]" class="form-control" required="" value="{{ $v->answer }}">
								@if(isset($data) && $data->category == 'tkp')
									<div class="input-group-append">&nbsp;&nbsp;&nbsp;<input style="width:70px;" type="text" name="tkp_point[{{ $k+1 }}]" class="form-control" required="" value="{{$v->point}}"></div>
								@endif
								<div class="input-group-append">
									<button type="button" class="btn text-danger" onclick="deleteAnswer({{ $k+1 }})">
										<i class="material-icons">close</i>
									</button>
								</div>
							</div>
							<div class="row answer-section">
								@if(isset($v->answer_image) and $v->answer_image != '')
									<div class="col-md-3 mb-2">
										<img class="img-fluid" src="{{asset('storage/images/answer/'.$v->answer_image)}}" />
									</div>
								@endif
								<input type="file" accept="image/*" name="answer_image[{{ $k+1 }}]" class="custom-file form-control" style="border: 0px;" >
							</div>
							@endforeach
						@endif

						<div id="answers"></div>
						
						<button type="button" onclick="addAnswer()" class="btn btn-primary btn-block mt-2">Tambah Jawaban</button>

						@error('answer')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						@error('correct')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<hr>

					<div>
						<button class="btn btn-primary">Simpan</button>
						<a href="{{ url('admin/tryout/question') }}" class="btn btn-warning">Kembali</a>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
<script type="text/javascript">
	@if(isset($data))
	var answer = {{ count($data->answer) + 1 }};
	@else
	var answer = 1;
	@endif

	$(document).ready(function(){
		$('#category').on('change', function() {
			$(".answer-section").remove();
			if(this.value == "tkp"){
				$(".div-point").hide();
			}else{
				$(".div-point").show();
			}
		});
	})

	function addAnswer(){
		var category = $('select[name=category] option').filter(':selected').val();
		if(category != "tkp")
		{	
			$("#answers").append('<div class="input-group mb-2 answer-section" data-answer="'+answer+'"><div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="correct" required="" value="'+answer+'"></div></div><input type="text" name="answer['+answer+'][answer]" class="form-control" required=""><input type="file" accept="image/*" name="answer_image['+answer+']" class="custom-file form-control" style="border: 0px;" ><div class="input-group-append"><button type="button" class="btn text-danger" onclick="deleteAnswer('+answer+')"><i class="material-icons">close</i></button></div></div>');
		}else{
			$("#answers").append('<div class="input-group mb-2 answer-section" data-answer="'+answer+'"><div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="correct" required="" value="'+answer+'"></div></div><input type="text" name="answer['+answer+'][answer]" class="form-control" required=""><input type="file" accept="image/*" name="answer_image['+answer+']" class="custom-file form-control" style="border: 0px;" ><div class="input-group-append">&nbsp;&nbsp;&nbsp;<input style="width:70px;" type="text" name="tkp_point['+answer+']" class="form-control" required=""></div><div class="input-group-append"><button type="button" class="btn text-danger" onclick="deleteAnswer('+answer+')"><i class="material-icons">close</i></button></div></div>');
		}
		answer++;
	}

	function deleteAnswer(index){
		$(".answer-section[data-answer='"+index+"']").remove();
	}
</script>
@endpush