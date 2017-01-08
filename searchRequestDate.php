<?php
	session_start();
	
	include('config_DB.php');
	
	$date = $_POST['r_date'];
	$type = $_POST['type'];
	
	$tbln = '';
	$dt_f = '';
	
	switch($type){
		case 'offset' : $tbln = 'ems_offset_new'; $dt_f = 'date_offset'; break;
	}
	
	$sql = "SELECT count(*) from ". $tbln ." where ".$dt_f." = '" . date('Y-m-d',strtotime($date)) . "' and (status Like '%Pending%' OR status in ('Approved','Pending','Used')) and emp_num = '".$_SESSION['emp_num']."'";
	//echo $sql . "\n";
	$get = mysql_query($sql);
	$row = mysql_fetch_array($get);
	
	if($row[0] == 0)
		echo 'true';
	else
		echo 'false';
?>