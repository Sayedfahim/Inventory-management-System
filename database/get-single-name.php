<?php 
include('connection.php');

// $stmt = $conn->prepare("SELECT * FROM product ORDER BY id DESC");
// $stmt->execute();
// // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
// $result = $stmt->fetchAll();

// // var_dump($result);

// echo json_encode($result);


if(isset($_POST['prod_id'])) {
	$stmt = $conn->prepare("SELECT * FROM users WHERE id = " . $_POST['prod_id']);
	$stmt->execute();
	$customer = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($customer);
}