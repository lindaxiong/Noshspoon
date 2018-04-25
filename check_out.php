<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>
	<?php include 'address_modal.php'; ?>

	<div class="container">
		<div id="alert-indicator"></div>
	</div>

	<?php
	require_once 'library.php';
	if (isset($_SESSION['username'])) {
		$queryname = $_SESSION['username'];
		$connection = new mysqli($hostname, $username, $password, $database);
		if ($connection->error) {
			die($connection->connect_error);
		}
		$query = "SELECT * FROM Cart JOIN Items ON (Cart.in_cart = Items.item_id) where username = '$queryname'";
		$result = $connection->query($query);
		if (!$result) {
			die($connection->error);
		} elseif ($result->num_rows) {
			echo '
			<div class="container">
			<div class="panel panel-primary">
			<!-- Default panel contents -->
			<div class="panel-heading">Preparing your order</div>
			<div class="panel-body">
			<p>Standard shipping takes 5-7 business days.</p>
			</div>
			<ul class="list-group">';

			$sum = 0;
			while ($row = $result->fetch_assoc()) {
				$sum = $sum + $row['price'];
				printf(
				'<li class="list-group-item">%s @ %.2f</li>
				', $row['item_name'], $row['price']);
			}

			printf('<li class="list-group-item" id="totalLabel" value="%.2f">Total: $%.2f</li>', $sum, $sum);

			echo '
			</ul>
			<form id="newOrder">
			<div class="form-inline">
			<input type="text" class="form-control" id="couponCode" name="couponCode"placeholder="Coupon Code">
			<a href="#" onclick="applyCoupon()" class="btn btn-primary" role="button">Apply</a>
			</div>
			<div class="form-inline">
			<label>Ship to: </label>
			<select class="form-control" id="shipAddress" name="shipAddress">
			<option value="-1">------</option>';

			$address_query = "SELECT * FROM Addresses WHERE username = '$queryname'";
			$address_query2 = "SELECT address_id FROM Addresses WHERE username='$queryname'";
			$address_result = $connection->query($address_query);
			if(!$address_result) {
				die($connection->error);
			} elseif ($address_result->num_rows) {
				while($row = $address_result->fetch_assoc()) {
					printf('<option value="%d">%s, %s, %s, %s, %d</option>', $row['address_id'], $row['recipient'], $row['street'], $row['city'], $row['state'], $row['zip']);
				}
			}

			echo'
			</select>
			<a href="" data-toggle="modal" data-target="#address-overlay" class="btn btn-primary">Add Address</a>
			</div>
			<a href="" onclick="placeOrder()" class="btn btn-success" role="button">Place Order</a>
			</form>
			</div>
			</div>
			';
		} else {
			echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Your cart is empty!</div>';
		}
		mysqli_close($connection);
	} else {
		echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You are not logged in!</div></div>';
	}

	?>


</body>
</html>
