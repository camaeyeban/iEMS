<?php
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);
	ini_set('memory_limit', '-1');
	session_start();

	include("config_DB.php");
	include("functions.php");
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}	
	chk_active($_SESSION['user_id']);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>iEMS</title>
        <link rel='stylesheet' href='cssall.css' type='text/css' />
        
		<!--Export HTML TABLE to CSV-->
		<script src="excellentexport.js"></script>
		
		<!---->
		<script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        
        <!--tabs-->
        <link rel="stylesheet" href="tabs.css" type="text/css">
        <script type="text/javascript" src="jquery.tools.min.js"></script>
        <script type="text/javascript" src="easy.notification.js"></script>
        <script type="text/javascript" src="jquery.cookie.js"></script>
		<script type="text/javascript">
            $(document).ready(function(){
				function load_lv(ID,action){
					window.open("leave_undertime.php?ID="+ID+"&action="+action,"_self");
				}
				function load_un(ID,action){
					window.open("leave_undertime.php?ID="+ID+"&action="+action,"_self");
				}
				function load_ot(ID,action){
					window.open("ot.php?ID="+ID+"&action="+action,"_self");
				}
				function load_ob(ID,action){
					window.open("ob.php?ID="+ID+"&action="+action,"_self");
				}
				function load_off(ID,action){
					window.open("offset.php?ID="+ID+"&action="+action,"_self");
				}	  
				function load_rsrv(ID,action){
					window.open("equip_request.php?ID="+ID+"&action="+action,"_self");
				}	  
				function load_air(ID,action){
					window.open("airticket.php?ID="+ID+"&action="+action,"_self");
				}
			}
        </script>
	</head>
    <body alink="#1f57a0" vlink="#1f57a0" link="#1f57a0" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<div id="container">
            <?php include("menu.php");?>
        </div>
		<div id="container">
			<div id = "cc">
				<?php
					if(!$_GET['genreport'])
					{
						if (headers_sent())
							die("Redirect failed. Please click on this link: <a href='login.php'>login.php</a>");
						else
							exit(header("Location: login.php"));
					}//if 
				
					$date_fr = $_GET['from'];
					$date_to = $_GET['to'];
					$request = $_GET['request'];
					$emp_status = $_GET['emp_status'];
					$status = $_GET['status'];
					
					$sql = "SELECT a.emp_lastname, a.emp_firstname, c.dept_name, a.emp_num, d.vl_balance, d.sl_balance, 
					a.Biometrics_ID, a.Falco_ID, e.rank, f.job_title_name, b.name, a.date_employ, a.date_sep,
					a.time_in, a.time_out from ems_employee a 
					inner join ems_emp_status b, ems_department c, ems_benefits d, ems_joblevel e,ems_jobtitle f where a.jl_id = e.jl_id
					and a.emp_num = d.emp_num and a.code = b.code and a.dept_code = c.dept_code and f.job_title_code = a.job_title_code and ";
					
					if($_GET['opt'] == '1')
					{
						if($_GET['for'] == 'All')
							$sql .= " b.name in ('".implode("','",$emp_status)."')";
						else
							$sql .= " b.name in ('".implode("','",$emp_status)."') and a.dept_code = '" . $_GET['for'] . "'";
					}//if company
					else
					{
						$sql = "SELECT a.emp_lastname, a.emp_firstname, c.dept_name, a.emp_num, d.vl_balance, d.sl_balance, a.Biometrics_ID, a.Falco_ID, e.rank, f.job_title_name, b.name, a.date_employ, a.date_sep, a.time_in, a.time_out from ems_employee a inner join ems_emp_status b, ems_department c, ems_benefits d, ems_joblevel e,ems_jobtitle f where a.jl_id = e.jl_id and a.emp_num = d.emp_num and a.code = b.code and a.dept_code = c.dept_code and f.job_title_code = a.job_title_code and (a.emp_lastname LIKE '%" . $_GET['emp_name'] . "%' or a.emp_firstname LIKE '%" . $_GET['emp_name'] . "%') ";
					}//if name
					
					//$sql .= " and a.date_employ < '" . $date_fr . "' and a.date_sep = '0000-00-00' group by a.emp_num order by a.emp_lastname, a.emp_firstname";
					$sql .= " and a.date_employ < '" . $date_to . "' and (a.date_sep = '0000-00-00' or a.date_sep >= '" . $date_fr ."') group by a.emp_num order by a.emp_lastname, a.emp_firstname";
					
					$get = mysql_query($sql);
					
					if(!$get)
						echo mysql_error() . "<br/>";
					
					$emp_record = array();
					
					$bReportPrint = false;
					
					if($_GET['type'] == 'allR')
						$bReportPrint = true;
					
					$sql_set = "SELECT settingName, value from ems_settings";
					
					$get_set = mysql_query($sql_set);
					
					$startCutOff = '';
					$endCutOff = '';
					
					
					while($row_set = mysql_fetch_array($get_set))
					{
						switch($row_set[0])
						{
							case 'leaveCutOffStart' : $startCutOff = $row_set[1]; break;
							case 'leaveCutOffEnd' : $endCutOff = $row_set[1]; break;
						}//
					}//
					
					$i = 0;
					
					while($row_emp = mysql_fetch_array($get))
					{
						$emp_record[$i] = array();
						
						$emp_record[$i]['D'] = array();
						$emp_record[$i]['C'] = array();
						
						$emp_record[$i]['LN'] = $row_emp[0];
						$emp_record[$i]['FN'] = $row_emp[1];
						
						switch($row_emp[8])
						{
							case 'Staff' :
							case 'Supervisor' : $emp_record[$i]['RN'] = 0; break;
							default:  $emp_record[$i]['RN'] = 1; break;
						}//switch
						
						$emp_record[$i]['JT'] = $row_emp[9];
						
						$emp_record[$i]['DN'] = $row_emp[2];
						$emp_record[$i]['EN'] = $row_emp[3];
						$emp_record[$i]['BI'] = $row_emp[6];
						$emp_record[$i]['FI'] = $row_emp[7];
						$emp_record[$i]['ES'] = $row_emp[10];
						$emp_record[$i]['HD'] = array();
						$emp_record[$i]['UT'] = array();
						$emp_record[$i]['VL'] = array();
						$emp_record[$i]['SL'] = array();
						$emp_record[$i]['RP'] = array();
						$emp_record[$i]['OS'] = array();
						$emp_record[$i]['TI'] = array();
						$emp_record[$i]['TO'] = array();
						
						$emp_record[$i]['VLB'] = array();
						$emp_record[$i]['SLB'] = array();
						
						$emp_record[$i]['OBD'] = array();
						$emp_record[$i]['OBA'] = array();
						
						$emp_record[$i]['OBTS'] = array();
						$emp_record[$i]['OBTE'] = array();
						
						$emp_record[$i]['OTREG'] = array();
						$emp_record[$i]['OTRSH'] = array();
						$emp_record[$i]['OTSHR'] = array();
						$emp_record[$i]['OTRHD'] = array();
						$emp_record[$i]['OTRHR'] = array();
						
						$date_employ = $row_emp[11];
						$date_seprte = $row_emp[12];
						
						$ctr = $date_fr;
						
						$VL_NUM = $row_emp[4];
						$SL_NUM = $row_emp[5];
						
						$VL_BALANCE = $row_emp[4];
						$SL_BALANCE = $row_emp[5];
						
						
						$vl_days = mysql_query("SELECT SUM(no_of_days) FROM ems_leave WHERE value = 1 AND emp_num = '" . $emp_record[$i]['EN'] . "'
											AND status = 'Approved' AND d_from >= '".$startCutOff."' AND d_to <= '". $date_fr . "' group by emp_num");
						$vl_row = mysql_fetch_array($vl_days);
						$vl_count = ($vl_row[0] > 0)? $vl_row[0] : 0;
						
						$sl_days = mysql_query("SELECT SUM(no_of_days) FROM ems_leave WHERE value = 2 AND emp_num = '" . $emp_record[$i]['EN'] . "'
											AND status = 'Approved' AND d_from >= '".$startCutOff."' AND d_to <= '".$date_fr."' group by emp_num");
						$sl_row = mysql_fetch_array($vl_days);
						$sl_count = ($sl_row[0] > 0)? $sl_row[0] : 0;
						
						$VL_BALANCE -= $vl_count;
						$SL_BALANCE -= $sl_count;
						
						if($VL_BALANCE < 0)
							$VL_BALANCE = 0;
						
						if($SL_BALANCE < 0)
							$SL_BALANCE = 0;
						
						$j = 0;
						
						$emp_record[$i]['R'] = 0;
						
						while(strtotime($ctr) <= strtotime($date_to))
						{
							$emp_record[$i]['D'][$j] = $ctr;
							$emp_record[$i]['C'][$j] = 0;
							
							$emp_record[$i]['HD'][$j] = 0;
							$emp_record[$i]['UT'][$j] = 0;
							$emp_record[$i]['VL'][$j] = 0;
							$emp_record[$i]['SL'][$j] = 0;
							$emp_record[$i]['OS'][$j] = '';
							$emp_record[$i]['RP'][$j] = '';
							$emp_record[$i]['TI'][$j] = $row_emp[13];
							$emp_record[$i]['TO'][$j] = $row_emp[14];
							
							$emp_record[$i]['VLB'][$j] = $VL_BALANCE;
							$emp_record[$i]['SLB'][$j] = $SL_BALANCE;
							$emp_record[$i]['OBD'][$j] = '';
							$emp_record[$i]['OBA'][$j] = '';
							
							$emp_record[$i]['OBTS'][$j] = '';
							$emp_record[$i]['OBTE'][$j] = '';
							
							$emp_record[$i]['OTREG'][$j] = 0;
							$emp_record[$i]['OTRSH'][$j] = 0;
							$emp_record[$i]['OTSHR'][$j] = 0;
							$emp_record[$i]['OTRHD'][$j] = 0;
							$emp_record[$i]['OTRHR'][$j] = 0;
							
							
							if($ctr < $date_employ)
								$emp_record[$i]['RP'][$j] = 'Not yet employed';
							
							if($date_seprte != '0000-00-00' && $date_seprte < $ctr)
								$emp_record[$i]['RP'][$j] = 'Resigned / Terminated';
								
							if($endCutOff == $ctr)
							{
								$VL_BALANCE = $VL_NUM;
								$SL_BALANCE = $SL_NUM;	
							}//
							
							$monthDay = date('m',strtotime($ctr)) . "-" . date('d',strtotime($ctr));
					
							$OT = mysql_query("SELECT expected_output, no_of_hours, cdc, time_start, time_end FROM ems_ot WHERE emp_num = '" . $emp_record[$i]['EN'] . "' AND status = '".$status ."' AND date_ot = '" . $ctr . "'");
							$UT = mysql_query("SELECT reason, time FROM ems_undertime WHERE emp_num = '" . $emp_record[$i]['EN'] . "' AND status  = '".$status ."' AND date_un  = '" . $ctr . "'");							
							$VL = mysql_query("SELECT reason, no_of_days, d_from FROM ems_leave WHERE emp_num = '" . $emp_record[$i]['EN'] . "' AND type = 'Vacation Leave' AND status ='".$status."' AND '" . $ctr . "' BETWEEN d_from and d_to");
							$SL = mysql_query("SELECT reason, no_of_days, d_from FROM ems_leave WHERE emp_num = '" . $emp_record[$i]['EN'] . "' AND type in ('Sick Leave','Emergency Leave') AND status ='".$status."' AND '" . $ctr . "' BETWEEN d_from and d_to");
							
							
							if($status == 'Approved')
								$OB_OLD = mysql_query("SELECT purpose, ob_from, ob_to, departure, time_start, time_end, arrival, remarks  FROM ems_ob WHERE emp_num = '" . $emp_record[$i]['EN'] . "' AND status in ('Approved','Confirmed') AND   '" . $ctr . "' BETWEEN ob_from and ob_to");
							else
								$OB_OLD = mysql_query("SELECT purpose, ob_from, ob_to, departure, time_start, time_end, arrival, remarks  FROM ems_ob WHERE emp_num = '" . $emp_record[$i]['EN'] . "' AND status = 'Pending' AND   '" . $ctr . "' BETWEEN ob_from and ob_to");
							
							
							$NW = mysql_query("SELECT name, type FROM ems_special_days WHERE '" . $ctr . "' BETWEEN date_from and date_to");
							
							if($status == 'Approved')
								$OB = mysql_query("SELECT purpose, ob_date, departure, time_start, time_end, arrival, remarks from ems_ob_new where ob_date LIKE '%" . date('m/d/Y',strtotime($ctr)) . "%' and emp_num = '" . $emp_record[$i]['EN'] . "' AND status in ('Approved','Confirmed')");
							else
								$OB = mysql_query("SELECT purpose, ob_date, departure, time_start, time_end, arrival, remarks from ems_ob_new where ob_date LIKE '%" . date('m/d/Y',strtotime($ctr)) . "%' and emp_num = '" . $emp_record[$i]['EN'] . "' AND status = 'Pending'");
							
							
							$OS = mysql_query("SELECT purpose, date_offset, off_type, off_halfday from ems_offset_new where emp_num = '" . $emp_record[$i]['EN'] . "' AND status  = '".$status ."' AND date_offset  = '" . $ctr . "'");
							if(!$OB)
								die(mysql_error());
								
							$row = mysql_fetch_array($OB);
							
							$ob_array = array();
							$ob_prpse = '';
							
							if(mysql_num_rows($OB) > 0)
							{
								$ob_date = explode("|",$row[1]);
								$ob_dept = explode("|",$row[2]);
								$ob_tmst = explode("|",$row[3]);
								$ob_tend = explode("|",$row[4]);
								$ob_arri = explode("|",$row[5]);
								
								for($o = 0; $o < count($ob_date); $o++)
								{
									$dt = date('Y-m-d',strtotime($ob_date[$o]));
									$ob_array[$dt]['dept'] = $ob_dept[$o];
									$ob_array[$dt]['tmst'] = $ob_tmst[$o];
									$ob_array[$dt]['tend'] = $ob_tend[$o];
									$ob_array[$dt]['arri'] = $ob_arri[$o];
									
								}
								
								$ob_prpse = $row[0] . " R " . $row[6];
							}
							
							if(!$NW)
								die("ERROR " . mysql_error());
							//OVERTIME
							$row = mysql_fetch_array($OT);
						
							if($row[2] > 0  && in_array('OT',$request))
							{
								switch($row[2])
								{
									case '1' : $emp_record[$i]['OTREG'][$j] = $row[1]; break;
									case '2' : $emp_record[$i]['OTRSH'][$j] = $row[1]; break;
									case '3' : $emp_record[$i]['OTSHR'][$j] = $row[1]; break;
									case '4' : $emp_record[$i]['OTRHD'][$j] = $row[1]; break;
									case '5' : $emp_record[$i]['OTRHR'][$j] = $row[1]; break;
								}//
								
								$emp_record[$i]['RP'][$j] .= ' ~OT ' . $row[3] . "-" . $row[4] . " = " . $row[0];
								$emp_record[$i]['C'][$j]++;
								$bReportPrint = true;
							}//if there is OT
							
							//UNDERTIME
							$row = mysql_fetch_array($UT);
							
							if($row[0] != "" && in_array('UT',$request))
							{
								$emp_record[$i]['UT'][$j] = date("H:i",strtotime($row[1]));
								$emp_record[$i]['RP'][$j] .= ' ~UT ' . $row[0];
								$emp_record[$i]['C'][$j]++;
								
								$bReportPrint = true;
							}//if there is undertime
							
							//VACATION LEAVE
							$row = mysql_fetch_array($VL);
							
							if($row[0] != "" && in_array('VL',$request))
							{
								$emp_record[$i]['VL'][$j] = ($row[2] == $ctr && $row[1] != floor($row[1]))? 0.5 : 1;
								$emp_record[$i]['C'][$j]++;
								$emp_record[$i]['RP'][$j] .= ' ~VL ' . $row[0];
								$emp_record[$i]['VLB'][$j] -= $emp_record[$i]['VL'][$j];
								$VL_BALANCE -= $emp_record[$i]['VL'][$j];
								$bReportPrint = true;
							}//if there is vacation leave
							
							//SICK LEAVE
							$row = mysql_fetch_array($SL);
							
							if($row[0] != "" && in_array('SL',$request))
							{
								$emp_record[$i]['SL'][$j] = ($row[2] == $ctr && $row[1] != floor($row[1]))? 0.5 : 1;
								$emp_record[$i]['C'][$j]++;
								$emp_record[$i]['RP'][$j] .= ' ~SL ' . $row[0];
								$emp_record[$i]['SLB'][$j] -= $emp_record[$i]['SL'][$j];
								$SL_BALANCE -= $emp_record[$i]['SL'][$j];
								$bReportPrint = true;
							}//if there is sick leave
							
							//OFFSET
							$row = mysql_fetch_array($OS);
							
							if($row[0] != "" && in_array('OS',$request))
							{
								$emp_record[$i]['OS'][$j] = $row[2] . " " . $row[3];
								$emp_record[$i]['C'][$j]++;
								$emp_record[$i]['RP'][$j] .= ' ~OS ' . $row[0];
								$bReportPrint = true;
							}//if there is sick leave
							
							//OFFICIAL BUSINESS
							
							$ob_counter = 0;
							
							if($ob_prpse != "" && in_array('OB',$request))
							{
								$emp_record[$i]['RP'][$j] .= ' ~OB ' .  $ob_prpse;
								$emp_record[$i]['C'][$j]++;
								
								$bReportPrint = true;
								
								$emp_record[$i]['OBD'][$j]  = date("H:i",strtotime($ob_array[$ctr]['dept']));
								$emp_record[$i]['OBTS'][$j] = date("H:i",strtotime($ob_array[$ctr]['tmst']));
								$emp_record[$i]['OBTE'][$j] = date("H:i",strtotime($ob_array[$ctr]['tend']));
								$emp_record[$i]['OBA'][$j]  = date("H:i",strtotime($ob_array[$ctr]['arri']));
								
								$ob_counter = 1;
							}//if there is official business old table
							
							$row = mysql_fetch_array($OB_OLD);
							
							if($row[0] != ''  && in_array('OB',$request) && $ob_counter == 0)
							{
								if(is_int($row[3])) $row[3] = "510";
								if(is_int($row[4])) $row[4] = "510";
								
								if(is_int($row[5])) $row[5] = "1110";
								if(is_int($row[6])) $row[6] = "1110";
								
								$emp_record[$i]['OBD'][$j] = display_time(trim($row[3]));
								$emp_record[$i]['OBTS'][$j] = display_time(trim($row[4]));
								$emp_record[$i]['OBTE'][$j] = display_time(trim($row[5]));
								$emp_record[$i]['OBA'][$j] = display_time(trim($row[6]));
								
								$emp_record[$i]['OBD'][$j] = date("H:i",strtotime($emp_record[$i]['OBD'][$j]));
								$emp_record[$i]['OBA'][$j] = date("H:i",strtotime($emp_record[$i]['OBA'][$j]));
								$emp_record[$i]['OBTS'][$j] = date("H:i",strtotime($emp_record[$i]['OBTS'][$j]));
								$emp_record[$i]['OBTE'][$j] = date("H:i",strtotime($emp_record[$i]['OBTE'][$j]));
								
								if($emp_record[$i]['OBD'][$j] == '--:--') $emp_record[$i]['OBD'][$j] = date("H:i",strtotime('08:30 AM'));
								if($emp_record[$i]['OBA'][$j] == '--:--') $emp_record[$i]['OBA'][$j] = date("H:i",strtotime('06:30 PM'));
								if($emp_record[$i]['OBTS'][$j] == '--:--') $emp_record[$i]['OBTS'][$j] = date("H:i",strtotime('08:30 AM'));
								if($emp_record[$i]['OBTE'][$j] == '--:--') $emp_record[$i]['OBTE'][$j] = date("H:i",strtotime('06:30 PM'));
								
								if($emp_record[$i]['OBD'][$j] == '00:00') $emp_record[$i]['OBD'][$j] = date("H:i",strtotime('08:30 AM'));
								if($emp_record[$i]['OBA'][$j] == '00:00') $emp_record[$i]['OBA'][$j] = date("H:i",strtotime('06:30 PM'));
								if($emp_record[$i]['OBTS'][$j] == '00:00') $emp_record[$i]['OBTS'][$j] = date("H:i",strtotime('08:30 AM'));
								if($emp_record[$i]['OBTE'][$j] == '00:00') $emp_record[$i]['OBTE'][$j] = date("H:i",strtotime('06:30 PM'));
								
								$emp_record[$i]['RP'][$j] .= ' ~OB ' . $row[0] . ' R ' . $row[7];
								$emp_record[$i]['C'][$j]++;
								
								$bReportPrint = true;
							}//if there is official business new table
							
							if($emp_record[$i]['RP'][$j] != '')
								$emp_record[$i]['R']++;
							
							$row = mysql_fetch_array($NW);
							
							if($row[0] != "")
							{
								$emp_record[$i]['RP'][$j] .= ' ~Special Day - ' . $row[0] . ' ( ' . $row[1] . ' ) ';
								
								$emp_record[$i]['HD'][$j] = 1;
								
								if($emp_record[$i]['ES'] == 'Regular' || $emp_record[$i]['ES'] == 'Probationary')
									$emp_record[$i]['HD'][$j] = 1;
								else if($emp_record[$i]['ES'] == 'Casual' && $row[2] == 'Special Holiday')
									$emp_record[$i]['HD'][$j] = 1;
									
							}
							
							$ctr = date ("Y-m-d", strtotime("+1 day", strtotime($ctr)));
							$j++;
						}
						$i++;
					}//while getting records in query
					
					if($bReportPrint === false)
						echo "<center><font style = 'color: #122AFF; font-family: courier new; font-style: normal; font-weight: bolder; font-variant: normal;text-indent: 4px; cursor: pointer; font-size : 40px'>NO RECORDS AVAILABLE<br/>FOR THAT CATEGORIES</font></center>";
					else
					{
						echo "<table id = 'datatable' hidden>";
						echo "	<tr>";
						echo "		<td>FROM</td>";
						echo "		<td>" . $date_fr . "</td>";
						echo "		<td>TO</td>";
						echo "		<td>" . $date_to . "</td>";
						echo "	</tr>";
						echo " 	<tr>";
						echo "		<th>EMPLOYEE NUMBER</th>";
						echo "		<th>LAST NAME</th>";
						echo "		<th>FIRST NAME</th>";
						echo "		<th>MANAGER</th>";
						echo "		<th>DEPARTMENT</th>";
						echo "		<th>BIOMETRICS ID</th>";
						echo "		<th>FALCO ID</th>";
						echo "		<th>DATE(s)</th>";
						
						if(in_array('OT',$request))
						{
							echo "	<th>OT REGULAR DAY</th>";
							echo "	<th>OT REST DAY / HOLIDAY</th>";
							echo "	<th>OT SPECIAL HOLIDAY on REST DAY</th>";
							echo "	<th>OT REGULAR HOLIDAY</th>";
							echo "	<th>OT REGULAR HOLIDAY on REST DAY</th>";
						}//Picked request has OT
						
						
						//Picked request has UT
						if(in_array('UT',$request))
							echo "	<th>UNDERTIME</th>";
							
						if(in_array('VL',$request))
						{
							echo "	<th>VACATION LEAVE</th>";
							echo "	<th>VL BALANCE</th>";
						}//Picked request has VL
						
						if(in_array('SL',$request))
						{
							echo "	<th>SICK LEAVE</th>";
							echo "	<th>SL BALANCE</th>";
						}//Picked request has SL
						
						if(in_array('OB',$request))
						{
							echo "	<th>OB DEPARTURE</th>";
							echo "	<th>OB TIME START</th>";
							echo "	<th>OB TIME END</th>";
							echo "	<th>OB ARRIVAL</th>";
						}
						
						
						if(in_array('OS',$request))
							echo "	<th>OFFSET</th>";
							
						echo "		<th>HOLIDAY</th>";
						echo "		<th>TIME IN</th>";
						echo "		<th>TIME OUT</th>";
						echo "		<th>REMARK(s)</th>";
						echo "	</tr>";
						
						for($i = 0; $i < count($emp_record); $i++)
						{
							for($j = 0; $j < count($emp_record[$i]['D']); $j++)
							{
								if($_GET['type'] == 'allR' || $_GET['type'] == 'recO' && $emp_record[$i]['C'][$j] > 0)
								{	
									echo "<tr>";	
									echo "	<td>" . $emp_record[$i]['EN'] . "</td>";
									echo "	<td>" . $emp_record[$i]['LN'] . "</td>";
									echo "	<td>" . $emp_record[$i]['FN'] . "</td>";
									echo "	<td>" . $emp_record[$i]['RN'] . "</td>";
									echo "	<td>" . $emp_record[$i]['DN'] . "</td>";
									echo "	<td>" . $emp_record[$i]['BI'] . "</td>";
									echo "	<td>" . $emp_record[$i]['FI'] . "</td>";
									echo "	<td>" . $emp_record[$i]['D'][$j] . "</td>";
									
									if(in_array('OT',$request)){
										echo "	<td>" . $emp_record[$i]['OTREG'][$j] . "</td>";
										echo "	<td>" . $emp_record[$i]['OTRSH'][$j] . "</td>";
										echo "	<td>" . $emp_record[$i]['OTSHR'][$j] . "</td>";
										echo "	<td>" . $emp_record[$i]['OTRHD'][$j] . "</td>";
										echo "	<td>" . $emp_record[$i]['OTRHR'][$j] . "</td>";
										}
									
									if(in_array('UT',$request))
										echo "	<td>" . $emp_record[$i]['UT'][$j] . "</td>";
									
									if(in_array('VL',$request)){
										echo "	<td>" . $emp_record[$i]['VL'][$j] . "</td>";
										echo "	<td>" . $emp_record[$i]['VLB'][$j] . "</td>";
									}
									
									if(in_array('SL',$request)){
										echo "	<td>" . $emp_record[$i]['SL'][$j] . "</td>";
										echo "	<td>" . $emp_record[$i]['SLB'][$j] . "</td>";
									}
									
									if(in_array('OB',$request)){
										echo "	<td>" . $emp_record[$i]['OBD'][$j] . "</td>";
										echo "	<td>" . $emp_record[$i]['OBTS'][$j] . "</td>";
										echo "	<td>" . $emp_record[$i]['OBTE'][$j] . "</td>";
										echo "	<td>" . $emp_record[$i]['OBA'][$j] . "</td>";
									}
									
									if(in_array('OS',$request))
										echo "	<td>" . $emp_record[$i]['OS'][$j] . "</td>";
									
									
									echo "	<td>" . $emp_record[$i]['HD'][$j] . "</td>";
									echo "	<td>" . date("H:i",strtotime($emp_record[$i]['TI'][$j])) . "</td>";
									echo "	<td>" . date("H:i",strtotime($emp_record[$i]['TO'][$j])) . "</td>";
									echo "	<td>" . str_replace(PHP_EOL, ' ', $emp_record[$i]['RP'][$j]) . "</td>";
									echo "</tr>";
								}///
							}//for each date
						}//for each employee record
						
						echo "</table>";
						
						$type = "";
						if($_GET['type'] == 'allR')
							$type = 'All';
						else
							$type = 'Existing';
							
						$filename = 'IEMS_' . $type . '_Employees_Record_for_'. $date_fr.'_to_'.$date_to.'.csv';
						
						$_SESSION['emp_record'] = $emp_record;
						$link =  "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						$escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
						
						echo "<h2 style = 'float : right; padding-right : 5%; margin-top : 0%'><a download=" . $filename . " onclick = 'return ExcellentExport.csv(this, \"datatable\");' href = '#' target = '_blank'>Download iEMS Report</a></h2><br/>";	
						echo "<div class = 'cc'>";
						echo "	<span class = 'title'>Data From " . $date_fr . " To " . $date_to . "</span>";
						echo "</div>";
						echo "<div class = 't'>";
						echo "	<table border = 0 width = 100% id='t_color'>";
						echo "	<thead>
									<tr>";
						echo "			<th>Employee Number</th>";
						echo "			<th>Employee Name</th>";
						echo "			<th>Department Name</th>";
						echo "			<th>Job Title</th>";
						echo "			<th>Number of Request(s)</th>";
						echo "			<th></th>";
						echo "		</tr>
								</thead>
								<tbody>";
						
						$l = 0;
						
						if(count($emp_record) % 2 != 0)
							$l++;
							
						for($i = 0; $i < count($emp_record); $i++)
						{
							if($_GET['type'] == 'allR' || $_GET['type'] == 'recO' && array_sum($emp_record[$i]['C']) > 0)
							{
								echo  ($l % 2 == 0)? "<tr style = 'background-color : #d3dfee;'>" : "<tr style = 'background-color : #ffffff;'>";
								echo "	<td><center>" . $emp_record[$i]['EN'] . "</center></td>";
								echo "	<td style = 'padding-left:5%;'>" . $emp_record[$i]['LN'] . ", " . $emp_record[$i]['FN'] . "</td>";
								echo "	<td style = 'padding-left:5%;'>" . $emp_record[$i]['DN'] . "</td>";
								echo "	<td style = 'padding-left:5%;'>" . $emp_record[$i]['JT'] . "</td>";
								echo "	<td><center>" . $emp_record[$i]['R'] . "</center></td>";
								
								if($emp_record[$i]['R'] > 0)
									echo "<td style = 'width : 10%;'><center><a class = 'remarks' target = '_blank' href = 'view_employee_request_report.php?emp_num=".$emp_record[$i]['EN']."'>View Record(s)</a></center></td>";
								else
									echo "<td><center>Nothing to View</center></td>";
								echo "</tr>";
								
								$l++;
							}//if
						}//
						
						echo " 		</tbody>";
						echo " 	</table>";
						echo "</div>";
					}//
	
				?>
			</div>
			<!--FOOTER-->
			<div id="footer">
                <br/>
                <p>Copyright 2011</p>     
            </div>
		</div>
    </body>
</html>