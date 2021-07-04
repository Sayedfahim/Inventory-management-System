<?php
 $data = $_POST;
 $user_id = (int) $data['userId'];
 $company_name =  $data['f_name'];
 $product_name = $data['l_name'];
 $barcode = $data['barcode'];
 $product_price = $data['product_price'];
 

 try {
                        
$sql = "UPDATE supplier SET  product_name=?, company_name=?, barcode=?,product_price=? WHERE id=?";
include('connection.php');
$conn->prepare($sql)->execute([$product_name, $company_name, $barcode,$product_price,$user_id]);

 echo json_encode([
'success' => true,
'message' => $product_name . ' successfully updated.'
]);
} catch (PDOException $e){
 echo json_encode([
'success' => false,
'message' => 'Error processing your request!'
]);
}