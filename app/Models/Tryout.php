<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TryoutQuestion;
use App\Models\StudentAnswer;
use App\Models\Question;

class Tryout extends Model
{
	protected $table = 'tryouts';
	protected $guarded = [
		'id'
	];

	public function questions($type = '-')
	{
		$tryoutQuestion = TryoutQuestion::where('tryout_id', $this->id)
		->get();

		$questions = [];
		foreach ($tryoutQuestion as $key => $value) {
			$question = Question::where('id', $value->question_id)
			->when($type != '-', function($q) use($type){
				return $q->where('category', $type);
			})
			->first();
			if($question){
				array_push($questions, $question);
			}
		}

		return $questions;
	}

	public function numbers($current, $student_tryout_id)
	{
		$tryoutQuestion = TryoutQuestion::where('tryout_id', $this->id)
		->get();
		$numbers = [];
		$questions = 0;
		$answered = 0;
		$notAnswered = 0;
		$correct = 0;
		$wrong = 0;

		foreach ($tryoutQuestion as $key => $value) {
			$status = 'gray';
			$answer = StudentAnswer::where('student_tryout_id', $student_tryout_id)
			->where('tryout_id', $value->tryout_id)
			->where('question_id', $value->question_id)
			->first();

			if($answer){
				if($answer->answer){
					$status = 'green';
					$answered++;

					if($answer->correct == 1){
						$correct++;
					}else{
						$wrong++;
					}
				}else{
					$notAnswered++;
				}
				if($answer->doubt == 1){
					$status = 'orange';
				}
			}else{
				$notAnswered++;
			}
			if($current == $key+1){
				$status = 'blue';
			}

			array_push($numbers, $status);
		}

		return [
			'numbers' => $numbers,
			'questions' => count($numbers),
			'answered' => $answered,
			'notAnswered' => $notAnswered,
			'correct' => $correct,
			'wrong' => $wrong,
		];
	}
}
