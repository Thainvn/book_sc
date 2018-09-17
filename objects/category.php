<?php 
	class Category{
		// variables to connect to db
		private $conn;
		// attibutes
		private $id;
		private $catname;

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


		public function getCatname(){
			return $this->catname;
		}
		public function setCatname($catname){
			$this->catname = $catname;
		}

		public function  get_categories(){

			 //select all data
	        $query = "SELECT id,catname FROM categories ORDER BY catname";  
	 
	        $stmt = $this->conn->prepare( $query );
	        $stmt->execute();        

			if($stmt){

				return $stmt;
			}
			
			return false;

		}



	}

 ?>