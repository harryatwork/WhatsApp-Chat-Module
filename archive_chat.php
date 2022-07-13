<?php include("db.php");

    $chat_loader_whatsapp = $_POST["chat_loader_whatsapp"];

    $sql_contact_stats = "UPDATE chats SET contact_stats = 'Archive' WHERE number = '$chat_loader_whatsapp'";
	 if ($conn->query($sql_contact_stats) === TRUE) { } else {
		echo "ERROR" . $sql_contact_stats . "<br>" . $conn->error;
	 }