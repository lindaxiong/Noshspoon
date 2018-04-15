<?php

session_start();
if (isset($_SESSION['username'])) {
	require_once 'library.php';
	date_default_timezone_set('UTC');
	$connection = new mysqli($hostname, $username, $password, $database);
	if ($connection->connect_error) {
		die($connection->connect_error);
	}
	$recipient = $connection->real_escape_string($_POST['recipient']);
	$street = $connection->real_escape_string($_POST['street']);
	$city = $connection->real_escape_string($_POST['city']);
	$state = $connection->real_escape_string($_POST['state']);
	$zip = $_POST['zip'];
	$username = $_SESSION['username'];
	$query = "INSERT INTO Addresses (recipient, street, city, state, zip, username) VALUES ('$recipient', '$street', '$city', '$state', '$zip', '$username')";
	if ($connection->query($query)) {
		echo 'success';
	} else {
		echo 'failed';
	}
	mysqli_close($connection);
} else {
	echo 'not_logged_in';
}
