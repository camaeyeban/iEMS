<?php
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);
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
            $("ul.tabs").tabs("div.panes > div");			
                $.ajax({
                    type : 'POST',
                    url : 'notification.php',		
                    success: function(data){
						if(data!="")
							$("#nn").addClass('notify').text(data);				
					}				
                });	
            });
        </script>
		
		<style type = 'text/css'>
			td
			{
				white-space : nowrap;
			}
		</style>
	</head>
    <body alink="#1f57a0" vlink="#1f57a0" link="#1f57a0" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    	<div id="container">
            <?php include("menu.php");?>
        </div>
		<div id="container">
			<?php
				$type = $_POST['type'];
		
				$date_fr = $_POST['from'];
				$date_to = $_POST['to'];
				
				$company = $_POST['for'];
				
				echo '<center><h2>' . $company . ' Employees Report</h2>';
				echo '<b>from<b> ' . $date_fr . ' <b>to</b> ' . $date_to . '</center><br/>';
				
				$con = mysql_connect('localhost','root');
				mysql_select_db('ems_test',$con);
				
				$sql = "";
				
				if($company == 'All')
					$sql = "SELECT a.emp_lastname, a.emp_firstname, c.dept_name, a.emp_num from ems_employee a inner join ems_emp_status b, ems_department c where a.code = b.code and a.dept_code = c.dept_code and b.name in ('Probationary','Regular') order by a.emp_lastname, a.emp_firstname";
				elseif($company == 'iRipple')
					$sql = "SELECT a.emp_lastname, a.emp_firstname, c.dept_name, a.emp_num from ems_employee a inner join ems_emp_status b, ems_department c where a.code = b.code and a.dept_code = c.dept_code and b.name in ('Probationary','Regular') and c.dept_name not in ('Synext (Nexus)','ATVI')  order by a.emp_lastname, a.emp_firstname";
				elseif($company == 'Synext (Nexus)')
					$sql = "SELECT a.emp_lastname, a.emp_firstname, c.dept_name, a.emp_num from ems_employee a inner join ems_emp_status b, ems_department c where a.code = b.code and a.dept_code = c.dept_code and b.name in ('Probationary','Regular') and c.dept_name = 'Synext (Nexus)' order by a.emp_lastname, a.emp_firstname";
				else
					$sql = "SELECT a.emp_lastname, a.emp_firstname, c.dept_name, a.emp_num from ems_employee a inner join ems_emp_status b, ems_department c where a.code = b.code and a.dept_code = c.dept_code and b.name in ('Probationary','Regular') and c.dept_name = 'ATVI'  order by a.emp_lastname, a.emp_firstname";
				
				$get = mysql_query($sql,$con);
				
				if(!$get)
					die(mysql_error());
				$i = 0;
				
				while($row = mysql_fetch_array($get,$con))
				{
					$report_record[$i] = array();
					$report_record[$i]['lastname'] = $row[0];
					$report_record[$i]['firstname'] = $row[1];
					$report_record[$i]['department'] = $row[2];
					$report_record[$i]['emp_num'] = $row[3];
					$report_record[$i]['count'] = 0;
					
					if($row[2] == "" || $row[2] == "NULL" || $row[2] == null)
					{
						$report_record[$i]['department'] = "NONE";
					}//if $row[2] has no value
			
					$i++;
				}//while getting records on query
				
				$report_record[$i]['date'] = array();
				$report_record[$i]['holi'] = array();
				$report_record[$i]['ot'] = array();
				$report_record[$i]['ut'] = array();
				$report_record[$i]['vl'] = array();
				$report_record[$i]['sl'] = array();
				$report_record[$i]['ob'] = array();
				$report_record[$i]['rm'] = array();
				
				$j = 0;
				
				for($i = 0; $i < count($report_record); $i++)
				{
					$j = 0;
					
					$ctr = $date_fr;
					$counterVL = 0;
					$counterSL = 0;
					
					while(strtotime($ctr) <= strtotime($date_to))
					{
						$report_record[$i]['date'][$j] = $ctr;
						$report_record[$i]['holi'][$j] = "";
						$report_record[$i]['ot'][$j] = 0;
						$report_record[$i]['ut'][$j] = 0;
						$report_record[$i]['vl'][$j] = 0;
						$report_record[$i]['sl'][$j] = 0;
						$report_record[$i]['ob'][$j] = 0;
						$report_record[$i]['rm'][$j] = '';
						
						$monthDay = date('m',strtotime($ctr)) . "-" . date('d',strtotime($ctr));
						
						//echo $monthDay . "<br/>";
						
						$ot = mysql_query("SELECT no_of_hours, expected_output FROM ems_ot WHERE emp_num = '" . $report_record[$i]['emp_num'] . "' AND status = 'Approved' AND date_ot = '" . $ctr . "'",$con);
						$ut = mysql_query("SELECT time, reason FROM ems_undertime WHERE emp_num = '" . $report_record[$i]['emp_num'] . "' AND status = 'Approved' AND date_un  = '" . $ctr . "'",$con);
						$vl = mysql_query("SELECT reason, no_of_days, time FROM ems_leave WHERE emp_num = '" . $report_record[$i]['emp_num'] . "' AND type in ('Vacation Leave','Maternity/Paternity Leave') AND status = 'Approved' AND '" . $ctr . "' BETWEEN d_from and d_to",$con);
						$sl = mysql_query("SELECT reason, no_of_days, time FROM ems_leave WHERE emp_num = '" . $report_record[$i]['emp_num'] . "' AND type in ('Sick Leave','Emergency Leave') AND status = 'Approved' AND   '" . $ctr . "' BETWEEN d_from and d_to",$con);
						$ob = mysql_query("SELECT purpose, ob_from, ob_to, time_start, time_end FROM ems_ob WHERE emp_num = '" . $report_record[$i]['emp_num'] . "' AND status = 'Approved' AND   '" . $ctr . "' BETWEEN ob_from and ob_to",$con);
						$hd = mysql_query("SELECT h_type, h_date, name FROM ems_holiday WHERE h_date LIKE '%" . $monthDay . "%'",$con);

						if(!$hd)
							die(mysql_error());
						while($row = mysql_fetch_array($hd,$con))
						{
							$holiMonthDay = date('m',strtotime($ctr)) . "-" . date('d',strtotime($row[1]));
							
							if(strpos($row[0],'Regular') !== false && $holiMonthDay == $monthDay)
							{
								$report_record[$i]['holi'][$j] = 'Regular';
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "(REGULAR HOLIDAY) - " . $row[2];
							}//if the date is Regular Holiday
							else
							{
								if(strpos($row[0],'Fixed Special') !== false && $holiMonthDay == $monthDay)
								{
									$report_record[$i]['holi'][$j] = 'Special';
									$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "(SPECIAL HOLIDAY) - " . $row[2];
								}//if the date is Special Holiday
								else if(strpos($row[0],'Movable Special') !== false && $ctr == $row[1])
								{
									$report_record[$i]['holi'][$j] = 'Special';
									$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "(SPECIAL HOLIDAY) - " . $row[2];
								}//if the date is Special Holiday
							}//if the date is Special Holiday
						}//getting records on query
						
						while($row = mysql_fetch_array($ot,$con))
						{
							$report_record[$i]['ot'][$j] = $row[0];
							
							if($report_record[$i]['rm'][$j] == "")
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "(OT) - " . $row[1];
							else
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "<br/>(OT) - " . $row[1];
								
							$report_record[$i]['count']++;
						}//getting records on query - overtime
						 
						while($row = mysql_fetch_array($ut,$con))
						{
							$report_record[$i]['ut'][$j] = $row[0];
							
							if($report_record[$i]['rm'][$j] == "")
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "(UT) - " . $row[1];
							else
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "<br/>(UT) - " . $row[1];
								
							$report_record[$i]['count']++;
						}////getting records on query - undertime
						
						while($row = mysql_fetch_array($vl,$con))
						{
							if($report_record[$i]['rm'][$j] == "")
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "(VL) - " . $row[0];
							else
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "<br/>(VL) - " . $row[0];
						
							if($counterVL == 0)
							{
								$report_record[$i]['vl'][$j] = 1 - $row[2];
								$counterVL++;
							}
							else
								$report_record[$i]['vl'][$j] = 1;
							
							$report_record[$i]['count']++;
						}////getting records on query - vacation leave,
				
						while($row = mysql_fetch_array($sl,$con))
						{
							if($report_record[$i]['rm'][$j] == "")
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "(SL) - " . $row[0];
							else
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "<br/>(SL) - " . $row[0];
						
							if($counterSL == 0)
							{
								$report_record[$i]['sl'][$j] = 1 - $row[2];
								$counterSL++;
							}
							else
								$report_record[$i]['sl'][$j] = 1;
							
							$report_record[$i]['count']++;
						}//getting records on query - sick leave, emergency leave, 
					
						while($row = mysql_fetch_array($ob,$con))
						{
							if($row[1] != $row[2])
							{
								$report_record[$i]['ob'][$j] = 1;
							}
							else
							{
								if($row[3] == "--Select--" || $row[4] == "--Select--")
									$report_record[$i]['ob'][$j] = "0000 to 0000";
								else
									$report_record[$i]['ob'][$j] = $row[3] . " to " . $row[4];
								//echo $report_record[$i]['name'] . " - name / from " . $row[1] . " to " . $row[2] . " time from " . $row[3] . " to " , $row[4] . "<br/>";
							}
							
							if($report_record[$i]['rm'][$j] == "")	 
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "(OB) - " . $row[0];
							else
								$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . "<br/>(OB) - " . $row[0];
							
							$report_record[$i]['count']++;
						}//getting records on query - offical business
						
						
						$ctr = date ("Y-m-d", strtotime("+1 day", strtotime($ctr)));
						$j++;
					}//while counter date is not the end date
				}//for 
				

				//echo "<table id = 'datatable' border = 0 style = 'display: none;'>";
				echo "<table id = 'datatable' border = 1>";
				echo "<th>Employee Number</th>";
				echo "<th>Last Name</th>";	 
				echo "<th>First Name</th>";
				echo "<th>Department</th>";
				echo "<!--<th>Status</th>-->";
				echo "<th>Date</th>";
				echo "<th>Number of Hours on Overtime</th>";
				echo "<th>Departure of Undertime</th>";
				echo "<th>Vacation Leave</th>";
				echo "<th>Sick Leave</th>";
				echo "<th>Time of Official Business</th>";
				echo "<th>Reason/s</th>";
				
				if($type == 'allR')
				{
					for($i = 0; $i < count($report_record) - 1; $i++)
					{
						for($k = 0; $k < $j; $k++)
						{
							echo "<tr>";
							echo "	<td>" . $report_record[$i]['emp_num']   . "</td>";
							echo "	<td>" . $report_record[$i]['lastname']   . "</td>";
							echo "	<td>" . $report_record[$i]['firstname']  . "</td>";
							echo "	<td>" . $report_record[$i]['department'] . "</td>";
							echo "	<td>" . $report_record[$i]['date'][$k] . "</td>";
							echo "	<td style = 'text-align : center'>" . $report_record[$i]['ot'][$k] . "</td>";
							echo "	<td style = 'text-align : center'>" . $report_record[$i]['ut'][$k] . "</td>";
							echo "	<td style = 'text-align : center'>" . $report_record[$i]['vl'][$k] . "</td>";
							echo "	<td style = 'text-align : center'>" . $report_record[$i]['sl'][$k] . "</td>";
							echo "	<td style = 'text-align : center'>" . $report_record[$i]['ob'][$k] . "</td>";
							echo "	<td>" . $report_record[$i]['rm'][$k] . "</td>";
						}//printing the records for all employees
						echo "</tr>";
						echo "<tr><td class = 'color' colspan = 11></td></tr>";
					}//looping for
				}//if - All Records
				else
				{
					for($i = 0; $i < count($report_record) - 1; $i++)
					{	
						$ctr = 0;
						for($k = 0; $k < $j; $k++)
						{
							if($report_record[$i]['ot'][$k] != 0 || $report_record[$i]['ut'][$k] != 0 || $report_record[$i]['sl'][$k] != 0 || $report_record[$i]['vl'][$k] != 0 || $report_record[$i]['ob'][$k] != 0)
							{
								echo "<tr>";
								echo "	<td>" . $report_record[$i]['emp_num']   . "</td>";
								echo "	<td>" . $report_record[$i]['lastname']   . "</td>";
								echo "	<td>" . $report_record[$i]['firstname']  . "</td>";
								echo "	<td>" . $report_record[$i]['department'] . "</td>";
								echo "	<td>" . $report_record[$i]['date'][$k] . "</td>";
								echo "	<td style = 'text-align : center'>" . $report_record[$i]['ot'][$k] . "</td>";
								echo "	<td style = 'text-align : center'>" . $report_record[$i]['ut'][$k] . "</td>";
								echo "	<td style = 'text-align : center'>" . $report_record[$i]['vl'][$k] . "</td>";
								echo "	<td style = 'text-align : center'>" . $report_record[$i]['sl'][$k] . "</td>";
								echo "	<td style = 'text-align : center'>" . $report_record[$i]['ob'][$k] . "</td>";
								echo "	<td>" . $report_record[$i]['rm'][$k] . "</td>";
								
								$ctr = 1;
							}//if ob or ut or ot or vl or sl has at least 1 record per date
						}//printing the records for all employees
						echo "</tr>";
						if($ctr == 1)
							echo "<tr height = 10px><td</td></tr>";
					}//looping for
				}//if - Records with output only
				echo '</table></br/><br/>';
				
				mysql_close($con);
				
			?>
		</div>
    </body>
</html>