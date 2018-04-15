<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<div class="container">
		<div id="alert-indicator"></div>
	</div>

	<?php
	require_once 'library.php';
	$connection = new mysqli($hostname, $username, $password, $database);
	if ($connection->error) {
		die($connection->connect_error);
	}
	
	if (isset($_POST['search'])) {   //valid input, perform query
		$search = $connection->real_escape_string($_POST['search']);
		// $query = "SELECT * FROM Items WHERE (item_name LIKE '%$search%' OR description LIKE '%$search%' OR type LIKE '%$search%')";
		$query = "SELECT * FROM Items WHERE (UCASE(item_name) LIKE UCASE('%$search%') 
			OR UCASE(description) LIKE UCASE('%$search%')
			OR UCASE(type) LIKE UCASE('%$search%'))";
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
				<p><a href="#" onclick="addToCart(%d)" class="btn btn-primary" role="button">Add to Cart</a>	&nbsp; <a href="review.php?item_id=%d" class="btn btn-primary" role="button">Reviews</a> &nbsp;  $%.2lf</p>
				</div>
				</div>
				</div>', $row['picture'], $row['item_name'], $row['description'], $row['item_id'], $row['item_id'], $row['price']);
			}
			echo '</div>';
		} else {
			echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>No results found!</div>'; //no result, stay on the search page, echo this
		}
	} else {
		echo '<p>Invalid search field, please try again.</p>';
	}
	mysqli_close($connection);
	?>


</body>
</html>
