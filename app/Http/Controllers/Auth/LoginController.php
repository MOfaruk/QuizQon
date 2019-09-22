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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/'; //TBD redirect to desired url
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');        
    }
    
    /**
     * Credit Goes to: 
     * https://laracasts.com/discuss/channels/laravel/auth-login-with-custom-fields?page=1
     * https://tutsforweb.com/laravel-auth-login-email-username-one-field/#
     *
     */
    public function username()
    {
        $this->username = 'phone'; //or define a function for more complex situation
        
        return $this->username;
    }
}
