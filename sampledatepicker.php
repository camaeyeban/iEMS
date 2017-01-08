<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
	var textbox = document.createElement('input');
	textbox.type = 'date';
	document.getElementById('form1').appendChild(textbox);
</script>
<style type="text/css">
	div { margin-bottom:1em; }
	label { font-family:Arial, Helvetica, sans-serif; }
</style>
</head>

<body>
	<form name="form1" method="post">
        <input type="date" name="date[]" />
        <input type="submit" name="submit" />  
	</form>  
	<?php
	extract($_POST);
	
		if(isset($submit)){
			$length = count($date);
			for ($i = 0; $i < $length; $i++) {
			  print $date[$i].'<br />';
			}
		}
	?>
</body>
</html>