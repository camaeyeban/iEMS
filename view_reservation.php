<?php
session_start();
ini_set('session.bug_compat_42', 0);
ini_set('session.bug_compat_warn', 0);

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
	
	$chk = $_POST['itemChk'];
	if(isset($_POST['approve_rsrv'])){
		if(sizeof($chk)!=0){
			foreach($chk as $app){
				$qry = mysql_query("UPDATE ems_equip_requests SET status='Approved' WHERE erqst_id='$app' ");
				approve_send_email("equipment reservation", $app, "rsv");
			}
		}
	}elseif(isset($_POST['deny_rsrv'])){
	$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $deny){
				$qry = mysql_query("UPDATE ems_equip_requests SET status='Denied' WHERE erqst_id='$deny' ");
			}
		}
	}

	//finding the OIC department
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
	} else {
		$man_oic = "";
	}
	
	//finding the report to department
	$s_report = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE report_to='$_SESSION[emp_num]' ");
	$q_report = "''";
	while($row = mysql_fetch_array($s_report)){
		$q_report = $q_report.",'".$row[0]."'";
	}
		
	//JD-2012/11/12 - Added variables to store and carry values to another php object
	$qoic = $q_oic; //variable containing the oic
	$report = $q_report; //variable containing the report to
	$empnum = $_SESSION['emp_num']; //variable containing the employee number from session
	$depcode = $_SESSION['dept_code']; //variable containing the deptartment code from session

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    	<title>iEMS</title>
        <link rel='stylesheet' href='cssall.css' type='text/css' />
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
    </head>
    <body alink="green" vlink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    	<div id="container">
    	<?php include("menu.php"); ?>
			<div id="cc">
            	<div>
                	<span class="title">Equipment Reservation</span>
                </div>
                <div class="t">
					<table border='0' width='100%' id="t_color">
    				<form name="form1" action="view_reservation.php?searchby=0&search=&submit=search" method="GET">
						<tr>
							<td colspan="8">
								<table border='0' width="100%">
									<tr>
                                        <td>
                                        	Search by:
                                            <select name="searchby">
                                                <option value="0">Any</option>
                                                <option value="1">Date Filed</option>
                                                <option value="2">Emp. Firstname</option>
                                                <option value="3">Emp. Middlename</option>
                                                <option value="4">Emp. Lastname</option>																	
                                                <option value="5">Purpose</option>																	
                                                <!--<option value="6">Client</option>-->																	
                                                <option value="6">Status</option>																
                                            </select>
                                            
                                            &nbsp;&nbsp;&nbsp;Search for:
                                            <input type='search' name='search' placeholder="search here.."/>
                                            <input type="submit" class="search" name="submit" value="search"/>
                                        </td>
									</tr>
								</table>
							</td>
						</tr>
                        <tr>
                        	<td width="1%" style="background-color: #4f81bd"></td>
                            <th width="8%">Date Filed</th>
                            <th width="10%">Name</th>
                            <th width="8%" colspan="2">Purpose</th>
                            <th width="15%">From-To</th>
                        	<th width="4%">Days</th>
                            <th width="15%">Equipments</th>
                            <th width="20%">Remarks</th>
                            <th width="8%">Status</th>
                       	</tr>
                        </form>
                            <?php
                            	$by = $_GET['searchby'];
                            	$search = $_GET['search'];
                                	if(isset($_GET['submit']) && $_GET['submit']=="search"){				
                                    	switch($by){
                                            case 1:
                                            	$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_filed='$search' " :
													"dept_code='$_SESSION[dept_code]' AND date_filed='$search'";
                                            	break;
                                            
                                            case 2:
                                                $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_firstname LIKE '%$search%' " :
													"dept_code='$_SESSION[dept_code]' AND emp_firstname LIKE '%$search%'";
                                            	break;
    
                                            case 3:
                                                $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_middlename LIKE '%$search%' " :
													"dept_code='$_SESSION[dept_code]' AND emp_middlename LIKE '%$search%'";
                                            	break;									
                                            
                                            case 4:
                                                $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "emp_lastname LIKE '%$search%' " :
													"dept_code='$_SESSION[dept_code]' AND emp_lastname LIKE '%$search%'";
                                            	break;	
    
                                            case 5:
                                                $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "subject_purpose='$search' " :
													"dept_code='$_SESSION[dept_code]' AND subject_purpose='$search'";
                                            	break;
    
                                        	/*case 6:
                                                $strqry = ($_SESSION['rights']==1) ? "client_branch='$search' " : "dept_code='$_SESSION[dept_code]' 
													AND client_branch='$search'";
                                            	break;*/
    
                                            case 6:
                                                $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "status='$search' " :
													"dept_code='$_SESSION[dept_code]' AND status='$search'";
                                            	break;
                                            
                                            case 0:
                                                $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==5) ? "date_filed='$search' OR 
													emp_firstname LIKE '%$search%' OR emp_middlename LIKE '%$search%' 
													OR emp_lastname LIKE '%$search%' OR subject_purpose='$search' OR r.status='$search'" : 
													"(dept_code='$_SESSION[dept_code]' AND (date_filed='$search' OR emp_firstname LIKE '%$search%' 
													OR emp_middlename LIKE '%$search%' OR emp_lastname LIKE '%$search%' 
													OR subject_purpose='$search' OR r.status='$search'))";
                                            	break;		
                                        }
                                    } else {
										//JD-2012/10/15 - Fixed bug in view reservation for report_to and OIC
                                        //Replace this code: $strqry = ($_SESSION['rights']==1 || 5) ? "1" : "dept_code='$_SESSION[dept_code]'"; with code below:
										$param = $_GET["param"]; //JD-2012/11/19 - Get paramater of the url
										$param = stripslashes($param); //JD-2012/11/19 - Used to removed slashes in the parameter
										$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==2) ? "$param" : "dept_code='$_SESSION[dept_code]'";
										//replace "1" with "$param" as the default value
									}
                                    
                                    if($_SESSION['rights']==1){ //For Adminisitrator
										if(!$strqry){
											$str = "SELECT r.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, subject_purpose, client_branch, 
														date_from, date_to, no_of_days, equip_list, r.remarks, r.status, erqst_id
														FROM ems_equip_requests as r 
														INNER JOIN ems_employee as e ON r.emp_num  = e.emp_num 
														WHERE 1
														ORDER BY r.erqst_id DESC";							
										}else{
											$str = "SELECT r.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, subject_purpose, client_branch, 
														date_from, date_to, no_of_days, equip_list, r.remarks, r.status, erqst_id
														FROM ems_equip_requests as r 
														INNER JOIN ems_employee as e ON r.emp_num  = e.emp_num 
														WHERE $strqry
														ORDER BY r.erqst_id DESC";	
										}
                                    }

                                    //JD-2012/06/25 - Separate Condition for Executive to show only managers' equipment reservations
									elseif($_SESSION['rights']==5){
										$str = "SELECT r.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, subject_purpose, client_branch, 
													date_from, date_to, no_of_days, equip_list, r.remarks, r.status, erqst_id
													FROM ems_equip_requests as r
													INNER JOIN ems_employee as e ON r.emp_num = e.emp_num
													INNER JOIN ems_users as ue ON ue.emp_num = e.emp_num
													WHERE 1 AND ue.rights=2
													ORDER BY r.erqst_id DESC";
									}

									//JD-2012/09/24 - Modified query to show only employees' applications under the 'report to' and 'oic' personnel
									else { //Managers
										$str = "SELECT r.date_Filed, e.emp_firstname, e.emp_middlename, e.emp_lastname, subject_purpose, client_branch, 
													date_from, date_to, no_of_days, equip_list, r.remarks, r.status, erqst_id
													FROM ems_equip_requests as r 
													INNER JOIN ems_employee as e ON r.emp_num  = e.emp_num
													INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
													WHERE ($strqry OR (dept_code IN($q_oic) AND rights!=2) OR (dept_code IN ($q_report) AND rights=2) $man_oic) 
													AND r.emp_num!='$_SESSION[emp_num]'
													ORDER BY r.erqst_id DESC";
									}
									
									//echo $str;
									
									$my_variable = 'param='.$strqry; //JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
									$pager = new PS_Pagination($conn, $str, 10, 5, $my_variable); //JD-2012/11/19 - append variable to the pagination function
									$pager->setDebug(true);
									$rs = $pager->paginate();
									if(!$rs){
										die(mysql_error());
									}
									$x = "a";
									?>
									<form name="form_reserve" action="view_reservation.php?searchby=0&search=&submit=search" method="POST" />
                                    <?php
									while($result = mysql_fetch_array($rs)){
										$name = $result[1]." ".$result[2]." ".$result[3];
										echo '<tr align="center" class="',$x,'" valign="top">';
										echo $showChk = ($view) ? '<td></td>' : chk_stat($result[11], $result[12], "rsvr_ad");
										echo '<td>',$result[0],'</td>';
										echo '<td>',$name,'</td>';
										echo '<td colspan="2">',$result[4],'</td>';										
										echo '<td>',$result[6]," / ",$result[7],'</td>';										
										echo '<td>',$result[8],'</td>';

										$equip = explode("|", $result[9]);
										for($i=0;$i<sizeof($equip)-1;$i++){
											if(sizeof($equip)==2){
												$items =  $equip[$i];
											} else {
												$pp = $pp . $equip[$i] . " / ";
												$items = del_slash($pp);
											}
										}
										
										echo '<td>',$items,'</td>';												
										$items= "";
										$pp = "";
										
										if($view){
											echo '<td>',$result[10],'</td>';
										} else {	
											show_remarks($result[12]);
										}
										echo '<td style="color:',f_color($result[11]),';"><b>',$result[11],'</b></td>';	
										
										
										echo '</tr>';
										if($x=="a") {
											$x = $x . "b";
										} else {
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
                                        if($view==false){
                                        	echo '<td width="30%" align="right" colspan="8" style="padding-right:0px;"><input type="submit" name="approve_rsrv" class="approve" onclick="return confirmation(\'approve\',\'rsrv\');">
													<input type="submit" name="deny_rsrv" class="deny" onclick="return confirmation(\'deny\',\'rsrv\');"></td>';				
                                        } else {
                                            echo '<td width="20%"></td>';
										}
                                            echo '</form>';
												if($_SESSION['rights']==1 OR $_SESSION['rights']==2){ //Only Administrator and Manager can export files
													echo '<td width="5%">';
													echo '<form name="export" method="post" action="emp_export.php">';
													?>
                                                        <input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
                                                        <input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
                                                        <input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
                                                        <input type="text" name="depcode" value="<?php echo $depcode ?>" hidden="hidden" />
                                                        <!--<input type="submit" name="export" value="export_reserveBtn" class="export">-->
													<?php
                                                    echo '</form>';
													echo '</td>';
												}
											echo '</tr>';
                                        echo '</table>';									
                            ?>
                    </table>
				</div>
			</div>
			<div id="footer">
            	<br/><p>Copyright 2011</p>     
        	</div>
    </body>
</html>