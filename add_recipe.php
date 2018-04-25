<?php
session_start();
if (isset($_SESSION['username'])) {
	require_once 'library.php';
	date_default_timezone_set('UTC');
	$connection = new mysqli($hostname, $username, $password, $database);
	if ($connection->connect_error) {
		die($connection->connect_error);
	}
	$name = $connection->real_escape_string($_POST['recipeName']);
	$picture = $connection->real_escape_string($_POST['recipePicture']);
	$description = $connection->real_escape_string($_POST['recipeDescription']);
	$ingredients = $_POST['ingredients'];
	$username = $_SESSION['username'];


	$query = "INSERT INTO Recipe (food_name, food_pic, description) VALUES ('$name', '$picture', '$description')";
	if (mysqli_query($connection, $query)) {
		//Grab the last added recipe_id
		$query = "SELECT * FROM Recipe ORDER BY r_id DESC";
		$result = mysqli_query($connection, $query);
		if(!$result) {
			echo 'failed';
		}
		$rec = mysqli_fetch_assoc($result);
		$rid = $rec['r_id'];
		foreach($ingredients as $ing){
			$query = "INSERT INTO Ingredients (r_id, item_id) VALUES ('$rid', '$ing')";
			$result = mysqli_query($connection, $query);
			if(!$result) {
				echo 'failed';
			}
		}
		echo 'success';
	}
	 else {
		echo 'failed';
	}
	mysqli_close($connection);
} else {
	echo 'not_logged_in';
}
?>