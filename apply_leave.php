<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("functions.php");
include('ps_pagination.php');
include("config_DB.php");

chk_active($_SESSION['user_id']);

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

if($_SESSION['rights']!=1 && $_SESSION['rights']!=4){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
}

if(isset($_POST['submit']) && $_POST['submit']=="leave"){
	$from = $_POST['from'];
	$to = $_POST['to'];
	$days = $_POST['days'];
	$reason = $_POST['reason'];
	$type = $_POST['leave'];	
	$emp_num = $_POST['employee'];
	
	$val = 0;
	
	if($type=="Vacation Leave"){
		$val = 1;
	}elseif($type=="Sick Leave" || $type=="Emergency Leave"){
		$val = 2;
	}
	$qry_num = mysql_query("SELECT leave_id FROM ems_leave ORDER BY leave_id DESC");
	$count = mysql_num_rows($qry_num);
		if($count==0){
			$ID = "lve-0001";
		}else{
			$qry_id = mysql_result($qry_num, 0);
			$ID = auto_num($qry_id);
		}
	
	$sql = "INSERT INTO ems_leave (leave_id,emp_num, date_Filed, d_from, d_to, no_of_days, type, reason, status, value)
							VALUES ('$ID','$emp_num','".date('Y-m-d')."','$from','$to','$days', '$type','$reason','Pending', '$val')";
	
	mysql_query($sql);
	$sql = "SELECT CONCAT(emp_firstname,' ',emp_lastname), dept_code from ems_employee where emp_num = '$emp_num'";
	$get = mysql_query($sql);
	$row = mysql_fetch_array($get);
	send_email_pending("leave application", $row[0], $row[1], "http://iripple.net:82/ems/view_leave_undr.php");
	header('location:leave_application.php');
}
$sql = "SELECT emp_num, CONCAT(emp_lastname, ', ', emp_firstname) from ems_employee where code not in ('EST004','EST005') order by 2";
$get = mysql_query($sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>iEMS</title>
<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="assets/js/materialize.min.js"></script>

    <link href="css/home-format.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />

    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
 
	<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
    <link rel='stylesheet' href='cssall.css' type='text/css' />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="navigation.js"></script>
    <script type="text/javascript" src="jsFunctions.js"></script>
    <script type="text/javascript" src="validator.js"></script>	<script>
		$(function() {
			$( "#from" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1,
				onClose: function( selectedDate ) {
					$( "#to" ).datepicker( "option", "minDate", selectedDate );
					calculate();
				}
				
			});
			$( "#to" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1,
				onClose: function( selectedDate ) {
					$( "#from" ).datepicker( "option", "maxDate", selectedDate );
					calculate();
				}
			});
			$( "#undertime" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1
			});
		});
		</script>
		<script type="text/javascript">
			function open_win(ID, action){
			var left = parseInt((screen.availWidth/2) - (650/2));
			var top = parseInt((screen.availHeight/2) - (320/2));
			window.open("accomplishment.php?ID="+ID+"&action="+action,"_blank","toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=650, height=320");
			}

			function calculate(){
				var from = document.getElementsByName("from")[0].value;
				var to = document.getElementsByName("to")[0].value;
				
				var count_days = 0;
				
				
				for (var d = new Date(from); d <= new Date(to); d.setDate(d.getDate() + 1))
				{
					if(d.getDay() != 0 && d.getDay() != 6)
						count_days++;
				}
				
				
				if(!isNaN(val)){
					if(document.getElementsByName("half")[0].checked == true)
						document.getElementsByName("days")[0].value = count_days - 0.5;	
					else
						document.getElementsByName("days")[0].value = count_days;
						
					document.getElementsByName("days")[0].focus();
				}
				
				return true;
			}
			function doClick(e){
				
				var days = parseFloat(document.getElementsByName("days")[0].value);
				if(document.getElementsByName("half")[0].checked)
				{
					if(confirm("Are you sure you want to apply for half day?")==false){
						e.target.checked = e.target.defaultChecked;
						e.preventDefault();
						e.stopPropagation();
						return false;
					}
					
					document.getElementsByName("days")[0].value = days - 0.5;
					return true;
				}
				else
					document.getElementsByName("days")[0].value = days + 0.5; 
			}
			function validate1(){
				var x = confirm("Are you sure you want to apply this leave?");
				if(x){
					return true;
				}
				return false;
			}
		</script>
		
	</head>
	<body vlink="green" alink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

	<?php include("menu.php"); ?>

	<form name="form_leave" action="<?PHP $PHP_SELF ?>" method="POST">
		<div id="container">
			
			<div class="container">
				<div class="page-header" style="width:904px!important;">
					<h4><strong class="formTitle"> Approved Leave Application </strong></h4>
				</div>
			</div>
			<div class="row"><br>
				<div class="input-field col s14">
					<input style="width:0%!important;" placeholder="Select Start Date" id="from" type="text" class="from1" required>
					<label class="from" for="from"><i class="fa fa-calendar"></i>  EMPLOYEE</label>
					<select style="margin-left:59%;margin-top:-9%;width:64%;" name = 'employee' class="form-control">
						<?php
							while($row = mysql_fetch_array($get)){
								echo "<option value = '" . $row[0] . "'>" . $row[0] . " - " . $row[1] . "</option>"; 
							}
						?>
					</select>
				</div>
			</div>
			<div class="row" style="margin-top:3%;">
				<div class="input-field col s14">
					<input placeholder="Select Start Date" id="from" name="from" type="text" class="from1" value = "<?php if($result[1] != '') echo $result[1];?>" required>
					<label class="from" for="from"><i class="fa fa-calendar"></i>  INCLUSIVE START DATE</label>
				</div>
				<div class="input-field col s15">
							  <input type="text" style="display:none" name="lv_id" id="lv_id" value= "<?php echo $result[7] ?>"/>	
							  <input placeholder="Select End Date" id="to" name="to" type="text" class="to1" value = "<?php if($result[2] != '') echo $result[2];?>" required>
							  <label class="to" for="to"><i class="fa fa-calendar"></i>  INCLUSIVE END DATE</label>
							</div>
							<div class="input-field col s16">
								  <input placeholder="Enter Number of Items" id="days" name="days" type="text" class="days1" value="<?php echo ($result[3] != '')? $result[3] : 1; ?>" onfocus="return set_date();" id="days" readonly="readonly" required>
								  <label class="days" for="days"><i class="fa fa-list-ol"></i>  NUMBER OF DAYS</label>
							</div>
							<div class="input-field col s17">
								<input type="checkbox" class="filled-in" id="filled-in-box4" name="half" value=".5 AM" onclick="doClick(event);" <?php echo $chk1;?>/><label for="filled-in-box4" class="checkbox"> HALF DAY</label>
							</div>
						</div>
						<div class="row">
						<label style="font-size:13px; margin-left:224px;"><i class="fa fa-sign-out fa-1x"></i>  LEAVE TYPE:</label>
							<?php 
                                    if($result[4]){
                                        switch($result[4]){
                                            case "Sick Leave":
                                                echo '<input type="radio" name="leave" class="with-gap" checked="checked" value="Sick Leave" id="sick"/><label for="sick" class="radio">SICK LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Vacation Leave" id="vacation"/><label for="vacation" class="radio">VACATION LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Emergency Leave" id="emergency"/><label for="emergency" class="radio">EMERGENCY LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Maternity/Paternity Leave" id="maternity"/><label for="maternity" class="radio">MATERNITY/PATERNITY LEAVE</label>';
                                            break;	
                                            case "Vacation Leave":
                                                echo '<input type="radio" name="leave" class="with-gap" value="Sick Leave" id="sick"/><label for="sick" class="radio">SICK LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" checked="checked" value="Vacation Leave" id="vacation"/><label for="vacation" class="radio">VACATION LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Emergency Leave" id="emergency"/><label for="emergency" class="radio">EMERGENCY LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Maternity/Paternity Leave" id="maternity"/><label for="maternity" class="radio">MATERNITY/PATERNITY LEAVE</label>';
                                            break;
                                            case "Emergency Leave":
                                                echo '<input type="radio" name="leave" class="with-gap" value="Sick Leave" id="sick"/><label for="sick" class="radio">SICK LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Vacation Leave" id="vacation"/><label for="vacation" class="radio">VACATION LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" checked="checked" value="Emergency Leave" id="emergency"/><label for="emergency" class="radio">EMERGENCY LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Maternity/Paternity Leave" id="maternity"/><label for="maternity" class="radio">MATERNITY/PATERNITY LEAVE</label>';
                                            break;
                                            case "maternity/paternity  leave":
                                                echo '<input type="radio" name="leave" class="with-gap" value="Sick Leave" id="sick"/><label for="sick" class="radio">SICK LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Vacation Leave" id="vacation"/><label for="vacation" class="radio">VACATION LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Emergency Leave" id="emergency"/><label for="emergency" class="radio">EMERGENCY LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" checked="checked" value="Maternity/Paternity Leave" id="maternity"/><label for="maternity" class="radio">MATERNITY/PATERNITY LEAVE</label>';
                                            break;
                                        }
                                    }
                                    else {
                                                echo '<input type="radio" name="leave" class="with-gap" value="Sick Leave" id="sick"/><label for="sick" class="radio">SICK LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Vacation Leave" id="vacation"/><label for="vacation" class="radio">VACATION LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Emergency Leave" id="emergency"/><label for="emergency" class="radio">EMERGENCY LEAVE</label>';
                                                echo '<input type="radio" name="leave" class="with-gap" value="Maternity/Paternity Leave" id="maternity"/><label for="maternity" class="radio">MATERNITY/PATERNITY LEAVE</label>';
                                    }										
                                ?>
						</div><br>
						<div class="row">
						<div class="input-field col s12">
						  <textarea style="margin-left:216px !important;width:790px !important;" placeholder="State Reason of Overtime" id="reason" class="materialize-textarea" name="reason" required/><?php echo $result[5];?></textarea>
						  <label style="margin-left:86px !important;" class="reason" for="reason"><i class="fa fa-pencil"></i>  REASON</label>
						</div>
						</div><br>
						<div class="row">
							<div class="disclaimer" style="margin-left:223px!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong>All fields are required.</div>
						</div>
					<br><br><br><br><br><br><br><br>
					<?php
                        if($_GET['action']=="leave_edit"){
                            echo '<input style="margin-left:205px!important;margin-top:-150px!important;" type="submit" class="btn btn-success" id="save" name="submit" value="APPLY"  onclick="return validate1();"/>';	
                        }else{
                            echo '<input style="margin-left:205px!important;margin-top:-150px!important;" type="submit" class="btn btn-success" id="save" name="submit" value="APPLY"  onclick="return validate1();"/>';
                        }
                    ?>   
	</form> 					
</div>
		<?php include("footer.php"); ?>
</body>
</html>
