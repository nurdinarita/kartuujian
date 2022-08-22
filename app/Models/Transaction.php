<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionPayment;

class Transaction extends Model
{
	protected $table = 'transactions';
	protected $guarded = [
		'id'
	];

	public function payment()
	{
		return TransactionPayment::where('transaction_id', $this->id)
		->orderBy('id', 'DESC')
		->first();
	}

	public function item()
	{
		return $this->hasMany('App\Models\TransactionItem', 'transaction_id', 'id');
	}
}
