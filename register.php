<?php
session_start();
include ("setup.php");
?>
<html>
<div>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="all" />
	</head>
	<body>
	<div class="main_wrapper">
		<form action="customer_register.php" method="POST" enctype="multipart/form-data">
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
		<?php
			global $dbh;
			$u_name = $_POST['u_name'];
			$u_email = $_POST['u_email'];
			$u_passwd = hash('whirlpool', $_POST['u_passwd']);
			$u_image = $_FILES['u_image'];
			$u_contact = $_POST['u_contact'];

			$stmt = $dbh->query("INSERT INTO users (`user_name`, `user_passwd`, `user_email`, `user_contact`, `user_image`) VALUES ('$u_name', '$u_passwd', '$u_email', '$u_contact', '$u_image')");
		?>
	</div>
	</body>
</html>
<?php

?>
