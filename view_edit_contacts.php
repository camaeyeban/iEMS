<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);


	include("config_DB.php");
	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();

	if (!$dblink)
		die("no connection");

	include("functions.php");
	chk_active($_SESSION['user_id']);

	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}	


	$strqry = "SELECT emp_num, emp_firstname, emp_middlename, emp_lastname, address1,address2, city, province, zip, home_no, mobile, work_no, email, email2
					FROM ems_employee WHERE emp_num='$_GET[ID]'";
	$query = $dblink->db_qry($strqry);
	$result = $dblink->get_data($query);

		if($_SESSION['emp_num']==$_GET['ID'] || $_SESSION['rights']==1 || $_SESSION['rights']==5) {
			$prop = "";
			$dis = "";	
		}else{
			$prop = "readonly";
			$dis = "disabled";	
		}
		
	if(isset($_POST['submit']) && $_POST['submit']=="save"){
		$add1 = $_POST['add1'];
		$add2 = $_POST['add2'];
		$mobile = $_POST['mobile'];
		$htel = $_POST['htel'];
		$wtel = $_POST['wtel'];
		$city = $_POST['city'];
		$province = $_POST['state'];
		$zip = $_POST['zip'];
		$email = $_POST['email1'];
		$email2 = $_POST['email2'];
		
		$str = "UPDATE ems_employee SET address1='$add1', address2='$add2', city='$city ', province='$province', zip='$zip', home_no='$htel', mobile='$mobile', work_no='$wtel', email='$email', email2='$email2'
					WHERE emp_num='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		$msg = "Contact details successfully saved!";
		
		var_sessions($_SESSION['username'],$_SESSION['rights']);
		
		$strqry = "SELECT emp_num, emp_firstname, emp_middlename, emp_lastname, address1,address2, city, province, zip, home_no, mobile, work_no, email, email2
					FROM ems_employee WHERE emp_num='$_GET[ID]'";
		$query = $dblink->db_qry($strqry);
		$result = $dblink->get_data($query);
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	
<html lang="en">
<head>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link rel="icon" href="../images/iEMS2.png">

		<title>iEMS</title>
		
		<link href="css/profile_form.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
		
		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>
		<script type="text/javascript" src="validator.js"></script>

	</head>

	<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

		<?php 
			include("menu.php");
			include("side_menu.php");
		?>

		<div class="container">
		<div class="row">
			<div class="col s9 offset-s2" id="profile_form">
			<h4>Contact Details</h4>
			<br><br>
			<form name="form_contacts" action="<?php $PHP_SELF;?>" method="POST">
				<div class="row">
					<div class="col s4">
						<label class="right-label">ADDRESS STREET 1 <span class="a">*</span></label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' size ="30" name='add1' value="<?php echo $result[4];?>" <?php echo $prop;?>/>
					</div>

					<div class="col s4">
						<label class="right-label">ADDRESS STREET 2</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='add2' value="<?php echo $result[5];?>" <?php echo $prop;?>/>
					</div>			
				</div>

				<div class="row">
					<div class="col s4">
						<label class="right-label">CITY</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='city' value="<?php echo $result[6];?>" <?php echo $prop;?>/>
					</div>

					<div class="col s4">
						<label class="right-label">STATE/PROVINCE</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='state' value="<?php echo $result[7];?>" <?php echo $prop;?>/>
					</div>

					<div class="col s4">
						<label class="right-label">ZIP/POSTAL CODE</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='zip' value="<?php echo $result[8];?>" <?php echo $prop;?>/>
					</div>
				</div>

				<div class="row">
					<div class="col s4">
						<label class="right-label">MOBILE</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='mobile' value="<?php echo $result[10];?>" <?php echo $prop;?>/>
					</div>

					<div class="col s4">
						<label class="right-label">HOME NUMBER</label>
						<input style="font-size:13px!important;font-weight:bold!important;"  class="right-input" type='text' name='htel' value="<?php echo $result[9];?>" <?php echo $prop;?>/>
					</div>

					<div class="col s4">
						<label class="right-label">WORK NUMBER</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='wtel' value="<?php echo $result[11];?>" <?php echo $prop;?>/>
					</div>
				</div>

				<div class="row">
					<div class="col s4">
						<label class="right-label">WORK EMAIL</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='email1' size="30" value="<?php echo $result[12];?>" <?php echo $prop;?>/>
					</div>

					<div class="col s4">
						<label class="right-label">OTHER EMAIL</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='email2' size="30" value="<?php echo $result[13];?>" <?php echo $prop;?>/>
					</div>
				</div>

				<div class="row form-bottom">
					<div class="col s12">
						<div class="note">
							<span class="note-label">NOTE: </span>
								Fields marked with an asterisk <span class="req">*</span> are required.
						</div>
					</div>
					<br><br>
					<div class="col s12">
						<?php
							if($_SESSION['emp_num']==$_GET['ID'] || $_SESSION['rights']==1 || $_SESSION['rights']==5) {
								echo '<button type="submit" class="waves-effect waves-light btn green" id="save" name="submit" value="save">Save</button>';
							}
						?>
									
					</div>
				</div>
			</form>
		</div> <!--col s9 offset-->
	</div> <!-- container -->
		
	
		
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="assets/js/materialize.min.js"></script>
		<script src="js/docs.min.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script type="text/javascript">
			var frmvalidator  = new Validator("form_contacts");
			frmvalidator.EnableMsgsTogether();
			frmvalidator.addValidation("email1","req", "Please enter your email work email.");
			frmvalidator.addValidation("email1","email", "Please enter a valid email address.");
		</script>
	</body>
</html>
