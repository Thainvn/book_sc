<?php 
	 class  Customer{
	 	// variables to connect db
	 	private $conn;

	 	// attibutes
	 	private $id;
	 	private $name;
	 	private $address;
	 	private $city;
	 	private $state;
	 	private $phonenum;
	 	private $country;

	 	// constructor
	 	public function __construct($db){
	 		$this->conn = $db;
	 	}
	 	public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}


		public function getName(){
			return $this->name;
		}
		public function setName($name){
			$this->name = $name;
		}


		public function getAddress(){
			return $this->address;
		}
		public function setAddress($address){
			$this->address = $address;
		}



		public function getCity(){
			return $this->city;
		}
		public function setCity($city){
			$this->city = $city;
		}



		public function getPhonenum(){
			return $this->phonenum;
		}
		public function setPhonenum($phonenum){
			$this->phonenum = $phonenum;
		}



		public function getCountry(){
			return $this->country;
		}
		public function setCountry($country){
			$this->country = $country;
		}



		public function getCustomer($name,$address,$city,$state,$phonenum,$country){

			$query = "SELECT customerid FROM customers WHERE name=:name AND address=:address AND city=:city AND state=:state AND phonenum=:phonenum AND country=:country";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':address',$address);
			$stmt->bindParam(':city',$city);
			$stmt->bindParam(':state',$state);
			$stmt->bindParam(':phonenum',$phonenum);
			$stmt->bindParam(':country',$country);

			$stmt->execute();

			if($stmt->rowCount()>0){
				
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				return $result;

			}
			return false;

		}

		/*public function getCustomer($customerid){

			$query = "SELECT * FROM customers WHERE customerid=:customer ";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':customerid',$customerid);
			

			$stmt->execute();

		}*/

		public function createCustomer($name,$address,$city,$state,$phonenum,$country){
			$query = "INSERT INTO customers SET name=:name , address=:address , city=:city , state=:state , phonenum=:phonenum , country=:country";

			$stmt = $this->conn->prepare($query);

		
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':address',$address);
			$stmt->bindParam(':city',$city);
			$stmt->bindParam(':state',$state);
			$stmt->bindParam(':phonenum',$phonenum);
			$stmt->bindParam(':country',$country);

			$stmt->execute();
			if(!$stmt){
				return false;
			}
			return true;

		}

	 }
 ?>