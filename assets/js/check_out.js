function applyCoupon() {
	var data = {};
	data['coupon_code'] = $('#couponCode').val();
	$.post("check_coupon.php", data, function(data2) {
		if (data2 == 'invalid') {
			var div = document.createElement('div');
			div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Invalid coupon code!</div>';
			document.getElementById('alert-indicator').appendChild(div);
		} else {
			var orig = $('#totalLabel').val();
			orig -= data2;
			$('#totalLabel').val(orig);
			$('#totalLabel').text('Total: $' + orig.toFixed(2));
			var div = document.createElement('div');
			div.innerHTML = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Coupon value $' + data2 + '!</div>';
			document.getElementById('alert-indicator').appendChild(div);
		}
	});
}

function placeOrder() {
	var input_fields = $('#newOrder').serializeArray();
	var addr = document.getElementById('shipAddress');
	//Checks to see if address selected, as coupon should be optional
	if (addr.selectedIndex == 0) {
		var div = document.createElement('div');
		div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>All fields must be filled!</div>';
		document.getElementById('alert-indicator').appendChild(div);
	}
	else {
		$.post('place_order.php', $('#newOrder').serialize(), function(data) {
			console.log(data);
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
	}
}