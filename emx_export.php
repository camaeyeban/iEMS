<?php
@session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

	include("config_DB.php");
	require("mysql_db_connect.inc.php");
	require_once("calendar/classes/tc_calendar.php"); 
	
	$dblink = new mysql_db_connect();
	if (!$dblink)
		die("no connection");
	include("functions.php");
	
	chk_active($_SESSION['user_id']);
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	
	//Restricts users whose rights is employee to export applications
	if($_SESSION['rights']==3){
		echo '<h1>',"Invalid URL",'</h1>';
		return false;
	}
	
	extract($_POST); //extract all the variables from the previous page
	
	//JD-2013/05/30 - Placed into new variables the value extracted from the previous page
	$exportFrom = ""; //will store the value for date1
	$exportTo = ""; //will store the value for date2
	$report = $_POST['report']; //variable containing the "report to" value
	$qoic = $_POST['qoic']; //variable containing the "oic" value of the current department
	$empnum = $_POST['empnum']; //variable containing the "empnum" value
	$bman = $_POST['bman']; //variable containing the "name" of the department manager
	
	function calendar1($date){ //get "from" date
			$myCalendar = new tc_calendar("date1", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(1970, 2020);
			$myCalendar->setAlignment('left', 'bottom');
			if($date!=""){
				$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
			}
			$myCalendar->setOnChange("calculate()");	
			$myCalendar->writeScript();
	}
	
	function calendar2($date){ //get "to" date
			$myCalendar = new tc_calendar("date2", true, false);
			$myCalendar->setIcon("calendar/images/iconCalendar.gif");
			$myCalendar->setPath("calendar/");
			$myCalendar->setYearInterval(1970, 2020);
			$myCalendar->setAlignment('right', 'bottom');
			if($date!=""){
				$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
			}		
			$myCalendar->setOnChange("calculate()");	
			$myCalendar->writeScript();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    <title>iEMS</title>
        <link href="calendar/calendar.css" rel="stylesheet" type="text/css">
        <link rel='stylesheet' href='cssall.css' type='text/css' />
        <script language="javascript" src="calendar/calendar.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
    	<script type="text/javascript" src="validator.js"></script>
        <script type="text/javascript">

			function validate1(){
				
				var from = document.iems_export.date1.value;
				var to = document.iems_export.date2.value;
				var currentTime = new Date(); //JD-2013/04/17 - current date
				var fromDate = new Date(from); //JD-2013/06/03 - from date

				if(from=="0000-00-00" || to=="0000-00-00"){
					alert("Please select inclusive dates.");
					return false;
				}
				if(from>to){
					alert("Inclusive date is invalid!");
					return false;
				}
				
				//JD-2013/06/03 - Added validation for choosing a beginning date beyond the current date
				//				- this prevent the user to export future application
				if(fromDate>currentTime){
					alert("Beginning date is beyond the current date.");
					return false;	
				}
			}
    </script>
    </head>
    <body alink="green" vlink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
        <div id="container">
            <?php include("menu.php"); ?>
            <div id="cc">
            	<div>
                    <span class="title">Export Applications</span></div>
					<div class="exportFrame">
                    	<form name="iems_export" id="iems_export" method="POST" action="emp_export.php">
                            <input type="text" name="report" value="<?php echo $report ?>" hidden="hidden" />
                            <input type="text" name="qoic" value="<?php echo $qoic ?>" hidden="hidden" />
                            <input type="text" name="empnum" value="<?php echo $empnum ?>" hidden="hidden" />
                            <input type="text" name="bman" value="<?php echo $bman ?>" hidden="hidden" />
                        	<table border="0" cellpadding="3" cellspacing="4" width="100%">
                                <tr>
                                	<td colspan="2"><hr /></td>
                                </tr>
                                <tr>
                                	<td>Department(s): </td>
                                    <td>
                                    <?php
                                    	//JD-2013/06/03 - Added query to show the departments headed by the user
										$result = mysql_query("SELECT d.dept_name FROM ems_business_units b
													LEFT JOIN ems_department d ON d.dept_code=b.dept_code
													WHERE b.b_manager_name='$_SESSION[fullname]'") or die(mysql_error);
													
										while($row = mysql_fetch_array($result)){
											echo '/',$row[0],'&nbsp;&nbsp;';
											//echo '/&nbsp;';
										}
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                	<td>Date: </td>
                                	<td><?php calendar1($exportFrom); calendar2($exportTo); ?></td>
                                </tr>
                            	<tr>
                                	<td valign="top">Select which report to export:</td>
                                	<td>
                                       <!-- 
                                       <select name="" id="" />
                                            <option value="">---Select One---</option>
                                            <option value="export_infoBtn">Employee List</option>
                                            <option value="export_leaveBtn">Leave Applications</option>
                                            <option value="export_underBtn">Undertime Applications</option>
                                            <option value="export_overtimeBtn">Overtime Applications</option>
                                            <option value="export_offsetBtn">Offset Applications</option>
                                            <option value="export_officialBtn">Official Business Applications</option>
                                            <option value="export_requisiteBtn">Equipment Requisition Applications</option>
                                            <option value="export_airticketBtn">Air Ticket Applications</option>
                                        </select> 
                                        -->
                                        <input type="radio" name="export_app" value="export_infoBtn" />Employee List<br />
										<input type="radio" name="export_app" value="export_leaveBtn" />Leave Application<br />
                                        <input type="radio" name="export_app" value="export_underBtn" />Undertime Application<br />
                                        <input type="radio" name="export_app" value="export_overtimeBtn" />Overtime Application<br />
                                        <input type="radio" name="export_app" value="export_offsetBtn" />Offset Application<br />
                                        <input type="radio" name="export_app" value="export_officialBtn" />Official Business Application<br />
                                        <input type="radio" name="export_app" value="export_requisiteBtn" />Equipment Requisition Application<br />
                                        <input type="radio" name="export_app" value="export_airticketBtn" />Air Ticket Application
                                    </td>
                                </tr>
                                <tr>
                                	<td colspan="2"><hr /></td>
                                </tr>
                                <tr>
                                	<td colspan="2" align="right">
                                    	<?php echo'<input type="submit" name="export" class="export" onclick="return validate1()" />'; ?>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
	            </div>
    	        <div id="footer">
        	        <br/><p>Copyright 2011</p>
            	</div>
			</div>
        </div>
    </body>
</html>
<script type="text/javascript">
		var frmvalidator  = new Validator("iems_export");
		frmvalidator.EnableMsgsTogether();
		frmvalidator.addValidation("export_app","selone_radio","Please select the type of application you want to export.");
</script>