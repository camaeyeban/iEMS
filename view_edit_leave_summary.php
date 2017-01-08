<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include('ps_pagination.php');
include("config_DB.php");

require_once('calendar/classes/tc_calendar.php');
require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

include("functions.php");
chk_active($_SESSION['user_id']);
chk_invalid_url();

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

				
$strqry = "SELECT emp_num, emp_firstname, emp_middlename, emp_lastname FROM ems_employee WHERE emp_num='$_GET[ID]'";
$query = mysql_query($strqry);
$result = mysql_fetch_array($query);

$cmd = "SELECT value FROM ems_settings
			WHERE settingName='leaveCutOffStart' ";
$qry = $dblink->db_qry($cmd);
$cutoff_startDate = $dblink->get_data($qry);

$cmd = "SELECT value FROM ems_settings
			WHERE settingName='leaveCutOffEnd' ";
$qry = $dblink->db_qry($cmd);
$cutoff_endDate = $dblink->get_data($qry);

$str = "SELECT vl_balance, sl_balance FROM ems_benefits WHERE emp_num='$_GET[ID]'";
$qry = mysql_query($str);
$res = mysql_fetch_array($qry);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>

<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/home-format.css" rel="stylesheet">
<link href="css/profile-forms-format.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">

<script language="javascript" src="calendar/calendar.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
 	  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  		<link rel="stylesheet" href="/resources/demos/sss">

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>
<script>
$(function() {
	$("input[name='leave']").change(
				function()
				{
					if($(this).val() == 'vl')
					{
						$("table[name='vl']").show();
						$("table[name='sl']").hide();
					}//
					else
					{
						$("table[name='sl']").show();
						$("table[name='vl']").hide();
					}
				}//function
			);
});
</script>
</head>

<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
<div id="container">
	<?php include("menu.php"); ?>
	<?php include("side_menu.php");?>
<!--/TL-2012/03/29 - Added hidden field for cutoff. -->
<input type='hidden' name='cutoff_start' id="cutoff_start" value="<?php echo $cutoff_startDate[0];?>"/>
<input type='hidden' name='cutoff_end' id="cutoff_end" value="<?php echo $cutoff_endDate[0];?>"/>


	<div id="col-lg-12">
		<form action="<?php $PHP_SELF;?>" method="POST">
			<div class="right-form">
				<div class="container">
					<div class="page-header" style="width:70%">
					<h4><strong class="formTitle">  Leave Summary </strong></h4>						</div>
				</div>
			
			
			<div class="row col s12" style="margin-left:-10%;width:170%;">
				<div class="col s6" style="width:30%;">
					<label class="right-label">VACATION LEAVE </label>
				</div>
			</div>
			
			
					<table style='margin=left:0%;' border='0' width='100%' id="t_color" name = 'vl' style = 'display : none'>	
						<tr>
							<td colspan = 5 height = 10px/>
						</tr>
						<tr>
							<td colspan = 5 height = 10px/>
						</tr>
						<tr>
							<th width = 10%>Date From</th>
							<th width = 10%>Date To</th>	
							<th width = 10%>Number of Days</th>
							<th>Reason</th>
							<th>Remarks</th>
						</tr>
							<?php
								$sql = "SELECT d_from, d_to, no_of_days, reason, remarks FROM ems_leave where emp_num = '" . $_GET['ID'] . "' and type = 'Vacation Leave' and status = 'Approved' and d_from >= '". $cutoff_startDate[0] ."' and d_to <= '" . $cutoff_endDate[0] ."' order by 1 desc";
								$get = mysql_query($sql);
								$cnt = mysql_num_rows($get);
								$i = 0;
								$sum = 0;
								
								while($row = mysql_fetch_array($get))
								{	
								
									if($i == 0){
										echo "<tr><td colspan = 5></td></td><tr><td colspan = 5></td></td>"; $i++;}
									else
									{
										echo "<tr>
											<td colspan = 5><hr/></td>
										  </tr>";
										  
										  $i++;
									}
									
									echo "<tr>";
									echo "	<td width = 10%><center>" . $row[0] . "</center></td>";
									echo "	<td width = 10%><center>" . $row[1] . "</center></td>";
									echo "	<td width = 10%><center>" . $row[2] . "</center></td>";
									echo "	<td width = 45% style = 'padding-left : 5%'>" . $row[3] . "</td>";
									echo "	<td width = 15%>" . $row[4] . "</td>";
									echo "<tr>";
									
									$sum = $sum + $row[2];
									if($i == $cnt)
										echo "<tr>
											<td colspan = 5><hr/></td>
										  </tr>";
								}
								
								if($cnt == 0)
								{
									echo "<tr>
											<td colspan = 5><center><h3>Nothing to Display</h3></center</td>
										  </tr>";
								}
								
								echo "<tr>";
								echo "	<td colspan = 2 width = 10% style = 'text-align : right; font-weight : bold;'>Total Vacation Leave Balance</td>";
								echo "	<td width = 10%><center>" . $res[0] . "</center></td>";
								echo "	<td width = 45% style = 'padding-left : 5%'></td>";
								echo "	<td width = 15%></td>";
								echo "</tr>";
								echo "<tr>";
								echo "	<td colspan = 3><hr/></td>";
								echo "</tr>";
								echo "<tr>";
								echo "	<td colspan = 2 width = 10% style = 'text-align : right; font-weight : bold;'>Total Vacation Leave Used</td>";
								echo "	<td width = 10%><center>" . $sum . "</center></td>";
								echo "	<td width = 45% style = 'padding-left : 5%'></td>";
								echo "	<td width = 15%></td>";
								echo "</tr>";
								echo "<tr>";
								echo "	<td colspan = 3><hr/></td>";
								echo "</tr>";
								echo "<tr>";
								echo "	<td colspan = 2 width = 10% style = 'text-align : right; font-weight : bold;'>Total Vacation Leave Left</td>";
								echo "	<td width = 10%><center>" . ($res[0] - $sum) . "</center></td>";
								echo "	<td width = 45% style = 'padding-left : 5%'></td>";
								echo "	<td width = 15%></td>";
								echo "</tr>";
							?>
						<tr>
							<td colspan = 5><hr/></td>
						</tr>
				   </table>
				   <table border = 0 width='100%' id="t_color" name = 'sl' hidden>
						<tr>
							<td colspan = 5 height = 10px/>
						</tr>
						<tr>
							<td colspan="5" style="font-weight:bold;font-size:18px;color:#3b5998">Sick / Emergency Leave</td>
						</tr>
						<tr>
							<td colspan = 5 height = 10px/>
						</tr>
						<tr>
							<th width = 10%>DATE FROM</th>
							<th width = 10%>DATE TO</th>
							<th width = 10%>NUMBER OF DAYS</th>
							<th>REASON</th>
							<th>REMARKS</th>
						</tr>
							<?php	
								$sql = "SELECT d_from, d_to, no_of_days, reason, remarks FROM ems_leave where emp_num = '" . $_GET['ID'] . "' and type in ('Emergency Leave','Sick Leave') and status = 'Approved' and d_from >= '". $cutoff_startDate[0] ."' and d_to <= '" . $cutoff_endDate[0] ."' order by 1 desc";
								$get = mysql_query($sql);
								$cnt = mysql_num_rows($get);
								$i = 0;
								$sum = 0;
								
								while($row = mysql_fetch_array($get))
								{	
								
									if($i == 0){
										echo "<tr><td colspan = 5></td></td><tr><td colspan = 5></td></td>"; $i++;}
									else
									{
										echo "<tr>
											<td colspan = 5><hr/></td>
										  </tr>";
										  
										  $i++;
									}
									
									echo "<tr>";
									echo "	<td width = 10%><center>" . $row[0] . "</center></td>";
									echo "	<td width = 10%><center>" . $row[1] . "</center></td>";
									echo "	<td width = 10%><center>" . $row[2] . "</center></td>";
									echo "	<td width = 45% style = 'padding-left : 5%'>" . $row[3] . "</td>";
									echo "	<td width = 15%>" . $row[4] . "</td>";
									echo "<tr>";
									
									$sum = $sum + $row[2];
									if($i == $cnt)
										echo "<tr>
											<td colspan = 5><hr/></td>
										  </tr>";
								}
								
								if($cnt == 0)
								{
									echo "<tr>
											<td colspan = 5><center><h3>Nothing to Display</h3></center</td>
										  </tr>";
								}
								
								echo "<tr>";
								echo "	<td colspan = 2 width = 10% style = 'text-align : right; font-weight : bold;'>Total Sick Leave Balance</td>";
								echo "	<td width = 10%><center>" . $res[1]. "</center></td>";
								echo "	<td width = 45% style = 'padding-left : 5%'></td>";
								echo "	<td width = 15%></td>";
								echo "</tr>";
								echo "<tr>";
								echo "	<td colspan = 3><hr/></td>";
								echo "</tr>";
								echo "<tr>";
								echo "	<td colspan = 2 width = 10% style = 'text-align : right; font-weight : bold;'>Total Sick Leave Used</td>";
								echo "	<td width = 10%><center>" . $sum . "</center></td>";
								echo "	<td width = 45% style = 'padding-left : 5%'></td>";
								echo "	<td width = 15%></td>";
								echo "</tr>";
								echo "<tr>";
								echo "	<td colspan = 3><hr/></td>";
								echo "</tr>";
								echo "<tr>";
								echo "	<td colspan = 2 width = 10% style = 'text-align : right; font-weight : bold;'>Total Sick Leave Left</td>";
								echo "	<td width = 10%><center>" . ($res[1] - $sum) . "</center></td>";
								echo "	<td width = 45% style = 'padding-left : 5%'></td>";
								echo "	<td width = 15%></td>";
								echo "</tr>";
							?>
						<tr>
							<td colspan = 5><hr/></td>
						</tr>
				   </table>
		</div>
	</form>
</div>
</body>
</html>
