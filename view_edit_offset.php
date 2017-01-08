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

	if(isset($_POST['cancel_off'])){
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
		
	</head>

	
	<body vlink="green" alink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
	
		<?php include("menu.php"); ?>
			
		<form name="form_ot_request" action="<?php $PHP_SELF;?>" method="POST">
			<div id="container">
		
				<div class="col-lg-12">

					<div class="panel-body top-bordered col-lg-12">
						
						<h2 class="summary-title">New Offset Request</h2>
						
						<div class="table-buttons row">
							<a href = "view_edit_offset_old.php" class = "a upper-link smaller-link-margin">View My Old Offset Request</a>
						</div>
						<button class="apply btn btn-primary" type="button" onclick="window.location = 'offset.php'">Apply Offset</button>
						<div class="table-buttons row">
							<button type="submit" name="deny_off" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'off\');">Deny</button>
							<button type="submit" name="approve_off" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'off\');">Approve</button>
						</div>
						
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="new-offset-request">
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
									<?php
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
									?>		
								</tbody>
							</table>
						</div> <!-- table-responsive -->
			
						<div class="table-buttons row">
							<?php
								echo '
								<button type="submit" name="deny_off" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'off\');">Deny</button>
								<button type="submit" name="approve_off" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'off\');">Approve</button>
								';
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
				$('#new-offset-request').dataTable({
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
