<!DOCTYPE html>
<?php
include("config/setup.php");
include "functions/functions.php";
ini_set("display_errors", true);
session_start();
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
			<!--content wrapper starts-->
			<div class="content_wrapper">
				<div class="upload_wrapper">
					<div id="upload_main">
						<!-- Should show webcam, webcam button, upload img button-->
						<h1>upload main</h1>
						<form action="" enctype="multipart/form-data" method="POST">
							<input name="upl_image" type="file">
							<input name="upload" type="submit" value="Upload Picture">
							<?php if (isset($_POST['upload'])){
									// if (isset($_FILE['upl_img'])){
										upload_image($_SESSION['user_id']);
									// }
								} ?>
						</form>
					</div>
					<div id="upload_side">
						<!-- Display previous pics taken/uploaded -->
						<h1>upload side</h1>
						<?php //get_upload_thumbs(); ?>
					</div>
				</div>
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
	if ($_GET['session_status'] == "logout") {
		log_out("index");
	}
}
?>
