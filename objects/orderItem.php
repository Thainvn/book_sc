<?php 
	class OrderItem{
		// variables to connect to db
		private $conn;

		// attibutes
		private $orderid ;
		private $isbn;
		private $item_price;
		private $quantity;

		// constructor
		public function __construct($db){
			$this->conn = $db;
		}

		public function getOrderId(){
			return $this->orderid;
		}
		public function setId($orderid){
			 $this->orderid = $orderid;
		}

		public function getIsbn(){
			return $this->isbn;
		}
		public function setIsbn($isbn){
			 $this->isbn = $isbn;
		}


		public function getItem_price(){
			return $this->item_price;
		}
		public function setItem_price($item_price){
			 $this->item_price = $item_price;
		}


		public function getQuantity(){
			return $this->quantity;
		}
		public function setQuantity($quantity){
			 $this->quantity = $quantity;
		}

		// create new order item
		public function createOrderItem($orderid,$isbn,$item_price,$quanity){

			var_dump($orderid);

			$query = "INSERT INTO order_items SET  orderid=:orderid ,isbn=:isbn ,item_price=:item_price, quanity=:quanity ";

			$stmt = $this->conn->prepare($query);

			

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

		// delete a Order Item
		public function deleteOrderItem($orderid,$isbn){
			$query = "DELETE orderitems WHERE orderid=:orderid AND isbn=:isbn";

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':orderid',$orderid);
			$stmt->bindParam(':isbn',$isbn);
			

			$stmt->execute();

			if($stmt){
				return true;
			}
			return false;
		}



	} 
?>