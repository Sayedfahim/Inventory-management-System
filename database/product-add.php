<?php session_start(); 

$table_name = $_SESSION['table'];

$barcode = $_POST['barcode'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$product_image = $_POST['product_image'];
$description = $_POST['description'];


include('connection.php');

try {
     $command = "INSERT INTO
                    $table_name(barcode,product_name,price,quantity,product_image,description)
                    VALUES 
                     ('".$barcode."','".$product_name."','".$price."','".$quantity."','".$product_image."','".$description."')";
                     


$conn->exec($command);
$response =[
      'success' => true,
      'message' => $quantity . ' ' . $product_name . '  successfully added to the system.'];
} catch (PDOException $e){
     $response = [
      'success' => false,
      'message' => $e->getMessage()
  ];
}



$_SESSION['response'] = $response;



header('location: ../product-in.php');

?>