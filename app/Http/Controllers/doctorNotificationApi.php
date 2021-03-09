<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\MailSendController;
use Log;
//use Artisan; //for artisan command execute without command line

class doctorNotificationApi extends Controller
{
    public function docNotification(Request $request)
    {

        try {
           // Log::error("test");
        $logdata = "doc notification started, ";
            
        $token = $request->token;    //doctor Id
        $senderName = $request->sender_name;
        $senderPhoto = $request->sender_photo;
        $senderID = $request->sender_id; //patient Id
        $roomID = $request->room_id;
        //    $requestId = $request->request_id;

        
        $api_key = 'AAAAZTFM7-o:APA91bGtqnhMf1J4SM3XXJ-bxP8KgYGhAA7axYuW9vwgZYmmXJBluuh8VSdFidV9kLcNL-tKdhxms_syo4o_u1mNyUKMPpp3hBkjuB_SpoXPc05-ZddJjlDhmASht7KizUZ8BC2LLnd-';

        $url = 'https://fcm.googleapis.com/fcm/send';


        $notified = array(
            "title" => "New request",
            "body" => "New request from patient",
            "icon" => "ic_request.png",
            "require_interaction" => true
        );

        // 	if($type!="REQUEST"){


        //      $message = array("sender_name" => $senderName,"sender_id" => $senderID,"sender_photo" => $senderPhoto);

        // 	    $fields = array('data' => array("title"=>"HelloDoc", "body" => $msg));
        // 	}
        // 	else{

        $message = array("sender_name" => $senderName, "sender_id" => $senderID, "sender_photo" => $senderPhoto, "room_id" => $roomID);

        $fields = array(
            'to' => $token,
            'priority' => 'high',
            'data' => $message,
            'time_to_live' => 0,
            'message_type' => 'nack',
            'content_available' => false
            // 'notification'=>$notified,
        );

        // 	}

        // if (is_null($token)) {
        // $fields = array(
        // // 'to' => $token ,
        // 'data' => array("title"=>"HelloDoc", "body" => $msg)
        // );
        //       }else{
        //       	$fields = array(
        // 'to' => $token ,
        // 'data' => array("title"=>"HelloDoc", "body" => $msg)
        // );

        //       }

        $jsondata = json_encode($fields);

        $headers = array(
            'Authorization: key=' . $api_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);

        $result = curl_exec($ch);
        if ($result === FALSE) {
            // die('Problem occurred: ' . curl_error($ch));
            $logdata.= "curl error - ".curl_error($ch);
            Log::info($logdata);
            return response()->json(['error'=> 'true', 'message' => 'following error found - '.curl_error($ch)],201);
        }

        curl_close($ch); 
        // echo "curl: " . $ch;
        // echo "result: " . $result;
        $logdata.= $result;
               
        $firestore = app('firebase.firestore');

        $db = $firestore->database();

        $treatment_requests = $db->collection('treatment_requests');
        $treatmentData = $treatment_requests->document($senderID);
        //$snapsot = $docRef->snapshot();
        $treatmentData->set([
            'stat' => "REQUESTING"
        ], ['merge' => true]);         
        
        //echo "curl: " . $ch;
        //echo "result: " . $result;
        //return $result;
        
        Log::info($logdata);
        return response()->json(['error'=> 'false', 'message' => "fcm sent and stat field updated"],200);
        
        } catch(\Exception $e){
            Log::error("exception on doc notification:".$e);
            return response()->json(['error'=> 'true', 'message' => "Exceptions found"],200);
        }
    }
}