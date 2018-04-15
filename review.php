<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>
	<?php include 'review_modal.php'; ?>

	<?php
	require_once 'library.php';
	$connection = new mysqli($hostname, $username, $password, $database);
	if ($connection->error) {
		die($connection->connect_error);
	}
	$item_id = $_GET['item_id'];
	$no_review = true;
	$avg = 0;

	$query = "SELECT COUNT(*) as cnt FROM Reviews WHERE item_id = '$item_id'";
	$result = $connection->query($query);
	if (!$result) {
		die($connection->error);
	} else {
		if ($result->num_rows) {
			$row = $result->fetch_assoc();
			if ($row['cnt'] > 0) {
				$no_review = false;
				$query = "SELECT AVG(score) as avg FROM Reviews WHERE item_id = '$item_id'";
				$result = $connection->query($query);
				if (!$result) {
					die($connection->error);
				} else {
					if ($result->num_rows) {
						$no_review = false;
						$row = $result->fetch_assoc();
						$avg = $row['avg'];
					}
				}
			}
		}
	}

	echo '<div class="panel panel-info">
	<div class="panel-heading">Reviews</div>
	<div class="panel-body">
	<p>
	<a href="" data-toggle="modal" data-target="#review-overlay" class="btn btn-primary">Write a review</a> &nbsp; ';
	if ($no_review) {
		echo 'No reviews for this item yet.';
	} else {
		printf('%.2f/5.00', $avg);
	}
	echo '</p></div></div>';

	if (!$no_review) {
		$query = "SELECT * FROM Reviews WHERE item_id = '$item_id'";
		$result = $connection->query($query);
		if (!$result) {
			die($connection->error);
		} else {
			if ($result->num_rows) {
				while ($row = $result->fetch_assoc()) {
					printf('<div class="media">
					<div class="media-body">
					<h4 class="media-heading"><b>%s</b> &nbsp; <i>%d stars by %s</i></h4>
					%s
					</div>
					</div>', $row['title'], $row['score'], $row['username'], $row['content']);
				}
			}
		}
	}

	mysqli_close($connection);
	?>

</body>
</html>
