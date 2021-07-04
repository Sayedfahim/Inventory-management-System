<?php
$servername = 'localhost';
$Username = 'root';
$password = '';


// connecting to database
try {
	$conn = new PDO("mysql:host=$servername;dbname=inventory", $Username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch (\Exception $e) {
	$error_message = $e->getMessage();
}


?>