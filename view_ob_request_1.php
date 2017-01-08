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
				$qry = mysql_query("UPDATE ems_ob_new SET status='Approved' WHERE ob_id='$app' ");
				approve_send_email("official business application", $app, "ob");
			}
		}
	}elseif(isset($_POST['conf_ob'])){
	$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $conf){
				$qry = mysql_query("UPDATE ems_ob_new SET status='Confirmed' WHERE ob_id='$conf' ");
				// approve_send_email("official business application", $app, "ob");
			}
		}
	}elseif(isset($_POST['deny_ob'])){
	$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_ob_new SET status='Denied' WHERE ob_id='$deny' ");
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
        <title>iEMS</title>
        <link rel='stylesheet' href='cssall.css' type='text/css' />
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
		<div id="container">
		<?php include("menu.php"); ?>
            <div id="cc">
				<div><span class="title">Official Business Request</span></div>
				<div class="t">
                	<table border='0' width='100%' id="t_color">
						<tr>
                        	<td colspan="8">
								<table border='0' width="100%">
									<form name="form1" action="view_ob_request.php?searchby=0&search=&submit=search" method="GET">
									<tr>
										<td>
                                        	Search by:
											<select name="searchby">
												<option value="0">Any</option>
												<option value="1">Date Filed</option>
												<option value="2">OB Date</option>
												<option value="3">Emp. Firstname</option>
												<option value="4">Emp. Middlename</option>
												<option value="5">Emp. Lastname</option>																	
												<option value="6">Client/Branch</option>																	
												<option value="7">Status</option>
											</select>

											&nbsp;&nbsp;&nbsp;Search for:
										  	<input type='search' name='search' placeholder="search here.."/>
										  	<input type="submit" class="search" name="submit" value="search"/>
										</td>
									</tr>
                        			</form>
								</table>
							</td>
                    	</tr>
						<tr>
                    		<td width="1%" style="background-color: #4f81bd"></td>
                            <th width="8%">Date Filed</th>
                            <th width="10%">Name</th>
                            <th width="18%">Client/ Branch</th>
                            <th width="8%">Purpose</th>
                            <th width="8%">OB Date/s</th>
                            <th width="8%">Departure / Time Started</th>
                            <th width="8%">Arrival / Time Ended</th>
                            <th width="8%">Total duration (hr.min)</th>
                            <th width="6%">Remarks</th>
                            <th width="8%">Status</th>
                        </tr>
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
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "ob_date LIKE '%$search%' " :
														"b.b_manager_name='$_SESSION[fullname]' AND (ob_date LIKE '%$search%' )";
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
											$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "ob_date LIKE '%$search%'  
													OR emp_firstname LIKE '%$search%' 
													OR emp_middlename LIKE '%$search%' 
													OR emp_lastname LIKE '%$search%' 
													OR client_branch='$search' 
													OR o.status LIKE '%$search%'" 
													: 
													"b.b_manager_name='$_SESSION[fullname]' AND (ob_date LIKE '%$search%' 
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
									$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "$param" : "b.b_manager_name='$_SESSION[fullname]'";
								}
								
								//echo "LOG IN RIGHTS: ".$_SESSION['rights'];
								if($_SESSION['rights']==1){ //admin
									echo"<script>alert('rights: 1');</script>";
									if(!$strqry){				
										$str = "SELECT date_filed, ob_date, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose,
													departure, arrival, total, status, ob_id, remarks, ob_dtype, time_start, time_end
													FROM ems_ob_new AS o
													INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num 
													WHERE 1
													ORDER BY o.ob_id DESC";						
									}else{					
										$str = "SELECT date_filed, ob_date, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose,
													departure, arrival, total, status, ob_id, remarks, ob_dtype, time_start, time_end
													FROM ems_ob_new AS o
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
									echo"<script>alert('rights: 5');</script>";
									$str = "SELECT date_filed, ob_date, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose,
													departure, arrival, total, o.status, ob_id, remarks, ob_dtype, time_start, time_end
												FROM ems_ob_new AS o
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
									
									//echo"<script>alert('rights: else');</script>";
									
									$str = 
									"SELECT date_filed, ob_date, e.emp_firstname, e.emp_middlename, e.emp_lastname, client_branch, purpose,
										departure, arrival, total, o.status, ob_id, remarks, ob_dtype, time_start, time_end
										FROM ems_ob_new AS o
										INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num
										INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
										LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
										WHERE ($strqry OR (e.dept_code IN($q_oic) AND rights!=2) OR (e.dept_code IN ($q_report) AND rights=2) $man_oic) 
										AND o.emp_num!='$_SESSION[emp_num]' AND e.code != 'EST004'
										ORDER BY o.ob_id DESC";
										
								}
								//echo $str; //- For debugging
								
								$my_variable = 'param='.$strqry; //JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
								$pager = new PS_Pagination($conn, $str, 10, 5, $my_variable); //JD-2012/11/19 - append variable to the pagination function
								$pager->setDebug(true);
								$rs = $pager->paginate();
									if(!$rs){
										die(mysql_error());
									}
								$x = "a";
								?>
                                <form name="form_ob_req" action="view_ob_request.php?searchby=0&search=&submit=search" method="POST" />
                                <?php
								while($result = mysql_fetch_array($rs)){		
									$name = $result[2]." ".$result[3]." ".$result[4];
									echo '<tr align="center" class="',$x,'">';
									chk_stat($result[10], $result[11], "ob_man");


									echo '<td>',$result[0],'</td>'; //date filed
									echo '<td>',$name,'</td>'; //name
									echo '<td>',$result[5],'</td>';	//client/branch
										
									$pur = explode("|", $result[6]);
									for($i=0; $i<sizeof($pur)-1; $i++){
										if(sizeof($pur)==2){
											$purpose =  $pur[$i];
										}else{
											$pp = $pp . $pur[$i] . " / ";
											$purpose = del_slash($pp);
										}
									}									
									echo '<td>',$purpose,'</td>'; //purpose
									$purpose = "";
									$pp = "";

									if($result[13]=="sd")//if OB is single day
									{	//ob date
										echo'<td>',$result[1],'</td>';

										//departure
										echo '<td>',display_time(trim($result[7])),'</td>';

										//arrival
										echo '<td>',display_time($result[8]),'</td>';

										//total
										echo'<td>',$result[1],'</td>';

									}
									else // Multiple dates OB
									{	//ob dates
										$item = explode("|",$result[1]);
											for($i=0;$i<sizeof($item)-1;$i++){
												$items = $items . $item[$i] . '<br/>';
											}										
											echo '<td>',$items,'</td>';	
											$items = "";

										//departure and arrival
											$time = explode("|",$result[14]);
											$time2 = explode("|",$result[15]);
											for($i=0;$i<sizeof($time)-1;$i++){
												$time_s = $time_s . $time[$i] . '<br/>';
												$time_e = $time_e . $time2[$i] . '<br/>';
											}										
											echo '<td>',$time_s,'</td>';	
											echo '<td>',$time_e,'</td>';	
											$time_s = "";
											$time_e = "";	


										//total
										$item = explode("|",$result[9]);
											for($i=0;$i<sizeof($item)-1;$i++){
												$items = $items . $item[$i] . '<br/>';
											}										
											echo '<td>',$items,'</td>';	
											$items = ""; 
									}

							
									
									show_remarks($result[11]); //remarks
									echo '<td id="stat_val" style="color:',f_color($result[10]),';"><b>',$result[10],'</b></td>';//status																				
									echo '</tr>';
									
									if($x=="a"){
										$x = $x . "b";
									}else{
										$x = "a";
									}	
								}	
								
								echo '</table>';
								echo '<tr><td><hr/></td></tr>';
									$qry = mysql_query($str);
									$page = ceil(mysql_num_rows($qry)/10);
									echo '<table border="0" width="100%">';
										echo '<tr>';
										$p = (!isset($_GET['page'])) ? 1 : $_GET['page'] ; //JD-2013/01/07 - Fixed alignment of pagination
											if($_SESSION['rights']==5){
												if($page<=0){
													echo '<td width="20%"></td>';
												}else{
													echo '<td width="25%">Page ',$p,' of ',$page,'></td>';
												}
											}else{
												if($page<=0){
													echo '<td width="20%"></td>';									
												}else{
													echo '<td width="30%">Page ',$p,' of ',$page,'</td>';									
												}
											}
											echo '<td align="center" width="50%">',$pager->renderFullNav(),'</td>';										
											echo '<td width="30%" align="right" colspan="8" style="padding-right:0px;"><input type="submit" name="approve_ob" id="approve" class="approve" onclick="return confirmation(\'approve\',\'ob\');">
												<input type="submit" name="conf_ob" id="confirm" class="confirm" onclick="return confirmation(\'confirm\',\'ob\');">
												<input type="submit" name="deny_ob" id="deny" class="deny" onclick="return confirmation(\'deny\',\'ob\');">
												</form></td>';
											if($_SESSION['rights']==1 OR $_SESSION['rights']==2){
												echo '<td width="100%" colspan="3" align="left">';
												echo '<form name="export" method="post" action="emp_export.php">';
												?>
                                                		<input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
                                                        <input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
                                                        <input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
                                                        <input type="text" name="bman" value="<?php echo $bman ?>" hidden="hidden" />
														<!--<input type="submit" name="export" value="export_officialBtn" class="export">-->
												<?php
                                                echo '</form>';
												echo '</td>';
											}
										echo '</tr>';
									echo '</table>';
							?>
						</tr>
                    </table>
				</div>
			</div>
			<div id="footer">
				<br/>
                <p>Copyright 2011</p>     
			</div>
		</div>
	</body>
</html>