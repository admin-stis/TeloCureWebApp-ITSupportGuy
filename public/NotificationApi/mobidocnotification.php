<?php 
	$token = $_GET['token'];
	    $senderName = $_GET['sender_name'];
	    $senderPhoto = $_GET['sender_photo'];
	$senderID = $_GET['sender_id'];
	//    $requestId = $_GET['request_id'];

	$api_key='AAAAYDr3JGI:APA91bFUyP7EVjDzi8l1HHvmFq_2JWw6BeBXd8E1Dg0Hds8S1hZkh4zbLQzXpPOc4SOC5_LhN4eI8-ETDPpVF-YBdcx04y0cZb4pgBwOTOeDQwjeYa0BueT44a8kBev8AoQvaxpzC5Gn';

	$url = 'https://fcm.googleapis.com/fcm/send';


	$notified = array(
		"title"=>"New request",
		"body"=>"New request from patient",
		"icon"=>"ic_request.png",
		"require_interaction"=>true);


// 	if($type!="REQUEST"){


//      $message = array("sender_name" => $senderName,"sender_id" => $senderID,"sender_photo" => $senderPhoto);

// 	    $fields = array('data' => array("title"=>"HelloDoc", "body" => $msg));
// 	}
// 	else{

	    $message = array("sender_name" => $senderName,"sender_id" => $senderID,"sender_photo" => $senderPhoto);

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
	echo "curl: ".$ch;
	echo "result: ".$result;
	return $result;

?>