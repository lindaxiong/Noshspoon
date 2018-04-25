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

	$select = "SELECT * FROM Items WHERE item_name = '$name'";
	$exists = $connection->query($select);
    $rows = $exists->num_rows;
    if ($rows == 0) {
    	$query = "INSERT INTO Items (item_name, price, picture, quantity, type, description) VALUES ('$name', '$price', '$picture', '$quantity', '$type', '$description')";
		if (mysqli_query($connection, $query)) {
			echo 'success';
		}
		else {
			echo 'failed';
		}
    } else {
    	$query = "UPDATE Items SET quantity = (quantity + '$quantity') WHERE item_name='$name'";
		if (mysqli_query($connection, $query)) {
			echo 'success';
		} else {
			echo 'failed';
		}
    	
    }

	
	mysqli_close($connection);
} else {
	echo 'not_logged_in';
}
?>



         