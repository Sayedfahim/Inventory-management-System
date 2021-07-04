<?php

    session_start();
    if(isset($_SESSION['user'])) header('location: index.php');

    $error_message='';
   if ($_POST) {
   	include('database/connection.php');

   	$Username=$_POST['Username'];
   	$password=$_POST['password'];
   
   $query ='SELECT * FROM users WHERE users.email="' . $Username .'"';
   $stmt = $conn->prepare($query);
   $stmt->execute();
   
   if($stmt->rowCount() > 0){
   	$stmt->setFetchMode(PDO::FETCH_ASSOC);
   	$user = $stmt->fetchAll()[0];

    $hash = $user['password'];
    if (password_verify($password, $hash)) {
     	$_SESSION['user'] =$user;
     	header('Location: dashboard.php');
    } else {
      $error_message='Please Make Sure That Username And Password are correct.';
    }
   } else $error_message='No user found';
   	
   }

?>


<!DOCTYPE html>
<html>
<head>
	<title>SMS Login - Stock Management System</title>
	<link rel="stylesheet" type="text/css" href="css/login.css?v=<?php echo time(); ?>">
</head>
<body id="loginBody">
  <?php if(!empty($error_message)) { ?>
  	<div id="errorMessage">
		<strong>Error:</strong>  </p><?=$error_message ?> </p>
	</div>
   <?php } ?>
<div class="container">
	<div class="loginHeader">
            <h1><a href="index.php">SMS</a></h1>
            
            <p>Member LogIn</p>
	</div>
	<div class="loginBody">
		<form action="login.php" method="POST">
			<div class="loginInputsContainer">
				<label for="">Email</label>
				<input placeholder="Email" name= "Username"  type="text" />
			</div>
			<div class="loginInputsContainer">
				<label for="">Password</label>
				<input placeholder="Password" name= "password"  type="password" />
			</div>
			<div class="loginButtonContainer">
				<button>login</button>
			</div>
		</form>
	</div>
</div>
</body>
</html>