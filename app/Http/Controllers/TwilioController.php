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
        
        // see https://getcomposer.org/doc/01-basic-usage.md             
        try{
        
            $smsSqlData = Settings::get()->toArray();
            if(isset($smsSqlData)) {
                if(isset($smsSqlData[0]['SmsApi'])){
                    $apiToUse = trim($smsSqlData[0]['SmsApi']);                                                                    
                    if($apiToUse=="twilio") { 
        ///////////twilio sms sending starts ///////////////
        // Find your Account Sid and Auth Token at twilio.com/console
        // DANGER! This is insecure. See http://twil.io/secure         
        $sid    = "AC5489bc3d2b3c8adf001879f1e9fa7417"; //trial "ACc170e1891afa9f0bf07fdc5b1e9881dd";
        $token  = "3b5a096390610a118103a93f452caa8f"; //trial "0f36645b30d3a5d94fec281614460d23";
        $twilio = new Client($sid, $token);
        
        $message = $twilio->messages->create("+".$request->phone."", //// "+8801748386620", //// to
            [
                "body" => "".$request->otp,
                "from" => "+16503999515" 
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
            
            } //twilio ends 
            else { if($apiToUse=="sslcommerz") { 
            //////////////sslcommerz sms sending starts //////////////
            $msisdn = "".$request->phone.""; //$phone;
            $messageBody = "".$request->otp;
            $csmsId = uniqid(); // csms id must be unique
                        
            echo $this->singleSms($msisdn, $messageBody, $csmsId);
            
            Log::info("sslcommerz sms success log-"."".$request->phone.""."".$request->otp);
            
            return response()->json(['status' => 'SUCCESS'],200);
            }}
            
                } else {  Log::info("sms api error, mysql setting table smsapi field not set"); } } else {  Log::info("sms api error, empty data returned in mysql query"); }
        } catch(\Exception $e){            
            //dd($e); 
            //Log::info("Error in twilio sms- ".$e); //twilio
            Log::info("Error in sslcommerz sms- ".$e); //new sslcommerz
        }             
        
    }
    // sms system    
    /**
     * @param $msisdn
     * @param $messageBody
     * @param $csmsId (Unique)
     */
    public function singleSms($msisdn, $messageBody, $csmsId)
    {
        $api_token = "smartecch-23572135-15fc-459c-a718-4417c3537662"; //put ssl provided api_token here
        $sid = "SMARTTECHNON"; // put ssl provided sid here
        //const DOMAIN = "<API_DOMAIN>"; //api domain // example http://smsplus.sslwireless.com
        $params = [
            "api_token" => $api_token,
            "sid" => $sid,
            "msisdn" => $msisdn,
            "sms" => $messageBody,
            "csms_id" => $csmsId
        ];
        $url = "https://smsplus.sslwireless.com/api/v3/send-sms";
        $params = json_encode($params);
        
        echo $this->callApi($url, $params);
    }         
    public function callApi($url, $params)
    {
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));
        
        $response = curl_exec($ch);
        
        curl_close($ch);
        
        return $response;
    }
   
}
