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
	if($_SESSION['rights']==3){
			echo '<h1>',"Invalid URL",'</h1>';
			return false;
	}
	
	//TL-2012/01/20 - Changed $a_data[0] to $_SESSION['rights'].
	$a_qry = mysql_query("SELECT rights FROM ems_users WHERE username='$_SESSION[username]' ");
	$a_data = mysql_fetch_array($a_qry);
	
	if(isset($_POST['approve_ob'])){
	$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				$qry = mysql_query("UPDATE ems_ob SET status='Approved' WHERE ob_id='$app' ");
				approve_send_email("official business application", $app, "ob");
			}
		}
	}elseif(isset($_POST['conf_ob'])){
	$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $conf){
				$qry = mysql_query("UPDATE ems_ob SET status='Confirmed' WHERE ob_id='$conf' ");
				// approve_send_email("official business application", $app, "ob");
			}
		}
	}elseif(isset($_POST['deny_ob'])){
	$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_ob SET status='Denied' WHERE ob_id='$deny' ");
			}
		}
	}

	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	$q_oic = "''";
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = $q_oic.",'".$row[0]."'";
	}
	$sman_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' 
								AND dept_code = 'DEP-0000' ");
	$cnt = mysql_num_rows($sman_oic);
	if($cnt > 0){
		$man_oic = " OR (rights=2 AND e.emp_num <> $_SESSION[emp_num]) ";
	}else{
		$man_oic = "";
	}
	
	$s_report = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE report_to='$_SESSION[emp_num]' ");
	//JD-2012/09/20 - Show applications of one manager in one or more departments
	$q_report = "''";
	while($row = mysql_fetch_array($s_report)){
		$q_report = $q_report.",'".$row[0]."'";
	}
		
	//JD-2012/11/12 - Added variables to store and carry values to another php object
	$qoic = $q_oic; //variable containing the oic
	$report = $q_report; //variable containing the report to
	$empnum = $_SESSION['emp_num']; //variable containing the employee number from session
	$depcode = $_SESSION['dept_code']; //variable containing the deptartment code from session
	$bman = $_SESSION['fullname']; //JD-2013/05/22 - variable containing the fullname of the manager

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
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
        
        	$(document).ready(function(){
            	function app_den(name, action){
                var form;
					if(action=="a_ob"){
                    	action = "Approve";
					}else if(action=="d_ob"){
                    	action = "Deny";
					}
                
                	var x = confirm(action+" official business request of "+name+" ?");
					if(x){
                        return true;
                    }else{
                        return false;
                    }
                	
					return false;
                }	
                
                $("[class^=chk_]").click(function(){
                	var id = $(this).attr("id");
                    	if($(this).is(":checked")==true){
                        	if(id=="Confirmation"){
                                $("[id^=Approval]").attr("disabled", "disabled");
                                $("#approve").hide();
                                $("#confirm").show();
                            }else{
                                $("[id^=Confirmation]").attr("disabled", "disabled");
                                $("#confirm").hide();
                                $("#approve").show();
                            }
                        }else{
                            var valid = false;
                            $("[name^=itemChk]").each(function(){
                                if($(this).is(":checked")){
                            	    valid = true;
                                	return false;
                                }										
                            });	
                            if(valid==false){
                            	$("#confirm").show();
                                $("#approve").show();
                                $("[id^=Confirmation]").removeAttr("disabled");
                                $("[id^=Approval]").removeAttr("disabled");	
                            }	
						}
				});
			});
        </script>
    </head>
	
	
	<body alink="green" vlink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
			
		<?php include("menu.php"); ?>

		<form name="form_ob_req" action="view_ob_request_old.php?searchby=0&search=&submit=search" method="POST" />
                                
			<div id="container">
				
				<div class="col-lg-12">
					
					<div class="panel-body top-bordered col-lg-12">
					
						<h2 class="summary-title">New Official Business Requests</h2>
						
						<div class="table-buttons row">
							<a href="view_ob_request.php?searchby=0&search=&submit=search#theirs" class="a upper-link tabbed smaller-link-margin">Old Official Business Requests</a>
						</div>
						<div class="table-buttons row">
							<button type="submit" name="cancel_ob" class="cancel btn btn-danger pull-right" onclick="return confirmation(\'cancel\',\'ob\');">Cancel</button>
						</div>
						
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="ob-requests-table">
								<thead>
									<tr>
										<th class="nosort"> </th>
										<th class="table-column-names">Date Filed</th>
										<th class="table-column-names">Name</th>
										<th class="table-column-names">Client/Branch</th>
										<th class="table-column-names">Details</th>
										<th class="table-column-names">Remarks</th>
										<th class="table-column-names">Status</th>
									</tr>
								</thead>
								<tbody>
							<?php
								$by = $_GET['searchby'];
								$search = $_GET['search'];
								if(isset($_GET['submit']) && $_GET['submit']=="search"){
									//--> JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]'
									switch($by){
										case 1:
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_filed LIKE '%$search%'" : 
														"b.b_manager_name='$_SESSION[fullname]' AND date_filed LIKE '%$search%'";
											break;

										case 2:
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "ob_from='$search'  OR ob_to='$search'" :
														"b.b_manager_name='$_SESSION[fullname]' AND (ob_from='$search'  OR ob_to='$search')";
											break;
										
										case 3:
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_firstname LIKE '%$search%' " :
														"b.b_manager_name='$_SESSION[fullname]' AND emp_firstname LIKE '%$search%'";
											break;

										case 4:
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_middlename LIKE '%$search%' " :
														"b.b_manager_name='$_SESSION[fullname]' AND emp_middlename LIKE '%$search%'";
											break;
										
										case 5:
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_lastname LIKE '%$search%' " : 
														"b.b_manager_name='$_SESSION[fullname]' AND emp_lastname LIKE '%$search%'";
											break;

										case 6:
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "client_branch='$search' " : 
														"b.b_manager_name='$_SESSION[fullname]' AND client_branch='$search'";
											break;

										case 7:
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "o.status='$search' " : 
														"b.b_manager_name='$_SESSION[fullname]' AND o.status='$search'";
											break;
										
										case 0:
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "ob_from='$search'  
													OR ob_to='$search' 
													OR emp_firstname LIKE '%$search%' 
													OR emp_middlename LIKE '%$search%' 
													OR emp_lastname LIKE '%$search%' 
													OR client_branch='$search' 
													OR o.status LIKE '%$search%'" 
													: 
													"b.b_manager_name='$_SESSION[fullname]' AND (ob_from='$search' 
													OR ob_to='$search' 
													OR emp_firstname LIKE '%$search%' 
													OR emp_middlename LIKE '%$search%' 
													OR emp_lastname LIKE '%$search%' 
													OR client_branch='$search' 
													OR o.status LIKE '%$search%')";
											break;
											//<----End of modification
									}
								}else{
									$param = $_GET["param"]; //JD-2012/11/19 - Get paramater of the url
									$param = stripslashes($param); //JD-2012/11/19 - Used to removed slashes in the parameter
									//JD-2012/11/19 - Replace "1" with "$param" as the default value
									//JD-2013/05/22 - Replaced dept_code='$_SESSION[dept_code]' with b.b_manager_name='$_SESSION[fullname]'
									$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "1" : "b.b_manager_name='$_SESSION[fullname]'";
								}
								
								//echo "LOG IN RIGHTS: ".$_SESSION['rights'];
								if($_SESSION['rights']==1){
									if(!$strqry){				
										$str = "SELECT ob_from, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose, 
													departure, arrival, total, status, ob_id, date_Filed, remarks, ob_to
													FROM ems_ob AS o
													INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num 
													WHERE 1
													ORDER BY o.ob_id DESC";						
									}else{					
										$str = "SELECT ob_from, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose, 
													departure, arrival, total, status, ob_id, date_Filed, remarks, ob_to
													FROM ems_ob AS o
													INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num 
													WHERE $strqry
													ORDER BY o.ob_id DESC";	
									}
								}
								
								//JD-2012/06/25 - Separate Condition for Executive to show only managers' Official Business Requests
								elseif($_SESSION['rights']==5){
									//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
									//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
									//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
									$str = "SELECT ob_from, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose, departure, 
												arrival, total, o.status, ob_id, date_Filed, remarks, ob_to
												FROM ems_ob AS o
												INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num 
												INNER JOIN ems_users as ue ON ue.emp_num = e.emp_num
												LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
												WHERE 1 AND (ue.rights=2 OR ue.rights=4)
												ORDER BY o.ob_id DESC";
												//search for executive not working
								}
								else{
									//JD-2014/09/25 - Added condition e.code != 'EST004'
									//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
									//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
									//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
									$str = "SELECT ob_from, e.emp_firstname, e.emp_middlename, e.emp_lastname,  client_branch, purpose, departure, 
											arrival, total, o.status, ob_id, date_Filed, remarks, ob_to
											FROM ems_ob AS o
											INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num
											INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
											LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
											WHERE ($strqry OR (e.dept_code IN($q_oic) AND rights!=2) OR (e.dept_code IN ($q_report) AND rights=2) $man_oic) 
											AND o.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
											ORDER BY o.ob_id DESC";
								}
								//echo $str; //- For debugging
								
								$my_variable = 'param='.$strqry; //JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
								
								$qry = mysql_query($str);
								
								$x = "a";
								
								while($result = mysql_fetch_array($qry)){		
									$name = $result[1]." ".$result[2]." ".$result[3];
									echo '<tr align="center" class="',$x,'">';
									
									// checkbox column
									chk_stat($result[9], $result[10], "ob_man");
									
									// date diled column
									echo '<td width="8%">',$result[11],'</td>';
									
									// name
									echo '<td>',$name,'</td>';
									
									// client/branch
									echo '<td>',$result[4],'<br>';	
										
									// purpose
									$pur = explode("|", $result[5]);
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
									$pp = "";
								
									// details column
									echo '<td width="15%">';
									// From-To
									if($result[13]=="0000-00-00"){
										echo date('F d, Y', strtotime($result[0])),'<br>';
									}else{
										echo date('F d, Y', strtotime($result[0])),' - ',date('F d, Y', strtotime($result[13])),'<br>';
									}
									
									//JD-2012/06/20 - Fixed display of Departure
									// departure
									echo 'Departed: ',display_time(trim($result[6])),'<br>';
											
									//TL-2012/01/02 - Fixed display of Arrival
									//if($result[0]!="0000-00-00" && !($result[10] == $result[0])){
									// arrived
									if($result[7] > 1435){
										echo 'Arrived: ',display_time_2($result[7]),'<br>';
									}else{
										echo 'Arrived: ',display_time($result[7]),'<br>';
									}	
									
									// total duration
									echo $result[8],' hour(s).min(s)';
									echo '</td>';
									
									// remarks
									show_remarks($result[10]);
									
									// status
									echo '<td width="8%"><button class="btn btn-',f_color($result[9]),'">',$result[9],'</button></td>';
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
						
						<div class="table-buttons row">
							<?php
								echo '<button type="submit" name="cancel_ob" class="cancel btn btn-danger pull-right" onclick="return confirmation(\'cancel\',\'ob\');">Cancel</button>';
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
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#ob-requests-table').dataTable({
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
