<?php
 $data = $_POST;
 $user_id = (int) $data['userId'];
 $barcode =  $data['f_name'];
 $product_name = $data['l_name'];
 $price = $data['price'];
 $quantity = $data['quantity'];

 try {
                        
$sql = "UPDATE product SET quantity=?, price=?, barcode=?, product_name=? WHERE id=?";
include('connection.php');
$conn->prepare($sql)->execute([$quantity,$price, $barcode, $product_name,$user_id]);

 echo json_encode([
'success' => true,
'message' => $quantity . ' ' . $product_name . ' successfully updated.'
]);
} catch (PDOException $e){
 echo json_encode([
'success' => false,
'message' => 'Error processing your request!'
]);
}