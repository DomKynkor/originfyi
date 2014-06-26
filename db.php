<?php
$whitelist = array('127.0.0.1','::1');

if(in_array($_SERVER['REMOTE_ADDR'], $whitelist))
{
   $mysqli = new mysqli("localhost", "root", "", "origin");
} 
else
{
	$mysqli = new mysqli("db533314322.db.1and1.com", "dbo533314322", "S7voPWKXiqxh9rD", "db533314322");
}

if ($mysqli->connect_errno) 
{
 
echo "MySQL Error # ".$mysqli->connect_errno.": ".$mysqli->connect_error;
 
exit;
 
}
?>