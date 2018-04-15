<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<div class="container">
		<div id="alert-indicator">
		</div>
		<form id="newItem">
			<fieldset class="form-group">
				<label for="itemName">Item name</label>
				<input class="form-control" id="itemName" name="itemName" type="text"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemPrice">Item price</label>
				<input class="form-control" id="itemPrice" name="itemPrice" type="number"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemPicture">Item picture</label>
				<input class="form-control" id="itemPicture" name="itemPicture" type="text"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemQuantity">Item quantity</label>
				<input class="form-control" id="itemQuantity" name="itemQuantity" type="number"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemType">Item type</label>
				<input class="form-control" id="itemType" name="itemType" type="text"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemDescription">Item description</label>
				<textarea class="form-control" id="itemDescription" name="itemDescription" rows="4"></textarea>
			</fieldset>
			<p><a href="#" onclick="submitForm()" class="btn btn-primary" role="button">Submit</a></p>
		</form>
	</div>
</body>
</html>
