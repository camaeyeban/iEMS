<?php
	ob_start();
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);
	date_default_timezone_set('Asia/Taipei');

	include("functions.php");
	include("config_DB.php");

	chk_active($_SESSION['user_id']);
	require_once("calendar/classes/tc_calendar.php");
	
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	
	if($_SESSION['rights']==3){
		echo '<h1>',"Invalid URL",'</h1>';
		return false;
	}
	
	//TL-2012/01/20 - Changed $a_data[0] to $_SESSION['rights'].
	$a_qry = mysql_query("SELECT rights FROM ems_users WHERE username='$_SESSION[username]' ");
	$a_data = mysql_fetch_array($a_qry);
		
	if(isset($_POST['approve_off'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				$qry = mysql_query("SELECT * FROM ems_offset_new where offset_id = '$app'");

				if(!qry)
					die("Error : " . mysql_error());
				$row = mysql_fetch_array($qry);

				$ot_dates = explode("|",$row[3]);
				$ot_hours = explode("|",$row[4]);
				$os_hours = explode("|",$row[6]);
				$no_hours = array();
				$bool = true;
				$ot_d = '';
				
				for($i = 0; $i < count($ot_dates); $i++){
					//echo "date = " . date('Y-m-d', strtotime($ot_dates[$i])) ." - " . $row[1]."<br/>";
					$qry_ot = mysql_query("SELECT status, date_ot, no_of_hours from ems_ot where emp_num = '" .$row[1]."' and date_ot = '" . date('Y-m-d', strtotime($ot_dates[$i])) . "' ");

					if(!$qry_ot)
						die("Error : " . mysql_error());

					$row_ot = mysql_fetch_array($qry_ot);
					
					//echo count($row_ot) . " = " . $row_ot[0] . " - " . $row_ot[1] ."<br/>";

					if($ot_dates[$i] != '' && $row_ot[0] != 'Pending'){	
						$bool = false;
						$ot_d = $row_ot[1];
						break;
					}
					
					$no_hours[$i] = $row_ot[2];
				}
				if($bool){
					if(!qry)
						die("Error : " . mysql_error());
					
					$bool_greater = true;
					$hrs = 0;
					$hra = 0;
					for($i = 0; $i < count($ot_dates); $i++){	
						if($no_hours[$i] < $os_hours[$i]){
							$bool_greater = false;
							$ot_d = $ot_dates[$i];
							$hrs = $no_hours[$i];
							$hra = $os_hours[$i];
							break;
						}
					}
					
					if($bool_greater){
						for($i = 0; $i < count($ot_dates); $i++){ 
							if(($ot_hours[$i] - $os_hours[$i]) == 0){
								$get = mysql_query("UPDATE ems_ot SET status='Used' where emp_num = '$row[1]' and date_ot = '".date('Y-m-d', strtotime($ot_dates[$i]))."' ");
								
								$qry = mysql_query("UPDATE ems_offset_new SET status='Approved' WHERE offset_id='$app' ");
							}else{
								$get = mysql_query("UPDATE ems_ot SET no_of_hours = ".($ot_hours[$i] - $os_hours[$i])." where emp_num = '$row[1]' and date_ot = '".date('Y-m-d', strtotime($ot_dates[$i]))."' ");
								
								$qry = mysql_query("UPDATE ems_offset_new SET status='Approved' WHERE offset_id='$app' ");
							}
						}
						send_email("offset request", $app, "off", "approved");
						$qry = mysql_query("SELECT emp_num from ems_offset_new where offset_id = '$app'");
						$row = mysql_fetch_array($qry);
						$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$app', '".$_SESSION['emp_num']."', 'Approved!', 'created: ".date('m-d-Y h:m A')." A') ");
					}else{
						echo "<script>alert('Conflict to Overtime date : ".$ot_d." . Number of Hours Left is ".$hrs.". Number of Hours Used is ".$hra."');</script>";
						header("Refresh:0");
					}
				}else{
					echo "<script>alert('Conflict to Overtime date : ".$ot_d." . OT Date already used or approved for offset');</script>";
					header("Refresh:0");
				}
			}
		}
	}else if(isset($_POST['deny_off'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_offset_new SET status='Denied' WHERE offset_id='$deny' ");
				send_email("offset request", $deny, "off", "denied");
				$qry = mysql_query("SELECT emp_num from ems_offset_new where offset_id = '$deny'");
				$row = mysql_fetch_array($qry);
				$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$deny', '".$_SESSION['emp_num']."', 'Denied!', 'created: ".date('m-d-Y h:m A')." D ') ");
			}
		}
	}elseif(isset($_POST['cancel_off'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_offset_new SET status='Cancelled' WHERE offset_id='$cancel' ");
			}
		}
	}
	
	if(isset($_POST['submit'])){

			if($count==0){
				$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$_GET[ID]', '$_SESSION[emp_num]', '$remarks', 'created: $datetime', '$dt') ");
			}else{
				$update = mysql_query("UPDATE ems_remarks SET remarks='$remarks', date='updated last: $datetime' WHERE id='$_GET[ID]' AND emp_num='$_SESSION[emp_num]' ");
			}
			echo '<script>window.location.href=window.location.href;
			 window.opener.location.reload();
			 parent.refresh();</script>';
			// echo '<script>window.location.reload();</script>'; 
	}

	$save_remarks = nl2br(trim($_POST['save_remarks']));
	$edit_remarks = nl2br(trim($_POST['edit_remarks']));
	$datetime = date("M d, Y h:i:s a", time());

	if(isset($_POST['save'])){
		$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$_GET[ID]', '$_SESSION[emp_num]', '$save_remarks', 'created: $datetime') ");
			echo '<script>window.location.href=window.location.href;
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif(isset($_POST['update'])){
		$update = mysql_query("UPDATE ems_remarks SET remarks='$edit_remarks', date= (date + '@updated last: $datetime') WHERE remarks_id='$_GET[id]' ");
			echo '<script>window.location = \'remarks.php?ID=',$_GET['ID'],'&\';
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}

	function get_name($data){
		if($data == 0)
			$data = 1;
		$qry = mysql_query("SELECT CONCAT(emp_firstname,' ',emp_lastname) FROM ems_employee WHERE emp_num='$data' ");
		$nn = mysql_result($qry, 0);
		if(mysql_num_rows($qry)>0){
			$name = $nn;
		}
		return $name;
	}

	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	$q_oic = "''";
	
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = $q_oic.",'".$row[0]."'";
	}
	
	$sman_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' 
								AND dept_code = 'DEP-0000' ");
	$cnt = mysql_num_rows($sman_oic);
	
	if($cnt > 0){
		$man_oic = " OR (rights=2 AND e.emp_num <> $_SESSION[emp_num]) ";
	}else{
		$man_oic = "";
	}
	
	$s_report = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE report_to='$_SESSION[emp_num]' ");
	//JD-2012/09/20 - Show applications of one manager in one or more departments
	$q_report = "''";
	while($row = mysql_fetch_array($s_report)){
		$q_report = $q_report.",'".$row[0]."'";
	}
	
	//JD-2012/11/12 - Added variables to store and carry values to another php object
	$qoic = $q_oic; //variable containing the oic
	$report = $q_report; //variable containing the report to
	$empnum = $_SESSION['emp_num']; //variable containing the employee number from session
	$depcode = $_SESSION['dept_code']; //variable containing the deptartment code from session
	$bman = $_SESSION['fullname']; //JD-2013/05/22 - variable containing the fullname of the manager
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	
<html lang="en">

    <head>
	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link rel="icon" href="../icons/icon.png">

		<title>iEMS</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
		<script>
			$(document).ready(function(){
				$("#b1").click(function(){
					$("#theirs").hide("slow");
					$("#mine").show("slow");
				});
				$("#b2").click(function(){
					$("#mine").hide("slow");
					$("#theirs").show("slow");
				});
			});
		</script>
		
    </head>
	
	
    <body alink="green" vlink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    	
		<?php include("menu.php"); ?>
		<br/>
		
	    <div id="container">
		
			<div class="col-lg-12" id="tab-container">

				<?php
					if($_SESSION['rights']!=1){
						echo '
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation"><a href="#mine" aria-controls="mine" role="tab" data-toggle="tab">My New Offset Applications</a></li>
					<li role="presentation"><a href="#theirs" aria-controls="theirs" role="tab" data-toggle="tab">New Offset Requests</a></li>
				</ul>
				
				<div class="tab-content">
		
					<div role="tabpanel" class="tab-pane active" id="mine">
						<form name="form_ot_request" action="',$PHP_SELF,'" method="POST">

							<div class="panel-body col-lg-12">
								<div class="table-buttons row">
									<a href = "view_edit_offset_old.php" class = "a upper-link">View My Old Offset Applications</a>
								</div>
								<button type="button" class="apply pull-right btn btn-primary" onclick="window.location = \'offset.php\'">Apply Offset</button>
								<div class="table-buttons row">
									<button type="submit" name="deny_off" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'off\');">Deny</button>
									<button type="submit" name="approve_off" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'off\');">Approve</button>
								</div>
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="offset-applications-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">OT Details</th>
												<th class="table-column-names">Offset Details</th>
												<th class="table-column-names">Remarks</th>
												<th class="table-column-names">Status</th>
											</tr>
										</thead>
										<tbody>
						';
											
												$by = $_POST['searchby'];
												$search = $_POST['search'];
												if(isset($_POST['submit']) && $_POST['submit']=="search"){
													switch($by){
														case 1:
																$strqry = "emp_num='$_SESSION[emp_num]' AND date_filed='$search'";
														break;
					
														case 2:
																$strqry = "emp_num='$_SESSION[emp_num]' AND (date_offset='$search')";
														break;	

														case 3:
																$strqry = "emp_num='$_SESSION[emp_num]' AND status='$search'";
														break;	

														case 4:
																$strqry = "emp_num='$_SESSION[emp_num]' AND off_type LIKE '%$search%'";								

														case 0:
																$strqry = "(emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND (date_offset LIKE '%$search%')) OR 
																(emp_num='$_SESSION[emp_num]' AND status LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND off_type LIKE '%$search%')"	;
														break;											
													}
												}else{
													$strqry = "emp_num='$_SESSION[emp_num]'";
												}
												$str = "SELECT date_filed, ot_dates, ot_hours, 
															purpose, date_offset, 
															remarks, status, offset_id, off_type, off_halfday, ot_exp_output, off_hrs
															FROM ems_offset_new
															WHERE $strqry
															ORDER BY offset_id DESC";
												$x = "a";
												$qry = mysql_query($str);
												
												while($result = mysql_fetch_array($qry)){
													echo '<tr align="center"  class="',$x,'">';
													chk_stat($result[6], $result[7], "off");
													edit_app($result[6], $result[7], "off_edit", $result[0]);

													//OT expected output
													//$eo_ot = (strpos($result[10],"|")? str_replace('|', '<br />', $result[10]) : $result[10]);
													
													//OT Date, expected output
													$date = explode("|",$result[1]);
													$output = explode("|", $result[10]);
													for($i=0;$i<sizeof($date);$i++){
														$date_out = $date_out . '<b>'.date('F d, Y', strtotime($date[$i])).'</b>' . ' - '. $output[$i]. '<br/>';
													}										
													echo '<td style="text-align: left">',$date_out;	
													$date_out = "";

													//OT hours
													$hrs_ot = (strpos($result[2],"|")? str_replace('|', '<br />', $result[2]) : $result[2]);
													echo $hrs_ot,'</td>';

													echo '<td>',date('F d, Y', strtotime($result[4])),', ';//offset date
													//Offset hrs
													$hrs_off = (strpos($result[11],"|")? str_replace('|', '<br />', $result[11]) : $result[11]);
													echo $hrs_off,' hour(s)<br>';

													//Purpose
													echo 'For: ',$result[3],'<br>'; 

													//offset type
													$off_type = ($result[8]=="Half Day")? $result[8] . " (" . $result[9] . ")" : $result[8]; //offset type
													echo 'Type: ', $off_type, '</td>'; 

													show_remarks($result[7]);	//remarks
													echo '<td><button class="btn btn-',f_color($result[6]),'">',$result[6],'</button></td>';//status
													
													if($x=="a"){
															$x = $x . "b";
													}else{
															$x = "a";
													}		
													
													echo '</tr>';
												}
											
						echo '
										</tbody>
									</table>
								</div> <!-- table-responsive of my offset applications -->
					
								<div class="table-buttons row">
						';
									
										echo '
										<button type="submit" name="deny_off" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'off\');">Deny</button>
										<button type="submit" name="approve_off" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'off\');">Approve</button>
										';
						echo '
								</div>
							</div> <!-- panel-body of my offset applications -->
						</form>
					</div> <!-- tab-pane (1) for my offset applications -->
					
					<div role="tabpanel" class="tab-pane active" id="theirs">
						<div class="panel-body col-lg-12">
						';
					}
					else{
						echo '
							<div class="panel-body top-bordered col-lg-12">
								<div class="table-buttons row">
									<h2 class="summary-title">New Offset Requests</h2>
								</div>
						';
					}
				?>
							<form name="form_off" action="view_offset_request.php?searchby=0&search=&submit=search" method="POST">
						
								<div class="table-buttons row">
									<a href="view_offset_request_old.php" class="a upper-link zero-bottom-margin"> View Old Offset Requests </a>
								</div>
								<div class="table-buttons row">
									<button type="submit" name="deny_off" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'off\');">Deny</button>
									<button type="submit" name="approve_off" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'off\');">Approve</button>
								</div>
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="offset-requests-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Name</th>
												<th class="table-column-names">OT Details</th>
												<th class="table-column-names">Offset Details</th>
												<th class="table-column-names">Remarks</th>
												<th class="table-column-names">Offset Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$by = $_GET['searchby'];
												$search = $_GET['search'];
												if(isset($_GET['submit']) && $_GET['submit']=="search"){
													//--> JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]'	
													switch($by){
														case 1:
															$strqry = ($_SESSION['rights']==1  OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "date_filed='$search' " :
																 "b.b_manager_name='$_SESSION[fullname]' AND date_filed='$search'";
														break;

														case 2:
															$strqry = ($_SESSION['rights']==1  OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "emp_firstname LIKE '%$search%' " :
																 "b.b_manager_name='$_SESSION[fullname]' AND emp_firstname LIKE '%$search%'";
														break;
														
														case 3:
															$strqry = ($_SESSION['rights']==1  OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "emp_middlename LIKE '%$search%' " :
																 "b.b_manager_name='$_SESSION[fullname]' AND emp_middlename LIKE '%$search%'";
														break;
														
														case 4:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "emp_lastname LIKE '%$search%' " :
																 "b.b_manager_name='$_SESSION[fullname]' AND emp_lastname LIKE '%$search%'";
														break;
														
														case 5:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "(o.date_offset='$search')" : "b.b_manager_name='$_SESSION[fullname]' AND (o.date_offset='$search')";
														break;
														
														case 6:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "o.status='$search' " :
																 "b.b_manager_name='$_SESSION[fullname]' AND o.status='$search'";
														break;
														
														case 0:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "date_filed='$search' 
																OR emp_firstname LIKE '%$search%' 
																OR emp_middlename LIKE '%$search%' 
																OR emp_lastname LIKE '%$search%' 
																OR (o.date_offset='$search')
																OR o.status='$search'" 
																:
																"b.b_manager_name='$_SESSION[fullname]' AND (date_filed='$search' 
																OR emp_firstname LIKE '%$search%' 
																OR emp_middlename LIKE '%$search%' 
																OR emp_lastname LIKE '%$search%' 
																OR o.date_offset='$search' 
																OR o.status='$search')";
														break;
														//<----- End of modification
													}
												}else{
													$param = $_GET["param"]; //JD-2012/11/19 - Get paramater of the url
													$param = stripslashes($param); //JD-2012/11/19 - Used to removed slashes in the parameter
													//JD-2012/11/19 - Replace "1" with "$param" as the default value
													//JD-2013/05/22 - Replaced dept_code='$_SESSION[dept_code]' with b.b_manager_name='$_SESSION[fullname]'
													//JD-2015/06/02 - Added condition that if param is empty, use 1
													if ($param == "") {
														if ($_SESSION['rights']==2) {
															$param = "b.b_manager_name='$_SESSION[fullname]'";
														}else{
															$param = 1;
														}
													}else{
														$param = $param;
													}
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "$param" : "b.b_manager_name='$_SESSION[fullname]'";
												}	
												// user 3
												// manager 2
												if($_SESSION['rights']==1 || $_SESSION['rights'] == 4 ){//admin
													if(!$strqry){
														$str = "SELECT o.date_filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, o.ot_dates, o.ot_hours, 
																purpose, o.date_offset, o.off_type, o.off_halfday, o.remarks, o.status, offset_id, o.ot_exp_output
																	FROM ems_offset_new as o
																	INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num 
																	WHERE 1					
																	ORDER BY case
																					when o.status = 'Pending' then 1
																					when o.status = 'Approved' then 2
																					when o.status = 'Denied' then 3
																					else 1000
																				 end asc, o.offset_id DESC";						
													}else{
														$str = "SELECT o.date_filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, o.ot_dates, o.ot_hours, 
																purpose, o.date_offset, o.off_type, o.off_halfday, o.remarks, o.status, offset_id, o.ot_exp_output
																	FROM ems_offset_new as o
																	INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num WHERE $strqry					
																	ORDER BY case
																					when o.status = 'Pending' then 1
																					when o.status = 'Approved' then 2
																					when o.status = 'Denied' then 3
																					else 1000
																				 end asc, o.offset_id DESC";
													}
												}  
												//JD-2012/06/25 - Separate Condition for Executive to show only managers' Offset Requests
												elseif($_SESSION['rights']==5){
													//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
													//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
													//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
													$str = "SELECT o.date_filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, o.ot_dates, o.ot_hours, 
																purpose, o.date_offset, o.off_type, o.off_halfday, o.remarks, o.status, offset_id, o.ot_exp_output
																FROM ems_offset_new as o
																INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num 
																INNER JOIN ems_users as ue ON ue.emp_num = e.emp_num
																LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
																WHERE 1 AND (ue.rights=2 OR ue.rights=4)
																ORDER BY case
																					when o.status = 'Pending' then 1
																					when o.status = 'Approved' then 2
																					when o.status = 'Denied' then 3
																					else 1000
																				 end asc, o.offset_id DESC";
												}else{
													//JD-2014/09/25 - Added condition e.code != 'EST004'
													//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
													//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
													//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
													$str = "SELECT o.date_filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, o.ot_dates, o.ot_hours, 
																purpose, o.date_offset, o.off_type, o.off_halfday, o.remarks, o.status, offset_id, o.ot_exp_output, o.off_hrs
																FROM ems_offset_new as o
																INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num
																INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
																LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
																WHERE ($strqry OR (e.dept_code IN($q_oic) AND rights!=2) OR (e.dept_code IN ($q_report) AND rights=2) $man_oic) 
																AND o.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
																ORDER BY case
																					when o.status = 'Pending' then 1
																					when o.status = 'Approved' then 2
																					when o.status = 'Denied' then 3
																					else 1000
																				 end asc, o.offset_id DESC";	
												}
												//echo $str; //For debugging purposes only
												
												$my_variable = 'param='.$strqry; //JD-2012/11/19 - added value to the url named param and concatenate value of $strqry
												$x = "a";
												$qry = mysql_query($str);
											
												while($result = mysql_fetch_array($qry)){
													$name = $result[1]." ".$result[2]." ".$result[3]; 
													echo '<tr align="center"  class="',$x,'">';
													chk_stat($result[11], $result[12], "off_man"); //check status
													echo '<td width="8%">',$result[0],'</td>'; //date filed
													echo '<td>',$name,'</td>'; //name
													
													$date = explode("|",$result[4]);
													$output = explode("|", $result[13]);
													
													for($i=0;$i<sizeof($date);$i++){
														$date_out = $date_out . '<b>'.date('F d, Y', strtotime($date[i])).'</b>' . ' - '. $output[$i]. '<br/>';
													} 										
													echo '<td style ="text-align: left">',$date_out;	
													$date_out = "";

													//ot hours
													$hrs_ot = (strpos($result[5], "|")) ? str_replace("|", '<br/>', $result[5]) : $result[5];			
													echo $hrs_ot,' hour(s)</td>'; 	

													echo '<td>',date('F d, Y', strtotime($result[7])),', '; //offset_date 
													
													$hrs_off = (strpos($result[14], "|")) ? str_replace("|", '<br/>', $result[14]) : $result[14];			
													echo $hrs_off,'<br>';
													
													echo 'For: ',$result[6],'<br>'; //purpose
													
													//offset_type
													$off_type = ($result[8] == "Half Day")? $result[8] . ' (' . $result[9] . ')' : $result[8];
													echo 'Type: ',$off_type,'</td>'; 
												
													show_remarks($result[12]); //remarks
													echo '<td><span class="label label-',f_color($result[11]),'">',$result[11],'</span></td>';	//status
													echo '</tr>';
													
													if($x=="a"){
														$x = $x . "b";
													}else{
														$x = "a";
													}	
												}
											?>
										</tbody>
									</table>
								</div> <!-- table-responsive of offset requests -->
								
								<div class="table-buttons row">
									<?php
										echo '
										<button type="submit" name="deny_off" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'off\');">Deny</button>
										<button type="submit" name="approve_off" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'off\');">Approve</button>
										';
									?>
								</div>
								
							</form>
						</div> <!-- panel-body of offset requests -->
				<?php
					if($_SESSION['rights']!=1){
						echo '
					</div> <!-- tab-pane (2) for offset requests -->
					
				</div> <!-- tab-content -->
						';
					}
				?>
			</div> <!-- col-lg-12 -->
		</div> <!-- container -->
										
		<?php include("footer.php"); ?>
		
		
		<script type="text/javascript">
			$(document).ready( function() {
				$('#tab-container').easytabs();
			});
		</script>
		<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script> 
		<script src="js/jquery.hashchange.min.js" type="text/javascript"></script>
		<script src="js/jquery.js"></script>
		<script src="js/jquery.easytabs.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
		<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#offset-applications-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			$(document).ready(function() {
				$('#offset-requests-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
		</script>
		
    </body>
</html>