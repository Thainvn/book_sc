<?php 
	
	class Book{
		// variables to connect db
		private $conn;

		// attitudes
		private $isbn;
		private $author;
		private $title;
		private $catid;
		private $catname;
		private $price;
		private $description;

		// constructor
		public function __construct($db){
			$this->conn = $db;
		}


		// method get,set
		public function getIsbn(){
			return $this->isbn;
		}
		public function setIsbn($isbn){
			$this->isbn = $isbn;
		}

		public function getAuthor(){
			return $this->author;
		}
		public function setAuthor($author){
			$this->author = $author;
		}


		public function getTitle(){
			return $this->title;
		}
		public function setTitle($title){
			$this->title = $title;
		}


		public function getCatid(){
			return $this->catid;
		}
		public function setCatid($catid){
			$this->catid = $catid;
		}


		public function getCatname(){
			return $this->catname;
		}
		public function setCatname($catname){
			$this->catname =  $catname;
		}


		public function getPrice(){
			return $this->price;
		}
		public function setPrice($price){
			$this->price = $price;
		}


		public function getDescription(){
			return $this->description;
		}
		public function setDescription($description){
			$this->description = $description;
		}

		public function get_books($catid){
			
			$query = "SELECT * FROM books LEFT JOIN categories ON (catid =:catid) =categories.id";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':catid',$catid);

		 	$stmt->execute();
				
			if(!$stmt){
				return false;
			}
		
			return $stmt;
		}

		public function get_books_details($isbn){
			
			$query = "SELECT * FROM books WHERE isbn =:isbn";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':isbn',$isbn);

			$stmt->execute();

			if(!$stmt){
				return false;
			}
			if($stmt->rowCount()==0){
				return false;
			}
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}



	}	
 ?>