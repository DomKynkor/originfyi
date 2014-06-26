<?php
	if(isset($_POST['makeOriginSubmit'])) 
		{
			include('db.php');
			
			//Stores word name
			$name=$_POST["word_name"];
			$name= ucfirst ($name);
			//Stores part of speech
			$pos=$_POST["word_pos"];
			//Stores place of origin
			$poo=$_POST["word_poo"];
			//Stores time of origin
			$too=$_POST["word_too"];
			//Stores description
			$desc=$_POST["word_description"];
			
			$loo=$_POST["word_loo"];
			
			//Error checking
			
			$error = array();
			//If word name is nothing or is over 20 characters
			if(strlen($name) < 1 || strlen($name) > 20 ) 
			{
				$error['word_name'] = "Name between 1-20 characters.";
				unset($name); 
			}
			//If part of speech = none
			if($pos=='none') 
			{
				$error['pos'] = "Part of speech unset.";
				//set drop down to error
			}
			//If place of origin = nothing or is over 40 characters
			if( strlen($poo) < 2 || strlen($poo) > 40 ) 
			{
				$error['word_poo'] = "Place between 2-40 characters.";
				unset($poo); 
			}
			//If Time of origin is nothing or over 20 characters
			if( strlen($too) < 1 || strlen($too) > 20 ) 
			{
				$error['word_too'] = "Time between 1-20 characters.";
				unset($too); 
			}
			//If description is less than 20 or over 2000 characters
			if( strlen($desc) < 1 || strlen($desc) > 2000 ) 
			{
				$error['word_description'] = "Description between 20-2000 characters.";
				unset($desc); 
			}
			//
			if( strlen($loo) < 1 || strlen($loo) > 20 ) 
			{
				$error['word_loo'] = "Location between 1-20 characters.";
				unset($loo); 
			}
			//If author doesn't have cookie info -> go to login page involving MySQL stuff
			$un=$_COOKIE['user_name'];
			$token=$_COOKIE['token'];
			$userlogged= $mysqli->query("SELECT * FROM user_login WHERE user_name='$un' AND token='$token'");
			$row = $userlogged->fetch_assoc();
			if(!isset($_COOKIE['user_name']) || !isset($_COOKIE['token']) || !$row['user_name']=$un || !$row['token']=$token)
			{
				header ('location:originLogin.php');
				exit();
			}
			$availability=0;

			if(count($error) === 0) 
			{
				$userlevel=$row['user_level'];
				
				//MySQL code here to check who the author is and upload the origin
				if($userlevel==2||$userlevel==3)
				{
					$availability=1;
				}
				if($userlevel==1)
				{
					
				}
				else
				{
					header('location:originLogin.php');
				}
				$aname=$row['name'];
				//die ("INSERT INTO origin_list (word_name, word_pos, word_poo, word_too, word_description, word_loo, word_author, word_available) VALUES ('$name','$pos','$poo','$too','$desc','$loo','$aname','$availability')");
				
				$result = $mysqli->query("INSERT INTO origin_list (word_name, word_pos, word_poo, word_too, word_description, word_loo, word_author, word_available) VALUES ('$name','$pos','$poo','$too','$desc','$loo','$aname','$availability')");
				if ($result === true)
				{
					print "<h5>Submit Sucessful</h5>";
					
				}
			}
			
			
			
			
		}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/style.css">
<title>Untitled Document</title>
</head>

<body>
<div class="content">
	
    
    <div id="makeOrigin">
    <h1>Make Origin</h1>
	<form method="POST">
<!--Word Name-->
<label class="loginLabel">Word: </label><input class="textform" type="text" name="word_name" value="<?php if(isset($_POST['word_name'])) echo $_POST['word_name'] ?>" placeholder="<?php if(isset($error['word_name'])) echo $error['word_name']; ?>" />  <br />

<!--Part of speech-->
<label class="loginLabel">Part of Speech:</label>
<select class="textform" name="word_pos">
<option value="none">select</option><!--Error setup as well as default-->
<option value="noun">noun</option>
<option value="pronoun">pronoun</option>
<option value="verb">verb</option>
<option value="adjective">adjective</option>
<option value="preposition">preposition</option>
<option value="article">article</option>
<option value="conjunction">conjunction</option>
<option value="interjection">interjection</option>

</select>

<label class="loginLabel">Place of Origin:</label><input class="textform" type="text" name="word_poo" value="<?php if(isset($_POST['word_poo'])) echo $_POST['word_poo'] ?>" placeholder="<?php if(isset($error['word_poo'])) echo $error['word_poo']; ?>" />

<label class="loginLabel">Time of Origin:</label><input class="textform" type="text" name="word_too" value="<?php if(isset($_POST['word_too'])) echo $_POST['word_too'] ?>" placeholder="<?php if(isset($error['word_too'])) echo $error['word_too']; ?>" />

 <label class="loginLabel">Language:</label><input class="textform" type="text" name="word_loo" value="<?php if(isset($_POST['word_loo'])) echo $_POST['word_loo'] ?>" placeholder="<?php if(isset($error['word_loo'])) echo $error['word_loo']; ?>" /><br /> <br /> <br /> <br /> 
 
 <label class="loginLabel">Description:</label><textarea class="textform" name="word_description" cols="20" rows="5" placeholder="<?php if(isset($error['word_description'])) echo $error['word_description']; ?>"></textarea>
<br /><br /><br /><br /><br />
<button class="formSubmit"type="submit" name="makeOriginSubmit" value="makeOriginSubmit">Submit</button>
</form>


</div>
</div>

</body>
</html>