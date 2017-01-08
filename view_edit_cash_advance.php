<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("functions.php");
include('ps_pagination.php');
include("config_DB.php");

chk_active($_SESSION['user_id']);

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

if($_SESSION['rights']==1){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
}


if(isset($_POST['cancel_ot'])){
	$chk = $_POST['itemChk'];
	if(sizeof($chk)!=0){
		foreach($chk as $cancel){
			$qry = mysql_query("UPDATE ems_ot SET status='Cancelled' WHERE ot_id='$cancel' ");
			$acc = mysql_query("SELECT status FROM ems_accomplishments WHERE ot_id='$cancel' ");
			$result = mysql_result($acc, 0);
			if(!empty($result[0])){
				$qry_acc = mysql_query("UPDATE ems_accomplishments SET status='Cancelled' WHERE ot_id='$cancel' ");
			}
		}
	}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>iEMS</title>
		<link rel='stylesheet' href='cssall.css' type='text/css' />
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="navigation.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>

		<script type="text/javascript">
				  function open_win(ID, action){
					var left = parseInt((screen.availWidth/2) - (650/2));
					var top = parseInt((screen.availHeight/2) - (320/2));
					window.open("accomplishment.php?ID="+ID+"&action="+action,"_blank","toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=650, height=320");
				  }
		</script>
	</head>
	<body vlink="green" alink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
	<form name="form_view_ot" action="view_ot_request.php" method="POST">
		<div id="container">
			<?php include("menu.php"); ?>
            <div id="cc">
				<div><span class="title">Cash Advance Request</span></div>
					<div class="t">
						<table border="0'"width="100%" id="t_color">
							<tr>
								<td colspan="13">
									<table border='0' width="100%">
										  <tr>
											  <td>
											  Search by:
												  <select name="searchby">
															<option value="0">Any</option>
															<option value="1">Date Filed</option>
															<option value="2">OT Date</option>
															<option value="3">OT Status</option>
												  </select>

											  &nbsp;&nbsp;&nbsp;Search for:
											  <input type='search' name='search' placeholder="search here.."/>
											  <input type="submit" class="search" name="submit" value="search"/>
											  </td>
											  <td align="right">
												<a href="ca.php" class = 'a'>Apply Cash Advance</a>
											  </td>								  
										  </tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div id="footer"><br/>
					<p>Copyright 2011</p>     
				</div>
			</div>
		</form>
	</body>
</html>
