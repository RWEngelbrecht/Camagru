<?php
include 'config/database.php';

try {
	$dbh = new PDO($dsn, $db_user, $db_passwd);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$quer = $dbh->query("CREATE DATABASE IF NOT EXISTS $db_name");
	$dbh->exec($quer);
}
catch(PDOException $e) {
	echo "ERROR: ".$e->getMessage();
}
$dbh = null;
?>
