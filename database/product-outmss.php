<?php  session_start();

 $data = $_POST;

 $barcode =  $data['barcode'];
 $product_id = $data['product_name'];
 $price = $data['price'];
 $quantity = $data['quantity'];
 $name = $data['c_name'];
include('connection.php');
 try {
  

  if(!empty($product_id)) {
    $stmt = $conn->prepare("SELECT * FROM product WHERE id = ".$product_id);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $product = $products[0];

    
    $sql = "UPDATE product SET quantity=? WHERE id=?";
    $conn->prepare($sql)->execute([$product['quantity']-$quantity,$product_id]);

    $sql_sale = "INSERT INTO sales (product_id,quantity,price,first_name) VALUES ('".$product_id."','".$quantity."','".$price."','".$name."')";
    $conn->exec($sql_sale);
  }






// $conn->exec($sql_sale);
$response =[
      'success' => true,
      'message' => $quantity . ' product successfully remove from the system.'];
} catch (PDOException $e){
     $response = [
      'success' => false,
      'message' => $e->getMessage()
  ];


}



  



$_SESSION['response'] = $response;


  header('location: ../product-out.php');



?>