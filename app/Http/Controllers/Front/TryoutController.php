<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\StudentTryout;
use App\Models\Tryout;
use App\Models\Cart;
use App\Models\Student;
use Auth;
use Session;
use Illuminate\Support\Facades\Mail;

class TryoutController extends Controller
{
	public function index(Request $request)
	{
		$tag = $request->tag;

		$newest = Tryout::where('tags', 'LIKE', '%terbaru%')
		->where('deleted', 0)
		->where('published', 1)
		->orderBy('id', 'DESC')
		->limit(5)
		->get();

		foreach ($newest as $key => $value) {
			$value->tags = explode(',', $value->tags);
		}

		$datas = Tryout::where('deleted', 0)
		->where('published', 1)
		->when($tag, function($q) use($tag) {
			return $q->where('tags', 'LIKE', '%'.$tag.'%');
		})
		->paginate(20);

		foreach ($datas as $key => $value) {
			$value->tags = explode(',', $value->tags);
		}

		return view('front.tryout.index')->with([
			'title' => 'Tryout',
			'newest' => $newest,
			'datas' => $datas,
			'tag' => $tag,
		]);
	}

	public function show($slug)
	{
		$data = Tryout::where('slug', $slug)
		->firstOrFail();
		$exam = 0;
		if(Auth::check()){
			$exam = StudentTryout::where('tryout_id', $data->id)
			->where('user_id', Auth::user()->id)
			->where('status', 2)
			->count();
		}

		return view('front.tryout.show')->with([
			'title' => $data->title,
			'data' => $data,
			'result' => ($exam > 0) ? true : false,
			'slug' => $slug
		]);
	}

	public function process($slug, Request $request)
	{
		$id = $request->id;

		$data = Tryout::where('id', $id)
		->where('deleted', 0)
		->firstOrFail();

		if(Auth::check()){
			if($data->price == null || $data->price == 0){
				$studentTryout = StudentTryout::where('tryout_id', $data->id)
				->where('user_id', Auth::user()->id)
				->whereIn('status', [0,1])
				->first();

				if($studentTryout){
					return back()->with([
						'warning' => 'Anda sudah terdaftar di tryout ini, silahkan periksa inbox email anda'
					]);
				}else{
					$student = Student::where('user_id', Auth::user()->id)
					->first();
					$message = "Selamat, pembayaran tryout anda telah berhasil. Silahkan gunakan token dibawah ini untuk masing-masing tryout yang anda pesan.\n\n";
					$token = $this->generateKey(Auth::user()->id);

					StudentTryout::create([
						'tryout_id' => $data->id,
						'user_id' => Auth::user()->id,
						'student_id' => $student->id,
						'key' => $token,
						'status' => 0,
						'remaining_time' => $data->duration * 60,
						'is_fee' => 1
					]);

					$message .= "Tryout : ".$data->title."\n";
					$message .= "Token : *".$token."*\n";
					$message .= "Link : ".(url('tryout/'.$data->slug))."\n\n";

					/* disable sementara belum ada api provider whatsapp
					if($student->phone){
						$this->sendWa($student->phone, $message);
					}*/

					if($student->email){
						try{
							Mail::send('emails.token', ['token' => $token, 'link' => (url('tryout/'.$data->slug)), 'tryout' => $data->title], function ($m) use ($student) {
								$m->from('info@kartuujian.com', 'Kartu Ujian Dot Com');
						
								$m->to($student->email, $student->name)->subject('Token Tryout Kartu Ujian');
							});

							return back()->with([
								'warning' => 'Token berhasil di redeem, silahkan periksa inbox email anda'
							]);
						}catch(\Exception $e){

						}
					}
				}
			}

			$cart = Cart::where('user_id', Auth::user()->id)
			->where('item_id', $id)
			->first();

			if(!$cart){
				Cart::create([
					'user_id' => Auth::user()->id,
					'item_id' => $id
				]);
			}

			return redirect('cart');
		}

		return redirect('/login')->with([
			'warning' => 'Silahkan login terlebih dahulu'
		]);
	}

	public function token($slug, Request $request)
	{
		$id = $request->id;
		$token = $request->token;

		$data = Tryout::where('id', $id)
		->where('deleted', 0)
		->firstOrFail();

		if(Auth::check()){

			$tryout = StudentTryout::where('key', $token)
			->where('user_id', Auth::user()->id)
			->first();

			if($tryout){
				if(in_array($tryout->status, [0,1])){
					Session::put('token', $token);
					return redirect('exam/'.$slug)->with([
						'success' => 'Selamat Mengerjakan'
					]);
				}

				return back()->with([
					'warning' => 'Token Tidak Bisa Digunakan Lagi'
				]);
			}

			return back()->with([
				'warning' => 'Token Tidak Valid'
			]);
		}

		return redirect('/login')->with([
			'warning' => 'Silahkan login terlebih dahulu'
		]);
	}

	private function generateKey($user_id)
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
