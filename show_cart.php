<?php 

	include_once 'book_sc_fns.php';
	include_once 'output_fns.php';
	session_start();

	// get the isbn from book detail
	$new = isset($_GET['new']) ? $_GET['new'] :"";

	//Adding Items to the Cart
	if($new) {

		//new item selected
		if(!isset($_SESSION['cart'])) {

				$_SESSION['cart'] = array();
				$_SESSION['items'] = 0;
				$_SESSION['total_price'] ='0.00';
		}
		// Check items is exist or not 
		if(isset($_SESSION['cart'][$new])) {

			$_SESSION['cart'][$new]++;

		} else {

			$_SESSION['cart'][$new] = 1;

		}

		// Cauculate quanity and price
		$_SESSION['total_price'] = calculate_price($_SESSION['cart']);
		$_SESSION['items'] = calculate_items($_SESSION['cart']);

	}

		// If save button is clicked
		if(isset($_POST['save'])) {
			
					
				
				foreach ($_SESSION['cart'] as $isbn => $qty) {

					if($_POST['num'] == '0') {

						unset($_SESSION['cart'][$isbn]);

					} else {

						$_SESSION['cart'][$isbn] = $_POST['num'];
					}
				}

				$_SESSION['total_price'] = calculate_price($_SESSION['cart']);
				$_SESSION['items'] = calculate_items($_SESSION['cart']);
			
		}	


			// header
			do_html_header("Your shopping cart");

			
			if(!empty($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {

				display_cart($_SESSION['cart']);

			} else {

				echo "<p>There are no items in your cart</p><hr/>";
			}



			$target = "index.php";


			// if we have just added an item to the cart, continue shopping in that category

			if($new) {

				$details = $book->get_books_details($new);

				if($details['catid']) {

					$target = "show_cat.php?catid=".$details['catid'];

				}
			}



		display_button($target, "continue-shopping", "Continue Shopping");
		// use this if SSL is set up
		// $path = $_SERVER['PHP_SELF'];
		// $server = $_SERVER['SERVER_NAME'];
		// $path = str_replace('show_cart.php', '', $path);
		// display_button("https://".$server.$path."checkout.php",
		// "go-to-checkout", "Go To Checkout");
		// if no SSL use below code
		display_button("checkout.php", "go-to-checkout", "Go To Checkout");


		// footer
		do_html_footer();
 ?>