<?php 
	require_once "config/database.php";
	require_once "objects/book.php";
	require_once "objects/category.php";
	require_once "objects/user.php";
	require_once "objects/customer.php";
	require_once "objects/order.php";
	require_once "objects/orderItem.php";


	$db = new Database();
	$db->getConnection();
	
	$user = new User($db->getConn());
	$book = new Book($db->getConn());
	$category = new Category($db->getConn());
	$customer = new Customer($db->getConn());
	$orderitem = new OrderItem($db->getConn());
	$order = new Order($db->getConn());

	function calculate_price($cart){
		$total_price = 0;

		if(!is_array($cart)){
			return 0;
		}

		foreach ($cart as $isbn => $quanity) {

			$stmt =  $GLOBALS['book']->get_books_details($isbn);
			$total_price += $stmt['price'] * $quanity;
		}
		return $total_price;
	}

	function calculate_items($cart){

		$items = 0;

		if(!is_array($cart)){
			return 0;
		}
		
		foreach ($cart as $isbn => $quanity) {
			$items += $quanity;
		}
		return $items;
	}

	// Xu ly thanh toan
	function process_card($card_details) {

		// connect to payment gateway or
		// use gpg to encrypt and mail or
		// store in DB if you really want to
		return true;
	}

	function insert_order($order_detail){

		// extract order_details out as variables
		extract($order_detail);

		if(!$ship_name && !$ship_address && !$ship_city && !$ship_province && !$ship_phonenum && !$ship_country){

			$ship_name = $name;
			$ship_address = $address;
			$ship_city = $city;
			$ship_phonenum = $phonenum;
			$ship_province = $province;
			$ship_country = $country;
		}


		// customer table to get customerid
		$customerid = '';
		$customer = $GLOBALS['customer']->getCustomer($name,$address,$city,$province,$phonenum,$country);


		if($customer){
			
			$customerid = $customer['customerid'];

		}else{
			$GLOBALS['customer']->createCustomer($name,$address,$city,$province,$phonenum,$country);
		}


		// order table to get orderid
		$GLOBALS['order']->createOrder($customerid,$_SESSION['total_price'], 'PARTIAL',$ship_name,$ship_address,$ship_city,$ship_province,$ship_phonenum,$ship_country);

		$orderid = "";


		$order = $GLOBALS['order']->getOrder($customerid,$_SESSION['total_price'], 'PARTIAL',$ship_name,$ship_address,$ship_city,$ship_province,$phonenum,$ship_country);
	
		$orderid = $order['orderid'];

	

		// order_item table
		foreach ($_SESSION['cart'] as $isbn => $quanity) {

			$detail =  $GLOBALS['book']->get_books_details($isbn);

			$GLOBALS['orderitem']->deleteOrderItem($orderid,$isbn);
			$GLOBALS['orderitem']->createOrderItem($orderid,$isbn,$detail['price'],$quanity);

			var_dump($GLOBALS['orderitem']);

		}
		return $orderid;
	}


	function calculate_shipping_cost(){
		return 20;
	}

	
 ?>