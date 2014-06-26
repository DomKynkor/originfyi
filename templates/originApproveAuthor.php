<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="makeOrigin">
	<h1>Approve Author</h1>
    <?php
		include ('db.php');
		$getUsers= $mysqli->query("SELECT * FROM user_login WHERE user_level=0 AND author_reason!=''");
		
		$count=$getUsers->num_rows;
		print "<h4>($count) new author(s)</h4>";
	?>
    <?php	
			
		while($row = $getUsers->fetch_assoc()) {
			
			$id=$row['user_id'];
			$un=$row['user_name'];
			$name=$row['name'];
			$reason=$row['author_reason'];
			
		
			print ("<h4>$un id:($id)</h4>");
			print ("<h4>$name</h4><h4>$reason</h4>");
			//create a approve and reject button
			print ("
			<form method='POST'> 
			<button class='accept' type='submit' name='accept$id' value='accept$id'>Accept</button>
			</form>
			<form method='POST'>
			<button class='reject' type='submit' name='reject$id' value='reject$id'>Reject</button>
			</form>
			");
			if(isset($_POST["reject$id"])) 
			{
				print("<h4>$id rejected</h4>");
				$reject= $mysqli->query("DELETE FROM user_login WHERE user_id=$id");
				
			}
				if(isset($_POST["accept$id"])) 
			{
				print("<h4>$id accepted</h4>");
				$accept = $mysqli->query("UPDATE user_login SET user_level=1 WHERE`user_id`=$id");
			}
		}
		
	?>
</div>
</body>
</html>