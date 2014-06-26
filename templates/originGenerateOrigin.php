<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
		
        <?php
		
			/*
			$entry= $mysqli->query("SELECT * FROM origin_list WHERE word_available=1 AND origin_id>= RAND() * (SELECT MAX(origin_id) FROM origin_list) LIMIT 1");
			$row = $entry->fetch_assoc();
			while(is_null($row)===true)
			{
			$newentry= $mysqli->query("SELECT * FROM origin_list WHERE word_available=1 AND origin_id>= RAND() * (SELECT MAX(origin_id) FROM origin_list) LIMIT 1");
			$row = $newentry->fetch_assoc();
			}
			*/
			
			$entry= $mysqli->query("SELECT * FROM origin_list WHERE word_available=1 ORDER BY RAND() LIMIT 0,1");
			$row = $entry->fetch_assoc();
			
			$id=$row['origin_id'];
			$name=$row['word_name'];
			$pos=$row['word_pos'];
			$poo=$row['word_poo'];
			$too=$row['word_too'];
			$des=$row['word_description'];
			$loo=$row['word_loo'];
			$author=$row['word_author'];
			$avail=$row['word_available'];
			print ("<h2>$name ($pos)</h2><h6></h6>");
			print ("<h4>$loo ($too, $poo)</h4><h4>$des</h4>");
		
		?>

</html>