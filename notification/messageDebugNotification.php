<?php 
$token = trim($_GET['token']);
$senderName = trim($_GET['sender_name']);
$senderPhoto = trim($_GET['sender_photo']);
$senderID = trim($_GET['sender_id']);
$roomID = trim($_GET['room_id']);
//$requestId = $_GET['request_id'];
$message_category = trim($_GET['message_category']);
$message_title = trim($_GET['message_title']);
$message_content = trim($_GET['message_content']);

	$api_key='AAAAZTFM7-o:APA91bGtqnhMf1J4SM3XXJ-bxP8KgYGhAA7axYuW9vwgZYmmXJBluuh8VSdFidV9kLcNL-tKdhxms_syo4o_u1mNyUKMPpp3hBkjuB_SpoXPc05-ZddJjlDhmASht7KizUZ8BC2LLnd-';

	$url = 'https://fcm.googleapis.com/fcm/send';

/* 	$notified = array(
		"title"=>"New request",
		"body"=>"New request from patient",
		"icon"=>"ic_request.png",
		"require_interaction"=>true); */

// 	if($type!="REQUEST"){
//      $message = array("sender_name" => $senderName,"sender_id" => $senderID,"sender_photo" => $senderPhoto);
// 	    $fields = array('data' => array("title"=>"HelloDoc", "body" => $msg));
// 	}
// 	else{

	$message = array("sender_name" => $senderName,"sender_id" => $senderID,"sender_photo" => $senderPhoto,"room_id" => $roomID,"message_category" => $message_category,"message_title" => $message_title,"message_content" => $message_content);

		$fields = array(
			'to' => $token,
			'priority'=>'high',
			'data' => $message,
			'time_to_live'=>0,
			'message_type'=>'nack',
			'content_available'=>false
			// 'notification'=>$notified,
		    );
	    
// 	}

	//      if (is_null($token)) {
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
	die('Problem occurred: ' . curl_error($ch));
	}

	curl_close($ch);
	echo $result;
	//echo "curl: ".$ch;
	//echo "result: ".$result;
	//return $result;

?>