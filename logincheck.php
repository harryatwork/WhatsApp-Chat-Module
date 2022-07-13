<?php include("db.php"); 
    
	$login_form_email = $_POST['login_form_email'];
	$login_form_password = md5($_POST['login_form_password']);

    $sqluser = "SELECT * FROM subadmin WHERE email = '$login_form_email' AND password = '$login_form_password' AND status = 'Active'";
	$resultuser = $conn->query($sqluser);
	if ($resultuser->num_rows > 0) {   
	while($rowuser = $resultuser->fetch_assoc()) {
		$_SESSION["email"] = $login_form_email;
		header("Location: chat");
	} } else { 
	    header("Location: index?alert");
	}
?>