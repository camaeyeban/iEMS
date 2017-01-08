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
			$( "#date_needed" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				changeYear: true,
				numberOfMonths: 1
			});
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
		<script language="javascript">
		
			function addRow(tableID){
			
				var table=document.getElementById(tableID);
				var rowCount=table.rows.length;
				var row=table.insertRow(rowCount);
				var colCount=table.rows[1].cells.length
				
				for(var i=0;i<colCount;i++){
				
					var newcell=row.insertCell(i);
					
					if(i < 2)
					{
						newcell.innerHTML=table.rows[1].cells[i].innerHTML;
						
					}
					else if(i < 5)
					{
						var buttonnode= document.createElement('input');
						buttonnode.setAttribute('type','text');
						
						if(i == 2) buttonnode.setAttribute('name','amount['+(rowCount-1)+']');
						else if(i == 3) buttonnode.setAttribute('name','quantity['+(rowCount-1)+']');
						else buttonnode.setAttribute('name','total['+(rowCount-1)+']');
						
						buttonnode.setAttribute('value','0');
						buttonnode.setAttribute('style','text-align : center');
						//buttonnode.setAttribute('required');
						if(i == 4)
							buttonnode.setAttribute('readonly','true');
						
						if(i != 4)
						buttonnode.onblur = function() { 
												
												if (isNaN(this.value))
												{
													alert('Invalid Value');
													this.value = 0;
													return false;
												}
												
												for(var i = 0; i < this.name.length; i++)
												{
													if(!isNaN(this.name[i]))
													{
														var x = document.getElementsByName("quantity["+this.name[i]+"]");
														
														if(this.name.indexOf('amount'))
															x = document.getElementsByName('amount['+this.name[i]+']');
															
														var amount = x[0].value;
														
														document.getElementsByName('total['+this.name[i]+']')[0].value = amount * this.value;
														
														var sum = 0;
														
														for(var j = 0; j < parseInt(this.name[i]) + 1; j++)
														{
															sum = sum + parseFloat(document.getElementsByName('total['+j+']')[0].value);
														}
														
														//alert(sum);
														
														document.getElementsByName('overall')[0].value = sum;
														//  = '2';
														
														break;
													}
												}
												
											 };
						newcell.appendChild(buttonnode);
						
					}
					else
					{
						var buttonnode= document.createElement('input');
						buttonnode.setAttribute('type','button');
						buttonnode.setAttribute('name','haha');
						buttonnode.setAttribute('value','REMOVE');
						buttonnode.setAttribute('style','width : 70px;');
						buttonnode.onclick = function() {
												
												var sum = 0;
												
												for(var j = 0; j < document.getElementsByName('total').length + 1 ; j++)
												{
													sum = sum + parseFloat(document.getElementsByName('total['+j+']')[0].value);
												}
												
												//alert(sum);
												
												document.getElementsByName('overall')[0].value = sum;
						
												row.remove();
											};
						newcell.appendChild(buttonnode);
					}
				
				}
			}
			
			function check(a_name,a_amount)
			{
				if(isNaN(a_amount))
				{
					alert('Invalid Value');
					this.value = 0;
					return false;
				}
				
				var x = document.getElementsByName("quantity[0]");
				
				if(a_name.indexOf('amount'))
					x = document.getElementsByName('amount[0]');
				
				var amount = x[0].value;
				
				document.getElementsByName('total[0]')[0].value = amount * a_amount;
	
				var sum = 0;
				
				for(var j = 0; j < document.getElementsByName('total').length + 1 ; j++)
				{
					sum = sum + parseFloat(document.getElementsByName('total['+j+']')[0].value);
				}
				
				//alert(sum);
				
				document.getElementsByName('overall')[0].value = sum;
			}
			
		</script>
	</head>
    <body alink="#1f57a0" vlink="#1f57a0" link="#1f57a0" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<form action="view_request_report.php" method="GET" name = "formReport" id = "formReport">
    	<div id="container">
            <?php include("menu.php");?>
        </div>
		<div id="container">
			<div id = "cc">
				<div>
					<span  class = 'title'>Application of Cash Advance</title>
				</div>
				<div class = 't' style = "display : inline-block;">
					<table border='0'>
                        <tr>
                            <td><b>Date Filed</b></td>
                            <td><?php echo $date = ($_GET['ID']) ? $result[4] : date("Y-m-d"); ?></td>
                        </tr>
						<tr>
                            <td><b>Name</b></td>
                            <td><?php echo $_SESSION['fullname'];?></td>						
						</tr>
						<tr>
                            <td><b>Department</b></td>
                            <td><?php echo $_SESSION['dept_name']; ?></td>						
						</tr>
                        <tr>
                            <td><b>Job Title</b></td>
                            <td><?php echo $_SESSION['job_title']; ?></td>
                        </tr>
						<tr>
							<td colspan='4'><hr/></td>
						</tr>
						<tr>
							<td colspan='4'><b>Cash Advance Information</b></td>
						</tr>
						<tr>
							<td colspan='4'><hr/></td>
						</tr>
						<tr>
							<td><b>Date Needed</b></td>
							<td><input type="text" id="date_needed" name="date_needed" placeholder = <?php echo date("Y-m-d");?> value = <?php echo date("Y-m-d");?> required/></td>
						</tr>
						<tr>
							<td><b>Client</b></td>
							<td><input type="text" id="client" name="client" placeholder = "Client Here" value = "Client Here" required/></td>
						</tr>
						<tr>
							<td><b>Purpose</b></td>
							<td colspan = 3><textarea rows = 1 cols = 115 id="purpose" name="purpose" placeholder = "Purpose Here" value = "Purpose Here" required/></textarea></td>
						</tr>
						<tr>
							<td colspan='4'><hr/></td>
						</tr>
						<tr>
							<td colspan='4'><b>Cash Advance Items</b></td>
						</tr>
						<tr>
							<td colspan='4'><hr/></td>
						</tr>
						<tr>
							<td colspan = 4>
								<table border = 0 id='t_color'>
									<tr>
										<th>Particulars</th>
										<th>Description</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Total Amount</th>
										<th></th>
									</tr>
									<tr>
										<td>
											<select name = 'particulars'>
												<option value = 'Transportation'>Transportation</option>
												<option value = 'Meal'>Meal</option>
												<option value = 'Others'>Others</option>
											</select>
										</td>
										<td>
											<textarea name = 'desc[]' id = 'desc' rows = 1 cols = 30 required/></textarea>
										</td>
										<td>
											<input type = 'text' name = 'amount[0]' id = 'amount' value = 0 width = 100% style = 'text-align : center' onblur = "check(this.name,this.value)" required/>
										</td>
										<td>
											<input type = 'text' name = 'quantity[0]' id = 'quantity' value = 0 width = 100% onblur = "check(this.name,this.value)" style = 'text-align : center' required/>
										</td>
										<td>
											<input type = 'text' name = 'total[0]' id = 'total' value = 0 width = 100% style = 'text-align : center' readonly required/>
										</td>
										<td>
											<input type = 'button' value = 'ADD' name = 'add_item' style = 'width : 70px;' onclick="addRow('t_color')"/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan = 3></td>
							<td>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<strong>Overall Total Amount</strong>
								<input type = 'text' name = 'overall' id = 'overall' style = 'text-align : center' value = 0 width = 100% readonly required/>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div id="footer">
                <br/>
                <p>Copyright 2011</p>     
            </div>
		</div>
    	</form>
    </body>
</html>