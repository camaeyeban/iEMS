<?php 
	ob_start();
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	include("functions.php");
	include("config_DB.php");
	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();

	if (!$dblink)
		die("no connection");

	chk_active($_SESSION['user_id']);

	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}

	// if($_SESSION['rights']!=1){
			// echo '<h1>',"Invalid URL!",'</h1>';
			// return false;
	// }

	if(isset($_GET['ID'])){
		$qry = $dblink->db_qry("SELECT dept_code, dept_name FROM ems_department WHERE dept_code='$_GET[ID]' ");
		$result = $dblink->get_data($qry);
	}

	$qry = mysql_query("SELECT dept_code FROM ems_department ORDER BY dept_code DESC");
	$count = mysql_num_rows($qry);

	if($count==0){
		$code = "DEP-0001";
	}else{
		$qry_id = mysql_result($qry, 0);
		$code = auto_num($qry_id);
	}
		

	$name = $_POST['name'];

	if(isset($_POST['submit']) && $_POST['submit']=="save"){
		$sql  = "SELECT COUNT(*) FROM ems_department where '$name' = dept_name";
		$get  = mysql_query($sql);	
		$row = mysql_fetch_array($get);
		
		if($row[0] == 0){
		 $strqry = "INSERT INTO ems_department (dept_code, dept_name)
		 VALUES('$code','$name')";
		 $qry = $dblink->db_qry($strqry);
		}
		else{
			echo "<script>alert('Company Name already exists');</script>";

		}        
		
		header("Refresh:0");
	}elseif(isset($_POST['submit']) && $_POST['submit']=="delete"){
		$chk = $_POST['del'];
		if($chk){
			foreach($chk as $del){
				$qry = $dblink->db_qry("DELETE FROM ems_department WHERE dept_code='$del' ");
			}
		}
		header("location:comp_structure.php");
	}elseif(isset($_POST['update'])){
		$sql  = "SELECT COUNT(*) FROM ems_department where '$name' = dept_name";
		$get  = mysql_query($sql);	
		$row = mysql_fetch_array($get);
		
		if($row[0] == 0){
		 $strqry = "UPDATE ems_department SET dept_name='$name' WHERE dept_code='$_POST[update]' ";
		 $qry = $dblink->db_qry($strqry);
		}
		else{
			echo "<script>alert('Company Name already exists');</script>";

		}      
		header("Refresh:0");
	}
 ?>

 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	
<html lang="en">

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" href="../images/iEMS2.png">

		<title>iEMS</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/view-requisition-modal-format.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>
		<script type="text/javascript">
			var counter = 1;
			
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
					var x = confirm("Are you sure you want to delete selected Department?");
					if(x){
						return true;
					}else{
						return false;
					}
				}else{
					alert("Select atleast one record to delete.");
					return false;
				}
				return true;
			}

			function checkAll(){
				var id = document.getElementsByName("del[]");	
				var chk = document.form_comp_struc.all.checked;
				
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

			function update(ID, name){
				document.getElementById('code').innerHTML = ID;
				var update = document.createElement("button");
				update.setAttribute("type", "submit");
				update.setAttribute("name", "update");	
				update.setAttribute("id", "update");	
				update.setAttribute("class", "update btn btn-primary");	
				update.setAttribute("value", ID);	
				update.innerHTML = "Update";
				update.onclick = function(){return validate()};
				
					if(counter==1){
						document.getElementById("button").appendChild(update);
					}else{
						var up = document.getElementById("update");
						document.getElementById("button").removeChild(up);
						document.getElementById("button").appendChild(update);
					}
					
				document.getElementById('save').style.display = "none";	
				document.getElementById("name").value = name;
				document.getElementById("name").style.fontsize = "12px";
				document.getElementById("name").focus();
				counter++;
				return true;
			}	
			
			function validate(){
				var name = document.form_comp_struc.name.value;		
				if(name==""){
					alert("Please enter department name.");
					return false;			
				}	
			}
			
			function close(){
				<?php
					$qry = mysql_query("SELECT dept_code FROM ems_department ORDER BY dept_code DESC");
					$count = mysql_num_rows($qry);

					if($count==0){
						$code = "DEP-0001";
					}else{
						$qry_id = mysql_result($qry, 0);
						$code = auto_num($qry_id);
					}
				?>
				document.getElementById('code').innerHTML = <?php echo $code ?>;
				var save = document.createElement("button");
				save.setAttribute("type", "submit");
				save.setAttribute("name", "submit");	
				save.setAttribute("id", "save");	
				save.setAttribute("class", "update btn btn-primary");	
				save.setAttribute("value", "save");	
				save.innerHTML = "Save";
				save.onclick = function(){return validate()};
				
					if(counter==1){
						document.getElementById("button").appendChild(save);
					}else{
						var up = document.getElementById("save");
						document.getElementById("button").removeChild(up);
						document.getElementById("button").appendChild(save);
					}
					
				document.getElementById('update').style.display = "none";	
				document.getElementById("name").value = name;
				document.getElementById("name").style.fontsize = "12px";
				document.getElementById("name").focus();
				counter++;
				return true;
			}
		</script>

	</head>

	
	<body vlink="blue" alink="blue" link="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<?php include("menu.php"); ?>
				
		<form name='form_comp_struc' action="<?php $PHP_SELF;?>" method='POST'>
		
			<div id="container">
			
				<div class="col-lg-12">
					
					<form name="view_ems_users" action="<?php $PHP_SELF; ?>" method="POST">
						<div class="panel-body top-bordered col-lg-12">
							
							<h2 class="summary-title">Company Info: Company Structure</h2>
							
							<div class="table-buttons row">
								<button type="submit" class="delete pull-right btn btn-danger" name="submit" value="delete" onclick="return removeChecked();">Delete</button>
								<a data-toggle="modal" data-target="#modal1">
									<button type="submit" class="add pull-right btn btn-primary" id="add" name="add">Add Department</button>
								</a>
							</div>
							
							<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<span class="modal-title">Department</span>
										</div>
										<div class="modal-body">
											<table class="add-modal">
												<tr>
													<td class="lbl modal-td">Department Code:</td>
													<td class="modal-td">
														<span id="code"><?php echo $cc = ($code) ? $code : "$result[0]";?></span>
													</td>
												</tr>
												<tr>
													<td class="lbl modal-td">Department Name:</td>
													<td class="modal-td">
														<input type='text' name='name' size="35"value="<?php echo $result[1];?>" id="name"/>
													</td>
												</tr>
											</table>
										</div>
										<div class="modal-footer" id="button">
											<div class="pull-right">
												<button type="submit" class="btn btn-primary" id="save" name="submit" value="save" onclick="return validate()">Save</button>
												<button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location = 'comp_structure.php';">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
											
											
							
							<div class="table-responsive col-lg-12">
								<table class="table table-striped table-bordered table-hover" id="company-structure-table">
									<thead>
										<tr>
											<th class="table-column-names nosort"><input type="checkbox" name="all" onclick="checkAll();" /></th>
											<th class="table-column-names">Department Code</th>
											<th class="table-column-names">Department Name</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$str = "SELECT dept_code ,dept_name FROM ems_department;";
											$qry = $dblink->db_qry($str);
											$x = "a";	
											
											while($data = $dblink->get_data($qry)){
												echo '<tr class="',$x,'" align="center">';

												//TL-2012/04/13 - Added fixed "Manager" Department in order for us to assign an OIC for them.
												if($data[0] != "DEP-0000"){
													echo '<td><input type="checkbox" name="del[]" value="',$data[0],'"/></td>';
													echo '<td><a href="#" data-toggle="modal" data-target="#modal1" onclick="update(\'',$data[0],'\',\'',$data[1],'\');" >',$data[0],'</a></td>';
													echo '<td><a href="#" data-toggle="modal" data-target="#modal1" onclick="update(\'',$data[0],'\',\'',$data[1],'\');" >',$data[1],'</a></td>';
												}else{
													echo '<td style="padding:0;"></td>';
													echo '<td>',$data[0],'</td>';
													echo '<td>',$data[1],'</td>';
												}
												echo '</tr>';
												
												if($x=="a"){
													$x = $x . "b";
												}else{
													$x = "a";
												}
											}
											ob_flush();
										?>
									</tbody>
									
								</table>
							</div> <!-- table-responsive -->
							
						</div> <!-- panel-body -->
					
					</form>
				</div> <!-- col-lg-12 -->
			</div> <!-- container -->
		</form>
		
		<?php include("footer.php"); ?>
		
		
		<script src="js/jquery.js"></script>
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#company-structure-table').dataTable( {
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