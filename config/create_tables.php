<?php
include "config/database.php";

$table = "users";

try {
	$con = new PDO($dsn.";dbname=".$db_name, $db_user, $db_passwd);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "CREATE TABLE IF NOT EXISTS $table(
	`ID` INT(100) AUTO_INCREMENT PRIMARY KEY,
	`user_name` varchar(255) NOT NULL,
	`user_passwd` varchar(100) NOT NULL,
	`user_email` varchar(255) NOT NULL,
	`user_contact` varchar(100) NOT NULL,
	`user_image` varchar(255))";

	$con->exec($sql);
}
catch(PDOException $e) {
	echo "ERROR: ".$e->getMessage();
}

$con = null;
?>
