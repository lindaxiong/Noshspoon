<?php include 'header.php'; ?>

<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<div class="container">
		<div class="row">
			<div class="jumbotron text-center" >
				<h1> Welcome to Noshspoon! <h1>
				<p>Browse recipes & have ingredients and snacks shipped to your door!</p>
				<?php if(!isset($_SESSION['username'])) { ?>
					<p class="lead">Register now for <span class="text-success">FREE</span>!</p>
					<a href = "" class = "btn btn-info">Learn More</a>
				<?php } 
				else{ ?>
					<p clas="lead">Browse the items we have available!</p>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>