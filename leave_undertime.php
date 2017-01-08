<?php
ob_start();
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
	
	if($_SESSION['rights'] == 1 &&  !isset($_GET['emp_num']))
	{
		echo "<h2>Invalid URL</h2>";
		die();
	}
	
	//TL-2012/03/29 - Added query for cutoff.
	//--------->
	$cmd = "SELECT value FROM ems_settings
				WHERE settingName='leaveCutOffStart' ";
	$qry = $dblink->db_qry($cmd);
	$cutoff_startDate = $dblink->get_data($qry);
	
	$cmd = "SELECT value FROM ems_settings
				WHERE settingName='leaveCutOffEnd' ";
	$qry = $dblink->db_qry($cmd);
	$cutoff_endDate = $dblink->get_data($qry);
	//<--------- /TL-2012/03/29 - end
	
	$qry_num = mysql_query("SELECT leave_id FROM ems_leave ORDER BY leave_id DESC");
	$count = mysql_num_rows($qry_num);
		if($count==0){
			$ID = "lve-0001";
		}else{
			$qry_id = mysql_result($qry_num, 0);
			$ID = auto_num($qry_id);
		}
		
	$qry_num2 = mysql_query("SELECT un_id FROM ems_undertime ORDER BY un_id DESC");
	$count2 = mysql_num_rows($qry_num2);
		if($count2==0){
			$ID2 = "und-0001";
		}else{
			$qry_id2 = mysql_result($qry_num2, 0);
			$ID2 = auto_num($qry_id2);
		}
	$chk1 = "";
	
	if($_GET['action']=="leave_edit"){
		$str = "SELECT date_Filed, d_from, d_to, no_of_days, type, reason, status, leave_id FROM ems_leave
					WHERE leave_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		$result = $dblink->get_data($qry);
	
		if($result[3] != floor($result[3])){
			$chk1 = "checked";
		}
	}elseif($_GET['action']=="undr_edit"){
		$str = "SELECT date_Filed, date_un, nature_un, time, reason, status, un_id FROM ems_undertime
					WHERE un_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		$result = $dblink->get_data($qry);
	}
	
	$date_u = isset($_REQUEST["undertime"]) ? $_REQUEST["undertime"] : "";
	$today = date("Y-m-d");
	$msg = array();
	
			$from = isset($_REQUEST["from"]) ? $_REQUEST["from"] : "";
			$to = isset($_REQUEST["to"]) ? $_REQUEST["to"] : "";
			
		
	if(isset($_POST['submit']) && $_POST['submit']=="leave"){
	
			$days = $_POST['days'];
			$reason = $_POST['reason'];
			$type = $_POST['leave'];		
			
			if(isdate($from) && isdate($to))
			{
				if($type=="Maternity/Paternity Leave"){
					$val = 0;
				}elseif($type=="Vacation Leave"){
					$val = 1;
				}elseif($type=="Sick Leave" || $type=="Emergency Leave"){
					$val = 2;
				}
				$str = "INSERT INTO ems_leave (leave_id, emp_num, date_Filed, d_from, d_to, no_of_days, type, reason, status, value)
							VALUES ('$ID', '$_SESSION[emp_num]','$today','$from','$to','$days', '$type','$reason','Pending', '$val')";
				
				$qry = $dblink->db_qry($str);
				send_email_pending("leave application", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_leave_undr.php"); 
				//param(type application, emp, dept) 
				//header("location:leave_undr_summary.php");
				echo '<script>window.location = \'leave_undr_summary.php\';</script>';
			}
			else
			{
				echo "<script>alert('Invalid date value either FROM date or TO date');</script>";
				header("Refresh:0");
			}
			
	}elseif(isset($_POST['submit']) && $_POST['submit']=="under"){
	
			$nature = $_POST['nature'];
			$dep  = $_POST['departure'];
			$reason = $_POST['reason2'];
			
			if(isdate($date_u))
			{
				$str = "INSERT INTO ems_undertime (un_id, emp_num, date_Filed, date_un, nature_un, time, reason, status)
							VALUES ('$ID2', '$_SESSION[emp_num]','$today', '$date_u', '$nature','$dep','$reason','Pending')";
				$qry = $dblink->db_qry($str);
				send_email_pending("undertime application", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_leave_undr.php"); //param(type application, emp, dept) 
				// header("location:leave_undr_summary.php");
				echo '<script>window.location = \'leave_undr_summary.php\';</script>';
			}
			else
			{
				echo "<script>alert('Invalid date value');</script>";
				header("Refresh:0");
			}
	
	}elseif(isset($_POST['submit']) && $_POST['submit']=="update_leave"){
			$days = $_POST['days'];
			$reason = $_POST['reason'];
			$type = $_POST['leave'];
	
			if(isdate($from) && isdate($to))
			{
				$str = "UPDATE ems_leave SET d_from='$from', d_to='$to', no_of_days='$days', type='$type', reason='$reason'
							WHERE leave_id='$_GET[ID]' ";
				$qry = $dblink->db_qry($str);
				
				if($_GET['emp_num'] != '')
					header("location:leave_application.php");
				else
					header("location:leave_undr_summary.php");
			}
			else
			{
				echo "<script>alert('Invalid date value either FROM date or TO date');</script>";
				header("Refresh:0");
			}
	
	}elseif(isset($_POST['submit']) && $_POST['submit']=="update_undr"){
			$nature = $_POST['nature'];
			$dep  = $_POST['departure'];
			$reason = $_POST['reason2'];
			
			if(isdate($date_u))
			{
				$str = "UPDATE ems_undertime SET date_un='$date_u', nature_un='$nature', time='$dep', reason='$reason'
							WHERE un_id='$_GET[ID]' ";
				$qry = $dblink->db_qry($str);
				header("location:leave_undr_summary.php");
			}
			else
			{
				echo "<script>alert('Invalid date value');</script>";
				header("Refresh:0");
			}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    <title>iEMS</title>
		<link href="css/home-format.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="assets/js/materialize.min.js"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />

    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
 
	<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
    <link rel='stylesheet' href='cssall.css' type='text/css' />
    <script type="text/javascript" src="jfquery.js"></script>
    <script type="text/javascript" src="navigation.js"></script>
    <script type="text/javascript" src="jsFunctions.js"></script>
    <script type="text/javascript" src="validator.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
    
        var patt = new RegExp(/[^0-9.]/);
            
        function validate1(){
            
            var from = document.form_leave.from.value;
            var to = document.form_leave.to.value;
            var no_days = document.form_leave.days.value;
            var reason = document.form_leave.reason.value;
            var currentTime = new Date(); //JD-2013/04/17 - added current time to compute for the 31 day cut-off limit
            
            //TL-2012/03/29 - Added cutoff.
            //------->
            var rights = document.form_leave.rights.value;
			
			var cutoff_startDate = document.form_leave.cutoff_start.value;
            var cutoff_endDate = document.form_leave.cutoff_end.value;
            
            var cSDate = new Date(cutoff_startDate);
            var cEDate = new Date(cutoff_endDate);
    
            cSDate.setDate(cSDate.getDate() -1);
            cEDate.setDate(cEDate.getDate());
			
            var fromDate = new Date(from);
            var toDate = new Date(to);
			
			<!--//JD-2013/04/17 - Added variables to get timestamp of current date and to date of the application -->			
			var timeDiff = Math.abs(currentTime.getTime() - toDate.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
    

            for (index=0; index < document.form_leave.leave.length; index++) {
                if (document.form_leave.leave[index].checked) {
                    var type = document.form_leave.leave[index].value;
                    break;
                }
            }
            
            var Day3 = new Date(currentTime.getTime() + 1 * 24 * 60 * 60 * 1000);
                if(from=="0000-00-00" || to=="0000-00-00"){
                    alert("Please select inclusive dates.");
                    return false;
                }
				if((fromDate<Day3) && type=="Vacation Leave" && rights != 4 && rights != 1){
					alert("For Vacation Leave: Application must be made 2 or more days before leave.");
				
					return false;
                }
                if(patt.test(no_days)){ //checks if the number of days is a number
                    alert("Invalid number of days!");
                    return false;
                } 
                if(no_days<=0){ //JD-2012/08/15 - checks if the number of days is 0 or negative
                    alert("Invalid number of days!");
                    return false;
                }
	
            //JD-2012/06/20 - Added validation for sick leave if date is already in the past.
            //JD-2012/08/29 - Edited validation: Checks if "To" date is greater than filing date (current date).
            var pastDate = new Date(currentTime.getTime() - 1 * 24 * 60 * 60 * 1000);
				//alert(fullname);
                if((fromDate>currentTime) && type=="Sick Leave" && rights != 4 && rights != 1){
                    alert("Sick Leave Application must not be later than the current date."); //JD-2013/07/26 - changed alert message
					return false;
					//return true;
                }

            //TL-2012/03/29 - Added validation if date applied from and to is passing through the cutoff date. It should not be allowed. //---->
            if((from < cutoff_startDate) && (to >= cutoff_startDate)){
                alert("Your inclusive dates have covered two different cut-off period. Please apply the leaves separately including only until " + (cSDate.getMonth()+1) + "/" + cSDate.getDate() + "/" + cSDate.getFullYear());
                return false;
            }
            if((from <= cutoff_endDate) && (to > cutoff_endDate)){
                alert("Your inclusive dates have covered two different cut-off period. Please apply the leaves separately including only until " + (cEDate.getMonth()+1) + "/" + cEDate.getDate() + "/" + cEDate.getFullYear());
                return false;
            }
            //<---- /TL-2012/03/29 - end

             
        }
    
        function calculate(){
            var from = document.form_leave.from.value;
            var to = document.form_leave.to.value;
			
            var count_days = 0;
			
			var check = document.form_leave.half.checked;
			
			for (var d = new Date(from); d <= new Date(to); d.setDate(d.getDate() + 1))
			{
				if(d.getDay() != 0 && d.getDay() != 6)
					count_days++;
			}
			
            
            if(!isNaN(val)){
				if(document.form_leave.half.checked == true)
					document.getElementById('days').value = count_days - 0.5;	
				else
					document.getElementById('days').value = count_days;
					
				document.getElementById('days').focus();
            }
			
            return true;
        }
    
        function bold(x){
    
            document.getElementById('cc').style.width = "50%";
            if(x=="bold"){
                document.getElementById('bold').style.fontWeight  = "bold";
                document.getElementById('bold2').style.fontWeight  = "normal"
            }else{
                document.getElementById('bold2').style.fontWeight  = "bold";
                document.getElementById('bold').style.fontWeight  = "normal";
            }
        }
    </script>
	<script type="text/javascript"> <!--/JD-2013/02/08 - Added confirmation for AM/PM half day applications./-->
        function doClick(e){
            
			var days = parseFloat(document.form_leave.days.value);
			
			if(document.form_leave.half.checked == true)
			{
				if(confirm("Are you sure you want to apply for half day?")==false){
					e.target.checked = e.target.defaultChecked;
					e.preventDefault();
					e.stopPropagation();
					return false;
				}
				
				document.form_leave.days.value = days - 0.5;
				return true;
			}
			else
				document.form_leave.days.value = days + 0.5;
           
        }
    </script>
	
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script>
		$(function() {
			$( "#from" ).datepicker({
				onSelect: function( selectedDate ) {
					$( "#to" ).datepicker( "option", "minDate", selectedDate );
					$tempdate_fr = selectedDate;
					isDateValid("leave");
				}
				
			});
			$( "#to" ).datepicker({
				onSelect: function( selectedDate ) {
					$( "#from" ).datepicker( "option", "maxDate", selectedDate );
					$tempdate_to = selectedDate;
					isDateValid("leave");
				}
			});

			$( "#undertime" ).datepicker({
				onSelect: function(selectedDate){
					$tempdate = selectedDate;
					isDateValid("undr");
				}
			});
		});

		function isDateValid(opt)
      	{ 	if($tempdate_to == "" || $tempdate_fr == "")
	      	{
	      		return;		
	      	}
      		if(opt == "leave")
	      	{	between = [];
	      		//between.push($tempdate_fr);

	      		$lv_id = document.getElementById('lv_id').value;
	      			
	      		  var start = new Date($tempdate_fr);
			      var end = new Date($tempdate_to);


			      var m = (start.getMonth() + 1).toString();
				  var d = start.getDate().toString();
					
					if(m.length == 1)
						m = '0' + "" + m;

					if(d.length == 1)
						d = '0' + "" + d;

					 var d_b = start.getFullYear() + '-' + m + '-' + d;

				  dates = [];
				  dates.push(d_b);	 

			      while(start < end){
			       between.push(start);           

			       var newDate = start.setDate(start.getDate() + 1);
			       start = new Date(newDate);
			      }

			    

			    jQuery.each(between, function() {
					var month = (this.getMonth() + 1).toString();
					var day = this.getDate().toString();
					
					if(month.length == 1)
						month = '0' + "" + month;

					if(day.length == 1)
						day = '0' + "" + day;

					 var db = this.getFullYear() + '-' + month + '-' + day;
					 //alert(db);
					 dates.push(db);
				});


			    jQuery.each(dates, function() {
			    	$lv_date = this;
			    	//alert(this);
					$.post('checkLeaveDate.php', { date_lv: $lv_date, lv_id: $lv_id }, function(result) {  

			        if(result > 0)
			        {
			          alert("You have an existing Approved or Pending Request for the inclusive dates.\nWait for your manager's approval or cancel your existing request.")
			          $( "#from" ).datepicker('setDate', null);
			          $( "#to" ).datepicker('setDate', null);
			          $( "#from" ).datepicker( "option", "maxDate", '' );
			          $( "#to" ).datepicker( "option", "maxDate", '' );
			          $tempdate_to = "";
			          $tempdate_fr = "";
			          document.getElementById("days").value = 0;
			          //location.reload();
			          
			        }
			        else
			        {
			        	calculate();
			        }
	        
		      		});
				});

	      	}
	      	else if(opt == "undr")
      		{
	          	$ut_id = document.getElementById('ut_id').value;

		      	$.post('checkUTDate.php', { date_ut: $tempdate, ut_id: $ut_id }, function(result) {  
			        if(result > 0)
			        {
			          alert("You have an existing Approved or Pending Request for the date you selected.\nWait for your manager's approval or cancel your existing request.")
			          $( "#undertime" ).datepicker('setDate', null);
			          //location.reload();
			          
			        }
	        
	      		});
	      	}
	      	
      	}

		</script>
    </head>
    <body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<?php include("menu.php"); ?>

		<div id="container">
                <!--/TL-2012/03/29 - Added hidden field for cutoff. -->
                <input type='hidden' name='cutoff_start' id="cutoff_start" value="<?php echo $cutoff_startDate[0];?>"/>
                <input type='hidden' name='cutoff_end' id="cutoff_end" value="<?php echo $cutoff_endDate[0];?>"/>
                <input type='hidden' name='rights' id="fullname" value="<?php echo $_SESSION['rights'];?>"/>
				
                <div class="container">
					<div class="page-header" style="width:79%!important;">
						<h4><strong class="formTitle"> Leave/Undertime Request </strong></h4>
					</div>
				</div>
				
				
				<div class="col-lg-12">
					<ul class="nav nav-tabs" role="tablist" style="width:68%!important;">
						<li role="presentation" class="active leave" id="b1"><a href="#leave" aria-controls="leave" role="tab" data-toggle="tab">Apply Leave</a></li>
						<li role="presentation" class="undertime" id="b2"><a href="#undertime1" aria-controls="undertime1" role="tab" data-toggle="tab">Apply Undertime</a></li>

					</ul>
				</div>
				
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="leave">
        <form name="form_leave" action="<?php $PHP_SELF;?>" method="POST">
					<!-- APPLY LEAVE-->
						<div class="row"><br><br><br><br><br>
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
						<label style="font-size:120%; margin-left:16.5%;"><i class="fa fa-sign-out fa-1x"></i>  LEAVE TYPE:</label>
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
						  <textarea style="margin-left:16% !important;width:790px !important;" placeholder="State Reason of Overtime" id="reason" class="materialize-textarea" name="reason" required/><?php echo $result[5];?></textarea>
						  <label style="margin-left:86px !important;" class="reason" for="reason"><i class="fa fa-pencil"></i>  REASON</label>
						</div>
						</div><br>
						<div class="row">
							<div class="disclaimer" style="margin-left:223px!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong>All fields are required.</div>
						</div>
					<br><br><br><br><br><br><br><br>
					<?php
                        if($_GET['action']=="leave_edit"){
                            echo '<input style="margin-left:205px!important;margin-top:-150px!important;" type="submit" class="btn btn-success" id="save" name="submit" value="update_leave" onclick="return validate1();"/>';	
                        }else{
                            echo '<input style="margin-left:205px!important;margin-top:-150px!important;" type="submit" class="btn btn-success" id="save" name="submit" value="leave"  onclick="return validate1();"/>';
                        }
                    ?>   
		</form> 					
			</div>
		
		<!--UNDERTIME-->
	  <div role="tabpanel" class="tab-pane" id="undertime1">
		<form name="form_under" action="<?php $PHP_SELF; ?>" method="POST">
			<!-- APPLY UNDERTIME -->	
				<div class="row"><br><br><br><br><br>
					<div class="input-field col s14">
					  <input type="text" style="display:none" name="ut_id" id="ut_id" value= "<?php echo $result[6] ?>"/>	
					  <input placeholder="Select Undertime Date" id="undertime" name="undertime" type="text" class="undertime1" value ='<?php if($result[1] != '') echo $result[1]; ?>' required>
					  <label class="from" for="undertime"><i class="fa fa-calendar"></i>  DATE OF UNDERTIME</label>
					</div>
					<div class="input-field col s13">
						<label style="font-size:13px; margin-left:-100px;margin-top:-24px;"><i class="fa fa-clock-o"></i>  TIME OF DEPARTURE:</label>
						<select name="departure" class="form-control" style="width:15%;margin-left: 30%;margin-top: -3%;">
							<?php
                                if($result[3]){
									echo '<option>',"--:--",'</option>';
									echo '<option selected>',$result[3],'</option>';
									for($x=30;$x<=55;$x=$x+5){
										if($result[3]!="3:".$x." pm"){
											echo '<option>',"3:".$x." pm",'</option>';
										}
                                    }
                                    if($result[3]=="4:00 pm"){
										echo '<option>',"4:05 pm",'</option>';
                                    }else{
										echo '<option>',"4:00 pm",'</option>';	
										echo '<option>',"4:05 pm",'</option>';													
                                    }									
									for($x=10;$x<=55;$x=$x+5){
										if($result[3]!="4:".$x." pm"){
											echo '<option>',"4:".$x." pm",'</option>';
										}				
									}					
                                    if($result[3]=="5:00 pm"){
										echo '<option>',"5:05 pm",'</option>';
                                    }else{
										echo '<option>',"5:00 pm",'</option>';										
                                    }
									for($z=10;$z<=30;$z=$z+5){
										if($result[3]!="5:".$z." pm"){
											echo '<option>',"5:".$z." pm",'</option>';
										}	
									}
                                }else{
                                    echo '<option>',"--:--",'</option>';
                                    for($x=30;$x<=55;$x=$x+5){
										echo '<option>',"3:".$x." pm",'</option>';
                                    }
                                    echo '<option>',"4:00 pm",'</option>';			
                                    echo '<option>',"4:05 pm",'</option>';
                                    for($x=30;$x<=55;$x=$x+5){
                                    	echo '<option>',"4:".$x." pm",'</option>';
                                    }
                                    echo '<option>',"5:00 pm",'</option>';			
                                    echo '<option>',"5:05 pm",'</option>';
									for($z=10;$z<=30;$z=$z+5){
										echo '<option>',"5:".$z." pm",'</option>';
									}
                            	}
                            ?>
                        </select>
					</div>
				</div>
				<div class="input-field col s15">
				<select name="departure">
					<?php
                                if($result[3]){
									echo '<option>',"--:--",'</option>';
									echo '<option selected>',$result[3],'</option>';
									for($x=30;$x<=55;$x=$x+5){
										if($result[3]!="3:".$x." pm"){
											echo '<option>',"3:".$x." pm",'</option>';
										}
                                    }
                                    if($result[3]=="4:00 pm"){
										echo '<option>',"4:05 pm",'</option>';
                                    }else{
										echo '<option>',"4:00 pm",'</option>';	
										echo '<option>',"4:05 pm",'</option>';													
                                    }									
									for($x=10;$x<=55;$x=$x+5){
										if($result[3]!="4:".$x." pm"){
											echo '<option>',"4:".$x." pm",'</option>';
										}				
									}					
                                    if($result[3]=="5:00 pm"){
										echo '<option>',"5:05 pm",'</option>';
                                    }else{
										echo '<option>',"5:00 pm",'</option>';										
                                    }
									for($z=10;$z<=30;$z=$z+5){
										if($result[3]!="5:".$z." pm"){
											echo '<option>',"5:".$z." pm",'</option>';
										}	
									}
                                }else{
                                    echo '<option>',"--:--",'</option>';
                                    for($x=30;$x<=55;$x=$x+5){
										echo '<option>',"3:".$x." pm",'</option>';
                                    }
                                    echo '<option>',"4:00 pm",'</option>';			
                                    echo '<option>',"4:05 pm",'</option>';
                                    for($x=30;$x<=55;$x=$x+5){
                                    	echo '<option>',"4:".$x." pm",'</option>';
                                    }
                                    echo '<option>',"5:00 pm",'</option>';			
                                    echo '<option>',"5:05 pm",'</option>';
									for($z=10;$z<=30;$z=$z+5){
										echo '<option>',"5:".$z." pm",'</option>';
									}
                            	}
                            ?>
					</select>
				  </div>
				<div class="row">
						<label style="font-size:13px; margin-left:224px;"><i class="fa fa-sign-out fa-1x"></i>  NATURE OF UNDERTIME:</label>
							<?php 
								if($result[2]){
									if($result[2]=="Emergency"){
										echo '<input type="radio" name="nature" class="with-gap" checked="checked" value="Emergency" id="emergency"/><label for="emergency" class="radio">EMERGENCY</label>';
										echo '<input type="radio" name="nature" class="with-gap" value="Anticipated" id="anticipated"/><label for="anticipated" class="radio">ANTICIPATED</label>';	
									}elseif($result[2]=="Anticipated"){
										echo '<input type="radio" name="nature" class="with-gap" value="Emergency" id="emergency"/><label for="emergency" class="radio">EMERGENCY</label>';
										echo '<input type="radio" name="nature" class="with-gap" value="Anticipated" id="anticipated"/><label for="anticipated" class="radio">ANTICIPATED</label>';										
									}else{
										echo '<input type="radio" name="nature" class="with-gap" checked="checked" value="Emergency" id="emergency"/><label for="emergency" class="radio">EMERGENCY</label>';
										echo '<input type="radio" name="nature" class="with-gap" checked="checked" value="Anticipated" id="anticipated"/><label for="anticipated" class="radio">ANTICIPATED</label>';											
									}
								}else{
									echo '<input type="radio" name="nature" class="with-gap" value="Emergency" id="emergency1"/><label for="emergency1" class="radio">EMERGENCY</label>';
									echo '<input type="radio" name="nature" class="with-gap" value="Anticipated" id="anticipated"/><label for="anticipated" class="radio">ANTICIPATED</label>';							
								}
							?>
				</div>	
				<br>
				   <div class="row">
					<form class="col s12">
					  <div class="row">
						<div class="input-field col s12">
						  <textarea style="margin-left:229px!important;" placeholder="State Reason of Undertime" id="textarea1" class="materialize-textarea" name="reason2" required/><?php echo $result[4];?></textarea>
						  <label class="reason2" for="reason2" style="margin-left:102px!important;"><i class="fa fa-pencil"></i>  REASON</label>
						</div>
					  </div>
					  <div class="disclaimer" style="margin-left:220px!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> All fields are required.</div>
						<?php
                            if($_GET['action']=="undr_edit"){
                              echo 	'<input style="margin-left:220px!important;margin-top:25px!important;" type="submit" class="btn btn-success" id="save" name="submit" value="APPLY"  onclick="return validate2();"/>';	
                            }else{
                                echo '<input style="margin-left:220px!important;margin-top:25px!important;" type="submit" class="btn btn-success" id="save" name="submit" value="APPLY"  onclick="return validate2();"/>';
                            }
							ob_flush();
                        ?>
					</form>
				  </div>
				</div>
		</form>
	  </div>
	  </div>
	  </div>
		<?php include("footer.php"); ?>
    </body>
</html>
<script type="text/javascript">
		var frmvalidator  = new Validator("form_leave");
		frmvalidator.EnableMsgsTogether();
		frmvalidator.addValidation("days","req","Please enter no of days.");
		frmvalidator.addValidation("leave","selone_radio","Please select leave type.");
		frmvalidator.addValidation("reason","req","Please enter your reason.");
		
		var frmvalidator1  = new Validator("form_under");
		frmvalidator1.EnableMsgsTogether();
		frmvalidator1.addValidation("nature","selone_radio","Please select the nature of undertime.");
		frmvalidator1.addValidation("departure","dontselect=0","Please select time of departure.");
		frmvalidator1.addValidation("reason2","req","Please enter your reason.");
</script>