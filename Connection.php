<?php
	include "connect-info.php";
	class Connection{
		public static function getDateWeight($attribute, $value, $table){
			$dsn = getDsn();
			$user = getUsername();
			$pass = getPassword();
			$conn = new PDO($dsn, $user, $pass);

			$sql = "SELECT date, weight FROM ${table} WHERE ${attribute} = '${value}'";
			return $conn->query($sql, PDO::FETCH_ASSOC);
		}

		public static function putDateWeight($date, $weight, $name){
			$dsn = getDsn();
			$user = getUsername();
			$pass = getPassword();
			$conn = new PDO($dsn, $user, $pass);

			$sql = "INSERTO INTO frequency(date, weight, name) VALUES('${date}', '${weight}', '${name}'";
			return $conn->query($sql, PDO::FETCH_ASSOC);
		}	
	}
?>
