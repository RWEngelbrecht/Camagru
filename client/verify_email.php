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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Rigardt Engelbrecht">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
		<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
		<title>Camagru - Email Verified</title>
	</head>
	<body>
		<header>
			<div class="navbar">
				<div class="navbar-brand">
					<a href="index.php">
						<img id="banner" src="../images/CAMAGRUFORU.png">
					</a>
					<?php
						get_menu();
					?>
				</div>
			</div>
		</header>
		<section class="section">
			<div class="container">
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
								echo "<h2>Your account is verified. Yay! Let's get started with your new, more fulfilling life! Just click <a href='my_account.php?'>here</a>.</h2>";
						}
					}
					else {
						echo "<script>window.alert('How the hell did you get here? Away with ye!');window.open('../index.php', '_self')</script>";
					}

				?>
			</div>
		</section>
			<!--content wrapper ends-->
			<!--footer starts-->
			<div id="footer">
				<h2 style="text-align:center; padding-top:30px;">rengelbr</h2>
			</div>
		</div>
		<!--footer ends-->
	</body>
</html>
