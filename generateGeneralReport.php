<head>
	<script src="excellentexport.js"></script>
	<style type = 'text/css'>
		td
		{
			white-space : nowrap;
		}
	</style>
</head>
<body style = "font-family : courier new;">
	<?php
		echo '<div id="container">';
        include("menu.php");
        echo '</div>';
		
		$type = $_POST['type'];
		
		$date_fr = $_POST['from'];
		$date_to = $_POST['to'];
		
		$company = $_POST['for'];
		
		echo "<b>Date From </b> " . $date_fr . " <b>To</b> " . $date_to . "<br/>";
		
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
					
					$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . " (OT) - " . $row[1];
				}//getting records on query - overtime
				 
				while($row = mysql_fetch_array($ut,$con))
				{
					$report_record[$i]['ut'][$j] = $row[0];
					
					$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . " (UT) - " . $row[1];
				}////getting records on query - undertime
				
				while($row = mysql_fetch_array($vl,$con))
				{
					$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . " (VL) - " . $row[0];
					
					if($counterVL == 0)
					{
						$report_record[$i]['vl'][$j] = 1 - $row[2];
						$counterVL++;
					}
					else
						$report_record[$i]['vl'][$j] = 1;
				}////getting records on query - vacation leave,
		
				while($row = mysql_fetch_array($sl,$con))
				{
					$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . " (SL) - " . $row[0];
					if($counterSL == 0)
					{
						$report_record[$i]['sl'][$j] = 1 - $row[2];
						$counterSL++;
					}
					else
						$report_record[$i]['sl'][$j] = 1;
				}//getting records on query - sick leave, emergency leave, 
			
				while($row = mysql_fetch_array($ob,$con))
				{
					if($row[1] != $row[2])
					{
						$report_record[$i]['ob'][$j] = 1;
						//echo $report_record[$i]['name'] . " - name / from " . $row[1] . " to " . $row[2] . "<br/>";
					}
					else
					{
						if($row[3] == "--Select--" || $row[4] == "--Select--")
							$report_record[$i]['ob'][$j] = "0000 to 0000";
						else
							$report_record[$i]['ob'][$j] = $row[3] . " to " . $row[4];
						//echo $report_record[$i]['name'] . " - name / from " . $row[1] . " to " . $row[2] . " time from " . $row[3] . " to " , $row[4] . "<br/>";
					}
					
					$report_record[$i]['rm'][$j] = $report_record[$i]['rm'][$j] . " (OB) - " . $row[0];
				}//getting records on query - offical business
				
				
				$ctr = date ("Y-m-d", strtotime("+1 day", strtotime($ctr)));
				$j++;
			}//while counter date is not the end date
		}//for 
		

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
					echo "<tr><td class = 'color' colspan = 11></td></tr>";
			}//looping for
		}//if - Records with output only
		echo '</table></br/><br/>';
		
		mysql_close($con);
		
		$filename = 'IEMS_' . $company . '_Employees_Record_for_'. $date_fr.'_to_'.$date_to.'.xls';
		
		echo "<a download=" . $filename . " href = '#' onclick = 'return ExcellentExport.excel(this, \"datatable\");'>Export to CSV</a><br/>";
	?>
</body>