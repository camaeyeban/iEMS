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
	
	if($_SESSION['rights']==2 || $_SESSION['rights']==3 || $_SESSION['rights']==5){
			echo '<h1>',"Invalid URL!",'</h1>';
			return false;
	}
	require_once("calendar/classes/tc_calendar.php");
	
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
	
	function calendar1($date){
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
	
	function calendar2($date){
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
	
	function dateDiff($start, $end){
		$val = strtotime($start) - strtotime($end);
		return $val/60/60/24;
	}
	
	$qry_num = mysql_query("SELECT leave_id FROM ems_leave ORDER BY leave_id DESC");
	$count = mysql_num_rows($qry_num);
		if($count==0){
			$ID = "lve-0001";
		}else{
			$qry_id = mysql_result($qry_num, 0);
			$ID = auto_num($qry_id);
		}
	
	if($_GET['action']=="leave_edit"){
		$str = "SELECT date_Filed, d_from, d_to, no_of_days, type, reason, status, time FROM ems_leave
					WHERE leave_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		$result = $dblink->get_data($qry);
	
		$len = strlen($result[7]);
			if($len==6){
				$chk1 = "checked";
				$chk2 = "checked";
			}else{
				//JD-2012/09/10 - fixed radio button upon updating leave for number of days - AM|PM indicator
				$sub = substr($result[7], -4, 2);
				if($sub=="AM"){
					$chk1 = "checked";
				}elseif($sub=="PM"){
					$chk2 = "checked";
				}else{
					$chk1 || $chk2 = "";
				}
			}
	}
	
	$date_u = isset($_REQUEST["date3"]) ? $_REQUEST["date3"] : "";
	$today = date("Y-m-d");
	$msg = array();
	$empnum = $_POST['empnum'];
	
		$from = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
		$to = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
	
		$am = $_POST['AM'];		
		$pm = $_POST['PM'];		
		$time = $am." ".$pm." ";
		
	if(isset($_POST['submit']) && $_POST['submit']=="leave"){
	
		$AM = $_POST['AM'];
		$reason = $_POST['reason'];
		$type = $_POST['leave'];		
		$val = 2;
		
		if(isset($_POST['empnum']) AND $_POST['empnum']!=0){
			if($_POST['from']<='$_POST["defDate"]'){
				//JD-2014/03/03 - added $time to remarks field if emergency leave
				$str = "INSERT INTO ems_leave (leave_id, emp_num, date_Filed, d_from, d_to, no_of_days, type, reason, status, value, remarks)
							VALUES ('$ID', '$empnum', '$today', '$from', '$from', '0.5', '$type', '$reason', 'Approved', '$val', 'sa_$time')";
				$qry = $dblink->db_qry($str);
				//send_email_pending("leave application", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_leave_undr.php"); 
				//param(type application, emp, dept) 
				//header("location:leave_undr_summary.php");
				//echo $str;
				echo '<script>window.location = \'leave_mngr_summary.php\';</script>';
			}else{
				echo '<script type="text/javascript">alert("Please select a manager!");</script>'; 
				echo '<script>window.location = \'leave_mngr.php\';</script>';
				return false;
			}
		}else{ 
			//JD-2013/04/24 - Added condition for validating form fields!
			echo '<script type="text/javascript">alert("Please select a manager!");</script>'; 
			echo '<script>window.location = \'leave_mngr.php\';</script>';
			return false;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    
        var patt = new RegExp(/[^0-9.]/);
            
        function validate1(){
            
            var from = document.form_leave.date1.value;
            var to = document.form_leave.date2.value;
			var AM = document.form_leave.AM.value; //JD-2013/05/20 - Added variable for the validation of time. Replaces days
            var reason = document.form_leave.reason.value;
            var currentTime = new Date(); //JD-2013/04/17 - added current time to compute for the 31 day cut-off limit
            
            //TL-2012/03/29 - Added cutoff.
            //------->
            var cutoff_startDate = document.form_leave.cutoff_start.value;
            var cutoff_endDate = document.form_leave.cutoff_end.value;
            
            var cSDate = new Date(cutoff_startDate);
            var cEDate = new Date(cutoff_endDate);
    
            cSDate.setDate(cSDate.getDate() -1);
            cEDate.setDate(cEDate.getDate());

            var fromDate = new Date(from);
            var toDate = new Date(to);
			
			<!--//JD-2013/04/17 - Added variables to get timestamp of current "date" and "to date" of the application -->			
			var timeDiff = Math.abs(currentTime.getTime() - toDate.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

            for (index=0; index < document.form_leave.leave.length; index++) {
                if (document.form_leave.leave[index].checked) {
                    var type = document.form_leave.leave[index].value;
                    break;
                }
            }
            
            var Day3 = new Date(currentTime.getTime() + 1 * 24 * 60 * 60 * 1000);
                if(from=="0000-00-00"){
                    alert("Please select a date.");
                    return false;
                }
                if((fromDate>currentTime) && type=="Emergency Leave"){
                    alert("Application should not be filed beyond the current date!");
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
    
        function DateDiff() {
                var dt1 = new Date(Date.parse("04/01/2009"));
                var dt2 = new Date(Date.parse("04/07/2009"));
    
                var dt3 = new Date();
                var one_day=1000*60*60*24;
                alert(parseInt(dt2.getTime()-dt1.getTime())/(one_day));
            }
    
        function calculate(){
            var from = document.form_leave.date1.value;
            var to = document.form_leave.date2.value;
            
            var d1 = Date.parse(from);
            var d2 = Date.parse(to);
            var one_day = 1000*60*60*24;
            var val = (d2-d1)/one_day;
            
            if(!isNaN(val)){		
                document.getElementById('days').value = val+1;	
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
    
    <!--/JD-2013/02/08 - Added validation for AM/PM half day applications./-->
	<script type="text/javascript"> 
        function doClick(e){
            if(confirm("Are you sure you want to apply for half day?")==false){
                e.target.checked = e.target.defaultChecked;
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
            return true;
        }
    </script>
    </head>
    <body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
        <form name="form_leave" action="<?php $PHP_SELF; ?>" method="POST">
            <div id="container">
                <!--/TL-2012/03/29 - Added hidden field for cutoff. -->
                <input type='hidden' name='cutoff_start' id="cutoff_start" value="<?php echo $cutoff_startDate[0];?>"/>
                <input type='hidden' name='cutoff_end' id="cutoff_end" value="<?php echo $cutoff_endDate[0];?>"/>
                <input type='hidden' name='defDate' value='<?php date("y/m/d") ?>' />
                <?php include("menu.php"); ?>
				<?php
						echo '<div id="cc" style="width:670px;">';
						$wid = "'style='width:670px;'";
                ?>
                <div>
                	<span class="title">Manager's Leave</span>
                </div>
                <div class="t" <?php echo $wid; ?>>
                    <table border='0' width="100%">
                        <tr>
                            <td colspan="2" class="caption2"><b>Leave Application</b></td>
                        </tr>
                        <tr>
                            <td  width="25%" style="padding: 0 0 0 10px;">Date Filed: </td>
                            <td><?php echo $d = ($result[0]) ? $result[0] : date("Y-m-d");?></td>
                        </tr>
                        <tr>
                            <td  style="padding: 0 0 0 10px;">Manager's Name: </td>
                            <td>
								<!--<?php echo $_SESSION['fullname'];?>-->
                            	<select name="empnum">
                                    <option value="0">Select a manager</option>
                                    <?php 
                                    
										$sql = mysql_query("SELECT ems_users.emp_num AS empnum, 
													CONCAT(emp_firstname,' ',emp_lastname) AS empname 
													FROM ems_users
													INNER JOIN ems_employee
													ON ems_employee.emp_num=ems_users.emp_num
													WHERE ems_employee.emp_num!=1 
													AND (ems_users.rights!=1 AND ems_users.rights!=3 
													AND ems_users.rights!=4 AND ems_users.rights!=5)
												");
										while ($row = mysql_fetch_array($sql)){
                                    
                                    ?>
                                    <option value="<?php echo $row['empnum']; ?>"><?php echo $row['empname']; ?></option>
                                    <?php
                                    	}
                                    ?>
                            	</select>
                            </td>
                        </tr>				
                        <tr>
                            <td  style="padding: 0 0 0 10px;">Date: <span class="a">*</span></td>
                            <td><?php calendar1($result[1]); ?><span style="display: none;"><?php calendar2($result[2]); ?></span></td>
                        </tr>
                        <tr>
                            <td  style="padding: 0 0 0 10px;">Time: <span class="a">*</span></td>
                            <td> 
                            	<!--/JD-2013/06/03 - Removed value since manager's application are not editable /-->
                                <input type="text" name="AM" size="12" value="" id="AM" placeholder="HH:MM AM/PM" /> 
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 0 0 10px;">Leave type: <span class="a">*</span></td>
                            <td>
                                <?php 
                                    if($result[4]){
                                        switch($result[4]){
                                            case "Emergency Leave":
                                                echo '<input type="radio" name="leave" value="Sick Leave"/>',"Sick Leave";
                                                echo '<input type="radio" name="leave" value="Vacation Leave"/>',"Vacation Leave";
                                                echo '<input type="radio" name="leave" checked="checked" value="Emergency Leave"/>',"Emergency Leave";
                                                echo '<input type="radio" name="leave" value="Maternity/Paternity Leave"/>',"Maternity/Paternity Leave";
                                            break;
                                        }
                                    }
                                    else {
                                        echo '<input type="radio" name="leave" value="Sick Leave" hidden="hidden" />',"";
                                        echo '<input type="radio" name="leave" value="Vacation Leave" hidden="hidden" />',"";
                                        echo '<input type="radio" name="leave" value="Emergency Leave"/>',"Emergency Leave";
                                        echo '<input type="radio" name="leave" value="Maternity/Paternity Leave" hidden="hidden" />',"";
                                    }										
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 0 0 10px;">Reason: <span class="a">*</span></td>
                            <td><textarea cols="86" rows="4" name="reason"><?php echo $result[5];?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr/></td>
                        </tr>
                        <tr>
                            <td  style="padding: 0 0 0 10px;">
                                <?php
									echo '<input type="submit" class="apply" id="save" name="submit" value="leave"  onclick="return validate1();"/>';
                                ?>
                            </td>
                            <td colspan="2" align="right" style="padding: 0 0 0 15px;">Fields marked with an asterisk <span class="a">*</span> are required.</td>
                        </tr>
                    </table>
            	</div>
        </form>
    </body>
</html>
<script type="text/javascript">
		var frmvalidator  = new Validator("form_leave");
		frmvalidator.EnableMsgsTogether();
		frmvalidator.addValidation("empnum","req","Please select a manager.");
		frmvalidator.addValidation("AM","req","Please enter the time.");
		frmvalidator.addValidation("leave","selone_radio","Please select leave type.");
		frmvalidator.addValidation("reason","req","Please enter your reason.");
</script>