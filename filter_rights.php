<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("config_DB.php");

function name($val){
	switch($val){
		case 1:
			$rights = "Admin";
		break;		
		
		case 2:
			$rights = "Manager";
		break;		
		
		case 3:
			$rights = "Employee";
		break;		
		
		case 4:
			$rights = "Sales Admin";
		break;
	}
	return $rights;
}

if($_POST['username']){
	$qry = mysql_query("SELECT rights, is_admin FROM ems_users WHERE username='$_POST[username]' ");
	$row = mysql_fetch_array($qry);
	$cnt = mysql_num_rows($qry);
	if($cnt!=0){
		if($row[0]==$row[1]){
			echo '<option value="'.$row[0].'">'.name($row[0]).'</option>';
		}elseif($row[0] && $row[1]==0){
			echo '<option value="'.$row[0].'">'.name($row[0]).'</option>';	
		}else{
			echo '<option value="'.$row[0].'">'.name($row[0]).'</option>';		
			echo '<option value="'.$row[1].'">'.name($row[1]).'</option>';
		}
	}
}
?>