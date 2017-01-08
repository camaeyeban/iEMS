<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("config_DB.php");
include("functions.php");
require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

if (!$dblink)
	die("no connection");

chk_active($_SESSION['user_id']);

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

if($_SESSION['rights']!=1){
	header("location: inbox.php");
}

$qry = mysql_query("SELECT username, CONCAT(emp_firstname,' ',emp_lastname), rights, status, e.emp_num FROM ems_users as u
										LEFT JOIN ems_employee as e
										ON e.emp_num = u.emp_num
										WHERE user_id='$_GET[ID]' ");
$data = mysql_fetch_array($qry);

$user = $_POST['username'];
$pass = md5($_POST['password']);
$emp_num = $_POST['emp'];
$status = $_POST['status'];

if(isset($_POST['submit']) && $_POST['submit']=="save"){
		$err = validate_user($user);
			if($err){
				$err;
			}else{
				 $strqry = "INSERT INTO ems_users (username, password, emp_num, rights, status, deleted)
				 VALUES('$user','$pass','$emp_num','1','$status', 'no')";
				 $qry = $dblink->db_qry($strqry);
				header("location:view_admin_users.php");
			}
}elseif(isset($_POST['submit']) && $_POST['submit']=="update"){
		if($_POST['password']=="" && $_POST['confirm']==""){
				$str = "UPDATE ems_users SET username='$user', status='$status' WHERE user_id='$_GET[ID]' ";
				$qry = $dblink->db_qry($str);
				header("location:view_admin_users.php");
		}else{
				 $str = "UPDATE ems_users SET username='$user', password='$pass', rights='1', status='$status'
							WHERE user_id='$_GET[ID]' ";
				$qry = $dblink->db_qry($str);
				header("location:view_admin_users.php");		
		}
}

$style = (isset($_GET['ID'])) ? "85%": "100%";

function employees(){
	$qry = mysql_query("SELECT username, CONCAT(emp_firstname,' ',emp_lastname), rights, status, e.emp_num FROM ems_users as u
											LEFT JOIN ems_employee as e
											ON e.emp_num = u.emp_num
											WHERE user_id='$_GET[ID]' ");
	$data = mysql_fetch_array($qry);
	
		if($data[0]){
			echo $data[1];
		}else{
			$qry = mysql_query("SELECT emp_num, CONCAT(emp_firstname,' ',emp_lastname), emp_num 
												FROM ems_employee");		
				echo '<select name="emp">';
				echo '<option>--Select--</option>';								
				while($result = mysql_fetch_array($qry)){
					echo '<option value="',$result[0],'">',$result[1],'</option>';
				}	
				echo '</select>';	
		}
}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>

<script type="text/javascript">

	var counter = 1;
	function validate(){
	
		var user = document.add_ems_users.username.value;
		var pass = document.add_ems_users.password.value;
		var conf = document.add_ems_users.confirm.value;
		var emp = document.add_ems_users.emp.value;
			
			if(user=="" || pass=="" || conf==""){
				alert("Please fill-out required fields!");
				return false;
			}
			if(pass!=conf){
				alert("Password did not match!");
				return false;			
			}			
			if(emp=="--Select--"){
				alert("Employee must be defined!");
				return false;
			}
		return true;
	}
	
		function validate2(){
	
		var user = document.add_ems_users.username.value;
		var pass = document.add_ems_users.password.value;
		var conf = document.add_ems_users.confirm.value;
			
		if(counter==2){
			if(user=="" || pass=="" || conf==""){
				alert("Please fill-out required fields!");
				return false;
			}
		}
			if(pass!=conf){
				alert("Password did not match!");
				return false;			
			}			
	}
	

	function create(){
		if(counter==1){
			counter++;
			document.getElementById('ccc').innerHTML = "Hide";
			document.getElementById('show').style.display = "table-row";
			document.getElementById('hide').style.display = "none";

		}else if(counter==2){
			counter--;		
			document.getElementById('ccc').innerHTML = "Create new password";
			document.getElementById('show').style.display = "none";
			document.getElementById('hide').style.display = "table-row";		

	}
}	
</script>


</head>

<body vlink="blue" alink="blue" link="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
<form name='add_ems_users' action="<?php $PHP_SELF; ?>" method='POST'>
<div id="container">
 <?php include("menu.php"); ?>
            <div id="cc" style="width:57%">
 <div><span class="title">Users: Admin Users</span></div>    
			<table border='0' width="<?php echo $style;?>" class="t">
					   <tr><td colspan="4" class="err">
					<?php echo $err;?>
					   </td></tr>
					   <tr>
						   <td width="20.9%">Username: <span class="a">*</span></td>
							<td width="20.9%"><input type="text" name="username" id="username" value="<?php echo $data[0];?>"/><span id="msgbox" style="display:none"></span></td>
					   </tr>
					   <?php 
							if(isset($_GET['ID'])){
								echo '<tr id="show" style="display: none;">';
								$create = "Create new password";
							}else{
								echo '<tr id="hide">';
							}
					   ?>
					   
						   <td>Password: <span class="a">*</span></td>
						   <td><input type="password" name="password"/></td>
						   <td width="30%"  style="padding-left:30px;">Confirm Password: <span class="a">*</span></td>
						   <td><input type="password" name="confirm"/></td>						   
					   </tr>					   
					   <tr>
							<td>Employee: <span class="a">*</span></td>
							<td><?php employees(); ?></td>									
							<td width="22%" style="padding-left:30px;">Status: <span class="a">*</span></td>  		
							<td>
								<select name="status">
								<?php
									if($data[3]){
										if($data[3]=="Enabled"){
											echo '<option>Enabled</option>';
											echo '<option>Disabled</option>';
										}elseif($data[3]=="Disabled"){
											echo '<option>Disabled</option>';												
											echo '<option>Enabled</option>';
										}
									}else{
											echo '<option>Enabled</option>';
											echo '<option>Disabled</option>';										
										}
								?>
								</select>
							</td>
					   </tr>
					   
					   <tr><td colspan="2"><a href="#"  id="ccc" onclick="return create();"><?php echo $create;?></a></td></tr>
						<tr><td colspan='4'><hr/></td></tr>
                        <tr>
							<td width="25%">
						<?php
							if(isset($_GET['ID'])){
                              echo 	'<input type="submit" class="update" id="save" name="submit" value="update"  onclick="return validate2();"/>';	
							}else{
								echo '<input type="submit" class="save" id="save" name="submit" value="save"  onclick="return validate();"/>';
							}
						?>
							<input type="button" class="back" onclick="javacript:window.open('view_admin_users.php', '_SELF');" />
							</td>
							<td colspan="4" align="right">Fields marked with an asterisk <span class="a">*</span> are required.</td>	   						  
                          </tr>
                 </table>
            </div>
      </div>
      </div>
	<div id="footer">
<br/><p>Copyright 2011</p>     
	</div>
</div>
</form>
</body>
</html>
