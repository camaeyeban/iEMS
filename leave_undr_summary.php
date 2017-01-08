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
	
	if($_SESSION['rights']==1){
			echo '<h1>',"Invalid URL",'</h1>';
			return false;
	}
	
	if(isset($_POST['cancel_lv'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_leave SET status='Cancelled' WHERE leave_id='$cancel' ");
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
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">
		<link href="css/plugins/social-buttons.css" rel="stylesheet">

		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>
		
    </head>
	
	
    <body vlink="green" alink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		
		<?php include("menu.php"); ?>
		<br/>
	
        <div id="container">
			
			<div class="col-lg-12" id="tab-container">
			
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation"><a href="#leave-summary" aria-controls="leave-summary" role="tab" data-toggle="tab">Leave Summary</a></li>
					<li role="presentation"><a href="#undertime-summary" aria-controls="undertime-summary" role="tab" data-toggle="tab">Undertime Summary</a></li>
				</ul>
				
				<div class="tab-content">
		
					<div role="tabpanel" class="tab-pane active" id="leave-summary">
		
						<div class="panel-body col-lg-12">
							<form name="form_leave" action="leave_undr_summary.php" method="POST">
								<div class="table-buttons row">
									<a href="leave_undertime.php?ID=&action=leave" class="a upper-link tabbed zero-bottom-margin">Apply Leave</a>
								</div>
								<div class="table-buttons row">
									<button type="submit" name="cancel_lv" class="cancel btn btn-md btn-danger pull-right" onclick="return confirmation(\'cancel\',\'lv\');">Cancel</button>
								</div>
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="leave-summary-table">
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
											<?php
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
													echo '<td><button class="btn btn-',f_color($result[6]),'">',$result[6],'</button></td>';
													echo '</tr>';
						
													if($x=="a"){
														$x = $x . "b";
													}else{
														$x = "a";
													}
													$cnt++;
												}
											?>
										</tbody>
									</table>
								</div> <!-- table-responsive for leave summary -->
								
								<div class="table-buttons row">
									<?php
										echo '<button type="submit" name="cancel_lv" class="cancel btn btn-md btn-danger pull-right" onclick="return confirmation(\'cancel\',\'lv\');">Cancel</button>';
									?>
								</div>
							</form>
						</div> <!-- panel-body of leave summary -->
					</div> <!-- tab-pane (1) for leave summary -->
					
					
					<div role="tabpanel" class="tab-pane active" id="undertime-summary">

						<div class="panel-body col-lg-12">
							<form name="form_under" action="leave_undr_summary.php" method="POST">
								<div class="table-buttons row">
									<a href="leave_undertime.php?ID=&action=under" class="a upper-link tabbed zero-bottom-margin">Apply Undertime</a>
								</div>
								<div class="table-buttons row">
									<button type="submit" name="cancel_un" class="cancel btn btn-md btn-danger pull-right" onclick="return confirmation(\'cancel\',\'un\');">Cancel</button>
								</div>
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="undertime-summary-table">
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
											<?php
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
											?>
										</tbody>
									</table>
								</div> <!-- table-responsive for undertime summary -->
								
								<div class="table-buttons row">
									<?php
										echo '<button type="submit" name="cancel_un" class="cancel btn btn-md btn-danger pull-right" onclick="return confirmation(\'cancel\',\'un\');">Cancel</button>';
									?>
								</div>
							</form>
						</div> <!-- panel-body of undertime summary -->
					</div> <!-- tab-pane (2) for undertime summary -->
					
				</div> <!-- tab-content -->
				
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
		<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#leave-summary-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			$(document).ready(function() {
				$('#undertime-summary-table').dataTable({
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