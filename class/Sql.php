<?php 
	
	class Sql extends PDO {

		private $conn;

		public function __construct() {
			$this->conn = new PDO("mysql:host=localhost; dbname=dbphp7", "root", "");
		}

		private function setParams($statement, $parameters = array()) {
			foreach ($statement as $key => $value) {
				$this->setParam($key, $value);
			}
		}

		private function setParam($key, $value) {
			$this->bindParam($key, $value);
		}

		public function query($rawQuery, $parameters = array()) {
			$stmt = $this->conn->prepare($rawQuery);
			$this->setParams($stmt);
			$stmt->execute();
			return $stmt;
		}

		public function select($rawQuery, $parameters = array()) {
			$stmt = $this->query($rawQuery);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>