<?php 
	
	include_once 'book_sc_fns.php';
	include_once 'output_fns.php';
	session_start();

	$catid = isset($_GET["catid"]) ? $_GET['catid'] : "";

	$title = "Book-O-Rama";
	// display header
	do_html_header($title);

	
	// get the book info out from db
	$stmt = $book->get_books($catid);

	display_books($stmt);

	// display footer
	do_html_footer();
 ?>