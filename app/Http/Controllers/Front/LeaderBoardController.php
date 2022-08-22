<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentTryout;
use App\Models\Tryout;
use App\Models\Student;

class LeaderBoardController extends Controller
{
	public function index(Request $request)
	{
		$tryout = $request->t;
		$query = $request->q;

		$tryouts = Tryout::where('published', 1)
		->pluck('title', 'id')
		->toArray();

		$datas = StudentTryout::where('status', 2)
		->when($query, function($q) use($query){
			$student = Student::where('name', 'LIKE', '%'.$query.'%')
			->pluck('id')
			->toArray();

			return $q->whereIn('student_id', $student);
		})
		->when($tryout, function($q) use($tryout){
			return $q->where('tryout_id', $tryout);
		})
		->paginate(50);

		return view('front.leaderboard')->with([
			'tryout' => $tryout,
			'query' => $query,
			'datas' => $datas,
			'tryouts' => $tryouts,
		]);
	}
}
