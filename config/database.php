<?php 
	class Database{
		// variables to connect to db
		private $servername = "localhost";
		private $username = "root";
		private $password = "";
		private $dbname = "booksc";
		private $conn;

		//method to get Conn
		public function getConn(){
			return $this->conn;
		}

		// connect to db
		public function getConnection(){

			$this->conn = null;

			try {
				$this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
				

			} catch (PDOException $e) {
				
				echo "Error : " .$e->getMessage();

			}
		}

	}
 ?>