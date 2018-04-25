<?php
session_start();
if (isset($_SESSION['username'])) {
	require_once 'library.php';
	date_default_timezone_set('UTC');
	$connection = new mysqli($hostname, $username, $password, $database);
	if ($connection->connect_error) {
		die($connection->connect_error);
	}
	$queryname = $_SESSION['username'];

	$query1 = "SELECT in_cart FROM Cart WHERE username = '$queryname'";
	$query2 = "SELECT SUM(price) AS total FROM Items WHERE item_id IN (SELECT in_cart FROM Cart WHERE username = '$queryname')";
	$result = $connection->query($query2);
	$row1 = $result->fetch_assoc(); # use this to fetch row
	$total = (int)$row1['total'];

	$query5 = "SELECT address_id FROM Addresses WHERE username = '$queryname'";
	$result5 = $connection->query($query5);
	$row5 = $result5->fetch_assoc(); # use this to fetch row
	$address_id = (int)$row5['address_id'];
	$query3 = "INSERT INTO Orders(order_time, address_id, order_total) VALUES (CURRENT_TIMESTAMP, '$address_id', '$total')";
	$connection->query($query3);

	$query4 = "SELECT order_id FROM Orders ORDER BY order_id DESC LIMIT 1";
	$result2 = $connection->query($query4);
	$row2 = $result2->fetch_assoc(); # use this to fetch row
	$order_id = (int)$row2['order_id'];

	$result3 = $connection->query($query1);
	while ($row3 = $result3->fetch_assoc()) {
		$item_id = $row3['in_cart'];
		$query5 = "INSERT INTO Order_details (order_id, item_id, quantity, username) VALUES ('$order_id', '$item_id', 1, '$queryname')";
		$connection->query($query5);
	}


	$query6 = "UPDATE Items SET quantity = (quantity-1) WHERE item_id IN (SELECT in_cart FROM Cart WHERE username = '$queryname')";
	$connection->query($query6);

	$query7 = "DELETE FROM Cart WHERE username = '$queryname'";
	$connection->query($query7);


	// need to implement placing order, get id of items from form
	if ($connection->query($query7)) {
		echo 'success';
	} else {
		echo 'failed';
}
	mysqli_close($connection);
} else {
	echo 'not_logged_in';
}
?>