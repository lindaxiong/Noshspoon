function addToCart(i_id) {
	var data = {};
	data['item_id'] = i_id;
	$.post("to_cart.php", data, function(data2) {
		if (data2 == "success") {
			var div = document.createElement('div');
			div.innerHTML = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Added to cart!</div>';
			document.getElementById('alert-indicator').appendChild(div);
		} else if (data2 == 'failed') {
			var div = document.createElement('div');
			div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You have this item in cart!</div>';
			document.getElementById('alert-indicator').appendChild(div);
		} else if (data2 == 'not_logged_in') {
			var div = document.createElement('div');
			div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You are not logged in!</div>';
			document.getElementById('alert-indicator').appendChild(div);
		}
	});
}

function submitForm() {
	var input_fields = $('#newItem').serializeArray();
	var ok = true;
	for (var i = 0; i < input_fields.length; i++) {
		if (!input_fields[i].value) {
			ok = false;
			break;
		}
	}
	if (ok) {
		$.post('add_item.php', $('#newItem').serialize(), function(data) {
			if (data == "success") {
				var div = document.createElement('div');
				div.innerHTML = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Successfully listed!</div>';
				document.getElementById('alert-indicator').appendChild(div);
				window.location.href = "index.php";
			} else if (data == "failed") {
				var div = document.createElement('div');
				div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Database error!</div>';
				document.getElementById('alert-indicator').appendChild(div);
			} else if (data == 'not_logged_in') {
				var div = document.createElement('div');
				div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You are not logged in!</div>';
				document.getElementById('alert-indicator').appendChild(div);
			}
		});
	} else {
		var div = document.createElement('div');
		div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>All fields must be filled!</div>';
		document.getElementById('alert-indicator').appendChild(div);
	}
}