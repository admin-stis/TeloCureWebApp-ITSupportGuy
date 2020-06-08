<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\MailSendController;
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
    // protected $redirectTo = '/';

    protected function redirectTo()
    {
        // return redirect('/');
        if(Auth::user()->hasRole('doctor')){
            return redirect('/doctor');
        }
        else if(Auth::user()->hasRole('patient')){
            return redirect('/patient');
        }
        else if (Auth::user()->hasRole('hospital')){
            return redirect('/hospital');
        }
        else if(Auth::user()->hasRole('admin')){
            return redirect('admin');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated()
    {
        $user = Auth::user();
        $MailSend = new MailSendController();
        $otp = mt_rand(10000,99999);
        $user->token_2fa = $otp;
        $user->save();

        $val = $MailSend->sendOtp($otp,$user->email);
        if ($val){
            return redirect('/2fa');
        }
    }
}
