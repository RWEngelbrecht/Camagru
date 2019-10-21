<!DOCTYPE html>
<?php
include ("config/setup.php");
ini_set("display_errors", true);
session_start();
    // include("functions/functions.php");
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles/style.css" media="all" />
		<title>Camagru</title>
	</head>
	<body>
		<div class="main_wrapper">
			<div class="header_wrapper">
				<a href="index.php">
					<img id="banner" src="images/logom.png">
				</a>
			</div>
			<!--Navigation bar starts-->
			<div class="menubar">
				<ul id="menu">
						<li><a href="index.php">Home</a></li>
						<li><a href="#">PH</a></li>
						<li><a href="#">PH</a></li>
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

			</div>
			<!--content wrapper ends-->
			<!--footer starts-->
			<div id="footer">
				<h2 style="text-align:center; padding-top:30px;">jrheeder</h2>
			</div>
		</div>
		<!--footer ends-->
	</body>
</html>
