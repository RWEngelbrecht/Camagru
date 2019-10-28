<!DOCTYPE html>
<?php
// include ("config/setup.php");
include 'includes/connect.php';
include '../functions/functions.php';
ini_set("display_errors", true);
session_start();
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta name="author" content="Rigardt Engelbrecht">
		<link rel="stylesheet" href="../styles/index.css" media="all" />
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
				<a href="../index.php">
					<img id="banner" src="../images/rengelbr_logo.png">
				</a>
				<div class="nav_bar">
					<ul id="menu">
							<li><a href="../index.php">Home</a></li>
					</ul>
					<div class="dropdown">
						<button onclick="myFunction()" class="dropbtn">Login - Register</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="../login.php">Login</a>
							<a href="../register.php">Register</a>
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
				<form method="POST" action="forgot_passwd.php">
					<table>
						<tr align="center">
							<td colspan="3"><h3 style="color:white;margin:10px">Forgot to have your browser remember your password, did you?</h3></td>
						</tr>
						<tr>
							<td align="right" style="color:white;padding:15px">Email:</td>
							<td><input type="text" name="user_email" placeholder="email" required/></td>
						</tr>
						<tr align="center">
							<td colspan="3"><input type="submit" name="reset" value="Reset Password"/></td>
						</tr>
					</table>
				</form>
				<?php
					if (isset($_POST['reset'])) {
						if (reset_passwd()) {
							echo "<script>window.alert('We all forget things. Check your email to reset your password.')</script>";
						}
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

