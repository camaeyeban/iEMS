<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	include("functions.php");
	include("config_DB.php");

	chk_active($_SESSION['user_id']);

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

	if(isset($_POST['approve_un'])){
		$chk = $_POST['itemChk2'];
		if(sizeof($chk)!=0){
			foreach($chk as $apps){
				$qry = mysql_query("UPDATE ems_undertime SET status='Approved' WHERE un_id='$apps' ");
				send_email("undertime application", $apps, "un","approved") ;
				$qry = mysql_query("SELECT emp_num from ems_undertime where un_id = '$apps'");
				$row = mysql_fetch_array($qry);
				$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$apps', '".$_SESSION['emp_num']."', 'Approved!', 'created: ".date('m-d-Y h:m A')."') ");
			
			}
		}
	}elseif(isset($_POST['deny_un'])){
		//JD-2012/10/01 - Changed from 'itemChk0' to 'itemChk2'
		$chk = $_POST['itemChk2']; 
		if(sizeof($chk)!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_undertime SET status='Denied' WHERE un_id='$deny' ");
				send_email("undertime application", $deny, "un","denied") ;
				$qry = mysql_query("SELECT emp_num from ems_undertime where un_id = '$deny'");
				$row = mysql_fetch_array($qry);
				$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$deny', '".$_SESSION['emp_num']."', 'Denied!', 'created: ".date('m-d-Y h:m A')." D') ");
			
			}
		}
	}elseif(isset($_POST['cancel_un'])){
		$chk = $_POST['itemChk2'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_undertime SET status='Cancelled' WHERE un_id='$cancel' ");
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
					<li role="presentation"><a href="#mine" aria-controls="mine" role="tab" data-toggle="tab">My Undertime Applications</a></li>
					<li role="presentation"><a href="#theirs" aria-controls="theirs" role="tab" data-toggle="tab">Undertime Requests</a></li>
				</ul>
				
				<div class="tab-content">
		
					<div role="tabpanel" class="tab-pane active" id="mine">
		
						<div class="panel-body col-lg-12">
							<form name="form_under" action="view_undertime_summary.php" method="POST">
								
								<div class="table-buttons row">
									<a href="leave_undertime.php?ID=&action=under" class="a upper-link tabbed zero-bottom-margin">Apply Undertime</a>
								</div>
								<div class="table-buttons row">
									<button type="submit" name="cancel_un" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'un\');">Cancel</button>
								</div>
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="undertime-applications-table">
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
											
												$by1 = $_POST['searchby1'];
												$search1 = $_POST['search1'];
												if(isset($_POST['submit']) && $_POST['submit']=="search_un"){				
													switch($by1){
														case 1:	
																$strqry = "emp_num='$_SESSION[emp_num]' AND date_filed='$search1'";								
														break;

														case 2:	
																$strqry = "emp_num='$_SESSION[emp_num]' AND date_un='$search1'";										
														break;

														case 3:	
																$strqry = "emp_num='$_SESSION[emp_num]' AND nature_un='$search1'";								
														break;

														case 4:	
																$strqry = "emp_num='$_SESSION[emp_num]' AND status='$search1'";								
														break;

														case 0:	
																$strqry = "(emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search1%') 
																		OR (emp_num='$_SESSION[emp_num]' AND nature_un LIKE '%$search1%') 
																		OR (emp_num='$_SESSION[emp_num]' AND date_un LIKE '%$search1%') 
																		OR (emp_num='$_SESSION[emp_num]'  AND status LIKE '%$search1%')";																		
														break;
													}
												}else{
													$strqry = "emp_num='$_SESSION[emp_num]'";
												}
												
												$str = "SELECT date_Filed, date_un, nature_un, time, reason, status, un_id, remarks 
															FROM ems_undertime
															WHERE $strqry
															ORDER BY un_id DESC";			
												//echo $str;
												
												$x = "a";				
												$cnt = 1;
												$qry = mysql_query($str);
						
												while($result = mysql_fetch_array($qry)){
													echo '<tr align="center" class="',$x,'">';
													// chk_stat($result[5],$result[6],"cchk".$cnt);
													chk_stat($result[5],$result[6], "un");
													edit_app($result[5],$result[6],"undr_edit",$result[0]);
													echo '<td>',date('F d, Y', strtotime($result[1])),', ';
													echo $result[3],'<br>';						
													echo $result[2],'</td>';
													echo '<td>',$result[4],'</td>';		
													show_remarks($result[6]);
													echo '<td><button class="btn btn-',f_color($result[5]),'">',$result[5],'</button></td>';
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
								</div> <!-- table-responsive for undertime summary -->
								
								<div class="table-buttons row">
						';
									
									echo '<button type="submit" name="cancel_un" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'un\');">Cancel</button>';
									
						echo '
								</div>
							</form>
						</div> <!-- panel-body of leave summary -->
					</div> <!-- tab-pane (1) for leave summary -->
					

	<!--/--------------------------------------------------------Undertime Requests--------------------------------------------------------/-->

					<div role="tabpanel" class="tab-pane active" id="theirs">
						
						<div class="panel-body col-lg-12">
							<div class="table-buttons row">
								<button type="submit" name="deny_un" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'un\');">Deny</button>
								<button type="submit" name="approve_un" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'un\');">Approve</button>
							</div>
						';
					}
					else{
						echo '
						<div class="panel-body top-bordered col-lg-12">
							<div class="table-buttons row">
								<h2 class="summary-title">Undertime Requests</h2>
								<button type="submit" name="deny_un" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'un\');">Deny</button>
								<button type="submit" name="approve_un" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'un\');">Approve</button>
							</div>
						';
					}
				?>
							<form name="form_under" action="view_undertime_summary.php?searchby=0&search=&submit=search_lv" method="POST">
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="undertime-requests-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Requested By</th>
												<th class="table-column-names">Details</th>
												<th class="table-column-names">Reason</th>
												<th class="table-column-names">Remarks</th>
												<th class="table-column-names">Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
											   $by1 = $_POST['searchby1'];
											   $search1 = $_POST['search1'];
													if(isset($_POST['submit']) && $_POST['submit']=="search_un"){
														//--> JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]'		
														switch($by1){
															case 1:
																$strqry1 = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_filed='$search1' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND date_filed='$search1'";
															break;
					
															case 2:
																$strqry1 = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_firstname LIKE '%$search1%' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND emp_firstname LIKE '%$search1%'";
															break;
					
															case 3:
																$strqry1 = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_middlename LIKE '%$search1%' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND emp_middlename LIKE '%$search1%'";
															break;
															
															case 4:
																$strqry1 = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_lastname LIKE '%$search1%' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND emp_lastname LIKE '%$search1%'";
															break;
					
															case 5:
																$strqry1 = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_un='$search1' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND date_un='$search1'";
															break;
					
															case 6:
																$strqry1 = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "nature_un='$search1' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND nature_un='$search1'";
															break;
					
															case 7:
																$strqry1 = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "u.status='$search1' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND u.status='$search1'";
															break;
					
															case 0:
																$strqry1 = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_filed='$search1' 
																	OR emp_firstname LIKE '%$search1%' 
																	OR emp_middlename LIKE '%$search1%' 
																	OR emp_lastname LIKE '%$search1%' 
																	OR date_un='$search1' 
																	OR nature_un='$search1' 
																	OR u.status='$search1'" 
																	: 
																	"b.b_manager_name='$_SESSION[fullname]' AND (date_filed='$search1' 
																	OR emp_firstname LIKE '%$search1%' 
																	OR emp_middlename LIKE '%$search1%' 
																	OR emp_lastname LIKE '%$search1%' 
																	OR date_un='$search1' 
																	OR nature_un='$search1' 
																	OR u.status='$search1')";
															break;
															//<--- END of modification
														}
													}else{
														$param1 = $_GET["param1"]; //JD-2013/01/07 - Get paramater of the url
														$param1 = stripslashes($param1); //JD-2013/01/07 - Used to removed slashes in the parameter
														//JD-2013/05/22 - Replaced dept_code='$_SESSION[dept_code]' with b.b_manager_name='$_SESSION[fullname]'
														$strqry1 = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "$param1" : "b.b_manager_name='$_SESSION[fullname]'" ;
														/*$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "1" : "dept_code='$_SESSION[dept_code]'";*/
													}

													//Administrator
													if($_SESSION['rights']==1){ // || $_SESSION['rights']==5){
														if(!$strqry1){
															$str = "SELECT date_Filed, e.emp_firstname,e.emp_middlename, e.emp_lastname, date_un, nature_un, reason,
																u.status, un_id, remarks, time
																FROM ems_undertime as u
																INNER JOIN ems_employee as e ON e.emp_num = u.emp_num WHERE 1
																ORDER BY case
																					when u.status = 'Pending' then 1
																					when u.status = 'Approved' then 2
																					when u.status = 'Denied' then 3
																					else 1000
																				 end asc, u.un_id DESC";
														}else{
															$str = "SELECT date_Filed, e.emp_firstname,e.emp_middlename, e.emp_lastname, date_un, nature_un, reason,
																u.status, un_id, remarks, time
																FROM ems_undertime as u
																INNER JOIN ems_employee as e ON e.emp_num = u.emp_num WHERE $strqry1
																ORDER BY case
																					when u.status = 'Pending' then 1
																					when u.status = 'Approved' then 2
																					when u.status = 'Denied' then 3
																					else 1000
																				 end asc, u.un_id DESC";
														}
													}

													//JD-2012/06/25 - Separate Condition for Executive to show only managers' undertime applications
													elseif($_SESSION['rights']==5){
														$str = "SELECT date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, date_un, nature_un, reason,
															u.status, un_id, remarks, time
															FROM ems_undertime as u
															INNER JOIN ems_employee as e ON e.emp_num = u.emp_num 
															INNER JOIN ems_users as eu ON eu.emp_num=e.emp_num
															WHERE (rights=2 OR rights=4) AND (eu.rights=2 OR eu.rights=4)
															ORDER BY case
																					when u.status = 'Pending' then 1
																					when u.status = 'Approved' then 2
																					when u.status = 'Denied' then 3
																					else 1000
																				 end asc, u.un_id DESC";
													}

													//Manager
													else{	
														if(!$strqry1){
															//JD-2014/09/25 - Added condition e.code != 'EST004'
															//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
															//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
															//JD-2014/03/18 - Replaced b.b_id = e.b_id with b.dept_code = e.dept_code
															$str = "SELECT date_Filed, e.emp_firstname,e.emp_middlename, e.emp_lastname, date_un, nature_un, reason,
																		u.status, un_id, remarks, time
																		FROM ems_undertime as u
																		INNER JOIN ems_employee as e ON e.emp_num = u.emp_num
																		INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
																		LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
																		WHERE (b.b_manager_name='$_SESSION[fullname]' OR (e.dept_code IN($q_oic) AND rights!=2) 
																		OR (e.dept_code IN ($q_report) AND rights=2) $man_oic) AND u.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
																		ORDER BY case
																					when u.status = 'Pending' then 1
																					when u.status = 'Approved' then 2
																					when u.status = 'Denied' then 3
																					else 1000
																				 end asc, u.un_id DESC";
														}else{
															//JD-2014/09/25 - Added condition e.code != 'EST004'
															//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
															//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
															$str = "SELECT date_Filed, e.emp_firstname,e.emp_middlename, e.emp_lastname, date_un, nature_un, reason,
																		u.status, un_id, remarks, time
																		FROM ems_undertime as u
																		INNER JOIN ems_employee as e ON e.emp_num = u.emp_num
																		INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
																		LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
																		WHERE ($strqry1 OR (e.dept_code IN($q_oic) AND rights!=2) 
																		OR (e.dept_code IN ($q_report) AND rights=2) $man_oic)
																		AND u.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
																		ORDER BY case
																					when u.status = 'Pending' then 1
																					when u.status = 'Approved' then 2
																					when u.status = 'Denied' then 3
																					else 1000
																				 end asc, u.un_id DESC";
														}
													}
													//echo $str; //for debugging purposes only

													//$my_variable = 'param='.$strqry;
													//$pager = new PS_Pagination($conn, $str, 10, 5, $my_variable);

													$my_variable = 'param1='.$strqry1; //JD-2013/01/07 - add value to the url named param and concatenate value of $strqry
													$qry = mysql_query($str);
															
													while($result = mysql_fetch_array($qry)){	
														echo '<tr align="center" class="',$x,'">';
														//JD-2012/10/01 - Changed chk_stat($result[7], $result[8] to chk_stat($result[8], $result[9]
														chk_stat($result[7], $result[8], "un_man");
														echo '<td width="8%">',$result[0],'</td>';
														echo '<td>',$result[1]." ".$result[2]." ".$result[3],'</td>';
														echo '<td width="15%">Left: ',$result[4],', ';
														echo $result[10],'<br>';
														echo $result[5],'</td>';
														echo '<td width="30%">',$result[6],'</td>';
														show_remarks($result[8]);
														echo '<td><span  class="label label-',f_color($result[7]),'">',$result[7],'</span ></td>';
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
								</div> <!-- table-responsive for undertime summary -->
							
								<div class="table-buttons row">
									<?php
										echo '
										<button type="submit" name="deny_un" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'un\');">Deny</button>
										<button type="submit" name="approve_un" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'un\');">Approve</button>
										';
									?>
								</div>
							</form>
						</div> <!-- panel-body of undertime summary -->
				
				<?php
					if($_SESSION['rights']!=1){
						echo '
					</div> <!-- tab-pane (2) for undertime summary -->
					
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
				$('#undertime-applications-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			$(document).ready(function() {
				$('#undertime-requests-table').dataTable({
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