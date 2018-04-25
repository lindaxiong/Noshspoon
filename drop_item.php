<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<div class="container">
		<div id="alert-indicator">
		</div>
		<?php 
		require_once 'library.php';
		$connection = new mysqli($hostname, $username, $password, $database);
		if ($connection->error) {
			die($connection->connect_error);
		}

		if(isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin'){ 
		$query = "SELECT * FROM v";
		$result = $connection->query($query);
		if (!$result) {
			die($connection->error);
		}
		if ($result->num_rows) { ?>
			<table class="table table-hover">
				<col width="95%">
				<col width="5%">
				<thead><tr><th>Item Name</th></tr></thead>
				<tbody>
				<?php $items = array();
				while($row = $result->fetch_assoc()){ 
					$items[$row['item_id']] = $row['item_name']; ?>
					<tr>
						<td><?php echo $row['item_name'] ?></td>
						<td>
							<button type="button" class="open-deleteItem btn btn-danger" data-id=<?php echo $row['item_id'] ?> data-toggle="modal" data-target="#deleteItem"><span class="glyphicon glyphicon-remove"></span></button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<div class="modal fade" id="deleteItem" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">x</button>
							<h4 class="modal-title">Delete item?</h4>
						</div>
						<div class="modal-body">
							<p class="lead" id="desc">Are you sure you want to delete ITEM?</p>
							<p>Deleting the item will also delete any carts, reviews, and recipe ingredients associated with the item.</p>
						</div>
						<div class="modal-footer">
							<form method="post" action="delete_item.php">
								<button type="submit" class="btn btn-danger" name="item" id="item" value="">Delete</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(document).on("click", ".open-deleteItem", function () {
					var itemId = $(this).data('id');
					$(".modal-footer #item").val( itemId );
					var str = document.getElementById("desc");
					var itemArr = <?php echo json_encode($items); ?>;
					str.innerHTML = "Are you sure you want to delete " + itemArr[itemId] + "?";
				});
			</script>
		<?php }
		}
		elseif(isset($_SESSION['username'])){ ?>
			<p class="lead">We're sorry, only administrators of Noshspoon may delete items.<br>
				Your carts will be updated if an item is deleted but it won't affect previous orders if you've already ordered the item!</p>
		<?php } 
		else{ ?>
			<p class="lead"> Please register or login to be able to access our website and its functionalities! </p>
		<?php } ?>
	</div>
</body>
</html>