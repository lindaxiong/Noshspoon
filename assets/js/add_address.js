function addAddress() {
	var input_fields = $('#address-form').serializeArray();
	var ok = true;
	for (var i = 0; i < input_fields.length; i++) {
		if (!input_fields[i].value) {
			ok = false;
			break;
		}
	}
	if (ok) {
		$.post('add_address.php', $('#address-form').serialize(), function(data) {
			if (data == "success") {
				var div = document.createElement('div');
				div.innerHTML = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Successfully added!</div>';
				document.getElementById('address-alert-indicator').appendChild(div);
				window.location.href = "check_out.php";
			} else if (data == "failed") {
				var div = document.createElement('div');
				div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Database error!</div>';
				document.getElementById('address-alert-indicator').appendChild(div);
			} else if (data == 'not_logged_in') {
				var div = document.createElement('div');
				div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You are not logged in!</div>';
				document.getElementById('address-alert-indicator').appendChild(div);
			}
		});
	} else {
		var div = document.createElement('div');
		div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>All fields must be filled!</div>';
		document.getElementById('address-alert-indicator').appendChild(div);
	}
}