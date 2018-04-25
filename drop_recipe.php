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
		$query = "SELECT * FROM Recipe";
		$result = $connection->query($query);
		if (!$result) {
			die($connection->error);
		}
		if ($result->num_rows) { ?>
			<table class="table table-hover">
				<col width="95%">
				<col width="5%">
				<thead><tr><th>Recipe Name</th></tr></thead>
				<tbody>
				<?php $recipes = array();
				while($row = $result->fetch_assoc()){ 
					$recipes[$row['r_id']] = $row['food_name']; ?>
					<tr>
						<td><?php echo $row['food_name'] ?></td>
						<td>
							<button type="button" class="open-deleteRecipe btn btn-danger" data-id=<?php echo $row['r_id'] ?> data-toggle="modal" data-target="#deleteRecipe"><span class="glyphicon glyphicon-remove"></span></button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<div class="modal fade" id="deleteRecipe" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">x</button>
							<h4 class="modal-title">Delete recipe?</h4>
						</div>
						<div class="modal-body">
							<p class="lead" id="desc">Are you sure you want to delete RECIPE?</p>
							<p>Deleting the recipe will also delete the ingredient list associated with the recipe.</p>
						</div>
						<div class="modal-footer">
							<form method="post" action="delete_recipe.php">
								<button type="submit" class="btn btn-danger" name="recipe" id="recipe" value="">Delete</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(document).on("click", ".open-deleteRecipe", function () {
					var recipeId = $(this).data('id');
					$(".modal-footer #recipe").val( recipeId );
					var str = document.getElementById("desc");
					var recipeArr = <?php echo json_encode($recipes); ?>;
					str.innerHTML = "Are you sure you want to delete " + recipeArr[recipeId] + "?";
				});
			</script>
		<?php }
		}
		elseif(isset($_SESSION['username'])){ ?>
			<p class="lead">We're sorry, only administrators of Noshspoon may delete recipes.<br>
				However, anybody is free and encouraged to <a href="add_recipe.php">add new recipes</a> to share with the rest of the world!</p>
		<?php } 
		else{ ?>
			<p class="lead"> Please register or login to be able to access our website and its functionalities! </p>
		<?php } ?>
	</div>
</body>
</html>