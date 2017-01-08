<?php
	$conn = mysql_connect('localhost','root','');	
	$db = mysql_select_db('datess', $conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<title>Display test page</title>
    </head>
    <body>
    	<?php
			$query = "SELECT id, date FROM test ORDER BY id ASC";
			$result = mysql_query($query);
			$rs = mysql_num_rows($result)

			while ($row = mysql_fetch_array($rs)){
				echo $row['date'];
				echo "<br />";
			}
		?>
    </body>
</html>