<?php
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
	
	if(isset($_POST['approve_ob'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				$qry = mysql_query("UPDATE ems_ob_new SET status='Approved' WHERE ob_id='$app' ");
				send_email("official business application", $app, "ob","approved");
				$qry = mysql_query("SELECT emp_num from ems_ob_new where ob_id = '$apps'");
				$row = mysql_fetch_array($qry);
				$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$apps', '".$_SESSION['emp_num']."', 'Approved!', 'created: ".date('m-d-Y h:m A')." A') ");
			}
		}
	}elseif(isset($_POST['conf_ob'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $conf){
				$qry = mysql_query("UPDATE ems_ob_new SET status='Confirmed' WHERE ob_id='$conf' ");
				send_email("official business application", $conf, "ob","confirmed");
				$qry = mysql_query("SELECT emp_num from ems_ob_new where ob_id = '$conf'");
				$row = mysql_fetch_array($qry);
				$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$conf', '".$_SESSION['emp_num']."', 'Confirmed!', 'created: ".date('m-d-Y h:m A')." C') ");
			}
		}
	}elseif(isset($_POST['deny_ob'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_ob_new SET status='Denied' WHERE ob_id='$deny' ");
				send_email("official business application", $deny, "ob","denied");
				$qry = mysql_query("SELECT emp_num from ems_ob_new where ob_id = '$deny'");
				$row = mysql_fetch_array($qry);
				$insert = mysql_query("INSERT INTO ems_remarks (id, emp_num, remarks, date) VALUES('$deny', '".$_SESSION['emp_num']."', 'Denied!', 'created: ".date('m-d-Y h:m A')." D') ");
			
			}
		}
	}elseif(isset($_POST['cancel_ob'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_ob_new SET status='Cancelled' WHERE ob_id='$cancel' ");
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
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript">
        	$(document).ready(function(){
            	function app_den(name, action){
					var form;
					if(action=="a_ob"){
                    	action = "Approve";
					}else if(action=="d_ob"){
                    	action = "Deny";
					}
                
                	var x = confirm(action+" official business request of "+name+" ?");
					if(x){
                        return true;
                    }else{
                        return false;
                    }
                	
					return false;
                }	
                
                $("[class^=chk_]").click(function(){
                	var id = $(this).attr("id");
					if($(this).is(":checked")==true){
						if(id=="Confirmation"){
							$("[id^=Approval]").attr("disabled", "disabled");
							$("#approve").hide();
							$("#confirm").show();
						}else{
							$("[id^=Confirmation]").attr("disabled", "disabled");
							$("#confirm").hide();
							$("#approve").show();
						}
					}else{
						var valid = false;
						$("[name^=itemChk]").each(function(){
							if($(this).is(":checked")){
								valid = true;
								return false;
							}										
						});	
						if(valid==false){
							$("#confirm").show();
							$("#approve").show();
							$("[id^=Confirmation]").removeAttr("disabled");
							$("[id^=Approval]").removeAttr("disabled");	
						}	
					}
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
					<li role="presentation"><a href="#mine" aria-controls="mine" role="tab" data-toggle="tab">My New Official Business Applications</a></li>
					<li role="presentation"><a href="#theirs" aria-controls="theirs" role="tab" data-toggle="tab">New Official Business Requests</a></li>
				</ul>
				
				<div class="tab-content">
					
					<div role="tabpanel" class="tab-pane active" id="mine">
		
						<div class="panel-body col-lg-12">
							<form name="form_ob_request" action="<?php $PHP_SELF;?>" method="POST">
								
								<div class="table-buttons row">
									<a href="view_edit_ob_old.php" class="a upper-link">View My Old Official Business Requests</a>
								</div>
								<button class="apply btn btn-primary" type="button" onclick="window.location = \'ob.php\'">Apply Offset</button>
								<div class="table-buttons row">
									<button type="submit" name="cancel_ob" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'ob\');">Cancel</button>
								</div>
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="ob-applications-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Client/Branch</th>
												<th class="table-column-names">Details</th>
												<th class="table-column-names">Remarks</th>
												<th class="table-column-names">Status</th>
											</tr>
										</thead>
										<tbody>
						';	/* echo */
											   $by = $_POST['searchby'];
											   $search = $_POST['search'];
												if(isset($_POST['submit']) && $_POST['submit']=="search"){				
												
													switch($by){
														case 1:
																$strqry = "o.emp_num='$_SESSION[emp_num]' AND date_filed='$search'";
														break;
														
														case 2:
																$strqry = "o.emp_num='$_SESSION[emp_num]' AND (ob_date LIKE '%$search%' ) ";
														break;

														case 3:
																$strqry = "o.emp_num='$_SESSION[emp_num]' AND client_branch='$search'";
														break;			
														
														case 4:
																$strqry = "o.emp_num='$_SESSION[emp_num]' AND status='$search'";
														break;					
														
														case 0:
																$strqry = "(o.emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search%') OR (o.emp_num='$_SESSION[emp_num]' AND (ob_date LIKE '%$search%')) OR 
																(o.emp_num='$_SESSION[emp_num]' AND client_branch LIKE '%$search%') OR (o.emp_num='$_SESSION[emp_num]' AND status LIKE '%$search%') ";
														break;												
													}

												}else{
														$strqry = "o.emp_num='$_SESSION[emp_num]'";
												}
												$str = "SELECT date_filed, ob_date, client_branch, purpose, departure, arrival, total, status, ob_id, remarks, ob_dtype, time_start, time_end
															FROM ems_ob_new as o
															INNER JOIN ems_employee as e
															ON o.emp_num = e.emp_num
															WHERE $strqry
															ORDER BY ob_id DESC";
												$x = "a";
												$qry = mysql_query($str);
												
												
												while($result = mysql_fetch_array($qry)){							
													echo '<tr align="center" class="',$x,'" valign="top">';
													
													// checkbox column
													chk_stat($result[7], $result[8], "ob");
													
													// date filed column
													edit_app($result[7], $result[8], "ob_edit", $result[0]);
												
													// client/branch column (client/branch)
													echo '<td>',$result[2],'<br>';
													
													// client/branch column (purpose)
													$pur = explode("|", $result[3]);
													$pp = "";	//2012/01/04 - Added to clear variable before usage for another record.
													for($i=0; $i<sizeof($pur)-1; $i++){
														if(sizeof($pur)==2){
															$purpose =  $pur[$i];
														}else{
															$pp = $pp . $pur[$i] . " / ";
															$purpose = del_slash($pp);
														}
													}
													echo 'For: ',$purpose,'</td>';
													$purpose = "";
													
													// details column for a single date
													if($result[10] == "sd"){
														// ob date
														echo '<td>',date('F d, Y', strtotime($result[1])),'<br>';

														// departure
														echo 'Departed: ',$result[4],'<br>';
													
														// arrival
														echo 'Arrived: ',$result[5],'<br>';	
														
														// duration
														echo $result[6],' hour(s) </td>';	
													}
													
													// details column for multiple dates
													else{
														echo '<td>';
													
														$item = explode("|",$result[1]); //ob dates
														$time = explode("|",$result[11]); // departure
														$time2 = explode("|",$result[12]); // arrival
														$item2 = explode("|",$result[6]); //total
														
														for($i=0;$i<sizeof($item)-1;$i++){
															// ob date
															echo date('F d, Y', strtotime($item[$i])),'<br>';
															
															// departure
															echo 'Departed: ',$time_s[$i],'<br>';
															
															// arrival
															echo 'Arrived: ',$time_e[$i],'<br>';

															// no of hours
															echo $item2[$i],' hour(s) <br><br>';
														}
														$items = "";
														$time_s = "";
														$time_e = "";
														$items2 = "";
														
														echo '</td>';
													}

													// remarks column										
													show_remarks($result[8]);
													
													// status column
													echo '<td><button class="btn btn-',f_color($result[7]),'">',$result[7],'</button></td>';
													echo '</tr>';
													
													if($x=="a"){
														$x = $x . "b";
													}else{
														$x = "a";
													}
												}
												
						echo '
										</tbody>
									</table>
								</div> <!-- table-responsive -->
								
								<div class="table-buttons row">
						'; /* echo */
									
										echo '<button type="submit" name="cancel_ob" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'ob\');">Cancel</button>';
						echo '
								</div>
							</form>
						</div> <!-- panel-body -->
					
					</div> <!-- tab-pane (2) for undertime requests -->
					
					<div role="tabpanel" class="tab-pane active" id="theirs">
						<div class="panel-body col-lg-12">
						';
					}
				
					else{
							echo '
						<div class="panel-body top-bordered col-lg-12">
							<h2 class="summary-title">New Official Business Requests</h2>
							';
					}
				?>
				
							<form name="form_ob_req" action="view_ob_request.php?searchby=0&search=&submit=search" method="POST">
                                
								<div class="table-buttons row">
									<a href="view_ob_request_old.php" class="a upper-link zero-bottom-margin"> View Old Official Business Requests </a>
								</div>
								<div class="table-buttons row">
									<button type="submit" name="deny_ob" id="deny" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'ob\');">Deny</button>
									<button type="submit" name="approve_ob" id="approve" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'ob\');">Approve</button>
									<button type="submit" name="conf_ob" id="confirm" class="confirm pull-right btn btn-primary" onclick="return confirmation(\'confirm\',\'ob\');">Confirm</button>
								</div>
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="ob-requests-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Requested By</th>
												<th class="table-column-names">Client/Branch</th>
												<th class="table-column-names">Details</th>
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
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "date_filed LIKE '%$search%'" : 
																	"b.b_manager_name='$_SESSION[fullname]' AND date_filed LIKE '%$search%'";
														break;

													case 2:
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "ob_date LIKE '%$search%' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND (ob_date LIKE '%$search%' )";
														break;
													
													case 3:
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "emp_firstname LIKE '%$search%' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND emp_firstname LIKE '%$search%'";
														break;

													case 4:
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "emp_middlename LIKE '%$search%' " :
																	"b.b_manager_name='$_SESSION[fullname]' AND emp_middlename LIKE '%$search%'";
														break;
													
													case 5:
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "emp_lastname LIKE '%$search%' " : 
																	"b.b_manager_name='$_SESSION[fullname]' AND emp_lastname LIKE '%$search%'";
														break;

													case 6:
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "client_branch='$search' " : 
																	"b.b_manager_name='$_SESSION[fullname]' AND client_branch='$search'";
														break;

													case 7:
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "o.status='$search' " : 
																	"b.b_manager_name='$_SESSION[fullname]' AND o.status='$search'";
														break;
													
													case 0:
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4 OR $_SESSION['rights']==5) ? "ob_date LIKE '%$search%'  
																OR emp_firstname LIKE '%$search%' 
																OR emp_middlename LIKE '%$search%' 
																OR emp_lastname LIKE '%$search%' 
																OR client_branch='$search' 
																OR o.status LIKE '%$search%'" 
																: 
																"b.b_manager_name='$_SESSION[fullname]' AND (ob_date LIKE '%$search%' 
																OR emp_firstname LIKE '%$search%' 
																OR emp_middlename LIKE '%$search%' 
																OR emp_lastname LIKE '%$search%' 
																OR client_branch='$search' 
																OR o.status LIKE '%$search%')";
														break;
														//<----End of modification
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
											
											//echo "LOG IN RIGHTS: ".$_SESSION['rights'];
											if($_SESSION['rights']==1 || $_SESSION['rights'] == 4 ){ //admin
												if(!$strqry){				
													$str = "SELECT date_filed, ob_date, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose,
																departure, arrival, total, status, ob_id, remarks, ob_dtype, time_start, time_end
																FROM ems_ob_new AS o
																INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num 
																WHERE 1
																ORDER BY case
																	when o.status = 'Pending for Confirmation' then 1
																	when o.status = 'Pending for Approval' then 2
																	when o.status = 'Approved' then 3
																	when o.status = 'Confirmed' then 4
																	when o.status = 'Denied' then 5
																	else 1000
																 end asc, o.ob_id DESC";		
												}else{					
													$str = "SELECT date_filed, ob_date, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose,
																departure, arrival, total, status, ob_id, remarks, ob_dtype, time_start, time_end
																FROM ems_ob_new AS o
																INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num 
																WHERE $strqry
																ORDER BY case
																	when o.status = 'Pending for Confirmation' then 1
																	when o.status = 'Pending for Approval' then 2
																	when o.status = 'Approved' then 3
																	when o.status = 'Confirmed' then 4
																	when o.status = 'Denied' then 5
																	else 1000
																 end asc, o.ob_id DESC";
												}
											}
											
											//JD-2012/06/25 - Separate Condition for Executive to show only managers' Official Business Requests
											elseif($_SESSION['rights']==5){
												//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
												//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
												//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
										
												$str = "SELECT date_filed, ob_date, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose,
																departure, arrival, total, o.status, ob_id, remarks, ob_dtype, time_start, time_end
															FROM ems_ob_new AS o
															INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num 
															INNER JOIN ems_users as ue ON ue.emp_num = e.emp_num
															LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
															WHERE 1 AND (ue.rights=2 OR ue.rights=4)
															ORDER BY case
																when o.status = 'Pending for Confirmation' then 1
																when o.status = 'Pending for Approval' then 2
																when o.status = 'Approved' then 3
																when o.status = 'Confirmed' then 4
																when o.status = 'Denied' then 5
																else 1000
															 end asc, o.ob_id DESC";
															//search for executive not working
											}
											else{
												//JD-2014/09/25 - Added condition e.code != 'EST004'
												//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
												//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
												//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
												
												//echo"<script>alert('rights: else');</script>";
												
												$str = 
												"SELECT date_filed, ob_date, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose,
													departure, arrival, total, o.status, ob_id, remarks, ob_dtype, time_start, time_end
													FROM ems_ob_new AS o
													INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num
													INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
													LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
													WHERE ($strqry OR (e.dept_code IN($q_oic) AND rights!=2) OR (e.dept_code IN ($q_report) AND rights=2) $man_oic) 
													AND o.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
															ORDER BY case
																when o.status = 'Pending for Confirmation' then 1
																when o.status = 'Pending for Approval' then 2
																when o.status = 'Approved' then 3
																when o.status = 'Confirmed' then 4
																when o.status = 'Denied' then 5
																else 1000
															 end asc, o.ob_id DESC";
											}
											//echo $str; //- For debugging
											
											$my_variable = 'param='.$strqry; //JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
											$x = "a";
											$qry = mysql_query($str);
											
											while($result = mysql_fetch_array($qry)){		
												$name = $result[2]." ".$result[3]." ".$result[4];
												echo '<tr align="center" class="',$x,'">';
												chk_stat($result[10], $result[11], "ob_man");

												echo '<td width="8%">',$result[0],'</td>'; //date filed
												echo '<td>',$name,'</td>'; //name
												echo '<td>',$result[5],'<br>';	//client/branch
													
												$pur = explode("|", $result[6]);
												for($i=0; $i<sizeof($pur)-1; $i++){
													if(sizeof($pur)==2){
														$purpose =  $pur[$i];
													}else{
														$pp = $pp . $pur[$i] . " / ";
														$purpose = del_slash($pp);
													}
												}									
												echo 'For: ',$purpose,'</td>'; //purpose
												$purpose = "";
												$pp = "";

												if($result[13]=="sd")//if OB is single day
												{	//ob date
													echo'<td>',date('F d, Y', strtotime($result[1])),'<br>';

													//departure
													echo 'Departed: ',$result[7],'<br>';

													//arrival
													echo 'Arrived: ',$result[8],'<br>';

													//total
													echo $result[9],' hour/s</td>';
												}
												else // Multiple dates OB
												{	//ob dates
													$item = explode("|",$result[1]);
													for($i=0;$i<sizeof($item)-1;$i++){
														$items = $items . $item[$i] . '<br/>';
													}
													echo '<td>',$items,'</td>';
													$items = "";

													//departure and arrival
													$time = explode("|",$result[14]);
													$time2 = explode("|",$result[15]);
													for($i=0;$i<sizeof($time)-1;$i++){
														$time_s = $time_s . $time[$i] . '<br/>';
														$time_e = $time_e . $time2[$i] . '<br/>';
													}
													echo '<td>',$time_s,'</td>';	
													echo '<td>',$time_e,'</td>';	
													$time_s = "";
													$time_e = "";	

													//total
													$item = explode("|",$result[9]);
													for($i=0;$i<sizeof($item)-1;$i++){
														$items = $items . $item[$i] . '<br/>';
													}										
													echo '<td>',$items,'</td>';	
													$items = ""; 
												}

												show_remarks($result[11]); //remarks
												echo '<td><span class="label label-',f_color($result[10]),'">',$result[10],'</span></td>';//status
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
										<button type="submit" name="deny_ob" id="deny" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'ob\');">Deny</button>
										<button type="submit" name="approve_ob" id="approve" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'ob\');">Approve</button>
										<button type="submit" name="conf_ob" id="confirm" class="confirm pull-right btn btn-primary" onclick="return confirmation(\'confirm\',\'ob\');">Confirm</button>
										';
									?>
								</div>
							</form>
						</div> <!-- panel-body of undertime requests -->
						
				<?php
					echo'
					</div> <!-- tab-pane (2) for undertime requests -->
					
				</div> <!-- tab-content -->
					';
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
		<script src="js/docs.min.js"></script>
		<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
		<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#ob-requests-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			$(document).ready(function() {
				$('#ob-applications-table').dataTable({
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