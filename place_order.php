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
	$query1 = "SELECT in_cart FROM Cart WHERE username = '$username'";
	$query2 = "SELECT SUM(price) AS total FROM Items WHERE item_id IN (SELECT in_cart FROM Cart WHERE username = '$username')";
	$result = $connection->query($query2);
	$row1 = $result->fetch_assoc(); # use this to fetch row
	$total = (int)$row1['total'];

	$query3 = "INSERT INTO Orders(order_time, order_total, coupon_code) VALUES (CURRENT_TIMESTAMP, '$total', 'NONE')";
	$connection->query($query3);

	$query4 = "SELECT order_id FROM Orders ORDER BY order_id DESC LIMIT 1";
	$result2 = $connection->query($query4);
	$row2 = $result2->fetch_assoc(); # use this to fetch row
	$order_id = (int)$row2['order_id'];

	$result3 = $connection->query($query1);
	while ($row3 = $result3->fetch_assoc()) {
		$item_id = $row3['in_cart'];
		$query5 = "INSERT INTO Order_details (order_id, item_id, quantity) VALUES ($order_id, $item_id, 1)";
		if ($connection->query($query5)) echo "inserted into order details";
	}

	$query_getusername = "SELECT DISTINCT username FROM Stock WHERE in_stock IN (SELECT in_cart FROM Cart WHERE username = '$username')";
	$result4 = $connection->query($query_getusername);
	if (!$result4) echo "failed result4";
	while ($row4 = $result4->fetch_assoc()) {
		$seller_id = $row4['username'];
		echo $username;
		echo $seller_id;
		echo $order_id;
		$query_insert = "INSERT INTO Transactions (buyer_id, seller_id, order_id) VALUES ('$username', '$seller_id', '$order_id')";
		$inserted = $connection->query($query_insert);
		if (!$inserted) echo "failed insert to transactions";
	}

	$query6 = "UPDATE Items SET quantity = (quantity-1) WHERE item_id IN (SELECT in_cart FROM Cart WHERE username = '$username')";
	$connection->query($query6);

	$query7 = "DELETE FROM Cart WHERE username = '$username'";
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