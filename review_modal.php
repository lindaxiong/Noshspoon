<div id="review-overlay" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Write review</h4>
			</div>
			<div class="modal-body">
				<div id="review-alert-indicator">
				</div>
				<div class="row">
					<div class="well">
						<form id="review-form">
							<div class="form-group">
								<label for="title" class="control-label">Title</label>
								<input type="text" class="form-control" id="title" name="title">
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label for="score" class="control-label">Score</label>
								<select name="score" id="score" class="form-control">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label for="content" class="control-label">Review</label>
								<textarea name="content" id="content" rows="5" class="form-control"></textarea>
								<span class="help-block"></span>
							</div>
							<p>
								<?php
								printf('
								<a href="#" onclick="addReview(%d)" class="btn btn-success btn-block">Submit Review</a>
								', $_GET['item_id']);
								?>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
