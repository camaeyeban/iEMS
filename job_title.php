<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();

	if (!$dblink)
		die("no connection");

	include("functions.php");
	chk_active($_SESSION['user_id']);

	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}

	if($_SESSION['rights']!=1){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
	}


	$qry = $dblink->db_qry("SELECT job_title_name, job_title_desc, job_title_comm FROM ems_jobtitle WHERE job_title_code='$_GET[ID]' ");
	$result = $dblink->get_data($qry);

	$name = $_POST['title_name'];
	$desc = $_POST['desc'];
	$comm = $_POST['comments'];

	if(isset($_POST['submit']) && $_POST['submit']=="save"){
		$strqry = "INSERT INTO ems_jobtitle (job_title_name, job_title_desc, job_title_comm )
		VALUES('$name','$desc','$comm')";
		$qry = $dblink->db_qry($strqry);
		header("location:view_job.php#jobtitle");
	}elseif(isset($_POST['submit']) && $_POST['submit']=="update"){
		$qry = $dblink->db_qry("UPDATE ems_jobtitle SET job_title_name='$name', job_title_desc='$desc', job_title_comm='$comm' WHERE job_title_code='$_GET[ID]' ");
		header("location:view_job.php#job-title");

	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
	<link href="css/home-format.css" rel="stylesheet">
	<link rel='stylesheet' href='cssall.css' type='text/css' />
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
	<link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
   
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>
   
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
    
	<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="icon" href="icons/iEMS2.png">
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="navigation.js"></script>
	<script type="text/javascript" src="jsFunctions.js"></script>
</head>

	<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

		<?php include("menu.php"); ?>

		<form name="form_title" action="<?php $PHP_SELF;?>" method="POST">
			<div id="container">
				<div class="container">
					<div class="page-header">
						<h4><strong class="blue-text text-darken-2"> JOB: New Job Title </strong></h4>
					</div>
				</div>
	<div class="container">
	<div class="row">
			<div class="row">
					<div class="row">
						<label style="font-size:90%; margin-left:11.8%;"><i class="fa fa-briefcase"></i>  JOB TITLE NAME:&nbsp;*&nbsp;</label>
						<input style="width:50%!important;text-align:left!important;" type="text" class="input_fields1" name="title_name" value="<?php echo $result[0]; ?>" required/> 
					</div>
					<div class="row">
						  <div class="row">
							<div class="input-field col s12" style="margin-left:11.5%!important;margin-top:2%!important;">
							  <textarea style="width:62.5%!important;"placeholder="Enter Job Description" id="textarea1" class="materialize-textarea" name="desc"/><?php echo $result[1];?></textarea>
							  <label class="text" for="textarea1"><i class="fa fa-pencil"></i>  JOB DESCRIPTION </label>
							</div>
						  </div>
					  </div>
					<div class="row">
						  <div class="row">
							<div class="input-field col s12" style="margin-left:10.9%!important;margin-top:-1%!important;">
							  <textarea placeholder="What's on your mind?" id="textarea1" class="materialize-textarea" name="comments"/><?php echo $result[2]; ?></textarea>
							  <label class="text" for="textarea1"><i class="fa fa-pencil"></i>  JOB TITLE COMMENTS</label>
							</div>
						  </div>
						  <div class="disclaimer" style="margin-left:11%!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> Fields marked with an asterisk * are required.</div>
					</div>
					<div class="row" style="margin-top:5%!important;margin-left:0.6%!important;">
						<?php
							if(isset($_GET['ID'])){
                              echo 	'<input type="submit" class="btn btn-primary" id="save" name="submit" value="update"  onclick="return validate();"/>';				
							}else{
								echo '<input type="submit" class="btn btn-primary" id="save" name="submit" value="save"  onclick="return validate();"/>';
							}
						?><input style="margin-left:1%!important;" type="button" class="btn btn-primary" value="BACK" onclick="window.location = 'view_job.php';" />
					</div>
			</div>
	</div>
</div>
</div>
</form>
		<?php include("footer.php"); ?>
</body>
</html>
