<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentTryout;
use App\Models\Student;
use App\Models\Tryout;

class ExamController extends Controller
{
	public function buy(Request $request)
	{
		$query = $request->q;
		$status = $request->status;
		$date = $request->date;

		$datas = StudentTryout::when($query, function($q) use($query){
			$student = Student::where('name', 'like', '%'.$query.'%')
			->pluck('id')
			->toArray();
			$tryout = Tryout::where('title', 'like', '%'.$query.'%')
			->pluck('id')
			->toArray();

			return $q->whereIn('student_id', $student)
			->orWhereIn('tryout_id', $tryout);
		})
		->when($status != null, function($q) use($status){
			return $q->where('status', $status);
		})
		->when($date != null, function($q) use($date){
			return $q->whereDate('created_at', $date);
		})
		->paginate(20);

		return view('admin.exam.buy')->with([
			'title' => 'Pembelian Ujian',
			'datas' => $datas,
			'date' => $date,
			'query' => $query,
			'status' => $status,
		]);
	}

	public function running(Request $request)
	{
		$query = $request->q;

		$datas = StudentTryout::when($query, function($q) use($query){
			$student = Student::where('name', 'like', '%'.$query.'%')
			->pluck('id')
			->toArray();
			$tryout = Tryout::where('title', 'like', '%'.$query.'%')
			->pluck('id')
			->toArray();

			return $q->whereIn('student_id', $student)
			->orWhereIn('tryout_id', $tryout);
		})
		->where('status', 1)
		->paginate(20);

		return view('admin.exam.running')->with([
			'title' => 'Ujian Berjalan',
			'datas' => $datas,
			'query' => $query,
		]);
	}

	public function result(Request $request)
	{
		$query = $request->q;

		$datas = StudentTryout::when($query, function($q) use($query){
			$student = Student::where('name', 'like', '%'.$query.'%')
			->pluck('id')
			->toArray();
			$tryout = Tryout::where('title', 'like', '%'.$query.'%')
			->pluck('id')
			->toArray();

			return $q->whereIn('student_id', $student)
			->orWhereIn('tryout_id', $tryout);
		})
		->where('status', 2)
		->paginate(20);

		return view('admin.exam.result')->with([
			'title' => 'Hasil Ujian',
			'datas' => $datas,
			'query' => $query,
		]);
	}
}
