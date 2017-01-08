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
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
}

$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$emp_num = $_POST['empid'];

$uname = $_POST['username'];
$pword = $_POST['password'];
$md5_pass = md5($pword);
$confirm = $_POST['confirm'];
$rights = $_POST['rights'];

$selected1 = "";
$selected2 = "";
$selected3 = "";
$selected4 = "";
$selected5 = "";
$chk  = "";
$display = "style='display:none'";
if(isset($_POST['submit'])){
	$chk = "checked";
	$display = "";
	switch($rights){
		case 1:
				$selected1 = "selected";
		break;

		case 2:
				$selected2 = "selected";
		break;

		case 3:
				$selected3 = "selected";
		break;

		case 4:
				$selected4 = "selected";
		break;		
		
		case 5:
				$selected5 = "selected";
		break;		
	}
}
			 
if(isset($_POST['submit']) && $_POST['submit']=="save"){
	$err = validate_empnum($emp_num);
	$err2 = validate_user($uname);
	if($err || $err2){
		$err;
		$err2;
	}
	 else{
		$str = "INSERT INTO ems_employee (emp_num, emp_lastname, emp_firstname, emp_middlename)
			VALUES ('$emp_num', '$lname', '$fname', '$mname')";
		$query = $dblink->db_qry($str);
	 
	$cc = (isset($_POST['checked'])) ? $_POST['checked'] : 0; 
	
		if(isset($_POST['username'], $_POST['password'], $_POST['rights'], $_POST['log']) &&  $_POST['log']=="log"){
			$str = "INSERT INTO ems_users (username, password, emp_num, rights, status, is_admin )
					VALUES ('$uname','$md5_pass','$emp_num', '$rights' , 'Enabled', '$cc')";
			$query = $dblink->db_qry($str);
	  }
	  header("Location:view_edit_job.php?ID=$emp_num");
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>

<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="assets/js/materialize.min.js"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>
<script type="text/javascript" src="validator.js"></script>

<script type="text/javascript">


   function validate(){
            var fname = document.add_emp.fname.value;
            var lname = document.add_emp.lname.value;
            var empid = document.add_emp.empid.value;
			
			var log = document.add_emp.log.checked
			var user = document.add_emp.username.value;
			var pass = document.add_emp.password.value;
			var conf = document.add_emp.confirm.value;
				if(log==true){
					if(user=="" || pass=="" || conf==""){
						alert("Please fill-out required fields!");
						return false;			
					}else if(pass!=conf){
						alert("Password did not match!");
						return false;							
					}

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
		var cc = document.add_emp.chk.checked;
		if(rr==1){
			return false;
		}
	}
</script>


</head>

<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
<form name='add_emp' action="add_emp.php" method="POST" >
<div id="container">
<?php include("menu.php"); ?>


	<div class="container">
		<div class="page-header" style="width:770px!important;">
			<h4><strong class="formTitle"> EIM: Add Employee </strong></h4>
		</div>
	</div>
	<div class="err">
		<?php if($err || $err2){ echo $err.'<br/>'.$err2; } ?>
	</div>
	<div class="row">
	<div class="input-field col s12">
        <div class="input-field col s4" style="margin-left:10%;width:28%;">
		  <div id='s_time'><input style="text-align:right!important;"placeholder="First Name *" id="fname" name="fname" type="search" class="s_time1" value="<?php echo $fname?>" required>
		  <label class="s_time" for="time_start"><i class="fa fa-clock-o"></i>  FULL NAME</label>
        </div></div>
		<div class="input-field col s4" style="margin-left:-1.5%;width:28%;">
          <div id='e_time'><input style="text-align:right!important;"placeholder="Middle Name" id="mname" name="mname" type="search" class="e_time1" value="<?php echo $mname?>">
          <label class="e_time" for="time_end">  </label>
        </div></div>
		<div class="input-field col s4" style="margin-left:-11%;width:28%;">
          <div id='e_time'><input style="text-align:right!important;"placeholder="Last Name *" id="lname" name="lname" type="search" class="e_time1" value="<?php echo $lname?>" required>
          <label class="e_time" for="time_end">  </label>
        </div></div>
      </div>
	</div>
	<div class="row">
	<div class="input-field col s12" style="margin-left:-10.5%;">
		  <div id='s_time'><input style="margin-left:29.5%!important;width:50.1%!important;" placeholder="Enter Employee ID" id="empid" name="empid" type="text" class="s_time1" value="<?php echo $emp_num;?>"/><span id="msgbox1" style="display:none"></span>
		  <label class="s_time" for="time_start"><i class="fa fa-clock-o"></i>  EMPLOYEE ID</label>
        </div>
	</div>
	</div>
	
	<div class="row" style="margin-top:-0.9%;margin-left:1%;">
		<div class="input-field col s4">
			<label style="font-size:90%; margin-left:22%;"><i class="fa fa-briefcase"></i>  CREATE LOGIN DETAILS </label>
		</div>
		<div class="input-field col s4" style="margin-left:-5%;margin-top:-.2%;">
			<input type='checkbox' class='filled-in' name='log' id='log' value='log' <?php echo $chk; ?>/><label for='log' class="radio">  </label>
		</div>
	</div>
	<hr style="width:56%;margin-left:17%;margin-top:2%;">
	<!-- CREATE LOGIN DETAILS -->
	<div class="row">
		<div class="input-field col s12">
				<div class="input-field col s6" style="width:20%;margin-left:8.9%;">
					<span style="margin-top:2.5%;margin-left:102%;" id="msgbox" style="display:none"></span>
					<input style="margin-left:0%!important;width:236%!important;" placeholder="Enter Username" id="username" type="text" class="date1" name="username" value="<?php echo $uname;?>">
					<label style="width:296%!important;"class="date" for="username"><i class="fa fa-calendar-o"></i>  USERNAME *</label>
				</div>
				<div class="input-field col s6" style="margin-left:16%;padding:0%;">
					<select style="margin-left:36%;width:86%;"name="rights" onchange="setAD(this.value);" id="rights" class="form-control">
						<option value="3" <? echo $selected1;?>>Employee</option>
						<option value="2" <? echo $selected2;?>>Manager</option>
						<option value="4" <? echo $selected4;?>>Sales Admin</option>
						<option value="5" <? echo $selected5;?>>Executive</option>
						<option value="1" <? echo $selected3;?>>Admin</option>
					</select>
					<label style="font-size:13px;margin-left:-50%;"class="date" for="first_name"><i class="fa fa-calendar-o"></i>  RIGHTS: *</label>
				</div>
		</div>
	</div>
	
	<div class="row" style="margin-left:7.8%;">
		<div class="input-field col s12">
				<div class="input-field col s6" style="width:40%;">
					<input style="margin-left:0%!important;width:81%!important;" placeholder="Enter Password" id="password" type="password" class="date1" name="password" required/>&nbsp;
					<label class="date" for="password"><i class="fa fa-calendar-o"></i>  PASSWORD *</label>
				</div>
				<div class="input-field col s6" style="width:40%;margin-left:18.6%;padding:0%;">
					<input style="margin-left:-47.8%!important;width:68%!important;" placeholder="Confirm Password" id="confirm" type="password" class="date1" name="confirm" required/>&nbsp;
					<label style="width:86%!important;margin-left:-75%;"class="date" for="confirm"><i class="fa fa-calendar-o"></i>  CONFIRM PASSWORD *</label>
				</div>
			</div>
	</div>
	<div class="row"><input class="filled-in" type="checkbox" name="admin" value="1" onclick="return read();" id="chk"/>
	<label style="margin-top:-0.5%;margin-left:60%!important;font-size:13px;" for="chk">SET AS ADMIN</label></div>
	<hr style="width:58%;margin-left:16%;"> <br><br>
	
	<div class="row" style="margin-left:4.5%;margin-top:-1%;">
			<div class="disclaimer" style="margin-left:12%!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> Fields marked with an asterisk * are required.</div>
				<div class="row" style="margin-top:4%;margin-left:2.5%;">
					<input style = "vertical-align : middle" type="submit" class="btn btn-success" id="save" name="submit" value="save"  onclick="return validate();"/>
					<a href="emp_info.php"><input style="margin-left:1%!important;" value="back" type="button" style = 'vertical-align : middle' class="btn btn-success" /></a>
				</div>
	</div>
	
</div>
</form>
</body>
</html>

<script type="text/javascript">
		var frmvalidator  = new Validator("add_emp");
		frmvalidator.EnableMsgsTogether();
		frmvalidator.addValidation("fname","req","Please enter first name.");
		frmvalidator.addValidation("lname","req","Please enter lastname.");
		frmvalidator.addValidation("empid","req","Please enter employee number.");
</script>
