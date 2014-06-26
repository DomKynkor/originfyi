<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div class="content">
<form method="POST">
    	<label id="label">Name:</label><br/><input class="arname" type="text" name="arname" value="<?php if(isset($_POST['arname'])) echo $_POST['arname'] ?>" />
  		<br/><label id="label">Reason for becoming author:</label><br/><textarea name="arreason" cols="80" rows="10" class="arreason"><?php if(isset($_POST['arreason'])) echo $_POST['arreason'] ?></textarea>
    <br/><button class="arbtn" type="submit" name="Submit" value="Submit">Submit</button>
        
</form> 
<?php
	if(isset($_POST['Submit'])) 
		{
			//Stores IRL name
			$name=$_POST["arname"];
			//Stores Author Reason for being an author
			$reason=$_POST["arreason"];
			//get username from token
			$username=$_COOKIE['user_name'];
			
    		include('db.php');
			$result = $mysqli->query("UPDATE user_login SET name='$name', author_reason='$reason' WHERE user_name='$username'");
			if ($result === true)
			{
				print '<h5>Author Request Sucessful. Please wait for approval.</h5>';
			}
		}
			
?>
</div>

</body>
</html>