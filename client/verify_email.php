<!DOCTYPE html>
<?php
// include("config/setup.php");
include '../includes/connect.php';
include '../config/database.php';
include '../functions/functions.php';
ini_set("display_errors", true);
session_start();
    // include("functions/functions.php");
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../styles/index.css" media="all" />
		<title>Camagru</title>
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
	</head>
	<body>
		<header>
			<div class="menubar">
				<a href="index.php">
					<img id="banner" src="../images/rengelbr_logo.png">
				</a>
			</div>
			<div class="nav_bar">
				<ul id="my_acc_menu">
					<li><a href="../index.php">Home</a></li>
				</ul>
			</div>
		</header>
		<div class="main_wrapper">
			<!--Navigation bar -->
			<!-- <div class="menubar">-->
			<?php
					// if (isset($_SESSION['user_id']))
					// {
					// 	if (verif_user($_SESSION['user_id']))
					// 		echo "<ul id='my_acc_menu'>
					// 				<li><a href='../index.php'>Home</a></li>
					// 				<li><a href='../client/my_account.php?user=".$_SESSION['user_id']."'>My Account</a></li>
					// 				<li><a href='../index.php?session_status=logout'>Log Out</a></li>
					// 				</ul>";
					// }
					// else {
					// 	echo "<ul id='menu'>
					// 			<li><a href='../index.php'>Home</a></li>
					// 			</ul>
					// 			<div class='dropdown'>
					// 			<button onclick='myFunction()' class='dropbtn'>Login - Register</button>
					// 			<div id='myDropdown' class='dropdown-content'>
					// 				<a href='../login.php'>Login</a>
					// 				<a href='../register.php'>Register</a>
					// 			</div>
					// 		</div>";
					// }
				?>
			</div>
			<!--content wrapper starts-->
			<div class="content_wrapper">
				<?php
		//checks if user is already verified or if user exists. Redundancy can be safer.
					if (isset($_GET['ver_key'])) {
						$get_user = $con->prepare("SELECT * FROM users WHERE token=?");
						$get_user->execute([$_GET['ver_key']]);
						$user = $get_user->fetch();
						if ($user['verified'] == 1) {
							$_SESSION['user_name'] = $user['user_name'];
							$_SESSION['user_email'] = $user['user_email'];
							$_SESSION['user_id'] = $user['user_id'];
							echo "<h2>You are already a verified user. That's good, but what are you doing in a place like this? Just click <a href='my_account.php'>here</a>.</h2>";
						} else {
							$u_email = $user['user_email'];
							// $get_ver = $con->prepare("SELECT token FROM users WHERE user_email=?");
							// $get_ver->execute([$u_email]);
							// $fetch_key = $get_ver->fetch();
							$ver_key = $user['token'];
							// if ($_GET['ver_key'] == $ver_key) {
								$updt_usr = $con->prepare("UPDATE users SET verified=1 WHERE user_email=?");
								$updt_usr->execute([$u_email]);
								// $get_id = $con->prepare("SELECT `user_id` FROM users WHERE user_email=?");
								// $get_id->execute([$u_email]);
								// $u_id = $get_id->fetch();
								$_SESSION['user_name'] = $user['user_name'];
								$_SESSION['user_email'] = $user['user_email'];
								$_SESSION['user_id'] = $user['user_id'];
								echo "<h2>You have successfully registered. Yay! Let's get started with your new, more fulfilling life! Just click <a href='my_account.php?'>here</a>.</h2>";
						}
					}
					else {
						echo "<script>window.alert('How the hell did you get here? Away with ye!');window.open('../index.php', '_self')</script>";
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
