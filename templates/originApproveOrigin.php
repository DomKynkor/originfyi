<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="makeOrigin">
	<h1>Approve Origin</h1>
    <?php
		include ('db.php');
		$getUnavailOrigins= $mysqli->query("SELECT * FROM origin_list WHERE word_available=0");
		
		$count=$getUnavailOrigins->num_rows;
		print "<h4>($count) new entrie(s)</h4>";
	?>
    <?php	
			
		while($row = $getUnavailOrigins->fetch_assoc()) {
			
			$id=$row['origin_id'];
			$name=$row['word_name'];
			$pos=$row['word_pos'];
			$poo=$row['word_poo'];
			$too=$row['word_too'];
			$des=$row['word_description'];
			$loo=$row['word_loo'];
			$author=$row['word_author'];
			$avail=$row['word_available'];
			print ("<h4>$name ($pos) id:($id)</h4>");
			print ("<h4>$loo ($too, $poo)</h4><h4>$des</h4>");
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
				$reject= $mysqli->query("DELETE FROM origin_list WHERE origin_id=$id");
				
			}
				if(isset($_POST["accept$id"])) 
			{
				print("<h4>$id accepted</h4>");
				$accept = $mysqli->query("UPDATE origin_list SET word_available=1 WHERE`origin_id`=$id");
			}
		}
		
	?>
    
</div>
</body>
</html>