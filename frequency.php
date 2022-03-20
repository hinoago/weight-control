<?php
	include "Connection.php";
	//include_once "connect-info.php";
	session_start();

	$dsn = getDsn();
	$user = getUsername();
	$pass = getPassword();
	$conn = new PDO($dsn, $user, $pass);
	$date = $_POST["date"];
	$weight = $_POST["weight"];
	$name = $_SESSION["user"];

	$sql = "INSERT INTO frequency(date, weight, name) VALUES('${date}', '${weight}', '${name}')";
	$conn->exec($sql);
	
	$string = '<table>
			<tr>
				<th>Data</th><th>Peso</th><th></th>
			</tr>';
		$stmt = Connection::getDateWeight("name", $_SESSION["user"], "frequency");
		$arr = $stmt->fetchAll();
		$date;
		foreach($arr as $keys => $value){
			$string .= "<tr>";
			foreach($value as $key => $v){
				$string .= "<td class=row".$keys.">".$v."</td>";
				if($key == "date"){
					$date = $v;
				}
			}
			$string .= "<td><a href='delete.php?date=".$date."'><img src='trash.png' width='14' height='14' /></a></td></tr>";
		}
		$string .= '</table>';
		echo $string;
?>
