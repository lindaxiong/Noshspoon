<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<div class="container">
		<div id="alert-indicator">
		</div>
		<?php require_once 'library.php';
		date_default_timezone_set('UTC');
		$connection = new mysqli($hostname, $username, $password, $database);
		if ($connection->connect_error) {
			die($connection->connect_error);
		}
		$query = "SELECT * FROM Items";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			printf("Error: %s\n", mysqli_error($connection));
			exit();
		}
		if(isset($_SESSION['username'])){ ?>
		<form id="newRecipe">
			<fieldset class="form-group">
				<label for="recipeName">Recipe Name</label>
				<input class="form-control" id="recipeName" name="recipeName" type="text"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="recipePicture">Recipe Picture (paste image link including html)</label>
				<input class="form-control" id="recipePicture" name="recipePicture" type="text"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="recipeDescription">Recipe Description</label>
				<textarea class="form-control" id="recipeDescription" name="recipeDescription" rows="4"></textarea>
			</fieldset>
			<fieldset class="form-group">
				<h3>Recipe Ingredients (Select all that apply)</h3>
					<?php foreach($result as $row){ ?>
						<input type="checkbox" id="<?php echo $row['item_name'];?>" name="ingredients[]" value="<?php echo $row['item_id'];?>">
						<label for="ingredients[]"><?php echo $row['item_name'];?></label><br>
					<?php }?>
				</select>
			</fieldset>
			<p><a href="#" onclick="submitRecipe()" class="btn btn-primary" role="button">Submit</a></p>
		</form>
		<?php }
		else{ ?>
			<p class="lead"> Please register or login to be able to access our website and its functionalities! </p>
		<?php } ?>
	</div>
</body>
</html>