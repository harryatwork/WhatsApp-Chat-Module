<?php include("db.php"); ?>
<?php
    $result = file_get_contents("php://input"); // Send a request
	$data = json_decode($result, 1); // Parse JSON
	
    	foreach(array_reverse($data['messages']) as $message){ // Echo every message
    		$sender = $message['author'];
    		$message_content = $conn->real_escape_string($message['body']);
    		$time = $message['time'];
    		
    		if($sender == '916362015109@c.us') { } else {
    		    
    		    $sender_number_pre = substr($sender, 2);
    		    $sender_number_pos = trim($sender_number_pre,"@c.us");
    		    
    		    $sql_chats = "SELECT * FROM chats WHERE number = '$sender_number_pos'";
            	$result_chats = $conn->query($sql_chats);
            	if ($result_chats->num_rows > 0) {                               
            	while($row_chats = $result_chats->fetch_assoc()) {
            		$u_id = $row_chats["id"];
    		    
            		 $sql2 = "INSERT INTO chat_messages (u_id, message, by_whom, status, date)
                     VALUES ('$u_id', '$message_content', 'user', 'NA', '$time')";
                     if ($conn->query($sql2) === TRUE) {  } else {  echo "ERROR" . $sql2 . "<br>" . $conn->error; } 
    		
    		         $sql = "UPDATE chats SET status = 0, contact_stats = 'Active'
        					 WHERE id = '$u_id'";
                	 if ($conn->query($sql) === TRUE) { } else {
                		echo "ERROR" . $sql . "<br>" . $conn->error;
                	 }
    		
            	} } else { }
    		
    		}
    	}

	    foreach(array_reverse($data['ack']) as $ack){ // Echo every message
    		$sender = $ack['chatId'];
    		$status = $ack['status'];
    		
    		if($sender == '916362015109@c.us') { } else {
    		    
    		    $sender_number_pre = trim($sender,"91");
    		    $sender_number_pos = trim($sender_number_pre,"@c.us");
    		    
    		    $sql_chats = "SELECT * FROM chats WHERE number = '$sender_number_pos'";
            	$result_chats = $conn->query($sql_chats);
            	if ($result_chats->num_rows > 0) {                               
            	while($row_chats = $result_chats->fetch_assoc()) {
            		$u_id = $row_chats["id"];
    		
            		$sql = "UPDATE chat_messages SET status = '$status'
        					WHERE by_whom = 'studio' AND status != 'viewed' AND u_id = '$u_id'";
                	if ($conn->query($sql) === TRUE) { } else {
                		echo "ERROR" . $sql . "<br>" . $conn->error;
                	}
                	
            	} } else { }
            	
    		}
    		
	    }

?>