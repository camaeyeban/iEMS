<?php
	session_start();
	
	include('config_DB.php');
	
	$ot_date = $_POST['ot_date'];
	$os_hour = $_POST['os_hour'];
	
	$sql = "SELECT * from ems_offset_new where ot_dates LIKE '%" . $ot_date . "%' and status = 'Pending' and emp_num = '$_SESSION[emp_num]'";
	$get = mysql_query($sql);
	
	$result = 'false';
	
	$sum = 0;
	while($row = mysql_fetch_array($get))
	{
		$ot_d = explode('|',$row[3]);
		$os_h = explode('|',$row[6]);
	
		for($i = 0; $i < count($ot_d); $i++)
		{
			if($ot_date == $ot_d[$i])
			{
				$sum += $os_h[$i];
				//echo 'sum ' . $sum;
			}
		}
	}
	
	$sql = "SELECT * from ems_ot where date_ot = '" . date('Y-m-d',strtotime($ot_date)) . "' and status = 'Pending' and emp_num = '$_SESSION[emp_num]' 	limit 1";
	$get = mysql_query($sql);
	$row = mysql_fetch_array($get);
	
	if($row[6] >= $sum + $os_hour)
		$result = 'true';
		
	echo $result;
?>