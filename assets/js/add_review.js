function addReview(item_id) {
	var input_fields = $('#review-form').serializeArray();
	var ok = true;
	for (var i = 0; i < input_fields.length; i++) {
		if (!input_fields[i].value) {
			ok = false;
			break;
		}
	}
	if (ok) {
		$.post('add_review.php', $('#review-form').serialize() + '&item_id=' + item_id, function(data) {
			if (data == "success") {
				var div = document.createElement('div');
				div.innerHTML = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Successfully added review!</div>';
				document.getElementById('review-alert-indicator').appendChild(div);
				window.location.href = "review.php?item_id=" + item_id;
			} else if (data == "failed") {
				var div = document.createElement('div');
				div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Database error!</div>';
				document.getElementById('review-alert-indicator').appendChild(div);
			} else if (data == 'not_logged_in') {
				var div = document.createElement('div');
				div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You are not logged in!</div>';
				document.getElementById('review-alert-indicator').appendChild(div);
			}
		});
	} else {
		var div = document.createElement('div');
		div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>All fields must be filled!</div>';
		document.getElementById('review-alert-indicator').appendChild(div);
	}
}