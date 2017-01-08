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
	
	if($_SESSION['rights']==3){
			echo '<h1>',"Invalid URL!",'</h1>';
			return false;
	}
	
	//TL-2012/01/20 - Changed $a_data[0] to $_SESSION['rights'].
	$a_qry = mysql_query("SELECT rights FROM ems_users WHERE username='$_SESSION[username]' ");
	$a_data = mysql_fetch_array($a_qry);
	$chk = $_POST['itemChk'];
	if(isset($_POST['conf_air'])){
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				$qry_stat = mysql_query("SELECT status FROM ems_air_ticket WHERE at_id='$app' ");
				$stat = mysql_result($qry_stat, 0);
				if($stat=="Pending for Re-booking"){
					$qry = mysql_query("UPDATE ems_air_ticket SET status='Confirmed for Re-booking', state='5' WHERE at_id='$app' ");
				}else{
					$qry = mysql_query("UPDATE ems_air_ticket SET status='Approved', state='1' WHERE at_id='$app' ");
					$qry_name = mysql_query("SELECT CONCAT(emp_firstname,' ',emp_lastname) FROM ems_employee AS e
																INNER JOIN ems_air_ticket AS a
																ON e.emp_num=a.emp_num
																WHERE at_id='$app' ");
					$emp_name = mysql_result($qry_name, 0);
					sales_pending_email($emp_name, "http://iripple.net:82/ems/view_airticket_request.php");
					echo '<script>window.location = \'view_airticket_request.php\';</script>';
				}
			}
		}
	}elseif(isset($_POST['book_air'])){
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				$qry_stat = mysql_query("SELECT status FROM ems_air_ticket WHERE at_id='$app' ");
				$stat = mysql_result($qry_stat, 0);
				if($stat=="Reviewed for Re-booking" || $stat=="Re-booked"){
					$qry = mysql_query("UPDATE ems_air_ticket SET status='Re-booked', state='7' WHERE at_id='$app' ");
				}else{
					$qry = mysql_query("UPDATE ems_air_ticket SET status='Booked', state='3' WHERE at_id='$app' ");
					send_email("air ticket application", $app, "air","approved");
				}
			}
		}
	}elseif(isset($_POST['deny_air'])){
		if(sizeof($chk)!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_air_ticket SET status='Denied' WHERE at_id='$deny' ");
				send_email("air ticket application", $deny, "air","denied");
			}
		}
	}elseif(isset($_POST['cancel_air'])){
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_air_ticket SET status='Cancelled' WHERE at_id='$cancel' ");
			}
		}
	}elseif(isset($_POST['rebook_air'])){
		$value = $_POST['rad_air'];
		header("location: airticket.php?ID=$value&action=air_edit&rebook=1");
	}

	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	$q_oic = "''";
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = $q_oic.",'".$row[0]."'";
	}
	
	$sman_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b
								WHERE oic='$_SESSION[emp_num]' AND dept_code = 'DEP-0000' ");
	$cnt = mysql_num_rows($sman_oic);
	if($cnt > 0){
		$man_oic = " OR (rights=2 AND e.emp_num <> $_SESSION[emp_num]) ";
	}else{
		$man_oic = "";
	}

	//finding the report to department
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
            function load_airticket(ID, action){
                window.open("airticket.php?ID="+ID+"&action="+action+"&sa=1","_self")
            }
            $(document).ready(function(){
                if($("#sales").attr("id")){
                    $("[class^=chk_]").click(function(){
                        var id = $(this).attr("id");
                        var arr = id.split("||");
						if($(this).is(":checked")==true){
							//JD-2013/05/28 - Added condition && arr[1]!="Approved" and "Confirmed"
							//if(arr[0]=="" && (arr[1]!="Approved" && arr[1]!="Confirmed" && arr[1]!="Booked")){
							//JD-2014/02/22 - Changed from Reviewed to Approved
							if(arr[0]=="" && (arr[1]=="Approved")){ 
								alert("Reminder: E-ticket is not yet uploaded.");
							}
							if(arr[1]=="Booked" || arr[1]=="Re-booked" || arr[1]=="Approved" || arr[1]=="Denied"){
								$("#sales").hide();			
								$("[class^=chk_]").each(function(){
									var ID = $(this).attr("id");
									var ARR = ID.split("||");
									if(ARR[1]=="Reviewed"){
										$(this).attr("disabled", "disabled");
									}
								});
							}
							//JD-2014/02/22 - Comment out 'Reviewed' status. New Status will be --> Pending (employee) > Approve (manager/admin) > Booked (sales admin)
							// else if(arr[1]=="Reviewed"){
							// 	$("#sales").show();
							// 	$("[class^=chk_]").each(function(){
							// 		var ID = $(this).attr("id");
							// 		var ARR = ID.split("||");
							// 		if(ARR[1]!="Reviewed"){
							// 			$(this).attr("disabled", "disabled");
							// 		}
							// 	});		
							// }			
						}else{
							var valid = false;
							$("[name^=itemChk]").each(function(){
								if($(this).is(":checked")){
										valid = true;
										return false;
								}		
							});	
							if(valid==false){
								$("#sales").show();
								$("[class^=chk_]").each(function(){
									$(this).removeAttr("disabled");
								});
							}
						}
                    });
                }else if($("#manager").attr("id")){
                    $("[class^=chk_]").click(function(){
                        var id = $(this).attr("id");
                        var arr = id.split("||");
						if($(this).is(":checked")){
							if(arr[1]=="Confirmed"){
								$("#manager").hide();
							}else if(arr[1]=="Approved"){ //JD-2013/05/28 - added else if condition to hide checkbox when status is Approved
								$("#manager").hide();	
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
								$("#manager").show();						
							}
						}
 					});
                }
            });
        </script>
		
    </head>
	
	
    <body alink="green" vlink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

		<?php include("menu.php"); ?>
		<br/>
        
		<div id="container">
			
			<div class="col-lg-12" id="tab-container">
				<?php
					if($_SESSION['rights']!=1){
						echo '
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation"><a href="#mine" aria-controls="mine" role="tab" data-toggle="tab">My Air Ticket Applications</a></li>
					<li role="presentation"><a href="#theirs" aria-controls="theirs" role="tab" data-toggle="tab">Air Ticket Requests</a></li>
				</ul>
				
				<div class="tab-content">
					
					<div role="tabpanel" class="tab-pane active" id="mine">
		
						<div class="panel-body col-lg-12">
							<form name="form_air" action="<?php $PHP_SELF;?>" method="POST">
			
								<div class="table-buttons row">
									<a href="airticket.php" class="a upper-link zero-bottom-margin"> Request for Air Ticket</a>
								</div>
								<div class="table-buttons row">
									<button type="submit" name="rebook_air" class="rebook pull-right btn btn-primary" onclick="return conf_air(\'re-book\');">Re-book</button>
								</div>
						
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="airticket-applications-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Details</th>
												<th class="table-column-names">Purpose</th>
												<th class="table-column-names">Remarks</th>
												<th class="table-column-names">Status</th>
											</tr>
										</thead>
										<tbody>
						';
											
												$by = $_POST['searchby'];
												$search = $_POST['search'];
												if(isset($_POST['submit']) && $_POST['submit']=="search"){
													switch($by){
														case 1:
																$strqry = "emp_num='$_SESSION[emp_num]' AND date_filed='$search'";
														break;
					
														case 2:
																$strqry = "emp_num='$_SESSION[emp_num]' AND origin='$search' ";
														break;	
					
														case 3:
																$strqry = "emp_num='$_SESSION[emp_num]' AND destination='$search' ";
														break;	

												/*		case 4:
																$strqry = "emp_num='$_SESSION[emp_num]' AND airline='$search' ";
														break;	*/
														
														case 4:
																$strqry = "emp_num='$_SESSION[emp_num]' AND status='$search'";
														break;				

														case 0:
																$strqry = "(emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND origin LIKE '%$search%') OR 
																 (emp_num='$_SESSION[emp_num]' AND destination LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND airline LIKE '%$search%') OR (emp_num='$_SESSION[emp_num]' AND status LIKE '%$search%') ";
														break;											
													}
												}else{
													$strqry = "emp_num='$_SESSION[emp_num]'";
												}
												
												$str = "SELECT date_Filed, origin, destination, airline, departure, arrival, purpose, type, status, at_id, amount, attachment
														   FROM ems_air_ticket
														   WHERE $strqry
														   ORDER BY at_id DESC";
													 
												$x = "a";
												$qry = mysql_query($str);

												while($result = mysql_fetch_array($qry)){	
													echo '<tr align="center" class="',$x,'">';
													chk_stat($result[8], $result[9], "air");
													edit_app($result[8], $result[9],"air_edit",$result[0]);
													
													$findme   = '<br/>';
													$pos = strpos($result[1], $findme);

													if ($pos !== false) {
														$result[1] = substr($result[1], 0, $pos);
													}
													echo '<td>From ',$result[1];
													
													$pos1 = strpos($result[2], $findme);
													if ($pos1 !== false) {
														$result[2] = substr($result[2], 0, $pos1);
													}
													echo ' to ',$result[2],'<br>';
													
													if($pos !== false && $pos1 !== false){
														echo 'Round trip<br>';
													}
													else{
														echo 'One way trip<br>';
													}
													
													echo 'Departure: ',$result[4], '<br>';
													if($result[5]!=NULL){
														echo 'Return on: ',$result[5],'<br>';
													}
													$amt = $result[10];
													$file = $result[11];
													$status = $result[8];
													if(empty($file)){
														echo $amt, '</td>';
													}else{
														//JD-2014/02/22 - Removed 'Reviewed' Status
														//if($status=="Booked" || $status=="Re-booked" || $status=="Reviewed"){
														if($status=="Booked" || $status=="Re-booked"){
															echo '<a class="file" id="'.$file.'" title="Click here to download e-ticket." href="download.php?download_file=',$file,'">',$amt,'</a></td>';
														}else{
															echo '<span class="file" id="'.$file.'" >',$amt,'</span></td>';
														}
													}
													echo '<td width="30%">',$result[6],'</td>';
													show_remarks($result[9]);
													echo '<td><button class="btn btn-',f_color($result[8]),'">',$result[8],'</button></td>';
													echo '</tr>';

													if($x=="a"){
															$x = $x . "b";
													}else{
															$x = "a";
													}
												}					
											
						echo '
										</tbody>
									</table>
								</div> <!-- table-responsive -->
								
								<div class="table-buttons row">
						';
									
									echo '<button type="submit" name="rebook_air" class="rebook pull-right btn btn-primary" onclick="return conf_air(\'re-book\');">Re-book</button>';
									
						echo '
								</div>
							</form>
						</div> <!-- panel-body -->
					
					</div> <!-- tab-pane (2) for undertime requests -->
					
					<div role="tabpanel" class="tab-pane active" id="theirs">
			
						<div class="panel-body col-lg-12">
								<div class="table-buttons row">
						';
						
						if($_SESSION['rights']==2 OR $_SESSION['rights']==5){
							echo '<button type="submit" name="deny_air" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'air\');">Deny</button>'; 
							echo '<button type="submit" id="manager" name="conf_air" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'air\');">Approve</button>';							
								//<input type="submit" id="manager" name="conf_air" class="confirm" onclick="return confirmation(\'confirm\',\'air\');">
								//JD - changed name from deny_request to deny_air to enable deny function
						//JD-2013/04/26 - Added $_SESSION['rights']==1 to allow the admin to book confirmed air ticket applications
						}elseif($_SESSION['rights']==4){
							echo '
								<button type="submit" id="sales" name="book_air" class="done pull-right btn btn-primary" onclick="return confirmation(\'book\',\'air\');">Book</button>
								<button type="submit" name="cancel_air" class="cancel pull-right btn btn-black" onclick="return confirmation(\'cancel\',\'air\');">Cancel</button>
							';						
						}else if($_SESSION['rights']==1){
							//JD-2013/04/26 - Problem regarding 'done' button hiding when a checkbox is checked
							//Applications for booking can't proceed because of this problem.
							//JD-2013/05/28 - Changed class of confirm button to approve
							echo '
								<button type="submit" name="deny_air" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'air\');">Deny</button>
								<button type="submit" name="cancel_air" class="cancel pull-right btn btn-black" onclick="return confirmation(\'cancel\',\'air\');">Cancel</button>
								<button type="submit" id="sales" name="book_air" class="done pull-right btn btn-primary" onclick="return confirmation(\'book\',\'air\');">Book</button>
								<button type="submit" id="manager" name="conf_air" class="approve pull-right btn btn-primary" onclick="return confirmation(\'confirm\',\'air\');">Confirm</button>
							';
						}
						echo '</div>';
						
					}
					else{
						echo '
							<div class="panel-body top-bordered col-lg-12">
								<div class="table-buttons row">
									<h2 class="summary-title">Airticket Requests</h2>
						';
						
						if($_SESSION['rights']==2 OR $_SESSION['rights']==5){
							echo '<button type="submit" name="deny_air" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'air\');">Deny</button>'; 
							echo '<button type="submit" id="manager" name="conf_air" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'air\');">Approve</button>';							
								//<input type="submit" id="manager" name="conf_air" class="confirm" onclick="return confirmation(\'confirm\',\'air\');">
								//JD - changed name from deny_request to deny_air to enable deny function
						//JD-2013/04/26 - Added $_SESSION['rights']==1 to allow the admin to book confirmed air ticket applications
						}elseif($_SESSION['rights']==4){
							echo '
								<button type="submit" id="sales" name="book_air" class="done pull-right btn btn-primary" onclick="return confirmation(\'book\',\'air\');">Book</button>
								<button type="submit" name="cancel_air" class="cancel pull-right btn btn-black" onclick="return confirmation(\'cancel\',\'air\');">Cancel</button>
							';						
						}else if($_SESSION['rights']==1){
							//JD-2013/04/26 - Problem regarding 'done' button hiding when a checkbox is checked
							//Applications for booking can't proceed because of this problem.
							//JD-2013/05/28 - Changed class of confirm button to approve
							echo '
								<button type="submit" name="deny_air" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'air\');">Deny</button>
								<button type="submit" name="cancel_air" class="cancel pull-right btn btn-black" onclick="return confirmation(\'cancel\',\'air\');">Cancel</button>
								<button type="submit" id="sales" name="book_air" class="done pull-right btn btn-primary" onclick="return confirmation(\'book\',\'air\');">Book</button>
								<button type="submit" id="manager" name="conf_air" class="approve pull-right btn btn-primary" onclick="return confirmation(\'confirm\',\'air\');">Confirm</button>
							';
						}
						echo '</div>';
								
					}
				?>
							<form name="form_airticket" action="view_airticket_request.php?searchby=0&search=&submit=search" method="POST">
								
								<div class="table-responsive col-lg-12">
									<table class="table table-striped table-bordered table-hover" id="airticket-requests-table">
										<thead>
											<tr>
												<th class="nosort"> </th>
												<th class="table-column-names">Date Filed</th>
												<th class="table-column-names">Name</th>
												<th class="table-column-names">Details</th>
												<th class="table-column-names">Client</th>
												<th class="table-column-names">Amount</th>
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
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "date_filed='$search' " :
																"b.b_manager_name='$_SESSION[fullname]' AND date_filed='$search%'";
															break;
														
														case 2:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "emp_firstname LIKE '%$search%' " :
																"b.b_manager_name='$_SESSION[fullname]' AND emp_firstname LIKE '%$search%'";
															break;
														
														case 3:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "emp_middlename LIKE '%$search%' " :
																"b.b_manager_name='$_SESSION[fullname]' AND emp_middlename LIKE '%$search%'";
															break;

														case 4:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "emp_lastname LIKE '%$search%' " :
																"b.b_manager_name='$_SESSION[fullname]' AND emp_lastname LIKE '%$search%'";
															break;

														case 5:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "origin LIKE '%$search%'" :
																"b.b_manager_name='$_SESSION[fullname]' AND origin LIKE '%$search%'";
															break;

														case 6:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "destination='$search'" :
																"b.b_manager_name='$_SESSION[fullname]' AND destination='$search'";
															break;

														/*case 7:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "airline='$search'" :
																"dept_code='$_SESSION[dept_code]' AND airline='$search'";
															break;*/			

														case 7:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "a.status='$search' " :
																"b.b_manager_name='$_SESSION[fullname]' AND a.status='$search'";
															break;

														case 0:
															$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "date_filed='$search' 
																OR emp_firstname LIKE '%$search%' 
																OR emp_middlename LIKE '%$search%' 
																OR emp_lastname LIKE '%$search%' 
																OR origin LIKE '%$search%' OR
																destination LIKE '%$search%' 
																OR airline='$search' 
																OR a.status='$search'" 
																: 
																"b.b_manager_name='$_SESSION[fullname]' AND (date_filed='$search' 
																OR emp_firstname LIKE '%$search%' 
																OR emp_middlename LIKE '%$search%' 
																OR emp_lastname LIKE '%$search%' 
																OR origin='$search' 
																OR destination='$search' 
																OR airline='$search' 
																OR a.status='$search')";
															break;
															//<----End of modification
													}
												}else{
													$param = $_GET["param"]; //JD-2012/11/19 - Get paramater of the url
													$param = stripslashes($param); //JD-2012/11/19 - Used to removed slashes in the parameter
													if($_SESSION['rights']==1){ //JD-2012/12/10 - Added condition to fix bug regarding the manager's view
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "$param" : "b.b_manager_name='$_SESSION[fullname]'";
													}else if($_SESSION['rights']==2 OR $_SESSION['rights']==4){
														$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "b.b_manager_name='$_SESSION[fullname]'" : "$param";
													}//replace "1" with "$param" as the default value
												}	

												if($_SESSION['rights']==1){ //For Administrator
													if(!$strqry){
														$str = "SELECT a.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, 
																origin, destination, a.client,departure, arrival, purpose, a.type, 
																a.status, at_id, a.state, amount, attachment
																FROM ems_air_ticket as a
																INNER JOIN ems_employee as e ON a.emp_num = e.emp_num 
																WHERE 1
																ORDER BY a.at_id DESC";						
													}else{
														$str = "SELECT a.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, 
																origin, destination, a.client, departure, arrival, purpose, a.type, 
																a.status, at_id, a.state, amount, attachment
																FROM ems_air_ticket as a
																INNER JOIN ems_employee as e ON a.emp_num = e.emp_num 
																WHERE $strqry
																ORDER BY a.at_id DESC";		
													}
												}

												elseif($_SESSION['rights']==4){ //For Sales Admin
														if(!$strqry){
														//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
														//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
														$str = "SELECT a.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, origin, destination, a.client,
															departure, arrival, purpose, a.type, a.status, at_id, a.state, amount, attachment
															FROM ems_air_ticket as a
															INNER JOIN ems_employee as e ON a.emp_num  = e.emp_num 
															INNER JOIN ems_users as ue ON ue.emp_num = e.emp_num
															LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id 
															WHERE 1
															ORDER BY a.at_id DESC";
													}else{
														//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
														//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
														$str = "SELECT a.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, origin, destination, a.client,
															departure, arrival, purpose, a.type, a.status, at_id, a.state, amount, attachment
															FROM ems_air_ticket as a
															INNER JOIN ems_employee as e ON a.emp_num  = e.emp_num 
															INNER JOIN ems_users as ue ON e.emp_num = ue.emp_num
															LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id 
															WHERE $strqry
															ORDER BY a.at_id DESC";
													}
												}

												//JD-2012/06/25 - Separate Condition for Executive to show only managers' Airticket Requests
												elseif($_SESSION['rights']==5){ //For Executive
													if(!$strqry){
														//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
														//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
														$str = "SELECT a.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, origin, destination, a.client,
															departure, arrival, purpose, a.type, a.status, at_id, a.state, amount, attachment
															FROM ems_air_ticket as a
															INNER JOIN ems_employee as e ON a.emp_num  = e.emp_num 
															INNER JOIN ems_users as ue ON ue.emp_num = e.emp_num
															LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id 
															WHERE (ue.rights=2 OR ue.rights=4) AND 1
															ORDER BY a.at_id DESC";
													}else{
														//JD-2013/05/22 - Added WHERE clause condition to select by manager name instead of by dept code
														//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
														$str = "SELECT a.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, origin, destination, a.client,
															departure, arrival, purpose, a.type, a.status, at_id, a.state, amount, attachment
															FROM ems_air_ticket as a
															INNER JOIN ems_employee as e ON a.emp_num  = e.emp_num 
															INNER JOIN ems_users as ue ON e.emp_num = ue.emp_num
															LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id 
															WHERE (ue.rights=2 AND ue.rights=4) AND $strqry
															ORDER BY a.at_id DESC";
													}
												}

												else { //Managers
													//JD-2014/09/25 - Added condition e.code != 'EST004'
													//JD-2013/05/22 - Joined table ems_business_units to select by manager name instead of by dept code
													//LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
													$str = "SELECT a.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, 
															origin, destination, a.client, departure, arrival, purpose, a.type, 
															a.status, at_id, a.state, amount, attachment
															FROM ems_air_ticket as a
															INNER JOIN ems_employee as e ON a.emp_num  = e.emp_num
															INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
															LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
															WHERE $strqry OR ((e.dept_code IN($q_oic) AND rights!=2) OR (e.dept_code IN ($q_report) 
															AND rights=2) $man_oic) AND a.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
															ORDER BY a.at_id DESC";
												}

												function edit($stat, $date, $ID, $file){
													if(($_SESSION['rights']==4 || $_SESSION['rights']==1) && 
													//JD-2013/05/28 - Changed $stat=="Confirmed" to $stat=="Approved"
													($stat=="Approved" || $stat=="Confirmed for Re-booking" || $stat=="Reviewed")) {
														echo '<td width="8%" class="attach" id="'.$file.'"><a href="#" title="Click to Review" 
															onclick="load_airticket(\'',$ID,'\',\'edit\')"><b>',$date,'</b></a></td>';
													}else{
														echo '<td width="8%" class="attach" id="'.$file.'">',$date,'</td>';
													}
													/*
													if(($_SESSION['rights']==4 || $_SESSION['rights']==1) && 
													($stat=="Confirmed" || $stat=="Confirmed for Re-booking" || $stat=="Reviewed")) {
														echo '<td class="attach" id="'.$file.'"><a href="#" title="Click to Review" 
															onclick="load_airticket(\'',$ID,'\',\'edit\')"><b>',$date,'</b></a></td>';
													}else{
														echo '<td class="attach" id="'.$file.'">',$date,'</td>';
													}*/
												}

												//echo $str;
												$my_variable = 'param='.$strqry; //JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
												$x = "a";
												$qry = mysql_query($str);
												
												while($result = mysql_fetch_array($qry)){
													$name = $result[1]." ".$result[2]." ".$result[3];
													echo '<tr align="center" class="',$x,'" id="file">';
													$pp = 	(($_SESSION['rights']==4 &&
																($result[11]=="Pending" || $result[11]=="Pending for Re-booking")) || 
															(($_SESSION['rights']==2 &&
																($result[11]=="Reviewed" || $result[11]=="Booked" || $result[11]=="Re-booked" ||
															$result[11]=="Reviewed for Re-booking")))) ? "Dis" : $result[11];
													
													// checkbox column
													if($_SESSION['rights']==1){
														//JD-2013/04/19 - changed to allow admin to approve for air ticket request
														chk_stat_sales($pp, $result[12],$result[15]);
														//echo '<td></td>';
													}else{
														chk_stat_sales($pp, $result[12],$result[15]);	
													}

													// date filed column
													edit($result[11], $result[0], $result[12], $result[15]);
													
													// name column
													echo '<td>',$name,'</td>';
													
													$findme   = '<br/>';
													$pos = strpos($result[4], $findme);

													// origin column
													if ($pos !== false) {
														$result[4] = substr($result[4], 0, $pos);
													}
													echo '<td>From ',$result[4];
													
													// destination column
													$pos1 = strpos($result[5], $findme);
													if ($pos1 !== false) {
														$result[5] = substr($result[5], 0, $pos1);
													}
													echo ' to ',$result[5],'<br>';
													
													// type of trip
													if($pos !== false && $pos1 !== false){
														echo 'Round trip<br>';
													}
													else{
														echo 'One way trip<br>';
													}
													// depart on
													echo 'Departure: ',$result[7], '<br>';
													
													// return on
													if($result[8]!=null){
														echo 'Return on: ',$result[8];
													}
													echo '</td>';
													
													// client column
													echo '<td width="20%">';
													if($result[6]!=NULL){
														echo $result[6],'<br>';
													}

													// purpose
													echo 'For: ',$result[9],'</td>';
													
													// amount
													chk_file($result[14], $result[15], $result[11]);
													
													// remarks column										
													show_remarks($result[12]);
													
													// status column
													echo '<td><button class="btn btn-',f_color($result[11]),'">',$result[11],'</button></td>';
													
													/*for manager & sales admin
													if($a_data[0]==2){										
														if($result[10]=="Pending" && $result[12]==0){
															$msg = "Deny air ticket request of ".$result[1]." ".$result[2]."?";
															$url = "view_airticket_request.php";														
															echo '<td><input type="submit" name="conf_air" value="',$result[11],'" class="confirm" 
																onclick="return app_den(\'',$name,'\',\'c_air\');">
															<input type="button" class="deny" 
																onclick="pop_action(\'',$msg,'\', \'',$url,'\', ',$result[11],',\'air\');"></td>';
														} 
														
														elseif ($result[10]=="Confirmed"&& $result[12]==1) {
															echo '<td>',"----",'</td>';
														} 
														else {
															echo '<td>',"----",'</td>';
														}	
													}
													elseif ($a_data[0]==4) {
														if($result[10]=="Confirmed" && $result[12]==1){
															echo '<td ><a href="#" title="Click to Review" 
																onclick="load_airticket(',$result[11],',\'edit\')"><input type="button" class="review"></a></td>';
														}
														elseif($result[10]=="Reviewed" && $result[12]==2) {
															 $msg = "Book air ticket application of ".$result[1]." ".$result[2]."?";
															 echo '<td ><input type="submit" name="done" value="',$result[11],'" class="done" 
																onclick="return Done(\'',$msg,'\');" /></td>';	
														}
														else {
															echo '<td>',"----",'</td>';
														}
													}
													elseif ($a_data[0]==1) {
														echo '<td>',"----",'</td>';
													}*/
													
													echo '</tr>';
													if($x=="a"){
														$x = $x . "b";
													} 
													else {
														$x = "a";
													}	
												}
											?>
										</tbody>
									</table>
								</div> <!-- table-responsive -->
								
								<div class="table-buttons row">
									<?php
										//JD-2013/04/19 - changed to display confirm and deny button on managers view
										//if($_SESSION['rights']==2 OR $_SESSION['rights']==5){
										//JD-2013/05/28 - Changed class of confirm button to approve
										if($_SESSION['rights']==2 OR $_SESSION['rights']==5){
											echo '<button type="submit" name="deny_air" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'air\');">Deny</button>'; 
											echo '<button type="submit" id="manager" name="conf_air" class="approve pull-right btn btn-primary" onclick="return confirmation(\'approve\',\'air\');">Approve</button>';							
												//<input type="submit" id="manager" name="conf_air" class="confirm" onclick="return confirmation(\'confirm\',\'air\');">
												//JD - changed name from deny_request to deny_air to enable deny function
										//JD-2013/04/26 - Added $_SESSION['rights']==1 to allow the admin to book confirmed air ticket applications
										}elseif($_SESSION['rights']==4){
											echo '
												<button type="submit" id="sales" name="book_air" class="done pull-right btn btn-primary" onclick="return confirmation(\'book\',\'air\');">Book</button>
												<button type="submit" name="cancel_air" class="cancel pull-right btn btn-black" onclick="return confirmation(\'cancel\',\'air\');">Cancel</button>
											';						
										}else if($_SESSION['rights']==1){
											//JD-2013/04/26 - Problem regarding 'done' button hiding when a checkbox is checked
											//Applications for booking can't proceed because of this problem.
											//JD-2013/05/28 - Changed class of confirm button to approve
											echo '
												<button type="submit" name="deny_air" class="deny pull-right btn btn-danger" onclick="return confirmation(\'deny\',\'air\');">Deny</button>
												<button type="submit" name="cancel_air" class="cancel pull-right btn btn-black" onclick="return confirmation(\'cancel\',\'air\');">Cancel</button>
												<button type="submit" id="sales" name="book_air" class="done pull-right btn btn-primary" onclick="return confirmation(\'book\',\'air\');">Book</button>
												<button type="submit" id="manager" name="conf_air" class="approve pull-right btn btn-primary" onclick="return confirmation(\'confirm\',\'air\');">Confirm</button>
											';
										}
										//JD-2012/10/03 - Added empty column to make page number display in the center of the screen on Administrator view
										//JD-2013/04/22 - Removed empty column to give space for the confirm and deny button on Administrator view
									?>
								</div>
							</form>
						</div> <!-- panel-body of undertime requests -->
				
				<?php
					if($_SESSION['rights']!=1){
						echo '
					</div> <!-- tab-pane (2) for undertime requests -->
					
				</div> <!-- tab-content -->
						';
					}
				?>
				
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
		<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
		<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#airticket-applications-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
			$(document).ready(function() {
				$('#airticket-requests-table').dataTable({
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