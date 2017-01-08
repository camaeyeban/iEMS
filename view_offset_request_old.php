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
				$qry = mysql_query("UPDATE ems_offset SET status='Approved' WHERE offset_id='$app' ");
				approve_send_email("offset request", $app, "off");
			}
		}
	}elseif(isset($_POST['deny_off'])){
	$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_offset SET status='Denied' WHERE offset_id='$deny' ");
			}
		}
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
		
		<link rel="icon" href="../images/iEMS2.png">

		<title>iEMS</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

		<script src="js/ie-emulation-modes-warning.js"></script>
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
						<h2 class="summary-title">Old Offset Requests</h2>
						<div class="table-buttons row">
						<?php
							if($_SESSION['rights']==3){
								echo '<a href="view_edit_offset.php?searchby=0&search=&submit=search" class="a upper-link smaller-link-margin"> View My New Offset Requests </a>';
							}else{
								echo '<a href="view_offset_request.php?searchby=0&search=&submit=search#theirs" class="a upper-link smaller-link-margin"> View New Offset Requests </a>';
							}
						?>
						</div>
						<div class="table-buttons row">
							<form name="form_off" action="view_offset_request_old.php?searchby=0&search=&submit=search" method="POST"/>
								<button type="submit" name="deny_off" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'off\');">Deny</button>
								<button type="submit" name="approve_off" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'off\');">Approve</button>
							</form>
							<?php
								if($_SESSION['rights']==1 OR $_SESSION['rights']==2){
									echo '<form name="export" method="post" action="emp_export.php">';
										?>
											<input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
											<input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
											<input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
											<input type="text" name="bman" value="<?php echo $bman ?>" hidden="hidden" />
											<button type="submit" name="export" value="export_offsetBtn" class="export pull-right btn btn-success">Export to Excel</button>
										<?php
									echo '</form>';
								}
							?>
						</div>
						
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="old-offset-request">
								<thead>
									<tr>
										<th class="nosort"> </th>
										<th class="table-column-names">Date Filed</th>
										<th class="table-column-names">Name</th>
										<th class="table-column-names">OT details</th>
										<th class="table-column-names">Accomplishments</th>
										<th class="table-column-names">Offset Date</th>
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
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_filed='$search' " :
														 "b.b_manager_name='$_SESSION[fullname]' AND date_filed='$search'";
												break;

												case 2:
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_firstname LIKE '%$search%' " :
														 "b.b_manager_name='$_SESSION[fullname]' AND emp_firstname LIKE '%$search%'";
												break;
												
												case 3:
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_middlename LIKE '%$search%' " :
														 "b.b_manager_name='$_SESSION[fullname]' AND emp_middlename LIKE '%$search%'";
												break;
												
												case 4:
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_lastname LIKE '%$search%' " :
														 "b.b_manager_name='$_SESSION[fullname]' AND emp_lastname LIKE '%$search%'";
												break;
												
												case 5:
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "(o.date_offset='$search' 
														OR o.date_offset2='$search')" : "b.b_manager_name='$_SESSION[fullname]' AND (o.date_offset='$search' 
														OR o.date_offset2='$search')";
												break;
												
												case 6:
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "o.status='$search' " :
														 "b.b_manager_name='$_SESSION[fullname]' AND o.status='$search'";
												break;
												
												case 0:
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_filed='$search' 
														OR emp_firstname LIKE '%$search%' 
														OR emp_middlename LIKE '%$search%' 
														OR emp_lastname LIKE '%$search%' 
														OR (o.date_offset='$search' 
														OR o.date_offset2='$search') 
														OR o.status='$search'" 
														:
														"b.b_manager_name='$_SESSION[fullname]' AND (date_filed='$search' 
														OR emp_firstname LIKE '%$search%' 
														OR emp_middlename LIKE '%$search%' 
														OR emp_lastname LIKE '%$search%' 
														OR o.date_offset='$search' 
														OR o.date_offset2='$search'
														OR o.status='$search')";
												break;
												//<----- End of modification
											}
										}else{
											$param = $_GET["param"]; //JD-2012/11/19 - Get paramater of the url
											
											$param = stripslashes($param); //JD-2012/11/19 - Used to removed slashes in the parameter
											//JD-2012/11/19 - Replace "1" with "$param" as the default value
											//JD-2013/05/22 - Replaced dept_code='$_SESSION[dept_code]' with b.b_manager_name='$_SESSION[fullname]'
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "1" : "b.b_manager_name='$_SESSION[fullname]'";
										}	

										if($_SESSION['rights']==1){
											if(!$strqry){
												$str = "SELECT o.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, o.date_ot, o.date_ot2, o.ot_hours, 
															o.ot_hours2, accomplishment, o.date_offset, o.date_offset2, o.remarks, o.status, offset_id
															FROM ems_offset as o
															INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num 
															WHERE 1					
															ORDER BY o.offset_id DESC";							
											}else{
												$str = "SELECT o.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, o.date_ot, o.date_ot2, o.ot_hours, 
															o.ot_hours2, accomplishment, o.date_offset, o.date_offset2, o.remarks, o.status, offset_id
															FROM ems_offset as o
															INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num WHERE $strqry					
															ORDER BY o.offset_id DESC";
											}
										}
											   
										//JD-2012/06/25 - Separate Condition for Executive to show only managers' Offset Requests
										elseif($_SESSION['rights']==5){
											//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
											//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
											//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
											$str = "SELECT o.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, o.date_ot, o.date_ot2, 
														o.ot_hours, o.ot_hours2, accomplishment, o.date_offset, o.date_offset2, o.remarks, o.status, offset_id
														FROM ems_offset as o
														INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num 
														INNER JOIN ems_users as ue ON ue.emp_num = e.emp_num
														LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
														WHERE 1 AND (ue.rights=2 OR ue.rights=4)
														ORDER BY o.offset_id DESC";
										}else{
											//JD-2014/09/25 - Added condition e.code != 'EST004'
											//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
											//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
											//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
											$str = "SELECT o.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, o.date_ot, o.date_ot2, 
														o.ot_hours, o.ot_hours2, accomplishment, o.date_offset, o.date_offset2, o.remarks, o.status, offset_id
														FROM ems_offset as o
														INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num
														INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
														LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
														WHERE ($strqry OR (e.dept_code IN($q_oic) AND rights!=2) OR (e.dept_code IN ($q_report) AND rights=2) $man_oic) 
														AND o.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
														ORDER BY o.offset_id DESC";
							
										}
										//echo $str; //For debugging purposes only
										
										$my_variable = 'param='.$strqry; //JD-2012/11/19 - added value to the url named param and concatenate value of $strqry
										$x = "a";
										$qry = mysql_query($str);
										
										while($result = mysql_fetch_array($qry)){
											$name = $result[1]." ".$result[2]." ".$result[3];
											echo '<tr align="center"  class="',$x,'">';
											
											// checkbox column
											chk_stat($result[12], $result[13], "off_man");
											
											// date filed column
											echo '<td width="8%">',$result[0],'</td>';
											
											// name column
											echo '<td>',$name,'</td>';
											
											// ot dates
											//JD-2013/04/19 - modified to show ot_date2 if ot_date is empty or 0000-00-00
											if($result[4]=="0000-00-00" OR $result[4]==""){
												echo '<td width="12%">',date('F d, Y', strtotime($result[5])),'<br/>',dont_show($result[4],""),'<br>';
											}else{
												echo '<td width="12%">',date('F d, Y', strtotime($result[4])),'<br/>',dont_show($result[5],""),'<br>';										
											}
											
											// ot hours
											//JD-2013/04/19 - modified to show ot_hours2 if ot_hours is empty or zero
											if($result[6]==0 OR $result[6]==""){
												echo $result[7],' hour(s) <br>',dont_show("",$result[6]),'</td>';
											}else{
												echo $result[6],' hour(s)<br>',dont_show("",$result[7]),'</td>';									
											}
											
											// accomplishments
											echo '<td>',$result[8],'</td>';
											
											// offset dates
											//JD-2013/05/22 - Condition for Offset date to show offset date2 if offset date1 is empty or 0000-00-00.
											if($result[9]=='0000-00-00'){
												echo '<td width="12%">',date('F d, Y', strtotime($result[10])),'</td>';
											}else if($result[10]=='0000-00-00'){
												echo '<td width="12%">',date('F d, Y', strtotime($result[9])),'</td>';	
											}else{
												echo '<td width="12%">',date('F d, Y', strtotime($result[9])),'</td>';
												//echo '<td>',$result[9],'<br/>',dont_show($result[10],""),'</td>';			
											}
											
											// remarks column
											show_remarks($result[13]);
											
											// status column
											echo '<td><button class="btn btn-',f_color($result[12]),'">',$result[12],'</button></td>';
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
						</div> <!-- table-responsive -->
				
						<div class="table-buttons row">
							<?php
								echo '
									<form name="form_off" action="view_offset_request_old.php?searchby=0&search=&submit=search" method="POST"/>
										<button type="submit" name="deny_off" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'off\');">Deny</button>
										<button type="submit" name="approve_off" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'off\');">Approve</button>
									</form>
								';								
								if($_SESSION['rights']==1 OR $_SESSION['rights']==2){
									echo '<form name="export" method="post" action="emp_export.php">';
										?>
											<input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
											<input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
											<input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
											<input type="text" name="bman" value="<?php echo $bman ?>" hidden="hidden" />
											<button type="submit" name="export" value="export_offsetBtn" class="export pull-right btn btn-success">Export to Excel</button>
										<?php
									echo '</form>';
								}
							?>
						</div>
					</div> <!-- panel-body -->
					
				</div> <!-- col-lg-12 -->
			</div> <!-- container -->
		</form>
	
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
				$('#old-offset-request').dataTable({
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