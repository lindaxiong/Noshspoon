<?php
session_start();
if (isset($_SESSION['username'])) {
	require_once 'library.php';
	date_default_timezone_set('UTC');
	$connection = new mysqli($hostname, $username, $password, $database);
	if ($connection->connect_error) {
		die($connection->connect_error);
	}
	$username = $_SESSION['username'];
	$query2 = "SELECT order_id, item_name, Order_details.quantity FROM `Order_details` JOIN Items ON Order_details.item_id=Items.item_id WHERE username='$username' ORDER BY order_id";
	$result2 = $connection->query($query2);
	$orders = array();
	if (!$result2)
		echo "No result2";
	while ($row2 = $result2->fetch_assoc()) {
		array_push($orders, $row2);
	}
	header('Content-disposition: attachment; filename=file.json');
	header('Content-type: application/json');
	echo json_encode($orders, JSON_PRETTY_PRINT);
} else {
	echo 'Did not export json';
}
?> 