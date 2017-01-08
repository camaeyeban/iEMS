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
		<style type = 'text/css'>

		</style>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        
		<!--tabs-->
        <link rel="stylesheet" href="tabs.css" type="text/css">
        <script type="text/javascript" src="jquery.tools.min.js"></script>
        <script type="text/javascript" src="easy.notification.js"></script>
        <script type="text/javascript" src="jquery.cookie.js"></script>
        <!--
            <link href="jquery-ui.css" rel="stylesheet" type="text/css"/>
            <script src="jquery-ui.min.js"></script>
            <script src="jquery.tools.min.js"></script>
            
            <link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />
            <script type="text/javascript" src="uploadify/swfobject.js"></script>
            <script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.min.js"></script>
        -->
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
			});
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
						
						$("input[name='emp_status[]']").each(function(){
							$(this).prop('disabled',false);
						});
					}//
					else
					{
						$('#for').prop('disabled',true);
						$('#emp_name').prop('disabled',false);
						
						$("input[name='emp_status[]']").each(function(){
							$(this).prop('disabled',true);
							$(this).prop('checked',false);
						});
					}
				}//function
			);
			$("#allRequest").click(
				function()
				{
					if(this.checked) { // check select status
						$(".request").each(function() { //loop through each checkbox
							this.checked = true;  //select all checkboxes with class "checkbox1"               
						});
					}
					else{
						$(".request").each(function() { //loop through each checkbox
							this.checked = false; //deselect all checkboxes with class "checkbox1"                       
						});  
					}
				}//function
			);
			$("#allStatus").click(
				function()
				{
					if(this.checked) { // check select status
						$(".status").each(function() { //loop through each checkbox
							this.checked = true;  //select all checkboxes with class "checkbox1"               
						});
					}
					else{
						$(".status").each(function() { //loop through each checkbox
							this.checked = false; //deselect all checkboxes with class "checkbox1"                       
						});  
					}
				}//function
			);
			$("#formReport").submit(function(){
				var checked = $('input[name="emp_status[]"]:checked').length > 0;
				
				if (!checked && !$('#for').prop('disabled')){
					alert("Please check at least one checkbox in Employee Status");
					return false;
				}
				var checked = $('input[name="request[]"]:checked').length > 0;
				if (!checked){
					alert("Please check at least one checkbox in Request(s)");
					return false;
				}
			});
		});
		</script>
	</head>
    <body alink="#1f57a0" vlink="#1f57a0" link="#1f57a0" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    	<form name="form_view_ot" action="generateGeneralReport.php" method="POST">
    	<div id="container">
            <?php include("menu.php");?>
        </div>
		<div id="container">
			<div id = "cc">
				<div>
					<span class="title">Request Cash Advance</span>
				</div>	
				<div class = 't' style = 'display : inline-block;'>
					<br/>
					<br/>
					<table border = 0>
						<tr>
							<td><label for = 'from'>From</label><input type="text" id="from" name="from" value = <?php echo date("Y-m-d"); ?> /></td>
							<td><label for = 'to'>To</label><input type="text" id="to" name="to" value = <?php echo date("Y-m-d"); ?> /></td>
						</tr>
						<tr>
							<td>Client</td>
							<td><input type = 'text' name = 'client' required/></td>
						<tr>
					</table>
					
					
					<center><input type="submit" value = 'Request' style = 'background-color: light blue;'/></center>
				</div>
			</div>
		</div>
    	</form>
    </body>
</html>