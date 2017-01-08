<?php	
	ob_start();
	session_start();
	include("config_DB.php");
	
	if($_GET['action'] == 'DELETE')
	{
		$sql = 'DELETE FROM ems_special_days where id = ' . $_GET['ID'];
		
		if($get = mysql_query($sql))
		{
			echo "<script>alert('Successfully Deleted : ".  $_GET['name'] ."');</script>";
			header('location:special_days.php');
		}
	}
	
	if($_POST['editdays'] == 'Edit Record')
	{
		$sql = "update ems_special_days set date_from = '" . $_POST['from'] . "', date_to = '" . $_POST['to'] ."', name = '" . $_POST['name'] . "', type = '" . $_POST['type'] ."' where id = '" . $_GET['ID'] . "'";
		$get = mysql_query($sql);
		
		if(!$get)
			die(mysql_error());
		else
		{
			echo "<script>alert('Successfully Edited : ". $_POST['name'] ."\non " . $_POST['from'] . " to " . $_POST['to'] ."');</script>";
			header('location:special_days.php');
		}
	}
	elseif($_POST['editdays'] == 'Cancel')
		header('location:special_days.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>iEMS</title>
        <link rel='stylesheet' href='cssall.css' type='text/css' />
		<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="assets/js/materialize.min.js"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
		
		<!---->
		<script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        
        <!--tabs-->
        <link rel="stylesheet" href="tabs.css" type="text/css">
        <script type="text/javascript" src="jquery.tools.min.js"></script>
        <script type="text/javascript" src="easy.notification.js"></script>
        <script type="text/javascript" src="jquery.cookie.js"></script>
    
		<script type="text/javascript">
            $(document).ready(function(){
				function load_lv(ID,action){
					window.open("leave_undertime.php?ID="+ID+"&action="+action,"_self");
				}
				function load_un(ID,action){
					window.open("leave_undertime.php?ID="+ID+"&action="+action,"_self");
				}
				function load_ot(ID,action){
					window.open("ot.php?ID="+ID+"&action="+action,"_self");
				}
				function load_ob(ID,action){
					window.open("ob.php?ID="+ID+"&action="+action,"_self");
				}
				function load_off(ID,action){
					window.open("offset.php?ID="+ID+"&action="+action,"_self");
				}	  
				function load_rsrv(ID,action){
					window.open("equip_request.php?ID="+ID+"&action="+action,"_self");
				}	  
				function load_air(ID,action){
					window.open("airticket.php?ID="+ID+"&action="+action,"_self");
				}
			}
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
				changeYear: false,
				numberOfMonths: 1,
				onClose: function( selectedDate ) {
					$( "#to" ).datepicker( "option", "minDate", selectedDate );
				}
			});
			$( "#to" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: false,
				numberOfMonths: 1,
				onClose: function( selectedDate ) {
					$( "#from" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
		});
		</script>
		<script type="text/javascript">
		function doClick(){
			var x = confirm("Are you sure you want to edit this event?");
			if(x) return true;
			else return false;
		}
		</script>
	</head>
    <body alink="#1f57a0" vlink="#1f57a0" link="#1f57a0" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    	<div id="container">
            <?php include("menu.php");?>
			<form method = "POST" action="<?php $PHP_SELF;?>">
			
				
			<?php
				if($_GET['action'] == 'EDIT')
				{
					$sql = 'SELECT * FROM ems_special_days where id = ' . $_GET['ID'];
					$get = mysql_query($sql);
					
					if(mysql_num_rows($get) > 0)
					{
						echo '<div class="container">';
						echo '		<div class="page-header" style="width:79%!important;">';
						echo '			<h4><strong class="formTitle"> SPECIAL DAYS </strong></h4>';
						echo '		</div>';
						echo '	</div>';
						
						while($row = mysql_fetch_array($get))
						{
							echo '	<div class="row" style="margin-left:1%;margin-top:-1%;"><br><br>';
							echo '		<div class="input-field col s14">';
							echo "		  <input placeholder='Select Start Date' id='from' name='from' type='text' class='from1' value = '" . $row[1] . "' required/>";
							echo '		  <label class="from" for="from"><i class="fa fa-calendar"></i>  INCLUSIVE START DATE</label>';
							echo '		</div>';
							echo '		<div class="input-field col s15">';
							echo "		  <input placeholder='Select End Date' id='to' name='to' type='text' class='to1' value = '" . $row[2] . "' required>";
							echo '		  <label class="to" for="to"><i class="fa fa-calendar"></i>  INCLUSIVE END DATE</label>';
							echo '		</div>';
							echo '	</div>';
							
							echo '<div class="row" style="margin-left:1%;margin-top:-1%;">';
							echo '	<label style="font-size:13px; margin-left:16.5%;"><i class="fa fa-user"></i>  NAME:&nbsp;*&nbsp;</label>';
							echo "	<input style='width:30%!important;text-align:left!important;' type='text' class='input_fields1' name='name' id = 'name' value = '" . $row[3] . "' required/> ";
							echo '</div><br>';
							
							echo '<div class="row" style="margin-left:1%;margin-top:-1%;">';
							echo '	<label style="font-size:13px; margin-left:16.5%;"><i class="fa fa-user"></i>  TYPE:&nbsp;*&nbsp;</label>';
							echo "	<input style='width:30%!important;text-align:left!important;' type='text' class='input_fields1' name='type' id = 'type' value = '" . $row[4] . "' required/> ";
							echo '</div><br>';
						}
						
					
						echo "			<div class='row' style='margin-top:-1.5%;'><hr style='margin-left:17%;width:64%;'></div>
										<div class='row' style='margin-left:-62%;'><center><input type = 'submit' name = 'editdays' value = 'Edit Record' class='btn btn-primary' onclick = 'return doClick()'/>
										<input style='margin-left:0%!important;' type = 'submit' name = 'editdays' value = 'Cancel' class='btn btn-primary' /></center>";
					
					
						echo "</form>";
						echo "</div>";
					}
				}ob_flush();
			?>
        </div>
    </body>
</html>