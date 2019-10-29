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
		$con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "qwerqwer");
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
		// if (verif_user($_SESSION['user_id'])) {
			echo "<ul id='my_acc_menu'>
					<li><a href='index.php'>Home</a></li>
					<li><a href='new_upload.php'>New Upload</a></li>
					<li><a href='client/my_account.php?user=".hash('whirlpool',$_SESSION['user_name'])."'>My Account</a></li>
					<li><a href='index.php?session_status=logout'>Log Out</a></li>
					</ul>";
		// }
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

function reset_passwd() {
	include '../includes/connect.php';

	$u_email = $_POST['user_email'];

	$get_udata = $con->prepare("SELECT * FROM users WHERE user_email=?");
	$get_udata->execute([$u_email]);
	$user_data = $get_udata->fetch();

	if (verif_user($user_data['user_id'])) {

		$ver_code = hash('whirlpool', time().$u_email);
		$updt_verif = $con->prepare('UPDATE users SET token=:ver_code WHERE user_email=:u_email');
		$updt_verif->execute(array(':ver_code'=>$ver_code, ':u_email'=>$user_data['user_email']));

		$subject = "Reset your password with Camagru.";
		$body = "Forgot your password, did you? Please click <a href='http://localhost:8080/Camagru/passwd_reset.php?ver_key=".$ver_code."'>here</a> to reset your password.\r\nIf this wasn't you, call the internet police.";
		$headers = "From: camagru.rigardt@gmail.com\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		if (mail($u_email,$subject,$body,$headers))
			return true;
	}
	return false;
}

function replace_passwd($new_passwd, $verif_key) {
	include 'includes/connect.php';

	$u_email = $_POST['user_email'];

	$get_udata = $con->prepare("SELECT * FROM users WHERE user_email=?");
	$get_udata->execute([$u_email]);
	$user_data = $get_udata->fetch();
	if ($verif_key != $user_data['token']) {
		echo "window.alert('Hol\' up. It wasn't you who reset the password, was it?')";
		exit();
	}
	$updt_pw = $con->prepare("UPDATE users SET user_passwd=:new_passwd WHERE user_email=:u_email");
	if ($updt_pw->execute(array(':new_passwd'=>$new_passwd, ':u_email'=>$u_email)))
		return true;
	else
		return false;
}

//gets and displays images uploaded by all users
function get_gallery() {
	include 'includes/connect.php';

	$get_imgs = "SELECT * FROM images ORDER BY date_created";
	$exe_imgs = $con->prepare($get_imgs);
	$exe_imgs->execute();

	while ($image = $exe_imgs->fetch()) {
		$img_name = $image['img_name'];
		echo "<img src='data:image/png;base64,".$img_name."' />";
	}
}

function upload_image($user) {
	include 'includes/connect.php';

	if (!empty($user)) {
		$upl_img_name = $_FILES['upl_image']['name'];
		$upl_img_tmp = base64_encode(file_get_contents($_FILES['upl_image']['tmp_name']));
		// move_uploaded_file($upl_image_tmp, "client/uploads/$upl_img_name");

		$upload_sql = "INSERT INTO images(u_id, img_name) VALUES(:u_id, :img)";
		$upload_image = $con->prepare($upload_sql);
		$upload_image->execute(array(':u_id'=>$user, ':img'=>$upl_img_tmp));
	}
}

function update_user($user_id) {

	if ($_GET['update'] == 'username') {
		echo "<form method='POST' action=''><table>
				<tr align='center'>
					<td colspan='6' style='padding:15px; color:white;'><h2>Update your Account</h2></td>
				</tr>
				<tr>
					<td align='right' style='padding:15px; color:white;''>New Name: </td>
					<td><input type='text' name='new_name' required/></td>
				</tr>
				<tr align='center'>
					<td colspan='6' style='padding:15px'><input type='submit' name='updt_name' value='Update Name'/></td>
				</tr>
				</table></form>";
		if (isset($_POST['updt_name'])) {
			validate_name($_POST['new_name']);
			update_name($user_id, $_POST['new_name']);
			echo "<script>window.open('my_account.php', '_self')</script>";
		}
	}
	if ($_GET['update'] == 'email') {
		echo "<form method='POST' action=''><table>
				<tr align='center'>
					<td colspan='6' style='padding:15px; color:white;'><h2>Update your Account</h2></td>
				</tr>
				<tr>
					<td align='right' style='padding:15px; color:white;''>New E-mail: </td>
					<td><input type='text' name='new_email' required/></td>
				</tr>
				<tr align='center'>
					<td colspan='6' style='padding:15px'><input type='submit' name='updt_email' value='Update E-mail'/></td>
				</tr>
				</table></form>";
		if (isset($_POST['updt_email'])) {
			validate_email($_POST['new_email']);
			update_email($user_id, $_POST['new_email']);
			echo "<script>window.alert('An email has been sent to ".$u_email.". Follow the instructions to verify your account.')</script>";
			echo "<script>window.open('my_account.php', '_self')</script>";
		}
	}
	if ($_GET['update'] == 'passwd') {
		echo "<form method='POST' action=''><table>
				<tr align='center'>
					<td colspan='6' style='padding:15px; color:white;'><h2>Update your Account</h2></td>
				</tr>
				<tr>
					<td align='right' style='padding:15px; color:white;''>New Password: </td>
					<td><input type='password' name='new_passwd' required/></td>
				</tr>
				<tr align='center'>
					<td colspan='6' style='padding:15px'><input type='submit' name='updt_passwd' value='Update Password'/></td>
				</tr>
				</table></form>";
		if (isset($_POST['updt_passwd'])) {
			validate_password($_POST['new_passwd']);
			update_passwd($user_id, hash('whirlpool',$_POST['new_passwd']));
			echo "<script>window.open('my_account.php', '_self')</script>";
		}
	}
	if ($_GET['update'] == 'image') {
		echo "<form method='POST' action='' enctype='multipart/form-data'><table>
				<tr align='center'>
					<td colspan='6' style='padding:15px; color:white;'><h2>Update your Account</h2></td>
				</tr>
				<tr>
					<td align='right' style='padding:15px; color:white;''>New Image: </td>
					<td><input type='file' name='new_image' required/></td>
				</tr>
				<tr align='center'>
					<td colspan='6' style='padding:15px'><input type='submit' name='updt_image' value='Update Image'/></td>
				</tr>
				</table></form>";
		if (isset($_POST['updt_image'])) {
			// validate_image($_POST['new_image']);
			$new_img_tmp = base64_encode(file_get_contents($_FILES['new_image']['tmp_name']));
			update_image($user_id, $new_img_tmp);
			echo "<script>window.open('my_account.php', '_self')</script>";
		}
	}
}

function update_name($user_id, $new_name) {
	include '../includes/connect.php';

	if (isset($_POST['updt_name'])) {
		$updt_sql = "UPDATE users SET user_name=:u_name WHERE user_id=:u_id";
		$updt_name = $con->prepare($updt_sql);
		$updt_name->execute(array(':u_name'=>$new_name, ':u_id'=>$user_id));
		$_SESSION['user_name'] = $new_name;
	}
}

function update_email($user_id, $new_email) {
	include '../includes/connect.php';

	if (isset($_POST['updt_email'])) {
		$updt_sql = "UPDATE users SET user_email=:u_email, verified=0 WHERE user_id=:u_id";
		$updt_email = $con->prepare($updt_sql);
		$updt_email->execute(array(':u_email'=>$new_email, ':u_id'=>$user_id));
		$_SESSION['user_email'] = $new_email;
		$new_verif = hash('whirlpool', time().$new_email);
		verif_email($new_email, $new_verif);
	}
}
function update_passwd($user_id, $new_passwd) {
	include '../includes/connect.php';

	if (isset($_POST['updt_passwd'])) {
		$updt_sql = "UPDATE users SET user_passwd=:u_passwd WHERE user_id=:u_id";
		$updt_passwd = $con->prepare($updt_sql);
		$updt_passwd->execute(array(':u_passwd'=>$new_passwd, ':u_id'=>$user_id));
	}
}
function update_image($user_id, $new_image) {
	include '../includes/connect.php';

	if (isset($_POST['updt_image'])) {
		$updt_sql = "UPDATE users SET user_image=:u_image WHERE user_id=:u_id";
		$updt_image = $con->prepare($updt_sql);
		$updt_image->execute(array(':u_image'=>$new_image, ':u_id'=>$user_id));
	}
}
?>
