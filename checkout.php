<?php 
	include_once 'book_sc_fns.php';
	include_once 'output_fns.php';
	session_start(); 

	//header
	do_html_header("Checkout");

	if(!empty($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {

		display_cart($_SESSION['cart'], false, 0);
		display_checkout_form();
		
	} else {

		echo "<p>There are no items in your cart</p>";
	}

		display_button("show_cart.php", "continue-shopping", "Continue Shopping");

	// footer
	do_html_footer();

 ?>