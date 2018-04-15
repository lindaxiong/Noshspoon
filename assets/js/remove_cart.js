function removeFromCart(i_id) {
	var data = {};
	data['item_id'] = i_id;
	$.post("remove_cart.php", data, function(data2) {
		if (data2 == "success") {
			var div = document.createElement('div');
			div.innerHTML = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Removed from cart!</div>';
			document.getElementById('alert-indicator').appendChild(div);
			var removeDiv = document.getElementById("cart_" + i_id);
			removeDiv.parentNode.removeChild(removeDiv);
		} else {
			var div = document.createElement('div');
			div.innerHTML = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Failed to remove!</div>';
			document.getElementById('alert-indicator').appendChild(div);
		}
	});
}
