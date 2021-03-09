<?php 
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\MailSendController;
use Log;
//use Artisan; //for artisan command execute without command line 

class DocSmsController extends Controller
{
    public function test_form(Request $request)
    {
      
    }
    public function doctorinstantsms(Request $request)
    {             

        //check if the request came from cron job or not
        /* if($request->token=="token_125")
        {
            
        try{
            
        $logdata = "doctor sms sending started: ";
        //Log::info("request came");
        $firestore = app('firebase.firestore');
        //$realtime_db = app('firebase.database');
        $phone=""; $text = ""; $link = ""; $message=""; 
        
        $db = $firestore->database();
        $doctorRef = $db->collection('doctors');
        //$frb_tz = new \DateTimeZone('Asia/Dhaka');
        
        $query = $doctorRef->where('active','=',true)->where('rejected','=',false);
        $activeDoctor = $query->documents();
       // $onlineDoctorList = array();
        foreach ($activeDoctor as $doctor) {
            if($doctor->exists()){
                $data = $doctor->data();
                if($data['active']){  
                    //start processing if not engaged                  
                    $phone = $data['phone'];
                    $text = $request->text;
                    $link = $request->link;
                    $message = $text." - ".$link;
                    
                    //////////////sslcommerz sms sending starts //////////////
                    $msisdn = $phone; //$phone;
                    $messageBody = $message;
                    $csmsId = uniqid(); // csms id must be unique
                    
                    echo $this->singleSms($msisdn, $messageBody, $csmsId);
                    
                    $logdata.="sms sent to - ".$phone.", ";

                //} //engaged field false condition ends
               } //if online = true condition ends 
            } //if doc exists condition ends
        } //foreach ends
        
        Log::info("sms job data: ".$logdata);
        return $logdata;
        
        } catch(\Exception $e){
            Log::error("Error in sms job: ".$e);
            return "exceptin errors";
        }
        }  */
        //dd($onlineDoctorList);                            
       
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
