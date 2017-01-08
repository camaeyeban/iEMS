<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	include("config_DB.php");
	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();
	if (!$dblink)
		die("no connection");
	include("functions.php");
	chk_active($_SESSION['user_id']);
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	if($_SESSION['rights']==3){
		echo '<h1>',"Invalid URL",'</h1>';
		return false;
	}
	
	//finding the OIC department
	//$s_oic = mysql_query("SELECT oic FROM ems_business_units AS b WHERE dept_code='$_SESSION[dept_code]' ");
	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	//TL-2012/04/15 - Revised to accomodate one user being an OIC in one or more departments.
	//$q_oic = mysql_fetch_array($s_oic);
	$q_oic = "''";
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = $q_oic.",'".$row[0]."'";
	}
	
	//TL-2012/04/15 - Added to check if user is an OIC of the Managers (DEP-0000).
	//TL-2012/04/16 - Added condition not to include the applications of the OIC itself.
	$sman_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' AND dept_code = 'DEP-0000' ");
	$cnt = mysql_num_rows($sman_oic);
	if($cnt > 0){
		$man_oic = " OR (rights=2 AND e.emp_num <> $_SESSION[emp_num]) ";
	}else{
		$man_oic = "";
	}
	
	//finding the report to department
	$s_report = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE report_to='$_SESSION[emp_num]' OR b_manager_name = '" . $_SESSION['fullname'] ."'"); //should get all users as managers
	//JD-2012/09/20 - Revised to accommodate one manager in one or more departments
	//$q_report = mysql_fetch_array($s_report);
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
	
	//JD-2015/06/02 - Added to get all the department of the manager
	$deptCode = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE b_manager_name='$_SESSION[emp_num]' ");
	$dept_report = "''";
	while($row = mysql_fetch_array($deptCode)){
		$dept_report = $dept_report.",'".$row[0]."'";
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	
<html lang="en">

    <head>
	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="icons/icon.png">

		<title>iEMS</title>
		
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript">
            function info(ID){
                window.open("view_edit_personal.php?ID="+ID,"_self");
            }
        </script>
		
    </head>
	
	
    <body alink="blue" vlink="blue" link="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
        
		<?php include("menu.php"); ?>
		
		<div id="container">
			<br/>
			<div class="col-lg-12">
				
				<div class="panel-body top-bordered col-lg-12">

					<h2 class="summary-title">Employee Records</h2>
					
					<?php
						if($_SESSION['rights']==1){
							echo '
								<div class="table-buttons row">
									<a href = "resigned_emp_info.php" class = "upper-link smaller-link-margin">View Resigned/Terminated Employees</a>
								</div>
								<div class="table-buttons row">
									<button type="submit" class="add btn btn-primary" onclick="window.location = \'add_emp.php\'">Add Employee</button>
								</div>
							';
						}
					?>
					
					<div class="table-responsive col-lg-12">
						<table class="table table-striped table-bordered table-hover" id="employee-information-table">
							<thead>
								<tr>
									<th class="table-column-names">Employee No.</th>
									<th class="table-column-names">Employee Name</th>
									<th class="table-column-names">Job Title</th>
									<th class="table-column-names">Employment Status</th>
									<th class="table-column-names">Department</th>
									<th class="table-column-names">Manager</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$by = $_POST['searchby'];
									$search = $_POST['search'];
									$sort = 1;
									if(isset($_POST['sort']))
										$sort = $_POST['sort'];
									
									if(isset($_POST['submit']) && $_POST['submit']=="search"){
										//--> JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' to get only list
										//			of employees under that manager
										//--> JD-2014/03/05 - Revert back b.b_manager_name='$_SESSION[fullname]' to dept_code='$_SESSION[dept_code]'
										switch($by){
											case 1:
												$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? " e.emp_num='$search'" :  " e.emp_num='$search' AND
													e.dept_code='$_SESSION[dept_code]'";
												break;
											case 2:
												$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? " e.emp_lastname LIKE '%$search%'" : " e.emp_lastname LIKE
													'%$search%' AND e.dept_code='$_SESSION[dept_code]'";
												 break;
											case 3:
												$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? " e.emp_firstname LIKE '%$search%'" : " e.emp_firstname LIKE
													'%$search%' AND e.dept_code='$_SESSION[dept_code]'";
												 break;
											case 4:
												$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? " e.emp_middlename LIKE '%$search%'" : " e.emp_middlename AND
													e.dept_code='$_SESSION[dept_code]'";
												  break;
											case 5:
												$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? " job_title_name='$search'" : " job_title_name='$search' AND
													e.dept_code='$_SESSION[dept_code]'";
												 break;
											case 6:
												$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? " name='$search'" : " name='$search%' AND
													e.dept_code='$_SESSION[dept_code]'";																			
												 break;
											case 7:
												$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? " dept_name='$search'" : " dept_name='$search' AND
													e.dept_code='$_SESSION[dept_code]'";																			
												 break;
											case 0:
												//JD-2015/06/02 - Removed condition : AND e.dept_code='$_SESSION[dept_code]'";
												$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "e.emp_num='$search' 
													OR e.emp_lastname LIKE '%$search%' OR e.emp_firstname LIKE '%$search%' OR e.emp_middlename LIKE '%$search%' 
													OR job_title_name='$search' OR name='$search' OR dept_name='$search' AND e.dept_code='$_SESSION[dept_code]'" 
													:
													"(e.emp_num='$search' OR e.emp_lastname LIKE '%$search%' OR e.emp_firstname LIKE '%$search%' 
													OR e.emp_middlename LIKE '%$search%' OR job_title_name='$search' OR name='$search' OR dept_name='$search') ";
													
												break;
											//<---END of modification
										}
									}else{
										//JD-2013/05/22 - Replaces e.dept_code='$_SESSION[dept_code]' with b.b_manager_name ='$_SESSION[fullname]'
										//JD-2014/03/05 - Revert back
										//JD-2015/06/02 - Modified
										if ($_SESSION['rights']==1 OR $_SESSION['rights']==5) {
											$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "1" : "e.dept_code='$_SESSION[dept_code]' AND e.emp_num!=1";
										}elseif($_SESSION['rights']==2){
											$str = "1";
										}
										//$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "1" : "e.dept_code='$_SESSION[dept_code]' AND e.emp_num!=1";
										//$str = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "1" : "b.b_manager_name ='$_SESSION[fullname]'";
									}

									if($_SESSION['rights']==1 || $_SESSION['rights']==5){ //Admin and Executive
										$strqry = "SELECT e.emp_num, CONCAT(e.emp_lastname,', ',e.emp_firstname,' y ',e.emp_middlename), j.job_title_name, s.name,
														d.dept_name, b.b_manager_name 
														FROM ems_employee AS e 
														LEFT JOIN ems_jobtitle AS j ON e.job_title_code = j.job_title_code
														LEFT JOIN ems_emp_status AS s ON e.code = s.code
														LEFT JOIN ems_department AS d ON e.dept_code = d.dept_code
														LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id 
														WHERE $str AND (e.emp_num!=1) ORDER BY $sort";
									}

									//JD-2014/09/25 - Added condition e.code != 'EST004'. Do not show resigned employees
									elseif($_SESSION['rights']==2){ //Manager
									//JD-2012/09/24 - Fixed to display employee/s of "report to" and "oic" of managers
										$strqry = "SELECT e.emp_num, CONCAT(e.emp_lastname,', ',e.emp_firstname,' y ',e.emp_middlename), j.job_title_name, s.name,
														d.dept_name, b.b_manager_name
														FROM ems_employee AS e 
														LEFT JOIN ems_jobtitle AS j ON e.job_title_code = j.job_title_code
														LEFT JOIN ems_emp_status AS s ON e.code = s.code
														LEFT JOIN ems_department AS d ON e.dept_code = d.dept_code
														LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
														LEFT JOIN ems_users AS u ON u.emp_num = e.emp_num 
														WHERE $str AND e.emp_num!=1
														AND (e.dept_code IN ($q_report) ) ORDER BY $sort";
									}

									//echo $strqry;
									if(!mysql_query($strqry))
										die("ERROR : " . mysql_error() . "<br/> qry : " . $strqry);
										
										$qry = $dblink->db_qry($strqry);
										
										$x = "a";
										$row = $dblink->row_count($qry);
								
									while($data = $dblink->get_data($qry)){
										if($data[0] != 1 && $data[3] != 'Resigned' && $data[3] != 'Terminated'){
											echo '<tr align="center" class="',$x,'">';
											echo '<td>',$data[0],'</td>';							
											echo '<td><a href="#" onclick="info(',$data[0],');">',$data[1],'</a></td>';
											echo '<td>',$data[2],'</td>';
											echo '<td>',$data[3],'</td>';
											echo '<td>',$data[4],'</td>';
											echo '<td>',$data[5],'</td>';														
											echo '</tr>';
											if($x=="a"){
												$x = $x . "b";
											} else {
												$x = "a";
											}	
										}
									}
								?>
							</tbody>
						</table>
					</div> <!-- table-responsive -->
					
				</div> <!-- panel-body -->
				
			</div> <!-- col-lg-12 -->
		</div> <!-- container -->
		
		
		<?php include("footer.php"); ?>
		
		
		
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
				$('#employee-information-table').dataTable();
			});
		</script>
		
    </body>
	
</html>