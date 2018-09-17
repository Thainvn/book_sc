<?php 
	class User {
		// variables to connect to db
		private $conn;

		// attitudes
		private $id;
		private $firstname;
		private $lastname;
		private $email;
		private $contact_number;
		private $address;
		private $password;
		private $access_level;
		private $status;
		private $created;

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

		public function getFirstname(){
			return $this->firstname;
		}

		public function setFirstname($firstname){
			$this->firstname = $firstname;
		}


		public function setLastname($lastname){
			$this->lastname = $lastname;
		}
		public function getLastname(){
			return $this->lastname;
		}
		

		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}


		public function getContact(){
			return $this->contact_number;
		}
		public function setContact($contact_number){
			$this->contact_number = $contact_number;
		}


		public function getAddress(){
			return $this->address;
		}
		public function setAddress($address){
			$this->address = $address;
		}

		public function getPassword(){
			return $this->password;
		}
		public function setPassword($password){
			$this->password = $password;
		}


		public function getAccess_level(){
			return $this->access_level;
		}
		public function setAccess_level($access_level){
			$this->access_level = $access_level;
		}
		public function getCreated(){
			return $this->created;
		}
		public function setCreated($created){
			$this->created = $created;
		}


	}
 ?>




