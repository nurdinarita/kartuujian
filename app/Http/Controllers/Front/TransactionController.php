<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\PaymentController;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends PaymentController
{
	public function show($id)
	{
		$data = Transaction::where('id', $id)
		->firstOrFail();
		$data->payment = $data->payment();
		$data->item = $data->item;

		return view('front.transaction.show')->with([
			'data' => $data
		]);
	}

	public function howToPay($id)
	{
		$data = Transaction::where('id', $id)
		->firstOrFail();
		$data->payment = $data->payment();

		if(!$data->payment){
			return redirect('/transaction/'.$id)->with([
				'warning' => 'Metode Pembayaran Belum Dipilih'
			]);
		}
		$data->pg = $this->detail($data->payment->reference);

		return view('front.transaction.how_to_pay')->with([
			'data' => $data
		]);
	}
}
