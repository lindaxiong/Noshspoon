<div id="address-overlay" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Add address</h4>
			</div>
			<div class="modal-body">
				<div id="address-alert-indicator">
				</div>
				<div class="row">
					<div class="well">
						<form id="address-form">
							<div class="form-group">
								<label for="recipient" class="control-label">Recipient Name</label>
								<input type="text" class="form-control" id="recipient" name="recipient">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label for="street" class="control-label">Street</label>
								<input type="text" class="form-control" id="street" name="street">
								<span class="help-block"></span>
							</div>
							<div class="form-inline">
								<label for="city" class="control-label">City</label>
								<input type="text" class="form-control" id="city" name="city">
								<label for="state" class="control-label">State</label>
								<input type="text" class="form-control" id="state" name="state">
								<label for="zip" class="control-label">Zip</label>
								<input type="number" class="form-control" id="zip" name="zip">
								<span class="help-block"></span>
							</div>
							<p>
								<a href="#" onclick="addAddress()" class="btn btn-success btn-block">Add</a>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
