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
	
	if($_SESSION['rights']==2 OR $_SESSION['rights']==5){
			echo '<h1>',"Invalid URL!",'</h1>';
			return false;
	}
	
	//TL-2012/01/20 - Changed $a_data[0] to $_SESSION['rights'].
	$a_qry = mysql_query("SELECT rights FROM ems_users WHERE username='$_SESSION[username]' ");
	$a_data = mysql_fetch_array($a_qry);
	
	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	$q_oic = "''";
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = "'".$row[0]."'";
	}
	
	//Condition not to include the applications of the OIC itself.
	$sman_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' AND dept_code = 'DEP-0000' ");
	$cnt = mysql_num_rows($sman_oic);
	if($cnt > 0){
		$man_oic = " OR (rights=2) ";
	}else{
		$man_oic = "";
	}
	
	//Finding the report to department
	$s_report = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE report_to='$_SESSION[emp_num]' ");
	//Show applications of one manager in one or more departments
	$q_report = "''";
	while($row = mysql_fetch_array($s_report)){
		$q_report = "'".$row[0]."'";
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
            <div id="cc" >
            	<div>
                	<span class="title">Time-in/Time-out Summary</span>
                </div>
                <div class="t">
                    <table border='0' width='100%' id="t_color">		 
                        <tr>
                            <td colspan="8"style="font-weight:bold;font-size:18px;color:#3b5998">
                                Leave Applications
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9">
                                <table border='0' width="100%">
								<form name="form1" action="leave_mngr_summary.php?searchby=0&search=&submit=search_lv" method="GET">	
                                    <tr>
                                        <td>
                                            Search by:
                                            <select name="searchby">
                                                <option value="0">Any</option>
                                                <option value="1">Date Filed</option>
                                                <option value="2">Emp. Firstname</option>
                                                <option value="3">Emp. Middlename</option>
                                                <option value="4">Emp. Lastname</option>
                                                <option value="5">Type</option>
                                                <option value="6">Status</option>
                                            </select>
                                            &nbsp;&nbsp;&nbsp;Search for:
                                            <input type='search' name='search' placeholder="search here.."/>
                                            <input type="submit" class="search" name="submit" value="search_lv"/>
                                        </td>
                                        <td align="right"><a href="leave_mngr.php"><img src="icons/alv.png"/></a></td>
                                    </tr>
                        		</form>
                                </table>
                            </td>
                        </tr>
                        <tr>	
                            <td width="1%" style="background-color: #4f81bd"></td>
                            <th width="10%">Date Filed</th>
                            <th width="10%">Name</th>
                            <th width="15%">From-To</th>
                            <th width="8%">Time</th>
                            <th width="8%">Type</th>
                            <th>Reason</th>
                            <th width="15%">Remarks</th>
                            <th width="8%">Status</th>
                    	</tr>
                            <?php
                            
                                $by = $_GET['searchby'];
                                $search = $_GET['search'];
                                if(isset($_GET['submit']) && $_GET['submit']=="search_lv"){				
                                    switch($by){
                                        case 1:
                                            $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "date_filed='$search' " :
                                                "dept_code='$_SESSION[dept_code]' AND date_filed='$search'";
                                        break;
                                        
                                        case 2:
                                            $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "emp_firstname LIKE '%$search%' " :
                                                "dept_code='$_SESSION[dept_code]' AND emp_firstname LIKE '%$search%'";
                                        break;
                                        
                                        case 3:
                                            $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "emp_middlename LIKE '%$search%' " :
                                                "dept_code='$_SESSION[dept_code]' AND emp_middlename LIKE '%$search%'";
                                        break;									
                                        
                                        case 4:
                                            $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "emp_lastname LIKE '%$search%' " :
                                                "dept_code='$_SESSION[dept_code]' AND emp_lastname LIKE '%$search%'";
                                        break;
                                        
                                        case 5:
                                            $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "l.type LIKE '%$search%'" : 
                                                "dept_code='$_SESSION[dept_code]' AND l.type='$search'";
                                        break;
                                        
                                        case 6:
                                            $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "l.status LIKE '%$search%'" : 
                                                "dept_code='$_SESSION[dept_code]' AND l.status='$search'";
                                        break;
                                        
                                        case 0:
                                            $strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) 
														? //If not searching, this will be used
													"(eu.rights=2 OR eu.rights=4) AND
														(date_filed='$search' 
														OR emp_firstname LIKE '%$search%' 
														OR emp_middlename LIKE '%$search%' 
														OR emp_lastname LIKE '%$search%' 
														OR l.type='$search'
														OR l.status='$search')" 
														: //If searching this will be used. Same as the ones above
													"(eu.rights=2 OR eu.rights=4) 
														AND (date_filed='$search' 
														OR emp_firstname LIKE '%$search%' 
														OR emp_middlename LIKE '%$search%' 
														OR emp_lastname LIKE '%$search%' 
														OR l.type='$search'
														OR l.status='$search')";
                                        break;
                                    }
                                }else{
									$param = $_GET["param"]; //JD-2012/11/19 - Get paramater of the url
									$param = stripslashes($param); //JD-2012/11/19 - Used to removed slashes in the parameter
									$strqry = ($_SESSION['rights']==1 OR $_SESSION['rights']==4) ? "$param" : "dept_code='$_SESSION[dept_code]'";
									//replace "1" with "$param" as the default value
                                }
								//JD-2013/04/23 - Fixed bug regarding search function
                                if($_SESSION['rights']==1 OR $_SESSION['rights']==4){
									if(!$strqry){
										$str = "SELECT dateFiled, emp_num, time_in, time_out, status, 
													e.emp_firstname, e.emp_middlename, e.emp_lastname
													FROM ems_time as t
													INNER JOIN ems_employee as e
													ON e.emp_num = t.emp_num
													WHERE 1 AND emp_num='$_SESSION[emp_num]'
													ORDER BY time_id DESC";
									}else{
										$str = "SELECT date_Filed, e.emp_firstname,e.emp_middlename, e.emp_lastname, d_from, d_to, no_of_days, 
													l.type, reason, l.status, leave_id, remarks, time
													FROM ems_leave as l
													INNER JOIN ems_employee as e
													ON e.emp_num = l.emp_num 
													INNER JOIN ems_users as eu
													ON eu.emp_num=e.emp_num
													WHERE $strqry 
													ORDER BY l.leave_id DESC";
													//add this after (eu.rights=2 OR eu.rights=4): AND $strqry
									}
								}
								
								//JD-2012/11/19 - add value to the url named param and concatenate value of $strqry
								//JD-2012/11/19 - append variable to the pagination function
								$my_variable = 'param='.$strqry;
								//echo $str;
								
								//$conn = connection to database
								//$str = query
								//10 = maximum number of records in a page
								//5 = maximum number of visible pages on the navigation
								//$my_variable = variable that contains the search parameters
                                $pager = new PS_Pagination($conn, $str, 10, 5, $my_variable); 
								$pager->setDebug(true);
                                $rs = $pager->paginate();
                                
                                if(!$rs){
                                    die(mysql_error());
                                }
                                $x = "a";
								
                                while($result = mysql_fetch_array($rs)){	
                                    echo '<tr align="center" class="',$x,'" valign="top">';
                                    chk_stat($result[9], $result[10], "lv_man");
                                    echo '<td>',$result[0],'</td>';
                                    echo '<td>',$result[1]." ".$result[2]." ".$result[3],'</td>';																			
                                    echo '<td>',$result[4]." / ".$result[5],'</td>';	
                                    /*$pos = strpos($result[6],".");
                                        if($pos){
                                            echo '<td>',$result[7]."-".$result[12],'</td>';
                                        }else{
                                            echo '<td>',$result[7],'</td>';
                                        } */
                                    //JD-2012/06/20 - Subtracted time to no. of days
									if($result[12]=="" OR $result[12]==0){
										echo '<td></td>';
									}else{
                                    	echo '<td>',$result[12],'</td>';
									}
									echo '<td>',$result[7],'</td>';
                                    echo '<td>',$result[8],'</td>';
                                    show_remarks($result[10]);
                                    echo '<td style="color:',f_color($result[9]),';"><b>',$result[9],'</b></td>';
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
											echo '<td width="10%">Page ',$p,' of ',$page,'></td>';
										}
									}else{
										if($page<=0){
											echo '<td width="20%"></td>';									
										}else{
											echo '<td width="20%">Page ',$p,' of ',$page,'</td>';									
										}
									}
                                
                                echo '<td align="center" width="60%">',$pager->renderFullNav(),'</td>';
								echo '<td></td>';									
                                /*echo '<td width="12%" align="right" colspan="8" style="padding-right:0px;">
                                    <input type="submit" name="approve_lv" class="approve" onclick="return confirmation(\'approve\');">
                                    <input type="submit" name="deny_lv" class="deny" onclick="return confirmation(\'deny\');">
									</form>';
								echo '</td>';*/
								if($_SESSION['rights']==1 OR $_SESSION['rights']==2){
									echo '<td width="5%">';
									echo '<form name="export" method="post" action="emp_export.php">';
									?>
											<input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
                                            <input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
                                            <input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
                                            <input type="text" name="depcode" value="<?php echo $depcode ?>" hidden="hidden" />
                                            <!--<input type="submit" name="export" value="export_leaveBtn" class="export">-->
									<?php
                                    echo '</form>';
									echo '</td>';
								}
                                echo '</tr>';
								echo '</form>';
                                echo '</table>';
                            ?>
                    </table>
				</div>
			</div>
            <div id="footer">
                <br/><p>Copyright 2011</p>     
            </div>
        </div>
    </body>
</html>