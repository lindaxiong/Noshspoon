<?php
function post($array){
	require_once('library.php');
	date_default_timezone_set("UTC");
	$connection = new mysqli($hostname, $username, $password, $database);
	if($connection->connect_error) die($connection->connect_error);
	$size = count($array);
	switch($array[0]){
		case 'user': // register a user (username, name, password hash)
			if(isset($array[1]) && isset($array[2]) && isset($array[3])){
				$select = "SELECT * FROM Users WHERE username = '$array[1]'";
				$exists = $connection->query($select);
				$rows = $exists->num_rows;
				if($rows == 0){
					$hash = md5($array[3]);
					echo $hash;
					$query = "INSERT INTO Users VALUES ('$array[1]', '$array[2]', '$hash')";
					$connection->query($query);	
					header('Location:modal.php'); // register success
				}else{
					header('Location:modal.php'); // put "user already exists" on the page
				}
				break;
			}
		}
	}
?>