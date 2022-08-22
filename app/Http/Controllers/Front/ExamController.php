<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tryout;
use App\Models\Question;
use App\Models\Answer;
use App\Models\TryoutQuestion;
use App\Models\StudentTryout;
use App\Models\StudentAnswer;
use Session;
use Auth;

class ExamController extends Controller
{
	private $exam;

	public function index($slug, Request $request)
	{
		if(!$exam = $this->validation($slug)){
			return redirect('tryout/'.$slug)->with([
				'warning' => 'Anda tidak diizinkan mengikuti ujian ini'
			]);
		}
		$number = $request->q ?? 1;
		if(!$request->q){
			$number = $exam['exam']->last_question == 0 ? 1 : $exam['exam']->last_question;
		}
		
		$tryoutQuestion = TryoutQuestion::where('tryout_id', $exam['tryout']->id)
		->offset($number-1)
		->limit(1)
		->first();
		if(!$tryoutQuestion){
			$tryoutQuestion = TryoutQuestion::where('tryout_id', $exam['tryout']->id)
			->offset(0)
			->limit(1)
			->first();
			$number = 1;
		}

		$question = $tryoutQuestion->question;
		$answers = $question->answer;
		$myAnswer = StudentAnswer::where('student_tryout_id', $exam['exam']->id)
		->where('question_id', $question->id)
		->first();
		$counters = $exam['tryout']->numbers($number, $exam['exam']->id);
		$numbers = array_chunk($counters['numbers'], 20);
		$examUpdate = [
			'last_question' => $number
		];

		if($exam['exam']->start_at == null){
			$now = now();
			$finish = Date('Y-m-d H:i:s', strtotime($now . ' +'.$exam['exam']->remaining_time.' minutes'));
			$examUpdate = [
				'start_at' => $now,
				'status' => 1,
			];
		}

		$exam['exam']->update($examUpdate);

		return view('front.tryout.exam')->with([
			'tryout' => $exam['tryout'],
			'exam' => $exam['exam'],
			'question' => $question,
			'answers' => $answers,
			'number' => $number,
			'myAnswer' => $myAnswer,
			'numbers' => $numbers,
			'counter' => [
				'questions' => $counters['questions'],
				'answered' => $counters['answered'],
				'notAnswered' => $counters['notAnswered'],
			],
		]);
	}

	public function answer($slug, $question_id, Request $request)
	{
		if(!$exam = $this->validation($slug)){
			echo json_encode(false);
			return;
		}

		$myAnswer = StudentAnswer::where('student_tryout_id', $exam['exam']->id)
		->where('question_id', $question_id)
		->first();
		$question = Question::where('id', $question_id)
		->first();
		$answer = Answer::where('answer', $request->answer)
		->where('question_id', $question_id)
		->first();

		if($question->category == "tkp")
		{
			$answer->correct = 1;
			$question->point = $answer->point;
		}

		if($question && $answer){
			if($myAnswer){
				$myAnswer->update([
					'answer' => $request->answer,
					'correct' => ($answer->correct) ? 1 : 0,
					'point' => ($answer->correct) ? $question->point : 0,
					'question_type' => $question->category,
					'question_number' => $request->number
				]);
			}else{
				StudentAnswer::create([
					'user_id' => Auth::user()->id,
					'student_tryout_id' => $exam['exam']->id,
					'tryout_id' => $exam['tryout']->id,
					'question_id' => $question_id,
					'answer' => $request->answer,
					'point' => ($answer->correct) ? $question->point : 0,
					'question_type' => $question->category,
					'question_number' => $request->number,
					'correct' => ($answer->correct) ? 1 : 0,
				]);	
			}

			$twk = StudentAnswer::where('question_type', 'twk')
			->where('student_tryout_id', $exam['exam']->id)
			->sum('point');
			$tiu = StudentAnswer::where('question_type', 'tiu')
			->where('student_tryout_id', $exam['exam']->id)
			->sum('point');
			$tkp = StudentAnswer::where('question_type', 'tkp')
			->where('student_tryout_id', $exam['exam']->id)
			->sum('point');
			$exam['exam']->update([
				'twk_score' => $twk,
				'tui_score' => $tiu,
				'tkp_score' => $tkp,
				'total_score' => ($twk + $tiu + $tkp)
			]);

			echo json_encode(true);
			return;
		}

		echo json_encode(false);
		return;
	}

	public function doubt($slug, $question_id, Request $request)
	{
		if(!$exam = $this->validation($slug)){
			echo json_encode(false);
			return;
		}

		$myAnswer = StudentAnswer::where('student_tryout_id', $exam['exam']->id)
		->where('question_id', $question_id)
		->first();
		$question = Question::where('id', $question_id)
		->first();

		if($question){
			if($myAnswer){
				$myAnswer->update([
					'doubt' => ($request->status)
				]);
			}else{
				StudentAnswer::create([
					'user_id' => Auth::user()->id,
					'student_tryout_id' => $exam['exam']->id,
					'tryout_id' => $exam['tryout']->id,
					'question_id' => $question_id,
					'doubt' => ($request->status)
				]);	
			}
			echo json_encode(true);
			return;
		}

		echo json_encode(false);
		return;
	}

	public function tick($slug, Request $request)
	{
		if(!$exam = $this->validation($slug)){
			echo json_encode(false);
			return;
		}

		$exam['exam']->update([
			'remaining_time' => $request->remaining_time,
		]);

		echo json_encode(true);
		return;
	}

	public function finish($slug, Request $request)
	{
		if(!$exam = $this->validation($slug)){
			return redirect('tryout/'.$slug)->with([
				'warning' => 'Anda belum memulai ujian'
			]);
		}else{
			$exam['exam']->update([
				'status' => 2,
				'finish_at' => now(),
				'is_graduated' => ($exam['exam']->total_score >= $exam['tryout']->passing_grade) ? 1 : 0
			]);
		}

		return redirect('result/'.$slug);
	}

	public function validation($slug)
	{
		$token = Session::get('token');
		$tryout = Tryout::where('slug', $slug)
		->first();
		$check = StudentTryout::where('key', $token)
		->where('tryout_id', $tryout->id)
		->where('finish_at', null)
		->where('remaining_time', '>', 0)
		->whereIn('status', [0,1])
		->first();

		if(!$check){
			return null;
		}

		return [
			'tryout' => $tryout,
			'exam' => $check,
		];
	}
}
