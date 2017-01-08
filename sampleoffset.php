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
	$remarks = $_POST['remarks'];
	$acc = $_POST['acc'];
	
	if(isset($_POST['submit']) && $_POST['submit']=="apply"){
		if(isset($_POST['chkd'])){
			$date_ot2 = isset($_REQUEST["date"]) ? $_REQUEST["date"] : "";
			//$ot_hours2  = $_POST['ot_hours2'];
			$date_offset2 = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
			
			$arr = count($date_ot2);
			for ($z=0; $z<$arr; $z++){
				$arra[] = $date_ot2[$z];
				foreach($arra as $row){
					$row = '("'.mysql_real_escape_string($row['date_ot2']).'")';
				}
			}
			//echo implode(" | ", $arra);
			@$data = implode(" / ", $arra);		//insert "-" on arrays
		
			$str = "INSERT INTO ems_offset (offset_id, emp_num, date_Filed, date_ot, date_ot2, ot_hours, ot_hours2,
						accomplishment, date_offset, date_offset2, remarks, status)
						VALUES ('$ID', '$_SESSION[emp_num]', '$today', '$date_ot', '$data', '$ot_hours1', '$ot_hours2', 
						'$acc', '$date_offset', '$date_offset2', '$remarks', 'Pending')";			
			$qry = $dblink->db_qry($str);
			echo $str;
			
		}else{
		
			$str = "INSERT INTO ems_offset (offset_id, emp_num, date_Filed, date_ot, date_ot2, ot_hours, ot_hours2,
						accomplishment, date_offset, date_offset2, remarks, status)
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
			$date_ot2 = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
			$date_offset2 = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
		}
		$str = "UPDATE ems_offset SET date_ot='$date_ot', date_ot2='$date_ot2', ot_hours='$ot_hours1', ot_hours2='$ot_hours2', 
							accomplishment='$acc', date_offset='$date_offset', date_offset2='$date_offset2', remarks='$remarks' WHERE offset_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		header("location:view_edit_offset.php");
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
				var cutoff = document.form_offset.cutoff.value; //validation for cut-off every 31st day
                
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
                	document.form_offset.ot_hours2.disabled = false;
                    document.getElementById('date_new').style.display = "block";
                    document.getElementById('dis').style.display = "none";
                    document.getElementById('dis2').style.display = "none";
                    document.getElementById('cal4').style.display = "block";
                    counter++;
                }else{
                    document.form_offset.ot_hours2.disabled = true;
                    document.getElementById('date_new').style.display = "none";
                    document.getElementById('dis').style.display = "inline";
                    document.getElementById('dis2').style.display = "inline";
                    document.getElementById('cal4').style.display = "none";
                    counter--;
                }
            }
			$(function(){ //add div contents
				$("#addButton").click(function(){
					tr = $("#addNew").clone().removeAttr('id').show()
					tr.find('input[type="text"]').addClass("datePickTest");
					tr.insertAfter($("#displayData tr:first"));
					 $(".datePickTest").datepicker(
						 {   changeYear: true ,
							changeMonth: true ,
							dateFormat: "yy-mm-dd", //numeric representations of day, month, year
					});
				});
			});
            $(document).ready(function(){
            	if($("#ot").is(":checked")==true){
                	$("#dis").hide();
                    $("#date_new").show();
                    $("#ot_hours2").removeAttr("disabled");
                    $("#dis2").hide();
                    $("#cal4").show();
                }
            });
        </script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript">
            function toggleStatus() { //disable div contents
                if ($('#chkd').is(':checked')) { 
					//1Day enabled
                    $('#1Day :input').removeAttr('disabled');
					$('#1Day').removeAttr('hidden');
					//nDays disabled
                    $('#nDays :input').attr('disabled', true);
                    $('#nDays').attr('hidden', true);
                } else { 
					//nDays enabled
                    $('#nDays :input').removeAttr('disabled');
					$('#nDays').removeAttr('hidden');
                    //1Day disabled
					$('#1Day :input').attr('disabled', true);
                    $('#1Day').attr('hidden', true);
					
                }   
            }
        </script>
		<script type="text/javascript">
            $(document).ready(function(){
                $counter = 0; // initialize 0 for limitting textboxes
                $('#buttonadd').click(function(){
                    if ($counter < 10)
                    {
                        $counter++;
                        $('#buttondiv').append('<div><label>OT date '+$counter+'</label> <input type="text" name="date[]" class="textbox" placeholder="YYYY-MM-DD" /> &nbsp </div>');
                    }else{
                        alert('Maximum of 10 OT dates only!');
                    }
                });
        
                $('#buttonremove').click(function(){
                    if ($counter!=2){
                        $counter--;
                        $('#buttondiv .textbox:last').parent().remove(); // get the last textbox and parent for deleting the whole div
                    }else{
                        alert('Minimum of 2 OT dates are required!');
                    }
                });
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
                    	<td style="padding-left: 10px;" valign="top">OT date/s: <span class="a">*</span></td>
                    	<td>
                        	<input type="checkbox" id="chkd" name="chkd" onchange="toggleStatus()" />
                            <label>Apply OT for more than 2 days</label>
                            
                            <div id="1Day">
                                <div id="buttondiv">
                                <!-- this is where textbox will appear -->
                                </div>
                                <div class="choices">
                                    <input type="button" id="buttonadd" value="Add OT date"/>
                                    <input type="button" id="buttonremove" value="Remove OT date"/>
                                </div>
                            </div>
                            
                            <div id="nDays">
                            	<table border="0">
                                    <tr>
                                        <td><?php calendar1($result[1]);?>
                                        <span style="padding-left:14px;">Days:</span> <span class="a">*</span>
                                        <input type="text" name="ot_hours1" size="2" value="<?php echo $result[3]?>"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <?php 
                            echo '<td>';
							echo '<span id="dis" style="padding:3px 0 3px 1px; background-color:#e2e2e2;">Select Date <img src="icons/iconCalendar.gif"/></span>';
                           // echo '<span id="date_new" style="display:none;">',calendar2($result[2]),'</span>';
                           // echo '<span style="padding-left:14px;"> Days:</span> <span class="a">* </span>';
                           // echo '<input type="text" name="ot_hours2" id="ot_hours2" size="2" disabled=="disabled" value="',$result[4],'"/>';
                            echo '<input type="checkbox" name="ot" value="day2" onclick="OT();" id="ot" '.$chk.' hidden="hidden"/> ';
                            echo '</td>';									
                        ?>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px;">Accomplishments: <span class="a">*</span></td>
                        <td><textarea cols='70' rows='4' name="acc"><?php echo $result[5]?></textarea></td>
                    </tr>
                    <tr><td colspan="2"><hr/></td></tr>
                    <tr>
                        <td colspan='2' class="caption2"><b>Offset Request</b></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px;">From: </td>
                        <td><?php echo calendar3($result[6]); ?></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px;">To: </td>
                        <?php
                            echo '<td>',calendar4($result[7]),'</td>';
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