<!DOCTYPE html>
<?php
include ("includes/connect.php");
ini_set("display_errors", true);
session_start();
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles/style.css" media="all" />
		<title>Camagru</title>
	</head>
	<body>
			<div class="header_wrapper">
				<a href="index.php">
					<img id="banner" src="images/rengelbr_logo.png">
				</a>
			</div>
		<div class="main_wrapper">
<!--Navigation bar-->
			<div class="menubar">
				<ul id="menu">
						<li><a href="index.php">Home</a></li>
				</ul>
				<div class="dropdown">
						<button onclick="myFunction()" class="dropbtn">Login - Register</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="login.php">Login</a>
							<a href="register.php">Register</a>
							<a href="fml.php">Forgot account-temp-</a>
						</div>
				</div>
				<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
				function myFunction() {
				document.getElementById("myDropdown").classList.toggle("show");
				}

// Close the dropdown if the user clicks outside of it
				window.onclick = function(event) {
					if (!event.target.matches('.dropbtn')) {
						var dropdowns = document.getElementsByClassName("dropdown-content");
						var i;
						for (i = 0; i < dropdowns.length; i++) {
							var openDropdown = dropdowns[i];
							if (openDropdown.classList.contains('show')) {
								openDropdown.classList.remove('show');
							}
						}
					}
				}
				</script>
			</div>
<!--content wrapper starts-->
			<div class="content_wrapper">
				<form action="register.php" method="POST" enctype="multipart/form-data">
					<table align="center">
						<tr align="center">
							<td colspan="6" style="padding:15px; color:white;"><h2>Create your Account</h2></td>
						</tr>
						<tr>
							<td align="right" style="padding:15px; color:white;">Name: </td>
							<td><input type="text" name="u_name" required/></td>
						</tr>
						<tr>
							<td align="right" style="padding:15px; color:white;">E-mail: </td>
							<td><input type="text" name="u_email" required/></td>
						</tr>
						<tr>
							<td align="right" style="padding:15px; color:white;">Password: </td>
							<td><input type="password" name="u_passwd" required/></td>
						</tr>
						<tr>
							<td align="right" style="padding:15px; color:white;">Image: </td>
							<td><input type="file" name="u_image" required/></td>
						</tr>
						<tr>
							<td align="right" style="padding:15px; color:white;">Contact Number: </td>
							<td><input type="text" name="u_contact" required/></td>
						</tr>
						<tr align="center" >
							<td colspan="6" style="padding:15px"><input type="submit" name="register" value="Register"/></td>
						</tr>
					</table>
				</form>
			</div>
<!--content wrapper ends-->
<!--footer starts-->
			<div id="footer">
				<h2 style="text-align:center; padding-top:30px;">rengelbr</h2>
			</div>
		</div>
<!--footer ends-->
	</body>
</html>
<?php
//check if register button clicked
	if (isset($_POST['register'])) {
//get registration data
		$u_name = $_POST['u_name'];
		$u_email = $_POST['u_email'];
		$u_passwd = hash('whirlpool', $_POST['u_passwd']);
		$u_image = $_FILES['u_image']['name'];
		$u_image_tmp = $_FILES['u_image']['tmp_name'];
		move_uploaded_file($u_image_tmp, "client/client_images/$u_image");
		$u_contact = $_POST['u_contact'];
//check if user email exists in db
		$check = $con->prepare("SELECT * FROM users WHERE user_email=?");
		$check->execute([$u_email]);
		$ret = $check->fetch();
		if ($ret) {
			echo "<script>window.alert('This user exists!')</script>";
		}
		else if (!filter_var($u_email, FILTER_VALIDATE_MAIL)) {
			echo "<script>window.alert('Please enter a valid email address!')</script>";
		}
		else {
//execute insert query
			$sql = "INSERT INTO users (`user_name`, `user_passwd`, `user_email`, `user_contact`, `user_image`) VALUES ('$u_name', '$u_passwd', '$u_email', '$u_contact', '$u_image')";
			$con->exec($sql);
//save session vars for later use
			$get_id = $con->prepare("SELECT `user_id` FROM users WHERE user_email=?");
			$get_id->execute([$u_email]);
			$u_id = $get_id->fetch();
			$_SESSION['user_email'] = $u_email;
			$_SESSION['user_id'] = $u_id;
//send email to user_email for verification
			$ver_code = substr(whirlpool(mt_rand()), 0, 15);
			$subject = "Activate your account with Camagru.";
			$headers = "From:phil@Camagru.com";
			$body = "Your Activation Code is ".
			echo "<script>window.alert('An email has been sent to ".$u_email."')</script>";
			// echo "<script>window.open('verify_email.php', '_self')</script>";
		}
	}

?>



