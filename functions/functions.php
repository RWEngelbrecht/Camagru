<?php

function validate_name($name) {
	if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
		echo "<script>window.alert('Invalid name, only letters and white space allowed.')</script>";
		exit();
	}
}

function validate_email($email) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script>window.alert('Invalid email.')</script>";
		exit();
	}
}

function validate_password($passwd) {
	if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%]{6,50}$/', $passwd)) {
		echo "<script>window.alert('Passwords need to be more than 5 characters long, and contain at least 1 number and 1 letter.')</script>";
		exit();
	}
}

//sends verification email
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

// Checks if user id corresponds to registered user
function verif_user($user_id) {
	// include ('../includes/connect.php');
	try {
		$con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo "ERROR: ".$e->getMessage();
	}
	$u_verif = $con->prepare("SELECT * FROM users WHERE user_id=? AND verified=1");
	$u_verif->execute([$user_id]);
	$row = $u_verif->fetch();
	if ($row['user_id'] == $user_id)
		return true;
	else
		return false;
}

function get_menu() {
	if (isset($_SESSION['user_id']))
	{
		if (verif_user($_SESSION['user_id'])) {
			echo "<ul id='my_acc_menu'>
					<li><a href='index.php'>Home</a></li>
					<li><a href='client/my_account.php?user=".hash('whirlpool',$_SESSION['user_name'])."'>My Account</a></li>
					<li><a href='index.php?session_status=logout'>Log Out</a></li>
					</ul>";
		}
	}
	else {
		echo "<ul id='menu'>
				<li><a href='index.php'>Home</a></li>
				</ul>
				<div class='dropdown'>
				<button onclick='myFunction()' class='dropbtn'>Login - Register</button>
				<div id='myDropdown' class='dropdown-content'>
					<a href='login.php'>Login</a>
					<a href='register.php'>Register</a>
					<a href='fml.php'>Forgot account-temp-</a>
				</div>
			</div>";
	}
}

function log_in() {
	include 'includes/connect.php';
		//validate email + password
		$u_email = $_POST['user_email'];
		$u_passwd = hash('whirlpool',$_POST['user_passwd']);
		$get_udata = $con->prepare("SELECT * FROM users WHERE user_email=?");
		$get_udata->execute([$u_email]);
		$user_data = $get_udata->fetch();
		if (empty($user_data) || $u_email != $user_data['user_email'] || $u_passwd != $user_data['user_passwd']) {
			echo "<script>window.alert('Incorrect password or e-mail! Won\'t tell you which, though...')</script>";
		}
//if email from form == email from db && passwd from form == passwd from db and user has been verified
		if ($u_email == $user_data['user_email'] && $u_passwd == $user_data['user_passwd'] && $user_data['verified'] == 1) {
//store session data
			$_SESSION['user_email'] = $u_email;
			$_SESSION['user_id'] = $user_data['user_id'];
			$_SESSION['user_name'] = $user_data['user_name'];
//take client to their account page
			echo "<script>window.open('client/my_account.php?', '_self')</script>";
		} //if all of the above, but user has not gone through verification link emailed to them
		else if ($u_email == $user_data['user_email'] && $u_passwd == $user_data['user_passwd'] && $user_data['verified'] == 0) {

			echo "<script>window.alert('Please verify your account. We sent you instructions on how to do that.')</script>";
			$_SESSION['user_email'] = $u_email;
			$_SESSION['user_id'] = $user_data['user_id'];
			$_SESSION['user_name'] = $user_data['user_name'];
			$u_ver = $user_data['token'];
			verif_email($u_email, $u_ver);
		}
		$con = null;
}

function log_out($page){
	if ($_GET['session_status'] == "logout") {
		session_destroy();
		if ($page == "my_account" || $page == "verify_email") {
			echo "<script>window.open('../index.php', '_self')</script>";
		}
		else if ($page == "index") {
			echo "<script>window.open('./index.php', '_self')</script>";
		}
	}
}
?>
