<?php
ob_start();
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
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
}

$qry = mysql_query("SELECT username, CONCAT(emp_firstname,' ',emp_lastname), rights, status, is_admin FROM ems_users as u
								INNER JOIN ems_employee as e
								ON e.emp_num = u.emp_num
								WHERE user_id='$_GET[ID]' ");
$data = mysql_fetch_array($qry);

$chk = "";
if($data[4]==1){
	$chk = "checked='checked'";
}

$hide = "";
if($_GET['rights']==1){
	$hide = "style='display: none;' ";
}

$user = $_POST['username'];
$pass = md5($_POST['password']);
$emp_num = $_POST['emp'];
$rights = $_POST['rights'];
$status = $_POST['status'];
$admin = $_POST['admin'];

if(isset($_POST['submit']) && $_POST['submit']=="save"){

		$err = validate_user($user,$emp_num);
			if($err){
			
				echo "<script>alert('Invalid Username');</script>";
				header("Refresh:0");
			}else{
				$strqry = "INSERT INTO ems_users (username, password, emp_num, rights, status, is_admin)
				 VALUES('$user','$pass','$emp_num','$rights','$status', '$admin')";
				 $qry = $dblink->db_qry($strqry);
				header("location:view_ems_users.php");			
			}

}elseif(isset($_POST['submit']) && $_POST['submit']=="update"){	
				if($_POST['password']=="" && $_POST['confirm']==""){
						$str = "UPDATE ems_users SET username='$user', rights='$rights', status='$status', is_admin='$admin' WHERE user_id='$_GET[ID]' ";
						$qry = $dblink->db_qry($str);
						header("location:view_ems_users.php");											
				}else{
						 $str = "UPDATE ems_users SET username='$user', password='$pass', rights='$rights', status='$status', is_admin='$admin'
									WHERE user_id='$_GET[ID]' ";
						$qry = $dblink->db_qry($str);
						header("location:view_ems_users.php");									
				}
}


function employees(){
		$qry = mysql_query("SELECT username, CONCAT(emp_firstname,' ',emp_lastname), rights, status FROM ems_users as u
								INNER JOIN ems_employee as e ON e.emp_num = u.emp_num
								WHERE user_id='$_GET[ID]'");
		$data = mysql_fetch_array($qry);				
		if($data[1]){
			echo $data[1];									
		}else{
			$qry1 = mysql_query("SELECT u.emp_num, emp_firstname, emp_lastname, e.emp_num 
												FROM ems_employee AS e
												LEFT JOIN ems_users AS u
												ON e.emp_num=u.emp_num");	
			echo '<select name="emp">';
			echo '<option>--Select--</option>';								
			while($result = mysql_fetch_array($qry1)){
				if($result[0]==null){
					echo '<option value="',$result[3],'">',$result[1] . " " . $result[2],'</option>';
				}						
			}	
			echo '</select>';
		}
}

function rights(){
		$qry = mysql_query("SELECT username, CONCAT(emp_firstname,' ',emp_lastname), rights, status FROM ems_users as u
										INNER JOIN ems_employee as e
										ON e.emp_num = u.emp_num
										WHERE user_id='$_GET[ID]' ");
		$data = mysql_fetch_array($qry);		
	if($data[2]){
		if($data[2]==1){
			echo '<option value="1">',"Admin",'</option>';				
			echo '<option value="2">',"Manager",'</option>';				
			echo '<option value="4">',"Sales Admin",'</option>';	
			echo '<option value="5">',"Executive",'</option>';			
			echo '<option value="3">',"Employee",'</option>';			
		}elseif($data[2]==2){										
			echo '<option value="2">',"Manager",'</option>';		
			echo '<option value="1">',"Admin",'</option>';				
			echo '<option value="4">',"Sales Admin",'</option>';
			echo '<option value="5">',"Executive",'</option>';			
			echo '<option value="3">',"Employee",'</option>';											
		}elseif($data[2]==3){
			echo '<option value="3">',"Employee",'</option>';	
			echo '<option value="1">',"Admin",'</option>';	
			echo '<option value="4">',"Sales Admin",'</option>';	
			echo '<option value="5">',"Executive",'</option>';		
			echo '<option value="2">',"Manager",'</option>';										
		}elseif($data[2]==4){
			echo '<option value="4">',"Sales Admin",'</option>';	
			echo '<option value="5">',"Executive",'</option>';
			echo '<option value="1">',"Admin",'</option>';				
			echo '<option value="2">',"Manager",'</option>';													
			echo '<option value="3">',"Employee",'</option>';
		}elseif($data[2]==5){	
			echo '<option value="5">',"Executive",'</option>';
			echo '<option value="1">',"Admin",'</option>';				
			echo '<option value="2">',"Manager",'</option>';	
			echo '<option value="4">',"Sales Admin",'</option>';			
			echo '<option value="3">',"Employee",'</option>';
		}		
	}else{		
		echo '<option value="3">',"Employee",'</option>';			
		echo '<option value="2">',"Manager",'</option>';
		echo '<option value="4">',"Sales Admin",'</option>';	
		echo '<option value="5">',"Executive",'</option>';	
		echo '<option value="1">',"Admin",'</option>';	
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
<script type="text/javascript" src="jquery.js"></script>
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>

<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="assets/js/materialize.min.js"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />

    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

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
			document.getElementById('ccc').innerHTML = "Back";
			document.getElementById('show').style.display = "table-row";
			document.getElementById('hide').style.display = "none";

		}else if(counter==2){
			counter--;		
			document.getElementById('ccc').innerHTML = "Create new password";
			document.getElementById('show').style.display = "none";
			document.getElementById('hide').style.display = "table-row";		

		}
	}

	function setAD(val){
		if(val=="1"){
			document.getElementById('chk').checked = true;
		}else{
			document.getElementById('chk').checked = false;
		}
	}
	
	function read(){
		var rr = document.getElementById('rights').value;
		var cc = document.add_ems_users.chk.checked;
		if(rr==1){
			return false;
		}
	}
</script>


</head>

<body vlink="blue" alink="blue" link="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
<form name='add_ems_users' action="<?php $PHP_SELF; ?>" method='POST'>
<div id="container">
 <?php include("menu.php"); ?>
 
	<div class="container">
		<div class="page-header">
			<h4><strong class="formTitle"> USERS: iEMS Users </strong></h4>
		</div>
	</div>	
<?php 		
	if($err){
		foreach($err as $msg){
			echo $msg.'<br/>';
		}
	}
?>
<div class="container">
    <div class="row">
		<div class="row">
			<div class="input-field col s12">
				<div class="input-field col s6" style="width:20%;">
					<span style="margin-top:2.5%;margin-left:102%;" id="msgbox" style="display:none"></span>
					<input style="margin-left:2%!important;width:296%!important;" placeholder="Enter Username" id="username" type="text" class="date1" name="username" value="<?php echo $data[0];?>" required/>&nbsp;
					<label style="width:296%!important;"class="date" for="username"><i class="fa fa-calendar-o"></i>  USERNAME *</label>
				</div>
				<div class="input-field col s6" style="margin-left:18%;padding:0%;">
					<select style="margin-left:52%;width:93%;"name="rights" onchange="setAD(this.value);" id="rights" class="form-control"><?php rights();?></select>
					<label style="font-size:13px;margin-left:-50%;"class="date" for="first_name"><i class="fa fa-calendar-o"></i>  RIGHTS: *</label>
				</div>
			</div>
			
			<div class="input-field col s12">
				<div class="input-field col s6" style="width:40%;">
					<input style="margin-left:0.5%!important;width:81%!important;" placeholder="Enter Password" id="password" type="password" class="date1" name="password" required/>&nbsp;
					<label class="date" for="password"><i class="fa fa-calendar-o"></i>  PASSWORD *</label>
				</div>
				<div class="input-field col s6" style="width:40%;margin-left:18%;padding:0%;">
					<input style="margin-left:-45%!important;width:68%!important;" placeholder="Confirm Password" id="confirm" type="password" class="date1" name="confirm" required/>&nbsp;
					<label style="width:86%!important;margin-left:-75%;"class="date" for="confirm"><i class="fa fa-calendar-o"></i>  CONFIRM PASSWORD *</label>
				</div>
			</div>
			
			<div class="input-field col s12">
				<div class="input-field col s6" style="margin-left:10.1%;padding:0%;">
					<select style="margin-left:56%;width:65%;" class="form-control"><?php rights();?></select>
					<label style="font-size:13px;margin-left:-50%;"class="date" for="first_name"><i class="fa fa-calendar-o"></i>  EMPLOYEE *</label>
				</div>
				<div class="input-field col s6" style="margin-left:8%;padding:0%;">
					<select style="margin-left:52%;width:93%;"name="status" class="form-control">
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
					<label style="font-size:13px;margin-left:-50%;"class="date" for="first_name"><i class="fa fa-calendar-o"></i>  STATUS *</label>
				</div><br><br>
				<div class="row">
					<?php echo $hide;?>
					<input type="checkbox" name="admin" value="1" onclick="return read();" id="chk" <?php echo $chk;?>/><label style="margin-top:0.5%;margin-left:-6%!important;font-size:13px;" for="chk">SET AS ADMIN</label>
				</div><hr style="width:700px;margin-left:133px;"> 
			</div>
		</div><div class="disclaimer" style="margin-left:12%!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> Fields marked with an asterisk * are required.</div>
		<div class="row" style="margin-top:6%;margin-left:1%;">
			<?php
				if(isset($_GET['ID'])){
                    echo 	'<input style = "vertical-align : middle" type="submit" class="btn btn-success" id="save" name="submit" value="update"  onclick="return validate2();"/>';	
				}else{
					echo '<input style = "vertical-align : middle" type="submit" class="btn btn-success" id="save" name="submit" value="save"  onclick="return validate();"/>';
				}ob_flush();
			?><input  style="margin-left:1%!important;" value="back" type="button" style = 'vertical-align : middle' class="btn btn-success" onclick="window.location = 'view_ems_users.php';" />
		</div>
	</div>
</div>
	<div id="footer">
<br/><p><center>Copyright 2011</p>     
	</div>
</div>
</form>
</body>
</html>
