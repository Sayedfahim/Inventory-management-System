<?php
 $data = $_POST;
 $user_id = (int) $data['user_id'];
 $created_at =  $data['f_name'];
 

 try {
     $command = "DELETE FROM sales WHERE id={$user_id}";                    

include('connection.php');
$conn->exec($command);

 echo json_encode([
'success' => true,
'message' => $created_at . '  successfully deleted.'
]);
} catch (PDOException $e){
 echo json_encode([
'success' => false,
'message' => 'Error processing your request!'
]);
}