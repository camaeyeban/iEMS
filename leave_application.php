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

	if($_SESSION['rights']!=1 && $_SESSION['rights']!=4){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
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
			function open_win(ID, action){
				var left = parseInt((screen.availWidth/2) - (650/2));
				var top = parseInt((screen.availHeight/2) - (320/2));
				window.open("accomplishment.php?ID="+ID+"&action="+action,"_blank","toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=650, height=320");
			}
		</script>
		
	</head>
	
	
	<body vlink="green" alink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

		<?php include("menu.php"); ?>
	
		<form name="form_view_ot" action="<?php $PHP_SELF;?>" method="POST">
			<div id="container">
				
				<div class="col-lg-12">
					
					<div class="panel-body top-bordered col-lg-12">
						<form name="form_leave" action="<?php $PHP_SELF ?>" method="POST">

							<h2 class="summary-title">Approved Leave Application</h2>
						
							<div class="table-buttons row">
								<a href="apply_leave.php" class="a upper-link tabbed">Apply Employee's Leave Application</a>						
							</div>
							
							<div class="table-responsive col-lg-12">
								<table class="table table-striped table-bordered table-hover" id="leave-applications-table">
									<thead>
										<tr>
											<th class="table-column-names">Employee Number</th>
											<th class="table-column-names">Employee Name</th>
											<th class="table-column-names">Details</th>
											<th class="table-column-names">Reason</th>
											<th class="table-column-names">Remarks</th>
											<th></th>
											</tr>
									</thead>
									<tbody>
										<?php
											$by = $_POST['searchby'];
											$search = $_POST['search'];
											
											if(isset($_POST['submit']) && $_POST['submit']=="search_lv"){				
												switch($by){
													case 1:
															$strqry = " date_filed='$search'";											
													break;
												
													case 2:
															$strqry = " (d_from='$search' OR d_to='$search')";		
													break;
												
													case 3:
															$strqry = " type='$search'";							
													break;
													
													case 4:
															$strqry = " (emp_lastname LIKE '%$search%' OR emp_firstname LIKE '%$search%') ";
													break;
													
													case 0:
															$strqry = " (date_filed LIKE '%$search%' 
																OR (d_to LIKE '%$search%' OR d_from LIKE '%$search%') OR ( TYPE LIKE '%$search%'))
																OR (emp_lastname LIKE '%$search%' OR emp_firstname LIKE '%$search%') ";
													break;
												}
											}
											else{
												$strqry = 1;
											}
											$str = "SELECT a.date_Filed, a.d_from, a.d_to, a.no_of_days, a.type, a.reason, a.status, a.leave_id, a.remarks, a.emp_num, b.emp_lastname , b.emp_firstname FROM ems_leave as a 
														INNER JOIN ems_employee as b on a.emp_num = b.emp_num
														WHERE a.status = 'Approved' and $strqry ORDER BY d_from DESC";
											$x = "a";
											$cnt = 1;
											$qry = mysql_query($str);
											
											while($result = mysql_fetch_array($qry)){
												if($result[6] == 'Approved'){
												//JD-2012/06/20 - show 0.5 with AM|PM indicator under leave only
												//$hd = ($result[3]-$result[8]." ".substr($result[8],-4, 2));  
												//JD-2014/01/06 - fixed to avoid problems in the future
												//$hd = $result[3]-$result[8]; 
													$hd = $result[3]-substr("$result[8]",0 ,2);
													
													echo '<tr align="center" class="',$x,'">';
													// chk_stat($result[6], $result[7],"chk".$cnt);
													
													// employee number column
													echo '<td>'.$result[9].'</td>';
													
													// employee name column
													echo '<td>'.$result[10] . ", " . $result[11].'</td>';
													
													// details column (type)
													echo '<td width="23%">',$result[4],'<br>';	

													// details column (from-to)
													echo date('F d, Y', strtotime($result[1]))." - ".date('F d, Y', strtotime($result[2])),'<br>';
					
													//JD-2013/04/22 - add condition here that when $result[3]==0 or empty, show only $result[8]
					
													$strVar = $result[8];
													$numInt = strlen($strVar);
													
													// details column (number of days)
													if($numInt==8){
														echo $result[3],' day(s)</td>';	
													}else{
														echo $hd,' day(s)</td>';
													}
													
													// reason column
													echo '<td>',$result[5],'</td>';	

													// remarks column
													show_remarks($result[7]);
													
													// Edit Records Column
													echo "<td width='8%'><a class = 'remarks' target = '_self' href = 'leave_undertime.php?ID=".$result[7]."&action=leave_edit&emp_num=".$result[9]."'>Edit Record</a></td>";									
													echo '</tr>';
						
													if($x=="a"){
														$x = $x . "b";
													}else{
														$x = "a";
													}
													$cnt++;
												}
											}
										?>
									</tbody>
								</table>
							</div> <!-- table-responsive -->
						</form>
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
				$('#leave-applications-table').dataTable();
			});
		</script>
		
	</body>
	
</html>
