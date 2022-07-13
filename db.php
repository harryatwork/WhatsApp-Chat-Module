<?php
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "whatsapp_web_chat";
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    define('HOST','localhost');
	define('USERNAME', 'root');
	define('PASSWORD','');
	define('DB','whatsapp_web_chat');
	$con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
	$con->set_charset('utf8mb4');
	$db = new PDO('mysql:host=localhost;dbname=whatsapp_web_chat','root','');

	session_start();
?>