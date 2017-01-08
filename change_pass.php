<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("functions.php");
include("config_DB.php");
require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

if (!$dblink)
	die("no connection");
	
chk_active($_SESSION['user_id']);

require_once("calendar/classes/tc_calendar.php");

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

$qry = $dblink->db_qry("SELECT password FROM ems_users WHERE user_id='$_SESSION[user_id]' ");
$result =  $dblink->get_data($qry);

		
$old = md5($_POST['old']);
$new = $_POST['new'];
$confirm = $_POST['confirm'];		

$msg = array();
if(isset($_POST['submit']) && $_POST['submit']=="apply"){

	if($old=="" || $new=="" || $confirm==""){
		$msg[] = "Please fill-out required fields!";
		
	}else{
	
		if($result[0]!=$old){
			$msg[] = "Old password did not match!";
		}
		
		if($new!=$confirm){
			$msg[] = "New password did not match!";
		}
	}

	if(empty($msg)){
	$str = "SELECT COUNT('password') FROM ems_users WHERE user_id='$_SESSION[user_id]' 
				and password='$old' ";
	$qry = $dblink->db_qry($str);
	$data = $dblink->get_data($qry);
		if($data[0]==1){
				$pass = md5($confirm);
				$str = "UPDATE ems_users SET password='$pass' WHERE user_id='$_SESSION[user_id]' ";
				$qry = $dblink->db_qry($str);			
				echo "<script>alert('Password Successfully Changed!'); window.location = 'inbox.php';</script>";
				// header("location: inbox.php");
		}
	}
}			

	


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
<head>

    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
	<script type="text/javascript" src="assets/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
	<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <link href="calendar/calendar.css" rel="stylesheet" type="text/css">
    <link rel='stylesheet' href='cssall.css' type='text/css' />
    <script language="javascript" src="calendar/calendar.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="navigation.js"></script>
    <script type="text/javascript" src="jsFunctions.js"></script>
    <script type="text/javascript" src="validator.js"></script>
    <script type="text/javascript" src="datetime/datetimepicker.js"></script>

<script type="text/javascript">
			var old	= document.getElementById('old');
			if(pass!=old){
				alert("mali");
				return false;
			}
</script>

</head>

<body>
<form name='form_offset' action="<?php $PHP_SELF; ?>" method='POST'>

<div id="container">
<?php include("menu.php"); ?>

	<div class="container">
		<div class="page-header">
			<h4><strong class="formTitle"> Change Password </strong></h4>
		</div>
	</div>	

	<div class="container">
		<div class="row">
			<form role="form">
			  <div class="row">
				<form class="col s12">
					<div class="row">
						<label style="font-size:105%; margin-left:11.8%;"><i class="fa fa-briefcase"></i>  OLD PASSWORD:&nbsp;*&nbsp;</label>
						<input style="margin-left:8%!important;width:40.2%!important;" type="password" class="input_fields1" id="old" name="old" required/> 
					</div>
					<div class="row" style="margin-top:-1%;">
						<label style="font-size:105%; margin-left:11.8%;"><i class="fa fa-briefcase"></i>  NEW PASSWORD:&nbsp;*&nbsp;</label>
						<input style="margin-left:7.9%!important;width:40.2%!important;" type="password" class="input_fields1" name="new" id="new" required/> 
					</div>
					<div class="row"style="margin-top:-1%;">
						<label style="font-size:105%; margin-left:11.8%;"><i class="fa fa-briefcase"></i>  CONFIRM NEW PASSWORD:&nbsp;*&nbsp;</label>
						<input style="margin-left:2.6%!important;width:40.2%!important;" type="password" id="conf" class="input_fields1" name="confirm" required/> 
					</div><br><hr style="margin-left:11%;margin-top:-1%;width:62%;">
				  </div>
				 <div class="disclaimer" style="margin-left:10.8%!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> Fields marked with an asterisk * are required.</div>
					<div class="row" style="margin-top:5%!important;margin-left:0%!important;">
						<input type="submit" class="btn btn-success" id="save" name="submit" value="APPLY"/>		
					</div>
				</form>
			  </div>
			</form>
		</div>
	</div>

	
</div>
<form>
</body>
</html>
