<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("functions.php");
require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

if (!$dblink)
	die("no connection");

	

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

if($_SESSION['rights']!=1){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
}

if(isset($_GET['ID'])){
		$qry = $dblink->db_qry("SELECT code, name FROM ems_emp_status WHERE code='$_GET[ID]' ");
		$result = $dblink->get_data($qry);
}else{

		$qry = $dblink->db_qry("SELECT MAX(code) FROM ems_emp_status");
		$data = $dblink->get_data($qry);

		if($data[0]==null){
			$code = "EST001";
		}else{
			$est = substr($data[0],0,3);
			$num = intval(substr($data[0], strpos($data[0],'T')+1, strlen($data[0])));
			$no = $num+1;
			if(strlen($num)==1){
				$code = $est . "00" . $no;
			}
		}	
}

$name = $_POST['name'];

if(isset($_POST['submit']) && $_POST['submit']=="save"){
         $strqry = "INSERT INTO ems_emp_status (code, name)
         VALUES('$code','$name')";
         $qry = $dblink->db_qry($strqry);
		header("location:view_job.php#employment-status");

}elseif(isset($_POST['submit']) && $_POST['submit']=="update"){
		$qry = $dblink->db_qry("UPDATE ems_emp_status SET name='$name' WHERE code='$_GET[ID]' ");
		header("location:view_job.php#employment-status");		
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
<head>
	<link rel='stylesheet' href='cssall.css' type='text/css' />
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
	<link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
   <link href="css/home-format.css" rel="stylesheet">
		
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>
   
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
    
	<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="icon" href="../images/iEMS2.png">
	<script type="text/javascript" src="jquery.js">
	</script>
	<script type="text/javascript" src="navigation.js"></script>
	<script type="text/javascript" src="jsFunctions.js"></script>
</head>

<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
	<?php include("menu.php"); ?>

	<form name='form_jobspecs' action="<?php $PHP_SELF;?>" method='POST'>
<div id="container">
 
	<div class="container">
		<div class="page-header" style="width:735px!important;">
			<h4><strong class="blue-text text-darken-2"> JOB: Employement Status </strong></h4>
		</div>
	</div>
 
	<div class="container">
		<div class="row">
        <form role="form">	
			<div class="row">
				<form class="col s12">
					<div class="row">
						<label style="font-size:13px; margin-left:140px;"><i class="fa fa-barcode"></i>  &nbsp;CODE:&nbsp;&nbsp;</label>
						<label style="color:black;font-weight:800;font-size:13px; margin-left:10px;"><?php echo $msg = ($code) ? $code: $result[0];?></label>
					</div>
					<div class="row">
						<label style="font-size:13px; margin-left:140px;"><i class="fa fa-user"></i>  NAME:&nbsp;*&nbsp;</label>
						<input style="width:380px!important;text-align:left!important;" type="text" class="input_fields1" name="name" value="<?php echo $result[1];?>" required/> 
					</div><br>
					<div class="row">	<hr style="width:740px;margin-left:133px;margin-top:-10px;"> </div>
					<div class="row">	<div class="disclaimer" style="margin-left:130px!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> Fields marked with an asterisk * are required.</div>
					
					<div class="row" style="margin-top:60px!important;margin-left:6px!important;">
						<?php
							if(isset($_GET['ID'])){
                              echo 	'<input type="submit" class="btn btn-primary btn-sm" id="save" name="submit" value="update"  onclick="return validate();"/>';				
							}else{
								echo '<input type="submit" class="btn btn-primary btn-sm" id="save" name="submit" value="save"  onclick="return validate();"/>';
							}
						?><input style="margin-left:10px!important;" type="button" class="btn btn-primary btn-sm" value="BACK" onclick="window.location = 'view_job.php#employment-status';" />
					</div>
				</form>
			</div>
		</form>
		</div>
	</div>
</div>
</form>
		<?php include("footer.php"); ?>
			
</body>
</html>
