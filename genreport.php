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
	<script type="text/javascript" src="navigation.js"></script>
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
    <link href="css/home-format.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />

    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	<link rel='stylesheet' href='cssall.css' type='text/css' />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="jsFunctions.js"></script>
	<script type="text/javascript" src="validator.js"></script>
	<link rel="stylesheet" href="css/jquery-ui.css">
  	<script src="js/jquery-1.10.2.js"></script>
 	<script src="js/jquery-ui.js"></script>
  	<link rel="stylesheet" href="/resources/demos/sss">

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
			});
        </script>
		<link rel="stylesheet" href="css/jquery-ui.css">
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script>
		$(function() {
			$( "#from" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				numberOfMonths: 1,
				onClose: function( selectedDate ) {
					$( "#to" ).datepicker( "option", "minDate", selectedDate );
				}
			});
			$( "#to" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
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
						$('#allStatus').prop('disabled',false);
						$("input[name='emp_status[]']").each(function(){
							$(this).prop('disabled',false);
						});
					}//
					else
					{
						$('#for').prop('disabled',true);
						$('#emp_name').prop('disabled',false);
						$('#allStatus').prop('disabled',true);
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
    <?php include("menu.php");?>
	<form action="view_request_report.php" method="GET" name = "formReport" id = "formReport">
    <div id="container">
	
		<div class="container">
			<div class="page-header">
				<h4><strong class="formTitle"> EMPLOYEE REQUEST REPORT </strong></h4>
			</div>
		</div>
		
		<div class="row">
			<div class="input-field col s6" style="width:40%;margin-left:5%;">
				<input type="radio" name="opt" class="with-gap" checked="checked" value="1" id="dept"/><label for="dept" class="radio">DEPARTMENT</label>
				<select style='margin-left:37%;width:50%;margin-top:-8%;' name = 'for' id = 'for' class='form-control'><option value = 'All'>All</option><?php $get = mysql_query("SELECT dept_code, dept_name from ems_department");while($row = mysql_fetch_array($get)) echo "<option value = '" . $row[0] . "'/>" . $row[1] . "</option>";?></select>
			</div>
			<div class="input-field col s6" style="margin-left:-4%;padding:0%;">
				<input type="radio" name="opt" class="with-gap" value="2" id="emp"/><label style="margin-top:16%;" for="emp" class="radio">EMPLOYEE</label>
				<input style="font-size:115%;margin-left:50%;margin-top:-24%;" type = 'text' id = 'emp_name' name = 'emp_name' rows = '1' cols = 33 height = 40px placeholder = "Employee Name" disabled required />
			</div>
		</div>
		<div class="row" style="margin-left:0%;">
			<div class="input-field col s14">
				<input placeholder="Select Start Date" id="from" name="from" type="text" class="from1" value = <?php echo date("Y-m-d");?> required>
				<label class="from" for="from"><i class="fa fa-calendar"></i>  INCLUSIVE START DATE</label>
			</div>
			<div class="input-field col s15">
				<input type="text" style="display:none" name="lv_id" id="lv_id" value= "<?php echo $result[7] ?>"/>	
				<input placeholder="Select End Date" id="to" name="to" type="text" class="to1" value = <?php echo date("Y-m-d"); ?> required>
				<label class="to" for="to"><i class="fa fa-calendar"></i>  INCLUSIVE END DATE</label>
			</div>
		</div>
		<div class="row" style="margin-top:-0.5%;">
			<div class="input-field col s4">
				<label style="font-size:110%; margin-left:22%;"><i class="fa fa-briefcase"></i>  RECORDS TYPE: </label>
			</div>
			<div class="input-field col s4" style="margin-left:-7%;margin-top:-.3%;">
				<input type='radio' class='with-gap' name='type' id='allR' value='allR' checked/><label for='allR' class="radio"> COMPLETE RECORD </label>
			</div>
			<div class="input-field col s4" style="margin-left:-20%;margin-top:-.3%;">
				<input type='radio' class='with-gap' name='type' id='recO' value='recO'/><label for="recO" class="radio"> DATE(S) W/ EXISTING REQUEST ONLY </label>
			</div>
		</div>
		<hr style="width:56%;margin-left:15%;margin-top:2%;">
		<div class="row" style="margin-top:-0.5%;">
			<div class="input-field col s4">
				<label style="font-size:110%; margin-left:22%;"><i class="fa fa-briefcase"></i> STATUS: </label>
			</div>
			<div class="input-field col s6" style="margin-left:-15.6%;margin-top:.7%;">
			
			<?php
				$get = mysql_query("SELECT name from ems_emp_status");
				
				if(mysql_num_rows($get) > 0)
				{
					echo '<input type="checkbox" class="filled-in" id="allStatus" name="allStatus" /><label for="allStatus" class="checkbox"> ALL</label>';
				}
				
				$i = 0;
				while($row = mysql_fetch_array($get)) {
					echo ($row[0] == 'Probationary' || $row[0] == 'Regular' || $row[0] == 'Consultant')? "<input type = 'checkbox' class = 'filled-in status' id = 'emp_status" .$i. "' name = 'emp_status[]' value = '" . $row[0] . "' checked/><label for='emp_status" .$i. "' class='checkbox'>" . $row[0] . "</label>"
							: "<input type = 'checkbox' class = 'filled-in status' id = 'emp_status' name = 'emp_status[]' value = '" . $row[0] . "'/><label for='emp_status" .$i. "' class='checkbox'>" . $row[0] . "</label>";
					$i++;
				}
			?>
			</div>
		</div>
		<hr style="width:56%;margin-left:15%;margin-top:2%;">
		<div class="row" style="margin-top:-0.5%;">
			<div class="input-field col s4">
				<label style="font-size:110%; margin-left:22%;"><i class="fa fa-briefcase"></i> REQUEST(S) </label>
			</div>
			<div class="input-field col s6" style="margin-left:-15.6%;margin-top:.7%;width:23%;">
				<input type="checkbox" class="filled-in request" id="allRequest" name="allRequest" /><label for="allRequest" class="checkbox"> ALL</label>
				<input type="checkbox" class="filled-in request" id="request1" name="request[]" value = 'OT'/><label for="request1" class="checkbox"> OVERTIME</label>
				<input type="checkbox" class="filled-in request" id="request2" name="request[]" value = 'UT'/><label for="request2" class="checkbox"> UNDERTIME</label>
				<input type="checkbox" class="filled-in request" id="request3" name="request[]" value = 'VL'/><label for="request3" class="checkbox"> VACATION LEAVE</label>			
			</div>
			<div class="input-field col s6"style="margin-left:-9.7%;margin-top:0.7%;width:25%;">
				<input type="checkbox" class="filled-in request" id="request4" name="request[]" value = 'SL'/><label for="request4" class="checkbox"> SICK LEAVE</label>
				<input type="checkbox" class="filled-in request" id="request5" name="request[]" value = 'OB'/><label for="request5" class="checkbox"> OFFICIAL BUSINESS</label>
				<input type="checkbox" class="filled-in request" id="request6" name="request[]" value = 'OS'/><label for="request6" class="checkbox"> OFFSET</label>		
			</div>
		</div>
		<hr style="width:56%;margin-left:15%;margin-top:2%;">
		<div class="row" style="margin-top:-0.5%;">
			<div class="input-field col s4">
				<label style="font-size:110%; margin-left:22%;"><i class="fa fa-briefcase"></i>  REQUEST STATUS: </label>
			</div>
			<div class="input-field col s4" style="margin-left:-7%;margin-top:-.3%;">
				<input type='radio' class='with-gap' name='status' id='status' value='Approved' checked/><label for='allR' class="radio"> APPROVED </label>
			</div>
			<div class="input-field col s4" style="margin-left:-20%;margin-top:-.3%;">
				<input type='radio' class='with-gap' name='status' id='status' value='Pending'/><label for="recO" class="radio"> PENDING </label>
			</div>
		</div>
		<hr style="width:56%;margin-left:15%;margin-top:2%;">
		<input style="margin-left:16%!important;margin-top:1%!important;" type="submit" name = 'genreport' value="Generate Report" class="btn btn-success" /></center>	
		</div>
	</div>
    	</form><br><br><br><br>
		
		<?php include("footer.php"); ?>
		
    </body>
</html>