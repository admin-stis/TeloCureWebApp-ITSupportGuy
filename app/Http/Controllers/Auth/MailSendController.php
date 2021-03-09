<?php

namespace App\Http\Controllers\Auth;
use App\Mail\OtpEmail;
use App\Mail\passwordLinkEmail;
use App\Mail\sendResetPassword;
use App\Mail\subscribe;
use App\Mail\contactUs;
use App\Mail\sendLink;
use App\Mail\SendRequest;
use Mail;
use Log;

class MailSendController
{
    public function sendOtp($otp,$receiver){

        $objDemo = new \stdClass();
        $objDemo->code = $otp;
        // $objDemo->code = 'Demo Two Value';
        $objDemo->sender = 'TeloCure';
        $objDemo->receiver = $receiver;

        //Mail::to($receiver)->send(new OtpEmail($objDemo));
        
        //mridul 21-7-20
        //email failure tests
        try {
            Mail::to($receiver)->send(new OtpEmail($objDemo));
            
        } catch(\Exception $e){
            Log::error("mail exception - ".$e->getMessage());
            if (count(Mail::failures()) > 0) {
                Log::error("mail failure log through exception");
            }
        }
        
        if(count(Mail::failures()) > 0){
            Log::error("mail failure general log");
        }

        if (Mail::failures()){
          return false;
        }else{
          return true;
        }
    }


    public function sendDoc($otp,$receiver){
        
        $objDemo = new \stdClass();
        $objDemo->code = $otp ;
        
        // $objDemo->code = 'Demo Two Value';
        
        $objDemo->sender = 'TeloCure Team';
        $objDemo->receiver = $receiver;
        
        // echo $receiver;
        // dd($objDemo);

        Mail::to($receiver)->send(new sendLink($objDemo));
        
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
        
        //28-01-21 set only receiver here and test cc 
        //Mail::to($userEmail)->send(new contactUs($objDemo)); //previous
        Mail::to("mridul.stis@gmail.com")->cc($userEmail)->send(new contactUs($objDemo)); //new //cc kept for testing will be removed

        if (Mail::failures()){
          return false;
        }else{
          return true;
        }
    }




}
