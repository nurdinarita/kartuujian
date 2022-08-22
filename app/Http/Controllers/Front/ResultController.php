<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentTryout;
use App\Models\StudentAnswer;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Tryout;
use Auth;

class ResultController extends Controller
{
	public function show($slug, Request $request)
	{
		$type = $request->type ?? 'twk';

		$tryout = Tryout::where('slug', $slug)
		->first();

		if(!$tryout){
			return redirect('/tryout')->with([
				'warning' => 'Tryout Tidak Ditemukan'
			]);
		}

		$studentTryout = StudentTryout::where('tryout_id', $tryout->id)
		->where('user_id', Auth::user()->id)
		->where('status', 2)
		->first();

		if(!$studentTryout){
			return redirect('tryout/'.$slug)->with([
				'warning' => 'Anda Belum Menyelesaikan Tryout ini'
			]);
		}

		$questions = $tryout->questions($type);
		$counters = $tryout->numbers(0, $studentTryout->id);
		$timer = $tryout->duration*60;
		$timerDif = ($timer - $studentTryout->remaining_time);
		if($timerDif > 0){
			$timer = $timerDif;
		}
		$timer = gmdate("H:i:s", $timer);

		foreach ($questions as $key => $value) {
			$value->myAnswer = StudentAnswer::where('student_tryout_id', $studentTryout->id)
			->where('question_id', $value->id)
			->first();
			$value->answer = Answer::where('question_id', $value->id)
			->where('correct', 1)
			->first();
		}

		return view('front.tryout.result')->with([
			'user' => Auth::user(),
			'tryout' => $tryout,
			'studentTryout' => $studentTryout,
			'questions' => $questions,
			'counters' => $counters,
			'timer' => $timer,
			'type' => $type,
		]);
	}

	public function detail($slug, $answer_id)
	{
		$tryout = Tryout::where('slug', $slug)
		->first();

		if(!$tryout){
			return response()->json([
				'success' => false,
				'message' => 'Tryout Tidak Ditemukan'
			]);
			return;
		}

		$answer = StudentAnswer::where('id', $answer_id)
		->first();
		$question = Question::where('id', $answer->question_id)
		->first();
		$answers = Answer::where('question_id', $answer->question_id)
		->get();

		return response()->json([
			'success' => true,
			'data' => view('front.tryout.answer')->with([
				'tryout' => $tryout,
				'question' => $question,
				'answer' => $answer,
				'answers' => $answers,
			])->render(),
		]);
	}

	public function download($slug)
	{
		$tryout = Tryout::where('slug', $slug)
		->first();

		if(!$tryout){
			return redirect('/tryout')->with([
				'warning' => 'Tryout Tidak Ditemukan'
			]);
		}

		$studentTryout = StudentTryout::where('tryout_id', $tryout->id)
		->where('user_id', Auth::user()->id)
		->where('status', 2)
		->first();

		if(!$studentTryout){
			return redirect('tryout/'.$slug)->with([
				'warning' => 'Anda Belum Menyelesaikan Tryout ini'
			]);
		}

		$questions = $tryout->questions();
		foreach ($questions as $key => $value) {
			$value->myAnswer = StudentAnswer::where('student_tryout_id', $studentTryout->id)
			->where('question_id', $value->id)
			->first();
			$value->answer = Answer::where('question_id', $value->id)
			->where('correct', 1)
			->first();
		}

		return view('front.tryout.solution')->with([
			'tryout' => $tryout,
			'questions' => $questions,
		]);
	}
}
