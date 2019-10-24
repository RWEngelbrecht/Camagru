<!DOCTYPE html>
<?php
// include("config/setup.php");
include '../includes/connect.php';
include '../config/database.php';
ini_set("display_errors", true);
session_start();
    // include("functions/functions.php");
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../styles/style.css" media="all" />
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
				<ul id="menu">
						<li><a href="../index.php">Home</a></li>
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
				<?php
					$u_email = $_SESSION['user_email'];
					if (isset($_GET['ver_key'])) {
						$get_ver = $con->prepare("SELECT token FROM users WHERE user_email=?");
						$get_ver->execute([$u_email]);
						$fetch_key = $get_ver->fetch();
						$ver_key = $fetch_key['token'];
						if ($_GET['ver_key'] == $ver_key) {
							$updt_usr = $con->prepare("UPDATE users SET verified=1 WHERE user_email='$u_email'");
							$updt_usr->execute();
							echo "<h2>You have successfully registered. Yay! Let's get started with your new, more fulfilling life! Just click <a href='my_account.php?user=".$_SESSION['user_id']."'>here</a>.</h2>";
						}
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
