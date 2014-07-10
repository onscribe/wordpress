
// Namespaces:
// - settings page: body.settings_page_onscribe-admin

var $ = $ || jQuery;

// variables
var onscribe = {
	dev: (window.location.hostname == "localhost"),
	products: null
}

$(document).ready(function(){

	// Settings

	// add action
	$("body.settings_page_onscribe-admin form").submit(function(e){
		e.preventDefault();
		var $form = $(this);
		// make sure fields are filled
		var key = $form.find("#onscribe_key").val();
		var secret = $form.find("#onscribe_secret").val();
		// stop if no new data is submitted
		if( key == "" && secret == "" ) return document.createElement('form').submit.call( $form[0] );
		// get product details
		var host = (onscribe.dev) ? "localhost" : "onscri.be";
		$.getJSON("//"+ host +"/api/product/info/"+ key, function( result ){
			if( $.isEmptyObject(result) ) return alert("The product you entered wasn't recognized");
			// update data
			$form.find("#onscribe_title").val( result.title );
			// all good...
			// using vanilla js submit
			// fix: http://stackoverflow.com/questions/833032/submit-is-not-a-function-in-javascript#comment23038712_834197
			document.createElement('form').submit.call( $form[0] );
		});
		// stop form submission (temporarily)
		return false;
	});

	// delete action
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
			onscribe.products = onscribe.products.filter(function(){return true;}); // reset index
			$(e.target).closest("tr").remove();
		}
		//
		// update products list
		$("input#onscribe_products").val( JSON.stringify(onscribe.products) );
	});

});