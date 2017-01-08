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
		
	$chk = $_POST['itemChk'];
	if(isset($_POST['approve_request'])){
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				$qry = mysql_query("UPDATE ems_equip_requisitions SET status='Approved' WHERE erqstn_id='$app' ");
				send_email("requisition application", $app, "rqstn","approved");
			}
		}
	}elseif(isset($_POST['done'])){
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				$qry = mysql_query("UPDATE ems_equip_requisitions SET status='Delivered' WHERE erqstn_id='$app' ");
			}
		}
	}elseif(isset($_POST['deny_request'])){
		if(sizeof($chk)!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_equip_requisitions SET status='Denied' WHERE erqstn_id='$deny' ");
				send_email("requisition application", $app, "rqstn","denied");
			}
		}
	}elseif(isset($_POST['cancel_request'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_equip_requisitions SET status='Cancelled' WHERE erqstn_id='$cancel' ");
			}
		}
	}
	
	function edit($status,$ID,$date){
		if($_SESSION['rights']==1){
			if($status=="Approved"){
				//Where will this link supposed to go?
				echo '<td width="8%"><a href="#" title="Click to Process" onclick="load_rqstn(',$ID,',\'ad_edit\')"><b>',$date,'</b></a></td>';
			}else{
				echo '<td width="8%">',$date,'</td>';
			}	
		}else{
			echo '<td width="8%">',$date,'</td>';
		}
	}
	
	function trimID($ID){
		$x = substr($ID,-3);
		$y = ltrim($x,"0");
		return $y;
	}

	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	$q_oic = "''";
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = $q_oic.",'".$row[0]."'";
	}
		
	$sman_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' AND dept_code = 'DEP-0000' ");
	$cnt = mysql_num_rows($sman_oic);
	if($cnt > 0){
		$man_oic = " OR (rights=2 AND e.emp_num <> $_SESSION[emp_num]) ";
	}else{
		$man_oic = "";
	}
		
	//finding the report to department
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
            function load_rqstn(ID,action){
                window.open("request_equip.php?ID="+ID+"&action="+action,"_self");
            }
            
            function conf(){
                var x = confirm("Are you sure you want to set the status to Delivered?");
				if(x){
					return true;
				}else{
					return false;
				}
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
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation"><a href="#mine" aria-controls="mine" role="tab" data-toggle="tab">My Equipment Requisitions</a></li>
					<li role="presentation"><a href="#theirs" aria-controls="theirs" role="tab" data-toggle="tab">Equipment Requisitions</a></li>
				</ul>
				
				<div class="tab-content">
					
					<div role="tabpanel" class="tab-pane active" id="mine">
					
						<div class="panel-body col-lg-12">
							<form name="form_rqstn" action="'; $PHP_SELF; echo'" method="POST">
		
								<div class="table-buttons row">
									<a href="request_equip.php" class="a upper-link zero-bottom-margin"> Request for Equipment </a>
								</div>
								<div class="table-buttons row">
									<button type="submit" name="cancel_request" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'request\');">Cancel</button>
								</div>
						
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="requisition-applications-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Date Needed</th>
												<th class="table-column-names">Details</th>
												<th class="table-column-names" width="30%">Purpose</th>
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
																// $ID = trimID($search);
																$strqry = "emp_num='$_SESSION[emp_num]' AND erqstn_id='$search' ";
														break;									
													
														case 2:
																$strqry = "emp_num='$_SESSION[emp_num]' AND date_filed='$search'";
														break;
					
														case 3:
																$strqry = "emp_num='$_SESSION[emp_num]' AND date_needed='$search' ";
														break;	
														
														case 4:
																$strqry = "emp_num='$_SESSION[emp_num]' AND status='$search'";
														break;				

														case 0:
																$ID = trimID($search);
																$strqry = "emp_num='$_SESSION[emp_num]' AND (erqstn_id LIKE '%$ID' OR date_filed LIKE '%$search%' OR date_needed LIKE '%$search%' OR status LIKE '%$search%') ";
														break;											
													}
												}else{
													$strqry = "emp_num='$_SESSION[emp_num]'";
												}
												
												$str = "SELECT date_Filed, date_needed, qty, items, purpose, remarks, status, erqstn_id, amount
															FROM ems_equip_requisitions
															WHERE $strqry
															ORDER BY erqstn_id DESC";
												$x = "a";
												$qry = mysql_query($str);
												
												while($result = mysql_fetch_array($qry)){	
													echo '<tr align="center" class="',$x,'">';
													chk_stat($result[6], $result[7], "request");
													edit_app($result[6], $result[7],"request_edit", $result[0]);

													echo '<td>',date('F d, Y', strtotime($result[1])),'</td>';
													
													$quantity = explode("|",$result[2]);
													$item = explode("|",$result[3]);
													for($i=0;$i<sizeof($quantity)-1;$i++){
														$out = $out . $quantity[$i] . ' ' . $item[$i] . '<br/>';
													}
													echo '<td>',$out;
													echo $result[8],'</td>';
													$out = "";
													echo '<td>',$result[4],'</td>';
													show_remarks($result[7]);				
													echo '<td><button class="btn btn-',f_color($result[6]),'">',$result[6],'</button></td>';
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
						';
										echo '<button type="submit" name="cancel_request" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'request\');">Cancel</button>';
						
						echo '
								</div>
							</form>
						</div> <!-- panel-body -->
					
					</div>
		
					<div role="tabpanel" class="tab-pane active" id="theirs">
		
						<div class="panel-body col-lg-12">
							<div class="table-buttons row">
						';
						
						if($_SESSION['rights']==2 OR $_SESSION['rights']==5){
							echo '
								<button type="submit" name="deny_request" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'rqst\');">Deny</button>
								<button type="submit" name="approve_request" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'rqst\');">Approve</button>
							';
						}elseif($_SESSION['rights']==1){
							echo '
								<button type="submit" name="deny_request" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'rqst\');">Deny</button>
								<button type="submit" name="done" class="done pull-right btn btn-primary" onclick="return conf();" title="Click to set status to Delivered">Done</button>
							';		
						}
						if($_SESSION['rights']==1 OR $_SESSION['rights']==2){
							echo '<form name="export" method="post" action="emp_export.php">';
							?>
								<input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
								<input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
								<input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
								<input type="text" name="bman" value="<?php echo $bman ?>" hidden="hidden" />
								<!--<input type="submit" name="export" value="export_requisiteBtn" class="export">-->
							<?php
							echo '</form>';
						}
						
						echo '</div>';
						
					}
					else{
						echo '
						<div class="panel-body top-bordered col-lg-12">
							<div class="table-buttons row">
								<h2 class="summary-title">Equipment Requisition</h2>
						';
						
						if($_SESSION['rights']==2 OR $_SESSION['rights']==5){
							echo '
								<button type="submit" name="deny_request" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'rqst\');">Deny</button>
								<button type="submit" name="approve_request" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'rqst\');">Approve</button>
							';
						}elseif($_SESSION['rights']==1){
							echo '
								<button type="submit" name="deny_request" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'rqst\');">Deny</button>
								<button type="submit" name="done" class="done pull-right btn btn-primary" onclick="return conf();" title="Click to set status to Delivered">Done</button>
							';		
						}
						if($_SESSION['rights']==1 OR $_SESSION['rights']==2){
							echo '<form name="export" method="post" action="emp_export.php">';
							?>
								<input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
								<input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
								<input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
								<input type="text" name="bman" value="<?php echo $bman ?>" hidden="hidden" />
								<!--<input type="submit" name="export" value="export_requisiteBtn" class="export">-->
							<?php
							echo '</form>';
						}
						
						echo '</div>';
					}
				?>
							<form name="form_requisition" action="view_requisition.php?searchby=0&search=&submit=search" method="POST">
						
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="requisition-requests-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Requested By</th>
												<th class="table-column-names">Date Needed</th>
												<th class="table-column-names">Details</th>
												<th class="table-column-names">Purpose</th>
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
															//$ID = trimID($search);
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "erqstn_id='$search' " :
																"b.b_manager_name='$_SESSION[fullname]' AND erqstn_id='$search'";
														break;							
													
														case 2:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_filed='$search' " :
																"b.b_manager_name='$_SESSION[fullname]' AND date_filed='$search'";
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
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_needed='$search'" :
																"b.b_manager_name='$_SESSION[fullname]' AND date_needed='$search'";
														break;

														case 7:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "r.status='$search' " : 
																"b.b_manager_name='$_SESSION[fullname]' AND r.status='$search'";
														break;
														
														case 0:
															// $ID = trimID($search);
															if($_SESSION['rights']==1 or $_SESSION['rights']==5){
																$x = 1;
															}
															else{
																//$x = "dept_code='$_SESSION[dept_code]'";
																$x = "b.b_manager_name='$_SESSION[fullname]'";
															}
															
															$strqry = "$x AND (erqstn_id='$search' 
																		OR date_filed='$search' 
																		OR emp_firstname LIKE '%$search%' 
																		OR emp_middlename LIKE '%$search%' 
																		OR emp_lastname LIKE '%$search%' 
																		OR date_needed='$search' 
																		OR r.status='$search')";
														break;
														//<----End of Modification		
													}
												}else{
													$param = $_GET["param"]; //JD-2012/11/19 - Get paramater of the url
													$param = stripslashes($param); //JD-2012/11/19 - Used to removed slashes in the parameter
													//JD-2012/11/19 - Replace "1" with "$param" as the default value
													//JD-2013/05/22 - Replaced dept_code='$_SESSION[dept_code]' with b.b_manager_name='$_SESSION[fullname]'
													$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "$param" : "dept_code='$_SESSION[dept_code]'";
												}	
												
												if($_SESSION['rights']==1){
													if(!$strqry){
														$str = "SELECT r.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, r.date_needed, r.qty, 
																	r.items, r.purpose, r.remarks, r.status, erqstn_id, amount
																	FROM ems_equip_requisitions as r
																	INNER JOIN ems_employee as e ON r.emp_num = e.emp_num 
																	WHERE 1
																	ORDER BY r.erqstn_id DESC";
													}else{
														$str = "SELECT r.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, r.date_needed, r.qty, 
																	r.items, r.purpose, r.remarks, r.status, erqstn_id, amount
																	FROM ems_equip_requisitions as r
																	INNER JOIN ems_employee as e ON r.emp_num = e.emp_num 
																	WHERE $strqry
																	ORDER BY r.erqstn_id DESC";
													}
												}
												
												//JD - Select only applications made by managers
												elseif($_SESSION['rights']==5){
													//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
													//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
														//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
													$str = "SELECT r.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, r.date_needed, r.qty, 
																r.items, r.purpose, r.remarks, r.status, erqstn_id, amount
																FROM ems_equip_requisitions as r
																INNER JOIN ems_employee as e ON r.emp_num = e.emp_num 
																INNER JOIN ems_users as ue ON ue.emp_num = e.emp_num
																LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
																WHERE 1 AND (ue.rights=2 OR ue.rights=4)
																ORDER BY r.erqstn_id DESC";
												}else{
													//JD-2014/09/25 - Added condition e.code != 'EST004'
													//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
													//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
														//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
													$str = "SELECT r.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, r.date_needed, r.qty, r.items, r.purpose, 
																r.remarks, r.status, erqstn_id, amount
																FROM ems_equip_requisitions as r
																INNER JOIN ems_employee as e ON r.emp_num  = e.emp_num
																INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
																LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
																WHERE ($strqry OR (e.dept_code IN($q_oic) AND rights!=2) OR (e.dept_code IN ($q_report) AND rights=2)) 
																AND r.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
																ORDER BY r.erqstn_id DESC";	
												}
												//echo $str; //For debugging purpose only
												
												$my_variable = 'param='.$strqry; //JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
												$x = "a";
												$qry = mysql_query($str);
												
												while($result = mysql_fetch_array($qry)){	
													$name = $result[1]." ".$result[2]." ".$result[3];
													echo '<tr align="center" class="',$x,'">';
													
													// checkbox column
													chk_stat_rqst($result[9], $result[10]);
													
													// date filed column
													edit($result[9],$result[10],$result[0]);
													
													// name column
													echo '<td>',$name,'</td>';
													
													// date needed
													echo '<td>',date('F d, Y', strtotime($result[4])),'</td>';	
													
													// qty
													echo '<td>';
													$item = explode("|",$result[5]);
													
													// particulars
													$item2 = explode("|",$result[6]);
													for($i=0;$i<sizeof($item)-1;$i++){
														echo $item[$i],' ',$item2[$i],'<br>';
													}
													
													// amount
													echo $result[11],'</td>';
													
													echo '</td>';
													
													// purpose
													echo '<td width="20%">',$result[7],'</td>';

													// remarks
													show_remarks($result[10]);
													
													// status
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
								</div> <!-- table-responsive -->
								
								<div class="table-buttons row">
									<?php
										if($_SESSION['rights']==2 OR $_SESSION['rights']==5){
											echo '
												<button type="submit" name="deny_request" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'rqst\');">Deny</button>
												<button type="submit" name="approve_request" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'rqst\');">Approve</button>
											';
										}elseif($_SESSION['rights']==1){
											echo '
												<button type="submit" name="deny_request" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'rqst\');">Deny</button>
												<button type="submit" name="done" class="done pull-right btn btn-primary" onclick="return conf();" title="Click to set status to Delivered">Done</button>
											';		
										}
										if($_SESSION['rights']==1 OR $_SESSION['rights']==2){
											echo '<form name="export" method="post" action="emp_export.php">';
											?>
												<input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
												<input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
												<input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
												<input type="text" name="bman" value="<?php echo $bman ?>" hidden="hidden" />
												<!--<input type="submit" name="export" value="export_requisiteBtn" class="export">-->
											<?php
											echo '</form>';
										}
									?>
								</div>
							</form>
						</div> <!-- panel-body -->
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
				$('#requisition-applications-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			$(document).ready(function() {
				$('#requisition-requests-table').dataTable({
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
