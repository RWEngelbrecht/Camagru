<!DOCTYPE html>
<?php
// include ("config/setup.php");
include 'includes/connect.php';
include 'functions/functions.php';
ini_set("display_errors", true);
session_start();
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles/index.css" media="all" />
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
	<!-- login form -->
				<form method="POST" action="login.php">
					<table>
						<tr align="center">
							<td colspan="3"><h2>Please log in or register</h2></td>
						</tr>
						<tr align="center">
							<td align="right">Email:</td>
							<td><input type="text" name="user_email" placeholder="enter email" required/></td>
						</tr>
						<tr>
							<td align="right">Password:</td>
							<td align="center"><input type="password" name="user_passwd" placeholder="enter password" required/></td>
						</tr>
						<tr align="right">
							<td colspan="3" style="font-size:12px;padding:5px 80px"><a href="forgot_pass.php">Forgot Password?</a></td>
						</tr>
						<tr align="center">
							<td colspan="3"><input type="submit" name="login" value="Log In"/></td>
						</tr>
					</table>
				</form>
				<?php
					if (isset($_POST['login'])) {
	//validate email + password
						$u_email = $_POST['user_email'];
						$u_passwd = hash('whirlpool',$_POST['user_passwd']);
						$get_udata = $con->prepare("SELECT * FROM users WHERE user_email=?");
						$get_udata->execute([$u_email]);
						$user_data = $get_udata->fetch();

						if (!$user_data) {
							echo "<script>window.alert('You don't exist yet! How about registering first?')</script>";
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
						else if ($u_email == $user_data['user_email'] && $u_passwd != $user_data['user_passwd']) {

							echo "<script>window.alert('Password incorrect!')</script>";
						}
						$con = null;    ////????
					}
				?>
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

