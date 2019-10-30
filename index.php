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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Rigardt Engelbrecht">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
		<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
		<title>Camagru</title>
	</head>
	<body>
		<header>
			<div class="navbar">
				<div class="navbar-brand">
					<a href="index.php">
						<img id="banner" src="images/rengelbr_logo.png">
					</a>
				<!-- </div> -->
				<!-- <div class="navbar-menu"> -->
					<?php
						get_menu();
					?>
				</div>
			</div>
		</header>
		<section class="section">
			<!--content wrapper starts-->
			<div class="container">
				<div class="gallery">
					<?php
						get_gallery();
					?>
				</div>
			</div>
		</section>
				<nav class="pagination" role="navigation" aria-label="pagination">
				<a class="pagination-previous" title="This is the first page" disabled>Previous</a>
				<a class="pagination-next">Next page</a>
				<ul class="pagination-list">
				<li>
					<a class="pagination-link is-current" aria-label="Page 1" aria-current="page">1</a>
				</li>
				<li>
					<a class="pagination-link" aria-label="Goto page 2">2</a>
				</li>
				<li>
					<a class="pagination-link" aria-label="Goto page 3">3</a>
				</li>
				</ul>
			</nav>
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
