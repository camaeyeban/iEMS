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
  

  //echo "otIndex  : ".$_GET['otIndex']."<br>";
  //echo "here:" . $_POST["otIndexVal"];

  if(isset($_GET['ID'])){
    $str = "SELECT ot_dates, ot_hours, purpose, date_offset, off_type, off_halfday, off_hrs, ot_exp_output, remarks, offset_id
        FROM ems_offset_new WHERE offset_id='$_GET[ID]' ";
    $qry = $dblink->db_qry($str);
    $result = $dblink->get_data($qry);
    //echo $result[1];
  }



  $qry_num = mysql_query("SELECT offset_id FROM ems_offset_new ORDER BY offset_id DESC");
  $count = mysql_num_rows($qry_num);
    if($count==0){
      $ID = "off-0001";
    }else{
      $qry_id = mysql_result($qry_num, 0);
      $ID = auto_num($qry_id);
    }


  $remarks = $_POST['remarks'];
  
  if(isset($_POST['submit']) && $_POST['submit']=="apply")
  {
    $date_filed = date("Y-m-d");
    $otIndex = $_POST["otIndexVal"];
  //echo "otIndex: ".$otIndexVal;
  
  /* fetching ot dates */

    $ot_dates = $_POST["date_0"]; //first ot date selected
    //$ot_eo = $_POST["eo_0"]; //expected output
        for ($i=1; $i <= $otIndex; $i++) { //appends other ot dates, if there are
          if (($_POST['date_'.$i]) != "") {
          
           if($i === $otIndex || $ot_dates ===""){
             $ot_dates = $ot_dates . $_POST['date_'.$i];
             //$ot_eo = $ot_eo . $_POST['eo_'.$i];

           }
           else
           {
             $ot_dates = $ot_dates . "|" . $_POST['date_'.$i];
             //$ot_eo = $ot_eo . "|" . $_POST['eo_'.$i];
           } 
          } 
        }

   
  /* feching ot hours */   
    $ot_hours = $_POST['hrs_0']; 
    //echo "<script>alert(".$ot_hours.");</script>";
    for ($j=1; $j <= $otIndex; $j++) { //appends other ot hrs, if there are
      if (($_POST['date_'.$j]) != "") {
        if($j === $otIndex || $ot_hours ==""){
          $ot_hours = $ot_hours . $_POST['hrs_'.$j];
        }
        else
        {
          $ot_hours = $ot_hours . "|" . $_POST['hrs_'.$j];
        }
      }
    }


     /* feching ot hours */
    $off_hours = $_POST['offset_0']; 
    //echo "<script>alert(".$ot_hours.");</script>";
    for ($k=1; $k <= $otIndex; $k++) { //appends other ot hrs, if there are
      if (($_POST['offset_'.$k]) != "") {
        if($k === $otIndex || $off_hours ==""){
          $off_hours = $off_hours . $_POST['offset_'.$k];
        }
        else
        {
          $off_hours = $off_hours . "|" . $_POST['offset_'.$k];
        }
      }
    }

    $purpose = $_POST['off_purpose'];
    $offset_date_temp = $_POST['offset_date'];
    $os_mdy = explode('/',$offset_date_temp);
    $offset_date = $os_mdy[2] . "-" . $os_mdy[0] . "-" . $os_mdy[1];
    $off_type = $_POST['offset_type'];
    $off_halfday = $_POST['meridian'];
    $emp_num = $_SESSION['emp_num'];


    if(strpos($ot_dates, "|")!==false)
    { $otd =  explode("|", $ot_dates);
      $ot_eo = "";
      
        for($i = 0; $i < count($otd); $i++)
        {
          $qry_ot = mysql_query("SELECT expected_output from ems_ot where emp_num = '" .$emp_num."' and date_ot = '" . date('Y-m-d', strtotime($otd[$i])) . "' ");
          $row_ot = mysql_fetch_array($qry_ot);
          if($row_ot[0] != '' && $ot_eo== "")
          {  $ot_eo = $ot_eo  . $row_ot[0];
           
          }
          else
          {
             $ot_eo = $ot_eo . "|" . $row_ot[0];
          }
        }
    }
    else
    {
        $qry_ot = mysql_query("SELECT expected_output from ems_ot where emp_num = '" .$emp_num."' and date_ot = '" . date('Y-m-d', strtotime($ot_dates)) . "' ");
        $row_ot = mysql_fetch_array($qry_ot);
        if($row_ot[0] != '')
        { 
          $ot_eo = $row_ot[0];
        }
    }
   

    $strqry = "INSERT INTO ems_offset_new (offset_id, emp_num, date_filed, ot_dates, ot_hours, ot_exp_output, off_hrs, purpose, date_offset, off_type, off_halfday, status, remarks)
    VALUES('$ID', '$emp_num', '$date_filed','$ot_dates','$ot_hours', '$ot_eo', '$off_hours', '$purpose', '$offset_date', '$off_type', '$off_halfday', 'Pending', '$remarks')";
    $qry = $dblink->db_qry($strqry);
	send_email_pending("offset request", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_offset_request.php");
    //echo $emp_num;
    header("location:view_edit_offset.php");
  }
 if(isset($_POST['submit']) && $_POST['submit']=="update"){
       $otIndex = $_POST["otIndexVal"];


       $ot_dates = $_POST["date_0"]; //first ot date selected
       $ot_eo = $_POST["eo_0"]; //expected output
       
        for ($i=1; $i <= $otIndex; $i++) { //appends other ot dates, if there are
          if (($_POST['date_'.$i]) != "") {
          
           if($i === $otIndex || $ot_dates ===""){
             $ot_dates = $ot_dates . $_POST['date_'.$i];
             $ot_eo = $ot_eo . $_POST['eo_'.$i];

           }
           else
           {
             $ot_dates = $ot_dates . "|" . $_POST['date_'.$i];
             $ot_eo = $ot_eo . "|" . $_POST['eo_'.$i];
           }
          } 
        }

      /* feching ot hours */
        $ot_hours = $_POST['hrs_0']; 
        //echo "<script>alert(".$ot_hours.");</script>";
        for ($j=1; $j <= $otIndex; $j++) { //appends other ot hrs, if there are
          if (($_POST['date_'.$j]) != "") {
            if($j === $otIndex || $ot_hours ==""){
              $ot_hours = $ot_hours . $_POST['hrs_'.$j];
            }
            else
            {
              $ot_hours = $ot_hours . "|" . $_POST['hrs_'.$j];
            }
          }
        }


         /* feching ot hours */
        $off_hours = $_POST['offset_0']; 
        //echo "<script>alert(".$ot_hours.");</script>";
        for ($k=1; $k <= $otIndex; $k++) { //appends other ot hrs, if there are
          if (($_POST['offset_'.$k]) != "") {
            if($k === $otIndex || $off_hours ==""){
              $off_hours = $off_hours . $_POST['offset_'.$k];
            }
            else
            {
              $off_hours = $off_hours . "|" . $_POST['offset_'.$k];
            }
          }
        }

        $purpose = $_POST['off_purpose'];
        $offset_date_temp = $_POST['offset_date'];
        $os_mdy = explode('/',$offset_date_temp);
        $offset_date = $os_mdy[2] . "-" . $os_mdy[0] . "-" . $os_mdy[1];
        $off_type = $_POST['offset_type'];
        $off_halfday = $_POST['meridian'];
        $emp_num = $_SESSION['emp_num'];


    if(strpos($ot_dates, "|")!==false)
    { $otd =  explode("|", $ot_dates);
      $ot_eo = "";
      
        for($i = 0; $i < count($otd); $i++)
        {
          $qry_ot = mysql_query("SELECT expected_output from ems_ot where emp_num = '" .$emp_num."' and date_ot = '" . date('Y-m-d', strtotime($otd[$i])) . "' ");
          $row_ot = mysql_fetch_array($qry_ot);
          if($row_ot[0] != '' && $ot_eo== "")
          {  $ot_eo = $ot_eo  . $row_ot[0];
           
          }
          else
          {
             $ot_eo = $ot_eo . "|" . $row_ot[0];
          }
        }
    }
    else
    {
        $qry_ot = mysql_query("SELECT expected_output from ems_ot where emp_num = '" .$emp_num."' and date_ot = '" . date('Y-m-d', strtotime($ot_dates)) . "' ");
        $row_ot = mysql_fetch_array($qry_ot);
        if($row_ot[0] != '')
        { 
          $ot_eo = $row_ot[0];
        }
    }
   
    



    $str = "UPDATE ems_offset_new SET ot_dates='$ot_dates', ot_hours='$ot_hours', ot_exp_output='$ot_eo', off_hrs='$off_hours', 
              purpose='$purpose', date_offset='$offset_date', off_type = '$off_type', off_halfday='$off_halfday', remarks='$remarks' WHERE offset_id='$_GET[ID]' ";
    $qry = $dblink->db_qry($str);
    header("location:view_edit_offset.php");
  }   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <style type = 'text/css'>
    td
    {
      white-space : nowrap;
    }
    .small
    {
      font-size : 14;
    }
      .align-center {
        display: block;
        margin: 1.0em auto;
        text-align: center;
    }


    .boxed {
      width:15em;
      border: 2px solid gray ;
      padding: 10px;
      margin: 0;
      text-align: justify;
      word-wrap: break-word;
    }

  </style>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>
<link href="css/home-format.css" rel="stylesheet">
		
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />

    <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	<!-- datepicker -->
     <title>iEMS</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> -->
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
     <link rel='stylesheet' href='cssall.css' type='text/css' />
     <script language="javascript" src="calendar/calendar.js"></script>
     <script type="text/javascript" src="jquery.js"></script>
     <script type="text/javascript" src="navigation.js"></script>
     <script type="text/javascript" src="jsFunctions.js"></script>
     
     <link href="calendar/calendar.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/sss">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  
  <script type="text/javascript">
    var max_fields = 5;
    var x = 1;
    var otIndex = 0;
    

    $(function(){
      $("#date_0").datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1,
                onSelect: function(selectedDate){
                   $tempdate = selectedDate;
					searchDate(this);
                  }
                });
    });

    $(function() {
    $( "#datepicker_offset" ).datepicker({
       minDate: 'M',
       maxDate: '+1M', 
      onSelect: function(selectedDate){
          $os_date = selectedDate;
          isDateValid();

        }
      });
    });



    function isDateValid()
      {   
          $os_id = document.getElementById('os_id').value;

      
      $.post('checkOSDate.php', { date_os: $os_date, os_id: $os_id }, function(result) {  
        if(result > 0)
        {
          alert("You have an existing Approved or Pending Request for the date you selected.\nWait for your manager's approval or cancel your existing request.")
          $( "#datepicker_offset" ).datepicker('setDate', null);
          
        }
        else
        {
          showhideAMPM();

        }
        
      });
      }

      function clearRow(el){
        reset_off_req();
        el_id = $(el).attr('id');
        //alert(el_id);

          var ot_date = document.getElementById('date_'+el_id);
          var ot_hrs = document.getElementById('ot['+el_id+'].hrs');
          var total_hrs = document.getElementById('total_hrs');
          var off = document.getElementById('ot['+el_id+'].offset');
          
          $(ot_date).datepicker('setDate', null);
          
          total_hrs.value = parseFloat(total_hrs.value) - parseFloat(off.value);
          ot_hrs.value = "0";
          off.value = "0";
          ot_hrs.disabled = true;
          off.disabled = true;

      }
      
    
      function searchDate(ot_date){
        //alert("Searching date...");
          //for()
          reset_off_req();
          var date_exist = false;
          date_id =  $(ot_date).attr('id');
          ot_id = parseInt(date_id.replace(/[^\d.]/g,''));
          //  alert(ot_id);
          ot_hrs =  document.getElementById('ot['+ot_id+'].hrs');
          off_hrs =  document.getElementById('ot['+ot_id+'].offset');
          expected_output = document.getElementById('ot['+ot_id+'].eo');
          total_hrs = document.getElementById("total_hrs");

          for(var i = 0; i <= 5; i++)
          {
            if(i != ot_id)
            {
              if(ot_date.value == (document.getElementById('date_'+i).value) && ot_date.value != "")
              {   date_exist = true;
                  alert("You have already selected that date!");
                  $(ot_date).focus();
                  $(ot_date).datepicker('setDate', null);

                  //ot_date.value = '';
                  total_hrs.value -= parseFloat(off_hrs.value);
                  ot_hrs.value = 0;
                  off_hrs.value = 0;
                  return;
              }
            }
          }


          if(date_exist == false) //if date is not repeated 
          { off_hrs.disabled = false;
            ot_hrs.disabled = false;
            $.post('searchDate.php', { date_ot: $tempdate }, function(result) { 
              //alert(result);
             
              //alert(res[1]);

              if (result>0) {
              total_hrs.value = parseFloat(total_hrs.value) - parseFloat(off_hrs.value);
              ot_hrs.value = result;  
              off_hrs.value = result;
              total_hrs.value = parseFloat(total_hrs.value) + parseFloat(result);
            
              }
              else
              { date = document.getElementById('date_'+ot_id);
                alert("OT date "+date.value+" is already used, approved, or not found.");
                $(date).datepicker('setDate', null);
                total_hrs.value -= parseFloat(off_hrs.value);
                ot_hrs.value = 0;
                off_hrs.value = 0;
                ot_hrs.disabled = true;
                off_hrs.disabled = true;
              }
            });

       
          }

      }
    
    
    function initValue(){
         //document.getElementById("time_fr").disabled = true;
         //document.getElementById("time_to").disabled = true;
         //clone();
         //document.getElementById("am").disabled = true;
         //document.getElementById("pm").disabled = true;
         disableDiv();
         //document.getElementById('am').style.display = 'none';
         //document.getElementById('pm').style.display = 'none';
     


      }

    function reset_off_req(){


      off_type = document.getElementById("offset_type");
          if(off_type.value != "")
          {   off_type.value = "";
              $('#datepicker_offset').datepicker('setDate', null);
              //$("offset_date").datepicker('setDate', null);
              
              document.getElementById("am").disabled = true;
              document.getElementById("pm").disabled = true;
          }
    }

      function clone(){

          $('[id="ot[0].hrs"]').attr('id','ot[0].hrs').attr('name', 'hrs_0').val('0');
          $('[id="ot[0].offset"]').attr('id','ot[0].offset').attr('name', 'offset_0').val('0');
          $('[id="0"]').attr('id',i);

          $('[id="date_0"]').removeClass('hasDatepicker').attr('id', 'date_0').attr('name', 'date_0').val('').datepicker({
           
              onSelect: function( selectedDate){
                $tempdate = selectedDate;
                searchDate(this);
              }
            });



          for(var i = 1; i <= 5; i ++)
          { var clone = $('#input_fields').clone(true).insertAfter('#t_color');
           
            clone.find('[id="ot[0].hrs"]').attr('id','ot['+i+'].hrs').attr('name', 'hrs_'+i).val('0');
            clone.find('[id="ot[0].offset"]').attr('id','ot['+i+'].offset').attr('name', 'offset_'+i).val('0');
            //clone.find('[id="ot[0].eo"]').attr('id','ot['+i+'].eo').attr('name', 'eo_'+i).val('');
            clone.find('[id="0"]').attr('id',i);


            clone.find('[id="date_0"]').removeClass('hasDatepicker').attr('id', 'date_'+i).attr('name', 'date_'+i).val('').datepicker({
            changeMonth: true,
            changeYear : true,
            minDate: '-1M',
            maxDate: 'M', 
              onSelect: function( selectedDate){
                $tempdate = selectedDate;
                searchDate(this);
              }
            });
          }
      }

      function disableDiv(){
          var nodes = document.getElementById("off_req").getElementsByTagName('*');
          for(var i = 0; i < nodes.length; i++)
          {
           nodes[i].disabled = true;
          }

      }

      function enableDiv(){
          var nodes = document.getElementById("off_req").getElementsByTagName('*');
          for(var i = 0; i < nodes.length; i++)
          {
           nodes[i].disabled = false;
          }

      }

      function amClicked(){
         document.getElementById("time_fr").disabled = false;
         document.getElementById("time_to").disabled = false;
      }

      function pmClicked(){
         document.getElementById("time_fr").disabled = false;
         document.getElementById("time_to").disabled = false;

      }

      function hdClicked(){
         document.getElementById("am").disabled = false;
         document.getElementById("pm").disabled = false;
      }

      function wdClicked(){
         document.getElementById("am").disabled = true;
         document.getElementById("pm").disabled = true;
         document.getElementById("time_fr").disabled = true;
         document.getElementById("time_to").disabled = true;
      }

      function showhideAMPM(){
		
        var total_hrs = document.getElementById('total_hrs');
        var offset_type = document.getElementById('offset_type');
		var offset_date = document.getElementById('datepicker_offset').value;
		var date = offset_date.split('/');
		var d = new Date(date[2],date[0]-1,date[1]);
		
		if(d.getDay() != 6 && d.getDay != 0)
		{
		
        //alert(total_hrs.value);
			if (parseInt(total_hrs.value) >= 4 && parseInt(total_hrs.value) < 8)
			{
			  document.getElementById("offset_type").value = "Half Day";
			  enableDiv();
			  document.getElementById("am").disabled = false;
			  document.getElementById("pm").disabled = false;
			  //alert("Halfday");
			  
			}

			else if (parseInt(total_hrs.value) > 7 && d.getDay == 5 )
			{
			  document.getElementById('offset_type').value = "Whole Day";
			  enableDiv();
			  document.getElementById("am").disabled = true;
			  document.getElementById("pm").disabled = true;
			  
			  document.getElementById("am").checked = false;
			  document.getElementById("pm").checked = false;
			  //alert("wholeday");

			}

			else if (parseInt(total_hrs.value) > 7 && d.getDay != 5 )
			{
			  document.getElementById('offset_type').value = "Whole Day";
			  enableDiv();
			  document.getElementById("am").disabled = true;
			  document.getElementById("pm").disabled = true;
			  
			  document.getElementById("am").checked = false;
			  document.getElementById("pm").checked = false;
			  //alert("wholeday");

			}
			else
			{ 
			  alert("Note:\n\tMinimum offset hours is 4 for half day,\n\t8 on friday or\n\t9 on monday to thursday for whole day.");
			  //document.getElementById('date_offset').value = "";
			  $('#datepicker_offset').datepicker('setDate', null);
			}
		}
		else
		{
			alert('You cant file a offset request on saturday and sunday');
			 $('#datepicker_offset').datepicker('setDate', null);
		}
      }

      function fill_totalhrs(oh){

        reset_off_req();
        oh_i = $(oh).attr("id");
        oh_id = parseInt(oh_i.replace(/[^\d.]/g,''));
        //alert(oh_id);

        off = document.getElementById('ot['+oh_id+'].offset');
        hours = document.getElementById('ot['+oh_id+'].hrs');
		ot_d = document.getElementById('date_'+oh_id);

        $.post('searchOffsetHours.php', { ot_date : ot_d.value, os_hour : off.value }, function(result) { 
      if(result == 'true')
			{
				
			}
			else
			{
				document.getElementById('ot['+oh_id+'].offset').value = 0;
				
				alert('Invalid Input\n(1) Please check your Overtime Hours(Pending).\n(2)Please check your Offset Application having the same OT date(Pending)');
			}
			var total = 0;
			for(var i = 0; i <= 5; i++)
			{   
				off = document.getElementById("ot["+i+"].offset");
				if(off.value != '')
				{
				  total += parseFloat(off.value);
				}
			}
			document.getElementById("total_hrs").value = total;
		});
      }

      function reset_field(r){
        if(r.value=="")
        {
          r.value = 0;
        }

      }
      function validate(){

            document.getElementById("otIndexVal").value = 5;
            var hrs_total = document.offset_form.hrs_total.value;
            var off_date = document.offset_form.offset_date.value;
            var off_type = document.offset_form.offset_type.value;
            var off_ampm = document.offset_form.meridian.value;
      
            
            if(hrs_total=="0"){//validate total offset hours
              alert("Please apply at least one OT date.");
              return false;
            } 

            if(off_date=="") //validate offset date
            { 
              alert("Please select your offset date");
              return false;
            }

            if(off_type == "Half Day" && off_ampm == "")
            {
              alert("Please choose if AM or PM");
              return false;
            
            }

      } 


    </script>

</head>

<body onLoad="initValue();">
	<?php include("menu.php"); ?>
	<form name="offset_form" method="POST" action='<?php $PHP_SELF;?>'>
	  <div id="container">
			
			<div class="container">
				<div class="page-header" style="width:735px!important;">
					<h4><strong class="formTitle"> Offset Application </strong></h4>
				</div>
			</div>
      
			<div class="container">
				<div class="row">
					<input type="text" style="display:none" name="os_id" id="os_id" value= "<?php echo $result[9] ?>"/> 
						<div class="row">
								  <label style="margin-left:19%!important;width:220px!important;" for="date_0"><i class="fa fa-calendar-o"></i>  OT DATE</label>
								  <label style="margin-left:-78px!important;width:220px!important;" for="ot[0].hrs"><i class="fa fa-clock-o"></i>  OT HOUR</label>
								  <label style="margin-left:-68%!important;" for="ot[0].offset"><i class="fa fa-clock-o"></i>  OFFSET HOUR/S</label>
							<div  id="t_color">
							<div class="row" id="input_fields">
								<div class="input-field col s4">
								  <input style="width:58%!important;margin-top:7.8%;margin-left:35%!important;text-align:center!important;" placeholder="Select OT Date" id="date_0" type="text" class="datepicker" name="date_0" required/>
								</div>
								<div class="input-field col s4">
								  <input style="margin-top:7.8%!important;" readonly="readonly" placeholder="Select Date" id="ot[0].hrs" type="text" class="input_fields1" name="hrs_0" value = "0" disabled />
								</div>
								<div class="input-field col s4">
								  <input style="margin-top:7.8%;margin-left:-44%;" readonly="readonly" placeholder="Select Date" id="ot[0].offset" type="text" class="input_fields1" name="offset_0" value="0" onkeyup="fill_totalhrs(this)" onchange="off_validation()" onblur="reset_field(this)" disabled /> 
								  <a style="margin-left:10px!important;margin-top:-3%!important;height:34px!important;width:80px!important;" id="0" onclick="clearRow(this);" type="button" class="waves-effect waves-light btn"><i style="margin-left:-7px!important;" class="fa fa-chevron-left"></i>&nbsp;&nbsp;CLEAR</a></button>
								</div>
							</div>
							<?php echo"<script> clone(); </script>"; ?>
							</div>
                    
							
								<div class="row" style="margin-top:-20px;">
									<label style="font-size:13px; margin-left:37.7%;"><i class="fa fa-sign-out fa-1x"></i>  TOTAL OFFSET HOURS:</label>
									<input readonly="readonly" placeholder="Select Date" id="ot[0].offset" type="text" class="input_fields1 total" name="offset_0" value="0"/> 
								</div><br><br>
								
							<div class="row" style="margin-top:-3%;margin-left:10.8%;">	
								<div class="input-field col s15">
									<input style="text-align:left!important;width:222px!important;" placeholder="Select Offset Date" id="datepicker_offset" type="text" class="input_fields1" name="offset_date" required/>
									<label style="font-size:13px; margin-left:-53%;width:100%;" for="date_0"><i class="fa fa-calendar-o"></i>  OFFSET DATE</label>
								</div>
								<div class="input-field col s15" style="margin-left:25px;">
									<input style="text-align:left;width:222px!important;"readonly="readonly" placeholder="Offset Type" name="offset_type" id="offset_type" type="text" class="input_fields1" value="<?php echo $result[4];?>"/>
									<label style="width:450px!important;margin-left:-55%;"><i class="fa fa-check-square-o"></i>  OFFSET TYPE</label>
								</div>
								<div class="input-field col s15" style="margin-left:-1%;margin-top:-1%;">
									<?php 
									  if($result[4] == "Half Day"){ 
										if($result[5] == "AM"){ 
										  echo '<input type="radio" name="leave" class="with-gap" checked="checked" value="Sick Leave" id="sick"/><label for="sick" class="radio">SICK LEAVE</label>';
										  echo '<input type="radio" name="meridian" class="with-gap" id="am" value="AM" id="AM" onClick="amClicked()" checked="checked"><label for="AM" class="radio">AM</label>';
										  echo '<input type="radio" name="meridian" class="with-gap" id="pm"  value="PM" id="PM" onClick="pmClicked()"><label for="PM" class="radio">PM</label>';
										}else{
										  echo '<input type="radio" name="meridian" class="with-gap" id="am" value="AM" id="AM" onClick="amClicked()"><label for="AM" class="radio">AM</label>';
										  echo '<input type="radio" name="meridian" class="with-gap" id="pm" value="PM" id="PM" onClick="pmClicked()" checked="checked"><label for="PM" class="radio">PM</label>';
										}
									  }else{
										echo'<input type="radio" name="meridian" class="with-gap" id="am" value="AM" id="AM" onClick="amClicked()" disabled><label for="AM" class="radio">AM</label>';
										echo'<input type="radio" name="meridian" class="with-gap" id="pm"  value="PM" id="PM" onClick="pmClicked()" disabled><label for="PM" class="radio">PM</label>';
									  }
									?>
								</div>
										<div class="row" style="margin-left:0%;margin-top:8%;">
											<div class="input-field col s12">
											  <textarea style="width:66%!important;"placeholder="Purpose of Offset" id="textarea1" class="materialize-textarea" name="off_purpose" required/><?php echo $result[2];?></textarea>
											  <label class="text" for="textarea1"><i class="fa fa-pencil"></i>  PURPOSE</label>
											</div>
											<?php
											  if(strpos($result[0], "|")!==false)
											  {
												$item = explode("|",$result[0]); //ot dates
												$hrs_ot = explode("|", $result[1]);
												$hrs_off = explode("|", $result[6]);
												$n = sizeof($item);
													for($i = 0; $i < $n; $i++)
													{ 
														 $parts = explode("/", $item[$i]);
														 echo "<script type='text/javascript'>
																$('#date_".$i."').datepicker().datepicker('setDate', new Date(".$parts[2].", ".$parts[0]."-1, ".$parts[1]."));
																$('.ui-datepicker-current-day').trigger('click');
																document.getElementById('ot[".$i."].hrs').value = '".$hrs_ot[$i]."'; 
																document.getElementById('ot[".$i."].offset').value = '".$hrs_off[$i]."'; 
																fill_totalhrs(document.getElementById('ot[".$i."].offset'));   
															 </script>";
														$parts = "";
													}
											  }
											  else
											  {    $parts = explode("/", $result[0]);
												   echo"<script>
													$('#date_0').datepicker().datepicker('setDate', new Date(".$parts[2].", ".$parts[0]."-1, ".$parts[1]."));
													$('.ui-datepicker-current-day').trigger('click');

													showhideAMPM();
												  </script>";
											  }
													
											  $parts2 = explode("-", $result[3]);
											  echo "<script> 
												   showhideAMPM();
													 $('#datepicker_offset').datepicker({
													   minDate: 'M',
													   maxDate: '+1M', 
													  onSelect: function(){
														 showhideAMPM();
														}
													  });
													$('#datepicker_offset').datepicker('setDate', new Date(".$parts2[0].", ".$parts2[1]."-1, ".$parts2[2]."));
													$('.ui-datepicker-current-day').trigger('click');
													</script>";
											?>
										</div>
										<div class="disclaimer" style="margin-left:1%!important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> You can only apply pending OT requests for offset. Offset type will be based on your total offset hours: 4 hours = half day (am / pm) 8 or 
															<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9 hours = whole day. Number of hours exceeding 9 will be forfeited.</div>
								<div class="row">
									<?php
										if($_GET['action']=="off_edit"){
											echo '<input style="margin-left:2%!important;margin-top:20px!important;" type="submit" name="submit" value="UPDATE" class="btn btn-success" onclick="return validate();"/>';
										}else{
											echo '<input style="margin-left:2%!important;margin-top:20px!important;" type="submit" name="submit" value="APPLY" class="btn btn-success" onclick="return validate();"/>';
											}
									?>
								</div>
							</div>
						</div>
				</div>
			</div>
    </form>

  </div>
		<?php include("footer.php"); ?>
</body>
</html>