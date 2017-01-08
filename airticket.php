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
		
	require_once("calendar/classes/tc_calendar.php");
	
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	
	if(!isset($_GET['sa'])){
		$display = "style=\"display:none;\"";
	}else{
		$display = "style=\"display:table-row;\"";
	}
	if($_SESSION['rights']==4 && isset($_GET['ID'], $_GET['sa'])){
		$qry = $dblink->db_qry("SELECT date_filed, client, origin, destination, departure, arrival, purpose, type, 
									status, state, amount, at_id, e.birthdate, e.emp_firstname, 
									e.emp_lastname, e.emp_middlename, d.dept_name, attachment
									FROM ems_air_ticket INNER JOIN ems_employee e ON ems_air_ticket.emp_num = e.emp_num 
									INNER JOIN ems_department d ON e.dept_code = d.dept_code WHERE at_id='$_GET[ID]' ");
	
		
		$result = $dblink->get_data($qry);									
	}elseif($_SESSION['rights']!=4 && isset($_GET['ID'])){
		$qry = $dblink->db_qry("SELECT date_filed, client, origin, destination, departure, arrival, purpose, type,
									status, state, amount, at_id, e.birthdate, e.emp_firstname,
									e.emp_lastname, e.emp_middlename, d.dept_name
									FROM ems_air_ticket INNER JOIN ems_employee e ON ems_air_ticket.emp_num = e.emp_num
									INNER JOIN ems_department d ON e.dept_code = d.dept_code WHERE at_id='$_GET[ID]' ");
		$result = $dblink->get_data($qry);
	}
	
	function age($birthday) {
		$age =  date("Y", time() - strtotime($birthday)) - 1970;
		$t_mon = date("m");
		$t_day = date("d");
		$mm = date("m",strtotime($birthday));
		$dd = date("d",strtotime($birthday));
			if($t_mon<$mm){
				return $age--;
			}elseif($t_mon==$mm && $t_day==$dd ){
				return $age;
			}elseif($t_mon==$mm && $t_day>$dd ){
				return $age = $age - 1;
			}else{
				return $age;
			}
	}
				
	$qry_num = mysql_query("SELECT at_id FROM ems_air_ticket ORDER BY at_id DESC");
	$count = mysql_num_rows($qry_num);
		if($count==0){
			$ID = "air-0001";
		}else{
			$qry_id = mysql_result($qry_num, 0);
			$ID = auto_num($qry_id);
		}
		
	$today = date("Y-m-d");
	$client = $_POST['client'];
	$origin = $_POST['origin'];
	$destination = $_POST['destination'];
	$etd = $_POST['etd'];
	$eta = $_POST['eta'];
	$purpose = $_POST['purpose'];
	$type = $_POST['selection'];
	$amount = $_POST['amount'];
	
	$etd2 = $_POST['etd_2'];
	$eta2 = $_POST['eta_2'];
	$origin2 = $_POST['origin_2'];
	
	if(isset($_POST['submit']) && $_POST['submit']=="submit"){
		if($_POST['selection']=="ow"){
			$str = "INSERT INTO ems_air_ticket (at_id, emp_num, date_filed, client, origin, destination, departure, purpose, type, status)
						VALUES ('$ID', '$_SESSION[emp_num]','$today', '$client', '$origin','$destination', '$etd', '$purpose', '$type', 'Pending') ";
		}elseif($_POST['selection']=="rt"){
			$str = "INSERT INTO ems_air_ticket (at_id, emp_num, date_filed, client, origin, destination, departure, arrival, purpose, type, status)
						VALUES ('$ID', '$_SESSION[emp_num]','$today', '$client', '$origin<br/>$destination','$destination<br/>$origin','$etd','$eta', '$purpose', '$type', 'Pending') ";	
		}elseif($_POST['selection']=="multi"){
			$str = "INSERT INTO ems_air_ticket (at_id, emp_num, date_filed, client, origin, destination, departure, purpose, type, status)
						VALUES ('$ID', '$_SESSION[emp_num]','$today', '$client', '$origin<br/>$destination','$origin2<br/>$origin','$etd<br/>$eta<br/>$etd2', '$purpose', '$type', 'Pending') ";
		}
	
		$qry = $dblink->db_qry($str);
		send_email_pending("air ticket request", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_airticket_request.php"); //param(type of application, emp, dept) 
		echo '<script>window.location = \'view_edit_airticket.php\';</script>';
		
	}elseif(isset($_POST['submit'], $_GET['sa']) && $_POST['submit']=="update"){ // SALES ADMIN UPDATE
		$qry_stat = mysql_query("SELECT status FROM ems_air_ticket WHERE at_id='$_GET[ID]' ");
		$stat = mysql_result($qry_stat, 0);
			if($stat=="Confirmed for Re-booking"){
				$status = "Reviewed for Re-booking";
				$state= "6";
			}else{
				$status = "Reviewed";
				$state= "2";
			}
			
			if(isset($_POST['chk'])){
				unlink("attachments/".$result[18]);
				$fname = $_FILES["file"]["name"];		
				move_uploaded_file($_FILES["file"]["tmp_name"], "attachments/".$fname);
			}elseif(!empty($_FILES["file"]["name"])){
				$fname = $_FILES["file"]["name"];		
				move_uploaded_file($_FILES["file"]["tmp_name"], "attachments/".$fname);
			}else{
				$fname = $result[18];
			}
						
			if($_POST['selection']=="ow"){
				$str = "UPDATE ems_air_ticket SET  client='$client', origin='$origin<br/>$destination', destination='$destination<br/>$origin', departure='$etd', 
							type='$type', purpose='$purpose', amount='$amount', status='$status', state='$state', attachment='$fname'
							WHERE at_id='$_GET[ID]' ";	
			}elseif($_POST['selection']=="rt"){
				$str = "UPDATE ems_air_ticket SET  client='$client', origin='$origin<br/>$destination', destination='$destination<br/>$origin', departure='$etd', arrival='$eta', 
							type='$type', purpose='$purpose', amount='$amount', status='$status', state='$state', attachment='$fname'
							WHERE at_id='$_GET[ID]' ";	
			}elseif($_POST['selection']=="multi"){
				$str = "UPDATE ems_air_ticket SET  client='$client', origin='$origin<br/>$origin2', destination='$destination<br/>$origin', departure='$etd<br/>$eta<br/>$etd2', 
							type='$type', purpose='$purpose', amount='$amount', status='$status', state='$state', attachment='$fname'
							WHERE at_id='$_GET[ID]' ";		
			}		
		$qry = $dblink->db_qry($str);	
		header("location:view_airticket_request.php");
		
	}elseif(isset($_POST['submit']) && $_POST['submit']=="update"){ // EMPLOYEE UPDATE
		if($_POST['selection']=="ow"){
			$str = "UPDATE ems_air_ticket SET  client='$client', origin='$origin', destination='$destination', departure='$etd', 
						type='$type', purpose='$purpose'
						WHERE at_id='$_GET[ID]' ";	
		}elseif($_POST['selection']=="rt"){
			$str = "UPDATE ems_air_ticket SET  client='$client', origin='$origin<br/>$destination', destination='$destination<br/>$origin',  departure='$etd', arrival='$eta', 
						type='$type', purpose='$purpose'
						WHERE at_id='$_GET[ID]' ";	
		}elseif($_POST['selection']=="multi"){
			$str = "UPDATE ems_air_ticket SET  client='$client', origin='$origin<br/>$origin2', destination='$destination<br/>$origin',  departure='$etd<br/>$eta<br/>$etd2', 
						type='$type', purpose='$purpose'
						WHERE at_id='$_GET[ID]' ";		
		}
		$qry = $dblink->db_qry($str);
		header("location:view_edit_airticket.php");
		
	}elseif(isset($_POST['submit']) && $_POST['submit']=="rebook"){
		$str = "UPDATE ems_air_ticket SET  client='$client', origin='$origin', destination='$destination', departure='$etd', arrival='$eta', 
					purpose='$purpose', status='Pending for Re-booking', state='4'
					WHERE at_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		header("location:view_edit_airticket.php");
	}
	
	if(isset($_GET['sa'])){
		$data_org = split('<br/>',$result['origin']);
		$data_des = split('<br/>',$result['destination']);
		$data_dep = split('<br/>',$result['departure']);
		$data_arr = split('<br/>',$result[11]);
	}else{
		$data_org = split('<br/>',$result['origin']);
		$data_des = split('<br/>',$result['destination']);
		$data_dep = split('<br/>',$result['departure']);
		$data_arr = split('<br/>',$result[11]);
	}
		$origin = $data_org[0];
		$origin2 = $data_org[1];
		$des = $data_des[0];
		$des2 = $data_des[1];
		$dep = $data_dep[0];
		$dep2 = $data_dep[1];
		$arr = $data_arr[0];
		$arr2 = $data_arr[1];
		
	if(isset($_GET['action'])){
		$qry = mysql_query("SELECT type FROM ems_air_ticket WHERE at_id='$_GET[ID]' ");
		$row_type = mysql_fetch_array($qry);
		if($row_type[0]=='ow'){
			$chk_ow = "checked";
			$bold_ow = "style='font-weight:bold;'";
		}elseif($row_type[0]=='rt'){
			$chk_rt = "checked style='font-weight:bold;'";
			$bold_rt = "style='font-weight:bold;'";
		}elseif($row_type[0]=='multi'){
			$chk_multi = "checked style='font-weight:bold;'";
			$bold_multi = "style='font-weight:bold;'";
		}
	}	
	?>

<!--/JD-2012/06/11 - Remove Airline in forms  -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>iEMS</title>
        <link href="calendar/calendar.css" rel="stylesheet" type="text/css">
        <link href="css/home-format.css" rel="stylesheet">
		<script language="javascript" src="calendar/calendar.js"></script>
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
        <!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="assets/js/materialize.min.js"></script>

		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />

		<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  
        <link rel='stylesheet' href='cssall.css' type='text/css' />
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript" src="validator.js"></script>
        <script type="text/javascript" src="datetime/datetimepicker.js"></script>
        
        <script type="text/javascript">
        
            $(document).ready(function(){
            $(".etd_2").hide();
            $("#tbody").hide();
            $("#ow").click(function(){
                if($("#ow:checked").val()=='ow'){
                    $("#tbody").show();
                    $(".data2").hide();	
                    $("#lbl_mu").css({'font-weight' : 'normal'});
                    $("#lbl_rt").css({'font-weight' : 'normal'});
                    $("#lbl_ow").css({'font-weight' : 'bold'});
                    $(".eta").hide();
                    $(".etd_2").hide();
                }
            });	
            
            $("#rt").click(function(){
                if($("#rt:checked").val()=='rt'){
                    $("#tbody").show();
                    $(".data2").hide();
                    $("#lbl_ow").css({'font-weight' : 'normal'});
                    $("#lbl_mu").css({'font-weight' : 'normal'});
                    $("#lbl_rt").css({'font-weight' : 'bold'});
                    $(".eta").show().html('Return On: <span class="a">*</span>');			
                    $(".etd_2").hide();
                }
            });
            
            $("#multi").click(function(){
                if($("#multi:checked").val()=='multi'){
                    $("#tbody").show();		
                    $(".data2").show();	
                    $("#lbl_ow").css({'font-weight' : 'normal'});
                    $("#lbl_rt").css({'font-weight' : 'normal'});
                    $("#lbl_mu").css({'font-weight' : 'bold'});
                    $(".eta").show().html('Depart On: <span class="a">*</span>');
                    $(".etd_2").show();
                }
            });
            
            if($("#ow:checked").val()=='ow'){
                $("#tbody").show();
                $("#rt").attr("disabled", true);
                $("#multi").attr("disabled", true);
                $(".eta").hide();
                $(".data2").hide();
            }if($("#rt:checked").val()=='rt'){
                $("#tbody").show();	
                $(".eta").show();
                $(".data2").hide();
                $("#ow").attr("disabled", true);
                $("#multi").attr("disabled", true);
            }else if($("#multi:checked").val()=='multi'){
                $("#tbody").show();	
                $(".data2").show();	
                $(".eta").show().html('Depart On: <span class="a">*</span>');			
                $("#rt").attr("disabled", true);
                $("#ow").attr("disabled", true);
                var dep2 = $("#multi_etd2").val();
                var dep3 = $("#multi_etd3").val();
                $("#eta").val(dep2);
                $("#etd_2").val(dep3);
                $(".etd_2").show();
            }		
            
            $("#submit, #rebook").click(function(){
                if($("#ow").is(':checked')){
                    if($("#client").val()=="" || $("#origin").val()=="" || $("#destination").val()=="" || $("#purpose").val()=="" || $("#etd").val()==""){
                        alert("Please fill-out required fileds!");
                        return false;
                    }
                }else if($("#rt").is(':checked')){
                    if($("#client").val()=="" || $("#origin").val()=="" || $("#destination").val()=="" || $("#purpose").val()=="" || $("#etd").val()=="" || $("#eta").val()=="" ){
                        alert("Please fill-out required fileds!");
                        return false;
                    }
                }else if($("#multi").is(':checked')){
                    if($("#client").val()=="" || $("#origin").val()=="" || $("#destination").val()=="" || $("#purpose").val()=="" || $("#etd").val()=="" || $("#origin_2").val()=="" || $("#eta").val()=="" || $("#etd_2").val()==""){
                        alert("Please fill-out required filedsss!");
                        return false;
                    }
                }
            });
            
            $("#chk").click(function(){
                if($("#chk").is(":checked")){
                    $("#attached").hide();	
                    $("#file").show();	
                }else{
                    $("#attached").show();	
                    $("#file").hide();	
                }
            });
            
            if($("#attached").html()){
                $("#attached").css({
                    'color' : 'blue',
                    'font-weight' : 'bold'
                });
                $("#file").hide();
            }else{
                $("#lbl_chk").hide();
            }
            
            $("#help").click(function(){
                var left = parseInt((screen.availWidth/2) - (500/2));
                var top = parseInt((screen.availHeight/2) - (300/2));
                window.open("help_air.html", "_blank", "modal=yes, toolbar=no, left="+left+", top="+top+", location=yes, directories=no, status=1, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=500, height=300"); 
                event.preventDefault();
                return false;
            });
            });
        </script>
    </head>
    <body link="blue" alink="blue" vlink="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    <?php include("menu.php"); ?>
    <form name="form_airticket" action="<?php $PHP_SELF;?>" method="POST" enctype="multipart/form-data">
    <div id="container">
   
   <div class="container"> 
		<div class="page-header" style="width:870px!important;">
			<h4><strong class="blue-text text-darken-2"> Air Ticket Application </strong></h4>
		</div>
	</div>
                        
    <!--SELECTION-->	
	<ul class="nav nav-tabs" role="tablist"  style="width:865px!important;">
		<li role="presentation" name="selection" class="active" id="ow" value="ow" <?php echo $chk_ow; ?>><a href="#oneway" aria-controls="oneway" role="tab" data-toggle="tab">One Way</a></li>
		<li role="presentation" name="selection" id="rt" value="rt" <?php echo $chk_rt; ?>><a href="#roundtrip" aria-controls="roundtrip" role="tab" data-toggle="tab">Round Trip</a></li>
		<li role="presentation" name="selection" id="multi" value="multi" <?php echo $chk_multi; ?>><a href="#multiple" aria-controls="multiple" role="tab" data-toggle="tab">Multiple</a></li>
	</ul>
    <!--END-->	
	
	
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="oneway">
			<!-------------------------One Way Ticket-------------------------->
			<div class="row"><br><br>
				<div class="input-field col s6">
				  <input style="color:black !important;width: 386px !important;font-size: 13px !important;margin-left: 87px !important;" placeholder="Enter Client Name" id="client" type="text" name="client" value="<?php echo $client = (isset($_GET['sa'])) ? $result[1] : $result[1];?>" required/>
				  <label for="client" style="padding-left:0px;width:100px;margin-left:217px!important;"><i class="fa fa-user"></i>  CLIENT</label>
				</div>
			</div>
			<div class="row">
			<div class="input-field col s14">
				<input placeholder="Enter Place of Origin" id="origin" type="text" class="origin1" name="origin" value="<?php echo $origin ;?>" required/>
				<label class="origin" for="origin"><i class="fa fa-map-marker"></i>  ORIGIN</label>
			</div>
			<div class="input-field col s15">
				<input placeholder="Select Depart Date and Time" id="etda" type="text" class="etd1" name="etd" value="<?php echo $result[4] ;?>" required/>
				<label class="etd" for="etda"><i class="fa fa-calendar-o"></i>  DEPART ON</label>
				<a href="javascript:NewCal('etda','MMMddyyyy',true,12)"><i class="fa fa-calendar fa-2x"></i></a>
			</div>
			</div>
			<div class="row">
			<div class="input-field col s6">
				<input placeholder="Enter Destination" id="destination" type="text" class="destination1" style="margin-left: 86px !important;" name="destination" value="<?php echo $des;?>" required/>
				<label class="destination" for="destination"><i class="fa fa-map-marker"></i>  DESTINATION</label>
			</div>
			</div>
			<div class="row">
				<form class="col s12">
				  <div class="row">
					<div class="input-field col s12">
					  <textarea placeholder="What's the purpose of your trip?" id="purpose" class="materialize-textarea" name="purpose" style="margin-left: 230px !important; width: 826px !important;" required/><?php echo $pur = (isset($_GET['sa'])) ? $result[6] : $result[6] ;?></textarea>
					  <label class="purpose" for="purpose"><i class="fa fa-pencil"></i>  PURPOSE OF TRIP</label>
					</div>
				  </div>
			  
			  <div class="disclaimer note_air"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong>All fields are required.</div>
				<br><br><br><br>
				<?php
                    if(isset($_GET['ID'], $_GET['action'], $_GET['rebook'] )){
                        echo '<td><input style="margin-left: 225px !important;" type="submit" name="submit" value="rebook" class="btn btn-primary" id="rebook"/></td>';							
                    }elseif(isset($_GET['sa'])){
                        echo '<td><input style="margin-left: 225px !important;" type="submit" name="submit" value="update" class="btn btn-primary" id="update_sa"/></td>';
                    }elseif(isset($_GET['action'], $_GET['ID'])){
                        echo '<td><input style="margin-left: 225px !important;" type="submit" name="submit" value="update" class="btn btn-primary" id="update"/></td>';		
                    }else{
                        echo '<td><input style="margin-left: 225px !important;" type="submit" name="submit" value="submit" class="btn btn-primary" id="submit"/></td>';
                    }
                ?>
			</form>
		  </div>
		</div>
		<div role="tabpanel" class="tab-pane" id="roundtrip">
			<!-------------------------Round Trip-------------------------->
			<div class="row"><br><br>
				<div class="input-field col s6">
				  <input style="color:black !important;width: 386px !important;font-size: 13px !important;margin-left: 87px !important;" placeholder="Enter Client Name" id="client" type="text" name="client" value="<?php echo $client = (isset($_GET['sa'])) ? $result[1] : $result[1];?>" required/>
				  <label for="client" style="padding-left:0px;width:100px;margin-left:217px!important;"><i class="fa fa-user"></i>  CLIENT</label>
				</div>
			</div>
			<div class="row">
			<div class="input-field col s14">
				<input placeholder="Enter Place of Origin" id="origin" type="text" class="origin1" name="origin" value="<?php echo $origin ;?>" required/>
				<label class="origin" for="origin"><i class="fa fa-map-marker"></i>  ORIGIN</label>
			</div>
			<div class="input-field col s15">
				<input placeholder="Select Depart Date and Time" id="etdb" type="text" class="etd1" name="etd1" value="<?php echo $result[4] ;?>" required/>
				<label class="etd" for="etd"><i class="fa fa-calendar-o"></i>  DEPART ON</label>
				<a href="javascript:NewCal('etdb','MMMddyyyy',true,12)"><i class="fa fa-calendar fa-2x"></i></a>
			</div>
			</div>
			<div class="row">
			<div class="input-field col s14">
				<input placeholder="Enter Destination" id="destination" type="text" class="destination1" name="destination" value="<?php echo $des;?>" required/>
				<label class="destination" for="destination"><i class="fa fa-map-marker"></i>  DESTINATION</label>
			</div>
			<div class="input-field col s15">
				<input placeholder="Select Depart Date and Time" id="eta" type="text" class="eta1" name="eta" value="<?php echo $result[5];?>" required/>
				<input type="hidden" id="multi_etd2" value="<?php echo $data_dep[1]; ?>">
				<label class="eta" for="eta"><i class="fa fa-calendar-o"></i>  RETURN ON</label>
				<a href="javascript:NewCal('eta','MMMddyyyy',true,12)"><i class="fa fa-calendar fa-2x"></i></a>
			</div>
			</div>
			<div class="row">
				<form class="col s12">
				  <div class="row">
					<div class="input-field col s12">
					  <textarea placeholder="What's the purpose of your trip?" id="purpose" class="materialize-textarea" name="purpose" style="margin-left: 222px !important; width: 826px !important;" required/><?php echo $pur = (isset($_GET['sa'])) ? $result[6] : $result[6] ;?></textarea>
					  <label class="purpose" for="purpose" style="margin-left: 92px !important;"><i class="fa fa-pencil"></i>  PURPOSE OF TRIP</label>
					</div>
				  </div>
			  
			  <div class="disclaimer note_air" style="margin-left: 214px !important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong>All fields are required.</div>
				<br><br><br><br>
				<?php
                    if(isset($_GET['ID'], $_GET['action'], $_GET['rebook'] )){
                        echo '<td><input style="margin-left: 217px !important;" type="submit" name="submit" value="rebook" class="btn btn-primary" id="rebook"/></td>';							
                    }elseif(isset($_GET['sa'])){
                        echo '<td><input style="margin-left: 217px !important;" type="submit" name="submit" value="update" class="btn btn-primary" id="update_sa"/></td>';
                    }elseif(isset($_GET['action'], $_GET['ID'])){
                        echo '<td><input style="margin-left: 217px !important;" type="submit" name="submit" value="update" class="btn btn-primary" id="update"/></td>';		
                    }else{
                        echo '<td><input style="margin-left: 217px !important;" type="submit" name="submit" value="submit" class="btn btn-primary" id="submit"/></td>';
                    }
                ?>
			</form>
		  </div>
		</div>
		<div role="tabpanel" class="tab-pane" id="multiple">
			<!-------------------------Multiple Trips-------------------------->
			<div class="row"><br><br>
				<div class="input-field col s6">
				  <input style="color:black !important;width: 386px !important;font-size: 13px !important;margin-left: 87px !important;" placeholder="Enter Client Name" id="client" type="text" name="client" value="<?php echo $client = (isset($_GET['sa'])) ? $result[1] : $result[1];?>" required/>
				  <label style="padding-left:0px;width:100px;margin-left:217px!important;" for="client"><i class="fa fa-user"></i>  CLIENT</label>
				</div>
			</div>
			<div class="row">
			<div class="input-field col s14">
				<input placeholder="Enter Place of Origin" id="origin" type="text" class="origin1" name="origin" value="<?php echo $origin ;?>" required/>
				<label class="origin" for="origin"><i class="fa fa-map-marker"></i>  ORIGIN</label>
			</div>
			<div class="input-field col s15">
				<input placeholder="Select Depart Date and Time" id="etdc" type="text" class="etd1" name="etd" value="<?php echo $result[4] ;?>" required/>
				<label class="etd" for="etdc"><i class="fa fa-calendar-o"></i>  DEPART ON</label>
				<input type="hidden" id="multi_etd3" value="<?php echo $data_dep[2]; ?>">
				<a href="javascript:NewCal('etdc','MMMddyyyy',true,12)"><i class="fa fa-calendar fa-2x"></i></a>
			</div>
			</div>
			<div class="row">
			<div class="input-field col s14">
				<input placeholder="Enter Destination" id="destination" type="text" class="destination1" name="destination" value="<?php echo $des;?>" required/>
				<label class="destination" for="destination"><i class="fa fa-map-marker"></i>  DESTINATION</label>
			</div>
			<div class="input-field col s15">
				<input placeholder="Select Depart Date and Time" id="eta1" type="text" class="eta1" name="eta" value="<?php echo $result[5];?>" required/>
				<input type="hidden" id="multi_etd2" value="<?php echo $data_dep[1]; ?>">
				<label class="eta" for="eta1"><i class="fa fa-calendar-o"></i>  RETURN ON</label>
				<a href="javascript:NewCal('eta1','MMMddyyyy',true,12)"><i class="fa fa-calendar fa-2x"></i></a>
			</div>
			</div>
			<div class="row">
			<div class="input-field col s14">
				<input placeholder="Enter Place of Origin" id="origin_2" type="text" class="origin1" name="origin_2" value="<?php echo $origin2; ?>" required/>
				<label class="origin" for="origin_2" style="width:290px !important;"><i class="fa fa-map-marker"></i>  2ND DESTINATION</label>
			</div>
			<div class="input-field col s15">
				<input placeholder="Select Depart Date and Time" id="etd" type="text" class="etd1" name="etd" value="<?php echo $result[4] ;?>" required/>
				<label class="etd" for="etd"><i class="fa fa-calendar-o"></i>  DEPART ON</label>
				<a href="javascript:NewCal('etd','MMMddyyyy',true,12)"><i class="fa fa-calendar fa-2x"></i></a>
			</div>
			</div>
			<div class="row">
				<form class="col s12">
				  <div class="row">
					<div class="input-field col s12">
					  <textarea placeholder="What's the purpose of your trip?" id="purpose" class="materialize-textarea" name="purpose" style="margin-left: 222px !important; width: 826px !important;" required/><?php echo $pur = (isset($_GET['sa'])) ? $result[6] : $result[6] ;?></textarea>
					  <label class="purpose" for="purpose" style="margin-left: 92px !important;"><i class="fa fa-pencil"></i>  PURPOSE OF TRIP</label>
					</div>
				  </div>
			  
			  <div class="disclaimer note_air" style="margin-left: 214px !important;"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> All fields are required.</div>
				<br><br><br><br>
				<?php
                    if(isset($_GET['ID'], $_GET['action'], $_GET['rebook'] )){
                        echo '<td><input style="margin-left: 217px !important;" type="submit" name="submit" value="rebook" class="btn btn-primary" id="rebook"/></td>';							
                    }elseif(isset($_GET['sa'])){
                        echo '<td><input style="margin-left: 217px !important;" type="submit" name="submit" value="update" class="btn btn-primary" id="update_sa"/></td>';
                    }elseif(isset($_GET['action'], $_GET['ID'])){
                        echo '<td><input style="margin-left: 217px !important;" type="submit" name="submit" value="update" class="btn btn-primary" id="update"/></td>';		
                    }else{
                        echo '<td><input style="margin-left: 217px !important;" type="submit" name="submit" value="submit" class="btn btn-primary" id="submit"/></td>';
                    }
                ?>
			
			</form>
		  </div>
		</div>
	</div>
    </div>
          </div>
    </form>
		<?php include("footer.php"); ?>
		
    </body>
</html>