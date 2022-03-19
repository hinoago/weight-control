<?php
	include "Connection.php";
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name='viewport' content='width=device-width'>
		<title>Home</title>
		<style>
			*{
				margin: 0;
				padding: 0;
			}

			body{
				background-color: #6d99b0;
				text-align: center;
			}
			
			table{
				border-collapse: collapse;
				width: 50%;
				text-align: center;
				margin: auto;
			}

			td, th{
				border: 1px solid black;
				padding: 4px;
			}
	
			.header{
				height: 10vh;
			}
	
			.container{
				margin-top: 3vh;
				margin-bottom: 3vh;
				height: 74vh;
 		 		overflow: auto;
			}

			.footer{
				height: 10vh;
			}

			.add{
				display: block;
				margin: auto;
				margin-top: 3vh;
			}

			a{
				background-color: #ccc;
				width: 100%;
				display: inline-block;
				text-decoration: none;
			}

			a:hover{
				background-color: #aaa;
			}

			@media(max-width: 500px){
				.container{
					height: 60vh;
				}

				input{
					width: 40%;
				}
			}
		</style>
	</head>
	<body>
		<div class='header'>
			<h1>
				<?php
					if($_SESSION["user"] == "mariana"){
						echo "Bem vinda ".$_SESSION["user"];
					}else{
						echo "Bem vindo ".$_SESSION["user"];
					}
				?>
			</h1>
		</div>
		<div class='container'>
			<table>
				<tr>
					<th>Data</th><th>Peso</th><th></th>
				</tr>
				<?php
					$stmt = Connection::getDateWeight("name", $_SESSION["user"], "frequency");
					$arr = $stmt->fetchAll();
					$date;
					foreach($arr as $keys => $value){
						echo "<tr>";
						foreach($value as $key => $v){
							echo "<td class=row".$keys.">".$v."</td>";
							if($key == "date"){
								$date = $v;
							}
						}
						echo "<td><a href='delete.php?date=".$date."'><img src='trash.png' width='14' height='14' /></a></td></tr>";
					}
				?>
			</table>
		</div>
		<div class='footer'>
			<input type='text' id='date' class='date' name='date' placeholder='Informe a data'>
			<input type='text' id='weight' class='weight' name='weight' placeholder='Informe o peso'>
			<button class='add'>Adicionar</button>
		</div>
		<script>
			var $add = document.querySelector(".add");
			var $container = document.querySelector(".container");
			var formData = new FormData();
			$add.addEventListener("click", () =>{
				var $weight = document.querySelector("#weight").value;
				var $date = document.querySelector("#date").value; 
				var ajax = new XMLHttpRequest();
				formData.append("date", $date);
				formData.append("weight", $weight);
				ajax.open("POST", "frequency.php");
				ajax.send(formData);
				ajax.addEventListener("readystatechange", function(){
					if(this.readyState == 4){
						$container.innerHTML = this.responseText;
					}
				});
				$date = "";
				$weight = "";
			});
		</script>
	</body>
</html>
