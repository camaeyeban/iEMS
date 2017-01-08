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

if($_SESSION['rights']==1){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
}
require_once("calendar/classes/tc_calendar.php");

function calendar1($date){
	  $myCalendar = new tc_calendar("date1", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  if($date!=""){
			$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
		}	  
	  $myCalendar->writeScript();
}

if(isset($_GET['action']) && $_GET['action']=="ot_edit"){
		$str = "SELECT no_of_hours, cdc, expected_output, status, date_ot, time_start, time_end, ot_id
				FROM ems_ot
				WHERE ot_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		$result = $dblink->get_data($qry);
            	if($result[1]==1)
            	{
            		$result[1] = "Regular Day";
            	}
            	else if($result[1] ==3)
            	{	
            		$result[1] = "Special Public Holiday on Rest Day";
            	}
            	else if($result[1] ==2)
            	{
            		$result[1] = "Rest Day/Special Public Holiday";
            	}
            	else if($result[1] == 4)
            	{
            		$result[1] = "Regular Holiday";
            	}
            	else if($result[1] == 5)
            	{
            		$result[1] = "Regular Holiday on Rest Day";
            	}
}

$qry_num = mysql_query("SELECT ot_id FROM ems_ot ORDER BY ot_id DESC");
$count = mysql_num_rows($qry_num);
	if($count==0){		
		$ID = "ovt-0001";
	}else{
		$qry_id = mysql_result($qry_num, 0);
		$ID = auto_num($qry_id);
	}

	$cdc = $_POST['calen_class'];
            	if($cdc=="Regular Day")
            	{
            		$cdc = 1;
            	}
            	else if($cdc =="Special Public Holiday on Rest Day")
            	{	
            		$cdc = 3;
            	}
            	else if($cdc =="Rest Day/Special Public Holiday")
            	{
            		$cdc = 2;
            	}
            	else if($cdc == "Regular Holiday")
            	{
            		$cdc = 4;
            	}
            	else if($cdc == "Regular Holiday on Rest Day")
            	{
            		$cdc = 5;

            	}
	$ex_output = $_POST['ex_output'];
	$today = date("Y-m-d");		
	$date_ot = date('Y-m-d', strtotime($_POST['ot_date']));	
	$day_ot = $_POST['ot_day'];
	if($day_ot == "6") //saturday
	{
		$hours = $hours - 4;
	}
	$ot_start = $_POST['time_start'];
	$ot_end = $_POST['time_end'];
	$hours = $_POST['hours'];


if(isset($_POST['submit']) && $_POST['submit']=="submit" && isdate($date_ot)){

            	if($cdc=="Regular Day")
            	{
            		$cdc = 1;
            	}
            	else if($cdc =="Special Public Holiday on Rest Day")
            	{	
            		$cdc = 3;
            	}
            	else if($cdc =="Rest Day/Special Public Holiday")
            	{
            		$cdc = 2;
            	}
            	else if($cdc == "Regular Holiday")
            	{
            		$cdc = 4;
            	}
            	else if($cdc == "Regular Holiday on Rest Day")
            	{
            		$cdc = 5;

            	}
				
 	 			// insert into ems_ot
				$strqry = "INSERT INTO ems_ot (ot_id, emp_num, date_Filed, date_ot, time_start, time_end, no_of_hours, cdc, expected_output, status)
						VALUES('$ID','$_SESSION[emp_num]','$today','$date_ot', '$ot_start', '$ot_end', '$hours','$cdc','$ex_output','Pending')";
						$query = $dblink->db_qry($strqry);

				// insert into ems_accomplishment
				$strqry = "INSERT INTO ems_accomplishments (ot_id, date_Filed, status)
						VALUES('$ID','$today','')";
				$query = $dblink->db_qry($strqry);

				send_email_pending("overtime request", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_ot_accomplishment.php"); //param(type of application, emp, dept) 
				echo '<script>window.location = \'view_ot_request.php\';</script>';
				 

	}elseif(isset($_POST['submit']) && $_POST['submit']=="update" && isdate($date_ot)){
				//for update
				 $str = "UPDATE ems_ot set date_ot='$date_ot', time_start='$ot_start', time_end='$ot_end', no_of_hours='$hours',cdc='$cdc',expected_output='$ex_output'
						WHERE ot_id='$_GET[ID]' ";
				 $qry = $dblink->db_qry($str);
				 header("location:view_ot_request.php");
	}	
	elseif(isset($_POST['submit']))	
	{
		echo "<script>alert('Invalid date value');</script>";
		header("Refresh:0");
	}			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
<head>
	<!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
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
 	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!--timepicker-->
  	<link rel="stylesheet" type="text/css" href="jquery.ptTimeSelect.css" />
	<script type="text/javascript" src="jquery.ptTimeSelect.js"></script>

<script type="text/javascript">

   $(function() {
    $( "#datepicker_ot" ).datepicker({
      onSelect: function(selectedDate){
      		$tempdate = selectedDate;
      		isDateValid();
         
        }
      });
    });
   	  function isDateValid(){
   	  		$ot_id = document.getElementById('ot_id').value;
			$.post('checkOTDate.php', { date_ot: $tempdate, ot_id: $ot_id }, function(result) { 
				if(result > 0){
					alert("You have an existing Approved or Pending Request for the date you selected.\nWait for your manager's approval or cancel your existing request.")
					$( "#datepicker_ot" ).datepicker('setDate', null);
					document.getElementById('calen_class').value = "";
				}else{searchDateClass($tempdate);}
			});
   	  }

      function searchDateClass(ot_date){
        	date = $tempdate.split('/');
			var d = new Date(date[2], date[0]-1, date[1]);
			var day = d.getDay();
			var calen_class = 1;
			cdc = document.getElementById('calen_class');
			
            $.post('searchDateClass.php', { date_ot: $tempdate }, function(result) { 
            	if(result=="" && (day!=6 && day!=0))
            	{
            		calen_class = "Regular Day";
            	}
            	else if(result =="Special Holiday" && (day==6 || day==0 ))
            	{	
            		calen_class = "Special Public Holiday on Rest Day";
            	}
            	else if(result =="Special Holiday" || (day==6 || day==0))
            	{
            		calen_class = "Rest Day/Special Public Holiday";
            	}
            	else if(result == "Regular Holiday" && (day!=6 || day!=0))
            	{
            		calen_class = "Regular Holiday";
            	}
            	else if(result == "Regular Holiday" && (day==6 || day==0))
            	{
            		calen_class = "Regular Holiday on Rest Day";

            	}
            	 cdc.value = calen_class;
	  });
	}
    

    function time_diff()
	{	
		start = document.getElementById("time_start").value;
		end = document.getElementById("time_end").value;
		hrs = document.getElementById("hours");
		s = parseInt(time_valid(start));
		e = parseInt(time_valid(end));
		if(start=="" || end==""){return;}

		
			$.post('time_diff.php', { start: start , end: end}, function(result) { 
	  			 hrs.value = result;
			});
	}


	function time_valid(str)
	{

		  var tokens = /([10]?\d):([0-5]\d) ([ap]m)/i.exec(str);
		    if (tokens == null) { return null; }
		    if (tokens[3].toLowerCase() === 'pm' && tokens[1] !== '12') {
		        tokens[1] = '' + (12 + (+tokens[1]));
		    } else if (tokens[3].toLowerCase() === 'am' && tokens[1] === '12') {
		        tokens[1] = '00';}
	return tokens[1] + '' + tokens[2];}

   	function block_char(bchar){
   		text = document.getElementById("ex_output");
   		if (text.value.match(/[|]/g)) {
			text.value = text.value.replace(/[|]/g, '');
		}
   	}
	function validate(){
		var time_start = document.form_ot.time_start.value;
		var time_end = document.form_ot.time_end.value;
		var hours  = document.form_ot.hours.value;
		var calen_class  = document.form_ot.calen_class.value;
		var output = document.form_ot.ex_output.value;
		var patt = new RegExp(/[^0-9.]/);
		var date = document.form_ot.ot_date.value;
		date = date.split('/');
		var d = new Date(date[2], date[0]-1, date[1]);

		var day = d.getDay();
			if(day == 6) //saturday
			{	document.getElementById('ot_day').value = 6;
				if(time_start != "12:00 am" && time_end.indexOf("am") == -1){
					if(hours <= 5)
					{
						alert("Minimum OT hours for Saturday is greater than 5 hours.");
						return false;
					}
					
				}document.getElementById('hours').value = document.getElementById('hours').value - 5;	
			}else{
				if(hours < 2){
					alert("Number of hours must be not less than to two.");
					return false;
				}
			}
		if(calen=="0000-00-00"){
			alert("Please select OT date.");
			return false;
		}
		if(patt.test(hours)){ //test the input if it contains only a number
			alert("Invalid number of hours!");
			return false;
		}
	}
	

</script>

</head>

<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    <?php include("menu.php"); ?>
<form name='form_ot' action='<?php $PHP_SELF; ?>' method='POST'>
<div id="container">
			
                        	<script type="text/javascript">
								 $(document).ready(function(){
			            		$('#s_time input').ptTimeSelect({DefaultHr: '6', DefaultMin: '30', DefaultAmPm: 'pm', onClose: function() {
            					time_diff(); }});
			            		$('#e_time input').ptTimeSelect({DefaultHr: '12', DefaultMin: '00', DefaultAmPm: 'am', onClose: function() {
            					time_diff(); }});
			       			 });
							</script>
                      
<div class="container">
<div class="page-header">
    <h4><strong class="blue-text text-darken-2"> Overtime Request </strong></h4>
</div>
</div>
<!-- Registration form - START -->
<div class="container">
    <div class="row">
        <form role="form">
        <input type="text" style="display:none" name="ot_id" id="ot_id" value= "<?php echo $result[7] ?>"/>	
            <?php $date = ($_GET['ID']) ? $result[3] : date("Y-m-d"); ?>
			<?php $_SESSION['fullname'];?>
			<?php $_SESSION['dept_name']; ?>
			<?php $_SESSION['job_title']; ?>
<div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s13">
          <input placeholder="Select Date" id="datepicker_ot" type="text" class="date1" name="ot_date" value="<?php echo ($result[4] != '')? date('m/d/Y', strtotime($result[4])) : ''; ?>" required/>
		  <label class="date" for="first_name"><i class="fa fa-calendar-o"></i>  OT DATE</label>
        </div>
        <div class="input-field col s13">
          <input readonly="readonly" placeholder="Classification" name="calen_class" id="calen_class" type="text" class="classification1" value="<?php echo $result[1]; ?>";/>
          <label class="classification" for="last_name"><i class="fa fa-calendar-o"></i>  CALENDAR DAY CLASSIFICATION</label>
        </div>
      </div>
      
	  <div class="input-field col s12">
        <div class="input-field col s4">
		  <div id='s_time'><input placeholder="Select Start Time" id="time_start" name="time_start" type="text" class="s_time1" onchange="endChange()" value="<?php echo $result[5] ?>" required>
		  <label class="s_time" for="time_start"><i class="fa fa-clock-o"></i>  START TIME</label>
        </div></div>
		<div class="input-field col s4">
          <div id='e_time'><input placeholder="Select End Time" id="time_end" name="time_end" type="text" class="e_time1" value="<?php echo $result[6] ?>" required>
          <label class="e_time" for="time_end"><i class="fa fa-clock-o"></i>  END TIME</label>
        </div></div>
		<div class="input-field col s4">
         <input readonly="readonly" placeholder="Total OT Hours" id='hours' name='hours' type="text" class="ot1" value="<?php echo (date('w',strtotime($result[4])) == 6 || date('w',strtotime($result[4])) == 0)? ($result[0] + 5) : $result[0];?>"/>
		 <label class="ot" for="last_name"><i class="fa fa-clock-o"></i>  TOTAL HOURS</label>
        </div>
      </div>
	  
		<div class="input-field col s12"style="margin-left:10.2%;margin-top:2%!important;">
			<textarea placeholder="What's on your mind?" id="textarea1" class="materialize-textarea" name="ex_output" onkeyup="block_char(this);" required/><?php echo $result[2];?></textarea>
			<label class="text" for="textarea1"><i class="fa fa-pencil"></i>  EXPECTED OUTPUT</label>
			<div class="disclaimer" style="margin-left:0%!important;margin-top:1%!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> Qualification for overtime and allowances pay during Mondays - Fridays will be minimum of 2 hours and minimum of 4 hours during Saturdays.<br>
			  All fields are required.</div>
		</div>
		</form>
    </form>
  </div>
  <br>
<?php								
	if($_GET['action']=="ot_edit"){
		echo '<td><input style="margin-left:10.4%!important;margin-top:-1%!important;" type="submit" name="submit" id="submit" value="update" class="btn btn-primary" onclick="return validate();"></td>';
	}else{
		echo '<td><input style="margin-left:10.4%!important;margin-top:-1%!important;;" type="submit" name="submit" id="submit" value="submit" class="btn btn-primary" onclick="return validate();"></td>';
	}
?>


	</form></div></div>
		<?php include("footer.php"); ?>
</body>
</html>
<script type="text/javascript">
		var frmvalidator  = new Validator("form_ot");
		frmvalidator.EnableMsgsTogether();
		frmvalidator.addValidation("hours","req","Please enter estimated no. of hours.");
		frmvalidator.addValidation("ot_date","req","Please select your OT Date.");
		frmvalidator.addValidation("ex_output","req","Please enter expected output.");

		var $input = $( '.datepicker' ).pickadate({
            formatSubmit: 'yyyy/mm/dd',
            container: '#container',
            closeOnSelect: false,
            closeOnClear: false,
        })

        var picker = $input.pickadate('picker')
</script>

