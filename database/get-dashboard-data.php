<?php 
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM sales ORDER BY id DESC");
$stmt->execute();
$sales_count = count($stmt->fetchAll());

$stmt_prod = $conn->prepare("SELECT * FROM product ORDER BY id DESC");
$stmt_prod->execute();
$product_count = count($stmt_prod->fetchAll());

$data['products'] = $product_count;
$data['sales'] = $sales_count;

echo json_encode($data);