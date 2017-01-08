<?php
 
include("config_DB.php");

if(isset($_POST['username'])){
	$user = $_POST['username'];
		if($user==""){
			echo "empty";
		}else{
				$query = "SELECT * FROM ems_users WHERE username='$user' ";
				$result = mysql_query($query);
				$data =	mysql_num_rows($result);
				if($data>0){
				echo "yes";
				}else{
				echo "no";
				}	
		}
}

if(isset($_POST['empid'])){
	$id = trim($_POST['empid']);
		if($id=="" || !is_numeric($id)){
			echo "empty";
		}else{
				$query = "SELECT * FROM ems_employee WHERE emp_num='$id' ";
				$result = mysql_query($query);
				$data =	mysql_num_rows($result);
				if($data>0){
				echo "yes";
				}else{
				echo "no";
				}	
		}
}
?>