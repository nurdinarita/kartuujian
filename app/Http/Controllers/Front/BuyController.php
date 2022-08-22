<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\PaymentController;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Models\TransactionItem;
use Auth;
use DB;

class BuyController extends PaymentController
{
	public function cart()
	{
		$datas = Cart::where('user_id', Auth::user()->id)
		->get();
		foreach ($datas as $key => $value) {
			$value->item = $value->item;
		}

		return view('front.cart.index')->with([
			'datas' => $datas
		]);
	}

	public function remove($id)
	{
		$data = Cart::where('id', $id)
		->where('user_id', Auth::user()->id)
		->first();

		if($data){
			$data->delete();

			return redirect('cart')->with([
				'success' => 'Item berhasil dihapus'
			]);
		}

		return redirect('cart')->with([
			'error' => 'Item tidak ditemukan'
		]);
	}

	public function proceedCart(Request $request)
	{
		if(count($request->item) < 1){
			return back()->with([
				'error' => 'Pilih minimal 1 item'
			]);
		}

		$datas = Cart::whereIn('id', $request->item)
		->where('user_id', Auth::user()->id)
		->get();	

		if(count($datas) < 1){
			return back()->with([
				'error' => 'Pilih minimal 1 item'
			]);
		}
		Cart::whereIn('id', $request->item)
		->where('user_id', Auth::user()->id)
		->update([
			'selected' => 1
		]);

		return redirect('cart/check');
	}

	public function check()
	{
		$datas = Cart::where('user_id', Auth::user()->id)
		->where('selected', 1)
		->get();

		if(count($datas) == 0){
			return redirect('/cart')->with([
				'warning' => 'Silahkan memilih item'
			]);
		}

		$total = 0;
		foreach ($datas as $key => $value) {
			$value->item = $value->item;
			$total += (int)$value->item->price;
		}

		return view('front.cart.check')->with([
			'datas' => $datas,
			'total' => $total
		]);
	}

	public function payment()
	{
		$datas = Cart::where('user_id', Auth::user()->id)
		->where('selected', 1)
		->get();

		if(count($datas) == 0){
			return redirect('/cart')->with([
				'warning' => 'Silahkan memilih item'
			]);
		}

		$total = 0;
		foreach ($datas as $key => $value) {
			$value->item = $value->item;
			$total += (int)$value->item->price;
		}

		return view('front.cart.payment')->with([
			'datas' => $datas,
			'total' => $total,
			'methods' => $this->paymentMethod(),
		]);
	}

	public function checkout(Request $request)
	{
		$datas = Cart::where('user_id', Auth::user()->id)
		->where('selected', 1)
		->get();

		if(count($datas) == 0){
			return redirect('/cart')->with([
				'warning' => 'Silahkan memilih item'
			]);
		}

		if(!$request->payment){
			return back()->with([
				'warning' => 'Silahkan memilih metode pembayaran'
			]);
		}

		$total = 0;
		foreach ($datas as $key => $value) {
			$value->item = $value->item;
			$value->price = $value->item->price;
			$total += (int)$value->item->price;
		}

		$payment = explode('-', $request->payment);
		$req = new Request();
		$req->merge([
			'payment_code' => $payment[1],
			'total' => $total
		]);
		$fee = (int)$this->fee($req);	

		try{
			DB::beginTransaction();

			$transaction = Transaction::create([
				'user_id' => Auth::user()->id,
				'student_id' => Auth::user()->account()->id,
				'item' => count($datas),
				'total' => $total,
				'fee' => $fee,
				'grand_total' => $total + $fee,
				'status' => 0,
			]);
			foreach ($datas as $key => $value) {
				TransactionItem::create([
					'transaction_id' => $transaction->id,
					'item_id' => $value->item_id,
					'amount' => 1,
					'price' => $value->price,
				]);
			}
			$reqPayment = $this->makePayment($transaction, $datas, $payment, Auth::user());
			if(!$reqPayment){
				DB::rollback();
				return back()->with([
					'error' => 'Gagal Melakukan Request ke Payment Gateway'
				]);
			}

			$payment = TransactionPayment::create([
				'transaction_id' => $transaction->id,
				'type' => $payment[0],
				'code' => $payment[1],
				'method' => $payment[2],
				'reference' => $reqPayment['reference'],
				'merchant_ref' => $reqPayment['merchant_ref'],
				'merchant_ref' => $reqPayment['merchant_ref'],
				'pay_code' => $reqPayment['pay_code'],
				'time_limit' => $reqPayment['time_limit'],
				'status' => $reqPayment['status'],
			]);

			DB::commit();
			return redirect('/transaction/how-to-pay/'.$transaction->id);
		}catch(\Exception $e){
			DB::rollback();
			return back()->with([
				'error' => 'Proses Checkout Gagal'
			]);
		}
	}
}
