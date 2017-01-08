<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("config_DB.php");
require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

	if (!$dblink)
		die("no connection");
	
	require_once("calendar/classes/tc_calendar.php");
	include("functions.php");
	chk_active($_SESSION['user_id']);
	
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	if($_SESSION['rights']==1){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
	}
	
	function calendar1($date){
		$myCalendar = new tc_calendar("date1", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(1970, 2020);
		$myCalendar->setAlignment('left', 'top');
		if($date!=""){
			$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
		}
		$myCalendar->writeScript();
	}
	
	function calendar2($date){
		$myCalendar = new tc_calendar("date2", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(1970, 2020);
		$myCalendar->setAlignment('left', 'top');
		if($date!=""){
			$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
		}
		$myCalendar->writeScript();
	}
	
	function calendar3($date){
		$myCalendar = new tc_calendar("date3", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(1970, 2020);
		$myCalendar->setAlignment('left', 'top');
		if($date!=""){
			$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
		}
		$myCalendar->writeScript();
	}
	
	function calendar4($date){
		$myCalendar = new tc_calendar("date4", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(1970, 2020);
		$myCalendar->setAlignment('left', 'top');
		if($date!=""){
			$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
		}
		$myCalendar->writeScript();
	}
	
	if(isset($_GET['ID'])){
		$str = "SELECT date_Filed, date_ot, date_ot2, ot_hours, ot_hours2, accomplishment, date_offset, date_offset2, remarks
				FROM ems_offset WHERE offset_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		$result = $dblink->get_data($qry);
	}
	if($result[4]!="0"){
		$chk = "checked";
	}
	
	$qry_num = mysql_query("SELECT offset_id FROM ems_offset ORDER BY offset_id DESC");
	$count = mysql_num_rows($qry_num);
		if($count==0){
			$ID = "off-0001";
		}else{
			$qry_id = mysql_result($qry_num, 0);
			$ID = auto_num($qry_id);
		}
	
	$today = date("Y-m-d");
	$date_ot = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
	$date_offset = isset($_REQUEST["date3"]) ? $_REQUEST["date3"] : "";
	$ot_hours1  = $_POST['ot_hours1'];
	$ot_hours2  = $_POST['ot_hours2'];
	$remarks = $_POST['remarks'];
	$acc = $_POST['acc'];
	
	if(isset($_POST['submit']) && $_POST['submit']=="apply"){
		if(isset($_POST['ot'])){
			//$date_ot2 = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
			//$date_offset2 = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
			
			$ot_hours2  = $_POST['ot_hours2'];
			$date_ot2 = isset($_REQUEST["date"]) ? $_REQUEST["date"] : "";
			$date_offset2 = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
			
			$str = "INSERT INTO ems_offset (offset_id, emp_num, date_Filed, date_ot, date_ot2, ot_hours, ot_hours2,
						accomplishment, date_offset, date_offset2, remarks, status)
						VALUES ('$ID', '$_SESSION[emp_num]', '$today', '$date_ot', '$date_ot2', '$ot_hours1', '$ot_hours2', 
						'$acc', '$date_offset', '$date_offset2', '$remarks', 'Pending')";			
			$qry = $dblink->db_qry($str);
			echo $str;
		
		}else{
		
			$str = "INSERT INTO ems_offset (offset_id, emp_num, date_Filed, date_ot, date_ot2, ot_hours, 
						ot_hours2, accomplishment, date_offset, date_offset2, remarks, status)
						VALUES ('$ID', '$_SESSION[emp_num]', '$today', '$date_ot', '$date_ot2', '$ot_hours1', '$ot_hours2', 
						'$acc', '$date_offset', '$date_offset2', '$remarks', 'Pending')";			
			$qry = $dblink->db_qry($str);
			echo $str;
		}
		//param(type of application, emp, dept) 
		//send_email_pending("offset request", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_offset_request.php"); 
		// header("location:view_edit_offset.php");		
		echo '<script>window.location = \'view_edit_offset.php\';</script>';		
	}
	if(isset($_POST['submit']) && $_POST['submit']=="update"){
		if(isset($_POST['ot'])){
			//$date_ot2 = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
			//$date_offset2 = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
			$ot_hours2  = $_POST['ot_hours2'];
			$date_ot2 = isset($_REQUEST["date"]) ? $_REQUEST["date"] : "";
			$date_offset2 = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
			
			$str = "UPDATE ems_offset SET date_ot='$date_ot', date_ot2='$date_ot2', ot_hours='$ot_hours1',
						ot_hours2='$ot_hours2', accomplishment='$acc', date_offset='$date_offset', 
						date_offset2='$date_offset2', remarks='$remarks' WHERE offset_id='$_GET[ID]' ";
			$qry = $dblink->db_qry($str);
			header("location:view_edit_offset.php");
			echo $str;
		}else{
			$str = "UPDATE ems_offset SET date_ot='$date_ot', date_ot2='$date_ot2', ot_hours='$ot_hours1',
						ot_hours2='$ot_hours2', accomplishment='$acc', date_offset='$date_offset', 
						date_offset2='$date_offset2', remarks='$remarks' WHERE offset_id='$_GET[ID]' ";
			$qry = $dblink->db_qry($str);
			header("location:view_edit_offset.php");
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
        <script type="text/javascript">
        
        	function validate(){
            	var date_ot = document.form_offset.date1.value;
                var date_ot2 = document.form_offset.date2.value;
                var ot_hours = document.form_offset.ot_hours1.value;
                var ot_hours2 = document.form_offset.ot_hours2.value;
                var date_off = document.form_offset.date3.value;
                var date_off2 = document.form_offset.date4.value;
                var acc = document.form_offset.acc.value;
                
                var patt = new RegExp(/[^0-9.]/);
        
                	if(date_ot=="0000-00-00" || ot_hours=="" ||  acc=="" || date_off=="0000-00-00"  || remarks==""){
                    	alert("Please fill-out required fields!");
                        return false;
                    }
                    if(document.form_offset.ot.checked == true){
                        if(date_ot2=="0000-00-00" || ot_hours2=="" || date_off2=="0000-00-00"){
                            alert("Please fill-out required fields!");
                            return false;					
                        }
						if(ot_hours2<=0 ){
							alert("Invalid number of hours!");
							return false;		
						}else if(patt.test(ot_hours2)){ //test the input if it contains only a number
							alert("Invalid number of hours!");
							return false;
							}	
						}
                    if(ot_hours<=0){
                        alert("Invalid number of hours!");
                        return false;		
                    } else if(patt.test(ot_hours)){ //test the input if it contains only a number
                    	alert("Invalid number of hours!");
                        return false;
                    }		
				}
				
            	var counter  =1 ;
            	function OT(){
                var chk = document.form_offset.ot.checked;
                if(chk){
                    $('#1Day :input').removeAttr('disabled');
					$('#1Day').removeAttr('hidden');
                    $('#nDays :input').attr('disabled', true);
                    $('#othour').attr('disabled', true);
					document.getElementById('multi_date').style.display ="inline";
					document.getElementById('multi_day').style.display ="inline";
                    document.getElementById('cal4').style.display = "block";
                    counter++;
                } else { 
                    $('#nDays :input').removeAttr('disabled');
					document.getElementById('multi_date').style.display ="none";
					document.getElementById('multi_day').style.display ="none";
                    document.getElementById('cal4').style.display = "none";
                }
            }
            $(document).ready(function(){
            	if($("#ot").is(":checked")==true){
					$('#multi_day').show();
					$('#multi_date').show();
                    $('#1Day :input').removeAttr('disabled');
                    $("#cal4").show();
                    $('#othour').removeAttr('disabled');
                }else{
					$('#multi_day').hide();
					$('#multi_date').hide();
                    $('#1Day :input').attr('disabled', true);
                    $("#cal4").hide();
                    $('#othour').removeAttr('disabled');
				}
            });
        </script>
    </head>
	<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
        <div id="container">
            <?php include("menu.php"); ?>
            <div id="cc">
                <div>
                	<span class="title">Offset Application</span>
                </div>
                <form name='form_offset' action='<?php $PHP_SELF;?>' method='POST'>
                <table border='0' width='50%' class="t">
                    <tr>
                        <td colspan='2' class="caption2"><b>Overtime Rendered</b></td>
                    </tr>
                    <tr>
                        <td width="24%" style="padding-left: 10px;">Date Filed:</td>
                        <td><?php echo $d = ($result[0]) ? $result[0] : date("Y-m-d");?></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px;">Name: </td>
                        <td><?php echo $_SESSION['fullname'];?></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px;">Department: </td>
                        <td><?php echo $_SESSION['dept_name'];?></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px;">OT date/s: <span class="a">*</span></td>
                        <td>
                        <div id="nDays">
							<span id="cal1"><?php calendar1($result[1]);?></span>
                        	<span id="cal_hour1" style="padding-left:14px;">Days: <span class="a">*</span>
                        		<input type="text" name="ot_hours1" size="2" value="<?php echo $result[3]?>" id="othour" required="required"/>
                            </span>
                       	</div>
                        	<input type="checkbox" name="ot" value="day2" onclick="OT();" id="ot" '.$chk.' checked="checked"/> 
                            <label for="ot" style="font-size:11px;">Apply offset for 2-day OT.</label>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                        	<div id="1Day">
                                <div class="choices">
                               		<span id="multi_date"style="padding:3px 0 3px 1px;"> Enter dates: <span class="a">* </span>
                                    <input type="text" id="date" name="date" size="30" value="<?php echo $result[2] ?>" placeholder="YYYY-MM-DD" title="Separate multiple date by comma." autofocus="autofocus" required="required" /><br /></span>
                                    <span id="multi_day" style="padding:3px 0 3px 1px;"> Days: <span class="a">* </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="text" name="ot_hours2" size="15" value="<?php echo $result[4] ?>" required="required" title="Separate multiple day by comma." /></span>
                                </div>
                            </div>
                        </td>
						<?php /* 
                            echo '<td>';
							echo '<span id="dis" style="padding:3px 0 3px 1px; background-color:#e2e2e2;">Select Date <img src="icons/iconCalendar.gif"/></span>';
                            echo '<span id="date_new" style="display:none;">',calendar2($result[2]),'</span>';
                            echo '<span style="padding-left:14px;"> Days:</span> <span class="a">* </span>';
                            echo '<input type="text" name="ot_hours2" id="ot_hours2" size="2" disabled=="disabled" value="',$result[4],'"/>';
                            echo '';
                            echo '</td>';									
                        */?>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px;">Accomplishments: <span class="a">*</span></td>
                        <td><textarea cols='70' rows='4' name="acc" required="required"><?php echo $result[5]?></textarea></td>
                    </tr>
                    <tr><td colspan="2"><hr/></td></tr>
                    <tr>
                        <td colspan='2' class="caption2"><b>Offset Request</b></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px;">Offset date/s: <span class="a">*</span></td>      
                        <td><?php echo calendar3($result[6]); ?></td>			
                    </tr>
                    <tr>
                        <td></td>
						<?php
                            echo '<td><span id="cal4" style="display:none;">',calendar4($result[7]),'</span>';
                        ?>
                    </tr>
                     <!--<tr>
                        <td style="padding-left: 10px;">Remarks: <span class="a">*</span></td>
                        <td><textarea cols='70' rows='4' name="remarks"><?php //echo $result[8]?></textarea></td>
                    </tr>-->
                    <tr><td colspan='2'><hr/></td></tr>
                    <tr>
                    <?php
                        if($_GET['action']=="off_edit"){
                            echo '<td><input type="submit" name="submit" value="update" class="update" onclick="return validate();" /></td>';
                        }else{
                            echo '<td><input type="submit" name="submit" value="apply" class="apply" onclick="return validate();"/></td>';
                            }
                    ?>
                    <td colspan="2" align="right">Fields marked with an asterisk <span class="a">*</span> are required.</td>

                    </tr>
                </table>
				<form>
            </div>
            <div id="footer">
                <br/>
                <p>Copyright 2011</p>     
            </div>
        </div>
	</body>
</html>