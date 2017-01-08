<?php
	ob_start();
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	include("config_DB.php");
	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();

	if (!$dblink)
		die("no connection");

	include("functions.php");
	chk_active($_SESSION['user_id']);
	chk_invalid_url();

	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	$show  = "style='display:none;'";
	$hide = "style='display:table-row;'";
	if(isset($_GET['id'])){
		$qry  = mysql_query("SELECT ecc_name, ecc_relationship, ecc_home_no, ecc_mobile_no, ecc_office_no FROM ems_emergency_contacts WHERE ec_id='$_GET[id]' ");
		$row = mysql_fetch_array($qry);
		$show = "style='display:table-row;'";
		$hide  = "style='display:none;'";
	}
	
	if($_SESSION['emp_num']==$_GET['ID'] || $_SESSION['rights']==1 || $_SESSION['rights']==5) {
		$prop = "";
		$dis = "";	
		$chk = "";
	}else{
		$prop = "readonly";
		$dis = "disabled";	
		$chk = "display:none;";
	}
	$name = $_POST['name'];
	$rel = $_POST['rel'];
	$h_no = $_POST['tel'];
	$m_no = $_POST['mobile'];
	$o_no = $_POST['worktel'];
	
	$bool = true;
	if($name == "" || $rel == "" || $m_no == "")
		$bool = false;
			
	if(isset($_POST['submit']) && $_POST['submit']=="save" && $bool){
		$str = "INSERT INTO ems_emergency_contacts (emp_num, ecc_name, ecc_relationship, ecc_home_no, ecc_mobile_no ,ecc_office_no)
					VALUES ('$_GET[ID]','$name','$rel','$h_no','$m_no','$o_no')";
		$qry = $dblink->db_qry($str);
		header("location:$PHP_SELF");
	}elseif(isset($_POST['delete'])){
		$chk = $_POST['del'];
		
		if(count($chk) > 0)
		{
			foreach($chk as $del){
				$qry = mysql_query("DELETE FROM ems_emergency_contacts WHERE ec_id='$del' ");
				if(!$qry)
					die(mysql_error());
			}
			header("Refresh:0");
		}
		else
		{
			echo "<script type = 'text/javascript'>alert('Select atleast 1 item to delete');</script>";
			header("Refresh:0");
			//header("location:view_edit_emergency.php?ID=$_GET[ID]");	
		}
	}elseif(isset($_POST['update']) && $bool){
			$qry = $dblink->db_qry("UPDATE ems_emergency_contacts SET ecc_name='$name', ecc_relationship='$rel', ecc_home_no='$h_no', ecc_mobile_no='$m_no', ecc_office_no='$o_no' WHERE ec_id='$_GET[id]' ");
			header("location:view_edit_emergency.php?ID=$_GET[ID]");	
			
	}elseif(isset($_POST['reset'])){
		header("location:view_edit_emergency.php?ID=$_GET[ID]");	
	}
	elseif(isset($_POST['update']) || isset($_POST['submit'])){
		echo "<script type = 'text/javascript'>alert('All Required Field must have inputs');</script>";
		header("Refresh:0");
		//header("location:view_edit_emergency.php?ID=$_GET[ID]");	
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
		
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/profile-forms-format.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		
		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>
		<script type="text/javascript">
			function removeChecked(){
				var id = document.getElementsByName("del[]");	
				var valid = false;
				for(var i in id){
					if(id[i].checked){
						valid = true;
						break;
					}
				}
				
				if(valid){
					var x = confirm("Are you sure you want ot delete selected record?");
						if(x){
							return true;
						}else{
							return false;
						}
				}else{
						alert("Select atleast one record to delete.");
						
						return false;
				}
			}
			
			function checkAll(){
				var id = document.getElementsByName("del[]");	
				var chk = document.form_ecc.all.checked;
				
				if(chk){
					for(var i=0; i<id.length; i++){
						id[i].checked = true;
					}		
				}else{
					for(var i=0; i<id.length; i++){
						id[i].checked = false;
					}
				}
			}
			
			function resetAll(){
				document.getElementById('update').style.display = "none";
				document.getElementById('save').style.display = "table-row";
			}
		</script>
		
	</head>

	
	<body vlink="blue" alink="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<div id="container">
			
			<?php include("menu.php"); ?>
			<?php include("side_menu.php");?>
			
			<div class="col-lg-12">
				<form name="form_ecc" action="<?php $PHP_SELF; ?>" method="POST">
					<div class="right-form">
						<div class="container">
							<div class="page-header" style="width:70%;">
								<h4><strong class="formTitle">  Emergency Contacts </strong></h4>
							</div>
						</div>
						<div>
							<div class="row col s12" style="margin-left:3%;width:70%;">
								<div class="col s6">
									<label class="right-label">Name<span class="req">*</span></label>
									<input style="font-size:13px!important;font-weight:bold!important;"class="right-input" placeholder="First Name              Middle Initial               Last Name" type='text' name="name" id="name" <?php echo $prop;?> value="<?php echo $row[0]; ?>"/>
								</div>
								<div class="col s6">
									<label class="right-label">Relationship<span class="req">*</span></label>
									<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='rel' placeholder="Relationship with the person" id="rel" <?php echo $prop;?> value="<?php echo $row[1]; ?>"/>
								</div>
							</div>
							<div class="row col s12" style="margin-left:3%;width:70%;">
								<div class="col s4">
									<label class="right-label">Home Telephone</label>
									<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" placeholder="Enter Contact Number" type='text' name='tel' id="tel" <?php echo $prop;?> value="<?php echo $row[2]; ?>"/>
								</div>
								<div class="col s4">
									<label class="right-label">Mobile<span class="req">*</span></label>
									<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" placeholder="Enter Contact Number" type='text' name='mobile' id="mob" <?php echo $prop;?> value="<?php echo $row[3]; ?>"/>
								</div>
								<div class="col s4">
									<?php if($_SESSION['rights']!=1) $read="readonly"; ?>
									<label class="right-label">Work Telephone</label>
									<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" placeholder="Enter Contact Number" type='text' name='worktel' id="work" <?php echo $prop;?> value="<?php echo $row[4]; ?>"/>
								</div><hr style="width:115%;margin-left:-3%;margin-top:12%;">
							</div><br><br><br><br><br><br>
							<div class="row col s12 form-bottom">
								<div class="col s12" style="margin-top: -20%;margin-left:-115%;">
									<div class="note">
										<span class="note-label">NOTE: </span>
										Fields marked with an asterisk <span class="req">*</span> are required.
									</div>
								</div>
								<div class="form-bottom-button" style="margin-top:-15%;">
									<button style="margin-left:-260%;" type="submit" class="save btn btn-primary" id="save" name="submit" value="save" <?php echo $hide;?> />Save</button>
									<button type="submit" class="update  btn btn-primary" id="update" name="update" <?php echo $show;?> />Update</button>
									<button type="submit" class="delete  btn btn-danger" name="delete" value="delete" onclick="return removeChecked();"/>Delete</button>
									<button type="submit" name="reset" class="reset btn btn-warning"/>Reset</button>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover" id="emergency-contacts-table" >
							<thead>
								<tr>
									<th style="<?php echo $chk; ?>">
										<input type="checkbox" class="filled-in"  id="filled-in-box-all" name="all" onclick="checkAll();"/>
										<label for="filled-in-box-all"></label>
									</th>
									<th class="table-column-names">Name</th>
									<th class="table-column-names">Relationship</th>
									<th class="table-column-names">Home Tel.</th>
									<th class="table-column-names">Mobile</th>
									<th class="table-column-names">Work Tel.</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$uri = htmlspecialchars($_SERVER['REQUEST_URI']);
									$pos = strpos($uri."&", "&");
									$str = substr($uri, 0, $pos);					
									$strqry = "SELECT ecc_name, ecc_relationship, ecc_home_no, ecc_mobile_no, ecc_office_no, ec_id FROM ems_emergency_contacts 
													WHERE emp_num='$_GET[ID]' ";
									$qry = $dblink->db_qry($strqry);
									$x = "a";
									$i = 0;
									while($result = $dblink->get_data($qry)){
										echo '<tr align="center" class="',$x,'">';
										echo '
											<td style="',$chk,'">
												<input type="checkbox" class="filled-in" id="filled-in-box',$i,'" name="del[]" value="',$result[5],'"/>
												<label for="filled-in-box',$i,'"></label>
											</td>
										';	
									  
										if($_SESSION['rights']==2 && $_SESSION['emp_num']!=$_GET['ID']){
											echo '<td>',$result[0],'</td>';
										}else{
											echo '<td><a href="'.$str.'&id=',$result[5],'" onclick="edit(\'',$result[0],'\',\'',$result[1],'\',\'',$result[2],'\',\'',$result[3],'\',\'',$result[4],'\',',$result[5],')">',$result[0],'</a></td>';								
										}

										echo '<td>',$result[1],'</td>';
										echo '<td>',$result[2],'</td>';
										echo '<td>',$result[3],'</td>';
										echo '<td>',$result[4],'</td>';
										echo '</tr>';
									  
										if($x=="a"){
												$x = $x . "b";
										}else{
													$x = "a";
										}
										$i++;
									}
									ob_flush();
								?>
							</tbody>
						</table>

					</div>
				</form>
			</div> <!-- col-lg-12 -->
		</div> <!-- container -->
		
		
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
				$('#emergency-contacts-table').dataTable();
			});
		</script>
		
    </body>

</html>