<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<?php
	if(isset($_SESSION['username'])) {
		require_once 'library.php';
		$connection = new mysqli($hostname, $username, $password, $database);
		if ($connection->error) {
			die($connection->connect_error);  
		}
		$username = $_SESSION['username'];
		$query = "SELECT * FROM Items WHERE item_id IN (SELECT in_stock FROM Stock WHERE username = '$username')";
		$result = $connection->query($query);
		if (!$result) {
			die($connection->error);
		} elseif ($result->num_rows) {
			echo '<div class="container">';
			while ($row = $result->fetch_assoc()) {
				printf('
				<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
				<img src="%s" alt="...">
				<div class="caption">
				<h3>%s</h3>
				<p>%s</p>
				<p><a href="edit_listing.php?item_id=%d" class="btn btn-primary" role="button">Manage</a></p>
				</div>
				</div>
				</div>', $row['picture'], $row['item_name'], $row['description'], $row['item_id']);
			}
			echo '</div>';
		} else {
			echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Sorry, you do not have any listed items!</div>'; //no result, stay on the search page, echo this
		}
		mysqli_close($connection);
	} else {
		echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You are not logged in!</div>';
	}
	?>

</body>
</html>
