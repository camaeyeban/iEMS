<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);
	date_default_timezone_set('Asia/Taipei');

	include("ps_pagination.php");
	include("functions.php");
	include("config_DB.php");

	chk_active($_SESSION['user_id']);
	require_once("calendar/classes/tc_calendar.php");

	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}

	if($_SESSION['rights']==3){
			echo '<h1>',"Invalid URL!",'</h1>';
			return false;
	}

	//TL-2012/01/20 - Changed $a_data[0] to $_SESSION['rights'].
	$a_qry = mysql_query("SELECT rights FROM ems_users WHERE username='$_SESSION[username]' ");
	$a_data = mysql_fetch_array($a_qry);

	if(isset($_POST['approve_lv'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				$qry = mysql_query("UPDATE ems_leave SET status='Approved' WHERE leave_id='$app' ");
				send_email("leave application", $app, "lv","approved");
				$qry = mysql_query("SELECT emp_num from ems_leave where leave_id = '$app'");
				$row = mysql_fetch_array($qry);
				$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$app', '".$_SESSION['emp_num']."', 'Approved!', 'created: ".date('m-d-Y h:m A')."') ");
			}
		}
	}elseif(isset($_POST['deny_lv'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk                                                                                                                                                                                                                                                                                                                              )!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_leave SET status='Denied' WHERE leave_id='$deny' ");
				send_email("leave application", $deny, "lv","denied") ;
				$qry = mysql_query("SELECT emp_num from ems_leave where leave_id = '$deny'");
				$row = mysql_fetch_array($qry);
				$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$deny', '".$_SESSION['emp_num']."', 'Denied!', 'created: ".date('m-d-Y h:m A')." A') ");
			
			}
		}
	}elseif(isset($_POST['cancel_lv'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_leave SET status='Cancelled' WHERE leave_id='$cancel' ");
			}
		}
	}

	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	$q_oic = "''";
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = $q_oic.",'".$row[0]."'";
	}
	
	//Condition not to include the applications of the OIC itself.
	$sman_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' AND dept_code = 'DEP-0000' ");
	$cnt = mysql_num_rows($sman_oic);
	if($cnt > 0){
		$man_oic = " OR (rights=2) ";
	}else{
		$man_oic = "";
	}

	//Finding the report to department
	$s_report = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE report_to='$_SESSION[emp_num]' OR b_manager_name = '" . $_SESSION['fullname'] ."'");
	//Show applications of one manager in one or more departments
	$q_report = "''";
	while($row = mysql_fetch_array($s_report)){
		$q_report = "'".$row[0]."'";
		//echo $row[0]. " - ";
	}
	
	//JD-2012/11/12 - Added variables to store and carry values to another php object
	$qoic = $q_oic; //variable containing the oic
	$report = $q_report; //variable containing the report to
	$empnum = $_SESSION['emp_num']; //variable containing the employee number from session
	$depcode = $_SESSION['dept_code']; //variable containing the deptartment code from session
	$bman = $_SESSION['fullname']; //JD-2013/05/22 - variable containing the fullname of the manager

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
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html lang="en">

    <head>
	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" href="../icons/icon.png">

        <title>iEMS</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/plugins/social-buttons.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">
		
		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
		
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
					<li role="presentation"><a href="#mine" aria-controls="mine" role="tab" data-toggle="tab">My Leave Applications</a></li>
					<li role="presentation"><a href="#theirs" aria-controls="theirs" role="tab" data-toggle="tab">Leave Requests</a></li>
				</ul>
				
				<div class="tab-content">
		
					<div role="tabpanel" class="tab-pane active" id="mine">
						<form name="form_leave" action="view_leave_summary.php" method="POST">
				
							<div class="panel-body col-lg-12">
								<form name="form_leave" action="view_leave_summary.php" method="POST">
									
									<div class="table-buttons row">
										<a href="leave_undertime.php?ID=&action=leave" class="a upper-link tabbed zero-bottom-margin">Apply Leave</a>
									</div>
									<div class="table-buttons row">
										<button type="submit" name="cancel_lv" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'lv\');">Cancel</button>
									</div>
								
									<div class="table-responsive col-lg-12">
										<table class="table table-striped table-bordered table-hover" id="leave-requests-table">
											<thead>
												<tr>
													<th class="nosort"> </th>
													<th class="table-column-names">Date Filed</th>
													<th class="table-column-names">Details</th>
													<th class="table-column-names">Reason</th>
													<th class="table-column-names">Remarks</th>
													<th class="table-column-names">Status</th>
												</tr>
											</thead>
											<tbody>
						';
												
													$by = $_POST['searchby'];
													$search = $_POST['search'];
													
													if(isset($_POST['submit']) && $_POST['submit']=="search_lv"){				
														switch($by){
															case 1:
																	$strqry = "emp_num='$_SESSION[emp_num]' AND date_filed='$search'";											
															break;
														
															case 2:
																	$strqry = "emp_num='$_SESSION[emp_num]' AND (d_from='$search' OR d_to='$search')";		
															break;
														
															case 3:
																	$strqry = "emp_num='$_SESSION[emp_num]' AND type='$search'";							
															break;
														
															case 4:
																	$strqry = "emp_num='$_SESSION[emp_num]' AND status='$search'";							
															break;
														
															case 0:
																	$strqry = "(emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' 
																		AND (d_to LIKE '%$search%' OR d_from LIKE '%$search%')) OR (emp_num='$_SESSION[emp_num]' 
																		AND TYPE LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND STATUS LIKE '%$search%')";
															break;
														}
													}else{
														$strqry = "emp_num='$_SESSION[emp_num]' ";
													}

													//JD-2015/06/02 - Added time on the query. This is to consider the 0.5 value for old applications
													$str = "SELECT date_Filed, d_from, d_to, no_of_days, type,  reason, status, leave_id, time, remarks FROM ems_leave 
																WHERE $strqry
																ORDER BY leave_id DESC";
													
													$x = "a";
													$cnt = 1;
													$qry = mysql_query($str);
												
													while($result = mysql_fetch_array($qry)){
														$hd = $result[3]-substr("$result[8]",0 ,2);
														
														echo '<tr align="center" class="',$x,'" valign="top">';
														chk_stat($result[6], $result[7], "lv");
														edit_app($result[6],$result[7],"leave_edit",$result[0]);
														echo '<td>',$result[4];
														echo '<br>',date('F d, Y', strtotime($result[1]))." - ".date('F d, Y', strtotime($result[2])),'<br>';
						
														$strVar = $result[8];
														$numInt = strlen($strVar);
						
														if($numInt==8){
															echo $result[3],' day(s)</td>';	
														}else{
															echo $hd,' day(s)</td>';
														}							
														echo '<td width="30%">',$result[5],'</td>';		
														show_remarks($result[6]);
														echo '<td><span class="btn btn-',f_color($result[6]),'">',$result[6],'</button></td>';
														echo '</tr>';
							
														if($x=="a"){
															$x = $x . "b";
														}else{
															$x = "a";
														}
														$cnt++;
													}
												
						echo '
											</tbody>
										</table>
									</div> <!-- table-responsive of my leave applications -->
									
									<div class="table-buttons row">
						';
										
										echo '<button type="submit" name="cancel_lv" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'lv\');">Cancel</button>';
										
						echo '
									</div>
								</form>
							</div> <!-- panel-body of my leave applications -->
						</form>
					</div> <!-- tab-pane (2) for my leave applications -->
					
					<div role="tabpanel" class="tab-pane active" id="theirs">
						
						<div class="panel-body col-lg-12">
							<div class="table-buttons row">
								<button type="submit" name="deny_lv" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\');">Deny</button>
								<button type="submit" name="approve_lv" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\');">Approve</button>
							</div>
						';
					}
					else{
						echo '
						<div class="panel-body top-bordered col-lg-12">
						
							<div class="table-buttons row">
								<h2 class="summary-title">Leave Requests</h2>
								<button type="submit" name="deny_lv" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\');">Deny</button>
								<button type="submit" name="approve_lv" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\');">Approve</button>
							</div>
						';
					}
				?>
							<form name="form_lv_un" action="view_leave_summary.php?searchby=0&search=&submit=search_lv" method="POST">
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="leave-applications-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Name</th>
												<th class="table-column-names">Details</th>
												<th class="table-column-names">Reason</th>
												<th class="table-column-names">Remarks</th>
												<th class="table-column-names">Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$by = $_GET['searchby'];
												$search = $_GET['search'];
												if(isset($_GET['submit']) && $_GET['submit']=="search_lv"){
													//--> JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]'		
													switch($by){
														case 1:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "date_filed='$search' " :
																"b.b_manager_name='$_SESSION[fullname]' AND date_filed='$search'";
														break;

														case 2:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "emp_firstname LIKE '%$search%' " :
																"b.b_manager_name='$_SESSION[fullname]' AND emp_firstname LIKE '%$search%'";
														break;

														case 3:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "emp_middlename LIKE '%$search%' " :
																"b.b_manager_name='$_SESSION[fullname]' AND emp_middlename LIKE '%$search%'";
														break;									

														case 4:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "emp_lastname LIKE '%$search%' " :
																"b.b_manager_name='$_SESSION[fullname]' AND emp_lastname LIKE '%$search%'";
														break;

														case 5:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "l.type LIKE '%$search%'" : 
																"b.b_manager_name='$_SESSION[fullname]' AND l.type='$search'";
														break;

														case 6:
															$strqry = ($_SESSION['rights']==1  OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "l.status LIKE '%$search%'" : 
																"b.b_manager_name='$_SESSION[fullname]' AND l.status='$search'";
														break;

														case 0:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? 
																"date_filed='$search' 
																	OR emp_firstname LIKE '%$search%' 
																	OR emp_middlename LIKE '%$search%' 
																	OR emp_lastname LIKE '%$search%' 
																	OR l.type='$search' 
																	OR l.status='$search'" 
																	: 
																"b.b_manager_name='$_SESSION[fullname]'
																	AND (date_filed='$search' 
																	OR emp_firstname LIKE '%$search%' 
																	OR emp_middlename LIKE '%$search%' 
																	OR emp_lastname LIKE '%$search%' 
																	OR l.type='$search'
																	OR l.status='$search')";
														break;
														//<---END of modification
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

												if($_SESSION['rights']==1 || $_SESSION['rights'] == 4 ){
													if(!$strqry){
														$str = "SELECT date_Filed, e.emp_firstname,e.emp_middlename, e.emp_lastname, d_from, d_to, no_of_days, 
																	l.type, reason, l.status, leave_id, remarks
																	FROM ems_leave as l
																	INNER JOIN ems_employee as e ON e.emp_num = l.emp_num 
																	WHERE 1
																	ORDER BY case
																					when l.status = 'Pending' then 1
																					when l.status = 'Approved' then 2
																					when l.status = 'Denied' then 3
																					else 1000
																				 end asc, l.leave_id DESC";
													}else{
														$str = "SELECT date_Filed, e.emp_firstname,e.emp_middlename, e.emp_lastname, d_from, d_to, no_of_days, 
																	l.type, reason, l.status, leave_id, remarks, time
																	FROM ems_leave as l
																	INNER JOIN ems_employee as e ON e.emp_num = l.emp_num 
																	WHERE $strqry
																	ORDER BY case
																					when l.status = 'Pending' then 1
																					when l.status = 'Approved' then 2
																					when l.status = 'Denied' then 3
																					else 1000
																				 end asc, l.leave_id DESC";
													}
												}

												//JD-2012/06/25 - Separate Condition for Executive to show only managers' leave applications
												elseif($_SESSION['rights']==5){
													$str = "SELECT date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, d_from, d_to, no_of_days, l.type, 
																reason, l.status, leave_id, remarks, time
																FROM ems_leave as l
																INNER JOIN ems_employee as e ON e.emp_num = l.emp_num 
																INNER JOIN ems_users as eu ON eu.emp_num=e.emp_num
																WHERE 1 AND (eu.rights=2 OR eu.rights=4)
																ORDER BY case
																					when l.status = 'Pending' then 1
																					when l.status = 'Approved' then 2
																					when l.status = 'Denied' then 3
																					else 1000
																				 end asc, l.leave_id DESC";
												} //Note: Jan.07'13/ Search function not working for executive account. Another query is needed.
												
												elseif($_SESSION['rights']==2){
													if(!$strqry){
														//JD-2014/09/25 - Added condition e.code != 'EST004'
														//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
														//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
														//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
														$str = "SELECT date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, d_from, d_to, 
																	no_of_days, l.type, reason, l.status, leave_id, remarks, time
																	FROM ems_leave as l
																	INNER JOIN ems_employee as e ON e.emp_num = l.emp_num
																	INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
																	LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code 
																	WHERE (1 OR (e.dept_code IN($q_oic) AND rights!=2) OR (e.dept_code IN ($q_report) AND rights=2) $man_oic)
																	AND l.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
																	ORDER BY case
																					when l.status = 'Pending' then 1
																					when l.status = 'Approved' then 2
																					when l.status = 'Denied' then 3
																					else 1000
																				 end asc, l.leave_id DESC";							
													}else{
														//JD-2014/09/25 - Added condition e.code != 'EST004'
														//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
														//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
														//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
														$str = "SELECT date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, d_from, d_to, 
																	no_of_days, l.type, reason, l.status, leave_id, remarks, time
																	FROM ems_leave as l
																	INNER JOIN ems_employee as e ON e.emp_num = l.emp_num
																	INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
																	LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
																	WHERE ($strqry OR (e.dept_code IN($q_oic) AND rights!=2) OR (e.dept_code IN ($q_report) AND rights=2) $man_oic)
																	AND l.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
																	ORDER BY case
																					when l.status = 'Pending' then 1
																					when l.status = 'Approved' then 2
																					when l.status = 'Denied' then 3
																					else 1000
																				 end asc, l.leave_id DESC";
													}
												}
												//echo $str; //for debugging purpose only
												//echo $strqry;
												
												$my_variable = 'param='.$strqry; //JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
												$x = "a";
												
												$qry = mysql_query($str);
														
												while($result = mysql_fetch_array($qry)){	
													echo '<tr align="center" class="',$x,'">';
													chk_stat($result[9], $result[10], "lv_man");
													echo '<td width="8%">',$result[0],'</td>';
													echo '<td width="15%">',$result[1]." ".$result[2]." ".$result[3],'</td>';
													echo '<td width="20%">',$result[7],'<br>';																		
													echo date('F d, Y', strtotime($result[4]))." - ".date('F d, Y', strtotime($result[5])),'<br>';
													echo $result[6],' day(s)</td>';
													//JD-2012/06/20 - Subtracted time to no. of days
													//JD-2013/07/24 - Revised code for getting days.
													echo '<td width="25%">',$result[8],'</td>';
													show_remarks($result[10]);
													echo '<td><span class="label label-',f_color($result[9]),'">',$result[9],'</span></td>';
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
								</div> <!-- table-responsive of leave requests -->
								
								<div class="table-buttons row">
									<?php
										echo '
										<button type="submit" name="deny_lv" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\');">Deny</button>
										<button type="submit" name="approve_lv" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\');">Approve</button>
										';
									?>
								</div>
							</form>
						</div> <!-- panel-body of leave requests -->
				<?php
					if($_SESSION['rights']!=1){
						echo '
					</div> <!-- tab-pane (2) for leave requests -->
					
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
		<script src="js/sb-admin-2.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#leave-applications-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			
			$(document).ready(function() {
				$('#leave-requests-table').dataTable({
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