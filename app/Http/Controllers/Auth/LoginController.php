<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $username = request()->name;

        $email = User::where('email', $username)
        ->first();

        if($email){
            request()->merge([
                'email' => $username
            ]);
            return 'email';
        }

        $phone = User::where('phone', $username)
        ->first();

        if($phone){
            request()->merge([
                'phone' => $username
            ]);
            return 'phone';
        }

        return 'name';
    }

    public function redirectTo(){
        if(request()->has('url')){
            return request()->url;
        }
        
        $user = Auth::user();
        if($user->level == 'admin'){
            return '/admin';
        }else{
            return '/';
        }
    }

    public function authenticated($request, $user)
    {
        if($user->level == 'admin'){
            return redirect('/admin');
        }else{
            return redirect('/');
        }
    }
}
