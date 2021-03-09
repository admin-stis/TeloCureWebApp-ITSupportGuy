<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\MailSendController;
use Mail;
use Log;
use App\Settings;

require_once 'twilio_vendor/autoload.php'; 
use Twilio\Rest\Client;

class TwilioController extends Controller
{
    public function twiliosms(Request $request)
    {
        $smsSqlData = Settings::get()->toArray();
        if(isset($smsSqlData)) { 
            //dd(trim($smsSqlData[0]['SmsApi'])); 
        } else { dd('tset'); }
        // see https://getcomposer.org/doc/01-basic-usage.md             
        try{
        // Find your Account Sid and Auth Token at twilio.com/console
        // DANGER! This is insecure. See http://twil.io/secure
        $sid    =  "AC5489bc3d2b3c8adf001879f1e9fa7417";   // trial"ACc170e1891afa9f0bf07fdc5b1e9881dd";
        $token  = "3b5a096390610a118103a93f452caa8f";    // trial"0f36645b30d3a5d94fec281614460d23";
        $twilio = new Client($sid, $token);
        
        $message = $twilio->messages->create("+".$request->phone."", //// "+8801748386620", //// to
            [
                "body" => "".$request->otp,
                "from" => "+16503999515"    //"+14158779876" 
            ]
            );
        
        //print($message->sid);               
        if(isset($message->sid)) { 
            $error_msg = ""; $msg_status = ""; 
            if(isset($message->error_message)){ $error_msg =  $message->error_message; }
            if(isset($message->status)){ $msg_status =  $message->status; }
            
            Log::info("twilio sms success log - sid ".$message->sid." to ".$message->to." err msg ".$error_msg." status ".$msg_status);
        
            return response()->json(['status' => 'SUCCESS'],200);
            
        } else {
            Log::info("twilio sms failed log - no sid returned");
            
            return response()->json(['status' => 'FAILED'],200);
        }
        } catch(\Exception $e){            
            //dd($e); 
            Log::info("Error in twilio sms- ".$e);
        }             
        
    }
    
   
}