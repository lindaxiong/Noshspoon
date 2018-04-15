<?php
session_start();
if (isset($_SESSION['username'])) {
	require_once 'library.php';
	date_default_timezone_set('UTC');
	$connection = new mysqli($hostname, $username, $password, $database);
	if ($connection->connect_error) {
		die($connection->connect_error);
	}
	$name = $connection->real_escape_string($_POST['itemName']);
	$price = $_POST['itemPrice'];
	$picture = $connection->real_escape_string($_POST['itemPicture']);
	$quantity = $_POST['itemQuantity'];
	$type = $connection->real_escape_string($_POST['itemType']);
	$description = $connection->real_escape_string($_POST['itemDescription']);
	$username = $_SESSION['username'];

	$query1 = "INSERT INTO Items (item_name, price, picture, quantity, type, description) VALUES ('$name', '$price', '$picture', '$quantity', '$type', '$description')";
	$connection->query($query1);

	$query2 = "SELECT item_id FROM Items ORDER BY item_id DESC LIMIT 1";
	$result = $connection->query($query2);
	$row = $result->fetch_assoc(); # use this to fetch row

	$item_id = (int)$row['item_id'];
	$query3 = "INSERT INTO Stock (username, in_stock) VALUES ('$username', '$item_id')";

	if ($connection->query($query3)) {
		echo 'success';
	} else {
		echo 'failed';
	}
	mysqli_close($connection);
} else {
	echo 'not_logged_in';
}
?>
