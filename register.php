<!DOCTYPE html>
<?php
// include ("config/setup.php");
// require "config/setup.php";
ini_set("display_errors", true);
// session_start();
    // include("functions/functions.php");
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles/style.css" media="all" />
		<title>Camagru</title>
	</head>
	<body>
			<div class="header_wrapper">
				<a href="index.php">
					<img id="banner" src="images/rengelbr_logo.png">
				</a>
			</div>
		<div class="main_wrapper">
			<!--Navigation bar-->
			<div class="menubar">
				<ul id="menu">
						<li><a href="index.php">Home</a></li>
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
				<form action="register.php" method="POST" enctype="multipart/form-data">
				<table align="center">
					<tr align="center">
						<td colspan="6" style="padding:15px; color:white;"><h2>Create your Account</h2></td>
					</tr>
					<tr>
						<td align="right" style="padding:15px; color:white;">Name: </td>
						<td><input type="text" name="u_name" required/></td>
					</tr>
					<tr>
						<td align="right" style="padding:15px; color:white;">E-mail: </td>
						<td><input type="text" name="u_email" required/></td>
					</tr>
					<tr>
						<td align="right" style="padding:15px; color:white;">Password: </td>
						<td><input type="password" name="u_passwd" required/></td>
					</tr>
					<tr>
						<td align="right" style="padding:15px; color:white;">Image: </td>
						<td><input type="file" name="u_image" required/></td>
					</tr>
					<tr>
						<td align="right" style="padding:15px; color:white;">Contact Number: </td>
						<td><input type="text" name="u_contact" required/></td>
					</tr>
					<tr align="center" >
						<td colspan="6" style="padding:15px"><input type="submit" name="register" value="Create Account"/></td>
					</tr>
				</table>
			</form>
		</div>
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
<?php
	$con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "qwerqwer");
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// if ($con)
	// 	echo "yea boi\n";
	// print_r($_POST);
	echo $u_name = $_POST['u_name']."\n";
	echo $u_email = $_POST['u_email']."\n";
	echo $u_passwd = hash('whirlpool', $_POST['u_passwd'])."\n";
	$u_image = $_FILES['u_image'];
	echo $u_contact = $_POST['u_contact']."\n";

	$sql = "INSERT INTO users (`user_name`, `user_passwd`, `user_email`, `user_contact`, `user_image`) VALUES ($u_name, $u_passwd, $u_email, $u_contact, $u_image);";
	$con->exec($sql);
	// $stmt = $dbh->prepare($sql);
	// $stmt->exec(['u_name'=>$u_name, 'u_passwd'=>$u_passwd, 'u_email'=>$u_email, 'u_contact'=>$u_contact, 'u_image'=>$u_image]);
	echo"post added?"
?>



