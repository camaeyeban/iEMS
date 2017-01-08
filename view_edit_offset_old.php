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

	if($_SESSION['rights']==1){
			echo '<h1>',"Invalid URL",'</h1>';
			return false;
	}

	if(isset($_POST['cancel_off'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_offset SET status='Cancelled' WHERE offset_id='$cancel' ");
			}
		}
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
				
		<form name="form_ot_request" action="<?php $PHP_SELF;?>" method="POST">
			<div id="container">
			
				<div class="col-lg-12">

					<div class="panel-body top-bordered col-lg-12">
						<h2 class="summary-title">My Old Offset Requests</h2>
						
						<div class="table-buttons row">
						<?php
							if($_SESSION['rights']==3){
								echo '<a href="view_edit_offset.php" class="a upper-link smaller-link-margin"> View My New Offset Request </a>';
							}else{
								echo '<a href="view_offset_request.php?searchby=0&search=&submit=search" class="a upper-link smaller-link-margin"> View My New Offset Request </a>';
							}
						?>
						</div>
						
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="old-offset-request">
								<thead>
									<tr>
										<th class="nosort"> </th>
										<th class="table-column-names">Date Filed</th>
										<th class="table-column-names">OT details</th>
										<th class="table-column-names">Accomplishments</th>
										<th class="table-column-names">Offset dates</th>
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
														$strqry = "emp_num='$_SESSION[emp_num]' AND (date_offset='$search' OR date_offset2='$search')";
												break;	

												case 3:
														$strqry = "emp_num='$_SESSION[emp_num]' AND status='$search'";
												break;										

												case 0:
														$strqry = "(emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND (date_offset LIKE '%$search%' OR date_offset2 LIKE '%$search%')) OR 
														(emp_num='$_SESSION[emp_num]' AND status LIKE '%$search%') ";
												break;											
											}
										}else{
														$strqry = "emp_num='$_SESSION[emp_num]'";
										}
										$str = "SELECT date_Filed, date_ot, date_ot2, ot_hours, 
														ot_hours2, accomplishment, date_offset, 
														date_offset2, remarks, status, offset_id
														FROM ems_offset
														WHERE $strqry
														ORDER BY offset_id DESC";

										$x = "a";
										$qry = mysql_query($str);
										
										while($result = mysql_fetch_array($qry)){
											echo '<tr align="center"  class="',$x,'">';
											
											// checkbox column
											chk_stat("Cancelled", $result[10], "off");
											
											// date filed column
											edit_app("", $result[10], "off_edit", $result[0]);
											
											// ot dates
											//JD-2013/04/18 - modified to show ot_date2 if ot_date is empty or 0000-00-00
											if($result[1]=="0000-00-00"){
												echo '<td width="12%">',date('F d, Y', strtotime($result[2])),'<br/>',dont_show($result[1]),'<br>';
											}else{
												echo '<td width="12%">',date('F d, Y', strtotime($result[1])),'<br/>',dont_show($result[2]),'<br>';
											}
											
											// ot hours
											//JD-2013/04/18 - modified to show ot_hours2 if ot_hours is empty or zero
											if($result[3]=='0' OR $result[3]==''){
												echo $result[4],' hour(s)<br/>',hide_hr($result[3]),'</td>';
											}else{
												echo $result[3],' hour(s)<br/>','</td>';
											}
											
											// accomplishments
											echo '<td>',$result[5],'</td>';
											//JD-2013/04/16 - replaced ,dont_show($result[7])), with ,$result[7],
											//JD-2013/04/16 - modified logic. If To date = 0000-00-00, show only From date
											/*
											Original
												
												echo '<td>',$result[6],'<br />',dont_show($result[7]),'</td>';
											
											*/
											
											// offset dates
											if($result[7]=='0000-00-00' OR $result[7]==''){
												echo '<td width="12%">',date('F d, Y', strtotime($result[6])),'</td>';
											}else if($result[6]==$result[7]){
												echo '<td width="12%">',date('F d, Y', strtotime($result[6])),'</td>';
											}else{
												//echo '<td>',$result[6],' / ',$result[7],'</td>';	
												echo '<td width="12%">',date('F d, Y', strtotime($result[7])),'</td>';
											}
											
											// remarks column
											show_remarks($result[10]);
											
											// status column
											echo '<td><button class="btn btn-',f_color($result[9]),'">',$result[9],'</button></td>';
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
