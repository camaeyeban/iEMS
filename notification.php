<?php	
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("config_DB.php");
	$date = date("Y-m-d");
	$qry = mysql_query("SELECT COUNT(*) FROM ems_announcement WHERE day>='$date' ");
	$count = mysql_fetch_array($qry);
	if($count[0]>=1){
		echo $cnt = $count[0];
	}
	
?>