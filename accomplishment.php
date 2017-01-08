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

if(!isset($_SESSION['username'])){
	header("location: login.php");
	exit;
}
	
$timein = $_POST['timein'];
$timeout = $_POST['timeout'];
$hours = $_POST['hours'];
$output = $_POST['output'];           
$justi = $_POST['justi'];
$today = date("Y-m-d");

$ot_id = $_GET['ID'];
$action = $_GET['action'];

        if($action=="edit" || $action=="details"){
                //display records
                $qry = $dblink->db_qry("SELECT date_filed, time_in, time_out, no_of_hours, actual_output, justification
                       FROM ems_accomplishments
                       WHERE ot_id='$ot_id'");
                $get_data = $dblink->get_data($qry);
        }

        if(isset($_POST['submit']) && $_POST['submit']=="UPDATE"){
                $str = "UPDATE ems_accomplishments SET time_in='$timein', time_out='$timeout', no_of_hours='$hours',actual_output='$output',justification='$justi'
                       WHERE ot_id='$ot_id'";
                $qry = $dblink->db_qry($str);
                echo '<script>alert("Accomplishment Successfully Updated!");
						window.close();
						window.opener.location.reload();
						parent.refresh();</script>';
        }

        if(isset($_POST['submit']) && $_POST['submit']=="SUBMIT"){
                $str = "UPDATE ems_accomplishments SET time_in='$timein', time_out='$timeout', no_of_hours='$hours',actual_output='$output',justification='$justi', status='Pending'
                       WHERE ot_id='$ot_id'";
                $qry = $dblink->db_qry($str);
				send_email_pending("accomplishment report", $_SESSION['fullname'], $_SESSION['dept_code'], $_SERVER['HTTP_HOST']."/ems/view_ot_accomplishment.php"); //param(type of application, emp, dept) 
                echo '<script>
						alert("Accomplishment Successfully Added!");
						window.close();
						window.opener.location.reload();
						parent.refresh();</script>';

        }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="validator.js"></script>

<script type="text/javascript">

	function validate(){
		var time_in = document.getElementById('start').value;
		var time_out = document.getElementById('end').value;
		
			if(time_in=="--Select--" || time_out=="--Select--"){
				alert("Please fill-out required fields!");
				return false;
			}	
	
	}

	function calc(){
		var start = document.getElementById('start').value;
		var end = document.getElementById('end').value;
		var hours = document.getElementById('hours');

		if(start!="--Select--" && end!="--Select--"){
			if(parseInt(end)<=parseInt(start)){
				document.getElementById('ex').style.visibility = "visible";
				document.getElementById('ex1').style.visibility = "visible";
				hours.value = "";
			}else{
				document.getElementById('ex').style.visibility = "hidden";
				document.getElementById('ex1').style.visibility = "hidden";
				var x = end - start;
					if(x<60){
						if(x=="5"){
							hours.value = "0.05";
						}else{
							hours.value = "0."+x;
						}					
					}else if(x>=60){
						var y = (x/60);
						var round = y.toFixed(2);
						// var len = round.length;
						var dec = round.substr(-3);
						var get_per = (60 * dec);
						var r_val = Math.round(get_per);	
							if(r_val==5){
								r_val = "05";
							}
						var pos = round.indexOf(".");
						var get_num = y.toString().substr(0,pos);		
						var duration = get_num+"."+r_val;	
						hours.value = duration;
					}
			}
		}
	}
	
	$(document).ready(function(){
		
		$("#chk").click(function(){
			var chk = $(this).is(":checked");
			if(chk==true){
				// $("#start").load("time_2.php");
				$("#end").load("time_2.php");
			}else{
				$("#start").load("time_1.php");	
				$("#end").load("time_1.php");	
			}
		});
	

	});
	
</script>

</head>

<body>
<form name="form_acc" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validate();">
<div id="container">
		<div><span class="title">Accomplishment Report</span></div>    
                 <table border='0' width='100%' class="t">

                        <tr>
                            <td>Time-in: <span class="a">*</span></td>
                            <td>
								<select name='timein' id="start" onchange="calc();" style="padding:1px;">
										<?php
										if($get_data[1]){
											echo '<option value="',$get_data[1],'">',display_time($get_data[1]),'</option>';
										}								
										time_();	
										?>
								</select>
								<span class="ex" id="ex"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label><input type="checkbox" id="chk" name="chk"/>Mid-night application</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Time-out: <span class="a">*</span></td>
                            <td>
                            <select name='timeout' id="end" onchange="calc();" style="padding:1px;">
                                    <?php
									if($get_data[2]){
										echo '<option value="',$get_data[2],'">',display_time($get_data[2]),'</option>';
									}
									time_();	
                                    ?>
                            </select>&nbsp;
							<span class="ex" id="ex1"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>No. of hours rendered: <span class="a">*</span></td>
							<!-- TL-2012/01/02 - Added number format. -->
                            <td><input type='text' name="hours" size='2' value="<?php echo number_format($get_data[3], 2); ?>" id="hours"/>&nbsp;hr.min</td>
                        </tr>
                        <tr>
                            <td>Actual Output: <span class="a">*</span></td>
                            <td  ><textarea name='output' id="output" rows='3' cols='40'><?php echo $get_data[4]; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Justification: </td>
                            <td ><textarea name='justi' rows='3' cols='40'><?php echo $get_data[5]; ?></textarea></td>
							<td><span style="font-size:11px;">To be filled-out when actual<br/> no. of hours of OT work exceeds <br/>authorized no. of hours.</span></td>
                        </tr>
                        <tr><td  colspan='4'><hr/></td></tr>
                       <tr>
                           <?php
                                if($action=="add"){
                                     echo '<td><input type="submit" value="SUBMIT" name="submit" class="apply" onclick="return validate();"/></td>';
                                }elseif($action=="edit"){
                                     echo '<td>','<input type="submit" value="UPDATE" name="submit" class="update" onclick="return validate();"/>','</td>';
                                }elseif($action=="details"){
                                     // echo '<td><a href="javascript:window.close();"><img src="icons/cancel.png"></a></td>';
                                }
                           ?>
                       </tr>
                 </table>
            </div>
      </div>

</form>
</body>
</html>

<script type="text/javascript">
		var frmvalidator  = new Validator("form_acc");
		
		frmvalidator.EnableMsgsTogether();
		// frmvalidator.addValidation("timein","dontselect=0","Please select Time-in.");
		// frmvalidator.addValidation("timeout","dontselect=0","Please select Time-out.");
		frmvalidator.addValidation("hours","req","Please input number of hours.");
		frmvalidator.addValidation("hours","gt=0","Number of hours must be not less than or equal to zero.");
		// frmvalidator.addValidation("hours","num","Invalid number of hours.");
		frmvalidator.addValidation("output","req", "Please indicate your actual output.");
</script>
