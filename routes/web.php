<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('transaction/callback', 'Front\PaymentController@callback');

Route::get('home', function(){
	$route = '/';
	if(auth()->check()){
		if(auth()->user()->level == 'admin'){
			$route =  '/admin';
		}else{
			$route =  '/';
		}
	}else{
		$route =  '/login';
	}
	return redirect($route);
});

Auth::routes();

Route::group([
	'namespace' => 'Front',
], function(){
	Route::get('/', 'FrontController@home');

	Route::get('/tryout', 'TryoutController@index');
	Route::get('/tryout/{slug}', 'TryoutController@show');

	Route::get('/leaderboard', 'LeaderBoardController@index');

	Route::group([
		'middleware' => [
			'auth',
			'is.role:student'
		],
	], function(){
		Route::post('/tryout/{slug}', 'TryoutController@process');
		Route::post('/tryout/{slug}/token', 'TryoutController@token');

		Route::get('/cart', 'BuyController@cart');
		Route::post('/cart', 'BuyController@proceedCart');
		Route::get('/cart/{id}/remove', 'BuyController@remove');
		Route::get('/cart/check', 'BuyController@check');
		Route::get('/cart/payment', 'BuyController@payment');
		Route::post('/cart/payment', 'BuyController@checkout');

		Route::get('/transaction/how-to-pay/{id}', 'TransactionController@howToPay');

		Route::post('/payment/fee', 'PaymentController@fee');

		Route::get('/exam/{slug}', 'ExamController@index');
		Route::post('/exam/{slug}/answer/{question_id}', 'ExamController@answer');
		Route::post('/exam/{slug}/doubt/{question_id}', 'ExamController@doubt');
		Route::post('/exam/{slug}/tick', 'ExamController@tick');
		Route::post('/exam/{slug}/finish', 'ExamController@finish');

		Route::get('/result/{slug}', 'ResultController@show');
		Route::get('/result/{slug}/download', 'ResultController@download');
		Route::get('/result/{slug}/answer/{answer_id}', 'ResultController@detail');
	});
});

Route::group([
	'middleware' => 'auth'
], function(){
	Route::group([
		'namespace' => 'Admin',
		'middleware' => 'is.role:admin',
		'prefix' => 'admin'
	], function(){
		Route::get('/', 'HomeController@index');

		Route::resource('/tryout/question', 'QuestionController', ['except' => 'show']);
		Route::resource('/tryout/tryout', 'TryoutController', ['except' => 'show']);
		Route::get('/tryout/tryout/{id}/publish', 'TryoutController@publish');
		Route::get('/tryout/tryout/{id}/question', 'TryoutController@question');
		Route::post('/tryout/tryout/{id}/question/data', 'TryoutController@questionData');
		Route::post('/tryout/tryout/{id}/question', 'TryoutController@questionSave');

		Route::get('/exam/buy', 'ExamController@buy');
		Route::get('/exam/running', 'ExamController@running');
		Route::get('/exam/result', 'ExamController@result');

		Route::get('/member', 'MemberController@index');
		Route::get('/member/export', 'MemberController@export');
	});
});
