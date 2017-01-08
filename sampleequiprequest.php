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
	$needed = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
	
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
    </head>
    <body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    	<div id="container">
			<?php include("menu.php"); ?>
            <div id="cc" style="width:600px;">
				<div>
                	<span class="title">Request Equipment</span>
				</div>
    			<form name="form_rqstn" action="<?php $PHP_SELF;?>" method="POST">
				<table border='0' class="t" width="100%">
                	<tr>
                    	<td width='30%'>Date Filed:</td>
                        <td><?php echo $d = ($result[4]) ? $result[4] : date("Y-m-d");?></td>
                    </tr>
                    <tr>
                    	<td>Name:</td>
                        <td><?php echo $name = ($result[5]) ? $result[5] : $_SESSION['fullname'];?></td>
					</tr>
                    <tr>
                    	<td>Department:</td>
                        <td><?php echo $dept = ($result[6]) ? $result[6] : $_SESSION['dept_name'];?></td>
					</tr>
                    <tr>
                    	<td>Date Needed: <span class="a">*</span></td>
                        <td><?php calendar1($result[3]);?></td>
					</tr>
                    <tr>
                    	<td>Item/s:</td>	
						<td>
                        	<table border="0" width="100%" >
                                <tr>
                                    <td width="14%">Qty: <span class="a">*</span></td>
                                    <td style="padding-left: 90px;">Particular: <span class="a">*</span></td>
                                </tr>
                                <tr>
                                	<td colspan="2">
                                    	<input type="text" name="qty[]" class="qty" size="1" value="<?php echo $get_qty[0]; ?>"/>
                                        <input type="date" name="item[]" size="58" value="<?php echo $get_item[0]; ?>"/>					
										<?php
										//for the display of the records
                                            echo '<div id="field">';
                                            if($result[0]){
                                                $last_id = sizeof($index)-2;
                                                    for($i=1;$i<sizeof($index)-1;$i++){
                                                        echo '<div id="s',$i,'">';
                                                        echo '<input type="text" name="qty[]" class="qty" size="1" value="',$get_qty[$i],'"/>
															<input type="date" name="item[]" size="58" value="',$get_item[$i],'"/>
																<a href="javascript:remove(\'s',$i,'\');"><img src="icons/remove.png"/></a><br/>';
                                                        echo '</div>';
                                                    }
                                            echo '</div>';
                                            }
										//end
                                        ?>
									</td>
								</tr>		  	
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right" style="padding-right:50px;">
                        	<a href="javascript:add(<?php echo $last_id;?>);"><img src="icons/plus.png"/></a>
                        </td>
					</tr>
                    <tr>
                    	<td>Purpose: <span class="a">*</span></td>
                        <td style="padding-left:4px;"><textarea cols="65" rows="3" name="purpose"><?php echo $result[2];?></textarea></td>
					</tr>		
					<?php echo $tr = ($_GET['action']=="ad_edit") ? '<tr>' : '<tr style="display:none;">';?>
						<td>Amount: <span class="a">*</span></td>
						<td style="padding-left:4px;"><input type="text" name="amount" value="<?php echo $result[7];?>"/></td>
					</tr>
                    <tr><td colspan='4'><hr/></td></tr>
					<tr>
						<?php
						
							if($_GET['action']=="request_edit"){
								echo '<td><input type="submit" name="submit" value="update" class="update" onclick="return validate();"/></td>';
							}elseif($_GET['action']=="ad_edit"){
								echo '<td><input type="submit" name="submit" value="save" class="save" onclick="return validate();"/></td>';
							}else{
								echo '<td><input type="submit" name="submit" value="submit" class="submit" onclick="return validate();"/></td>';
							}
					?>
						<td colspan="2" align="right">Fields marked with an asterisk <span class="a">*</span> are required.</td>
					</tr>
				</table>
				</form>
			</div>
		</div>
        <div id="footer">
            <br/>
            <p>Copyright 2011</p>
        </div>
	</body>
</html>
<script type="text/javascript">
	var frmvalidator  = new Validator("form_rqstn");
	frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("qty[]","req","Please enter quantity.");
	frmvalidator.addValidation("item[]","req","Please enter item.");
</script>