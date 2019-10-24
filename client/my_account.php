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
		<link rel="stylesheet" href="../styles/index.css" media="all" />
		<title>Camagru</title>
	</head>
	<body>
			<div class="header_wrapper">
				<a href="index.php">
					<img id="banner" src="../images/rengelbr_logo.png">
				</a>
			</div>
		<div class="main_wrapper">
			<!--Navigation bar-->
			<div class="menubar">
				<ul id="my_acc_menu">
						<li><a href="../index.php">Home</a></li>
						<li><a href="my_account.php?session_status=logout">Log Out</a></li>
				</ul>
				<!-- <div class="dropdown">
						<button onclick="myFunction()" class="dropbtn">Login - Register</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="../login.php">Login</a>
							<a href="../register.php">Register</a>
							<a href="../fml.php">Forgot account-temp-</a>
						</div>
				</div> -->
				<!-- <script>
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
				</script> -->
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
				<h2 style="text-align:center; padding-top:30px;">rengelbr</h2>
			</div>
		</div>
		<!--footer ends-->
	</body>
</html>
<?php
if (isset($_GET['session_status'])) {
	if ($_GET['session_status'] == "logout") {
		session_destroy();
		echo "<script>window.open('../index.php', '_self')</script>";
	}
}
?>
