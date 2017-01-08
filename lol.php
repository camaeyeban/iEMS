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
	chk_invalid_url();
	
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	
	require_once('calendar/classes/tc_calendar.php');
	

	function calendar1($date){
		  $myCalendar = new tc_calendar("date1", true, false);
		  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
		  $myCalendar->setPath("calendar/");
		  $myCalendar->setYearInterval(1970, 2020);
		  $myCalendar->setAlignment('left', 'bottom');
		  if($date!="0000-00-00"){
				$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
			}	  
		  $myCalendar->writeScript();
	}
	
	//JD-2013/07/16 - Added Calendar2 function for date of separation
	function calendar2($date){ 
		  $myCalendar = new tc_calendar("date2", true, false);
		  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
		  $myCalendar->setPath("calendar/");
		  $myCalendar->setYearInterval(1970, 2020);
		  $myCalendar->setAlignment('left', 'bottom');
		  if($date!="0000-00-00"){
				$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
			}	  
		  $myCalendar->writeScript();
	}
	
		if($_SESSION['rights']==1 || $_SESSION['rights']==5){	
			$prop = "";
			$dis = "";
		}else{
			$prop = "readonly";
			$dis = "disabled";
		}
	
		function managers($name){
			if(!is_numeric($name)){
				$qry = mysql_query("SELECT b_id, b_manager_name FROM ems_business_units WHERE b_manager_name='$name' ");
				$row = mysql_fetch_array($qry);
					if($name==$row[1]){
						return $row[0];
					}
			}
		}
		
	$date = $_POST['date_join']; // joined date
	$date2 = isset($_POST['date_sept'])? $_POST['date_sept'] : "0000-00-00"; //separation date
	$dept_code = $_POST['dept'];
	$jl = $_POST['joblevel'];
	$jt = $_POST['jobtitle'];
	$est = isset($_POST['est'])? $_POST['est'] : "NONE";
	$bio = $_POST['bio_id'];
	$fal = $_POST['falco_id'];
	$time_in = $_POST['time_in'];
	$time_out = $_POST['time_out'];
	$enabled = 'Enabled';
	
	//2014-06-16 - carol employed
	//
	
	if($est == 'EST004' || $est == 'EST005' || $date2 != '0000-00-00')
		$enabled = 'Disabled';
	else
		$enabled = 'Enabled';
	
	$managers = $_POST['managers'];
	
		if(isset($_POST['save']) && $_POST['save']=="save"){
			$mm = managers($managers);
			$str = "UPDATE ems_employee SET Biometrics_ID = '$bio', Falco_ID = '$fal', b_id='$mm', dept_code='$dept_code', job_title_code='$jt', jl_id='$jl', date_employ='$date', code='$est', date_sep='$date2', time_in = '$time_in', time_out = '$time_out' WHERE emp_num='$_GET[ID]' "; //JD-2013/07/19 - added employee's date of separation
			$qry = $dblink->db_qry($str);
			$msg = "Job successfully saved!";
			
			$str = "UPDATE ems_users SET status = '" . $enabled . "' WHERE emp_num = '" . $_GET['ID'] . "'";
			$qry = $dblink->db_qry($str);
			
		
			
			//echo $str; //JD-2013/07/24 - //JD-2013/07/24 - commented for debugging purpose only
		}
	
	if(isset($_GET['ID'])){
			$strqry = "SELECT e.emp_num, e.emp_firstname, e.emp_middlename, e.emp_lastname, e.dept_code, d.dept_name, e.job_title_code, jt.job_title_name, 
							jl.jl_id, jl.rank, jl.job_level, jl.grade, 
							es.code, es.name, e.date_employ, 
							b.b_manager_name, e.b_id, e.date_sep, e.Falco_id, e.Biometrics_ID, u.rights, e.time_in, e.time_out
							FROM ems_employee AS e
							LEFT JOIN ems_department AS d ON e.dept_code = d.dept_code
							LEFT JOIN ems_jobtitle AS jt ON e.job_title_code = jt.job_title_code
							LEFT JOIN ems_joblevel AS jl ON e.jl_id = jl.jl_id
							LEFT JOIN ems_emp_status AS es ON e.code = es.code 
							LEFT JOIN ems_business_units AS b ON b.b_id = e.b_id
							LEFT JOIN ems_users AS u ON u.emp_num = e.emp_num
							WHERE e.emp_num ='$_GET[ID]' ";
							
			$query = $dblink->db_qry($strqry);
			$result = $dblink->get_data($query);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>iEMS</title>
        <link href="calendar/calendar.css" rel="stylesheet" type="text/css">
    	
        
    	<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/profile-forms-format.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
		
        <script language="javascript" src="calendar/calendar.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
	    <script type="text/javascript" src="navigation.js"></script>
    	<script type="text/javascript" src="jsFunctions.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
 	  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  		<link rel="stylesheet" href="/resources/demos/sss">

  	<!-- time picker -->	
  	<link rel="stylesheet" type="text/css" href="jquery.ptTimeSelect.css" />
	<script type="text/javascript" src="jquery.ptTimeSelect.js"></script>


		<script type="text/javascript">
    	

			 $(function() {
			 $( "#date_join" ).datepicker({
		     
		    	dateFormat: "yy-mm-dd",
				//defaultDate: "+1w",
				yearRange: "-20:+0",
				changeMonth: true,
				changeYear: true,
				
		      });


			  $( "#date_sept" ).datepicker({
		     
		    	dateFormat: "yy-mm-dd",
				//defaultDate: "+1w",
				yearRange: "-20:+0",
				changeMonth: true,
				changeYear: true,
				
		      });
		    });
			

			
			function display(name_manager){
				var man = document.getElementById('name');
				var nn = document.getElementsByName('nn[]');
				var mname = document.getElementById('manager_name');
					if(name_manager==""){
						man.innerHTML = "Not yet assigned.";
					}else{
						man.innerHTML = name_manager;
						document.form_edit_job.manager_name.selectedIndex = 0;
							// for(x in nn){
								// if(nn[x].value == name_manager){
									// nn.innerHTML = nn[x].value;
									// break;
								// }
							// }
					}
			}
			
			function chkbox(){
				if(document.form_edit_job.chk.checked == true){
					document.form_edit_job.manager_name.disabled = false;
				}else{
					document.form_edit_job.manager_name.disabled = true;
				}
			}
		
			function validate(){
				var jt = document.form_edit_job.jobtitle.value;
				var dep = document.form_edit_job.dept.value;
					if(dep=="--Select--"){
						alert("Please fill-out required fields!");
						return false;
					}
			}
    	</script>
    </head>
    <body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    	<form name="form_edit_job" action="<?php $PHP_SELF;?>" method="POST">
            <div id="container">
                <?php include("menu.php"); ?>
                 <?php include("side_menu.php");?>
            
                <div id="right_top" style="float:right">
                    <div>
                        <p class="title2">Job</p>
                    </div>
                    <div style="width:60%; padding-left: 12px;">
                        <table border='0' width='100%' class="t">
                            <tr>
                                <td class="succ" colspan="4">
                                    <?php echo $x = ($msg) ? $msg.'<hr/>' : "" ;?>
                                </td>
                            </tr>
                            <tr>
                                <td width='40%'>Job Title:</td>
                                <td>
                                    <select name="jobtitle" <?php echo $dis;?>>
                                    <?php
                                    
                                        if($result[7]){
                                            echo '<option value="',$result[6],'">',$result[7],'</option>';
                                            $qry = $dblink->db_qry("SELECT job_title_name, job_title_code FROM ems_jobtitle");
                                            
                                            while($data = $dblink->get_data($qry)){
                                                echo '<option value="',$data[1],'">',$data[0],'</option>';
                                            }											
                                        } else {
                                            echo '<option value="">--Select--</option>';
                                            $qry = $dblink->db_qry("SELECT job_title_name, job_title_code FROM ems_jobtitle");
                                            
                                            while($data = $dblink->get_data($qry)){
                                                echo '<option value="',$data[1],'">',$data[0],'</option>';
                                            }
                                        }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Employment Status: <span class="a">*</span></td>
                                <td>
                                    <select name="est" <?php echo $dis;?>>
                                    <?php
                                    
                                        if($result[13]){
                                            echo '<option value="',$result[12],'">',$result[13],'</option>';
                                            $qry = $dblink->db_qry("SELECT name, code FROM ems_emp_status");
                                            
                                            while($data = $dblink->get_data($qry)){
                                                echo '<option value="',$data[1],'">',$data[0],'</option>';
                                            }
                                        } else {
                                            echo '<option value="">--Select--</option>';
                                            $qry = $dblink->db_qry("SELECT name, code FROM ems_emp_status");
                                            
                                            while($data = $dblink->get_data($qry)){
                                                echo '<option value="',$data[1],'">',$data[0],'</option>';
                                            }
                                        }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Job Level:</td>
                                <td>
                                    <select name="joblevel" <?php echo $dis;?>>
                                    <?php
                                    
                                        if($result[9] && $result[10] && $result[11]){
                                            echo '<option value="',$result[8],'">',$result[9] ." - Level ".$result[10]." - Grade ".$result[11],'</option>';
                                            $qry = $dblink->db_qry("SELECT rank, job_level, grade, jl_id FROM ems_joblevel");
                                            
                                            while($data = $dblink->get_data($qry)){
                                                echo '<option value="',$data[3],'">',$data[0]. " - Level ".$data[1]. " - Grade ".$data[2],'</option>';
                                            }
                                        } else {
                                            echo '<option value="">--Select--</option>';
                                            $qry = $dblink->db_qry("SELECT rank, job_level, grade, jl_id FROM ems_joblevel");
                                            
                                            while($data = $dblink->get_data($qry)){
                                                echo '<option value="',$data[3],'">',$data[0]. " - Level ".$data[1]. " - Grade ".$data[2],'</option>';
                                            }
                                        }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Joined Date:</td>
                                <td><input type="text" placeholder="Select Joined Date" style="text-align:center" id="date_join" size="15" maxlength="10" name="date_join" value="<?php echo $result[14]; ?>"/></td>
                            </tr>
                            <tr>
                                <td>Separation Date:</td> <!--//JD-2013/07/19 - added employee's date of separation //-->
                                <td><input type="text" placeholder="Select Separation Date" style="text-align:center" id="date_sept" size="15" maxlength="10" name="date_sept" value="<?php echo $result[17]; ?>"/></td>
                            </tr>
                           
                            <tr>
                                <td>Department: <span class="a">*</span></td>
                                <td>																	
                                    <?php
                                    
                                        $qry = mysql_query("SELECT d.dept_code , dept_name, b_manager_name, b_id FROM ems_department as d
                                                LEFT JOIN ems_business_units as b ON d.dept_code = b.dept_code");
                                        echo '<select name="dept" ',$dis,'>';
                                        if($result[5]){
                                            echo '<option value="',$result[4],'" onclick="display(\'',$result[15],'\');">',$result[5],'</option>';
                                            while($data = mysql_fetch_array($qry)){
                                                if($result[5]!=$data[1]){
                                                    echo '<option value="',$data[0],'" onclick="display(\'',$data[2],'\');">',$data[1],'</option>';		
                                                }										
                                            }											
                                        } else {
                                            echo '<option>',"--Select--",'</option>';
                                            while($data = mysql_fetch_array($qry)){
                                                echo '<option value="',$data[0],'" onclick="display(\'',$data[2],'\');">',$data[1],'</option>';												
                                            }
                                        }
                                        
                                        echo '</select>';
										//echo $qry;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Manager:</td>
                                <td>
                                    <?php
    
                                        $qry2 = mysql_query("SELECT b_id, b_manager_name FROM ems_business_units");
                                        echo '<select name="managers" id="manager_name" ',$dis,'>';
                                        
                                        if($result[16]){
                                            echo '<option id="name">--Select--</option>';
                                            echo '<option selected >',$result[15],'</option>';
                                            while($data2 = mysql_fetch_array($qry2)){
                                                if($result[15]!=$data2[1]){
                                                    echo '<option>',$data2[1],'</option>';
                                                }
                                            }		
                                        } else {
                                            echo '<option id="name">--Select--</option>';
                                            while($data2 = mysql_fetch_array($qry2)){										
                                                echo '<option>',$data2[1],'</option>';
                                            }
                                        }
                                        
                                        echo '</select>';
                                    	//echo $qry2;
									?>
                                    <!--<input type="checkbox" name="chk" id="chk" onclick="chkbox();" <?php //echo $dis; ?>/>-->
                                </td>
                            </tr>
							<?php
								echo "
										<tr>
											<td>Biometrics ID : </td>
											<td><input type = 'text' name = 'bio_id'", $prop ," value = '".$result[19]."' /></td>
										</tr>
										<tr>
											<td>Falco ID : </td>
											<td><input type = 'text' name = 'falco_id'", $prop ," value = '".$result[18]."' /></td>
										</tr>
									";
							?>


							<tr>
								<td>Required Time In:</td>
								<td id='in_time'><input name="time_in" class="time" id="time_in" type="text"   placeholder="Select Time In" size="15" maxlength="10" style="text-align:center" value="<?php echo $result[21]?>" <?php $dis ?>> </td>

							</tr>

							<tr>
								<td>Required Time Out:</td>
								<td id='out_time'><input name="time_out" class="time" id="time_out" type="text"  placeholder="Select Time Out" size="15" maxlength="10" style="text-align:center" value="<?php echo $result[22]?>" <?php $dis ?>> </td>

							</tr>

							<script type="text/javascript">
								 $(document).ready(function(){
			           			 // find the input fields and apply the time select to them.
			            		//$('#s_time').val("8:30 AM");
			            		$('#in_time input').ptTimeSelect({DefaultHr: '8', DefaultMin: '30', DefaultAmPm: 'am', onClose: function() {
            					time_diff(); }});

			            		$('#out_time input').ptTimeSelect({DefaultHr: '6', DefaultMin: '30', DefaultAmPm: 'pm', onClose: function() {
            					time_diff(); }});


			            	

			            		//document.getElementById('s_time').value = "8:30 AM";
			       			 });
							</script>
								<?php
                           		if($_SESSION['rights'] != 1)
                           		{

                           			echo "<script>
                           				 document.getElementById('date_join').disabled = true; 
                           				 document.getElementById('date_sept').disabled = true; 
                           				 document.getElementById('time_in').disabled = true;
                           				 document.getElementById('time_out').disabled = true;

                           			 </script>";
                           		}

                           	?>
							<tr><td colspan='2'><hr/></td></tr>
            <!-- hahah	        
			<!--EMPLOYMENT CONTRACT
                            <tr><th colspan='2'>Employment Contract</th></tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr><td colspan='2'><hr/></td></tr>
    
    		<!--SCHEDULE
                            <tr><th colspan='2'>Schedule</th></tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
            -->
							<tr>
                                <?php
                                    if($_SESSION['rights']==1 || $_SESSION['rights']==5){
                                        echo '<td><input type="submit" class="save" id="save" name="save" value="save"  onclick="return validate();"/></td>';
										echo '  <td colspan="2" align="right">Field marked with an asterisk <span class="a">*</span> is required.</td>';
								   }
                                ?>
                              
                            </tr>
                        </table>
                    </div>
                    <div id="footer">
                        <br/>
                        <p>Copyright 2011</p>     
                    </div>				
                </div>
            </div>
		</form>
    </body>
</html>