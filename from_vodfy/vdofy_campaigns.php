<?php
include("../db.php");

$name = $_GET['name'];
$whatsapp = $_GET['whatsapp'];
$mobile = $_GET['whatsapp'];
$message = $_GET['instructions'];
$source = $_GET['source'];
$email = $_GET['email'];

$conn = new mysqli ($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$date = date_default_timezone_set('Asia/Kolkata');
$date = date('M-d,Y H:i:s');
$time = strtotime($date);

$sql5 = "SELECT * FROM chats WHERE number = '$whatsapp'";
$result5 = $conn->query($sql5);
if ($result5->num_rows > 0) {                               
while($row5 = $result5->fetch_assoc()) { 
	$u_name = $row5["name"];
	$u_id = $row5["id"];

    $sql2 = "INSERT INTO chat_messages (u_id, message, by_whom, status, date)
             VALUES ('$u_id', '$message', 'user', 'NA', '$time')";
             if ($conn->query($sql2) === TRUE) {  } else {  echo "ERROR" . $sql2 . "<br>" . $conn->error; } 

		// Whatsapp API - Chat-API
	$data2 = [
		'phone' =>	'91'.$mobile, 
		'body' => $message, 
	];
	$json2 = json_encode($data2); 
	$token2 = '2jrpj6v32qc0ncyv';
	$instanceId2 = '243079';
	$url2 = 'https://eu12.chat-api.com/instance'.$instanceId2.'/message?token='.$token2;
	$options2 = stream_context_create(['http' => [
			'method'  => 'POST',
			'header'  => 'Content-type: application/json',
			'content' => $json2
		]
	]);
	$result2 = file_get_contents($url2, false, $options2);
		
		header("location:https://vdofy.com/campaigns/2/$source/thank-you.php?email=$email");
	
} } else { 
    
    
    if($source == 'Smart-GAd-1') { } else {
	
        $sql = "INSERT INTO chats (name, number)
        VALUES ('$name', '$mobile')";
        
        if ($conn->query($sql) === TRUE) {
        	$u_id = $conn->insert_id;
        
        
        $sql2 = "INSERT INTO chat_messages (u_id, message, by_whom, status, date)
                 VALUES ('$u_id', '$message', 'user', 'NA', '$time')";
                 if ($conn->query($sql2) === TRUE) {  } else {  echo "ERROR" . $sql2 . "<br>" . $conn->error; } 
        
        
        // Whatsapp API - Chat-API
        $data2 = [
        	'phone' =>	'91'.$mobile, 
        	'body' => $message, 
        ];
        $json2 = json_encode($data2); 
        $token2 = '2jrpj6v32qc0ncyv';
        $instanceId2 = '243079';
        $url2 = 'https://eu12.chat-api.com/instance'.$instanceId2.'/message?token='.$token2;
        $options2 = stream_context_create(['http' => [
        		'method'  => 'POST',
        		'header'  => 'Content-type: application/json',
        		'content' => $json2
        	]
        ]);
        $result2 = file_get_contents($url2, false, $options2);
        		
        	header("location:https://vdofy.com/campaigns/2/$source/thank-you.php?email=$email");
        
        }
        else {
        	echo "ERROR" . $sql . "<br>" . $conn->error;
        }

    }

}