<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    public function getLogin(){
        return view('backend/admin/login');
    }
    public function postLogin(LoginRequest $loginRequest){

        if (Auth::attempt(['username' => $loginRequest->username, 'password' => $loginRequest->password])) {
            Auth::user()->last_login = date('Y-m-d H:i:s');
            Auth::user()->save();
            return redirect()->route('admin.dashboard')->with('success_message', 'You are success fully loged In');
        } else {
            return redirect()->route('admin.login')->with('error_message', 'Invalid Username or Password');
        }
    }
}
