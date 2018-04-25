<?php include 'header.php'; ?>

<style>
.wide {
  width:100%;
  height:100%;
  background-image:url('http://www.toyodaya.net/images/photo_e.jpg');
  background-size:cover;
  background-position: center center;
}
</style>
<body>

	<?php include 'nav_bar.php'; ?>
	<?php include 'modal.php'; ?>

	<div class="container">
		<div class="row">
			<div class="wide jumbotron text-center" >
				<font color="white"><h1> Welcome to Noshspoon! </h1>
				<p>Browse recipes & have ingredients and snacks shipped to your door!</p>
				<?php if(!isset($_SESSION['username'])) { ?>
					<p class="lead">Register now for <span class="text-success">FREE</span>!</p></font>
					<a href = "" class = "btn btn-info" data-toggle="modal" data-target="#login-overlay">Login</a>
				<?php } 
				else{ ?>
					<p clas="lead">Browse the items we have available!</p>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>