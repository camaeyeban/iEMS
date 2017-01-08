<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("config_DB.php");
require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

if (!$dblink)
	die("no connection");

if(!isset($_SESSION['username'])){
	header("location: login.php");
	exit;
}

	$str = "SELECT emp_firstname, emp_lastname, ot.date_ot, a.no_of_hours, a.actual_output 
				FROM ems_accomplishments as a
				INNER JOIN ems_ot as ot
				ON ot.ot_id = a.ot_id
				INNER JOIN ems_employee as e
				ON e.emp_num = ot.emp_num
				WHERE ot.ot_id='$_GET[ID]' ";
	$qry = $dblink->db_qry($str);
	$result = $dblink->get_data($qry);
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

            <div>
                 <p class="title_pop">Overtime Rendered Details</p>
            </div>
            <div id="pop_up">
                 <table border='0' width='100%'>
					<tr>
						<td>Employee: </td>
						<td><?php echo $result[0]." ". $result[1];?></td>
					</tr>
					<tr>
						<td>Date OT: </td>
						<td><?php echo $result[2];?></td>
					</tr>
					<tr>
						<td>Hours/Days: </td>
						<td><?php echo $result[3];?></td>
					</tr>
					<tr>
						<td>Accomplished Task: </td>
						<td><textarea cols="60" rows="3" disabled="disabled"><?php echo $result[4];?></textarea></td>
					</tr>
					
					<tr><td colspan="2"><hr/></td></tr>

                 </table>
            </div>
      </div>
                
</div>
</form>
</body>
</html>


 