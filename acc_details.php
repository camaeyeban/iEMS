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

$remarks = $_POST['remarks'];
if(isset($_POST['submit']) && $_POST['submit']=="apply"){
			$qry = $dblink->db_qry("UPDATE ems_accomplishments SET remarks='$remarks' WHERE ot_id='$_GET[ot_id]' ");
			echo '<script>window.close();
                     window.opener.location.reload();
                     parent.refresh();</script>';
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
<script type="text/javascript" src="jquery.js">
</script>

<script type="text/javascript">


</script>

</head>

<body>
<form name="form_acc" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<div id="container">
	<div><span class="title">Accomplishment Report</span></div>   
                 <table border='0' width='100%' class="t">
					<?php
						
						$str = "SELECT ot.date_ot, a.date_filed, a.time_in, a.time_out, a.no_of_hours, a.actual_output, a.justification, a.remarks, emp_firstname, emp_lastname
									FROM ems_accomplishments as a
									JOIN ems_ot as ot
									ON ot.ot_id = a.ot_id
									JOIN ems_employee as e
									ON e.emp_num = ot.emp_num
									WHERE ot.ot_id='$_GET[ot_id]'";
						$qry = $dblink->db_qry($str);	
						$result= $dblink->get_data($qry);
						?>
					
					<tr>
						<td colspan="2">Employee: <?php echo $result[8]." ".$result[9] ;?></td>
					</tr>
					<tr>
						<td colspan="2">Overtime request as of <?php echo $result[1];?></td>
					</tr>
					<tr><td colspan="2"><hr/></td></tr>
					<tr>
						<td width="40%">Date OT: </td>
						<td><?php echo $result[0]; ?></td>
					</tr>
					<tr>
						<td>Time-in: </td>
						<!-- TL-2012/01/02 - Added display_time() -->
						<td><?php echo display_time($result[2]); ?></td>
					</tr>
					<tr>
						<td>Time-out: </td>
						<!-- TL-2012/01/02 - Added display_time() -->
						<td><?php echo display_time($result[3]); ?></td>
					</tr>
					<tr>
						<td>No. of hours rendered: </td>
						<!-- TL-2012/01/02 - Added number format. -->
						<td><?php echo number_format($result[4],2); ?></td>
					</tr>
					<tr>
						<td>Actual Output: </td>
						<td><div style="height:60px; width: auto; overflow: auto; text-align: justify; border: 1px solid #ccc;"><?php echo $result[5]; ?></div></td>
					</tr>
					<tr>
						<td>Justification: </td>
						<td><div style="height:60px; width: auto; overflow: auto; text-align: justify; border: 1px solid #ccc;"><?php echo $result[6]; ?></div></td>
					</tr>
					<tr>
						<td colspan="2" align="right"><input type="button" class="close" onclick="window.close();"/></td>
					</tr>
                 </table>
            </div>
      </div>
</form>
</body>
</html>


 