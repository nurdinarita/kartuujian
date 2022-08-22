<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\Tryout;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Models\TransactionItem;
use App\Models\StudentTryout;
use App\Models\Student;
use DB;

class PaymentController extends Controller
{
	public function fee(Request $request)
	{
		$baseUrl = config('app.tripay_url');
		$apiKey = config('app.tripay_api_key');

		$client = new Client([
			'base_uri' => $baseUrl
		]);
		$response = $client->get('merchant/payment-channel', [
			'headers' => [
				'authorization' => 'Bearer '.$apiKey,
				'accept' => 'Application/json'
			],
			'query' => [
				'code' => $request->payment_code,
			],
			'http_errors' => false,
		]);

		$status = $response->getStatusCode();
		$total = $request->total;
		if($status == 200){
			$body = json_decode($response->getBody())->data[0];
			if($body->fee_customer){
				$fee = $body->fee_customer->flat;
				$fee += ceil(floatval($body->fee_customer->percent) / 100 * (int) $total);
				return json_encode($fee);
			}
		}else{
			return json_encode(false);
		}
	}

	public function makePayment($transaction, $items, $payment, $user)
	{
		$merchantCode = config('app.tripay_merchant');
		$baseUrl = config('app.tripay_url');
		$apiKey = config('app.tripay_api_key');
		$privateKey = config('app.tripay_private_key');
		$merchantRef = null;
		$amount = $transaction->total;
		$signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);

		$orderItems = [];
		foreach ($items as $key => $value) {
			array_push($orderItems, [
				'sku' => 'TRYOUT-'.$value->item_id,
				'name' => $value->item->title ?? 'Tryout CPNS Indonesia',
				'price' => $value->price,
				'quantity' => 1
			]);
		}

		$timeLimit = Date('Y-m-d H:i:s', strtotime('+3 days'));
		$client = new Client([
			'base_uri' => $baseUrl
		]);
		$response = $client->post('transaction/create', [
			'http_errors' => false,
			'headers' => [
				'authorization' => 'Bearer '.$apiKey,
				'accept' => 'Application/json'
			],
			'form_params' => [
				'method' => $payment[1],
				'amount' => $amount,
				'customer_name' => $user->name ?? 'CPNS Indonesia',
				'customer_email' => $user->email ?? 'cpns.indonesia@gmail.com',
				'customer_phone' => $user->phone ?? '085802968281',
				'order_items' => $orderItems,
				'callback_url' => url('gateway/callback/tripay'),
				'expired_time' => strtotime($timeLimit),
				'return_url' => url('/'),
				'signature' => $signature
			]
		]);

		$status = $response->getStatusCode();
		if($status == 200){
			$body = json_decode($response->getBody())->data;
			return [
				'reference' => $body->reference,
				'merchant_ref' => $body->merchant_ref,
				'pay_code' => $body->pay_code,
				'time_limit' => $timeLimit,
				'status' => $body->status,
			];
		}else{
			return null;
		}
	}

	public function detail($reference)
	{
		$baseUrl = config('app.tripay_url');
		$apiKey = config('app.tripay_api_key');

		$client = new Client([
			'base_uri' => $baseUrl
		]);
		$response = $client->get('transaction/detail', [
			'headers' => [
				'authorization' => 'Bearer '.$apiKey,
				'accept' => 'Application/json'
			],
			'http_errors' => false,
			'query' => [
				'reference' => $reference,
			]
		]);

		$status = $response->getStatusCode();
		if($status == 200){
			return json_decode($response->getBody())->data;
		}else{
			return null;
		}
	}

	public function callback(Request $request)
	{
		$privateKey = config('app.tripay_private_key');
		$json = file_get_contents("php://input");

		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

		// $signature = hash_hmac('sha256', $json, $privateKey);
		// if( $callbackSignature !== $signature ) {
		// 	exit("Invalid Signature");
		// }

		$data = json_decode($json);
		$event = $_SERVER['HTTP_X_CALLBACK_EVENT'];

		if( $event == 'payment_status' )
		{
			if( $data->status == 'PAID' )
			{
				$payment = TransactionPayment::where('reference', $data->reference)
				->where('code', $data->payment_method_code)
				->where('status', 'UNPAID')
				->first();

				try{
					DB::beginTransaction();
					if($payment){
						$transaction = Transaction::where('id', $payment->transaction_id)
						->first();
						$student = Student::where('id', $transaction->student_id)
						->first();

						if($transaction && $student){
							$items = TransactionItem::where('transaction_id', $transaction->id)
							->get();

							$message = "Selamat, pembayaran tryout anda telah berhasil. Silahkan gunakan token dibawah ini untuk masing-masing tryout yang anda pesan.\n\n";

							foreach ($items as $key => $value) {
								$tryout = Tryout::where('id', $value->item_id)
								->first();

								if($tryout){
									$token = $this->generateKey($transaction->user_id);

									StudentTryout::create([
										'tryout_id' => $value->item_id,
										'user_id' => $transaction->user_id,
										'student_id' => $transaction->student_id,
										'key' => $token,
										'status' => 0,
										'remaining_time' => $tryout->duration * 60,
										'is_fee' => 0
									]);

									$message .= "Tryout : ".$tryout->title."\n";
									$message .= "Token : *".$token."*\n";
									$message .= "Link : ".(url('tryout/'.$tryout->slug))."\n\n";
								}
							}

							$transaction->update([
								'status' => 1
							]);
							$payment->update([
								'status' => $data->status
							]);

							if($student->phone){
								$this->sendWa($student->phone, $message);
							}

							DB::commit();
							echo json_encode([
								'success' => true,
							]);
							return;
						}
					}
				}catch(\Exception $e){
					dd($e);
					DB::rollback();
					echo json_encode([
						'success' => false,
						'message' => $e
					]);
					return;
				}
			}
		}

		echo json_encode([
			'success' => false,
			'message' => "Transaction Not Found"
		]);
		return;
	}

	public function generateKey($user_id)
	{
		$key = strtoupper(Str::random(7).$user_id);
		$check = StudentTryout::where('key', $key)
		->where('status', 0)
		->first();

		if($check){
			return $this->generateKey($user_id);
		}

		return $key;
	}
}
