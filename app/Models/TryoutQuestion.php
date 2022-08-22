<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TryoutQuestion extends Model
{
	protected $table = 'tryout_questions';
	protected $guarded = [
		'id'
	];

	public function question()
	{
		return $this->hasOne('App\Models\Question', 'id', 'question_id');
	}
}
