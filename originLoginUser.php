<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>

<body>
<?php

$mysqli = new mysqli("localhost", "root", "", "origin");

if ($mysqli->connect_errno) {
 
echo "MySQL Error # ".$mysqli->connect_errno.": ".$mysqli->connect_error;
 
exit;
 
}
$error = array();
 
if(isset($_POST['submitted'])) {
 
if( strlen($_POST['login_user_name']) < 4 || strlen($_POST['login_user_name']) > 20 ) {
$error['login_user_name'] = "Incorrect User Name";
}
 
if( strlen($_POST['login_password']) < 5 || strlen($_POST['login_password']) > 20 ) {
 
$error['login_password'] = "Incorrect Password";
 
}
}
?>

<div id="Signin">

<form method="post">
<label>User Name: </label><input type="text" name="login_user_name" value="<?php if(isset($_POST['login_user_name'])) echo $_POST['login_user_name'] ?>" />  <?php if(isset($error['login_user_name'])) echo $error['login_user_name']; ?><br />
 
<label>__Password: </label><input type="password" name="login_password" value="<?php if(isset($_POST['login_password'])) echo $_POST['login_password'] ?>" /> <?php if(isset($error['login_password'])) echo $error['login_password']; ?><br />

<input type="submit" name="submitted" value="Sign In" />
</form>
</div>
</body>
</html>