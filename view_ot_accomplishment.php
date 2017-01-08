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
	
	//TL-2012/01/20 - Changed $a_data[0] to $_SESSION['rights'].
	$a_qry = mysql_query("SELECT rights FROM ems_users WHERE username='$_SESSION[username]' ");
	$a_data = mysql_fetch_array($a_qry);
	
	$chk = $_POST['itemChk'];
	if(isset($_POST['approve_ot'])){
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				//JD-2015/06/09 - Removed a.status in the SELECT query
				$qry_stat = mysql_query("SELECT o.status FROM ems_ot as o WHERE o.ot_id='$app'");
				$stat = mysql_fetch_row($qry_stat);
						$qry = mysql_query("UPDATE ems_ot SET status='Approved' WHERE ot_id='$app' ");
						send_email("overtime application", $app, "ot", "approved");
						$qry = mysql_query("SELECT emp_num from ems_ot where ot_id = '$app'");
						$row = mysql_fetch_array($qry);
						$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$app', '".$_SESSION['emp_num']."', 'Approved!', 'created: ".date('m-d-Y h:m A')." A') ");
			}
		}
	}elseif(isset($_POST['deny_ot'])){
		if(sizeof($chk)!=0){
			foreach($chk as $app){
					$qry = mysql_query("UPDATE ems_ot SET status='Denied' WHERE ot_id='$app' ");
					send_email("overtime application", $app, "ot", "denied");
					$qry = mysql_query("SELECT emp_num from ems_ot where ot_id = '$app'");
					$row = mysql_fetch_array($qry);
					$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$app', '".$_SESSION['emp_num']."', 'Denied!', 'created: ".date('m-d-Y h:m A')." D') ");
			}
		}
	}elseif(isset($_POST['cancel_ot'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_ot SET status='Cancelled' WHERE ot_id='$cancel' ");
				$acc = mysql_query("SELECT status FROM ems_accomplishments WHERE ot_id='$cancel' ");
				$result = mysql_result($acc, 0);
				if(!empty($result[0])){
					$qry_acc = mysql_query("UPDATE ems_accomplishments SET status='Cancelled' WHERE ot_id='$cancel' ");
				}
			}
		}
	}

	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	$q_oic = "''";
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = $q_oic.",'".$row[0]."'";
	}
	
	$sman_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b 
								WHERE oic='$_SESSION[emp_num]' AND dept_code = 'DEP-0000' ");
	$cnt = mysql_num_rows($sman_oic);
	if($cnt > 0){
		$man_oic = " OR (rights=2 AND e.emp_num <> $_SESSION[emp_num]) ";
	}else{
		$man_oic = "";
	}
	
	$s_report = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE report_to='$_SESSION[emp_num]' OR b_manager_name = '" . $_SESSION['fullname'] ."'");
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
<!--/JD-2012/11/19 - Fixed problem regarding approve and deny buttons not functioning /-->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	 
<html lang="en">
	
	<head>
	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" href="../icons/icon.png">

        <title>iEMS</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/ie-emulation-modes-warning.js"></script>
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript">
			function open_win(ID, action){
				var left = parseInt((screen.availWidth/2) - (650/2));
				var top = parseInt((screen.availHeight/2) - (320/2));
				window.open("accomplishment.php?ID="+ID+"&action="+action,"_blank","toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=650, height=320");
			}
		</script>
		<script type="text/javascript">
			function app_den(name, action){
				var form;
				var x;
				if(action=="a_ot"){
					action = "Approve";
					form = "overtime";
					x = "request";
				}else if(action=="d_ot"){
					action = "Deny";
					form = "overtime";
					x = "request";
				}else if(action=="a_acc"){
					action = "Approve";
					form = "accomplishment";
					x = "report";
				}else if(action=="d_acc"){
					action = "Deny";
					form = "accomplishment";
					x = "report";
				}
				
				var x = confirm(action+" "+form+" "+x+" of "+name+" ?");
				
				if(x){
					return true;
				}else{
					return false;
				}
            
            return false;
            }
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
				<ul class="nav nav-tabs" role="tablist" >
					<li role="presentation"><a href="#mine" aria-controls="mine" role="tab" data-toggle="tab">My Overtime Applications</a></li>
					<li role="presentation"><a href="#theirs" aria-controls="theirs" role="tab" data-toggle="tab">Overtime Requests and Accomplishments</a></li>
				</ul>
				
				<div class="tab-content">
					
					<div role="tabpanel" class="tab-pane active" id="mine">
			
						<div class="panel-body col-lg-12">
							<form name="form_view_ot" action="view_ot_accomplishment.php?searchby=0&search=&submit=search" method="POST">
			
								<div class="table-buttons row">
									<a href="ot.php" class="a upper-link tabbed zero-bottom-margin">Apply Overtime</a>
								</div>
								<div class="table-buttons row">
									<button type="submit" name="cancel_ot" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'ot\');">Cancel</button>
								</div>
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="overtime-requests-and-accomplishment">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Details</th>
												<th class="table-column-names">Day Classification</th>
												<th class="table-column-names">Expected Output</th>
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
																$strqry = "ot.emp_num='$_SESSION[emp_num]' AND ot.date_filed='$search'";												 							
														break;

														case 2:
																$strqry = "ot.emp_num='$_SESSION[emp_num]' AND ot.date_ot='$search'";
														break;			

														case 3:
																$strqry = "ot.emp_num='$_SESSION[emp_num]' AND ot.status='$search'";
														break;	
														
														case 0:
																$strqry = "ot.emp_num='$_SESSION[emp_num]' AND (ot.date_filed='$search' OR ot.date_ot LIKE '%$search%' OR ot.status LIKE '%$search%')";
														break;												
													}
												}else{
													$strqry = "ot.emp_num='$_SESSION[emp_num]'";
												}
											
												$str = "SELECT ot.ot_id, ot.date_ot, ot.no_of_hours, ot.cdc, ot.expected_output, ot.status, ot.remarks, ot.date_Filed, ot.time_start, ot.time_end
															FROM ems_ot as ot
															WHERE $strqry
															ORDER BY ot.ot_id DESC";
												$x = "a";
												$old = '';
												$qry = mysql_query($str);
												
												while($result = mysql_fetch_array($qry)){
													if($old != $result[0]){
														echo '<tr align="center" class="',$x,'">';
														
														// checkbox column
														chk_stat($result[5], $result[0], "ot");
														
														// date filed column
														edit_app($result[5], $result[0], "ot_edit", $result[1]);
														$old = $result[0];
														
														// details column (date_ot)
														echo '<td width="12%">',date('F d, Y', strtotime($result[1]));
														
														// details column (start time - end time)
														if($result[8] != NULL && $result[9] != NULL)
															echo '<br>', $result[8],' - ', $result[9];
															
														// details column (no. of hours)
														echo '<br>',$result[2],' hour(s)</td>';
														
														// day classification column
														if($result[3] == 1){
															$result[3] = "Regular Day";
														}else if($result[3] == 2){
															$result[3] = "Rest Day/ Special Public Holiday";
														}else if($result[3] == 3){
															$result[3] = "Special Public Holiday on Rest Day";
														}else if($result[3] == 4){
															$result[3] = "Regular Holiday";
														}else if($result[3] == 5){
															$result[3] = "Regular Holiday on Rest Day";
														}
														echo '<td>',$result[3]	,'</td>';
														
														// expected output column
														echo '<td width="30%">',$result[4],'</td>';
														
														// remarks column
														show_remarks($result[0]);
														
														// status column
														echo '<td><button class="btn btn-',f_color($result[5]),'">',$result[5],'</button></td>';
														echo '</tr>';
														   
														if($x=="a"){
															$x = $x . "b";
														}else{
															$x = "a";
														}
													}
												}
											
						echo '
										</tbody>
									</table>
								</div> <!-- table-responsive of my undertime applications -->
								
								<div class="table-buttons row">
						';
									
									echo '<button type="submit" name="cancel_ot" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'ot\');">Cancel</button>';
						echo '
								</div>
								
							</form>
						</div> <!-- panel-body of my undertime applications -->
					</div> <!-- tab-pane (1) for my undertime applications -->
					
					<div role="tabpanel" class="tab-pane active" id="theirs">
		
						<div class="panel-body col-lg-12">
							<div class="table-buttons row">
								<button type="submit" name="deny_ot" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'ot\');">Deny</button>
								<button type="submit" name="approve_ot" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'ot\');">Approve</button>
							</div>
					';
					}
					else{
						echo '
						<div class="panel-body top-bordered col-lg-12">
							<div class="table-buttons row">
								<h2 class="summary-title">Overtime Requests and Accomplishments</h2>
								<button type="submit" name="deny_ot" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'ot\');">Deny</button>
								<button type="submit" name="approve_ot" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'ot\');">Approve</button>
							</div>
						';
					}
				?>
							<form name="form_view_ot" action="view_ot_accomplishment.php?searchby=0&search=&submit=search" method="post">
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="ot_accomplishments">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Name</th>
												<th class="table-column-names">Details</th>
												<th class="table-column-names">Day Classification</th>
												<th class="table-column-names">Expected Output</th>
												<th class="table-column-names">Remarks</th>
												<th class="table-column-names">Status</th>
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
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "ot.date_filed='$search' " :
																"b.b_manager_name='$_SESSION[fullname]' AND ot.date_filed='$search'";
														break;

														case 2:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_ot='$search' " :
																"b.b_manager_name='$_SESSION[fullname]' AND date_ot='$search'";
														break;
														
														case 3:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_firstname LIKE '%$search%' " :
																"b.b_manager_name='$_SESSION[fullname]' AND emp_firstname LIKE '%$search%'";
														break;

														case 4:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_middlename LIKE '%$search%' " :
																"b.b_manager_name='$_SESSION[fullname]' AND emp_middlename LIKE '%$search%'";
														break;
														
														case 5:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_lastname LIKE '%$search%' " :
																"b.b_manager_name='$_SESSION[fullname]' AND emp_lastname LIKE '%$search%'";
														break;

														case 6:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "ot.status='$search' " :
																"b.b_manager_name='$_SESSION[fullname]' AND ot.status='$search'";
														break;

														//JD-2015/06/09 - Removed searching by accomplishment
														/*case 7:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "a.status='$search' " :
																"b.b_manager_name='$_SESSION[fullname]' AND a.status='$search'";
														break;*/

														case 0:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "ot.date_filed='$search' 
																OR date_ot='$search' 
																OR emp_firstname LIKE '%$search%' 
																OR emp_middlename LIKE '%$search%' 
																OR emp_lastname LIKE '%$search%' 
																OR ot.status='$search'" 
																:
																//replaced dept_code='$_SESSION[dept_code]' with b.b_manager_name='$_SESSION[fullname]'
																"b.b_manager_name='$_SESSION[fullname]' AND (ot.date_filed='$search' 
																OR date_ot='$search' 
																OR emp_firstname LIKE '%$search%' 
																OR emp_middlename LIKE '%$search%' 
																OR emp_lastname LIKE '%$search%' 
																OR ot.status='$search')";
														break;
														//<---- End of Modification
													}
												}else{
													$param = $_GET["param"]; //JD-2012/11/19 - Get paramater of the url
													$param = stripslashes($param); //JD-2012/11/19 - Used to removed slashes in the parameter
													//JD-2012/11/19 - Replace "1" with "$param" as the default value
													//JD-2013/05/22 - Replaced dept_code='$_SESSION[dept_code]' with b.b_manager_name='$_SESSION[fullname]'
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "$param" : "b.b_manager_name='$_SESSION[fullname]'";
												}
												
												if($_SESSION['rights']==1){
													//JD-2012/11/19 - Condition checks if variable $strqry has a value, if none, it will show all records.
													if(!$strqry){
														$str = "SELECT ot.ot_id, ot.date_filed, e.emp_firstname, e.emp_lastname, ot.status, e.emp_middlename,
																	date_ot, no_of_hours, cdc, expected_output, time_start, time_end
																	FROM ems_ot as ot 
																	JOIN ems_employee as e ON e.emp_num = ot.emp_num 
																	WHERE 1
																	ORDER BY case
																				when ot.status = 'Pending' then 1
																				when ot.status = 'Approved' then 2
																				when ot.status = 'Denied' then 3
																				else 1000
																			 end asc, ot.ot_id DESC";
													}else{
														$str = "SELECT ot.ot_id, ot.date_filed, e.emp_firstname, e.emp_lastname, ot.status, e.emp_middlename,
																	date_ot, no_of_hours, cdc, expected_output, time_start, time_end 
																	FROM ems_ot as ot 
																	JOIN ems_employee as e ON e.emp_num = ot.emp_num 
																	WHERE $strqry
																	ORDER BY case
																				when ot.status = 'Pending' then 1
																				when ot.status = 'Approved' then 2
																				when ot.status = 'Denied' then 3
																				else 1000
																			 end asc, ot.ot_id DESC";
													}
												}

												//JD-2012/06/25 - Separate Condition for Executive to show only managers' Overtime request and accomplishments
												//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
												elseif($_SESSION['rights']==5){
													$str = "SELECT ot.ot_id, ot.date_filed, e.emp_firstname, e.emp_lastname, ot.status, e.emp_middlename,
																date_ot, no_of_hours, cdc, expected_output, time_start, time_end 
																FROM ems_ot as ot
																JOIN ems_employee as e ON e.emp_num = ot.emp_num
																JOIN ems_users as ue ON ue.emp_num = e.emp_num
																LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code 
																WHERE 1 AND (ue.rights=2 OR ue.rights=4)
																ORDER BY case
																				when ot.status = 'Pending' then 1
																				when ot.status = 'Approved' then 2
																				when ot.status = 'Denied' then 3
																				else 1000
																			 end asc, ot.ot_id DESC";
												}else{
													//JD-2014/09/25 - Added condition e.code != 'EST004'
													//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
													//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
													//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
													$str = "SELECT ot.ot_id, ot.date_filed, e.emp_firstname, e.emp_lastname, ot.status, e.emp_middlename,
																date_ot, no_of_hours, cdc, expected_output, time_start, time_end
																FROM ems_ot as ot 
																INNER JOIN ems_employee as e ON e.emp_num = ot.emp_num
																INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
																LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
																WHERE ($strqry OR (e.dept_code IN ($q_oic) AND rights!=2) 
																OR (e.dept_code IN ($q_report) AND rights=2) $man_oic) AND ot.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
																ORDER BY case
																			when ot.status = 'Pending' then 1
																			when ot.status = 'Approved' then 2
																			when ot.status = 'Denied' then 3
																			else 1000
																		 end asc, ot.ot_id DESC";
												}
												//echo $str;

												$my_variable = 'param='.$strqry; //JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
												$x = "a";
												$qry = mysql_query($str);
												
												while($result = mysql_fetch_array($qry)){
													$name = $result[2]." ".$result[5]." ".$result[3];
													echo '<tr align="center" class="',$x,'">';
													
													// checkbox column
													chk_stat($result[4], $result[0], "ot_man");
													
													// date filed column
													echo '<td width="8%">',$result[1],'</td>';
													
													// name column
													echo '<td>',$name,'</td>';
													
													// details column (date_ot)
													echo '<td width="12%">', date('F d, Y', strtotime($result[6])), '<br>';
													
													// details column (start time - end time)
													if($result[10] != null && $result[11] != null){
														echo $result[10], ' - ', $result[11], '<br>'; 
													}
													
													// number of hours
													echo $result[7], ' hour(s)</td>';
													
													// day classification column
													if($result[8] == 1){
														$result[8] = "Regular Day";
													}else if($result[8] == 2){
														$result[8] = "Rest Day/ Special Public Holiday";
													}else if($result[8] == 3){
														$result[8] = "Special Public Holiday on Rest Day";
													}else if($result[8] == 4){
														$result[8] = "Regular Holiday";
													}else if($result[8] == 5){
														$result[8] = "Regular Holiday on Rest Day";
													}
													echo '<td width="7%">',$result[8],'</td>';
													
													// expected output column
													echo '<td width="20%">',$result[9],'</td>';
													
													// remarks column
													show_remarks($result[0]);
													
													// status column
													echo '<td><span class="label label-',f_color($result[4]),'">',$result[4],'</span></td>';	//status
													
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
								</div> <!-- table-responsive of undertime requests -->
								
								<div class="table-buttons row">
									<?php
										echo '
										<button type="submit" name="deny_ot" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'ot\');">Deny</button>
										<button type="submit" name="approve_ot" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'ot\');">Approve</button>
										';
									?>
								</div>
								
							</form>
						</div> <!-- panel-body of undertime requests -->
				<?php
					if($_SESSION['rights']!=1){
						echo '
					</div> <!-- tab-pane (2) for undertime requests -->
					
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
				$('#ot_accomplishments').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			$(document).ready(function() {
				$('#overtime-requests-and-accomplishment').dataTable({
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