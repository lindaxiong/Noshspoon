<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<div class="container">
		<div id="alert-indicator"></div>
	</div>

	<?php
	require_once 'library.php';
		if (isset($_SESSION['username'])) {
			echo '</div>';
			$queryname = $_SESSION['username'];
		$connection = new mysqli($hostname, $username, $password, $database);
		if ($connection->error) {
			die($connection->connect_error);
		}
		$query = "SELECT * FROM Cart JOIN Items ON Cart.in_cart = Items.item_id where username = '$queryname'";
		$result = $connection->query($query);
		if (!$result) {
			die($connection->error);
		} elseif ($result->num_rows) {
			echo '<div class="container">';
			while ($row = $result->fetch_assoc()) {
				printf('
						<div class="col-sm-6 col-md-4" id="cart_%d">
						<div class="thumbnail">
						<img src="%s" alt="...">
						<div class="caption">
						<h3>%s</h3>
						<p>%s</p>
						<p><a href="#" onclick="removeFromCart(%d)" class="btn btn-danger" role="button">Remove from Cart</a>  $%.2f</p>
						</div>
						</div>
						</div>', $row['item_id'], $row['picture'], $row['item_name'], $row['description'], $row['item_id'], $row['price']);
			}
			echo '</div>';
		} else {
			echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Your cart is empty!</div>'; //no result, stay on the search page, echo this
		}
		mysqli_close($connection);
		} else {
			echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You are not logged in!</div></div>';
		}
	?>

</body>
</html>
