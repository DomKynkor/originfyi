<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Origin Subscribe</title>
</head>

<body>

	
	<?php
	if(isset($_POST['Subscribe'])) 
	{
		//var_dump($_POST);
		$email=$_POST["email"];
		//var_dump($email);
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
    		include('db.php');
			$result = $mysqli->query("SELECT email FROM mail_list WHERE email='$email'");
		
				if( mysqli_num_rows( $result ) === 0 ) 
				{
					
					$result = $mysqli->query("INSERT INTO mail_list (email) VALUES ('$email')");
	 
					if( $result === true ) 
					{
	 
						//information has been stored successfully
						print "<h6>Email: ($email) has been added</h6>";
	 
					} 
					else 
					{
					$error['user_name'] = 'There was an error during subscription, please try again.';
					}
				}
				else
				{
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
					{
						print "<h6>Email: ($email) has already been added</h6>";
					}
					else
					{
						print "<h6>Email: ($email) is not valid</h6>";
					}
				}
			
		}
		else
		{
			print "<h6>Email: ($email) is not valid</h6>";
		}
	}
	if(isset($_POST['Unsubscribe'])) 
	{
		//var_dump($_POST);
		$email=$_POST["email"];
		//var_dump($email);
		include('db.php');
		{
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
					{
			            $mysqli->query("DELETE FROM mail_list WHERE email='$email'");
						print "<h6>Email: ($email) has been deleted</h6>";
					}
					else
					{
						print "<h6>Email: ($email) is not valid</h6>";
					}
			
		}
	}
	?>
    <div id="subForm">
    <form method="POST">
    	<label>Email:</label><input class="email_input" type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" />
        <button class="subbtn" type="submit" name="Subscribe" value="Subscribe">Subscribe</button>
        <button class="btn" type="submit" name="Unsubscribe" value="Unsubscribe">Unsubscribe</button>
    </form> 
    </div>
</body>
</html>