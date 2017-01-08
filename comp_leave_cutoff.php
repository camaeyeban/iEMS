<?php
//TL-2012/03/29 - Added comp_leave_cutoff.php
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
	
if(!isset($_SESSION['username'])){
	header("location: login.php");
}
require_once("calendar/classes/tc_calendar.php");


//JD-2014/02/22 - Get cutoff Date start value from setting before updating to latest value
$sql = "SELECT value FROM ems_settings WHERE settingName='leaveCutOffStart'";
$result = mysql_query($sql);
while($row=mysql_fetch_array($result)){
    $startDate = $row[0];
}

//JD-2014/02/22 - Get cutoff Date end value from setting before updating to latest value
$sql1 = "SELECT value FROM ems_settings WHERE settingName='leaveCutOffEnd'";
$result1 = mysql_query($sql1);
while($row1=mysql_fetch_array($result1)){
    $endDate = $row1[0];
}


$cmd = "SELECT value FROM ems_settings
			WHERE settingName='leaveCutOffStart' ";
$qry = $dblink->db_qry($cmd);
$start_date = $dblink->get_data($qry);

$cmd = "SELECT value FROM ems_settings
			WHERE settingName='leaveCutOffEnd' ";
$qry = $dblink->db_qry($cmd);
$end_date = $dblink->get_data($qry);

$cutoff_from = isset($_REQUEST["from"]) ? $_REQUEST["from"] : "";
$cutoff_to = isset($_REQUEST["to"]) ? $_REQUEST["to"] : "";

// if(isset($_POST['submit']) && $_POST['submit']=="save"){	
// 	if($start_date[0]==""){
//         $strqry = "INSERT INTO ems_settings(settingName,value,createBy,createDate,updateBy,updateDate) 
// 			VALUES('leaveCutOffStart','$cutoff_from','".$_SESSION['username']."',NOW(),'".$_SESSION['username']."',NOW())";
//         $qry = $dblink->db_qry($strqry);
// 	}else{
// 		$strqry = "UPDATE ems_settings SET value='$cutoff_from', updateBy='".$_SESSION['username']."', 
// 				updateDate=NOW() WHERE settingName='leaveCutOffStart' ";
//         $qry = $dblink->db_qry($strqry);
// 	}
// 		$cmd = $dblink->db_qry("SELECT value FROM ems_settings WHERE settingName='leaveCutOffStart' ");
// 		$start_date = $dblink->get_data($cmd);
	
// 	if($end_date[0]==""){
// 		$strqry = "INSERT INTO ems_settings(settingName,value,createBy,createDate,updateBy,updateDate) 
// 			VALUES('leaveCutOffEnd','$cutoff_to','".$_SESSION['username']."',NOW(),'".$_SESSION['username']."',NOW())";
//         $qry = $dblink->db_qry($strqry);
// 	}else{
// 		$strqry = "UPDATE ems_settings SET value='$cutoff_to', updateBy='".$_SESSION['username']."', 
// 			updateDate=NOW() WHERE settingName='leaveCutOffEnd' ";
//         $qry = $dblink->db_qry($strqry);
// 	}
// 		$cmd = $dblink->db_qry("SELECT value FROM ems_settings WHERE settingName='leaveCutOffEnd' ");
// 		$end_date = $dblink->get_data($cmd);
		
// 	$msg = "Leave Cut-off successfully saved!";
// }

//JD-2014/02/22 - Revised Logic to automatically insert or update ems_benefits table when changing cut off dates.
if(isset($_POST['submit']) && $_POST['submit']=="save"){
	if($start_date[0]==""){
        $strqry = "INSERT INTO ems_settings(settingName,value,createBy,createDate,updateBy,updateDate) 
			VALUES('leaveCutOffStart','$cutoff_from','".$_SESSION['username']."',NOW(),'".$_SESSION['username']."',NOW())";
        $qry = $dblink->db_qry($strqry);
	}else{
		$strqry = "UPDATE ems_settings SET value='$cutoff_from', updateBy='".$_SESSION['username']."', 
				updateDate=NOW() WHERE settingName='leaveCutOffStart' ";
        $qry = $dblink->db_qry($strqry);
	}

	$cmd = $dblink->db_qry("SELECT value FROM ems_settings WHERE settingName='leaveCutOffStart' ");
	$start_date = $dblink->get_data($cmd);
	
	if($end_date[0]==""){
		$strqry = "INSERT INTO ems_settings(settingName,value,createBy,createDate,updateBy,updateDate) 
			VALUES('leaveCutOffEnd','$cutoff_to','".$_SESSION['username']."',NOW(),'".$_SESSION['username']."',NOW())";
        $qry = $dblink->db_qry($strqry);
	}else{
		$strqry = "UPDATE ems_settings SET value='$cutoff_to', updateBy='".$_SESSION['username']."', 
			updateDate=NOW() WHERE settingName='leaveCutOffEnd' ";
        $qry = $dblink->db_qry($strqry);
	}

	$cmd = $dblink->db_qry("SELECT value FROM ems_settings WHERE settingName='leaveCutOffEnd' ");
	$end_date = $dblink->get_data($cmd);

	$cmd = "SELECT emp_num from ems_employee where emp_num not in (SELECT emp_num from ems_benefits) and emp_num != '1'";
	$get = mysql_query($cmd);
	
	$sql = "SELECT max(ben_id) from ems_benefits";
	$ret = mysql_query($sql);
	
	$cnt = mysql_fetch_array($ret);
	$cnt = $cnt[0] + 1;
	
	while($row = mysql_fetch_array($get))
	{
		$cmd = "INSERT INTO ems_benefits values(" . $cnt++. ",'" . $row[0] . "','0','0')";
		$qry = $dblink->db_qry($cmd);
	}
	
	$cmd = "UPDATE ems_benefits SET vl_balance = 0, sl_balance = 0";
	$qry = $dblink->db_qry($cmd);

	$msg = "Leave Cut-off successfully saved!";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>iEMS</title>
    <link href="css/home-format.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="validator.js"></script>

		<link rel='stylesheet' href='cssall.css' type='text/css' />
		<script type="text/javascript" src="jquery.js"></script>

		<!--/TL-2012/03/29 - Added for Calendar -->
		<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
		<script language="javascript" src="calendar/calendar.js"></script>

		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>

		<script type="text/javascript">

		function validate2(){
				var date = document.form_comp_info.date1.value;
				
				if(date=="0000-00-00"){
					alert("Please select start date for cut-off.");
					return false;								
				}
				
				date = document.form_comp_info.date2.value;
				
				if(date=="0000-00-00"){
					alert("Please select end date for cut-off.");
					return false;								
				}
			}
		</script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
		$(function() {
			$( "#from" ).datepicker({
				onClose: function( selectedDate ) {
					$( "#to" ).datepicker( "option", "minDate", selectedDate );
				}
			});
			$( "#to" ).datepicker({
				onClose: function( selectedDate ) {
					$( "#from" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
		})
		</script>
	</head>
	<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<?php include("menu.php"); ?>
		
		<form name="form_comp_info" action="<?php $PHP_SELF; ?>" method="POST" onsubmit="return infoidate();">
		<div id="container">
		
		<div class="container">
			<div class="page-header" style="width:800px!important;">
				<h4><strong class="formTitle"> Leave Cut-Off </strong></h4>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<form role="form">
         
				<div class="row">
					<form class="col s12">
					  <div class="row">
						<div class="input-field col s13">
						  <input style="margin-left:125px!important;" placeholder="Select Date" id="from" type="text" class="cotime" name="from" value='<?php echo $start_date[0]; ?>'/>
						  <label style="margin-left:-4px!important;" class="date" for="first_name"><i class="fa fa-calendar-o"></i>  START DATE</label>
						</div>
						<div class="input-field col s13">
						  <input style="margin-left:-220px!important;" placeholder="Select Date" id="to" type="text" class="cotime" name="to" value='<?php echo $end_date[0]; ?>'/>
						  <label style="margin-left:-350px!important;" class="date" for="first_name"><i class="fa fa-calendar-o"></i>  END DATE</label>
						</div>
					  </div>
					</form>
				</div>
			<hr style="margin-left:118px;margin-top:-25px;width:798px;">
		<input style="margin-left:118px!important;margin-top:0px!important;" type="submit" class="btn btn-success" name="submit" value="save" onclick="return validate2();"/>
		
		
		
		
		
		
		
		
		
		
		

		</div>
		</form>
		<?php include("footer.php"); ?>
	</body>
</html>	