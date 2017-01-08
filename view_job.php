<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();

	if (!$dblink)
		die("no connection");

	include("functions.php");
	chk_active($_SESSION['user_id']);

	if(!isset($_SESSION['username'])){
		header("location: login.php");
		exit;
	}

	if(isset($_POST['delete_job_title']) && $_POST['delete_job_title']=="delete_job_title"){
		$chk = $_POST['del'];
		if($chk){
			foreach($chk as $del){
				$qry = $dblink->db_qry("DELETE FROM ems_jobtitle WHERE job_title_code='$del' ");
			}
		}
	}elseif(isset($_POST['delete_job_level']) && $_POST['delete_job_level']=="delete_job_level"){
		$chk = $_POST['del'];
		if(count($chk) > 0){
			if($chk){
				foreach($chk as $del){
					$qry = $dblink->db_qry("DELETE FROM ems_joblevel WHERE jl_id='$del' ");
				}
			}
		}
	}elseif(isset($_POST['delete_emp_status']) && $_POST['delete_emp_status']=="delete_emp_status"){
		$chk = $_POST['del'];
		if(count($chk) > 0)
		foreach($chk as $del){
			$qry = $dblink->db_qry("DELETE FROM ems_emp_status WHERE code='$del' ");
		}
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
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">
		<link href="css/plugins/social-buttons.css" rel="stylesheet">

		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>
		<script type="text/javascript">
			function info1(ID){
				window.open("job_title.php?ID="+ID,"_self");
			}

			function removeCheckedJobTitle(){
				var id = document.getElementsByName("del[]");	
				
				if(id.length==0){
					return false;
				}
				
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

			function checkAllJobTitle(){
				var id = document.getElementsByName("del[]");	
				var chk = document.view_jobtitle.all.checked;
				
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
		</script>
		<script type="text/javascript">
			function info2(ID){
				window.open("job_level.php?ID="+ID,"_self");
			}

			function removeCheckedJobLevel(){
				var id = document.getElementsByName("del[]");	
				
				if(id.length==0){
					return false;
				}
				
				var valid = false;
				for(var i in id){
					if(id[i].checked){
						valid = true;
						break;
					}
				}
				
				if(valid){
					var x = confirm("Are you sure you want to delete selected job level?");
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

			function checkAllJobLevel(){
				var id = document.getElementsByName("del[]");	
				var chk = document.view_joblevel.all.checked;
				
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
		</script>
		<script type="text/javascript">
			function info3(ID){
				window.open("emp_status.php?ID="+ID,"_self");
			}

			function removeCheckedEmpStatus(){
				var id = document.getElementsByName("del[]");	
				
				if(id.length==0){
					return false;
				}
				
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
			
			function checkAllEmpStatus(){
				var id = document.getElementsByName("del[]");	
				var chk = document.view_empstats.all.checked;
				
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
		</script>
	</head>

	<body vlink="blue" alink="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		
		<?php include("menu.php"); ?>
		<br/>
		
		<div id="container">
			
			<div class="col-lg-12" id="tab-container">
					
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation"><a href="#job-title" aria-controls="job-title" role="tab" data-toggle="tab">Job Titles</a></li>
					<li role="presentation"><a href="#job-level" aria-controls="job-level" role="tab" data-toggle="tab">Job Levels</a></li>
					<li role="presentation"><a href="#employment-status" aria-controls="employment-status" role="tab" data-toggle="tab">Employment Status</a></li>
				</ul>
				
				<div class="tab-content">
				
<!------------------------------------------------ JOB TITLE ------------------------------------------------>
	
					<div role="tabpanel" class="tab-pane active" id="job-title">
		
						<div class="panel-body col-lg-12">
							<form name="view_jobtitle" action="<?php $PHP_SELF; ?>" method="POST">
								
								<h2 class="summary-title">Job: Job Title</h2>
								
								<div class="table-buttons row">
									<button type="submit" class="delete_job_title pull-right btn btn-danger" name="delete_job_title" value="delete_job_title" onclick="return removeCheckedJobTitle();">Delete</button>
									<button type="button" class="add pull-right btn btn-primary" onclick="window.location = 'job_title.php';">Add</button>
								</div>
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="job-title-table">
										<thead>
											<tr>
												<th class="table-column-names nosort"><input type="checkbox" name="all" onclick="checkAllJobTitle();"/></th>
												<th class="table-column-names">ID</th>
												<th class="table-column-names">Job Title Name</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$by = $_POST['searchby'];
												$search = $_POST['search'];
												if(isset($_POST['submit']) && $_POST['submit']=="search"){
													switch($by)
													{
													case 0:
														$str = "SELECT job_title_code, job_title_name FROM ems_jobtitle WHERE job_title_code='$search' OR job_title_name LIKE '%$search%' ";
														break;																	
													case 1:	
														$str = "SELECT job_title_code, job_title_name FROM ems_jobtitle WHERE job_title_code='$search' ";
														break;
													case 2:
														$str = "SELECT job_title_code, job_title_name FROM ems_jobtitle WHERE job_title_name='$search' ";
														 break;
													}
												}else{
													$str = "SELECT job_title_code, job_title_name FROM ems_jobtitle";
												}
						
												$qry = mysql_query($str);
												$count = mysql_num_rows($qry);
												if($count==0){
													echo '<tr><td colspan="4">No records to display.</td></tr>';
												}
												$x = "a";
												
												while($data = mysql_fetch_array($qry)){
													echo '<tr align="center" class="',$x,'">';
													echo '<td style="padding:0;"><input type="checkbox" name="del[]" value="',$data[0],'"/></td>';																
													echo '<td><a href="#" onclick="info1(',$data[0],');">',$data[0],'</a></td>';
													echo '<td><a href="#" onclick="info1(',$data[0],');">',$data[1],'</a></td>';
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
								
							</form>
						</div> <!-- panel-body -->
				
					</div> <!-- tab-pane (3) for job title -->
					
<!------------------------------------------------ JOB LEVEL ------------------------------------------------>
					
					<div role="tabpanel" class="tab-pane active" id="job-level">
		
						<div class="panel-body col-lg-12">
							<form name="view_joblevel" action="<?php $PHP_SELF; ?>" method="POST">

								<h2 class="summary-title">Job: Job Level</h2>
								
								<div class="table-buttons row">
									<button type="submit" class="delete_job_level pull-right btn btn-danger" name="delete_job_level" value="delete_job_level" onclick="return removeCheckedJobLevel();">Delete</button>
									<button type="button" class="add pull-right btn btn-primary" onclick="window.location = 'job_level.php';">Add</button>
								</div>
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="job-level-table">
										<thead>
											<tr>
												<th class="table-column-names nosort"><input type="checkbox" name="all" onclick="checkAllJobLevel();"/></th>
												<th class="table-column-names">Rank</th>
												<th class="table-column-names">Level</th>
												<th class="table-column-names">Grade</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$by = $_POST['searchby'];
												$search = $_POST['search'];
												if(isset($_POST['submit']) && $_POST['submit']=="search"){
													switch($by)
													{
													case 0:
														$str = "SELECT jl_id, job_level, rank, grade FROM ems_joblevel WHERE rank LIKE '%$search%' OR job_level='$search' OR grade='$search' ";
														break;																	
													case 1:	
														$str = "SELECT jl_id, job_level, rank, grade FROM ems_joblevel WHERE job_level='$search' ";																		
														break;
													case 2:
														$str = "SELECT jl_id, job_level, rank, grade FROM ems_joblevel WHERE rank='$search' ";																	
														 break;
													case 3:
														$str = "SELECT jl_id, job_level, rank, grade FROM ems_joblevel WHERE grade='$search' ";																	
														 break;																		 
													}
												}else{
													$str = "SELECT	jl_id, job_level, rank, grade FROM ems_joblevel";
												}
			
												$qry = mysql_query($str);
												$count = mysql_num_rows($qry);
												if($count==0){
													echo '<tr><td colspan="4">No records to display.</td></tr>';
												}
												$x = "a";

												while($data = mysql_fetch_array($qry)){
													echo '<tr align="center" class="',$x,'">';
													echo '<td style="padding:0;"><input type="checkbox" name="del[]" value="',$data[0],'"/></td>';			
													echo '<td><a href="#" onclick="info2(',$data[0],');">',$data[2],'</a></td>';
													echo '<td><a href="#" onclick="info2(',$data[0],');">',$data[1],'</a></td>';
													echo '<td><a href="#" onclick="info2(',$data[0],');">',$data[3],'</a></td>';
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
							</form>
						</div> <!-- panel-body -->
					</div> <!-- tab-pane (2) for job level -->

<!------------------------------------------------ EMPLOYMENT STATUS ------------------------------------------------>
	
					<div role="tabpanel" class="tab-pane active" id="employment-status">
		
						<div class="panel-body col-lg-12">
							<form name="view_empstats" action="<?php $PHP_SELF; ?>" method="POST">

								<h2 class="summary-title">Job: Employement Status</h2>
								
								<div class="table-buttons row">
									<button type="submit" class="delete_emp_status pull-right btn btn-danger" name="delete_emp_status" value="delete_emp_status" onclick="return removeCheckedEmpStatus()">Delete</button>
									<button type="button" class="add pull-right btn btn-primary" onclick="window.location = 'emp_status.php';">Add</button>
								</div>
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="employment-status-table">
										<thead>
											<tr>
												<th class="table-column-names nosort"><input type="checkbox" name="all" onclick="checkAllEmpStatus();"/></th>
												<th class="table-column-names">Employment Status ID</th>
												<th class="table-column-names">Employment Status Name</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$by = $_POST['searchby'];
												$search = $_POST['search'];
												if(isset($_POST['submit']) && $_POST['submit']=="search"){
													switch($by)
													{
													case 0:
														$str = "SELECT code, name FROM ems_emp_status WHERE code='$search' OR name LIKE '%$search%' ";
														break;																	
													case 1:	
														$str = "SELECT code, name FROM ems_emp_status WHERE code='$search' ";																		
														break;
													case 2:
														$str = "SELECT code, name FROM ems_emp_status WHERE name='$search' ";																	
														 break;
													}
												}else{
													$str = "SELECT code, name FROM ems_emp_status";
												}
						
												$qry = mysql_query($str);
												$count = mysql_num_rows($qry);
												if($count==0){
													echo '<tr><td colspan="4">No records to display.</td></tr>';
												}
												$x = "a";
												while($data = mysql_fetch_array($qry)){
													echo '<tr align="center" class="',$x,'">';
													echo '<td><input type="checkbox" name="del[]" value="',$data[0],'"/></td>';
													echo '<td><a href="#" onclick="info3(\'',$data[0],'\');">',$data[0],'</a></td>';
													echo '<td><a href="#" onclick="info3(\'',$data[0],'\');">',$data[1],'</a></td>';
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
							</form>
						</div> <!-- panel-body -->
						
					</div> <!-- tab-pane (3) for employment status -->
					
				</div> <!-- tab-content -->
			</div> <!-- col-lg-12 -->
		</div> <!-- container -->
		
		
		<?php include("footer.php"); ?>
		
		
		<script type="text/javascript">
			$(document).ready( function() {
				$('#tab-container').easytabs();
			});
		</script>
		<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script> 
		<script src="js/jquery.hashchange.min.js" type="text/javascript"></script>
		<script src="js/jquery.js"></script>
		<script src="js/jquery.easytabs.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#job-title-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			$(document).ready(function() {
				$('#job-level-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			$(document).ready(function() {
				$('#employment-status-table').dataTable({
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

