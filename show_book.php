<?php 
	include_once 'book_sc_fns.php';
	include_once 'output_fns.php';
	session_start();

	$isbn = isset($_GET["isbn"]) ? $_GET['isbn'] : "";

	$catname = isset($_GET["catname"]) ? $_GET['catname'] : "";
	

	$stmt = $book->get_books_details($isbn);

	// display header
	do_html_header($stmt['title']);
	
	display_book_details($stmt,$catname);

	$catid = $stmt["catid"];


	// set url for "continue button"
	$target = 'index.php';
	if ($catid) {
		$target = 'show_cat.php?catid='.$catid;
	}

	display_button("show_cart.php?new=".$isbn, "add-to-cart","Add ".$stmt['title']." To My Shopping Cart");
	
	display_button($target,"continute-shopping",'Continue Shopping');


	// display footer
	do_html_footer();
 ?>
