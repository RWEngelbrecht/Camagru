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
				<form method="POST">
					<table>
						<tr align="center">
							<td colspan="3"><h2>Please log in or register</h2></td>
						</tr>
						<tr align="center">
							<td align="right">Email:</td>
							<td><input type="text" name="email" placeholder="enter email" required/></td>
						</tr>
						<tr>
							<td align="right">Password:</td>
							<td align="center"><input type="password" name="pass" placeholder="enter password" required/></td>
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

