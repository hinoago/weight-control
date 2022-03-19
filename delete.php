<?php
	include "connect-info.php";

	$date = $_GET["date"];
	$dsn = getDsn();
	$user = getUsername();
	$pass = getPassword();
	$conn = new PDO($dsn, $user, $pass);

	$sql = "DELETE FROM frequency WHERE date = '".$date."';";
	$conn->query($sql);
	header("Location: home.php");
?>
