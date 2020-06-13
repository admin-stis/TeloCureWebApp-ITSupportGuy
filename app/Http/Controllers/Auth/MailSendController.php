<?php

namespace App\Http\Controllers\Auth;
use App\Mail\OtpEmail;
use App\Mail\passwordLinkEmail;
use App\Mail\sendResetPassword;
use App\Mail\subscribe;
use App\Mail\contactUs;
use App\Mail\SendRequest;
use Mail;

class MailSendController
{
    public function sendOtp($otp,$receiver){

        $objDemo = new \stdClass();
        $objDemo->code = $otp;
        // $objDemo->code = 'Demo Two Value';
        $objDemo->sender = 'TeloCure';
        $objDemo->receiver = $receiver;

        Mail::to($receiver)->send(new OtpEmail($objDemo));

        if (Mail::failures()){
          return false;
        }else{
          return true;
        }
    }

    public function sendlink($otp,$receiver){

        $objDemo = new \stdClass();
        $objDemo->code = $otp ;
        //dd($objDemo->code);
        // $objDemo->code = 'Demo Two Value';
        $objDemo->sender = 'TeloCure Team';
        $objDemo->receiver = $receiver;

        Mail::to($receiver)->send(new passwordLinkEmail($objDemo));

        if (Mail::failures()){
          return false;
        }else{
          return true;
        }
    }

    public function sendRequest($data,$sender,$receiver){
        $obj = new \stdClass();
        $obj->code = $data;
        $obj->sender = $sender;
        $obj->receiver = $receiver;

        Mail::to($receiver)->send(new SendRequest($obj));

        if (Mail::failures()){
            return false;
        }else{
            return true;
        }
    }

    public function sendResetPassword($otp,$receiver){

        $objDemo = new \stdClass();
        $objDemo->code = $otp ;
        // $objDemo->code = 'Demo Two Value';
        $objDemo->sender = 'TeloCure';
        $objDemo->receiver = $receiver;

        Mail::to($receiver)->send(new sendResetPassword($objDemo));

        if (Mail::failures()){
          return false;
        }else{
          return true;
        }
    }

    public function subscribe($otp,$receiver){

        $objDemo = new \stdClass();
        $objDemo->code = $otp ;
        // $objDemo->code = 'Demo Two Value';
        $objDemo->sender = 'TeloCure';
        $objDemo->receiver = $receiver;

        Mail::to($receiver)->send(new subscribe($objDemo));

        if (Mail::failures()){
          return false;
        }else{
          return true;
        }
    }

    public function contactusMail($name,$userEmail,$phone,$subject,$message,$email){

        $objDemo = new \stdClass();

        $objDemo->name = $name;
        $objDemo->subject = $subject;
        $objDemo->sender = $userEmail;
        $objDemo->receiver = $email;
        $objDemo->phone = $phone;
        $objDemo->message = $message;

        Mail::to($userEmail)->send(new contactUs($objDemo));

        if (Mail::failures()){
          return false;
        }else{
          return true;
        }
    }




}
