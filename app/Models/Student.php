<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $table = 'students';
	protected $guarded = [
		'id'
	];
	protected $dates = ['created_at', 'updated_at'];
}
