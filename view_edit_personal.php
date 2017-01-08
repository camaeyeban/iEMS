<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	include("config_DB.php");
	include("functions.php");
	require_once('calendar/classes/tc_calendar.php');
	require("mysql_db_connect.inc.php");

	$dblink = new mysql_db_connect();
	if (!$dblink)
		die("no connection");
	
	chk_active($_SESSION['user_id']);
	chk_invalid_url();
	
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	
	function calendar1($date){
		$myCalendar = new tc_calendar("date1", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(1900, 2020);
		$myCalendar->setAlignment('right', 'bottom');
		if($date!="0000-00-00"){
			$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
		}
		$myCalendar->writeScript();
	}
	
	if($_SESSION['emp_num']==$_GET['ID'] || $_SESSION['rights']==1 || $_SESSION['rights']==5) {
		$prop = "";
		$dis = "";	
	}else{
		$prop = "readonly";
		$dis = "disabled";	
	}
			
	if(isset($_GET['ID'])){
		$strqry = "SELECT emp_num, emp_firstname, emp_middlename, emp_lastname, birthdate, gender, sss, tin, pag_ibig, phil_health 
					FROM ems_employee WHERE emp_num='$_GET[ID]'";
		$query = $dblink->db_qry($strqry);
		$result = $dblink->get_data($query);
	}
	
	if(isset($_POST['submit']) && $_POST['submit']=="save"){
		$emp_num = $_POST['emp_id'];
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$bdate = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
		$gender = $_POST['sex'];
		$sss = $_POST['sss'];
		$tin = $_POST['tin'];
		$pagibig = $_POST['pagibig'];
		$phil = $_POST['phil'];
			 
		$strqry = "UPDATE ems_employee SET emp_firstname='$fname', emp_lastname='$lname', emp_middlename='$mname', 
					birthdate='$bdate', gender='$gender', sss='$sss', tin='$tin', pag_ibig='$pagibig', phil_health='$phil' WHERE emp_num='$_GET[ID]' ";
		$query = $dblink->db_qry($strqry);
	
		$strqry = "SELECT emp_num, emp_firstname, emp_middlename, emp_lastname, birthdate, gender, sss, tin, pag_ibig, phil_health 
					FROM ems_employee WHERE emp_num='$_GET[ID]'";
		$query = $dblink->db_qry($strqry);
		$result = $dblink->get_data($query);
			
		$msg = "Personal details successfully saved!";
			
		var_sessions($_SESSION['username'],$_SESSION['rights']);
			// header("location:view_edit_personal.php?ID=$emp_num");
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
		<link href="assets/css/materialize.min.css" rel="stylesheet">
		
		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
        <script language="javascript" src="calendar/calendar.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript" src="validator.js"></script>
        <script type="text/javascript" src="assets/js/materialize.min.js"></script>
     
		
    </head>
	
	
    <body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

	<?php
		include("menu.php");  
		include("side_menu.php"); 
	?>

	<div class ="container">
	<div class ="row">
		<div class="col s9 offset-s2" id="profile_form">
			<h4>Personal Profile</h4>
			<br><br>
			<form name="form_personal" id="form_personal" action="<?php $PHP_SELF;?>" method="POST">
				<div class="row">
					<div class="col s12">
						<label class="right-label">FULL NAME *</label>
					</div>

					<div class="col s4">
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='search' name='fname' placeholder="First Name *" value="<?php echo $result[1]; ?>" <?php echo $prop;?> />
					</div>
					<div class="col s4">
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='search' name='mname' placeholder="Middle Name" value="<?php echo $result[2]; ?>" <?php echo $prop;?> />
					</div>
					<div class="col s4">
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='search' name='lname' placeholder="Last Name *" value="<?php echo $result[3]; ?>" <?php echo $prop;?> />
					</div>
				</div>

				<div class="row">
					<div class="col s3">
						<label class="right-label">PAGIBIG</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type="text" name="pagibig" value="<?php echo $result[8];?>" />
					</div>

					<div class="col s3">
						<label class="right-label">TIN #</label>
						<input style="font-size:13px!important;font-weight:bold!important;"  class="right-input" type="text" name="tin" value="<?php echo $result[7];?>" />
					</div>
								
					<div class="col s3">
						<label class="right-label">SSS</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type="text" name="sss" value="<?php echo $result[6];?>"/>
					</div>

					<div class="col s3">
						<label class="right-label">PhilHealth</label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type="text" name="phil" value="<?php echo $result[9];?>"/>
					</div>
				</div>

				<div class="row">
					<div class="col s3">
						<?php if($_SESSION['rights']!=1) $read="readonly"; ?>
						<label class="right-label">EMPLOYEE ID<span class="req">*</span></label>
						<input style="font-size:13px!important;font-weight:bold!important;" class="right-input" type='text' name='emp_id' value="<?php echo $result[0]; ?>" <?php echo $read;?> disabled="disabled" />
					</div>
				
					<div class="col s3">
						<label class="right-label">DATE OF BIRTH:</label>
						<br>
						<?php calendar1($result[4]);?>
					</div>
								
					<div class="col s3">
						<label class="label">GENDER<span class="req">*</span></label>
							<?php
								if($result[5]=="male"){
									echo '
										<p>
											<input class="with-gap" type="radio" name="sex" value="male" id="male" checked ',$dis,' />
											<label class="right-input" for="male">Male</label>
											&nbsp &nbsp
											<input class="with-gap" type="radio" name="sex" id="female" value="female" ',$dis,' />
											<label class="right-input" for="female">Female</label>
										</p>';
												
								}elseif($result[5]=="female"){
									echo '
										<p>
											<input class="with-gap" type="radio" name="sex" value="male" id="male" ',$dis,'/>
											<label class="right-input" for="male">Male</label>
											&nbsp &nbsp
											<input class="with-gap" type="radio" name="sex" value="female" id="female" checked ',$dis,' />
											<label class="right-input" for="female">Female</label>
										</p>';								  
								}
							?>
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
		</div> <!--col s9 offset-s3-->
	</div> 
	</div>
		
			
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/docs.min.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script type="text/javascript">
			function DoCustomValidation(){
				var frm = document.forms["form_personal"];
				if(frm.date1.value=="0000-00-00"){
					sfm_show_error_msg('The Password and verified password does not match!',frm.date1);
					return false;
				}else{
					return true;
				}
			}
			
			var frmvalidator  = new Validator("form_personal");
				
			frmvalidator.EnableMsgsTogether();
			frmvalidator.addValidation("fname","req","Please enter your First name.");
			frmvalidator.addValidation("lname","req","Please enter your Last name.");
			frmvalidator.addValidation("emp_id","req","Please enter your employee number.");
			frmvalidator.addValidation("emp_id","num","Please enter a valid employee number.");
			frmvalidator.addValidation("sex","selone_radio","Please select your gender.");	
		</script>
	
    </body>

</html>