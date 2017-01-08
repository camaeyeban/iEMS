<?php
	$start_fiscal_date = date('Y') . "-04-01";
	$end_fiscal_date = (date('Y')+1) . "-03-31";
	echo "<b>Date From :</b> " . $start_fiscal_date . " <b>To : </b> " . $end_fiscal_date . "<br/><br/>";
		
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
	
	while($row = mysql_fetch_array($get,$con))
	{
		$emp[$i] = array();
		$emp[$i]['leave'] = array();
		$emp[$i]['leave']['vl'] = array();
		$emp[$i]['leave']['sl'] = array();
		
		$emp[$i]['numb'] = ($i + 1);
		$emp[$i]['name'] = $row[0] . ", " . $row[1];
		$emp[$i]['enum'] = $row[2];
		
		$emp[$i]['leave']['vl']['r'] = 7.5;
		$emp[$i]['leave']['vl']['u'] = 0;
		$emp[$i]['leave']['sl']['r'] = 7.5;
		$emp[$i]['leave']['sl']['u'] = 0;
		
		$i++;
	}
	
	echo "<table border = 0>";
	echo "	<tr>";
	echo "		<td rowspan = 3><center><b>#</b></center></td>";
	echo "		<td rowspan = 3><center><b>NAME</b></center></td>";
	echo "		<td rowspan = 3><center><b>EMPLOYEE NUMBER</b></center></td>";
	echo "		<td colspan = 4><center><b>LEAVES</b></center></td>";
	echo "	</tr>";
	echo "	<tr>";
	echo "		<td colspan = 2><center><b>SL</b></center></td>";
	echo "		<td colspan = 2><center><b>VL</b></center></td>";
	echo "	</tr>";
	echo "  <tr>";
	echo "  	<td>Remaining</td>";
	echo "  	<td>Used</td>";
	echo "  	<td>Remaining</td>";
	echo "  	<td>Used</td>";
	echo "  <tr>";
	
	for($i = 0; $i < count($emp); $i++)
	{
		echo "<tr>";
		echo "	<td>".$emp[$i]['numb']."</td>";
		echo "	<td>".$emp[$i]['name']."</td>";
		echo "	<td><center>".$emp[$i]['enum']."</center></td>";
		echo "	<td><center>".$emp[$i]['leave']['sl']['r']."</center></td>";
		echo "	<td><center>".$emp[$i]['leave']['sl']['u']."</center></td>";
		echo "	<td><center>".$emp[$i]['leave']['vl']['r']."</center></td>";
		echo "	<td><center>".$emp[$i]['leave']['vl']['u']."</center></td>";
		echo "</tr>";
	}
	
	echo "</table>";
	mysql_close($con);
	
	function add_quotes($str) {
		return sprintf("'%s'", $str);
	}
?>