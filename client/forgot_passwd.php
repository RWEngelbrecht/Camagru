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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Rigardt Engelbrecht">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
		<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
		<title>Camagru - Forgot Password</title>
	</head>
	<body>
		<header>
			<div class="navbar">
				<div class="navbar-brand">
					<a href="../index.php">
						<img id="banner" src="../images/rengelbr_logo.png">
					</a>
								<!-- <div class="nav_bar">
									<ul id="menu">
											<li><a href="../index.php">Home</a></li>
									</ul>
									<div class="dropdown">
										<button onclick="myFunction()" class="dropbtn">Login - Register</button>
										<div id="myDropdown" class="dropdown-content">
											<a href="../login.php">Login</a>
											<a href="../register.php">Register</a>
										</div> -->
					<?php //get_menu(); ?>
				<div class='navbar-start'>
					<div class='navbar-item'>
						<a class='button is-primary' href='../index.php'>Home</a>
					</div>
					<div class='navbar-item'>
						<a class='button is-light' href='../login.php'>Log In</a>
					</div>
					<div class='navbar-item'>
						<a class='button is-primary' href='../register.php'>Register</a>
					</div>
				</div>
				</div>
			</div>
		</header>
		<section class="section">
			<div class="container">
	<!-- login form -->
				<form method="POST" action="">
					<!-- <table>
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
					</table> -->
					<div class="field">
						<label class="label">Forgot to remember your password?</label>
						<p class="control has-icons-left">
							<input class="input is-medium" type="email" name="user_email" placeholder="email"/>
							<span class="icon is-small is-left">
								<i class="fas fa-envelope"></i>
							</span>
						</p>
					</div>
					<div class="field">
						<p class="control">
							<input class="button is-success" type="submit" name="reset" value="Reset Password">
						</p>
					</div>
				</form>
				<?php
					if (isset($_POST['reset'])) {
						if (reset_passwd()) {
							echo "<script>window.alert('We all forget things. Check your email to reset your password.')</script>";
						}
					}
				?>
			</section>
			<!--content wrapper ends-->
			<!--footer starts-->
			<div id="footer">
				<h2 style="text-align:center; padding-top:30px;">&#169; rengelbr</h2>
			</div>
		</div>
		<!--footer ends-->
	</body>
</html>

