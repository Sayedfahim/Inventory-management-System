<?php 
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM supplier ORDER BY id DESC");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();