<?php
	include "connect-info.php";
	session_start();

	if(isset($_POST["user"]) && isset($_POST["pass"])){
		$dsn = getDsn();
		$user = getUsername();
		$pass = getPassword();
		$conn = new PDO($dsn, $user, $pass);

		$sql = "SELECT * FROM users WHERE name = :name AND pass = :pass";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam("name", $_POST["user"]);
		$stmt->bindParam("pass", $_POST["pass"]);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if($result == false){
			//TO DO
		}else{
			$_SESSION["user"] = $_POST["user"];
			header("Location: home.php");
		}
	}else{
		//TO DO
	}
?>
