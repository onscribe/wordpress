
// Namespaces:
// - settings page: body.settings_page_onscribe-admin

var $ = $ || jQuery;

// variables
var onscribe = {
	products: null
}

$(document).ready(function(){

	$("body.settings_page_onscribe-admin .products-list .delete a").click(function(e){
		e.preventDefault();
		// get the products
		if( onscribe.products == null ){
			// parse products
			var products = $("input#onscribe_products").val();
			onscribe.products = JSON.parse( products );
		}
		// find the one we want to delete
		var key = $(e.target).attr("data-key");
		for( var i in onscribe.products ){
			var product = onscribe.products[i];
			if( product && product["key"] !== key ) continue;
			delete onscribe.products[i];
			onscribe.products = onscribe.products.filter(function(){return true;});
			$(e.target).closest("tr").remove();
		}
		//
		// update products list
		$("input#onscribe_products").val( JSON.stringify(onscribe.products) );
	});

});