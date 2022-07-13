<?php include("db.php");

    $chat_loader_whatsapp = $_POST["chat_loader_whatsapp"];
   
    $sql_chat = "SELECT * FROM chats WHERE number = '$chat_loader_whatsapp'";
	$result_chat = $conn->query($sql_chat);
	if ($result_chat->num_rows > 0) {                               
	while($row_chat = $result_chat->fetch_assoc()) {
		$u_id = $row_chat["id"];
		
		 $sql_contact_stats = "DELETE FROM chat_messages WHERE u_id = '$u_id'";
    	 if ($conn->query($sql_contact_stats) === TRUE) { } else {
    		echo "ERROR" . $sql_contact_stats . "<br>" . $conn->error;
    	 }
		
	} } else { } 	
	
         $sql_contact_stats2 = "UPDATE chats SET contact_stats = 'Delete' WHERE number = '$chat_loader_whatsapp'";
    	 if ($conn->query($sql_contact_stats2) === TRUE) { } else {
    		echo "ERROR" . $sql_contact_stats2 . "<br>" . $conn->error;
    	 }