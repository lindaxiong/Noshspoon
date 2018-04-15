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
	$query2 = "SELECT order_id, item_id, quantity FROM Order_details GROUP BY order_id IN (SELECT distinct order_id FROM Transactions WHERE buyer_id = '$username')"; // maybe still need Transactions table to keep track of order history?
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