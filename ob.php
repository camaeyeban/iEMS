<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);
date_default_timezone_set('Asia/Taipei');


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

if($_SESSION['rights']==1){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
}
require_once("calendar/classes/tc_calendar.php");


if(isset($_GET['action'])){
	//TL-2011/10/27 - added date_filed
		$str = "SELECT ob_date, client_branch, purpose, remarks, departure, time_start, time_end, duration, arrival, total, status, ob_id, date_filed, ob_dtype
					FROM ems_ob_new WHERE ob_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		$result = $dblink->get_data($qry);
}


//creatig id...
$qry_num = mysql_query("SELECT ob_id FROM ems_ob_new ORDER BY ob_id DESC");
$count = mysql_num_rows($qry_num);
	if($count==0){
		$ID = "ofb-0001";
	}else{
		$qry_id = mysql_result($qry_num, 0);
		$ID = auto_num($qry_id);
	}
//TL-2011/10/27 - Added time in $today.
$today = date("Y-m-d H:i");
//$ob_from = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
//$ob_to = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
$client = $_POST['client'];
$status = $_POST['status'];
$remarks  = $_POST['remarks'];
$others = trim($_POST['others']."|");
$purpose = $_POST['purpose'];
	
$departure = $_POST['departure'];
$duration = $_POST['duration'];
$arrival = $_POST['arrival'];
$total = $_POST['total'];



if($others=="|"){
	$others = "";
}



if(isset($_POST['submit']) && $_POST['submit']=="submit"){	
	$today = date("Y-m-d H:i");
//$ob_from = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
//$ob_to = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
$client = $_POST['client'];
$status = $_POST['status'];
$remarks  = $_POST['remarks'];
if($_POST['others'] == "")
{
	$others = "";
}
else
{
	$others = trim($_POST['others']."|");
}

$purpose = $_POST['purpose'];
	
$departure = $_POST['dept'];
$duration = $_POST['duration'];
$arrival = $_POST['arrival'];
$total = $_POST['total'];

	if($_POST['dates']=="Single Day"){
		$ob_dtype = 'sd';
		$dates = $_POST["date_fr"];
	
		$time_start = $_POST['start'];
		$time_end = $_POST['end'];
	}
	else{
		$ob_dtype = 'md';
		$days_n = $_POST['n_dates'];

	
		for($i = 0; $i < $days_n; $i++){
			$dates = $dates . $_POST["date_".$i] . " | ";
			$time_start = $time_start . $_POST["stime_".$i] . " | ";
			$time_end = $time_end . $_POST["etime_".$i] . " | ";

		}	

		$total = '';

		for($j = 0; $j < $days_n; $j++)
		{	$start_time = date("H:i", strtotime($_POST['stime_'.$j]));
			$end_time = date("H:i", strtotime($_POST['etime_'.$j]));
			$diff = getTimeDiff($start_time, $end_time);
			$total = $total . $diff . '|';
		}

		$departure = $time_start;
		$arrival = $time_end;
		$duration = $total;

	}

	// status
	$date = date('Y-m-d', strtotime($_POST["date_fr"]));
	$todate =  date('Y-m-d');
	if($date >= $todate)
		{
			$status = "Pending for Confirmation";
		}
	else{
			$status = "Pending for Approval";
		}

foreach($purpose as $i){
	if($i!=""){ 	
		$item = $item.$i."|";
	}
}

	$str = "INSERT INTO ems_ob_new (ob_id, emp_num, date_filed, client_branch, ob_dtype, ob_date, purpose, status, remarks, departure, time_start, time_end, duration, arrival, total)
				VALUES ('$ID', '$_SESSION[emp_num]','$today','$client', '$ob_dtype', '$dates', '$item$others','$status','$remarks','$departure ','$time_start','$time_end','$duration','$arrival','$total')";
	$qry = $dblink->db_qry($str); 
	send_email_pending("official business request", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_ob_request.php"); //param(type of application, emp, dept)
	echo '<script>window.location = \'view_edit_ob.php\';</script>';

}elseif(isset($_POST['submit']) && $_POST['submit']=="update"){
	$today = date("Y-m-d H:i");
$client = $_POST['client'];
$status = $_POST['status'];
$remarks  = $_POST['remarks'];
if($_POST['others'] == "")
{
	$others = "";
}
else
{
	$others = trim($_POST['others']."|");
}
$purpose = $_POST['purpose'];
	
$departure = $_POST['dept'];
$duration = $_POST['duration'];
$arrival = $_POST['arrival'];
$total = $_POST['total'];

	if($_POST['dates']=="Single Day"){
		$ob_dtype = 'sd';
		$dates = $_POST["date_fr"];
		$time_start = $_POST['start'];
		$time_end = $_POST['end'];
	}
	else{
		$ob_dtype = 'md';
		$days_n = $_POST['n_dates'];

		for($i = 0; $i < $days_n; $i++){
			$dates = $dates . $_POST["date_".$i] . " | ";
			$time_start = $time_start . $_POST["stime_".$i] . " | ";
			$time_end = $time_end . $_POST["etime_".$i] . " | ";

		}	

		$total = '';

		for($j = 0; $j < $days_n; $j++)
		{	$start_time = date("H:i", strtotime($_POST['stime_'.$j]));
			$end_time = date("H:i", strtotime($_POST['etime_'.$j]));
			$diff = getTimeDiff($start_time, $end_time);
			$total = $total . $diff . '|';
		}
	}
	$date = date('Y-m-d', strtotime($_POST["date_fr"]));
	$todate =  date('Y-m-d');
	if($date >= $todate)
		{
			$status = "Pending for Confirmation";
		}
	else{
			$status = "Pending for Approval";
		}

	foreach($purpose as $i){
		if($i!=""){
			$item = $item.$i."|";
		}
	}
		$str = "UPDATE ems_ob_new SET client_branch='$client', ob_dtype='$ob_dtype', ob_date='$dates', purpose='$item$others', remarks='$remarks', departure='$departure', time_start='$time_start', time_end='$time_end', duration='$duration', arrival='$arrival', total='$total', status='$status'
					WHERE ob_id='$_GET[ID]' ";	
	$qry = $dblink->db_qry($str);
	header("location:view_edit_ob.php");	
}
if(isset($_GET['action']) && $result[1]!="0000-00-00"){
	$chk = "checked disabled";
}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
<head>
		<!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
    
	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link href="css/home-format.css" rel="stylesheet">
		
    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="calendar/calendar.js"></script>
	<link rel='stylesheet' href='cssall.css' type='text/css' />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="navigation.js"></script>
	<script type="text/javascript" src="jsFunctions.js"></script>
	<script type="text/javascript" src="validator.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/redmond/jquery-ui.css" />
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<!--datepicker-->
    <link href="calendar/calendar.css" rel="stylesheet" type="text/css">
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
 	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  	<link rel="stylesheet" href="/resources/demos/sss">

	<!--timepicker-->

  	<link rel="stylesheet" type="text/css" href="jquery.ptTimeSelect.css" />
	<script type="text/javascript" src="jquery.ptTimeSelect.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#b2").click(function(){
				$("#sday").hide("slow");
				$("#mdays").show("slow");
			});
			$("#b1").click(function(){
				$("#mdays").hide("slow");
				$("#sday").show("slow");
			});
			console.log("pasok");
		});
	</script>
<script type="text/javascript">
		var days_n = 0;
		$(function() {
    		$( "#date_fr" ).datepicker({
      			onSelect: function(dataText, inst){
      				$("#date_to").focus();
        	  		document.getElementById("dates[0]").value = dataText;
        	  		document.getElementById("s_times[0]").disabled = false;
     				document.getElementById("e_times[0]").disabled = false;
     				document.getElementById("s_times[0]").value = "8:30 am";
     				document.getElementById("e_times[0]").value = "6:30 pm";
      				isDateValid();
      				total_duration();

        		}

      		});
			
    	});
		$(function() {
    		$( "#date_fr1" ).datepicker({
      			onSelect: function(dataText, inst){
      				$("#date_to").focus();
        	  		document.getElementById("dates[0]").value = dataText;
        	  		document.getElementById("s_times[0]").disabled = false;
     				document.getElementById("e_times[0]").disabled = false;
     				document.getElementById("s_times[0]").value = "8:30 am";
     				document.getElementById("e_times[0]").value = "6:30 pm";
      				isDateValid();
      				total_duration();

        		}

      		});
			
    	});
		$(function() {
    		$( "#date_to" ).datepicker({
      			onSelect: function(dataText, inst){
      				$("#multi_data").show();
        			clear_clone(days_n);
      				clone(dateDifference());
      			}
      		});
    	});

		function checkOBDate(ob_date)
		{	$ob_id = document.getElementById('ob_id').value;
			$ob_date = ob_date;
			$.post('checkOBDate.php', { date_fr: $ob_date, ob_id: $ob_id }, function(result) { 
				if(result > 0)
				{
					alert("You have an existing Approved or Pending Request on the date "+$ob_date+".\nWait for your manager's approval or cancel your existing request.");
					clear_clone(days_n);
					$( "#date_fr" ).datepicker('setDate', null);
					$( "#date_fr" ).datepicker('hide');
					$( "#date_to" ).datepicker('setDate', null);
		     		document.getElementById("dates[0]").value = null;
		     		document.getElementById("s_times[0]").disabled = true;
		     		document.getElementById("e_times[0]").disabled = true;
					$( "#date_fr" ).focus();							
				}
				else{}
			});
		}
    	
    	function isDateValid()
   	  	{	$("#date_fr").datepicker('hide');
   	  		$ob_id = document.getElementById('ob_id').value;
   	  	
   	  		if(days_n > 0)
	   	  	{	$dates = [];
	   	  		for(var i = 0; i < days_n; i++)
	   	  		{	$dates.push(document.getElementById("dates["+i+"]").value);
	   	  			
	   	  		}
	   	  		jQuery.each($dates, function() {
					checkOBDate(this);
				});
	   	  	}
	   	  	else
	   	  	{	
	   	  		$date = document.getElementById("dates[0]").value;
				checkOBDate($date);
	   	  	}
   	  	}

    		function dateDifference() {
    		if($("#date_fr").val()=='' || $("#date_to").val()=='') 
    		{
    			return;
    		}
    		else
    		{
       			var diff = ( $("#date_to").datepicker('getDate') - $("#date_fr").datepicker('getDate')) /1000 / 60 / 60 / 24; // days
    			diff+=1;
    			if(diff>1)
    			{
    				return diff;
    			}
    			else{
    				alert("Invalid Date Selection!");
    				$(date_fr).datepicker('setDate',null);
    				$(date_to).datepicker('setDate',null);
    				document.getElementById("dates[0]").value = null;
        	  		document.getElementById("s_times[0]").disabled = true;
     				document.getElementById("e_times[0]").disabled = true;
    			}
    		}	
			}
			function clear_clone(n_days){
				$("#multi_data").find("tr:gt(1)").remove();
				days_n = days_n - 1;
			}

			function clone(n_days){
				days_n = n_days;
	
				var start = $("#date_fr").datepicker("getDate"),
        			end = $("#date_to").datepicker("getDate"),
       				currentDate = new Date(start),
    				between = []
    				;
    			while (currentDate <= end) {

        		between.push(new Date(currentDate));	
        		currentDate.setDate(currentDate.getDate() + 1);
    			}

				dates_ob = [];
				jQuery.each(between, function() {
					var month = (this.getMonth() + 1).toString();
					var day = this.getDate().toString();
					if(month.length == 1)
						month = '0' + "" + month;
					if(day.length == 1)
						day = '0' + "" + day;
					 var db = month + '/' + day + '/' +  this.getFullYear();
					 dates_ob.push(db);
				});
				if(between[0].getDay() == 5)
					{
						$('[id="e_times[0]"]').val('5:30 pm');
					}//checks first date if friday, set time end to 5:30 PM

				for(var i = 1; i < n_days; i++)
				{	
					var clone = $('#md_tr').clone(true).insertAfter('#multi_data tbody>tr:last');

					clone.find('[id="dates[0]"]').attr('id','dates['+i+']').attr('name', 'date_'+i).val(dates_ob[i]);

					clone.find('[id="s_times[0]"]').attr('id', 's_times['+i+']').attr('name', 'stime_'+i);
					clone.find('[id="e_times[0]"]').attr('id', 'e_times['+i+']').attr('name', 'etime_'+i);

					if(between[i].getDay() == 5)
					{
						clone.find('[id="e_times['+i+']"]').val('5:30 pm');
					}//check if date is friday, set time end to 5:30 PM
					else
					{
						clone.find('[id="e_times['+i+']"]').val('6:30 pm');
					}
            	}
            	isDateValid();
			}
    	

		function sdClick(){
     		document.getElementById("date_fr").disabled = false;
     		$(date_fr).datepicker('setDate',null);
     		$("#date_to").hide()
     		$(".to").hide();
     		$("#ob_data").show();
     		$("#md_th").hide();
     		$("#multi_data").hide();
     	}

     	function mdClick(){
     		
        	document.getElementById("date_to").disabled = false;
     		document.getElementById("date_fr").disabled = false;
     		$(date_fr).datepicker('setDate',null);
     		$(date_to).datepicker('setDate',null);
     		document.getElementById("dates[0]").value = null;
     		document.getElementById("s_times[0]").disabled = true;
     		document.getElementById("e_times[0]").disabled = true;
     		$("#date_to").show();
     		$(".to").show();
     		$("#ob_data").hide();
     		$("#multi_data").show();
     		$("#md_th").show();
     		clear_clone(days_n);
     	}


     	function initValue(){
     		if($("#md").is(':checked'))
     		{
     			$("#ob_data").hide();
     		}
     		else if($("#sd").is(':checked'))
     		{
     			$("#date_to").hide()
     			$(".to").hide();
     			$("#ob_data").show();
     			$("#md_th").hide();
     			$("#multi_data").hide();
     		}
     		else{
     	    	document.getElementById("sd").checked = true;
     			$("#date_to").hide()
     			$(".to").hide();
     			$("#ob_data").show();
     			$("#md_th").hide();
     			$("#multi_data").hide();
     		}
     
	    }

</script>

<script type="text/javascript">
	
	function calculate(){
		var from = document.form_ob.date1.value;
		var to = document.form_ob.date2.value;
		
		var d1 = Date.parse(from);
		var d2 = Date.parse(to);
		var one_day = 1000*60*60*24;
		var val = ((d2-d1)/one_day + 1);
			
		if(!isNaN(val)){		
			if(val==1){
				$("#data").show();
				$("#end").load("time_1.php");
				$("#arrival").load("time_1.php");
				$("#data > tr > td > input, select").removeAttr("disabled");
			}else if(val==2){
				$("#data").show();
				$("#end").load("time_2.php");
				$("#arrival").load("time_2.php");
				$("#data > tr > td > input, select").removeAttr("disabled");
			}else if(val>2){
				$("#data > tr > td > input, select").attr("disabled", "disabled");
			}else{
				alert("Invalid date!");
				return false;
			}
		}
	}	

	
 	function validate(){
 		document.getElementById("n_dates").value = days_n;
 		var ob_dtype = document.form_ob.dates.value;
 		var client = document.form_ob.client.value;
 		var date_fr = document.form_ob.date_fr.value;
 		var date_to = document.form_ob.date_to.value;
		var purpose = document.getElementsByName('purpose[]');
		var dept = document.getElementById('dept').value;
		var start = document.getElementById('start').value;
		var end = document.getElementById('end').value;
		var arrival = document.getElementById('arrival').value;
		var sd = document.getElementById('sd');
		var md = document.getElementById('md');
		if(client==""){//validate client
			alert("Please fill-out required fields!");
			return false;
		}	

		if(date_fr=="")
		{	
			alert("Please fill-out required fields!");
			return false;
		}

		if(ob_dtype == "Multiple Days")
		{
			if(date_to==""){
			alert("Please fill-out required fields!");
			return false;
			}
		}

		if(sd.checked == true)
		{

			if(dept == "" || arrival =="" || start == "" || end =="")
			{	
				alert("Please fill-out required fields!");
				return false;
			}
		}
		var valid = false;
		for (var i=0; i<purpose.length; i++){
			if(purpose[i].checked){	
				valid = true;
				break;
			}
		}	
			if(!valid){
				alert("Please check at least one purpose.");
				return false;
			}
		for (var i=0; i<days_n; i++){//validate time

			date = document.getElementById("dates["+i+"]").value;
			time_s = document.getElementById("s_times["+i+"]").value;
			time_e = document.getElementById("e_times["+i+"]").value;
			
			ts = parseInt(time_valid(time_s));
			te = parseInt(time_valid(time_e));

			if(ts >= te)
			{
				alert("Invalid Time Range on date: "+date);
				return false;

			}
		
		}
		
		if(patt.test(duration)){ //test the input if it contains only a number
			alert("Invalid duration!");
			return false;
		}
		if(patt.test(total)){ //test the input if it contains only a number
			alert("Invalid total duration!");
			return false;
		}
		
	} 

	function time_valid(str)
	{

		  var tokens = /([10]?\d):([0-5]\d) ([ap]m)/i.exec(str);
		    if (tokens == null) { return null; }
		    if (tokens[3].toLowerCase() === 'pm' && tokens[1] !== '12') {
		        tokens[1] = '' + (12 + (+tokens[1]));
		    } else if (tokens[3].toLowerCase() === 'am' && tokens[1] === '12') {
		        tokens[1] = '00';
		    }
		    return tokens[1] + '' + tokens[2];

	}

	function calc(){
		var dep = document.getElementById('dept').value;
		var start = document.getElementById('start').value;
		var end = document.getElementById('end').value;
		var dur = document.getElementById('duration');

		depart();

		if(start!="--Select--" && end!="--Select--"){
			if(parseInt(end)<=parseInt(start)){
				document.getElementById('ex').style.visibility = "visible";
				document.getElementById('ex1').style.visibility = "visible";
				dur.value = "";
			}else{
				document.getElementById('ex').style.visibility = "hidden";
				document.getElementById('ex1').style.visibility = "hidden";

				var x = end - start;
					if(x<60){
						if(x=="5"){
							dur.value = "0.05";
						}else{
							dur.value = "0."+x;
						}					
					}else if(x>=60){
						var y = (x/60);
						var round = y.toFixed(2);
						var dec = round.substr(-3);
						var get_per = (60 * dec);
						var r_val = Math.round(get_per);	
							if(r_val==5){
								r_val = "05";
							}
						var pos = round.indexOf(".");
						var get_num = y.toString().substr(0,pos);		
						var duration = get_num+"."+r_val;	
						dur.value = duration;
					}
			}
		}
	}
	
	function depart(){
		var depart = document.getElementById('dept').value;
		var start = document.getElementById('start').value;
		
		if(start!="--Select--" && depart!="--Select--"){
			if(parseInt(start)<=parseInt(depart)){
				document.getElementById('ex3').style.visibility = "visible";
				document.getElementById('ex').style.visibility = "visible";
			}else{
				document.getElementById('ex3').style.visibility = "hidden";
				document.getElementById('ex').style.visibility = "hidden";
			}
		}
	}
	

	function time_diff(field){
			console.log("Field: "+field);
			if(field == 1)
			{
				f = document.getElementById("dept");
			}
			else if(field == 2)
			{
				f = document.getElementById("start");
			}
			else if(field == 3)
			{
				f = document.getElementById("end");
			}
			else if(field == 4)
			{
				f = document.getElementById("arrival");
			}

			
			dept = document.getElementById("dept").value;
			arrival = document.getElementById("arrival").value;
			total = document.getElementById("total");
			console.log(total);
			t_d = parseInt(time_valid(dept));
			
			t_a = parseInt(time_valid(arrival));


			if(t_d >= t_a && arrival!="" && dept!="")
			{
			alert("Invalid Departure - Arrival Time.");
			f.value = "";
			total.value = "";	
			}
			else if(arrival!="" && dept!="")
			{
			$.post('time_diff.php', { start: dept , end: arrival}, function(result) { 
	  		total.value = result;
			});
			}

			
			t_start = document.getElementById("start").value;
			t_end = document.getElementById("end").value;
			duration = document.getElementById("duration");

			t_s = parseInt(time_valid(t_start));
			
			t_e = parseInt(time_valid(t_end));
			if(t_s >= t_e && t_start!="" && t_end!="")
			{	
			alert("Invalid Start Time - End Time.");
			f.value = "";
			duration.value = "";
			}
			else if(t_start!="" && t_end!="")
			{
			$.post('time_diff.php', { start: t_start , end: t_end}, function(result) { 
				duration.value = result;
			});
			}
			
			if(t_d > t_s && departure!="" && time_start!="")
			{	
				alert("Invalid Departure Time - Start Time.");
				f.value = "";
				duration.value = "";
				total.value = "";

			}
			if(t_e > t_a && t_end!="" && arrival!="")
			{	
				alert("Invalid End Time - Arrival Time.");
				f.value = "";
				duration.value = "";
				total.value = "";

			}
	}
	function total_duration(){
		var dep = document.getElementById('dept').value;
		var start = document.getElementById('start').value;
		var diff_start_dep = start - dep;
		var end = document.getElementById('end').value;
		var dur = document.getElementById('duration').value;
		var arr = document.getElementById('arrival').value;
		var total_dur = document.getElementById('total');
		var sd = document.getElementById('sd');
		var total_dur;
		if(end!="--Select--" && arr!="--Select--"){
			if(parseInt(arr)<=parseInt(end)){
				document.getElementById('ex2').style.visibility = "visible";
			}else{
				document.getElementById('ex2').style.visibility = "hidden";
				var x = arr - end;
						var y = (x/60);
						var round = y.toFixed(2);
						var dec = round.substr(-3);
						var get_per = (60 * dec);
						var r_val = Math.round(get_per);	
							if(r_val==5){
								r_val = "05";
							}
						var pos = round.indexOf(".");
						var get_num = y.toString().substr(0,pos);		
						var total_duration = get_num+"."+r_val;	

						var len_total = total_duration.toString().length;
						var len_duration = dur.toString().length;
						
						var pos_total = total_duration.toString().indexOf(".");
						var pos_duration = dur.toString().indexOf(".");
						
						var get_num_total = total_duration.toString().substr(0, pos_total);
						var get_num_dur = dur.toString().substr(0, pos_duration);
						
						var get_dec_total = total_duration.toString().substr(pos_total+1, len_total);
						var get_dec_dur = dur.toString().substr(pos_duration+1, len_duration);
						
						var whole_num = parseInt(get_num_total) + parseInt(get_num_dur); 
						
						var add_dec;
						if(get_dec_total=="05"){
							add_dec = "05";
						}else{
							add_dec = parseInt(get_dec_total) + parseInt(get_dec_dur);
						}					
						
						var add_one;
						var diff;
						var ans;
						if(add_dec>=60){
							diff= add_dec - 60;
							ans = (whole_num+1)+"."+diff;
						}else if(add_dec<60){
							ans = whole_num+"."+add_dec;
						}
					var diff_start_dep = start - dep;
					var start_dep;
					if(diff_start_dep<60){
						if(diff_start_dep=="5"){
							start_dep = "0.05";
						}else{
							start_dep = "0."+diff_start_dep;
						}					
					}else if(diff_start_dep>=60){
						var y1 = (diff_start_dep/60);
						var round1 = y1.toFixed(2);
						var dec1 = round1.substr(-3);
						var get_per1 = (60 * dec1);
						var r_val1 = Math.round(get_per1);	
							if(r_val1==5){
								r_val1 = "05";
							}
						var pos1 = round1.indexOf(".");
						var get_num1 = y1.toString().substr(0,pos1);		
						start_dep = get_num1+"."+r_val1;	
						
					}
						var len_ans = ans.toString().length;
						var len_start_dep = start_dep.toString().length;
						
						var pos_ans = ans.toString().indexOf(".");
						var pos_start_dep = start_dep.toString().indexOf(".");
						
						var get_num_ans = ans.toString().substr(0, pos_ans);
						var get_num_start_dep = start_dep.toString().substr(0, pos_start_dep);
						
						var get_dec_ans = ans.toString().substr(pos_ans+1, len_total);
						var get_dec_start_dep = start_dep.toString().substr(pos_start_dep+1, len_start_dep);	
						
						var whole_no = parseInt(get_num_ans) + parseInt(get_num_start_dep);
						
						var add_dec1;
						if(get_dec_ans=="05"){
							add_dec1 = "05";
						}else{
							add_dec1 = parseInt(get_dec_ans) + parseInt(get_dec_start_dep);
						}					
						
						var add_one1;
						var diff1;
						var ans1;
						if(add_dec1>=60){
							diff1= add_dec1 - 60;
							ans1 = (whole_no+1)+"."+diff1;
						}else if(add_dec1<60){
							ans1 = whole_no+"."+add_dec1;
						}
						total_dur.value = ans1;
				}
		}
	}
	
	$(document).ready(function(){
		var date1 = $("[name=date1]").val();
		var date2 = $("[name=date2]").val();
		var d1 = Date.parse(date1);
		var d2 = Date.parse(date2);
		var one_day = 1000*60*60*24;
		var val = ((d2-d1)/one_day + 1);

		if(!isNaN(val)){		
			if(val==1){
				$("#data").show();
					if($("#end").val()=="--Select--"){
						$("#end").load("time_1.php");
						$("#arrival").load("time_1.php");						
					}				
			}else if(val==2){
				$("#data").show();
				$("#end").load("time_2.php");
				$("#arrival").load("time_2.php");
			}else if(val>2){
				$("#data > tr > td > input, select").attr("disabled", "disabled");
			}
		}
		if($("#chk").is(":checked")==true){
			$(".to").css({'visibility' : 'visible'});
			$(".from").show();
		}
		
		if($("#others").is(":checked")==true){
			$("#f_others").removeAttr("disabled");
		}
		if($("#others1").is(":checked")==true){
			$("#f_others1").removeAttr("disabled");
		}
		$("#others").click(function(){
			if($(this).is(":checked")){
				$("#f_others").removeAttr("disabled");
				$("#f_others").focus();
			}else{
				$("#f_others").attr("disabled", "disabled");
			}
		});
		$("#others1").click(function(){
			if($(this).is(":checked")){
				$("#f_others1").removeAttr("disabled");
				$("#f_others1").focus();
			}else{
				$("#f_others1").attr("disabled", "disabled");
			}
		});
	$("#chk").click(function(){
		if($(this).is(":checked")){
			$("#end").load("time_2.php");
			$("#arrival").load("time_2.php");
			$(".to").css({'visibility' : 'visible'});
			$(".from").show();
		}else{
			$("#end").load("time_1.php");
			$("#arrival").load("time_1.php");
			$(".from").hide();
			$(".to").css({'visibility' : 'hidden'});			
		}
	});
		$("#help").click(function(){
			var left = parseInt((screen.availWidth/2) - (500/2));
			var top = parseInt((screen.availHeight/2) - (300/2));
			window.open("help_ob.html", "_blank", "modal=yes, toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=1, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=500, height=300"); 
			event.preventDefault();
			return false;
		});
	});
	
</script>

</head>

<body alink="blue" vlink="blue" link="blue" onload="initValue()";>
<?php include("menu.php"); ?>
<form name="form_ob" action="<?php $PHP_SELF;?>" method="POST">
<div id="container">
						
<div class="container">
	<div class="page-header">
		<h4><strong class="blue-text text-darken-2"> Official Business Application </strong></h4>
	</div>
</div>
<!-- Registration form - START -->
	<ul class="nav nav-tabs" role="tablist" style="width:55%!important;">
		<li style="width:15%!important;" role="presentation" class="active" id="b1"><a href="#sday" aria-controls="sday" role="tab" data-toggle="tab">Single Day</a></li>
		<li style="width:15%!important;" role="presentation" id="b2"><a href="#mdays" aria-controls="mdays" role="tab" data-toggle="tab">Multiple Days</a></li>
	</ul>
	
	<div class="tab-content" style="width:100%!important;">
	<!-- Single Day Tab -->
		<div role="tabpanel" class="tab-pane active" id="sday"><br><br>
			<div class="panel-body col-lg-12">
				
				<div class="row">
				<div class="input-field col s14">
					<input type="text" class="obdate1" placeholder="Select Date" name="date_fr" id="date_fr" size="25" maxlength="10" value="<?php echo $result[0];?>"/>
					<label class="obdate" for="first_name"><i class="fa fa-calendar-o"></i>  OB DATE</label>
				</div>
				
				<div class="input-field col s13">
					<input placeholder="Client/Branch" name="client" id="client" type="text" class="client1" value="<?php echo $result[1]; ?>";/>
					<label class="clients" for="client"><i class="fa fa-building"></i>  CLIENT OR BRANCH</label>
				</div>
				</div>
				
				<div class="row" style="margin-left:-1%;">
				<div class="input-field col s1">
				</div>
					<label style="font-size:112%; margin-left:7.3%;"><i class="fa fa-sign-out fa-1x"></i>  PURPOSE:</label>
							<?php
								$item = explode("|",$result[2]);
									for($i=0; $i<sizeof($item)-1; $i++){
										$arr[] = $item[$i];
									}

								if(isset($_GET['ID'])){
									foreach($item as $items){
										if($items=="Network"){
											$n_chk = "checked";
										}elseif($items=="Consultation"){
											$c_chk = "checked";
										}elseif($items=="Delivery"){
											$d_chk = "checked";
										}elseif($items=="Meeting"){
											$m_chk = "checked";
										}elseif($items=="Others"){
											$o_chk = "checked";
										}
									}		
									 echo '<td><input type="checkbox" class="filled-in" id="filled-in-box1" name="purpose[]" ',$n_chk,' value="Network"/><label for="filled-in-box1" class="check">NETWORK</label>';
									 echo '    <input type="checkbox" class="filled-in" id="filled-in-box2" name="purpose[]" ',$c_chk,' value="Consultation"/><label for="filled-in-box2" class="check">CONSULTATION</label>';
									 echo '    <input type="checkbox" class="filled-in" id="filled-in-box3" name="purpose[]" ',$d_chk,' value="Delivery"/><label for="filled-in-box3" class="check">DELIVERY</label>';
									 echo '    <input type="checkbox" class="filled-in" id="filled-in-box4" name="purpose[]" ',$m_chk,' value="Meeting"/><label for="filled-in-box4" class="check">MEETING</label>';	
									 echo '    <input type="checkbox" class="filled-in" name="purpose[]" ',$o_chk,' id="others" value="Others"/><label for="others" class="check">OTHERS</label></td>';								 
								}else{
									 echo '<td><input type="checkbox" class="filled-in" id="filled-in-box1" name="purpose[]" value="Network"/><label for="filled-in-box1" class="check">NETWORK</label>';
									 echo '    <input type="checkbox" class="filled-in" id="filled-in-box2" name="purpose[]" value="Consultation"/><label for="filled-in-box2" class="check">CONSULTATION</label>';
									 echo '    <input type="checkbox" class="filled-in" id="filled-in-box3" name="purpose[]" value="Delivery"/><label for="filled-in-box3" class="check">DELIVERY</label>';
									 echo '    <input type="checkbox" class="filled-in" id="filled-in-box4" name="purpose[]" value="Meeting"/><label for="filled-in-box4" class="check">MEETING</label>';	
									 echo '    <input type="checkbox" class="filled-in" name="purpose[]" id="others" value="Others"/><label for="others" class="check">OTHERS</label></td>';								 
								}
							?>
				</div>
				
				<div class="row"><br>
					<div class="row">
						<div class="input-field col s12" style="margin-left:15.7%;">
						  <textarea style="width:54.5%!important;" placeholder="Other purpose/s" id="f_others" class="materialize-textarea" name="others" disabled/></textarea>
						  <label class="others"><i class="fa fa-pencil"></i>  OTHERS (PLEASE SPECIFY)</label>
						  
								<?php 
									if(isset($_GET['ID'])){
										$arr_pur = array("Network",  "Consultation", "Delivery", "Meeting");
										$last = end($arr);
										if(!in_array($last, $arr_pur)){
											echo $last;
										}
									}
								?>
							</textarea>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="row">
						<div class="input-field col s12"style="margin-left:15.7%;margin-top:-1.5%;">
						  <textarea style="width:54.5%!important;" placeholder="What's on your mind..." id="textarea2" class="materialize-textarea" name="ex_output" required/></textarea>
						  <label class="others" for="textarea2"><i class="fa fa-pencil"></i>  REMARKS</label>
						</div>
					</div>
				</div>
			
			
			<tbody id="ob_data">
				<div class="row" style="margin-left:10.7%;">
					<div class="input-field col s14" style="width:35%;margin-left:-6.5%;">
						<div id='time_start'><input placeholder="Select Start Time" id="start" name="start" type="text" class="s_time1" value="<?php echo $result[5] ?>" required>
						<label class="s_time" for="first_name"><i class="fa fa-clock-o"></i>  START TIME</label>
					</div></div>
					<div class="input-field col s15" style="width:35%;margin-left:-2%;" >
						<div id='time_end'><input placeholder="Select End Time" id="end" name="end" type="text" onchange="checkDates()" class="e_time1" value="<?php echo $result[6] ?>" required>
						<label class="e_time" for="last_name"><i class="fa fa-clock-o"></i>  END TIME</label>
					</div></div>
					<div class="input-field col s16" style="width:35%;margin-left:-2%;">
						<input readonly="readonly" placeholder="Total Time Duration" id='duration' name='duration' type="text" class="ot1" value="<?php echo $result[7];?>"/>
						<label class="ot" for="duration"><i class="fa fa-clock-o"></i>  TOTAL DURATION (IN HOURS) </label>
					</div>
				</div>
				
				<div class="row" style="margin-left:10.7%;">
					<div class="input-field col s14" style="width:35%;margin-left:-6.5%;">
						<div id='s_time'><input placeholder="Select Start Time" id="time_start" name="time_start" type="text" class="s_time1" value="<?php echo $result[5] ?>" required>
						<label class="s_time" for="first_name"><i class="fa fa-clock-o"></i>  DEPARTURE TIME</label>
					</div></div>
					<div class="input-field col s15"style="width:35%;margin-left:-2%;">
						<div id='e_time'><input placeholder="Select End Time" id="time_end" name="time_end" type="text" class="e_time1" value="<?php echo $result[6] ?>" required>
						<label class="e_time" for="last_name"><i class="fa fa-clock-o"></i>  ARRIVAL TIME</label>
					</div></div>
					<div class="input-field col s16"style="width:35%;margin-left:-2%;">
						<input readonly="readonly" placeholder="Total OT Hours" id='total' name='total' type="text" class="ot1" value="<?php echo $result[9]; ?>"/>
						<label class="ot" for="total"><i class="fa fa-clock-o"></i>  TOTAL DURATION (IN HOURS) </label>
					</div>
				</div>
				<br><br>
				<div id="container" style="margin-left:3.9%;margin-top:-3%;">
				  <div class="disclaimer"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> All fields are required.</div>
				</div>
				<div id="container" style="margin-left:4.9%;margin-top: 4%;">
					<?php
						if($_GET['action']=="ob_edit"){
							echo '<td><input type="submit" name="submit" value="update" class="btn btn-primary" onclick="return validate();"/></td>';
						}else{
							echo '<td><input type="submit" name="submit" value="submit" class="btn btn-primary" onclick="return validate();"/></td>';
						}
					?><br><br><br><br>
				</div>
			</tbody>
			</div>
		</div>
		
		<script type="text/javascript">
			$(document).ready(function(){
			$('#departure input').ptTimeSelect({DefaultHr: '8', DefaultMin: '30', DefaultAmPm: 'am', onClose: function() {
            time_diff(1); }});

			$('#time_start input').ptTimeSelect({DefaultHr: '8', DefaultMin: '30', DefaultAmPm: 'am', onClose: function() {
            time_diff(2); }});

            $('#time_end input').ptTimeSelect({DefaultHr: '6', DefaultMin: '30', DefaultAmPm: 'pm', onClose: function() {
            time_diff(3); }});

            $('#arrival_t input').ptTimeSelect({DefaultHr: '6', DefaultMin: '30', DefaultAmPm: 'pm', onClose: function() {
            time_diff(4); }});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#s_time input').ptTimeSelect({DefaultHr: '8', DefaultMin: '30', DefaultAmPm: 'am'});
				$('#e_time input').ptTimeSelect({DefaultHr: '6', DefaultMin: '30', DefaultAmPm: 'pm'});
				
			});
		
		</script>
		<?php
			if($result[13]=="mdays"){	
				$item = explode("|",$result[0]); 
				$n = sizeof($item)-1;
				echo "<script type='text/javascript'>
					$('#date_fr').datepicker({
						onSelect: function(dataText, inst){ 	
							document.getElementById('dates[0]').value = dataText;
							document.getElementById('s_times[0]').disabled = false;
							document.getElementById('e_times[0]').disabled = false;
							document.getElementById('s_times[0]').value = '8:30 am';
							document.getElementById('e_times[0]').value = '6:30 pm';
							clear_clone(".$n.");
							clone(dateDifference());
							total_duration();
						}
					});

					$('#date_to').datepicker({
      					onSelect: function(dataText, inst){
							document.getElementById('dates[0]').value = $('#date_fr').val();
							$('#multi_data').show();
							clear_clone(".$n.");
							clone(dateDifference());
						}
    				});

					var parts = $('#date_fr').val().split('/'); 
					var parts2 = $('#date_to').val().split('/'); 
					$('#date_fr').datepicker('setDate',new Date(parts[2],parts[0]-1,parts[1]));
					$('.ui-date-currpickerent-day').trigger('click'); 
					$('#date_to').datepicker('setDate',new Date(parts2[2],parts2[0]-1,parts2[1]));
					$('.ui-datepicker-current-day').trigger('click'); 
    				document.getElementById('sd').disabled = true;
					</script>";
						$t_start = explode("|",$result[5]); 
						$t_end = explode("|",$result[6]); 

						for($i = 0; $i < $n; $i++){
							echo"<script>document.getElementById('s_times[".$i."]').value = '".$t_start[$i]."';</script>";
							echo"<script>document.getElementById('e_times[".$i."]').value = '".$t_end[$i]."';</script>";
						}
			}
			if($result[13]=='sday'){
				echo"<script>
				document.getElementById('mdays').disabled = true;
				</script>";
			}	
		?>	
		
		
		
	<!-- Multiple Days Tab -->
		<div role="tabpanel" class="tab-pane" id="mdays">
			<br><br><br>
			<div class="row"style="margin-left:-.12%;">
			<div class="input-field col s12">
				<div class="input-field col s6" style="margin-left:-10%;width:50%;">
					<input type="text" class="obdate1" placeholder="Select Start Date" name="date_fr1" id="date_fr1" size="25" maxlength="10" value="<?php echo $result[0];?>"/>
					<label style="margin-left:30%!important;"class="obdate" for="first_name"><i class="fa fa-calendar-o"></i>  OB DATE</label>
				</div>
				
				<div class="input-field col s6" style="margin-left:14%;padding:0%;">
					<input style="margin-left:-99%!important;" type="text" class="obdate1" placeholder="Select End Date" name="date_to" id="date_to" size="25" maxlength="10" value="<?php $item = explode("|",$result[0]); echo $item[sizeof($item)-2];?>"/>
					<label style="margin-left:-150%!important;" class="obdate" for="first_name"><i class="fa fa-calendar-o"></i>  OB DATE</label>
				</div>
			</div>
			</div>
			<div class="input-field col s13" style="margin-left:14.6%!important;">
					<input style="margin-left:0.8%!important;width:42.3%!important;" placeholder="Client/Branch" name="client" id="client" type="text" class="client1" value="<?php echo $result[1]; ?>";/>
					<label class="clients" for="client"><i class="fa fa-building"></i>  CLIENT OR BRANCH</label>
				</div>
				<br>
				<div class="row" style="margin-left:-1%;">
				<div class="input-field col s1">
				</div>
					<label style="font-size:112%; margin-left:7.9%;"><i class="fa fa-sign-out fa-1x"></i>  PURPOSE:</label>
							<?php
								$item = explode("|",$result[2]);
									for($i=0; $i<sizeof($item)-1; $i++){
										$arr[] = $item[$i];
									}

								if(isset($_GET['ID'])){
									foreach($item as $items){
										if($items=="Network"){
											$n_chk = "checked";
										}elseif($items=="Consultation"){
											$c_chk = "checked";
										}elseif($items=="Delivery"){
											$d_chk = "checked";
										}elseif($items=="Meeting"){
											$m_chk = "checked";
										}elseif($items=="Others"){
											$o_chk = "checked";
										}
									}		
									 echo '<td><input type="checkbox" class="filled-in" id="box1" name="purpose[]" ',$n_chk,' value="Network"/><label for="box1" class="check">NETWORK</label>';
									 echo '    <input type="checkbox" class="filled-in" id="box2" name="purpose[]" ',$c_chk,' value="Consultation"/><label for="box2" class="check">CONSULTATION</label>';
									 echo '    <input type="checkbox" class="filled-in" id="box3" name="purpose[]" ',$d_chk,' value="Delivery"/><label for="box3" class="check">DELIVERY</label>';
									 echo '    <input type="checkbox" class="filled-in" id="box4" name="purpose[]" ',$m_chk,' value="Meeting"/><label for="box4" class="check">MEETING</label>';	
									 echo '    <input type="checkbox" class="filled-in" name="purpose[]" ',$o_chk,' id="others1" value="Others"/><label for="others1" class="check">OTHERS</label></td>';								 
								}else{
									 echo '<td><input type="checkbox" class="filled-in" id="box1" name="purpose[]" value="Network"/><label for="box1" class="check">NETWORK</label>';
									 echo '    <input type="checkbox" class="filled-in" id="box2" name="purpose[]" value="Consultation"/><label for="box2" class="check">CONSULTATION</label>';
									 echo '    <input type="checkbox" class="filled-in" id="box3" name="purpose[]" value="Delivery"/><label for="box3" class="check">DELIVERY</label>';
									 echo '    <input type="checkbox" class="filled-in" id="box4" name="purpose[]" value="Meeting"/><label for="box4" class="check">MEETING</label>';	
									 echo '    <input type="checkbox" class="filled-in" name="purpose[]" id="others1" value="Others"/><label for="others1" class="check">OTHERS</label></td>';								 
								}
							?>
				</div>
				
				<div class="row" style="margin-left:.1%;"><br>
					<div class="row">
						<div class="input-field col s12" style="margin-left:15.7%;">
						  <textarea style="width:54.5%!important;" placeholder="Other purpose/s" id="f_others1" class="materialize-textarea" name="others1" disabled/></textarea>
						  <label class="others"><i class="fa fa-pencil"></i>  OTHERS (PLEASE SPECIFY)</label>
						  
								<?php 
									if(isset($_GET['ID'])){
										$arr_pur = array("Network",  "Consultation", "Delivery", "Meeting");
										$last = end($arr);
										if(!in_array($last, $arr_pur)){
											echo $last;
										}
									}
								?>
							</textarea>
						</div>
					</div>
				</div>
				
				<div class="row" style="margin-left:.1%;">
					<div class="row">
						<div class="input-field col s12"style="margin-left:15.7%;margin-top:-1.5%;">
						  <textarea style="width:54.5%!important;" placeholder="What's on your mind..." id="textarea2" class="materialize-textarea" name="ex_output" required/></textarea>
						  <label class="others" for="textarea2"><i class="fa fa-pencil"></i>  REMARKS</label>
						</div>
					</div>
				</div>
				<div id="container" style="margin-left:5%;margin-top:-1%;">
				  <div class="disclaimer"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> All fields are required.</div>
				</div>
				<div id="container" style="margin-left:6%;margin-top: 4%;">
					<?php
						if($_GET['action']=="ob_edit"){
							echo '<td><input type="submit" name="submit" value="update" class="btn btn-primary" onclick="return validate();"/></td>';
						}else{
							echo '<td><input type="submit" name="submit" value="submit" class="btn btn-primary" onclick="return validate();"/></td>';
						}
					?>
				</div><br><br><br><br><br>
		</div>
	</div>
</form>
</div>
		<?php include("footer.php"); ?>
</body>

</html>
