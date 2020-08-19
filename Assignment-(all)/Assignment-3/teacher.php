<?php  
include('server.php');

?>
<html>
 <head>
 	<title>Ragister_php</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<table>
 	<thead>
		<tr>
			<th>Name</th>
            <th>Firstname</th>
             <th>SID</th>
             <th>Email</th>
            <th>Slot</th>
		</tr>
	</thead>
<?php
 while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['sid']; ?></td>
           <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['days']; ?></td>
	</tr>
    <?php } ?>
</table>

    </body>
    </html>