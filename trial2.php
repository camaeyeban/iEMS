<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

if (!$dblink)
	die("no connection");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html lang="en">
	<head>
	
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" href="../icons/icon.png">

		<title>iEMS</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    
	</head>
	<body>
		<?php include("menu.php"); ?>
	</body>
   <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
</html>