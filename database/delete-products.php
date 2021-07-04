<?php
 $data = $_POST;
 $user_id = (int) $data['user_id'];
 $quantity =  $data['f_name'];
 $product_name = $data['l_name'];

 try {
     $command = "DELETE FROM product WHERE id={$user_id}";                    

include('connection.php');
$conn->exec($command);

 echo json_encode([
'success' => true,
'message' => $quantity . ' ' . $product_name . ' successfully deleted.'
]);
} catch (PDOException $e){
 echo json_encode([
'success' => false,
'message' => 'Error processing your request!'
]);
}