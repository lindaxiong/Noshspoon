<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Noshspoon</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<form class="navbar-form navbar-left" role="search" method="POST" action="search.php">
				<div class="input-group">
					<input type="text" class="form-control" id="search" name="search" placeholder="Search">
					<div class="input-group-btn">
						<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="new_item.php">Post Item for Sale</a></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cart<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="cart.php">View Cart</a></li>
						<li><a href="check_out.php">Check Out</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<?php
						if (isset($_SESSION['username'])){
							$username = $_SESSION['username'];
							printf('%s <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li><a href="my_listings.php">My Listings</a></li>
								<li><a href="my_orders.php">My Orders</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="log_out.php">Logout</a></li>
								</ul>', $username);
						} else {
							echo 'Account' . ' <span class="caret"></span></a>
								<ul class="dropdown-menu">
								<li><a href="" data-toggle="modal" data-target="#login-overlay">Login</a></li>
								<li><a href="" data-toggle="modal" data-target="#login-overlay">Register</a></li>
								</ul>';
							}
						?>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
