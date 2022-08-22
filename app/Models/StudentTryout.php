<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTryout extends Model
{
    protected $table = 'student_tryouts';
    protected $guarded = [
    	'id'
    ];

    public function student()
    {
    	return $this->hasOne('App\Models\Student', 'id', 'student_id');
    }

    public function tryout()
    {
    	return $this->hasOne('App\Models\Tryout', 'id', 'tryout_id');
    }

    public function status()
    {
        $statuses = [
            [
                'type' => 'warning',
                'status' => 'Belum Dikerjakan',
            ],
            [
                'type' => 'primary',
                'status' => 'Dikerjakan',
            ],
            [
                'type' => 'success',
                'status' => 'Selesai',
            ],
        ];

        return (isset($statuses[$this->status])) ? $statuses[$this->status] : '-';
    }
}
