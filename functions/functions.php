<?php

function verif_email($u_email, $ver_code) {
	$subject = "Activate your account with Camagru.";
	$body = "Please click <a href='http://localhost:8080/Camagru/client/verify_email.php?ver_key=".$ver_code."'>here</a> to activate your account.";
	$headers = "From: camagru.rigardt@gmail.com\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	if (mail($u_email,$subject,$body,$headers))
	return true;
	else
	return false;
}

function verif_user($user_id) {
	include ('../includes/connect.php');
	$u_verif = $con->prepare("SELECT * FROM users WHERE user_id=? AND verified=1");
	$u_verif->execute([$user_id]);
	$row = $u_verif->fetch();
	if ($row['user_id'] == $user_id)
		return true;
	else
		return false;
}

?>
