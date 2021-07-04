<?php 
	include('connection.php');

	

	function loadAuthors() {
		$db = new DbConnect;
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT * FROM product");
		$stmt->execute();
		$product = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $product;
	}

 ?>