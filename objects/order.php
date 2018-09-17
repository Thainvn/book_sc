<?php 
	class 	Order{

		// variables to connect to db
		private $conn;
		// attibutes
		private $orderId;
		private $customerId;
		private $amount;
		private $created;
		private $order_status;
		private $ship_name;
		private $ship_address;
		private $ship_city;
		private $ship_state;
		private $ship_zip;
		private $ship_country;

		// constructor
		public function __construct($db){
			$this->conn = $db;
		}

		public function getOrderId(){
			return $this->orderId;
		}
		public function setOrderId($orderId){
			 $this->orderId = $orderId;
		}


		public function getCustomerId(){
			return $this->customerId;
		}
		public function setCustomerId($customerId){
			 $this->customerId = $customerId;
		}


		public function getAmount(){
			return $this->amount;
		}
		public function setAmount($amount){
			 $this->amount = $amount;
		}


		public function getCreated(){
			return $this->created;
		}
		public function setCreated($created){
			 $this->created = $created;
		}


		public function getOrder_status(){
			return $this->order_status;
		}
		public function setOrder_status($order_status){
			 $this->order_status = $order_status;
		}


		public function getShip_name(){
			return $this->ship_name;
		}
		public function setShip_name($ship_name){
			 $this->ship_name = $ship_name;
		}


		public function getShip_address(){
			return $this->ship_address;
		}
		public function setShip_address($ship_address){
			 $this->ship_address = $ship_address;
		}


		public function getShip_city(){
			return $this->ship_city;
		}
		public function setShip_city($ship_city){
			 $this->ship_city = $ship_city;
		}


		public function getShip_state(){
			return $this->ship_state;
		}
		public function setShip_state($ship_state){
			 $this->ship_state = $ship_state;
		}
		public function getShip_zip(){
			return $this->ship_zip;
		}
		public function setShip_zip($ship_zip){
			 $this->ship_zip = $ship_zip;
		}


		public function getShip_country(){
			return $this->ship_country;
		}
		public function setShip_country($ship_country){
			 $this->ship_country = $ship_country;
		}


		public function createOrder($customerid,$amount,$order_status,$ship_name,$ship_address,$ship_city,$ship_state,$phonenum,$ship_country){


			$query = "INSERT INTO orders SET customerid=:customerid,amount=:amount ,created=:created, order_status=:order_status , ship_name=:ship_name , ship_address=:ship_address , ship_city=:ship_city , ship_state=:ship_state ,phonenum=:phonenum , ship_country=:ship_country";

			$stmt = $this->conn->prepare($query);

			$timestamp = date("Y-m-d");

			$stmt->bindParam(':customerid',$customerid);
			$stmt->bindParam(':amount',$amount);
			$stmt->bindParam(':created',$timestamp);

			$stmt->bindParam(':order_status',$order_status);
			$stmt->bindParam(':ship_name',$ship_name);
			$stmt->bindParam(':ship_address',$ship_address);
			$stmt->bindParam(':ship_city',$ship_city);
			$stmt->bindParam(':ship_state',$ship_state);
			$stmt->bindParam(':phonenum',$phonenum);
			$stmt->bindParam(':ship_country',$ship_country);

			$stmt->execute();
			if($stmt){
				return true;
			}
			return false;

		}


		public function getOrder($customerid,$amount,$order_status,$ship_name,$ship_address,$ship_city,$ship_state,$phonenum,$ship_country){

			$query = "SELECT orderid FROM orders WHERE
			 customerid=:customerid AND 
			amount > (:amount-.001) AND
			amount < (:amount+.001) AND   
			 order_status=:order_status AND 
			 ship_name=:ship_name AND 
			 ship_address=:ship_address AND 
			 ship_city=:ship_city AND 
			 ship_state=:ship_state AND 
			 phonenum=:phonenum AND 
			 ship_country=:ship_country";


			$stmt = $this->conn->prepare($query);

			
			$stmt->bindParam(':customerid',$customerid);
			$stmt->bindParam(':amount',$amount);
			$stmt->bindParam(':order_status',$order_status);
			$stmt->bindParam(':ship_name',$ship_name);
			$stmt->bindParam(':ship_address',$ship_address);
			$stmt->bindParam(':ship_city',$ship_city);
			$stmt->bindParam(':ship_state',$ship_state);
			$stmt->bindParam(':phonenum',$phonenum);
			$stmt->bindParam(':ship_country',$ship_country);

			$stmt->execute();

			
			if($stmt->rowCount()>0){
				
				$result = $stmt->fetch(PDO::FETCH_ASSOC);

				return $result;

			}
			return false;

		}
	}
 ?>