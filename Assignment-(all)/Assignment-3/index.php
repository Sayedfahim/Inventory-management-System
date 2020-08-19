<?php  include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ragister_php</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form method="post" action="server.php" >
	<h3>
COMP207 - Register here for a practical slot
</h3>
<h4>
Register only if you know you are doing
</h4>
<ul>
	<li>Please enter all information and select your desired day</li>
	<li>Please check the number of avilable seats before submitting</li>
	<li>Register only to one slot</li>
	<li>Any problem?Write a message to weberb@cse.liv.ac.uk</li>
</ul>
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name" value="">
		
		</div>
		<div class="input-group">
			<label>Firstname</label>
			<input type="text" name="firstname" value="">
		</div>
		<div class="input-group">
			<label>SID</label>
			<input type="text" name="sid" value="">
		</div>
		<div class="input-group">
			<label>Email Address</label>
			<input type="email" name="email" value="">
		</div>

		Select the practical slot:<br/>
  <input type="radio" name="days" value="monday" >Monday 15.00-17.00<br/>
  <input type="radio" name="days" value="tuesday">Tuesday 14.00-16.00<br/>
  <input type="radio" name="days" value="thursday">Thursday 11.00-13.00<br/>
  <input type="radio" name="days" value="friday">Friday 10.00-12.00<br/>
		<div class="input-group">
				<button class="btn" type="submit" name="save" >Register</button>
				<button class="btn" type="reset" name="reset" >Reset</button>
		</div>
	</form>
	
</body>



</html>