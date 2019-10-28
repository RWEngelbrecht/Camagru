<!DOCTYPE html>
<?php
// include ("config/setup.php");
include 'includes/connect.php';
include 'functions/functions.php';
ini_set("display_errors", true);
session_start();
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="author" content="Rigardt Engelbrecht">
		<link rel="stylesheet" href="styles/index.css" media="all" />
		<title>Camagru - Login</title>
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
					<ul id="menu">
							<li><a href="index.php">Home</a></li>
					</ul>
					<div class="dropdown">
						<button onclick="myFunction()" class="dropbtn">Login - Register</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="login.php">Login</a>
							<a href="register.php">Register</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="main_wrapper">
<!--Navigation bar-->
			<div class="menubar">
			</div>
<!--content wrapper starts-->
			<div class="content_wrapper">
	<!-- login form -->
				<form method="POST" action="login.php">
					<table>
						<tr align="center">
							<td colspan="3"><h2 style="color:white;margin:10px">Welcome Back</h2></td>
						</tr>
						<tr>
							<td align="right" style="color:white;padding:15px">Email:</td>
							<td><input type="text" name="user_email" placeholder="email" required/></td>
						</tr>
						<tr>
							<td align="right" style="color:white;padding:15px">Password:</td>
							<td><input type="password" name="user_passwd" placeholder="password" required/></td>
						</tr>
						<tr>
							<td align="right" colspan="3" style="font-size:12px;padding:0px 90px 5px"><a href="client/forgot_passwd.php">Forgot Password?</a></td>
						</tr>
						<tr align="center">
							<td colspan="3"><input type="submit" name="login" value="Log In"/></td>
						</tr>
					</table>
				</form>
				<?php
					if (isset($_POST['login'])) {
						log_in();
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

