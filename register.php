<?php
  session_start();
  if(isset($_SESSION['user'])) header('location: index.php');
  $error_message='';

  if ($_POST) {
    include('database/connection.php');

    $table_name = 'users';
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypted = password_hash($password, PASSWORD_DEFAULT);

    include('database/connection.php');

    try {
      $command = "INSERT INTO
      $table_name(first_name,last_name,email,password,created_at,updated_at)
      VALUES 
      ('".$first_name."','".$last_name."','".$email."','".$encrypted."',NOW(),NOW())";

      $conn->exec($command);
      
      header('location: login.php');

    } catch (PDOException $e){
      $response = [
        'success' => false,
        'message' => $e->getMessage()
      ];
      
      $_SESSION['response'] = $response;
    }

  }
?>


<!DOCTYPE html>
<html>
<head>
	<title>SMS Register - Stock Management System</title>
	<link rel="stylesheet" type="text/css" href="css/login.css?v=<?php echo time(); ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body id="loginBody2">
  <?php if(!empty($error_message)) { ?>
  	<div id="errorMessage">
		<strong>Error:</strong>  </p><?=$error_message ?> </p>
	</div>
   <?php } ?>
<div class="container">
	<div class="loginHeader">
            <h1><a href="index.php">SMS</a></h1>
            <p>Member registration</p>
	</div>
	<div class="loginBody2">
		<form action="register.php" method="POST" class="text-left">
			<div class="form-groupmb-2">
        <label for="first_name" class="text-light">First Name</label>
        <input placeholder="First Name" type="text"  class="form-control"  id="first_name" name="first_name"/>
      </div>
      <div class="form-groupmb-2">
        <label class="text-light" for="last_name">Last Name</label>
        <input placeholder="Last Name" type="text" class="form-control" id="last_name" name="last_name" />
      </div>
      <div class="form-groupmb-2">
        <label class="text-light" for="email">Email</label>
        <input placeholder="Email" type="text" class="form-control" id="email" name="email"/>
      </div>
      <div class="form-groupmb-2">
        <label class="text-light" for="password">Password</label>
        <input placeholder="Password" type="password" class="form-control"  id="password" name="password" />
      </div>
			<div class="loginButtonContainer">
				<button type="submit" class="btn btn-success">Register</button>
			</div>
		</form>

	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>