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

        // if($request->input('2fa') == Auth::user()->token_2fa){

        //     $user = Auth::user();
        //     $user->token_2fa_expiry = \Carbon\Carbon::now()->addMinutes(config('session.lifetime'));
        //     $user->save();

        //     if(Auth::user()->hasRole('doctor')){
        //         return redirect('/doctor');
        //     }
        //     else if(Auth::user()->hasRole('patient')){
        //         return redirect('/patient');
        //     }
        //     else if (Auth::user()->hasRole('hospital')){
        //         return redirect('/hospital');
        //     }
        //     else if(Auth::user()->hasRole('admin')){
        //         return redirect('admin');
        //     }
        //     // return redirect('/home');
        // } else {
        //     return redirect('/2fa')->with('message', 'Incorrect code.');
        // }

        $helodoc2fa = $request->session()->get('helodoc2fa');

        $user = $request->session()->get('user');

        $district = $request->session()->get('district');

        if($request->input('2fa') == $helodoc2fa['opt']){

            $helodoc2fa=array(
                // 'title' => $request->title,
                'title' => $helodoc2fa['title'],
                'opt'   => $helodoc2fa['opt'],
                'status'=> true
            );

            $request->session()->put('helodoc2fa', $helodoc2fa);
            $request->session()->put('user', $user);
            $request->session()->put('district', $district);

            if($helodoc2fa['title'] == 'doctor' ){
                if(!isset($user[0]['regNo']))
                return redirect('/doctor/profile');
                else{
                    $request->session()->get('user');
                    return redirect('/doctor');
                }
                // return redirect('/doctor');
                // if(isset($user[0]['regNo'])){
                //     if( $user[0]['regNo'] != null){
                //         return redirect('/doctor');
                //     }
                //     else return redirect('/doctor/profile');
                // }else{
                //     return redirect('/doctor/profile');
                // }
            }
            else if($helodoc2fa['title'] =='patient'){
                $request->session()->get('user');
                return redirect('/patient');
            }
            else if ($helodoc2fa['title'] =='hospital'){
                return redirect('/hospital');
            }
            else if($helodoc2fa['title'] =='admin'){
                return redirect('/admin');
            }
            dd($helodoc2fa);

        } else {
            return redirect('/2fa')->with('message', 'Incorrect code.');
        }
    }

    public function showTwoFactorForm()
    {
        return view('auth.two_factor');
    }
}
