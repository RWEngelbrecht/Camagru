<div id="update_form">
	<!-- <form action="my_account.php" method="POST" enctype="multipart/formdata"> -->
		<table>
		<tr align="center">
			<td colspan="6" style="padding:15px; color:white;"><h2>Update your Account</h2></td>
			</tr>
			<tr>
				<td align="right" style="padding:15px; color:white;">Name: </td>
				<td><?php echo $_SESSION['user_name']; ?></td>
				<td style="font-size:10px">[<a href="my_account.php?update=username">Update Username</a>]</td>
			</tr>
			<tr>
				<td align="right" style="padding:15px; color:white;">E-mail: </td>
				<td><?php echo $_SESSION['user_email'] ?></td>
				<td style="font-size:10px">[<a href="my_account.php?update=email">Update E-mail</a>]</td>
			</tr>
			<tr>
				<td align="right" style="padding:15px; color:white;">Password: </td>
				<td style="font-size:10px">[<a href="my_account.php?update=passwd">Update Password</a>]</td>
			</tr>
			<tr>
				<td align="right" style="padding:15px; color:white;">Image: </td>
				<td style="font-size:10px">[<a href="my_account.php?update=image">Update Account Picture</a>]</td>
			</tr>
		</table>
	<!-- </form> -->
</div>
