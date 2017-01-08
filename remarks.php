<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);
	date_default_timezone_set('Asia/Taipei');

	include("config_DB.php");
	include("functions.php");

	chk_active($_SESSION['user_id']);
	require_once("calendar/classes/tc_calendar.php");

	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	//echo $_SESSION['user_id'];

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
	
	if(isset($_GET['ID'])){
		$qry_show = mysql_query("SELECT remarks_id, id, r.emp_num, remarks, DATE, path FROM ems_remarks AS r
													LEFT JOIN ems_photos AS p ON r.emp_num=p.emp_num
													WHERE id='$_GET[ID]'
													ORDER BY remarks_id DESC");
		$qry_name = mysql_query("SELECT emp_num, remarks FROM ems_remarks WHERE emp_num='$_SESSION[emp_num]' AND id='$_GET[ID]' ");
	}

	$names = mysql_fetch_array($qry_name);
	$count = mysql_num_rows($qry_name);
	if($count==0){
		$action = "Add remarks:";
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html>

	<head>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link rel="icon" href="../images/iEMS2.png">

		<title>iEMS</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/remarks-format.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		
		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript">
			function validate(){
			var remarks = document.form_remarks.save_remarks.value;
				// if(remarks==""){
					// alert("Please indicate your remarks.");
					// return false;
				// }else{
					// return true;
				// }
			}
		</script>
		<script type="text/javascript" src="datetime/datetimepicker.js"></script>
	
	</head>
	
	
	<body onload="document.getElementById('edit_remarks').focus();">
	
		<form name="form_remarks" action="<?php $PHP_SELF;?>" method="POST"  onsubmit="return validate();">
			<div class="remarks-container">
				<table>
					<?php $x = ($count!=0) ? "style='display: none;'" : "";?>

					<!--Add remarks-->		
					<tr>
						<td><span type="button" class="adds btn btn-primary" id="add">Add remarks</span></td>
					</tr>

					<!--for saving-->
					<tr class="add_rem" <?php echo $x;?>>
						<td><textarea name="save_remarks" id="save_remarks" cols="48" rows="3"></textarea></td>
					</tr>

					<tr class="add_rem" <?php echo $x;?>>
						<td align="right" >
							<button type="submit" name="save" class="save btn btn-primary">Save</button>
							<button type="button" class="cancel btn btn-danger" id="can_save">Cancel</button>
						</td>
					</tr>
					<!----------------->		

					<!--for editing-->			
					<?php 	
						$z = "style='display: none;'";	
						if($_GET['id']!=0){ 
							$qry = mysql_query("SELECT remarks FROM ems_remarks WHERE remarks_id='$_GET[id]' ");
							$result = mysql_result($qry, 0);
							$txt = str_replace("<br />", "", $result);
							$z = "style='display: table-row;'";
						}
					?>
					<tr class="edit_rem" <?php echo $z;?>>
						<td><textarea name="edit_remarks" id="edit_remarks" cols="48" rows="3"><?php echo $txt; ?></textarea></td>
					</tr>

					<tr class="edit_rem" <?php echo $z;?>>
						<td align="right">
							<button type="submit" name="update" class="update btn btn-primary">Update</button>
							<button type="button" class="cancel btn btn-danger" id="can_edit">Cancel</button>
						</td>
					</tr>
					<!----------------->	

					<tr>
						<td>
							<fieldset>
								<legend>Remarks:</legend>
								<label>
									<?php 		
										// if($count==0){
										// echo "No remarks to display.";
										// }else{
										$uri = htmlspecialchars($_SERVER['REQUEST_URI']);
										$pos = strpos($uri, "&");
										$str = substr($uri, 0, $pos);
										
										while($row = mysql_fetch_array($qry_show)){
											if($row[5]!=null){
												$img = $row[5];
											}else{
												$img = "photos/image.png";
											}	
											echo '<img src="',$img,'" width="50" height="50" style="border:1px solid gray; float:left;"><br/>';

											if($row[2]==$_SESSION['emp_num']){
												$edit = '&nbsp;&nbsp;<b>'.get_name($row[2]).':&nbsp;<a href="'.$str.'&id='.$row[0].'" title="Click to edit remarks" id="edit" class="edit">[Edit]</a></b> ';
											}else{
												$edit = '&nbsp;&nbsp;<b>'.get_name($row[2]).':</b> ';
											}
											echo $edit;
											echo '<i style="font-size:11px;">',$cc,'<br/>&nbsp;&nbsp;
											',$row[4],'</i><br/><br/>&nbsp;&nbsp;&nbsp;&rarr; ';
											echo $row[3].'<hr/>';
										}
									?>
								</label>
							</fieldset>
						</td>
					</tr>
					<tr><td align="right"></td></tr>
				</table>
				<div class="navbar-fixed-bottom">
				<button type="button" class="close-window btn btn-danger" onclick="window.close();">Close Window</button>
				</div>
			</form>
		</div>
	</body>
	
</html>