<?php 

	include_once 'book_sc_fns.php';
	include_once 'output_fns.php';
	session_start();



	$title = "Book-O-Rama";
	// display header
	do_html_header($title);

	// display content of page
	echo "Please choose a category";

	$stmt = $category->get_categories();
	
	display_category($stmt);

	// display footer
	do_html_footer();
 ?>