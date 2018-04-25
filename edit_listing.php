<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<?php
	if (isset($_SESSION['username'])) {
			require_once 'library.php';
			$connection = new mysqli($hostname, $username, $password, $database);
			if ($connection->error) {
					die($connection->connect_error);
			}
			$username = $_SESSION['username'];
			$item_id = $_GET['item_id'];
			$query = "SELECT * FROM v WHERE item_id = '$item_id'";
			$result = $connection->query($query);
			if (!$result) {
					die($connection->error);
			} elseif ($result->num_rows) {
					$row = $result->fetch_assoc();
					printf('
			<div class="container">
				<div id="alert-indicator">
				</div>
				<form id="newItem">
					<fieldset class="form-group">
						<label for="itemName">Item name</label>
						<input class="form-control" id="itemName" name="itemName" type="text" value="%s"></input>
					</fieldset>
					<fieldset class="form-group">
						<label for="itemPrice">Item price</label>
						<input class="form-control" id="itemPrice" name="itemPrice" type="number" value="%.2f"></input>
					</fieldset>
					<fieldset class="form-group">
						<label for="itemPicture">Item picture</label>
						<input class="form-control" id="itemPicture" name="itemPicture" type="text" value="%s"></input>
					</fieldset>
					<fieldset class="form-group">
						<label for="itemQuantity">Item quantity</label>
						<input class="form-control" id="itemQuantity" name="itemQuantity" type="number" value="%d"></input>
					</fieldset>
					<fieldset class="form-group">
						<label for="itemType">Item type</label>
						<input class="form-control" id="itemType" name="itemType" type="text" value="%s"></input>
					</fieldset>
					<fieldset class="form-group">
						<label for="itemDescription">Item description</label>
						<textarea class="form-control" id="itemDescription" name="itemDescription" rows="4">%s</textarea>
					</fieldset>
					<p><a href="#" onclick="editItem(%d)" class="btn btn-primary" role="button">Update Item</a></p><p><a href="#" onclick="deleteItem(%d)" class="btn btn-danger" role="button">Delete Item</a></p>
				</form>
			</div>', $row['item_name'], $row['price'], $row['picture'], $row['quantity'], $row['type'], $row['description'], $row['item_id'], $row['item_id']);
			} else {
					echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>We cannot find the item you are looking for!</div>';
			}
			mysqli_close($connection);
	} else {
			echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You are not logged in!</div>';
	}
	?>
</body>
</html>
