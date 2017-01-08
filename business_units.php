<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	include("functions.php");
	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();

	if (!$dblink){
		die("no connection");
	}
	
	chk_active($_SESSION['user_id']);
		
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}

	function oic($OIC){
		//TL-2012/04/12 - Revised query to show name of OIC.
		//$qry = mysql_query("SELECT dept_code, dept_name FROM ems_department WHERE dept_name='$OIC' ");
		$qry = mysql_query("SELECT emp_num, CONCAT(emp_firstname, ' ',emp_lastname) AS firstlast 
								FROM ems_employee 
								WHERE CONCAT(emp_firstname, ' ', emp_lastname) = '$OIC' ");
		$data = mysql_fetch_array($qry);
		if($OIC==$data[1]){
			return $data[0];
		}else{
			return "None";
		}
	}
	
	function rt($name){
		$qry = mysql_query("SELECT emp_num, CONCAT(emp_firstname, ' ',emp_lastname) AS firstlast 
								FROM ems_employee 
								WHERE CONCAT(emp_firstname, ' ', emp_lastname) = '$name' ");
		$data = mysql_fetch_array($qry);
		if($name==$data[1]){
			return $data[0];
		}else{
			return "None";
		}
	}

     $dept_name = $_POST['dept'];
     $manager_name = $_POST['manager'];
	 $oic = $_POST['oic'];
	 $oo = oic($oic);
	 $report_to = rt($_POST['report_to']);
	 
	if(isset($_POST['submit']) && $_POST['submit']=="save"){
		$strqry = "INSERT INTO ems_business_units (dept_code, b_manager_name, oic, report_to)
		VALUES ('$dept_name', '$manager_name', '$oo', '$report_to')";
		$query = $dblink->db_qry($strqry);
		 
	}elseif(isset($_POST['update'])){
		echo $qry = $dblink->db_qry("UPDATE ems_business_units SET b_manager_name='$manager_name', dept_code='$dept_name', oic='$oo', report_to='$report_to' 
			WHERE b_id='$_POST[update]'");
		//header("location:business_units.php");	
	}elseif(isset($_POST['delete'])){
		$chk = $_POST['del'];
		if($chk){
			foreach($chk as $del){
				$qry = $dblink->db_qry("DELETE FROM ems_business_units WHERE b_id='$del' ");
			}
		}
		header("location:business_units.php");
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


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
		<link href="css/business-units-modal-format.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript" src="validator.js"></script>
        <script type="text/javascript">
            $("a").click(function(){
                return false;
            });

            var counter = 1;

            function validate(){
                var dept = document.form_buss_units.dept.value;
                var manager = document.form_buss_units.manager.value;

				if(dept=="--Select--" && manager=="--Select--"){
					alert("Please select department. \nPlease select manager.");
					return false;
				}else if(dept=="--Select--" && manager!="--Select--"){
					alert("Please select department.");
					return false;
				}else if(dept!="--Select--" && manager=="--Select--"){
					alert("Please select manager.");
					return false;
				}
            }

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
					var x = confirm("Are you sure you want to delete selected department?");
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
                var chk = document.form_buss_units.all.checked;

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

            function get(dept, name, ID, d_code, d_oic, report_to){
            
                var sel = document.getElementsByName('item');
                var dd =  document.getElementById('c_dept');
                var nn = document.getElementById('c_name');
                var ooo = document.getElementById('oic');
                var report = document.getElementById('report');

				dd.innerHTML = dept;
				dd.value = d_code;
				nn.innerHTML = name;
				ooo.innerHTML = d_oic;
				report.innerHTML = report_to;

                var update = document.createElement("button");
                update.setAttribute("type", "submit");
                update.setAttribute("name", "update");	
                update.setAttribute("id", "update");	
                update.setAttribute("class", "update btn btn-primary btn-large");	
                update.setAttribute("value", ID);
				update.innerHTML = "Update";

				if(counter==1){
					document.getElementById("button").appendChild(update);
				}else{
					var up = document.getElementById("update");
					document.getElementById("button").removeChild(up);
					document.getElementById("button").appendChild(update);
				}

                document.form_buss_units.oic.disabled = false;
                document.form_buss_units.report_to.disabled = false;
                document.getElementById('save').style.display = "none";	
                document.getElementById('dept').focus();
                counter++;

				return true;
			}
        </script>
		
    </head>
	
	
    <body vlink="blue" alink="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

		<?php include("menu.php"); ?>

	    <form name='form_buss_units' action="business_units.php" method="POST">
	
			<div id="container">
			
				
				<div class="col-lg-12">
					
					<div class="panel-body top-bordered col-lg-12">
						
						<h2 class="summary-title">Company Info: Business Units</h2>
						
						<div class="table-buttons row">
							<button type="submit" class="delete btn pull-right btn-danger" name="delete" value="delete" onclick="return removeChecked();">Delete</button>
							<a data-toggle="modal" data-target="#modal1">
								<button type="submit" class="add btn pull-right btn-primary">Add Business Unit</button>
							</a>
						</div>
						
						<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<span class="modal-title">New Business Unit</span>
									</div>
									<div class="modal-body">
										<table class="add-modal">
											<tr>
												<td class="lbl modal-td">Name of Department:</td>
												<td class="modal-td">
													<select name='dept' id="dept">
														<option id="c_dept">--Select--</option>
														<?php
															$query = $dblink->db_qry("SELECT d.dept_code, d.dept_name, b.dept_code FROM ems_department AS d 
																						LEFT JOIN ems_business_units AS b
																						ON d.dept_code = b.dept_code");
												   
															while($result = $dblink->get_data($query)){
																//if($result[2]==null OR $result[2]){ //--> allow a certain department to be selected again
																if($result[2]==null){
																	echo '<option value="',$result[0],'">',$result[1],'</option>';
																}
															}
													   ?>
													</select>
												</td>
											</tr>
											<tr>
												<td class="lbl modal-td">Name of Manager:</td>
												<td class="modal-td">
													<select name="manager">
														<option id="c_name">--Select--</option>
														<?php
															$str = "SELECT DISTINCT(CONCAT(emp_firstname,' ',emp_lastname)) AS emp, b_manager_name FROM ems_employee AS e 
																		LEFT JOIN ems_business_units AS b ON CONCAT(emp_firstname,' ',emp_lastname)=b_manager_name
																		LEFT JOIN ems_users u ON u.emp_num = e.emp_num
																		WHERE e.emp_num!=1 AND (u.rights!=3 AND u.rights!=1 AND u.rights!=5)";
																		#JD-2012/10/17 - Added condition to show only managers' name on the managers dropdown list
																		#Just remove the following condition: AND (u.rights!=3 AND u.rights!=1 AND u.rights!=5) to show all names of employee
															$query = $dblink->db_qry($str);
													
															while($result = $dblink->get_data($query)){
																//JD-2012/10/17 - Added condition to allow certain manager to be selected again as a manager of another department
																//if($result[1]==null OR $result[1]){
																if($result[1]==null OR $result[1]){
																	echo '<option>',$result[0],'</option>';
																}
															}
														?>
													</select>
												</td>
											</tr>
											<tr>
												<td class="lbl modal-td">Report to:</td>
												<td class="modal-td">
													<select id="report_to" name="report_to">
														<option id="report">None</option>
														<?php
															echo '<option>None</option>';
															
															$str = "SELECT CONCAT(emp_firstname,' ',emp_lastname) AS emp, b_manager_name, emp_num FROM ems_employee AS e 
																		INNER JOIN ems_business_units AS b 
																		ON CONCAT(emp_firstname,' ',emp_lastname)=b_manager_name";
															
															$qry = mysql_query($str);
															while($row = mysql_fetch_array($qry)){
																echo '<option>'.show_name($row[2]).'</option>';
															}
														?>
													</select>
												</td>
											</tr>
											<tr>
												<td class="lbl modal-td">Assign OIC:</td>
												<td class="modal-td">
													<select name="oic">
														<option id="oic">None</option>
														<?php
															echo '<option>None</option>';
															//TL-2012/04/12 - Revised query to show name instead of department.
															//$str = "SELECT dept_name, dept_code FROM ems_department";
															//$str = "SELECT d.dept_code, e.emp_num FROM ems_department as d
															//		INNER JOIN ems_business_units as b ON b.dept_code = d.dept_code
															//		INNER JOIN ems_employee e ON e.b_id = b.b_id";
															$str = "SELECT CONCAT(emp_firstname,' ',emp_lastname) AS emp, emp_num 
																		FROM ems_employee AS e 
																		INNER JOIN ems_business_units AS b 
																		ON CONCAT(emp_firstname,' ',emp_lastname)=b_manager_name";
															$qry = $dblink->db_qry($str);
															while($result = $dblink->get_data($qry)){
																//echo '<option>',show_dept($result[1]),'</option>';
																echo '<option>',show_name($result[1]),'</option>';
															}
														?>
													</select>
												</td>
											</tr>
										</table>
									</div>
									<div class="modal-footer" id="button">	
										<button type="submit" class="btn btn-primary save" id="save" name="submit" value="save" onclick="return validate();">Save</button>
										<button type="button" class="btn btn-default pull-right" data-dismiss="modal" onclick="window.location='business_units.php';">Close</button>
									</div>
								</div>
							</div>
						</div>
					
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="business-units-table">
								<thead>
									<tr>
										<th class="table-column-names nosort"><input type="checkbox" name="all" onclick="checkAll();"/></th>
										<th class="table-column-names">Department</th>
										<th class="table-column-names">Manager</th>
										<th class="table-column-names">Report To</th>
										<th class="table-column-names">OIC</th>
									</tr>
								</thead>
								<tbody>
									<?php
										//TL-2012/04/15 - Changed LEFT JOIN TO INNER JOIN.
										$str = "SELECT dept_name, b_manager_name, b_id, b.dept_code, oic, report_to FROM ems_department as d
													INNER JOIN ems_business_units as b ON b.dept_code = d.dept_code";

										$qry = $dblink->db_qry($str);
										$x = "a";		
										while($data = $dblink->get_data($qry)){
											echo '<tr align="center" class="',$x,'">';
												echo '<td><input type="checkbox" name="del[]" value="',$data[2],'"/></td>';
										
												//TL-2012/04/13 - Changed show_dept($data[4]) to show_name()
												echo '<td><a href="#" data-toggle="modal" data-target="#modal1" onclick="return get(\'',$data[0],'\',\'',$data[1],'\',',$data[2],',\'',$data[3],'\',\'',show_name($data[4]),'\',\'',show_name($data[5]),'\');">',$data[0],'</a></td>';
												echo '<td>',$data[1],'</td>';
												echo '<td>',show_name($data[5]),'</td>';
										
												//TL-2012/04/12 - Changed to show_name
												//echo '<td>',show_dept($data[4]),'</td>';
												echo '<td>',show_name($data[4]),'</td>';
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
				$('#business-units-table').dataTable( {
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