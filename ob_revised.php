<?php
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);
	session_start();

	include("config_DB.php");
	include("functions.php");
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}	
	chk_active($_SESSION['user_id']);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>iEMS</title>
        <link rel='stylesheet' href='cssall.css' type='text/css' />
        
		<!--Export HTML TABLE to CSV-->
		<script src="excellentexport.js"></script>
		
		<!---->
		<script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        
		
        </script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
		$(function() {
			$( "#from" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1,
				onClose: function( selectedDate ) {
					$( "#to" ).datepicker( "option", "minDate", selectedDate );
				}
			});
			$( "#to" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1,
				onClose: function( selectedDate ) {
					$( "#from" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
			$("input[name='opt']").change(
				function()
				{
					if($(this).val() == '1')
					{
						$('#for').prop('disabled',false);
						$('#emp_name').prop('disabled',true);
					}//
					else
					{
						$('#for').prop('disabled',true);
						$('#emp_name').prop('disabled',false);
					}
				}//function
			);
		});
		</script>
	</head>
    <body alink="#1f57a0" vlink="#1f57a0" link="#1f57a0" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<form action="UI_Request_table.php" method="POST">
    	<div id="container">
            <?php include("menu.php");?>
        </div>
		<div id="container">
			<div id = "cc" style="width:480px">
				<div><span class = 'title'>Official Business Application</span></div>
				<table border = 0 width = 100% class = 't'>
					<tr>
						<td width = "20%">Date Filed: </td>
						<td><?php echo date('Y-m-d'); ?></td>
					</tr>
					<tr>
						<td>Name: </td>
						<td><?php echo $_SESSION['fullname'];?></td>
					</tr>
					<tr>
						<td>Department: </td>
						<td><?php echo $_SESSION['dept_name'];?></td>
					</tr>
					<tr>
						<td>Client/Branch: <span class="a">*</span> </td>
						<td><input type="text" name="client" required/></td>
					</tr>
					<tr>
						<td>Date of OB: <span class="a">*</span> </td>
						<td>
							<table>
								<tr>
									<td><label for = 'from'>From</label></td>
									<td><input type="text" id="from" name="from" value = <?php echo date("Y-m-d");?> required/></td>
									<td><label for = 'to'>To</label></td>
									<td><input type="text" id="to" name="to" value = <?php echo date("Y-m-d"); ?> required/></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>Purpose: <span class="a">*</span> </td>
						<td>
							<label><input type="checkbox" name="purpose[]" value="Network"/>Network</label>
							<label><input type="checkbox" name="purpose[]" value="Consultation"/>Consultation</label>
							<label><input type="checkbox" name="purpose[]" value="Delivery"/>Delivery</label>
							<label><input type="checkbox" name="purpose[]" value="Meeting"/>Meeting</label>
							<label><input type="checkbox" name="purpose[]" id="others" value="Others"/>Others</label></td>
						</td>
					</tr>
			</div>
		</div>
    	</form>
		
		<!--FOOTER--
    </body>
</html>