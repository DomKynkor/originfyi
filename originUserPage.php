<?php
	include('db.php');
	$un=$_COOKIE['user_name'];
	$token=$_COOKIE['token'];
	$userlogged= $mysqli->query("SELECT * FROM user_login WHERE user_name='$un' AND token='$token'");
	$row = $userlogged->fetch_assoc();
	if(!isset($_COOKIE['user_name']) || !isset($_COOKIE['token']))
	{
		if($row['user_name']!=$un||$row['token']!=$token)
		{
			header ('location:originLogin.php');
			exit();
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Origin User</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>

<body>
	<?php 
		include('templates/header.php');
		$un=$_COOKIE['user_name'];
		
		$userlevel= $mysqli->query("SELECT user_level FROM user_login WHERE user_name='$un'");
		$row = $userlevel->fetch_assoc();
		if ($row['user_level']==='0')
		{
			include('templates/originAuthorAccessRequest.php');
		}
		if ($row['user_level']==='1'||$row['user_level']==='2'||$row['user_level']==='2')
		{
			include('templates/originMakeOrigin.php');
		}
		if ($row['user_level']==='2')
		{
			include('templates/originApproveOrigin.php');
			include('templates/originApproveAuthor.php');
		}
	
	?>  
    <div id='loggedIn'>
	<?php 
			if(isset($un))
			{
				print "<h4>You are logged in as: ($un)</h4>";
			}
	?>
    </div>
    <?php
			//include('templates/footer.php');
	?>
    
</body>
</html>