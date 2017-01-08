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

	if(isset($_POST['cancel_request'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_equip_requisitions SET status='Cancelled' WHERE erqstn_id='$cancel' ");
			}
		}
	}

	function trimID($ID){
		$x = substr($ID,-3);
		$y = ltrim($x,"0");
		return $y;
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
		<?php include("table_head.php"); ?>
	</head>
	
	
	<body vlink="green" alink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

		<?php include("menu.php"); ?>
		
		<form name="form_rqstn" action="<?php $PHP_SELF;?>" method="POST"><div id="container">
			<div id="container">
		
				<div class="col-lg-12">
				
					<div class="panel-body top-bordered col-lg-12">
						<div class="table-buttons row">
							<h2 class="summary-title"> Equipment Requisition </h2>
							<a href="request_equip.php" class="a upper-link smaller-link-margin"> Request for Equipment </a>
						</div>
						<div class="table-buttons row">
							<button type="submit" name="cancel_request" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'request\');">Cancel</button>
						</div>
						
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="new-offset-request">
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
									<?php
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
											
											// checkbox column
											chk_stat($result[6], $result[7], "request");
											
											// date filed column
											edit_app($result[6], $result[7],"request_edit", $result[0]);

											// date needed column
											echo '<td>',date('F d, Y', strtotime($result[1])),'</td>';
											
											// details column
											
											// quantity and particulars
											$quantity = explode("|",$result[2]);
											$item = explode("|",$result[3]);
											for($i=0;$i<sizeof($quantity)-1;$i++){
												$out = $out . $quantity[$i] . ' ' . $item[$i] . '<br/>';
											}
											echo '<td>',$out;
											$out = "";
											
											// amount
											if($result[8] != null){
												echo $result[8],' php</td>';
											}else{
												echo '</td>';
											}
											
											// purpose column
											echo '<td>',$result[4],'</td>';
											
											// remarks column
											show_remarks($result[7]);				
											
											// status column
											echo '<td><button class="btn btn-',f_color($result[6]),'">',$result[6],'</button></td>';
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
								echo '<button type="submit" name="cancel_request" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'request\');">Cancel</button>';
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
