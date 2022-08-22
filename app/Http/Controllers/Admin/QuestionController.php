<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use DB;

class QuestionController extends Controller
{

	const BASE = 'admin.tryout.question.';
	const URL = 'admin/tryout/question';

	public function index(Request $request)
	{
		$limit = 20;
		$query = $request->q;
		$category = $request->category;

		$datas = Question::when($query, function($q) use($query) {
			return $q->where('question', 'LIKE', '%'.$query.'%');
		})
		->when($category, function($q) use($category){
			return $q->where('category', $category);
		})
		->paginate($limit);

		return view(self::BASE.'index')->with([
			'title' => 'Soal Tryout',
			'datas' => $datas,
			'search' => [
				'q' => $query,
				'category' => $category,
			],
		]);
	}

	public function create()
	{
		return view(self::BASE.'form')->with([
			'title' => 'Buat Soal'
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'question' => 'required',
			'category' => 'required',
			'solution' => 'required',
			'point' => 'required',
			'answer' => 'required',
			'correct' => 'required',
		]);

		

		if(count($request->answer) <= 1){
			return back()->with([
				'error' => 'Jawaban Harus Lebih dari Satu'
			])->withInput();
		}

		try{
			DB::beginTransaction();

			$questionfilename = "";
			if ($request->hasFile('question_image')) {
				$questionfiles = $request->file('question_image');
				$questionfilename = 'question_' . time() . '.' . $questionfiles->getClientOriginalExtension();

				$questionfiles->storeAs(
						'public/images/question/',
						$questionfilename
				);
			}

			$solutionfilename = "";
			if ($request->hasFile('solution_image')) {
				$solutionfiles = $request->file('solution_image');
				$solutionfilename = 'solution_' . time() . '.' . $solutionfiles->getClientOriginalExtension();

				$solutionfiles->storeAs(
						'public/images/solution/',
						$solutionfilename
				);
			}

			$question = Question::create([
				'question' => $request->question,
				'category' => $request->category,
				'solution' => $request->solution,
				'point' => $request->point,
				'question_image' => $questionfilename,
				'solution_image' => $solutionfilename
			]);

			foreach ($request->answer as $key => $value) {
				if($request->category != "tkp"){
					$filename = "";
					if ($request->hasFile('answer_image')) {
						$files = $request->file('answer_image');
						if(isset($files[$key])){
							$filename = $key . '_' . time() . '.' . $files[$key]->getClientOriginalExtension();

							$files[$key]->storeAs(
								'public/images/answer/',
								$filename
							);
						}
					}
					
					Answer::create([
						'question_id' => $question->id,
						'answer' => $value['answer'],
						'correct' => ($request->correct == $key) ? 1 : 0,
						'point' => ($request->correct == $key) ? $request->point : 0,
						'answer_image' => $filename
					]);
				}else{
					$filename = "";
					if ($request->hasFile('answer_image')) {
						$files = $request->file('answer_image');
						if(isset($files[$key])){
							$filename = $key . '_' . time() . '.' . $files[$key]->getClientOriginalExtension();

							$files[$key]->storeAs(
								'public/images/answer/',
								$filename
							);
						}
					}
					
					Answer::create([
						'question_id' => $question->id,
						'answer' => $value['answer'],
						'correct' => ($request->correct == $key) ? 1 : 0,
						'point' => $request->tkp_point[$key],
						'answer_image' => $filename
					]);
				}
				
			}

			DB::commit();

			return redirect(self::URL)->with([
				'success' => 'Berhasil Menambah Soal'
			]);
		}catch(\Exception $e){
			DB::rollback();
			return back()->with([
				'error' => 'Gagal Menambah Soal'
			])->withInput();
		}
	}

	public function edit($id)
	{
		$data = Question::where('id', $id)
		->firstOrFail();
		$answer = $data->answer;

		return view(self::BASE.'form')->with([
			'title' => 'Edit Soal',
			'data' => $data
		]);
	}

	public function update($id, Request $request)
	{
		$data = Question::where('id', $id)
		->firstOrFail();

		$request->validate([
			'question' => 'required',
			'category' => 'required',
			'solution' => 'required',
			'point' => 'required',
			'answer' => 'required',
			'correct' => 'required',
		]);

		if(count($request->answer) <= 1){
			return back()->with([
				'error' => 'Jawaban Harus Lebih dari Satu'
			]);
		}

		$toUpdate = [];
		try{
			DB::beginTransaction();

			$dataUpdate = [
				'question' => $request->question,
				'category' => $request->category,
				'solution' => $request->solution,
				'point' => $request->point,
			];

			$questionfilename = "";
			if ($request->hasFile('question_image')) {
				$questionfiles = $request->file('question_image');
				$questionfilename = 'question_' . time() . '.' . $questionfiles->getClientOriginalExtension();

				$questionfiles->storeAs(
						'public/images/question/',
						$questionfilename
				);

				$dataUpdate['question_image'] = $questionfilename;
			}

			$solutionfilename = "";
			if ($request->hasFile('solution_image')) {
				$solutionfiles = $request->file('solution_image');
				$solutionfilename = 'solution_' . time() . '.' . $solutionfiles->getClientOriginalExtension();

				$solutionfiles->storeAs(
						'public/images/solution/',
						$solutionfilename
				);

				$dataUpdate['solution_image'] = $solutionfilename;
			}

			$data->update($dataUpdate);

			foreach ($request->answer as $key => $value) {
				if(isset($value['id'])){
					if($request->category != "tkp"){

						$filename = "";
						$answerUpd = [
							'answer' => $value['answer'],
							'correct' => ($request->correct == $key) ? 1 : 0,
							'point' => ($request->correct == $key) ? $request->point : 0,
							
						];

						if ($request->hasFile('answer_image')) {
							$files = $request->file('answer_image');
							if(isset($files[$key])){
								$filename = $key . '_' . time() . '.' . $files[$key]->getClientOriginalExtension();

								$files[$key]->storeAs(
									'public/images/answer/',
									$filename
								);
								$answerUpd['answer_image'] = $filename;
							}
							
						}

						Answer::where('id', $value['id'])
						->update($answerUpd);
					}else{
						$filename = "";
						$answerUpd = [
							'answer' => $value['answer'],
							'correct' => ($request->correct == $key) ? 1 : 0,
							'point' => $request->tkp_point[$key],
						];
						if ($request->hasFile('answer_image')) {
							$files = $request->file('answer_image');
							if(isset($files[$key])){
								$filename = $key . '_' . time() . '.' . $files[$key]->getClientOriginalExtension();

								$files[$key]->storeAs(
									'public/images/answer/',
									$filename
								);

								$answerUpd['answer_image'] = $filename;
							}
						}
						Answer::where('id', $value['id'])
						->update($answerUpd);
					}
					
					array_push($toUpdate, $value['id']);
				}else{
					$filename = '';
					if ($request->hasFile('answer_image')) {
						$files = $request->file('answer_image');
						if(isset($files[$key])){
							$filename = $key . '_' . time() . '.' . $files[$key]->getClientOriginalExtension();

							$files[$key]->storeAs(
								'public/images/answer/',
								$filename
							);
						}
					}
					$newId = Answer::create([
						'question_id' => $data->id,
						'answer' => $value['answer'],
						'correct' => ($request->correct == $key) ? 1 : 0,
						'answer_image' => $filename
					]);
					array_push($toUpdate, $newId->id);
				}
			}
			Answer::where('question_id', $data->id)
			->whereNotIn('id', $toUpdate)
			->delete();

			DB::commit();

			return redirect(self::URL)->with([
				'success' => 'Berhasil Mengubah Soal'
			]);
		}catch(\Exception $e){
			DB::rollback();
			return back()->with([
				'error' => 'Gagal Menambah Soal'
			]);
		}
	}

	public function destroy($id)
	{
		$data = Question::where('id', $id)
		->firstOrFail();

		$data->delete();
		Answer::where('question_id', $id)
		->delete();

		return redirect(self::URL)->with([
			'success' => 'Berhasil Menghapus Soal'
		]);
	}
}
