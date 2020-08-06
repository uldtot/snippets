// Websitecare.io <support@websitecare.io>
// Fix for prices not showing correct old price in price html if variable product.
// Know issues: If the price is "From: xxx", then it wont write that.
add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
function wpa83367_price_html( $price, $product ){

	if ($product->is_type( 'simple' )) {
		return $price;
	}

      if($product->product_type=='variable' && $product->is_on_sale() ) {

	      $available_variations = $product->get_available_variations();
	    	$count = count($available_variations)-1;
	      $variation_id=$available_variations[$count]['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.
	      $variable_product1= new WC_Product_Variation( $variation_id );
	      $regular_price = $variable_product1 ->regular_price;
	      $sales_price = $variable_product1 ->sale_price;


		$output = "
		<del>
			<span class=\"woocommerce-Price-amount amount\">".wc_price($regular_price)."
			</span>
		</del>
		<ins>
			<span class=\"woocommerce-Price-amount amount\">".wc_price($product->get_price())."
			</span>
		</ins>
		";

		return $output;

}

	return $price;

}
