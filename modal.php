<div id="login-overlay" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Welcome to Noshspoon!</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-6">
						<div class="well">
							<form method="POST" action="log_in.php">
								<div class="form-group">
									<label for="username" class="control-label">Username</label>
									<input type="text" class="form-control" id="username" name="username" value="" required="" title="Please enter your username">
									<span class="help-block"></span>
								</div>
								<div class="form-group">
									<label for="password" class="control-label">Password</label>
									<input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
									<span class="help-block"></span>
								</div>
								<button type="submit" class="btn btn-success btn-block">Login</button>
							</form>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="well">
							<form method="POST" action="register.php">
								<div class="form-group">
									<label for="name" class="control-label">Full Name</label>
									<input type="text" class="form-control" id="name" name="name" value="" required="" title="Please enter your name">
									<span class="help-block"></span>
								</div>
								<div class="form-group">
									<label for="username" class="control-label">Username</label>
									<input type="text" class="form-control" id="new-username" name="new-username" value="" required="" title="Please create a username">
									<span class="help-block"></span>
								</div>
								<div class="form-group">
									<label for="password" class="control-label">Password</label>
									<input type="password" class="form-control" id="new-password" name="new-password" value="" required="" title="Please create a password">
									<span class="help-block"></span>
								</div>
								<button type="submit" class="btn btn-info btn-block">Register</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
