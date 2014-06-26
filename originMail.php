<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
	include('db.php');
	$getRec= $mysqli->query("SELECT * FROM mail_list");
	while($row = $getRec->fetch_assoc()) 
	{
		$to =$row['email'];
		$subject = 'Daily Etymology';
		
		ob_start();
		
		include('templates/originGenerateOrigin.php');
		
		$message = ob_get_contents() ;
			
		ob_end_clean();
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= "To: <$to> \r\n";
		$headers .= 'From: Originfyi.com <donotreply@originfyi.com>' . "\r\n";
		
		mail($to, $subject, $message, $headers);
		
		echo "mailed to $to <br/>";
	}



// Mail it

	
?>
</body>
</html>