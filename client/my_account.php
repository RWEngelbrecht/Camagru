<!DOCTYPE html>
<?php
// include("config/setup.php");
include "../includes/connect.php";
include "../functions/functions.php";
ini_set("display_errors", true);
session_start();
// include("functions/functions.php");
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Rigardt Engelbrecht">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
		<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
		<style>
			.navbar-brand {
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 220px;
				z-index: 10;
				background: #eeeeee;
				-webkit-box-shadow: 0 7px 8px rgba(0, 0, 0, 0.12);
				-moz-box-shadow: 0 7px 8px rgba(0, 0, 0, 0.12);
				box-shadow: 0 7px 8px rgba(0, 0, 0, 0.12);
			}
		</style>
		<title>Camagru - My Account</title>

	</head>
	<body>
		<header>
			<!-- <a href="../index.php">
				<img id="banner" src="../images/rengelbr_logo.png">
			</a>
			<div class="menubar">
				<div class="nav_bar">
					<ul id="my_acc_menu">
						<li><a href="../index.php">Home</a></li>
						<li><a href='../new_upload.php'>New Upload</a></li>
						<li><a href="my_account.php?session_status=logout">Log Out</a></li>
					</ul>
				</div>
			</div> -->
			<div class="navbar">
			<div class="navbar-brand">
				<a href="../index.php">
					<img id="banner" src="../images/CAMAGRUFORU.png">
				</a>
				<div class='navbar-start'>
					<div class='navbar-item'>
						<a class='button is-primary' href='../index.php'>Home</a>
					</div>
					<div class='navbar-item'>
						<a class='button is-light' href='new_upload.php'>New Upload</a>
					</div>
					<div class='navbar-item'>
						<a class='button is-light' href='my_account.php?session_status=logout'>Log Out</a>
					</div>
				</div>
			</div>
		</header>
		<section class="section" style="margin-top:150px">
				<div class="tile is-ancestor">
					<div class="tile is-2">
					<article class="tile is-child box">
						<figure class="image is-128x128">
							<?php
								$get_udata = $con->prepare("SELECT * FROM users WHERE user_email=?");
								$get_udata->execute([$_SESSION['user_email']]);
								$u_data = $get_udata->fetch();
								$u_img = $u_data['user_image'];
								echo "<img class='is-rounded' src='data:image/png;base64,".$u_img."' />";
							?>
						</figure>
						<br/>
					<p class="menu-label">
						<?php echo $_SESSION['user_name'] ?>
					</p>
					<ul class="menu-list">
						<li><a id="open-modal" href="my_account.php?session_status=update">Edit Account</a></li>
					</ul>
					</article>
					</div>
					<div class="tile is-10">
						<div class="tile is-parent">
							<article class="tile is-child box">
								<?php
									if (isset($_GET['session_status'])){
										include_once 'update_account.php';
									}
									else {
										get_upload_thumbs($_SESSION['user_id']);
									}
									if (isset($_POST['updt_name']) || isset($_POST['updt_email']) || isset($_POST['updt_passwd']) || isset($_POST['updt_image'])){
										update_user($u_data['user_id']);
									}
								?>
							</article>
						</div>
					</div>
				</div>

		</section>
	</body>
	<footer>
		<div id="footer">
			<h2 style="text-align:center; padding-top:30px;">&#169; rengelbr</h2>
		</div>
	</footer>
</html>
<?php
if (isset($_GET['session_status'])) {
	if ($_GET['session_status'] == "logout") {
		log_out("my_account");
	}
}
?>
