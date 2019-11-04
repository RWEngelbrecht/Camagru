<!DOCTYPE html>
<?php
include("config/setup.php");
include "../functions/functions.php";
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
		<script>
			function hasGetUserMedia() {
				return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
			}
			if (!hasGetUserMedia()) {
				alert("navigator.mediaDevices.getUserMedia doesn\'t exist");
			}else {
				var video = document.querySelector("#vidElement");
				navigator.mediaDevices.getUserMedia({video:true}).then(function(stream) {
						video.srcObject = stream;
					}).catch(function(err0r) {
						console.log("Well, that did not work.");
					});
			}


		</script>
		<title>Camagru</title>
	</head>
	<body>
		<header>
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
						<a class='button is-light' href='my_account.php'>My Account</a>
					</div>
					<div class='navbar-item'>
						<a class='button is-light' href='new_upload.php?session_status=logout'>Log Out</a>
					</div>
				</div>
				</div>
			</div>
		</header>
		<main>
			<section class="section">
				<!-- <div class="columns is-vcentered">
					<div class="column" style="background:blue">
						<div class="container">
							<form action="" enctype="multipart/form-data" method="POST">
								<input name="upl_image" type="file">
								<input name="upload" type="submit" value="Upload Picture">

							</form>
						</div>
					</div>
					<div class="column is-one-quarter" style="background:black">
						<div class="container">

						</div>
					</div>
				</div> -->
				<div class="tile is-ancestor">
					<div class="tile is-8">
						<div class="tile is-parent">
							<article class="tile is-child box">
								<p class="title">main [webcam, upload]</p>
								<video autoplay="true" id="vidElement"></video>
								<!-- <figure class="image"><img src="images/rengelbr_logo.png"><figure> -->
								<form action="" enctype="multipart/form-data" method="POST">
									<input name="upl_image" type="file">
									<input name="upload" type="submit" value="Upload Picture">
								</form>
							</article>
						</div>
					</div>
					<div class="tile is-4">
						<div class="tile is-parent">
							<article class="tile is-child box">
								<p class="title">Images You've Uploaded</p>
								<?php get_upload_thumbs($_SESSION['user_id']); ?>
							</article>
						</div>
					</div>
				</div>
				<?php
					if (isset($_POST['upload'])){
						if (isset($_FILES['upl_image']['name'])){
							upload_image($_SESSION['user_id']);
						}
					}
				?>
			</section>
		<main>
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
		log_out("new_upload");
	}
}
?>
