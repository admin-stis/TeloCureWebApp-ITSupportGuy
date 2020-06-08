<?php

namespace App\Http\Controllers\Auth;
use App\Mail\OtpEmail;
use Mail;

class MailSendController
{
    public function sendOtp($otp,$receiver){

        $objDemo = new \stdClass();
        $objDemo->code = $otp;
        // $objDemo->code = 'Demo Two Value';
        $objDemo->sender = 'Hello Doc';
        $objDemo->receiver = $receiver;

        Mail::to($receiver)->send(new OtpEmail($objDemo));
        
        if (Mail::failures()){
          return flase;
        }else{
          return true;
        }

    }
    
}
