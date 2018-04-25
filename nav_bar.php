<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-ice-lolly-tasted"></i>Noshspoon</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<form class="navbar-form navbar-left" role="search" method="POST" action="search.php">
				<div class="input-group">
					<input type="text" class="form-control" id="search" name="search" placeholder="Search">
					<div class="input-group-btn">
						<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<?php if(isset($_SESSION['username'])) { ?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-list"></i> Recipe<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="new_recipe.php"><i class="glyphicon glyphicon-plus-sign"></i> Add New Recipe</a></li>
							<?php if(strcmp($_SESSION['usertype'], 'admin') == 0){ ?>
							<li><a href="drop_recipe.php"><i class="glyphicon glyphicon-remove-sign"></i> Delete Recipe</a></li>
							<?php } ?>
						</ul>
					</li>
				<?php } 
				if(isset($_SESSION['usertype']) && strcmp($_SESSION['usertype'], 'admin') == 0) { ?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-th-large"></i> Item<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="new_item.php"><i class="glyphicon glyphicon-plus-sign"></i> Add New Item</a></li>
							<li><a href="drop_item.php"><i class="glyphicon glyphicon-remove-sign"></i> Delete Item</a></li>
						</ul>
					</li>
				<?php } 
				if(true){ ?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-shopping-cart"></i> Cart<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="cart.php"><i class="glyphicon glyphicon-zoom-in"></i> View Cart</a></li>
							<li><a href="check_out.php"><i class="glyphicon glyphicon-ok-circle"></i> Check Out</a></li>
						</ul>
					</li>
				<?php } ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<?php
						if (isset($_SESSION['username'])){
							$username = $_SESSION['username'];
							printf('<i class="glyphicon glyphicon-user"></i> %s <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<!--<li><a href="my_listings.php">My Listings</a></li>-->
								<li><a href="my_orders.php"><i class="glyphicon glyphicon-list-alt"></i> My Orders</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="log_out.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
								</ul>', $username);
						} else {
							echo 'Account' . ' <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li><a href="" data-toggle="modal" data-target="#login-overlay"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
								<li><a href="" data-toggle="modal" data-target="#login-overlay"><i class="glyphicon glyphicon-new-window"></i> Register</a></li>
								</ul>';
							}
						?>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
