<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Str;
use App\User;
use Storage;
use Image;
use File;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function getIcon($method){
		switch ($method) {
			case 'Maybank Virtual Account':
			return 'images/bank/maybank.webp';
			case 'Permata Virtual Account':
			return 'images/bank/permata.webp';
			case 'BNI Virtual Account':
			return 'images/bank/bniva.webp';
			case 'BRI Virtual Account':
			return 'images/bank/briva.webp';
			case 'Mandiri Virtual Account':
			return 'images/bank/mandiri.webp';
			case 'BCA Virtual Account':
			return 'images/bank/bcava.webp';
			case 'Muamalat Virtual Account':
			return 'images/bank/muamalat.webp';
			case 'Sinarmas Virtual Account':
			return 'images/bank/sinarmas.webp';
			case 'BRI Virtual Account (Open Payment)':
			return 'images/bank/briva.webp';
			case 'BNI Virtual Account (Open Payment)':
			return 'images/bank/bniva.webp';
			case 'CIMB Niaga Virtual Account (Open Payment)':
			return 'images/bank/cimb.webp';
			case 'BCA Virtual Account (Open Payment)':
			return 'images/bank/bcava.webp';
			case 'Alfamart':
			return 'images/bank/alfamart.webp';
			case 'Alfamidi':
			return 'images/bank/alfamidi.webp';
			case 'QRIS':
			return 'images/bank/qris.webp';
			
			default:
			return 'images/bank/default.png';
			break;
		}
	}

	public function paymentMethod($type = 'all'){
		$ewallet = [];
		$wallet = [];
		$stores = [];

		if($type == 'all' || $type == 'instant'){
			$instants = [];
			$baseUrl = config('app.tripay_url');
			$apiKey = config('app.tripay_api_key');

			try{
				$client = new Client([
					'base_uri' => $baseUrl
				]);
				$response = $client->get('merchant/payment-channel', [
					'headers' => [
						'authorization' => 'Bearer '.$apiKey,
						'accept' => 'Application/json'
					],
					'http_errors' => false,
				]);

				$status = $response->getStatusCode();
				if($status == 200){
					$body = json_decode($response->getBody())->data;
					foreach ($body as $key => $value) {
						if($value->active){
							if($value->group == 'Convenience Store'){
								$value->icon = $this->getIcon($value->name);
								$value->service_name = $value->name;
								$value->request_code = 'stores-'.$value->code.'-'.$value->name;
								$stores[] = $value;
							}else{
								if($value->name == 'QRIS'){
									$value->icon = $this->getIcon($value->name);
									$value->service_name = $value->name;
									$value->request_code = 'ewallet-'.$value->code.'-'.$value->name;
									$ewallet[] = $value;
								}else{
									$value->icon = $this->getIcon($value->name);
									$value->service_name = $value->name;
									$value->request_code = 'instant-'.$value->code.'-'.$value->name;
									$instants[] = $value;
								}
							}
						}
					}
				}
			}
			catch(\Exception $e){
			}
		}

		if($type == 'all'){
			$accounts = [
				'ewallet' => $ewallet,
				'instant' => $instants,
				'stores' => $stores
			];
		}else{
			$accounts = $banks;
		}

		return $accounts;
	}

	public function slugify($text)
	{
		return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
	}

	public function usernamify($name)
	{
		$generated = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', substr($name, 0, 8)));

		$user = User::where('name', $generated)
		->first();
		if($user){
			return $this->usernamify($generated.Str::random(3));
		}

		return $generated;
	}

	public function resizeImage($file, $path = null, $width = null)
	{
		$path = 'uploads/'.($path ?? 'resized_image').'/';
		$fullpath = storage_path('/app/public/').$path;
		$size = $width ?? 250;

		File::isDirectory($fullpath) or File::makeDirectory($fullpath, 0777, true, true);

		$fileName = Date('YmdHis').'_' . uniqid() . '.' . $file->getClientOriginalExtension();

		$resizeImage  = Image::make($file)->resize(null, $size, function($constraint) {
			$constraint->aspectRatio();
		});
		$resizeImage->save($fullpath.$fileName);
		return $path.$fileName;
	}

	public function isImage($file)
	{
		$extension = ['jpg', 'jpeg', 'png'];
		if(!in_array($file->getClientOriginalExtension(), $extension)){
			return false;
		}

		return true;
	}

	public function deleteFile($path)
	{
		if($path != null && Storage::exists($path)){
			Storage::delete($path);
		}

		return true;
	}

	public static function generatePhone($phone){
		if($phone[0] == '+'){
			$phone = str_replace('+', '', $phone);
		}

		if($phone[0] == 0){
			return '62'.substr($phone, 1, strlen($phone));
		}else{
			return $phone;
		}
	}

	public static function sendWa($phone, $message){
		$curl = curl_init();
		$url = config("app.wablas_url");
		$token = config('app.wablas_key');

		if($url && $token){
			$data = [
				'phone' => self::generatePhone($phone),
				'message' => $message,
			];

			curl_setopt($curl, CURLOPT_HTTPHEADER,
				array(
					"Authorization: $token",
				)
			);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($curl, CURLOPT_URL, $url."/api/send-message");
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			$result = curl_exec($curl);
			curl_close($curl);
		}

		return true;
	}
}
