<!DOCTYPE html>
<?php
// include("config/setup.php");
include "config/connect.php";
include "functions/functions.php";
ini_set("display_errors", true);
session_start();
    // include("functions/functions.php");
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="author" content="Rigardt Engelbrecht">
		<link rel="stylesheet" href="styles/index.css" media="all" />
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
					<img id="banner" src="images/rengelbr_logo.png">
				</a>
				<div class="nav_bar">
					<?php
						get_menu();
					?>
				</div>
			</div>
		</header>
		<div class="main_wrapper">
			<!--Navigation bar-->

			<!--content wrapper starts-->
			<div class="content_wrapper">

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
	// 	echo "<script>window.open('index.php', '_self')</script>";
	// }
	log_out("index");
}
?>
