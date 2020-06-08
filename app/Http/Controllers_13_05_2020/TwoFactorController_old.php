<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TwoFactorController extends Controller
{
    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            '2fa' => 'required',
        ]);

        if($request->input('2fa') == Auth::user()->token_2fa){            
            $user = Auth::user();
            $user->token_2fa_expiry = \Carbon\Carbon::now()->addMinutes(config('session.lifetime'));
            $user->save(); 

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
            // return redirect('/home');
        } else {
            return redirect('/2fa')->with('message', 'Incorrect code.');
        }
    }

    public function showTwoFactorForm()
    {
        return view('auth.two_factor');
    }   
}
