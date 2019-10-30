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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Rigardt Engelbrecht">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
		<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
		<title>Camagru - Login</title>
	</head>
	<body>
		<header>
			<div class="navbar">
				<div class="navbar-brand">
					<a href="index.php">
						<img id="banner" src="images/rengelbr_logo.png">
					</a>
					<?php
						get_menu();
					?>
				</div>
			</div>
		</header>
		<section class="section">
<!--content wrapper starts-->
			<div class="container">
	<!-- login form -->
				<form method="POST" action="login.php">
					<div class="field">
						<label class="label">Log In</label>
						<p class="control has-icons-left">
							<input class="input is-medium" type="email" name="user_email" placeholder="email" required/>
							<span class="icon is-small is-left">
								<i class="fas fa-envelope"></i>
							</span>
						</p>
					</div>
					<div class="field">
						<p class="control has-icons-left">
							<input class="input is-medium" type="password" name="user_passwd" placeholder="password" required/>
							<span class="icon is-small is-left">
								<i class="fas fa-lock"></i>
							</span>
						</p>
					</div>
					<div class="field">
						<p class="control">
							<input class="button is-success" type="submit" name="login" value="Login">
						</p>
					</div>
				</form>
				<?php
					if (isset($_POST['login'])) {
						log_in();
					}
				?>
			</div>
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

