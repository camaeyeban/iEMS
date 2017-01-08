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

	if(isset($_POST['cancel_ot'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_ot SET status='Cancelled' WHERE ot_id='$cancel' ");
				$acc = mysql_query("SELECT status FROM ems_accomplishments WHERE ot_id='$cancel' ");
				$result = mysql_result($acc, 0);
				if(!empty($result[0])){
					$qry_acc = mysql_query("UPDATE ems_accomplishments SET status='Cancelled' WHERE ot_id='$cancel' ");
				}
			}
		}
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
		
		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>
		<script type="text/javascript">
			function open_win(ID, action){
				var left = parseInt((screen.availWidth/2) - (650/2));
				var top = parseInt((screen.availHeight/2) - (320/2));
				window.open("accomplishment.php?ID="+ID+"&action="+action,"_blank","toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=650, height=320");
			}
		</script>

	</head>
	
	
	<body vlink="green" alink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

		<?php include("menu.php"); ?>
		
		<form name="form_view_ot" action="view_ot_request.php" method="POST">
			<div id="container">
			
				<div class="col-lg-12">
					
					<div class="panel-body top-bordered col-lg-12">
						<h2 class="summary-title">Overtime Request & Accomplishment</h2>
						
						<div class="table-buttons row">
							<a href="ot.php" class="a upper-link tabbed smaller-link-margin">Apply Overtime</a>
						</div>
						<div class="table-buttons row">
							<button type="submit" name="cancel_ot" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'ot\');">Cancel</button>
						</div>
						
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="overtime-requests-and-accomplishment">
								<thead>
									<tr>
										<th class="nosort"> </th>
										<th class="table-column-names">Date Filed</th>
										<th class="table-column-names">Details</th>
										<th class="table-column-names">Day Classification</th>
										<th class="table-column-names">Expected Output</th>
										<th class="table-column-names">Remarks</th>
										<th class="table-column-names">OT Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
									   $by = $_POST['searchby'];
									   $search = $_POST['search'];
										if(isset($_POST['submit']) && $_POST['submit']=="search"){				
										
											switch($by){
												case 1:
														$strqry = "ot.emp_num='$_SESSION[emp_num]' AND ot.date_filed='$search'";												 							
												break;

												case 2:
														$strqry = "ot.emp_num='$_SESSION[emp_num]' AND ot.date_ot='$search'";
												break;			

												case 3:
														$strqry = "ot.emp_num='$_SESSION[emp_num]' AND ot.status='$search'";
												break;	
												
												case 0:
														$strqry = "ot.emp_num='$_SESSION[emp_num]' AND (ot.date_filed='$search' OR ot.date_ot LIKE '%$search%' OR ot.status LIKE '%$search%')";
												break;												
											}
										}else{
											$strqry = "ot.emp_num='$_SESSION[emp_num]'";
										}
									
										$str = "SELECT ot.ot_id, ot.date_ot, ot.no_of_hours, ot.cdc, ot.expected_output, ot.status, ot.remarks, ot.date_Filed, ot.time_start, ot.time_end
													FROM ems_ot as ot
													WHERE $strqry
													ORDER BY ot.ot_id DESC";
										$x = "a";
										$old = '';
										$qry = mysql_query($str);
										
										while($result = mysql_fetch_array($qry)){
											if($old != $result[0]){
												echo '<tr align="center" class="',$x,'">';
												
												// checkbox column
												chk_stat($result[5], $result[0], "ot");
												
												// date filed column
												edit_app($result[5], $result[0], "ot_edit", $result[1]);
												$old = $result[0];
												
												// details column (date_ot)
												echo '<td width="15%">',date('F d, Y', strtotime($result[1]));
												
												// details column (start time - end time)
												if($result[8] != NULL && $result[9] != NULL)
													echo '<br>Time: ', $result[8],' - ', $result[9];
												
												// number of hours
												echo '<br>',$result[2],' hour(s)</td>';
												
												// day classification column
												if($result[3] == 1){
													$result[3] = "Regular Day";
												}else if($result[3] == 2){
													$result[3] = "Rest Day/ Special Public Holiday";
												}else if($result[3] == 3){
													$result[3] = "Special Public Holiday on Rest Day";
												}else if($result[3] == 4){
													$result[3] = "Regular Holiday";
												}else if($result[3] == 5){
													$result[3] = "Regular Holiday on Rest Day";
												}
												echo '<td>',$result[3]	,'</td>';									   
												
												// expected output column
												echo '<td width="20%">',$result[4],'</td>';											
												
												// remarks column
												show_remarks($result[0]);
												
												// status column
												echo '<td><button class="btn btn-',f_color($result[5]),'">',$result[5],'</button></td>';
												echo '</tr>';
												   
												if($x=="a"){
													$x = $x . "b";
												}else{
													$x = "a";
												}
											}
										}
									?>
								</tbody>
							</table>
						</div> <!-- table-responsive -->
						
						<div class="table-buttons row">
							<?php
								echo '<button type="submit" name="cancel_ot" class="cancel pull-right btn btn-danger" onclick="return confirmation(\'cancel\',\'ot\');">Cancel</button>';
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
		<script src="js/sb-admin-2.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#overtime-requests-and-accomplishment').dataTable({
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
