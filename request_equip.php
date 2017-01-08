<?php
ob_start();
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
	
	
	if(isset($_GET['ID'])){
		$str = "SELECT qty, items, purpose, date_needed, date_filed, CONCAT(emp_firstname,' ',emp_middlename,' ',emp_lastname), dept_name, amount FROM ems_equip_requisitions AS r
					INNER JOIN ems_employee AS e 
					ON r.emp_num = e.emp_num
					INNER JOIN ems_department AS d
					ON e.dept_code = d.dept_code
					WHERE erqstn_id='$_GET[ID]' ";
		$qry = $dblink->db_qry($str);
		$result = $dblink->get_data($qry);
		$index = explode("|", $result[0]);
		$get_qty = explode("|", $result[0]);	
		$get_item = explode("|", $result[1]);	
	
	}
	
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
	
	$qry_num = mysql_query("SELECT erqstn_id FROM ems_equip_requisitions ORDER BY erqstn_id DESC");
	$count = mysql_num_rows($qry_num);
		if($count==0){
			$ID = "ER2011001";
		}else{
			$qry_id = mysql_result($qry_num, 0);
			$ID = id($qry_id);
		}
	
		
	$today = date("Y-m-d");
	$needed = $_POST["form_date"];
		$qty = $_POST['qty'];
			for($i=0;$i<sizeof($qty);$i++){
				if($qty[$i]!=""){
					$quantity = $quantity . $qty[$i] . "|";
				}
		}
		$item = $_POST['item'];
			for($i=0;$i<sizeof($item);$i++){
				if($item[$i]!=""){
					$items = $items . $item[$i] . "|";
				}
		}
	$purpose = $_POST['purpose'];	
	$amount = $_POST['amount'];
	
	
	if(isset($_POST['submit']) && $_POST['submit']=="submit"){
				$str = "INSERT INTO ems_equip_requisitions (erqstn_id, emp_num, date_Filed, date_needed, qty, items, purpose, status)
							VALUES ('$ID', '$_SESSION[emp_num]','$today','$needed','$quantity','$items', '$purpose', 'Pending') ";
				$qry = $dblink->db_qry($str);
				send_email_pending("equipment requisition", $_SESSION['fullname'], $_SESSION['dept_code'], "http://iripple.net:82/ems/view_requisition.php"); //param(type of application, emp, dept) 
				// header("location:view_edit_requisition.php");			
				echo '<script>window.location = \'view_edit_requisition.php\';</script>';
				
	}elseif(isset($_POST['submit']) && $_POST['submit']=="update"){
				$str = "UPDATE ems_equip_requisitions SET date_needed='$needed', qty='$quantity', items='$items', purpose='$purpose' WHERE erqstn_id='$_GET[ID]' ";
				$qry = $dblink->db_qry($str);
				header("location:view_edit_requisition.php");
				
	}elseif(isset($_POST['submit']) && $_POST['submit']=="save"){
				$str = "UPDATE ems_equip_requisitions SET date_needed='$needed', qty='$quantity', items='$items', purpose='$purpose', amount='$amount', status='In Process' WHERE erqstn_id='$_GET[ID]'";
				$qry = $dblink->db_qry($str);
				header("location:view_requisition.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    <title>iEMS</title>
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/mine.css"  media="screen,projection"/>
    <link href="css/home-format.css" rel="stylesheet">
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
	<script type="text/javascript" src="assets/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
	<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <link href="calendar/calendar.css" rel="stylesheet" type="text/css">
    <link rel='stylesheet' href='cssall.css' type='text/css' />
    <script language="javascript" src="calendar/calendar.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="navigation.js"></script>
    <script type="text/javascript" src="jsFunctions.js"></script>
    <script type="text/javascript" src="validator.js"></script>
    <script type="text/javascript" src="datetime/datetimepicker.js"></script>
    <script type="text/javascript" language="javascript">
    
		var counter = 1;
    
			function add(id){
            	if(id==null){
                	id = 0;
            	}		
				counter =  counter + id;
				var div = document.createElement("div");
				div.setAttribute("id","s"+counter);
				var a_tag = document.createElement("a");
				
				var qty = document.createElement("input");
				qty.setAttribute("type", "text");
				qty.setAttribute("id","q"+counter);		
				qty.setAttribute("class", "qty");
				qty.setAttribute("name", "qty[]");
				qty.setAttribute("size", "1");	
				
				var item = document.createElement("input");
				item.setAttribute("type", "text");
				item.setAttribute("id","i"+counter);	
				item.setAttribute("name", "item[]");	
				item.setAttribute("size", "58");	
				a_tag.setAttribute("href", "javascript:remove('s"+counter+"');");
				
				var image = document.createElement("img");
				image.src = "icons/remove.png";
				a_tag.appendChild(image);
				
				div.appendChild(qty);
				div.appendChild(item);
				div.appendChild(a_tag);
		
				document.getElementById("field").appendChild(div);
				counter++;
				qty.focus();
			}
            
        function remove(i){ 
            var elm = document.getElementById(i); 
            var name = document.getElementsByName(i);
            document.getElementById("field").removeChild(elm); 
		}
         
		function validate(){
            var date = document.form_rqstn.date1.value;
            var purpose = document.form_rqstn.purpose.value;
            var qty = document.getElementsByName('qty[]');
            var item = document.getElementsByName('item[]');
            var patt = new RegExp(/[^0-9]/);
            
			var valid = false;
			var valid2 = false;
			for (var i=0; i<qty.length; i++){
				if(qty[i].value!=""){	
					valid = true;
					break;
				}
			}
			
			for (var i=0; i<item.length; i++){
				if(item[i].value!=""){	
					valid2 = true;
					break;
				}
			}
			
			if(date=="0000-00-00" || purpose==""){
				alert("Please fill-out required fields!");
				return false;
			}else{
				for (var i=0; i<qty.length; i++){
					if(qty[i].value!=""){	
						break;
					}
				}       
				if(patt.test(qty[i].value) || qty[i].value<=0){
					alert("Invalid quantity!");
					return false;
				}else{
					return true;
				}
			}
			return true;		
		}
    </script>
	<style>
		#calendar-header{
			height: 50px !important;
		}
	</style>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script>
		$(function() {
			$( "#form_date" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1,
				onSelect: function(selectedDate){
					$tempdate = selectedDate;
				}
			});
		});
		</script>
    </head>
    <body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
	<?php include("menu.php"); ?>
	<form name="form_rqstn" action="<?php $PHP_SELF;?>" method="POST">
    	<div id="container">
			<div class="container">
				<div class="page-header">
					<h4><strong class="formTitle"> Request Equipment </strong></h4>
				</div>
			</div>		
                    <?php $d = ($result[4]) ? $result[4] : date("Y-m-d");
                     $name = ($result[5]) ? $result[5] : $_SESSION['fullname'];
					 $dept = ($result[6]) ? $result[6] : $_SESSION['dept_name'];?>
					
						<!-- Registration form - START -->
						<div class="container">
							<div class="row">
								  
								  <div class="row">
									  <div class="row">
										<div class="input-field col s6">
											<input placeholder="Select Needed Date" id="form_date" type="text" class="form_date1" name="form_date" value = "<?php echo ($result[3] != '')? date('m/d/Y', strtotime($result[3])) : ''; ?>" required/>
											<label class="form_date" for="form_date"><i class="fa fa-calendar-o"></i>  DATE NEEDED</label>
										</div>
										<div class="input-field col s14">
										  <?php echo $tr = ($_GET['action']=="ad_edit") ? '<tr>' : '<tr style="display:none;">';?>
										  <input placeholder="Enter Amount" id="amount" name="amount" type="text" class="amount1" value="<?php echo $result[7];?>" required>
										  <label class="amount" for="amount"><i class="fa fa-tasks"></i>  AMOUNT</label>
										</div>
									  </div>
									</form>
								  </div>
								  
								  <div class="row">
									<div class="input-field col s15">
									  <input placeholder="Enter Number of Items" id="qty" name="qty[]" type="text" class="qty1" value="<?php echo $get_qty[0]; ?>" required>
									  <label class="qty" for="qty">&nbsp &nbsp &nbsp &nbsp &nbsp<i class="fa fa-list-ol"></i>  QUANTITY</label>
									</div>
									<div class="input-field col s15">
									  <input placeholder="Enter Item Description" id="item" name="item[]" type="text" class="item1" value="<?php echo $get_item[0]; ?>" required>
									  <label class="item" for="item"><i class="fa fa-desktop"></i>  PARTICULAR</label>
									</div>
									<div class="input-field col s15">
										<a href="javascript:add(<?php echo $last_id;?>);"><i class="fa fa-plus-circle fa-2x"></i></a>
									</div>
								  </div>
								  
														<?php
															echo '<div id="field">';
															if($result[0]){
																$last_id = sizeof($index)-2;
																	for($i=1;$i<sizeof($index)-1;$i++){
																		echo '<div id="s',$i,'">';
																		echo '<input placeholder="Enter Number of Items" id="time_start" type="text" name="qty[]" class="qty1" value="',$get_qty[$i],'"/>
																			  <input placeholder="Enter Item Description" id="time_end" type="text" name="item[]" value="',$get_item[$i],'"/>
																				<a href="javascript:remove(\'s',$i,'\');"><i class="fa fa-times-circle fa-2x"></i></a><br/>';
																		echo '</div>';
																	}
															echo '</div>';
															}
														?>
										<div class="row">
											  <div class="row">
												<div class="input-field col s12">
												  <textarea placeholder="Enter purpose/s" id="textarea1" class="materialize-textarea ta1" name="purpose" required/><?php echo $result[2];?></textarea>
												  <label class="text1" for="textarea1"><i class="fa fa-pencil"></i>  PURPOSE</label>
												</div>
											  </div>
											  <div class="disclaimer note"><i class="fa fa-asterisk"></i> <strong>NOTE:</strong> All fields are required.</div>
												<br><br><br><br>
												
												<?php		
													if($_GET['action']=="request_edit"){
														echo '<input style="margin-left:10%important;" type="submit" name="submit" value="update" class="update button btn btn-success" onclick="return validate();"/>';
													}elseif($_GET['action']=="ad_edit"){
														echo '<input style="margin-left:10%!important;" type="submit" name="submit" value="save" class="save button btn btn-success" onclick="return validate();"/>';
													}else{
														echo '<input style="margin-left:10%!important;" type="submit" name="submit" value="submit" class="submit button btn btn-success" onclick="return validate();"/>';
													}ob_flush();
												?>
										</div>
							</div>
						</div>
	</div>
   
					</form>
		<?php include("footer.php"); ?>
	</body>
</html>
<script type="text/javascript">
	var frmvalidator  = new Validator("form_rqstn");
	frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("qty[]","req","Please enter quantity.");
	frmvalidator.addValidation("item[]","req","Please enter item.");
</script>