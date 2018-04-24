<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<div class="container">
		<div id="alert-indicator">
		</div>
		<?php if(isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin'){ ?>
		<form id="newItem">
			<fieldset class="form-group">
				<label for="itemName">Item Name</label>
				<input class="form-control" id="itemName" name="itemName" type="text"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemPrice">Item Price</label>
				<input class="form-control" id="itemPrice" name="itemPrice" type="number"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemPicture">Item Picture (paste image link including html)</label>
				<input class="form-control" id="itemPicture" name="itemPicture" type="text"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemQuantity">Item Quantity</label>
				<input class="form-control" id="itemQuantity" name="itemQuantity" type="number"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemType">Item Type</label>
				<input class="form-control" id="itemType" name="itemType" type="text"></input>
			</fieldset>
			<fieldset class="form-group">
				<label for="itemDescription">Item Description</label>
				<textarea class="form-control" id="itemDescription" name="itemDescription" rows="4"></textarea>
			</fieldset>
			<p><a href="#" onclick="submitForm()" class="btn btn-primary" role="button">Submit</a></p>
		</form>
		<?php }
		elseif(isset($_SESSION['username'])){ ?>
			<p class="lead">We're sorry, only administrators of Noshspoon may add new items.<br>
				<a href="search.php">Browse through items</a> we're currently offering and we'll let you know when we update with new items!</p>
		<?php } 
		else{ ?>
			<p class="lead"> Please register or login to be able to access our website and its functionalities! </p>
		<?php } ?>
	</div>
</body>
</html>
