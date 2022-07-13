<?php
    define('HOST','localhost');
	define('USERNAME', 'vdofybzn_pklist');
	define('PASSWORD','Chitra@3693');
	define('DB','vdofybzn_filex');
	
	$con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
    
    $servername = "localhost";
	$dbusername = "vdofybzn_pklist";
    $dbpassword = "Chitra@3693";
	$dbname = "vdofybzn_filex";
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    
	$message = $_POST['message'];
	$mobile = $_POST['whatsapp'];
	$sub_id = $_POST['sub_id'];
	
    $icon_data_base64 = 'iVBORw0KGgoAAAANSUhEUgAAADIAAAAxCAYAAACYq/ofAAAFFElEQVR4Ac2aA7QrSReF82zb792ga5/Kzf+Pbdu2bdu2bdu2bdu2Z6I9fdZNr9vPfdNdydRaO05VvuziOZ1aauflE1XF83rQ8wYTmMhsrpXALFRlMgUaTGIuN0Q/k3S7sSuo2tZONGYYgYV87URjzqfI/b5e9fWhr49r+rD22gP6GQK70JhF6JkRWkdzQIJ/3mB2ihzk61Fa+z1tvsx8npFk8xVa+wNFniRwqK+5mE73bBgIM9muNJibImfR2k+Zz1d9MZasVX1GkfMIzEeDbk5BaMw4/fdo7Sf6A5xIgYAjaTAhcZBK4f+dtT9r/6a1QfdxqQpFHiGwhP+4cyIgajOBjXWwaiMNlToPbEHPdI8FogOawM46kLXipkjkRwJ7+DC96gEJnNiB1v7ULIiQM78S2F2d6TiIyLq09puZNjLbbGRrqzbmGuYH7eK65kQGqU2vb0ewndx1V/L4E8gFFtDnrrvZ+zRYIBIIgeEUuTVSxQB5zDHkX3+RDz1EbrSRe3dE7tbdwAxB1Lba4P4nMshRR5GVCqnlyy/JE0906461RR38Oi1PF4SeB4q8rl+oC0RLsUg+/LBTd7Tb64Z0miBKSIMDdQ8UC4Rsd+ekk1y5U6UxhxO2y9QgusUWeUk/mAhI2J2NN07eHZE3aJCbGkRXb2v/TgjEvTs6VozZajIQXTUJXKEfcAISuPPII8m6A1zHbLZPO4hBWgeQU5CgfPUVefLJ5IILxndH1xXAhEDMsroNcA4SdufRR8lNNonnjrW/0zMrtYMAu+jWuWEgYXdOOaV+d6ytEthLGdpOfMCp+oZ7EAfuGHMOx4ztluL4Cb1pzDVNAwnK11+3ubPQQh1zB7iJ2WzfVNWgP8Xe1nSQwJ3HHiM33ZT8//+jDvgHNPyU0jgTRR5sOki4fP4Fuf320boZ8LDvyNAUIQN1R/mfAfnhB/L888nFF48MomaktH8RuLHpIOUy+eyz5DbbaLeKPk6A29mS7p/i2LHdNfLXVJDvvyfPPZdcbDEF6NjMBVyqgb1gZT/QHYgDFwIpMHCknqOCBXEdWvuXO5AILtS3sv9DYzYKr+yzUOTzhoCoC888Q269NVkoxNtvaXAEmCu81xqkEXTnIOrCOeeQiy6azHZe5BGdeqc8j+yvexcnIIELW20V34Xw+DDmMB0fU4LMRbGfJw7y3Xfk2Wcn5sIU3Wq+8MEqfLi6NDEQdeHpp5N1ISzgal0Dpx1FMViS1n4bGyTsAuAqHrz8dMNB6koVOK9ukMCFLbd040J4EVQ3ZhRp/DXrzV4E3u8QSLXa5sJZZ5GLLEICLmPA7xGYc6Yh02369u/8YUvL7n+L/BMp9nvYYeQTT7p2IYD4g8B2OlNFCmIf37//0LcmTryuFOVHLbmkuqAAjchinUFj+nUorXBKv375dydNeqJsbZREpmsI6g6dYsfWlbG6aNCg2T5qaXkygGma9ARrkI6VQ7x0yJD/f5pO3+nDlJuQqSpRA4cGLYlkde8ZNWrMb553NK39roEQPxA4ytfwBPPsQWJUVqXIk7R5d+5o3SJPE1hT23R35QMwsbbBfEtnkkRnJWvfIXBwuCu5AgnlUowQ2LfNIfsrbYyMrcgzhBxAIM98oUujrw4KUnWjfC1PyNEUudfX+75+1BOnr6Kvck3F2ms/1a4Uup/AcRq71TrCi5wrkMiXeWigzFeBWW8F/35LGrOfr8NV2h01n1F7r0CNp9l8l6Ta/xfkxiTZsm/RTwAAAABJRU5ErkJggg==';
	$url_format = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
	
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = date('M-d,Y H:i:s');
    $time_stamp = strtotime($date);

    $sql_chat = "SELECT * FROM chats WHERE number = '$mobile'";
	$result_chat = $conn->query($sql_chat);
	if ($result_chat->num_rows > 0) {                               
	while($row_chat = $result_chat->fetch_assoc()) {
		$u_id = $row_chat["id"];
    
        $message_to_insert = $con->real_escape_string($_POST['message']);

	    $sql2 = "INSERT INTO chat_messages (u_id, message, by_whom, sub_id, status, date)
             VALUES ('$u_id', '$message_to_insert', 'studio', '$sub_id', 'sent', '$time_stamp')";
             if ($conn->query($sql2) === TRUE) {  } else {  echo "ERROR" . $sql2 . "<br>" . $conn->error; } 
             
        $sql_contact_stats = "UPDATE chats SET contact_stats = 'Active' WHERE id = '$u_id'";
        	 if ($conn->query($sql_contact_stats) === TRUE) { } else {
        		echo "ERROR" . $sql_contact_stats . "<br>" . $conn->error;
        	 }
        	 

	} } else { 
	    
	    $user_name = $_POST['name'];
	    
	    $message_to_insert = $con->real_escape_string($_POST['message']);
	    
	    $sql21 = "INSERT INTO chats (name, number)
             VALUES ('$user_name', '$mobile')";
             if ($conn->query($sql21) === TRUE) {  
                 $last_id = $conn->insert_id;
             } else {  echo "ERROR" . $sql21 . "<br>" . $conn->error; } 
	    
	    $sql22 = "INSERT INTO chat_messages (u_id, message, by_whom, sub_id, status, date)
             VALUES ('$last_id', '$message_to_insert', 'studio', '$sub_id', 'sent', '$time_stamp')";
             if ($conn->query($sql22) === TRUE) {  } else {  echo "ERROR" . $sql22 . "<br>" . $conn->error; } 

	} 
	

	// Whatsapp API - Chat-API
	$data2 = [
		'phone' =>	'91'.$mobile, 
		'body' => $message, 
		'metadata' => 'VDOfy',
		'previewBase64' => $icon_data_base64,
		'title' => $message,
	];
	$json2 = json_encode($data2); 
	$token2 = '2jrpj6v32qc0ncyv';
	$instanceId2 = '243079';
	
	if (preg_match($url_format, $message, $url)) {
        $url2 = 'https://api.chat-api.com/instance'.$instanceId2.'/sendLink?token='.$token2;
    } else {
        $url2 = 'https://api.chat-api.com/instance'.$instanceId2.'/sendMessage?token='.$token2;
    }
	
// 	$url2 = 'https://eu12.chat-api.com/instance'.$instanceId2.'/message?token='.$token2;    -----Old Link
//  $url2 = 'https://api.chat-api.com/instance'.$instanceId2.'/sendMessage?token='.$token2;     -----New Link
    
	$options2 = stream_context_create(['http' => [
			'method'  => 'POST',
			'header'  => 'Content-type: application/json',
			'content' => $json2
		]
	]);
	$result2 = file_get_contents($url2, false, $options2);
	
	echo $message;
	
?>