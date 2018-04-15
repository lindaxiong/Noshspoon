function indicate(data) {
	if (data == "success") {
		var div = document.createElement('div');
		div.innerHTML = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Success!</div>';
		document.getElementById('alert-indicator').appendChild(div);
		window.location.href = "my_listings.php";
	} else if (data == "failed") {
		var div = document.createElement('div');
		div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Database error!</div>';
		document.getElementById('alert-indicator').appendChild(div);
	} else if (data == 'not_logged_in') {
		var div = document.createElement('div');
		div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You are not logged in!</div>';
		document.getElementById('alert-indicator').appendChild(div);
	}
}

function editItem(item_id) {
	var input_fields = $('#newItem').serializeArray();
	var ok = true;
	for (var i = 0; i < input_fields.length; i++) {
		if (!input_fields[i].value) {
			ok = false;
			break;
		}
	}
	if (ok) {
		var inputs = $('#newItem').serialize();
		inputs = inputs + '&itemId=' + item_id;
		console.log(inputs);
		$.post('edit_item.php', inputs, function(data) {
			indicate(data);
		});
	} else {
		var div = document.createElement('div');
		div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>All fields must be filled!</div>';
		document.getElementById('alert-indicator').appendChild(div);
	}
}

function deleteItem(item_id) {
	var item = {};
	item['item_id'] = item_id;
	$.post('delete_item.php', item, function(data) {
		indicate(data);
	});
}