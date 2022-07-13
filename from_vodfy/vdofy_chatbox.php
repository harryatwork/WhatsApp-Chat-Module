<?php header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
include("../db.php");

$mobile = $_GET["whatsapp"];
$name = $_GET["name"];
$email = $_GET["email"];
$message = $_GET["message"];

$conn = new mysqli ($servername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$date = date_default_timezone_set('Asia/Kolkata');
$date = date('M-d,Y H:i:s');
$time = strtotime($date);

$sql5 = "SELECT * FROM chats WHERE number = '$mobile'";
$result5 = $conn->query($sql5);
if ($result5->num_rows > 0) {                               
while($row5 = $result5->fetch_assoc()) { 
	$u_name = $row5["name"];
	$u_id = $row5["id"];

    $sql2 = "INSERT INTO chat_messages (u_id, message, by_whom, status, date)
             VALUES ('$u_id', '$message', 'user', 'NA', '$time')";
             if ($conn->query($sql2) === TRUE) {  } else {  echo "ERROR" . $sql2 . "<br>" . $conn->error; } 
	
} } else { 
	
	$sql = "INSERT INTO chats (name, number, c_code)
	VALUES ('$name', '$mobile', '1')";

	if ($conn->query($sql) === TRUE) {
		$u_id = $conn->insert_id;
	} else {
		echo "ERROR" . $sql . "<br>" . $conn->error;
	}

}

	// Whatsapp API - Chat-API
	$data2 = [
		'phone' =>	'91'.$mobile, 
		'body' => 'Thanks for messaging, our representative will get in touch with you soon.', 
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
		
		header("location:https://wa.me/+916362015109/?text=$message");

