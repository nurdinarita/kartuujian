<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tryout;
use App\Models\Question;
use App\Models\TryoutQuestion;
use Storage;

class TryoutController extends Controller
{

	const BASE = 'admin.tryout.tryout.';
	const URL = 'admin/tryout/tryout';

	public function index(Request $request)
	{
		$limit = 20;
		$query = $request->q;

		$datas = Tryout::when($query, function($q) use($query){
			return $q->where('title', 'LIKE', '%'.$query.'%');
		})
		->where('deleted', 0)
		->paginate($limit);

		return view(self::BASE.'index')->with([
			'title' => 'Tryout',
			'datas' => $datas,
			'search' => [
				'q' => $query
			]
		]);
	}

	public function create()
	{
		return view(self::BASE.'form')->with([
			'title' => 'Buat Tryout',
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required',
			'description' => 'required',
			'privacy_policy' => 'required',
			'duration' => 'required',
			'featured' => 'nullable|mimes:jpg,jpeg,png,max:1500',
			// 'passing_grade' => 'required',
			'twk_passing_grade' => 'required',
			'tiu_passing_grade' => 'required',
			'tkp_passing_grade' => 'required',
		]);

		$filename = null;
		if($request->featured){
			if(!$this->isImage($request->featured)){
				return back()->withInput()
				->with([
					'error' => 'Format File Tidak Didukung'
				]);
			}

			$filename = $this->resizeImage($request->featured, 'tryout', 700);
		}

		$data = Tryout::create([
			'title' => $request->title,
			'slug' => $this->slugg($request->title),
			'description' => $request->description,
			'privacy_policy' => $request->privacy_policy,
			'duration' => $request->duration,
			'question' => 0,
			'date' => $request->date,
			'tags' => implode(',', $request->tags),
			'price' => $request->price,
			'deleted' => 0,
			'featured' => $filename,
			// 'passing_grade' => $request->passing_grade,
			'twk_passing_grade' => $request->twk_passing_grade,
			'tiu_passing_grade' => $request->tiu_passing_grade,
			'tkp_passing_grade' => $request->tkp_passing_grade,
		]);

		return redirect(self::URL)->with([
			'success' => 'Berhasil Menambah Tryout'
		]);
	}

	public function edit($id)
	{
		$data = Tryout::where('id', $id)
		->firstOrFail();
		$data->date = Date('Y-m-d', strtotime($data->date));
		$data->tags = explode(',', $data->tags);

		return view(self::BASE.'form')->with([
			'title' => 'Edit Tryout',
			'data' => $data
		]);
	}

	public function update($id, Request $request)
	{
		$data = Tryout::where('id', $id)
		->firstOrFail();

		$request->validate([
			'title' => 'required',
			'description' => 'required',
			'privacy_policy' => 'required',
			'duration' => 'required',
			'featured' => 'nullable|mimes:jpg,jpeg,png,max:1500',
			// 'passing_grade' => 'required',
			'twk_passing_grade' => 'required',
			'tiu_passing_grade' => 'required',
			'tkp_passing_grade' => 'required',
		]);

		$filename = $data->featured;
		if($request->featured){
			if(!$this->isImage($request->featured)){
				return back()->withInput()
				->with([
					'error' => 'Format File Tidak Didukung'
				]);
			}

			$this->deleteFile($request->featured);
			$filename = $this->resizeImage($request->featured, 'tryout', 700);
		}

		$data = $data->update([
			'title' => $request->title,
			'description' => $request->description,
			'privacy_policy' => $request->privacy_policy,
			'duration' => $request->duration,
			'date' => $request->date,
			'tags' => implode(',', $request->tags),
			'price' => $request->price,
			'featured' => $filename,
			// 'passing_grade' => $request->passing_grade,
			'twk_passing_grade' => $request->twk_passing_grade,
			'tiu_passing_grade' => $request->tiu_passing_grade,
			'tkp_passing_grade' => $request->tkp_passing_grade,
		]);

		return redirect(self::URL)->with([
			'success' => 'Berhasil Mengedit Tryout'
		]);
	}

	public function destroy($id)
	{
		$data = Tryout::where('id', $id)
		->firstOrFail();

		$data->update([
			'deleted' => 1
		]);

		return redirect(self::URL)->with([
			'success' => 'Berhasil Menghapus Tryout'
		]);
	}

	public function publish($id)
	{
		$data = Tryout::where('id', $id)
		->firstOrFail();

		$data->update([
			'published' => ($data->published) ? 0: 1
		]);

		return redirect(self::URL)->with([
			'success' => 'Berhasil Mempublish Tryout'
		]);
	}

	public function question($id)
	{
		$data = Tryout::where('id', $id)
		->firstOrFail();

		return view(self::BASE.'question')->with([
			'title' => 'Pilih Soal',
			'data' => $data
		]);
	}

	public function questionData($id, Request $request)
	{
		$search = $request->search['value'];
		$start = $request->start;
		$length = $request->length;

		$totalData = Question::count();

		$records = Question::when($search, function($q) use($search){
			return $q->where('question', 'LIKE', '%'.$search.'%');
		})
		->offset($start)->limit($length)
		->get();

		$filtered = Question::when($search, function($q) use($search){
			return $q->where('question', 'LIKE', '%'.$search.'%');
		})
		->get();
		$totalFiltered = count($filtered);

		$datas = [];
		foreach ($records as $key => $value) {
			$check = TryoutQuestion::where('question_id', $value->id)
			->where('tryout_id', $id)
			->first();

			array_push($datas, [
				'<input type="checkbox" class="check-question" '.($check ? 'checked ' : ' ').' data-id="'.$value->id.'"/>',
				$value->question,
				$value->category,
				$value->point,
			]);
		}

		$json_data = [
			"draw"            => intval($request->draw),  
			"recordsTotal"    => intval($totalData), 
			"recordsFiltered" => intval($totalFiltered),
			"data"            => $datas
		];
		echo json_encode($json_data);
	}

	public function questionSave($id, Request $request)
	{
		$check = TryoutQuestion::where('question_id', $request->id)
		->where('tryout_id', $id)
		->first();

		if($check and $request->check == "false"){
			$check->delete();
		}else if(!$check and $request->check == "true"){
			TryoutQuestion::create([
				'question_id' => $request->id,
				'tryout_id' => $id,
			]);
		}

		Tryout::where('id', $id)
		->update([
			'question' => TryoutQuestion::where('tryout_id', $id)
			->count(),
		]);

		return json_encode(true);
	}

	public function slugg($text)
	{
		$generated = $this->slugify($text);

		$data = Tryout::where('slug', $generated)
		->first();

		if($data){
			return $this->slug($text.' '.random_int(1, 6511));
		}

		return $generated;
	}
}
