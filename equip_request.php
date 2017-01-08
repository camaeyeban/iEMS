<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

require_once('calendar/classes/tc_calendar.php');
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
	
	if($_SESSION['rights']==1){
		echo '<h1>',"Invalid URL",'</h1>';
		return false;
	}
	
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

	if(isset($_GET['ID'])){
		$str = "SELECT date_Filed, subject_purpose, date_from, date_to, no_of_days, equip_list
					FROM ems_equip_requests
					WHERE erqst_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		$result = $dblink->get_data($qry);
	}

	$qry_num = mysql_query("SELECT erqst_id FROM ems_equip_requests ORDER BY erqst_id DESC");
	$count = mysql_num_rows($qry_num);
	if($count==0){
		$ID = "rsv-0001";
	}else{
		$qry_id = mysql_result($qry_num, 0);
		$ID = auto_num($qry_id);
	}

	//inserting data in the table
	$today = date("Y-m-d");
	$subject = $_POST['subject'];
	$Datefrom = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
	$Dateto = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
	$num_days = $_POST['no_of_days'];
	$others = trim($_POST['others']."|");
	$type = $_POST['type'];

	if($others=="|"){
		$others = "";
	}

	if(isset($_POST['submit']) && $_POST['submit']=="submit"){
		foreach($type as $ty){
			if($ty!=""){
				$items = $items . $ty. "|";
			}
		}

		$strqry = "INSERT INTO ems_equip_requests (erqst_id, emp_num, date_Filed, subject_purpose, date_from, date_to, no_of_days, equip_list, status)
					VALUES('$ID', '$_SESSION[emp_num]','$today', '$subject', '$Datefrom', '$Dateto', '$num_days', '$items$others', 'Pending')";
		$query = $dblink->db_qry($strqry);
		//param(type of 	application, emp, dept)
		send_email_pending("equipment reservation", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_reservation.php"); 
		// header("location:view_edit_equip.php");
		echo '<script>window.location = \'view_edit_equip.php\';</script>';
	}elseif(isset($_POST['submit']) && $_POST['submit']=="update"){
		foreach($type as $ty){
			if($ty!=""){
				$items = $items . $ty. "|";
			}
		}

		$str = "UPDATE ems_equip_requests SET subject_purpose='$subject', date_from='$Datefrom', 
				date_to='$Dateto', no_of_days='$num_days', equip_list='$items$others' WHERE erqst_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		header("location:view_edit_equip.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
	    <title>iEMS</title>
	    <link rel='stylesheet' href='cssall.css' type='text/css' />
	    <script type="text/javascript" src="jquery.js"></script>
	    <link href="calendar/calendar.css" rel="stylesheet" type="text/css">
	    <script language="javascript" src="calendar/calendar.js"></script>
	    <script type="text/javascript" src="navigation.js"></script>
	    <script type="text/javascript" src="jsFunctions.js"></script>
	    <script type="text/javascript" src="validator.js"></script>
	    <script type="text/javascript">
			function validate(){
				var subject = document.form_request.subject.value;
				//var client = document.form_request.client.value; /JD-2012/06/11
				var from = document.form_request.date1.value;
				var to = document.form_request.date2.value;
				var no_days = document.form_request.no_of_days.value;
				var type = document.getElementsByName("type[]");
				var others = document.form_request.others.value;
				var patt = new RegExp(/[^0-9.]/);

					if(from=="0000-00-00" || to=="0000-00-00"){
						alert("Please fill-out required fields!");
						return false;
					}
					//validated checkboxes
					var valid = false;
					for (var i=0; i<type.length; i++){
						if(type[i].checked){	
							valid = true;
							break;
						}
					}

					if(!valid){
						alert("Please select atleast one equipment.");
						return false;
					}

					if(no_days<=0){
						alert("No. of days must not be less than or equal to zero.");
						return false;
					}
					if(patt.test(no_days)){ //test the input if it contains only a number
						alert("Invalid number of days!");
						return false;
					}	

					// if(!valid && others==""){
						// alert("Please select atleast one equipment.");
						// return false;
					// }else if(valid && others==""){
						// return true;
					// }else if(!valid && others){
						// return true;			
					// }			
					//-------------end of checkboxes			
				}

				function calculate(){
					var from = document.form_request.date1.value;
					var to = document.form_request.date2.value;
	
					var d1 = Date.parse(from);
					var d2 = Date.parse(to);
					var one_day = 1000*60*60*24;
					var val = (d2-d1)/one_day;
	
					if(!isNaN(val)){		
						document.getElementById('days').value = val+1;	
						document.getElementById('days').focus();
						// document.getElementById('days').setAttribute("disabled", "disabled");
					}
	
					return true;
				}

				$(document).ready(function(){
				if($("#others").is(":checked")==true){
					$("#f_others").removeAttr("disabled");
				}
				$("#others").click(function(){
					if($(this).is(":checked")){
						$("#f_others").removeAttr("disabled");
						$("#f_others").focus();
					}else{
						$("#f_others").attr("disabled", "disabled");
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
                    <span class="title">Equipment Reservation</span>
                </div>
                <form name='form_request' action="<?php $PHP_SELF; ?>" method="POST">
                <table border='0' width='770px' class="t">
                    <tr>
                        <td width="20%">Date Filed:</td>
                        <td><?php echo $d = ($result[0]) ? $result[0] : date("Y-m-d");?></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $_SESSION['fullname'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>Department:</td>
                        <td><?php echo $_SESSION['dept_name'];?></td>
                    </tr>
                    <tr>
                        <td>Subject/Purpose: <span class="a">*</span></td>
                        <td><input type='text' name='subject' value="<?php echo $result[1];?>" /></td>
                    </tr>
                <!--/<tr>
                        <td>Client/Branch: <span class="a">*</span></td>
                        <td><input type='text' name='client' value="<?php echo $result[2];?>"/></td>
                    </tr>/-->
                    <tr>
                        <td>Inclusive Dates: <span class="a">*</span></td>
                        <td><?php calendar1($result[2]); calendar2($result[3]);?></td>
                    </tr>
                    <tr>
                        <td>No. of Days: <span class="a">*</span></td>
                        <td><input type='text' name='no_of_days' id="days" size='1' value="<?php echo ($result[3]-$result[2]), $result[4]?>"/></td>
                    </tr>
                    <tr>
                        <!--//JD - Make code simplier //-->
                        <td valign="top">Equipment Type: <span class="a">*</span></td>
                        <!--/<table cellpadding="2" cellspacing="0" border="0" width="100%" height="100%">
                                <tr>
                                    <td>Equipment Type: <span class="a">*</span></td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
                        </td>/-->
                        <td>
                            <table border='0' width="100%">
                                <?php
								
                                    if(isset($_GET['ID'])){
                                        $items = explode("|", $result[5]);
                                        
                                        //JD-2012/06/14 - Added options for types of Projectors and Types of Wireless Internet Devices
                                        foreach($items as $item){
                                            if($item!="")
                                                $arr[] = $item; 
                                            /*if($item=="Projector"){
                                                $p_chk = "checked";*/
                                            if($item=="Epson White"){
                                                $ew_chk = "checked";
                                            }elseif($item=="Epson Emp 50"){
                                                $ee_chk = "checked";
                                            }elseif($item=="Panasonic"){
                                                $p_chk = "checked";
                                            }elseif($item=="Acer K-11"){
                                                $ac_chk = "checked";
                                            }elseif($item=="Laptop"){
                                                $l_chk = "checked";
                                            }elseif($item=="Flashdrive"){
                                                $f_chk = "checked";
                                            }elseif($item=="CPU"){
                                                $c_chk = "checked";
                                            }elseif($item=="Polycom"){
                                                $e_chk = "checked";
                                            }elseif($item=="Mouse"){
                                                $m_chk = "checked";
                                            }elseif($item=="Keyboard"){
                                                $k_chk = "checked";
                                            }elseif($item=="Monitor"){
                                                $mt_chk = "checked";
                                            }elseif($item=="Extension Cord"){
                                                $ec_chk = "checked";
                                            /*}elseif($item=="Wireless Internet Device"){
                                                $w_chk = "checked";*/
                                            }elseif($item=="Globe Tattoo"){
                                                $gt_chk = "checked";
                                            }elseif($item=="Smart Bro"){
                                                $sb_chk = "checked";
                                            }elseif($item=="Sun Broadband"){
                                                $su_chk = "checked";
                                            }elseif($item=="Others:"){
                                                $o_chk = "checked";
                                            }											
                                    	}
										echo '<tr>';
											echo '<td colspan="2"><b><label>Wireless Internet Device</b></label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Globe Tattoo" ',$gt_chk,' />Globe Tattoo</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Smart Bro" ',$sb_chk,' />Smart Bro</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Sun Broadband" ',$su_chk,' />Sun Broadband</label></td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td><label><b>Projector</b></label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Epson White" ',$ew_chk,' />Epson White</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Epson Emp 50" ',$ee_chk,' />Epson Emp 50</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Panasonic" ',$p_chk,' />Panasonic</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Acer K-11" ',$ac_chk,' />Acer K-11</label></td>';
										echo '</tr>';					
										echo '<tr>';
											echo '<td><label><input type="checkbox" name="type[]" value="CPU" ',$c_chk,'/>CPU</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Mouse" ',$m_chk,'/>Mouse</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Laptop" ',$l_chk,'/>Laptop</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Flashdrive" ',$f_chk,'/>Flashdrive</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Keyboard" ',$k_chk,'/>Keyboard</label></td>';
										echo '</tr>';		
										echo '<tr>';
											/*echo '<td><label><input type="checkbox" name="type[]" value="Projector" ',$p_chk,' />Projector</label>r</td>'; 
											echo '<td><label><input type="checkbox" name="type[]" value="Wireless Internet Device" ',$w_chk,'/>
											Wireless Internet Device</label></td>'; */
											echo '<td><label><input type="checkbox" name="type[]" value="Monitor" ',$mt_chk,'/>Monitor</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Extension Cord" ',$ec_chk,'/>Extension Cord</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Polycom" ',$e_chk,'/>Polycom</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Others:" ',$o_chk,' id="others">Others</label></td>';
										echo '</tr>';
										
										//display checkboxes
									}else{
										echo '<tr>';
											echo '<td colspan="2"><b><label>Wireless Internet Device</b></label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Globe Tattoo">Globe Tattoo</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Smart Bro">Smart Bro</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Sun Broadband">Sun Broadband</label></td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td><label><b>Projector</b></label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Epson White">Epson White</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Epson Emp 50">Epson Emp 50</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Panasonic">Panasonic</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Acer K-11">Acer K-11</label></td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td><label><input type="checkbox" name="type[]" value="CPU" />CPU</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Mouse" />Mouse</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Laptop" />Laptop</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Flashdrive" />Flashdrive</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Keyboard" />Keyboard</label></td>';
										echo '</tr>';		
										echo '<tr>';
											echo '<td><label><input type="checkbox" name="type[]" value="Monitor" >Monitor</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Extension Cord">Extension Cord</label></td>';
											echo '<td><label><input type="checkbox" name="type[]" value="Polycom" >Polycom</label></td>';
											echo '<td colspan="2"><label><input type="checkbox" name="type[]" value="Others:" id="others">Others</label></td>';												
										echo '</tr>';
									}
								?>
                    	    </table>
                    	</td>
					</tr>
                	<tr>
                        <td>Others (Please specify):</td>
                        <td><textarea name='others' id="f_others" rows='3' cols='90' disabled>
                        <?php
                            if(isset($_GET['ID'])){
                                $arr_item = array("Projector", "Laptop", "Flashdrive", "CPU", "Polycom", "Mouse", "Keyboard", "Monitor", "Extension Cord", "Wireless Internet Device");
                                $last = end($arr);
                                if(!in_array($last, $arr_item)){
                                    echo $last;
								}
							}
                        ?></textarea></td>
                    </tr>
                    <tr><td colspan='4'><hr/></td></tr>
                        <tr>
                        <?php
                            if($_GET['action']=="equip_edit"){
                                echo '<td><input type="submit" name="submit" value="update" class="update" onclick="return validate();"/></td>';
                            }else{
                                echo '<td><input type="submit" name="submit" value="submit" class="submit" onclick="return validate();"/></td>';
                            }
                        ?>
                        <td colspan="2" align="right">Fields marked with an asterisk <span class="a">*</span> are required.</td>
                    </tr>
                </table>
                </form>
            </div>
        <div id="footer">
            <br/>
            <p>Copyright 2011</p>
        </div>
        </div>
	</body>
</html>
<script type="text/javascript">
		var frmvalidator  = new Validator("form_request");
		frmvalidator.EnableMsgsTogether();
		frmvalidator.addValidation("subject","req","Please enter subject/purpose."); //parameters = name of form input, req, message to show
		//frmvalidator.addValidation("client","req","Please enter client/branch."); /JD-2012/06/11 - Disabled form validation for client
		frmvalidator.addValidation("no_of_days","req", "Please enter no. of days.");
</script>