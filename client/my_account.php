<!DOCTYPE html>
<?php
// include("config/setup.php");
include "../config/connect.php";
include "../functions/functions.php";
ini_set("display_errors", true);
session_start();
// include("functions/functions.php");
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="author" content="Rigardt Engelbrecht">
		<link rel="stylesheet" href="../styles/index.css" media="all" />
		<title>Camagru - My Account</title>
	</head>
	<body>
		<header>
			<div class="menubar">
				<a href="index.php">
					<img id="banner" src="../images/rengelbr_logo.png">
				</a>
				<div class="nav_bar">
					<ul id="my_acc_menu">
						<li><a href="../index.php">Home</a></li>
						<li><a href="my_account.php?session_status=logout">Log Out</a></li>
					</ul>
				</div>
			</div>
		</header>
		<div class="main_wrapper">
			<!--Navigation bar-->
			<div class="menubar">

			</div>
			<!--content wrapper starts-->
			<div class="content_wrapper">
				<?php
					if (isset($_SESSION['user_id'])) {
						if (verif_user($_SESSION['user_id']))
							echo "<h2>Welcome, ".$_SESSION['user_name']."</h2>";
						else
							echo "<h2>You're not supposed to be here!</h2>";
					}
					else {
						echo "<h2>Welcome, whoever you are! Please log in or register.</h2>";
					}
				?>
			</div>
			<!--content wrapper ends-->
			<!--footer starts-->
			<div id="footer">
				<h2 style="text-align:center; padding-top:30px;">&#169; rengelbr</h2>
			</div>
		</div>
		<!--footer ends-->
	</body>
</html>
<?php
if (isset($_GET['session_status'])) {
	// if ($_GET['session_status'] == "logout") {
	// 	session_destroy();
	// 	echo "<script>window.open('../index.php', '_self')</script>";
	// }
	log_out("my_account");
}
?>
