<?php
include "config/database.php";

try {
	$con = new PDO($dsn.";dbname=".$db_name, $db_user, $db_passwd);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$usr = "CREATE TABLE IF NOT EXISTS users(
	`user_id` INT(100) AUTO_INCREMENT PRIMARY KEY,
	`user_name` VARCHAR(255) NOT NULL,
	`user_passwd` VARCHAR(255) NOT NULL,
	`user_email` VARCHAR(255) NOT NULL,
	`user_contact` VARCHAR(100) NOT NULL,
	`user_image` LONGTEXT,
	`token` VARCHAR(255) NOT NULL,
	`verified` BIT default 0 NOT NULL)";

	$con->exec($usr);

	$img = "CREATE TABLE IF NOT EXISTS images(
		`id` INT(100) AUTO_INCREMENT PRIMARY KEY,
		`u_id` INT(100) NOT NULL,
		`img_name` LONGTEXT,
		`date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
		// FOREIGN KEY (u_id) REFERENCES users(user_id)";

	$con->exec($img);
}
catch(PDOException $e) {
	echo "ERROR: ".$e->getMessage();
}

$con = null;
?>
