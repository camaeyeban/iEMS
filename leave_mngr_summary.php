<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	include("ps_pagination.php");
	include("functions.php");
	include("config_DB.php");

	chk_active($_SESSION['user_id']);
	
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	
	if($_SESSION['rights']==2 OR $_SESSION['rights']==3 OR $_SESSION['rights']==5){
			echo '<h1>',"Invalid URL!",'</h1>';
			return false;
	}
	
	//TL-2012/01/20 - Changed $a_data[0] to $_SESSION['rights'].
	$a_qry = mysql_query("SELECT rights FROM ems_users WHERE username='$_SESSION[username]' ");
	$a_data = mysql_fetch_array($a_qry);
	
	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	$q_oic = "''";
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = "'".$row[0]."'";
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
	$s_report = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE report_to='$_SESSION[emp_num]' ");
	//Show applications of one manager in one or more departments
	$q_report = "''";
	while($row = mysql_fetch_array($s_report)){
		$q_report = "'".$row[0]."'";
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
		
		<link rel="icon" href="../images/iEMS2.png">

		<title>iEMS</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/business-units-modal-format.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
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
			
			<div class="col-lg-12">
				
				<div class="panel-body top-bordered col-lg-12">
							
					<h2 class="summary-title">Manager's Leave Summary</h2>
					
					<?php
						if ($_SESSION['rights'] == 5) {
							echo '<a class="a upper-link" href="leave_mngr.php">Apply Leave</a>';
						}
					?>
					
					<div class="table-responsive col-lg-12">
						<table class="table table-striped table-bordered table-hover" id="users-table">
							<thead>
								<tr>
									<th class="nosort"> </th>
									<th class="table-column-names">Date Filed</th>
									<th class="table-column-names">Name</th>
									<th class="table-column-names">From-To</th>
									<th class="table-column-names">Type</th>
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
										switch($by){
											case 1:
												$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "date_filed='$search' " :
													"dept_code='$_SESSION[dept_code]' AND date_filed='$search'";
											break;
											
											case 2:
												$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "(eu.rights=2 OR eu.rights=4) AND emp_firstname LIKE '%$search%' " :
													"dept_code='$_SESSION[dept_code]' AND emp_firstname LIKE '%$search%'";
											break;
											
											case 3:
												$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "(eu.rights=2 OR eu.rights=4) AND emp_middlename LIKE '%$search%' " :
													"dept_code='$_SESSION[dept_code]' AND emp_middlename LIKE '%$search%'";
											break;									
											
											case 4:
												$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "(eu.rights=2 OR eu.rights=4) AND emp_lastname LIKE '%$search%' " :
													"dept_code='$_SESSION[dept_code]' AND emp_lastname LIKE '%$search%'";
											break;
											
											case 5:
												$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "(eu.rights=2 OR eu.rights=4) AND l.type LIKE '%$search%'" : 
													"dept_code='$_SESSION[dept_code]' AND l.type='$search'";
											break;
											
											case 6:
												$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "(eu.rights=2 OR eu.rights=4) AND l.status LIKE '%$search%'" : 
													"dept_code='$_SESSION[dept_code]' AND l.status='$search'";
											break;
											
											case 0:
												$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) 
															? //If not searching, this will be used
														"(eu.rights=2 OR eu.rights=4) AND
															(date_filed='$search' 
															OR emp_firstname LIKE '%$search%' 
															OR emp_middlename LIKE '%$search%' 
															OR emp_lastname LIKE '%$search%' 
															OR l.type='$search'
															OR l.status='$search')" 
															: //If searching this will be used. Same as the ones above
														"(eu.rights=2 OR eu.rights=4) 
															AND (date_filed='$search' 
															OR emp_firstname LIKE '%$search%' 
															OR emp_middlename LIKE '%$search%' 
															OR emp_lastname LIKE '%$search%' 
															OR l.type='$search'
															OR l.status='$search')";
											break;
										}
									}else{
										$param = $_GET["param"]; //JD-2012/11/19 - Get paramater of the url
										$param = stripslashes($param); //JD-2012/11/19 - Used to removed slashes in the parameter
										$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "$param" : "dept_code='$_SESSION[dept_code]'";
											//replace "1" with "$param" as the dsefault value
									}
									//JD-2013/04/23 - Fixed bug regarding search function
									if($_SESSION['rights']==1 OR $_SESSION['rights']==4){
										if(!$strqry){
											$str = "SELECT date_Filed, e.emp_firstname,e.emp_middlename, e.emp_lastname, d_from, d_to, no_of_days, 
														l.type, reason, l.status, leave_id, remarks
														FROM ems_leave as l
														INNER JOIN ems_employee as e
														ON e.emp_num = l.emp_num 
														INNER JOIN ems_users as eu
														ON eu.emp_num=e.emp_num
														WHERE 1 AND remarks LIKE 'sa_%'
														ORDER BY l.leave_id DESC";
										}else{
											$str = "SELECT date_Filed, e.emp_firstname,e.emp_middlename, e.emp_lastname, d_from, d_to, no_of_days, 
														l.type, reason, l.status, leave_id, remarks
														FROM ems_leave as l
														INNER JOIN ems_employee as e
														ON e.emp_num = l.emp_num 
														INNER JOIN ems_users as eu
														ON eu.emp_num=e.emp_num
														WHERE $strqry AND remarks LIKE 'sa_%'
														ORDER BY l.leave_id DESC";
														//add this after (eu.rights=2 OR eu.rights=4): AND $strqry
														// remarks LIKE 'sa_%' - will only display applications applied by sales admin!
										}
									}
									$sCount = strlen($result[12]);
									//JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
									//JD-2012/11/19 - append variable to the pagination function
									$my_variable = 'param='.$strqry;
									//echo $str;
									
									//$conn = connection to database
									//$str = query
									//10 = maximum number of records in a page
									//5 = maximum number of visible pages on the navigation
									//$my_variable = variable that contains the search parameters
									
									$x = "a";
									$qry = mysql_query($str);
									
									while($result = mysql_fetch_array($qry)){	
										echo '<tr align="center" class="',$x,'">';
										
										// checkbox column
										chk_stat($result[9], $result[10], "lv_man");
										
										// date filed column
										echo '<td>',$result[0],'</td>';
										
										// name column
										echo '<td>',$result[1]." ".$result[2]." ".$result[3],'</td>';

										// from-to column
										echo '<td>',date('F d, Y', strtotime($result[4]))." / ".date('F d, Y', strtotime($result[5])),'</td>';
										
										//JD-2012/06/20 - Subtracted time to no. of days
										//JD-2013/04/24 - Displays the complete time instead of subtracting time to no. of days
										
										// type column
										echo '<td>',$result[7],'</td>';
										
										// reason column
										echo '<td>',$result[8],'</td>';
										
										//remarks column
										show_remarks($result[10]);
										
										// status column
										echo '<td><button class="btn btn-',f_color($result[9]),'">',$result[9],'</button></td>';
										echo '</tr>';
										
										if($x=="a"){
											$x = $x . "b";
										}else{
											$x = "a";
										}
									}
									
									if($_SESSION['rights']==1 OR $_SESSION['rights']==2){
										echo '<form name="export" method="post" action="emp_export.php">';
										?>
											<input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
											<input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
											<input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
											<input type="text" name="depcode" value="<?php echo $depcode ?>" hidden="hidden" />
											<!--<input type="submit" name="export" value="export_leaveBtn" class="export">-->
										<?php
										echo '</form>';
									}
								?>
							</tbody>
						</table>
					</div> <!-- table-responsive -->
					
				</div> <!-- panel-body -->
				
			</div> <!-- col-lg-12 -->
		</div> <!-- container -->
		
		
		
		
		<script src="js/jquery.js"></script>
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/docs.min.js"></script>
		<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
		<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#users-table').dataTable({
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