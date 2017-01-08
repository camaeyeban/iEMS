<?php
	$date_fr = $_POST['from'];
	$date_to = $_POST['to'];
	
	echo "<b>Date From </b> " . $date_fr . " <b>To</b> " . $date_to . "<br/>";
		
	mysql_connect('localhost','root');
	mysql_select_db('ems_test');
	
	$date = date('Y-m-d');
	
	$emp = array();
	
	$con = mysql_connect('localhost','root');
	
	$sql  = "SELECT * FROM ems_emp_status where name in ('Probationary','Regular')";
	$get  = mysql_query($sql,$con);
	
	$code = array();
	
	$j = 0;
	
	while($row = mysql_fetch_array($get,$con))
	{
		$code[$row[0]] = $row[1];
	}
	
	$sql = "SELECT * FROM ems_department";
	$get = mysql_query($sql,$con);
	
	while($row = mysql_fetch_array($get,$con))
	{
		$department[$row[0]] = $row[1];
	}
	
	$sql = "SELECT emp_lastname, emp_firstname, emp_num FROM ems_employee where code IN (" . implode(',',array_map('add_quotes', array_keys($code))) .") order by emp_lastname, emp_firstname";
	$get = mysql_query($sql,$con);
	
	$i = 0;
	
	$num_em = array();
	
	while($row = mysql_fetch_array($get,$con))
	{
		$emp[$i] = array();
		$emp[$i]['numb'] = ($i + 1);
		$emp[$i]['name'] = $row[0] . ", " . $row[1];
		$emp[$i]['leave'] = array();
		$emp[$i]['leave']['vl'] = 0;
		$emp[$i]['leave']['sl'] = 0;
		
		$num_em[$i] = $row[2];
		
		$i++;
	}

	for($i = 0; $i < count($num_em) ; $i++)
	{
		$sql = "SELECT value, time	 from ems_leave where type = 'Vacation Leave'  and status = 'Approved' and d_from >= '" . date('Y') . "-01-01' AND emp_num = '" . $num_em[$i] . "'";
		$get = mysql_query($sql,$con);
		
		$total = 0;
		
		while($row = mysql_fetch_array($get,$con))
		{
			$total = $total + ($row[0] - $row[1]);
		}
		
		
		$emp[$i]['leave']['vl'] = $total;
	
		//----------------------------------------------------------------
		
		$sql = "SELECT value, time from ems_leave where type in ('Sick Leave','Emergency Leave') and status = 'Approved' and d_from >= '" . date('Y') . "-01-01' AND emp_num = '" . $num_em[$i] . "'";
		$get = mysql_query($sql,$con);
		
		$total = 0;
		
		while($row = mysql_fetch_array($get,$con))
		{
			$total = $total + ($row[0] - $row[1]);
		}
		
		$emp[$i]['leave']['sl'] = $total;
		
	}
	
	echo "<table border = 2>";
	echo "	<tr>";
	echo "		<td rowspan = 2><center><b>#</b></center></td>";
	echo "		<td rowspan = 2><center><b>NAME</b></center></td>";
	echo "		<td rowspan = 2><center><b>EMPLOYEE NUMBER</b></center></td>";
	echo "		<td colspan = 2><center><b>TOTAL LEAVES</b></center></td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td><b>Sick Leave</b></td>";
	echo "		<td><b>Vacation Leave</b></td>";
	echo "	</tr>";
	
	for($i = 0; $i < count($emp); $i++)
	{
		echo "<tr>";
		echo "	<td>".$emp[$i]['numb']."</td>";
		echo "	<td>".$emp[$i]['name']."</td>";
		echo "	<td>".$num_em[$i]."</td>";
		echo "	<td><center>".$emp[$i]['leave']['sl']."</center></td>";
		echo "	<td><center>".$emp[$i]['leave']['vl']."</center></td>";
		echo "</tr>";
	}
	
	echo "</table>";
	mysql_close($con);
	
	function add_quotes($str) {
		return sprintf("'%s'", $str);
	}
?>