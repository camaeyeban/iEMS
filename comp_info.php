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
		
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	
	$qry = $dblink->db_qry("SELECT COUNT(emp_num) FROM ems_employee");
	$data = $dblink->get_data($qry);
	
	$q = $dblink->db_qry("SELECT * FROM ems_geninfo");
	$info = $dblink->get_data($q);
	
	
	
	if(isset($_POST['submit']) && $_POST['submit']=="save"){
		$name = $_POST['name'];
        $phone = $_POST['phone'];
        $add1 = $_POST['add1'];
        $add2 = $_POST['add2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $tin = $_POST['tin'];
        $pagibig = $_POST['pagibig'];
        $phil = $_POST['phil'];
        $sss = $_POST['sss'];
        $strqry = "UPDATE ems_geninfo SET name='$name', phone='$phone', add1='$add1', add2='$add2', city='$city', state='$state', zip='$zip', tin='$tin', pagibig='$pagibig', philhealth='$phil', sss='$sss' ";
		$qry = $dblink->db_qry($strqry);
		$msg = "Company info successfully saved!";
		$q = $dblink->db_qry("SELECT * FROM ems_geninfo");
		$info = $dblink->get_data($q);
	}
	
	//casual
	$qry = $dblink->db_qry("SELECT COUNT('e.code') AS Casual  FROM ems_employee AS e
											INNER JOIN ems_emp_status AS es ON e.code  = es.code
											WHERE es.name='Casuals'");
	$casual = $dblink->get_data($qry);
	
	//Probationary
	$qry = $dblink->db_qry("SELECT COUNT('es.code') AS Probationary  FROM ems_employee AS e
											INNER JOIN ems_emp_status AS es ON e.code  = es.code
											WHERE es.name='probationary'");
	$prob  = $dblink->get_data($qry);			
	
	//regular
	$qry = $dblink->db_qry("SELECT COUNT('es.code') AS Regular  FROM ems_employee AS e
											INNER JOIN ems_emp_status AS es ON e.code  = es.code
											WHERE es.name='regular'");	
	$regular = $dblink->get_data($qry);
	
	//total
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>iEMS</title>
		<link rel="icon" href="icons/icon.png">
		
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
		<link rel="icon" href="icons/iEMS2.png">
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>
    </head>
    
	<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
        
		<?php include("menu.php"); ?>
        
		<form name="form_comp_info" action="<?php $PHP_SELF; ?>" method="POST" onsubmit="return infoidate();">
        
			<div id="container">
				<div class="container">
					<div class="page-header" style="width:770px!important;">
						<h4><strong class="blue-text text-darken-2"> COMPANY INFO: General </strong></h4>
					</div>
				</div>
				
				<div class="container">
					<div class="row">
							<?php echo $x = ($msg) ? $msg.'<hr>' : "" ;?>
							<div class="row">
									<div class="row">
										<div class="input-field col s6" style="width:30%!important;">
										  <input style="margin-left:1%!important;width:175%!important;" placeholder="Enter Company Name" id="name" type="text" class="date1" name="name" value="<?php echo $info[1];?>" required/>
										  <label class="date" for="name" style="width:100%!important;"><i class="fa fa-building-o"></i> COMPANY NAME *</label>
										</div>
										<div class="input-field col s6" style="margin-left:22%;padding:0%!important;">
										  <input style="width:370px!important;" placeholder="Enter Contact Number" name="phone" id="phone" type="text" class="classification1" value="<?php echo $info[2]; ?>";/>
										  <label style="margin-left:-39%!important;"class="classification" for="phone"><i class="fa fa-mobile fa-lg"></i>  PHONE</label>
										</div>
									</div>
									
									<div class="row">
										<div class="input-field col s6"style="width:30%!important;">
										  <input style="margin-left:1%!important;width:175%!important;" placeholder="Enter Address" id="add1" type="text" class="date1" name="add1" value="<?php echo $info[3]; ?>"/>
										  <label class="date" for="add1" style="width:700px!important;"><i class="fa fa-location-arrow"></i> ADDRESS 1 </label>
										</div>
										<div class="input-field col s6" style="margin-left:22%;padding:0%!important;">
										  <input style="width:370px!important;" placeholder="Enter Address" name="add2" id="add2" type="text" class="classification1" value="<?php echo  $info[4]; ?>"/>
										  <label style="margin-left:-39%!important;"class="classification" for="add2"><i class="fa fa-location-arrow"></i>  ADDRESS 2 </label>
										</div>
									</div>
									
									<div class="row">
										<div class="input-field col s6"style="width:30%!important;">
										  <input style="margin-left:1%!important;width:175%!important;" placeholder="Enter Location" id="city" type="text" class="date1" name="city" value="<?php echo $info[5]; ?>"/>
										  <label class="date" for="city" style="width:700px!important;"><i class="fa fa-map-marker"></i> CITY </label>
										</div>
										<div class="input-field col s6" style="margin-left:22%;padding:0%!important;">
										  <input style="width:370px!important;" placeholder="Enter Location" name="state" id="state" type="text" class="classification1" value="<?php echo  $info[6]; ?>"/>
										  <label style="margin-left:-39%!important;"class="classification" for="state"><i class="fa fa-map-marker"></i>  STATE/PROVINCE </label>
										</div>
									</div>
									
									<div class="row">
										<div class="input-field col s6"style="width:30%!important;">
										  <input style="margin-left:1%!important;width:175%!important;" placeholder="Enter Zip Code" id="zip" type="number" class="date1" name="zip" value="<?php echo $info[7]; ?>"/>
										  <label class="date" for="zip" style="width:700px!important;"><i class="fa fa-qrcode"></i> ZIP CODE </label>
										</div>
										<div class="input-field col s6" style="margin-left:22%;padding:0%!important;">
										  <input style="width:370px!important;" placeholder="Enter Tin Number" name="tin" id="tin" type="text" class="classification1" value="<?php echo  $info[8]; ?>"/>
										  <label style="margin-left:-39%!important;"class="classification" for="tin"><i class="fa fa-cog"></i>  TIN # </label>
										</div>
									</div>
									
									<div class="row">
										<div class="input-field col s6"style="width:30%!important;">
										  <input style="margin-left:1%!important;width:175%!important;" placeholder="Enter ID Number" id="pagibig" type="number" class="date1" name="pagibig" value="<?php echo $info[9]; ?>"/>
										  <label class="date" for="pagibig" style="width:700px!important;"><i class="fa fa-home"></i> PAGIBIG </label>
										</div>
										<div class="input-field col s6" style="margin-left:22%;padding:0%!important;">
										  <input style="width:370px!important;" placeholder="Enter Philhealth Number" name="phil" id="phil" type="number" class="classification1" value="<?php echo  $info[10]; ?>"/>
										  <label style="margin-left:-39%!important;"class="classification" for="phil"><i class="fa fa-user-md"></i>  PHILHEALTH </label>
										</div>
									</div>
									
									<div class="row">
										<div class="input-field col s6"style="width:30%!important;">
										  <input style="margin-left:1%!important;width:175%!important;" placeholder="Enter SSS ID" id="sss" type="number" class="date1" name="sss" value="<?php echo $info[11]; ?>"/>
										  <label class="date" for="sss" style="width:700px!important;"><i class="fa fa-credit-card"></i> SSS </label>
										</div>
									</div><hr style="margin-left: 130px;width: 768px;">
								
							</div>
						<div class="page-header" style="width:770px!important;margin-left:120px!important;margin-top:-20px!important;">
							<h4><strong class="blue-text text-darken-2" style="font-size:14px!important;"> Total Number of Employees as of <?php echo date("M-d-Y");?></strong></h4>
						</div>
						
						<?php
								$qry = mysql_query("SELECT e.code,e.name,(SELECT COUNT(CODE) FROM ems_employee WHERE CODE = e.code) AS stat_count
																FROM ems_emp_status e");
								while($result = mysql_fetch_array($qry)){
									echo '<table style="margin-top:-30px;"><br><br>';
									echo '<tr><td> <label style="font-size:13px; margin-left:130px;padding-right:20px;"><i class="fa fa-hand-o-right"></i>  ',$result[1].': </td></label><td><label style="margin-left:-796px;font-size:13px;">',$result[2].' </label></td>';
									echo '</tr></table>';
									//TL-2012/01/25 - Added currently employed total w/ condition not to include "Resign/Resigned" status, fixed hardcoded.
									if(strlen($result[1]) <= strlen("resign")){	//if length of $result[1]
										if(strtolower($result[1]) != "resign"){
											$curTotal = $curTotal + $result[2];
										}
									}else{
										//If status does not contain the word "resign", add to $curTotal.
										if(!is_numeric(strpos(strtolower($result[1]),"resign"))){
											$curTotal = $curTotal + $result[2];
										}
									}
									$total = $total + $result[2];
								}
							?>
						<hr style="margin-left: 130px;width: 768px;">
						<table style="margin-top:-10px;"><tr>
							<td><label style="font-size:13px; margin-left:130px;"><i class="fa fa-long-arrow-right"></i>  Presently Employed: </td></label><td><label style="margin-left:-800px;font-size:13px;"> <?php echo $curTotal;?> </label></td>
							</tr><tr><td><label style="margin-top:8px;font-size:13px; margin-left:130px;"><i class="fa fa-long-arrow-right"></i>  Total Number of Employees: </td></label><td><label style="margin-left:-800px;font-size:13px;"> <?php echo $total;?> </label></td>
						</tr></table><hr style="margin-left: 130px;width: 768px;"><br><br>
						<div class="disclaimer" style="margin-left:127px!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> Fields marked with an asterisk * are required.</div>
						<input style="margin-left:129px!important;margin-top:19px!important;" type="submit" name="submit" id="submit" value="save" class="save btn btn-primary" />
					</div>
				</div>
			</div>
				
				
		
            </div>
        </form>
		
		<?php include("footer.php"); ?>
    </body>
</html>