<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentTryout;
use App\Models\Question;
use App\Models\Student;

class FrontController extends Controller
{
	public function home()
	{
		$tryout = StudentTryout::count();
		$question = Question::count();
		$student = Student::count();

		return view('front.home')->with([
			'tryout' => $tryout,
			'question' => $question,
			'student' => $student
		]);
	}
}
