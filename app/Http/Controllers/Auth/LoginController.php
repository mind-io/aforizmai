<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = ('/');

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        if(!session()->has('url.intended')) {
            session()->put('url.intended', url()->previous());
    	}
        return view('auth.login');
	}

    // direct back to the same page the user was on after login
    // public function showLoginForm()
    // {
    //     if(!session()->has('from')){
    //         session()->put('from', url()->previous());
    //     }
    //     return view('auth.login');
    // }

    // public function authenticated($request,$user)
    // {
    //     return redirect(session()->pull('from',$this->redirectTo));
    // }

}
