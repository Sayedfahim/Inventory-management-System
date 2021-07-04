<?php 
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM product ORDER BY id DESC");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();