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

	if(isset($_POST['cancel_ob'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_ob SET status='Cancelled' WHERE ob_id='$cancel' ");
			}
		}
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	
<html lang="en"><title>iEMS</title>
	
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
			function load_ob(ID,action){
				window.open("ob.php?ID="+ID+"&action="+action,"_self");
			}
				
			function cancel(){
				var x = confirm("Cancel official business application?");
				if(x){
					return true;
				}else{
					return false;
				}
			} 
		</script>

	</head>
	
	
	<body vlink="green" alink="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		
		<?php include("menu.php"); ?>

		<form name="form_ob_request" action="<?php $PHP_SELF;?>" method="POST">
			<div id="container">
				
				<div class="col-lg-12">
					
					<div class="panel-body top-bordered col-lg-12">
						<h2 class="summary-title">My Old Official Business Requests</h2>
						
						<div class="table-buttons row">
						<?php
							if($_SESSION['rights']==3){
								echo '<a href="view_edit_ob.php" class="a upper-link tabbed smaller-link-margin">View My New Official Business Requests</a>';
							}else{
								echo '<a href="view_ob_request.php?searchby=0&search=&submit=search" class="a upper-link smaller-link-margin"> View My New Official Business Requests </a>';
							}
						?>
						</div>
						
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="ob-applications-table">
								<thead>
									<tr>
										<th class="nosort"> </th>
										<th class="table-column-names">Date Filed</th>
										<th class="table-column-names">From-To</th>
										<th class="table-column-names">Client/Branch</th>
										<th class="table-column-names">Details</th>
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
														$strqry = "o.emp_num='$_SESSION[emp_num]' AND date_filed='$search'";
												break;
												
												case 2:
														$strqry = "o.emp_num='$_SESSION[emp_num]' AND (ob_from='$search' OR ob_to='$search' ) ";
												break;

												case 3:
														$strqry = "o.emp_num='$_SESSION[emp_num]' AND client_branch='$search'";
												break;			
												
												case 4:
														$strqry = "o.emp_num='$_SESSION[emp_num]' AND status='$search'";
												break;					
												
												case 0:
														$strqry = "(o.emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search%') OR (o.emp_num='$_SESSION[emp_num]' AND (ob_from LIKE '%$search%' OR ob_to LIKE '%$search%')) OR 
														(o.emp_num='$_SESSION[emp_num]' AND client_branch LIKE '%$search%') OR (o.emp_num='$_SESSION[emp_num]' AND status LIKE '%$search%') ";
												break;												
											}

										}else{
												$strqry = "o.emp_num='$_SESSION[emp_num]'";
										}
										$str = "SELECT date_Filed, ob_from, ob_to, client_branch, purpose, departure, arrival, total, status, ob_id, remarks
													FROM ems_ob as o
													INNER JOIN ems_employee as e
													ON o.emp_num = e.emp_num
													WHERE $strqry
													ORDER BY ob_id DESC";	
										
										$x = "a";
										$qry = mysql_query($str);
										
										while($result = mysql_fetch_array($qry)){							
											echo '<tr align="center" class="',$x,'">';
											
											// checkbox column
											chk_stat("Cancelled", $result[9], "ob");
											
											// date filed column
											edit_app("", $result[9], "ob_edit", $result[0]);
											
											// from - to column
											if($result[2]=="0000-00-00"){
												echo '<td>',date('F d, Y', strtotime($result[1])),'</td>';
											}else{
												echo '<td>',date('F d, Y', strtotime($result[1])),' - ',date('F d, Y', strtotime($result[2])),'</td>';
											}
											
											// client/branch column
											echo '<td>',$result[3],'<br>';
											
											//Purpose
											$pur = explode("|", $result[4]);
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
											
											// departure
											echo '<td>Departure: ',display_time(trim($result[5])),'<br>';
											
											// arrival
											if($result[2]!="0000-00-00" && !($result[1] == $result[2])){
												echo 'Arrival: ',display_time_2($result[6]),'<br>';	
											}else{
												echo 'Arrival:',display_time($result[6]),'<br>';
											}
											//echo '<td>',display_time($result[6]),'</td>';
											
											// total duration
											echo $result[7],' (hr.min)</td>';	

											// remarks column
											show_remarks($result[9]);
											
											// status column
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
