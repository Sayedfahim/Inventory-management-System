<?php 
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM users ORDER BY id DESC");
$stmt->execute();
$users_count = count($stmt->fetchAll());

$stmt_prod = $conn->prepare("SELECT * FROM supplier ORDER BY id DESC");
$stmt_prod->execute();
$supplier_count = count($stmt_prod->fetchAll());

$data['supplier'] = $supplier_count;
$data['users'] = $users_count;

echo json_encode($data);