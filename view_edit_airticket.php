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
			echo '<h1>',"Invalid URL!",'</h1>';
			return false;
	}

	if(isset($_POST['rebook_air'])){
		$value = $_POST['rad_air'];
		header("location: airticket.php?ID=$value&action=air_edit&rebook=1");
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

	
	<body vlink="green" alink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

		<?php include("menu.php"); ?>
		
		<form name="form_air" action="<?php $PHP_SELF;?>" method="POST">
			<div id="container">
				
				<div class="col-lg-12">

					<div class="panel-body top-bordered col-lg-12">
						
						<div class="table-buttons row">
							<h2 class="summary-title">Air Ticket Request</h2>
							<a href="airticket.php" class="a upper-link smaller-link-margin"> Request for Air Ticket</a>
						</div>
						<div class="table-buttons row">
							<button type="submit" name="rebook_air" class="rebook pull-right btn btn-primary" onclick="return conf_air(\'re-book\');">Re-book</button>
						</div>
						
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="new-offset-request">
								<thead>
									<tr>
										<th class="nosort"> </th>
										<th class="table-column-names">Date Filed</th>
										<th class="table-column-names">Details</th>
										<th class="table-column-names">Purpose</th>
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
														$strqry = "emp_num='$_SESSION[emp_num]' AND origin='$search' ";
												break;	
			
												case 3:
														$strqry = "emp_num='$_SESSION[emp_num]' AND destination='$search' ";
												break;	

										/*		case 4:
														$strqry = "emp_num='$_SESSION[emp_num]' AND airline='$search' ";
												break;	*/
												
												case 4:
														$strqry = "emp_num='$_SESSION[emp_num]' AND status='$search'";
												break;				

												case 0:
														$strqry = "(emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND origin LIKE '%$search%') OR 
														 (emp_num='$_SESSION[emp_num]' AND destination LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND airline LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND status LIKE '%$search%') ";
												break;											
											}
										}else{
											$strqry = "emp_num='$_SESSION[emp_num]'";
										}
										
										$str = "SELECT date_Filed, origin, destination, airline, departure, arrival, purpose, type, status, at_id, amount, attachment
												   FROM ems_air_ticket
												   WHERE $strqry
												   ORDER BY at_id DESC";
											 
										$x = "a";
										$qry = mysql_query($str);

										while($result = mysql_fetch_array($qry)){	
											echo '<tr align="center" class="',$x,'">';
											chk_stat($result[8], $result[9], "air");
											edit_app($result[8], $result[9],"air_edit",$result[0]);
											
											$findme   = '<br/>';
											$pos = strpos($result[1], $findme);

											if ($pos !== false) {
												$result[1] = substr($result[1], 0, $pos);
											}
											echo '<td>From ',$result[1];
											
											$pos1 = strpos($result[2], $findme);
											if ($pos1 !== false) {
												$result[2] = substr($result[2], 0, $pos1);
											}
											echo ' to ',$result[2],'<br>';
											
											if($pos !== false && $pos1 !== false){
												echo 'Round trip<br>';
											}
											else{
												echo 'One way trip<br>';
											}
											
											echo 'Departure: ',$result[4], '<br>';
											if($result[5]!=NULL){
												echo 'Return on: ',$result[5],'<br>';
											}
											$amt = $result[10];
											$file = $result[11];
											$status = $result[8];
											if(empty($file)){
												echo $amt, '</td>';
											}else{
												//JD-2014/02/22 - Removed 'Reviewed' Status
												//if($status=="Booked" || $status=="Re-booked" || $status=="Reviewed"){
												if($status=="Booked" || $status=="Re-booked"){
													echo '<a class="file" id="'.$file.'" title="Click here to download e-ticket." href="download.php?download_file=',$file,'">',$amt,'</a></td>';
												}else{
													echo '<span class="file" id="'.$file.'" >',$amt,'</span></td>';
												}
											}
											echo '<td width="30%">',$result[6],'</td>';
											show_remarks($result[9]);
											echo '<td><button class="btn btn-',f_color($result[8]),'">',$result[8],'</button></td>';
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
								echo '<button type="submit" name="rebook_air" class="rebook pull-right btn btn-primary" onclick="return conf_air(\'re-book\');">Re-book</button>';
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
