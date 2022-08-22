<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Tryout;
use App\Models\Student;

class HomeController extends Controller
{
	public function index()
	{
		$question = Question::count();
		$tryout = Tryout::where('deleted', 0)
		->count();
		$student = Student::count();

		return view('admin.dashboard')->with([
			'question' => $question,
			'tryout' => $tryout,
			'student' => $student,
		]);
	}
}
