<?php
include ('../includes/connect.php');
function verif_email($u_email, $ver_code) {
	$subject = "Activate your account with Camagru.";
	$body = "Please click <a href='http://localhost:8080/Camagru/verify_email.php?ver_key=".$ver_code."'>here</a> to activate your account.";
	$headers = "From: rigardte@gmail.com\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	if (mail($u_email,$subject,$body,$headers))
		echo "<h2>Verfication e-mail sent!</h2>";
	else
		echo "<h2>Something went wrong! Could not send verification e-mail.</h2>";
}
?>
