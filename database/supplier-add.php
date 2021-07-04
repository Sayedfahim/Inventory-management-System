<?php session_start(); 

$table_name = $_SESSION['table'];

$company_name = $_POST['company_name'];
$barcode = $_POST['barcode'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];



include('connection.php');

try {
     $command = "INSERT INTO
                    $table_name(company_name,barcode,product_name,product_price)
                    VALUES 
                     ('".$company_name."','".$barcode."','".$product_name."','".$product_price."')";
                     


$conn->exec($command);
$response =[
      'success' => true,
      'message' =>  $product_name . '  successfully added to the system.'];
} catch (PDOException $e){
     $response = [
      'success' => false,
      'message' => $e->getMessage()
  ];
}



$_SESSION['response'] = $response;



header('location: ../supplier.php');

?>