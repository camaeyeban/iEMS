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
	
	//if($_SESSION['rights']==2 OR $_SESSION['rights']==5){
	//		echo '<h1>',"Invalid URL!",'</h1>';
	//		return false;
	//}

	
	function dateDiff($start, $end){
		$val = strtotime($start) - strtotime($end);
		return $val/60/60/24;
	}
	
	$qry_num = mysql_query("SELECT time_id FROM ems_time ORDER BY time_id DESC");
	$count = mysql_num_rows($qry_num);
		if($count==0){
			$ID = "trs-0001";
		}else{
			$qry_id = mysql_result($qry_num, 0);
			$ID = auto_num($qry_id);
		}
	
	$today = date("Y-m-d");
	$emp_num = $_SESSION['emp_num'];
	/*$strqry = "SELECT emp_num, dateFiled, time_in, time_out, status FROM ems_time
					WHERE time_id='$_GET[ID]'";
	$qry = $dblink->db_qry($strqry);
	$result = $dblink->get_data($qry);
	*/
	
	if(isset($_POST['tIn'])){ //checks if empnum is not empty!
		$str = "INSERT INTO ems_time (time_id, emp_num, dateFiled, time_in)
			VALUES ('$ID', '$emp_num','$today', NOW())";
		$qry = $dblink->db_qry($str);
		
		/*echo '<script>window.location = \'ems_time_summary.php\';</script>';*/
	}else if(isset($_POST['tOut'])){ //JD-2013/04/24 - Added condition for validating form fields!
		$str = "UPDATE ems_time SET time_out=Now() WHERE dateFiled='$today'";
		/*echo '<script type="text/javascript">alert("Please fill in the required fields!");</script>'; 
		echo '<script>window.location = \'leave_mngr.php\';</script>';*/
		//return false;
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
    </head>
    <body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
        <form name="form_leave" action="<?php $PHP_SELF;?>" method="POST" />
            <div id="container">
                <?php include("menu.php"); ?>
                <?php
					echo '<div id="cc" style="width:600px;">';
					$wid = "'style='width:670px;'";
                ?>
                <div>
                	<span class="title">iEMS Time-in/Time-out</span>
                </div>
                <div class="t" <?php echo $wid; ?>>
                    <table border='0' width="100%">
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td width="25%" style="padding: 0 0 0 10px;">Date Today: </td>
                            <td style="padding: 0 0 0 10px;">
								<?php echo $d = ($result[0]) ? $result[0] : date("Y-m-d");?>
                            </td>
                        </tr>
                        <!--/ <tr>
                            <td width="25%" style="padding: 0 0 0 10px;">Current Time: </td>
                            <td style="padding: 0 0 0 5px; font-weight: bolder; color: red;">
								<input type="text" name="emp_num" value="<?php echo ''; ?>"  />
                            </td>
                        </tr> /-->
                        <tr>
                        	<td width="25%" style="padding: 0 0 0 10px;">
                            	
                            </td>
                            <td>
                            	<hr />
                            	<table border="0" width="60%" cellpadding="5" cellspacing="1">
                                	<tr>
                                    	<td colspan="2"></td>
                                    </tr>
                                	<tr>
                                    <?php
									
										$dateToday = date("Y-m-d H:i:s"); //define the date today in MySQL format
										$strqry = "SELECT emp_num, dateFiled, time_in, time_out, remarks, status FROM ems_time";
										$data = $dblink->db_qry($strqry);

										if(($data[2]==NULL)){
											echo '<td align="center">
												<input type="submit" name="tIn" value="Time In" title="Click to register time of arrival." style="height: 100px; width: 100px;" />
											</td>';
											echo '<td align="center">
												<input type="submit" name="tOut" value="Time Out" title="Register first your time of arrival!" style="height: 100px; width: 100px;" disabled="disabled" />
											</td>';
										}else{
											echo '<td align="center">
												<input type="submit" name="tIn" value="Time In" title="You have already logged-in today." style="height: 100px; width: 100px;" disabled="disabled" />
											</td>';
											echo '<td align="center">
												<input type="submit" name="tOut" value="Time Out" title="You have already logged-out today." style="height: 100px; width: 100px;" disabled="disabled" />
											</td>';	
										}
									?>
                                    </tr>
                                </table>
                        	</td>
                        </tr>
                        <tr>
                            <td colspan="2"><br /><hr /></td>
                        </tr>
                        <tr>
                        	<td colspan="2"><?php echo $str; ?></td>
                        </tr>
                    </table>
            	</div>
			</div>
        </form>
        <div id="footer">
            <br/><p>Copyright 2011</p>     
        </div>
    </body>
</html>