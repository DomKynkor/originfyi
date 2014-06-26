<?php

include ('db.php');

//Create an array of errors
$error = array();

//
//
// Sign up
//
//
if( isset($_COOKIE['user_name']) && isset($_COOKIE['token'])){
	$un=$_COOKIE['user_name'];
	$token=$_COOKIE['token'];
}
$userlogged= $mysqli->query("SELECT * FROM user_login WHERE user_name='$un' AND token='$token'");
$row = $userlogged->fetch_assoc();
/*
mysql_real_escape_string($_POST['login_user_name']);
mysql_real_escape_string($_POST['login_password']);
mysql_real_escape_string($_POST['user_name']);
mysql_real_escape_string($_POST['password']);
mysql_real_escape_string($_POST['password_confirm']);
*/

if(!isset($_COOKIE['user_name']) || !isset($_COOKIE['token'])||$row['user_name']!=$un||$row['token']!=$token)
{
	if(isset($_POST['signup_submitted'])) 
	{
		if( strlen($_POST['user_name']) < 4 || strlen($_POST['user_name']) > 20 ) 
		{
			$error['user_name'] = "Username between 4-20 characters.";
			unset($_POST['user_name']); 
		}
		if( strlen($_POST['password']) < 5 || strlen($_POST['password']) > 20 ) 
		{
			$error['password'] = "Password between 5-20 characters.";
			unset($_POST['password']); 
			unset ($_POST['password_confirm']);
		}
		else{
			if( $_POST["password"] != $_POST['password_confirm'] ) 
			{
				$error['password_confirm'] = 'Your Passwords do not match.';
				unset ($_POST['password_confirm']);
			}
		}
	//If there are no errors
		if(count($error) === 0) 
		{
			$un = $_POST['user_name'];
	 
			// SQL query for returning usernames from the database
			$result = $mysqli->query("SELECT user_name FROM user_login WHERE user_name='$un'");
	 
			// Checking to see if any usernames were returned
			if(mysqli_num_rows( $result ) === 0 ) 
			{
				//username is available
				$salted_pass = $_POST['password'] . 'RJG5GqmP';
	 
				$hash = hash('SHA256', $salted_pass);
	
				//generate token
	 
				$token = hash('SHA256', rand());
	 
				setcookie('user_name', $un, time()+60*60*24*1);
	 
				setcookie('token', $token, time()+60*60*24*1);
			
			
			
				$result = $mysqli->query("INSERT INTO user_login (user_name, user_level, password, token) VALUES ('$un', 0, '$hash', '$token')");
	 
				if( $result === true ) 
				{
	 
				//information has been stored successfully
					header('Location: originTutorial.php');
					exit();
	 
				} 
				else 
				{
				$error['user_name'] = 'There was an error during registration, please try again.';
				}
			}
			else 
			{
				$error['user_name'] = 'Username is already in use.';
				unset($_POST['user_name']); 
			}
		}
	}

//
//
//	Login
//
//
	if(isset($_POST['login_submitted'])) 
	{
		$lun = $_POST['login_user_name'];
	
	//salt n hash
		$lp = $_POST['login_password'];
 	// SQL query for returning usernames from the database
		$salted_pass = $lp.'RJG5GqmP';
	 
		$hash = hash('SHA256', $salted_pass);

	//$userresult = $mysqli->query("SELECT user_name FROM user_login WHERE user_name='$lun'");
	//$passresult = $mysqli->query("SELECT password FROM user_login WHERE password='$lp'");
		$result = $mysqli->query("SELECT user_name, password FROM user_login WHERE user_name='$lun' AND password='$hash'");
	
	
		$row = mysqli_fetch_assoc($result);
	
	
		//var_dump($row);
		//exit;
		if($lun!== $row['user_name'] || $hash!== $row['password'] ) 
		{
			$error['login_user_name'] = "Incorrect User Name or Password";
			unset ($_POST['login_password'],$_POST['login_user_name']);
		}
		if(count($error) === 0) 
		{
			//Login has suceeeded
			
			$salted_pass = $_POST['login_password'] . 'RJG5GqmP';
	 
			$hash = hash('SHA256', $salted_pass);
	
			//generate token
	 
			$token = hash('SHA256', rand());
	 
			setcookie('user_name', $lun, time()+60*60*24*1);
			
			setcookie('token', $token, time()+60*60*24*1);
			
			$userlevel= $mysqli->query("UPDATE $lun SET token='$token'");
			
			header('Location:originUserPage.php');
			exit();
			
		}
	}

}
else
{
	header('Location: originUserPage.php');
}
//
//
//
//
//
 
//If there are no errors
	
 
 
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Origin Registration Page</title>
 <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two|Roboto' rel='stylesheet' type='text/css'>
</head>
 
<body> 
<?php include('templates/header.php');?>
<div class="content">
<div class="loginForm">
<form method="POST">
<label class="loginLabel">User Name: </label><input class="textform" type="text" name="user_name" value="<?php if(isset($_POST['user_name'])) echo $_POST['user_name'] ?>" placeholder="<?php if(isset($error['user_name'])) echo $error['user_name']; ?>" />  <br />
 
<label class="loginLabel">Password: </label><input class="textform" type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" placeholder="<?php if(isset($error['password'])) echo $error['password']; ?>"/><br />
 
<label class="loginLabel" >Confirm Password: </label><input class="textform" type="password" name="password_confirm" value="<?php if(isset($_POST['password_confirm'])) echo $_POST['password_confirm'] ?>" placeholder="<?php if(isset($error['password_confirm'])) echo $error['password_confirm']; ?>"/>  <br /><br />
 
<button class="formSubmit" type="submit" name="signup_submitted" value="Sign Up">Sign Up</button>
</form>
</div>

<!-- -->

<div class="loginForm">
<form method="POST">

<label class="loginLabel">User Name:</label><input class="textform" type="text" name="login_user_name" value="<?php if(isset($_POST['login_user_name'])) echo $_POST['login_user_name'] ?>" placeholder="<?php if(isset($error['login_user_name'])) echo $error['login_user_name']; ?>"/> <br />
 
<label class="loginLabel">Password: </label><input class="textform" type="password" name="login_password" value="<?php if(isset($_POST['login_password'])) echo $_POST['login_password'] ?>" placeholder="<?php if(isset($error['login_user_name'])) echo $error['login_user_name']; ?>"/> <br /><br />
<button class="formSubmit" type="submit" name="login_submitted" value="Sign in">Sign In</button>
</form>
</div>
</div>
<?php include('templates/footer.php');?>
 
    
</body>
 
</html>
