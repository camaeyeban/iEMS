<?php
	ob_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);
	session_start();

	include("config_DB.php");
	include("functions.php");
	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();

	if (!$dblink)
		die("no connection");

	chk_active($_SESSION['user_id']);
	
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}	
	if(isset($_POST['add_days'])){
		$sql = "Insert ems_special_days (date_from,date_to,name,type) value ('$_POST[from]','$_POST[to]','$_POST[name]','$_POST[type]')";
		$get = mysql_query($sql);
		
		if(!$get)
			die(mysql_error());
		else
			echo "<script>alert('Successfully Added : ". $_POST['name'] ."\non " . $_POST['from'] . " to " . $_POST['to'] ."');</script>";
	
		header('location:special_days.php');
	}elseif($_POST['editdays'] == 'Edit Record')
	{
		$sql = "update ems_special_days set date_from = '" . $_POST['from'] . "', date_to = '" . $_POST['to'] ."', name = '" . $_POST['name'] . "', type = '" . $_POST['type'] ."' where id = '" . $_GET['ID'] . "'";
		$get = mysql_query($sql);
		
		if(!$get)
			die(mysql_error());
		else
		{
			echo "<script>alert('Successfully Edited : ". $_POST['name'] ."\non " . $_POST['from'] . " to " . $_POST['to'] ."');</script>";
			header('location:special_days.php');
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
		<link href="css/special-days-modal-format.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript" src="jquery.tools.min.js"></script>
        <script type="text/javascript" src="easy.notification.js"></script>
        <script type="text/javascript" src="jquery.cookie.js"></script>
		<script type="text/javascript">
            $(document).ready(function(){
				function load_lv(ID,action){
					window.open("leave_undertime.php?ID="+ID+"&action="+action,"_self");
				}
				function load_un(ID,action){
					window.open("leave_undertime.php?ID="+ID+"&action="+action,"_self");
				}
				function load_ot(ID,action){
					window.open("ot.php?ID="+ID+"&action="+action,"_self");
				}
				function load_ob(ID,action){
					window.open("ob.php?ID="+ID+"&action="+action,"_self");
				}
				function load_off(ID,action){
					window.open("offset.php?ID="+ID+"&action="+action,"_self");
				}	  
				function load_rsrv(ID,action){
					window.open("equip_request.php?ID="+ID+"&action="+action,"_self");
				}	  
				function load_air(ID,action){
					window.open("airticket.php?ID="+ID+"&action="+action,"_self");
				}
			}
        </script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
		$(function() {
			$( "#from" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: false,
				numberOfMonths: 1,
				onClose: function( selectedDate ) {
					$( "#to" ).datepicker( "option", "minDate", selectedDate );
				}
			});
			$( "#to" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: false,
				numberOfMonths: 1,
				onClose: function( selectedDate ) {
					$( "#from" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
		});
		</script>
		<script type="text/javascript">
		function del_doClick(){
			var x = confirm("Are you sure you want to delete this event?");
			if(x) return true;
			else return false;
		}
		function add_doClick(){
			var x = confirm("Are you sure you want to add this event?");
			if(x) return true;
			else return false;
		}
		function doClick(){
			var x = confirm("Are you sure you want to edit this event?");
			if(x) return true;
			else return false;
		}
		</script>
		
	</head>
	
	
    <body alink="#1f57a0" vlink="#1f57a0" link="#1f57a0" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
            
		<?php include("menu.php");?>
		<br/>
    	
		<div id="container">
			
			<div class="col-lg-12">
				
				<div class="panel-body top-bordered col-lg-12">
					
					<h2 class="summary-title">Special Days for this Year</h2>
					
					<div class="table-buttons row">
						<?php
							echo '
								<a data-toggle="modal" data-target="#modal1">
									<button class="add btn btn-primary">Add Special Day</button>
								</a>
							';
						?>
					</div>
					
					
					<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<form method = 'post' action="<?php $PHP_SELF;?>">
									<div class="modal-header">
										<span class="modal-title">New Special Day</span>
									</div>
									<div class="modal-body">
										<table class="add-modal">
											<tr>
												<td class="lbl modal-td">Name:</td>
												<td class="modal-td">
													<input type="text" size="30" name='name' placeholder='Name of special day' value="<?php echo $row[1]; ?>" required/>
												</td>
											</tr>
											<tr>
												<td class="lbl modal-td">Date From:</td>
												<td class="modal-td">
													<input type="text" size="30" id="from" name="from" placeholder = <?php echo date("Y-m-d");?> value="<?php echo $row[2]; ?>" required/>
												</td>
											</tr>
											<tr>
												<td class="lbl modal-td">Date To:</td>
												<td class="modal-td">
													<input type="text" size="30" id="to" name="to" value="<?php echo $row[3]; ?>" placeholder = <?php echo date("Y-m-d");?> required/>
												</td>
											</tr>
											<tr>
												<td class="lbl modal-td">Type:</td>
												<td class="modal-td">
													<input type="text" size="30" name = 'type' placeholder = 'Type' value="<?php echo $row[4]; ?>" required/>
												</td>
											</tr>
										</table>
									</div>
									<div class="modal-footer">	
										<button type='submit' name='add_days' class="btn btn-primary" onclick='return add_doClick()'>Add Special Day</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					
					<div class="table-responsive col-lg-12">
						<table class="table table-striped table-bordered table-hover" id="ob-requests-table">
							<thead>
								<tr>
									<th class="table-column-names">Date From</th>
									<th class="table-column-names">Date To</th>
									<th class="table-column-names">Name</th>
									<th class="table-column-names">Type</th>
									<th> </th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql = "SELECT * FROM ems_special_days WHERE date_from LIKE '%" . date('Y') . "%' order by 2";
									$get = mysql_query($sql);
									
									while($row = mysql_fetch_array($get))
									{
										echo "<tr align='center'>";
										echo "	<td>" . date('F d, Y', strtotime($row[1])) . "</td>";
										echo "	<td>" . date('F d, Y', strtotime($row[2])) . "</td>";
										echo "	<td>" . $row[3] . "</td>";
										echo "	<td>" . $row[4] . "</td>";
										echo " 	<td>
													<a data-toggle='modal' data-target='#modal1'>
														<button class='btn btn-warning'>Edit</button>
													</a>
													<a href = 'process_special_days.php?ID=".$row[0]."&action=DELETE' class = 'a' onclick='return del_doClick()'>
														<button class='btn btn-danger'>Remove</button>
													</a>
											</td>";
										echo "</tr>";
									}
									ob_flush();
								?>
							</tbody>
						</table>
					</div> <!-- table-responsive -->
					
				</div> <!-- panel-body -->
				
			</div> <!-- col-lg-12 -->
		</div> <!-- container -->
		
		<?php include("footer.php"); ?>
		
			<form method = "POST" action="<?php $PHP_SELF;?>">
			
			<?php
				if($_GET['action'] == 'EDIT')
				{
					$sql = 'SELECT * FROM ems_special_days where id = ' . $_GET['ID'];
					$get = mysql_query($sql);
					
					if(mysql_num_rows($get) > 0)
					{
						echo "<br/><div class = 'cc'>";
						echo "	<span class = 'title'>Special Days</span>";
						echo "</div>";
						echo "<div class = 't' style = 'width : 50%'>";
						echo "<table border = 0 width = 100% id = 't_color'>";
				
						while($row = mysql_fetch_array($get))
						{
							echo "<tr>";
							echo "	<th>Date From</th>";
							echo "	<td style = 'text-align:center;'><input type = 'text' style = 'width : 100%; text-align : center;' name = 'from' id = 'from' value = '" . $row[1] . "' required/></td>";
							echo "</tr>";
							echo "<tr>";
							echo "	<th>Date To</th>";
							echo "	<td style = 'text-align:center;'><input type = 'text' style = 'width : 100%; text-align : center;' name = 'to' id = 'to' value = '" . $row[2] . "' required/></td>";
							echo "</tr>";
							echo "<tr>";
							echo "	<th>Name</th>";
							echo "	<td style = 'text-align:center;'><input type = 'text' style = 'width : 100%; text-align : center;' name = 'name' id = 'name' value = '" . $row[3] . "' required/></td>";
							echo "</tr>";
							echo "<tr>";
							echo "	<th>Type</th>";
							echo "	<td style = 'text-align:center;'><input type = 'text' style = 'width : 100%; text-align : center;' name = 'type' id = 'type' value = '" . $row[4] . "' required/></td>";
							echo "</tr>";
						}
						echo "<tr>";
						echo "	<td colspan = 2><center><input type = 'submit' name = 'editdays' value = 'Edit Record' style  = 'background : url(icons/edit_record.png); color: transparent;width:14%; height:45%;' onclick = 'return doClick()' onclick = 'return doClick()'/>
								<input type = 'submit' name = 'editdays' value = 'Cancel' style  = 'background : url(icons/cancel2.png); width:11%;color: transparent; height:35%;' /></center></td>";
						echo "</tr>";
						echo "</table>";
						echo "</form>";
						echo "</div>";
					}
				}
				ob_flush();
			?>
		
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
				$('#ob-requests-table').dataTable();
			});
		</script>
		
    </body>
	
</html>