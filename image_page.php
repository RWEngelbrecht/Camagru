<!DOCTYPE html>
<?php
include("config/setup.php");
include "functions/functions.php";
include "functions/image_functions.php";
include "functions/comment_functions.php";
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
		<title>Camagru</title>
	</head>
	<body>
		<header>
			<!-- <div class="navbar"> -->
				<div class="navbar-brand">
					<a href="index.php">
						<img id="banner" src="images/CAMAGRUFORU.png">
					</a>
					<?php
						get_menu();
					?>
				</div>
			<!-- </div> -->
		</header>
		<main>
			<section class="section">
				<div class="container is-fluid">
					<!-- <div class="gallery"> -->
						<?php get_image($_GET['img']); ?>
						<div class="control">
							<form method="POST" action="">
								<input class="textarea" type="text" name="cmntContent" placeholder="Comment...">
								<div class="field is-grouped is-grouped-right">
									<input class="button is-success" type="submit" name="comment" value="Comment">
								</div>
							</form>
						</div>
						<?php
							if (isset($_POST['comment'])) {
								post_comment($_GET['img']);
							}
							get_comments($_GET['img']);
						?>
					<!-- </div> -->
				</div>
			</section>
		</main>
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
		log_out("index");
	}
}
?>
