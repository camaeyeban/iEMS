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
		
		<!---->
		<script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        
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
			}
        </script>
	</head>
    <body alink="#1f57a0" vlink="#1f57a0" link="#1f57a0" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    	<div id="container">
            <?php include("menu.php");?>
        </div>
		<div id="container">
			<?php
				$emp_record = $_SESSION['emp_record'];
	
				
				$emp_num =$_GET['emp_num'];
				
				$request_record = array();
				$request_record['D'] = array();
				$request_record['T'] = array();
				$request_record['V'] = array();
				$request_record['R'] = array();
				
				$count_request = 0;
				
				for($i = 0; count($emp_record); $i++)
				{
					if($emp_record[$i]['EN'] == $emp_num)
					{
						echo "<br/>";
						echo "<div class = 'cc'>";
						echo "	<span class = 'title'>";
						echo "		" .  $emp_num . " - " . $emp_record[$i]['LN'] . ", " . $emp_record[$i]['FN'];
						echo "	</span>";
						echo "</div>";
						echo "<div class = 't'>";
						echo "	<table border = 0 width = 100% id = 't_color'>";
						echo "		<tr>";
						echo " 			<th>Date(s)</th>";
						echo " 			<th>Type(s)</th>";
						echo " 			<th>Value(s)</th>";
						echo " 			<th>Purpose(s)</th>";
						echo "		</tr>";
						
						$request_record['D'][$count_request] = '';
						$request_record['T'][$count_request] = array();
						$request_record['V'][$count_request] = array();
						$request_record['R'][$count_request] = array();
						
						for($j = 0; $j < count($emp_record[$i]['D']); $j++)
						{
							$count_times = 0;
							
							if($emp_record[$i]['C'][$j] != 0)
							{
								
								$request_record['D'][$count_request] = $emp_record[$i]['D'][$j];
								$request_record['T'][$count_request][$count_times] = '';
								$request_record['V'][$count_request][$count_times] = '';
								$request_record['R'][$count_request][$count_times] = '';
								
								if($emp_record[$i]['OTREG'][$j] != 0)
								{
									$request_record['T'][$count_request][$count_times] = 'Overtime on Regular Day';
									$request_record['V'][$count_request][$count_times] = $emp_record[$i]['OTREG'][$j];
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
									
									$count_times++;
								}//if there is OT on Regular Day
								
								if($emp_record[$i]['OTRSH'][$j] != 0)
								{
									$request_record['T'][$count_request][$count_times] = 'Overtime on Rest Day or Special Holiday';
									$request_record['V'][$count_request][$count_times] = $emp_record[$i]['OTRSH'][$j];
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
									
									$count_times++;
								}//if there is OT on Rest Day or Special Holiday
								
								if($emp_record[$i]['OTSHR'][$j] != 0)
								{
									$request_record['T'][$count_request][$count_times] = 'Overtime on Special Holiday on Rest Day';
									$request_record['V'][$count_request][$count_times] = $emp_record[$i]['OTSHR'][$j];
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
									
									$count_times++;
								}//if there is OT on Special Holiday on Rest Day
								
								if($emp_record[$i]['OTRHD'][$j] != 0)
								{
									$request_record['T'][$count_request][$count_times] = 'Overtime on Regular Holiday';
									$request_record['V'][$count_request][$count_times] = $emp_record[$i]['OTRHD'][$j];
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
									
									$count_times++;
								}//if there is OT on Regular Holiday
								
								if($emp_record[$i]['OTRHR'][$j] != 0)
								{
									$request_record['T'][$count_request][$count_times] = 'Overtime on Regular Holiday on Rest Day';
									$request_record['V'][$count_request][$count_times] = $emp_record[$i]['OTRGR'][$j];
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
									
									$count_times++;
								}//if there is OT on Regular Holiday on Rest Day
								
								if($emp_record[$i]['UT'][$j] != 0)
								{
									$request_record['T'][$count_request][$count_times] = 'Undertime';
									$request_record['V'][$count_request][$count_times] = $emp_record[$i]['UT'][$j];
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
									
									$count_times++;
								}
								
								if($emp_record[$i]['OS'][$j] != '')
								{
									$request_record['T'][$count_request][$count_times] = 'Offset';
									$request_record['V'][$count_request][$count_times] = $emp_record[$i]['OS'][$j];
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
									
									$count_times++;
								}
								
								if($emp_record[$i]['VL'][$j] != 0)
								{
									$request_record['T'][$count_request][$count_times] = 'Vacation Leave';
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
									
									if($emp_record[$i]['VLB'][$j] >= 0)
									{
										if($emp_record[$i]['VL'][$j] == 0.5)
											$request_record['V'][$count_request][$count_times] = 'Half Day';
										else
											$request_record['V'][$count_request][$count_times] = 'Whole Day';
									}
									else
										$request_record['V'][$count_request][$count_times] = 'Absent';
									
									$count_times++;
								}//if there is Vacation Leave
								
								if($emp_record[$i]['SL'][$j] != 0)
								{
									$request_record['T'][$count_request][$count_times] = 'Sick Leave or Emergency Leave';
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
									
									if($emp_record[$i]['SLB'][$j] >= 0)
									{
										if($emp_record[$i]['SL'][$j] == 0.5)
											$request_record['V'][$count_request][$count_times] = 'Half Day';
										else
											$request_record['V'][$count_request][$count_times] = 'Whole Day';
									}
									else
										$request_record['V'][$count_request][$count_times] = 'Absent';
									
									$count_times++;
								}//if there is Sick Leave or Emergency Leave
								
								/*
								if($emp_record[$i]['OBD'] == '' && $emp_record[$i]['OBA'] == '' && $emp_record[$i]['OBTS'] == '' && $emp_record[$i]['OBTE'] == '')
								{
									echo "wala";
								}//if there is an Official Business
								else
								{
									$request_record['V'][$count_request][$count_times] = "- " . $emp_record[$i]['OBD'] . " - " . $emp_record[$i]['OBTS'] . " - " . $emp_record[$i]['OBTE'] . " - " . $emp_record[$i]['OBA'];
									$request_record['T'][$count_request][$count_times] = 'Official Business';
									$request_record['R'][$count_request][$count_times] = $emp_record[$i]['RP'][$j];
								}
								*/
								
								if($count_times == 0)
								{
									$request_record['T'][$count_request][0] = 'Official Business';
									$request_record['V'][$count_request][0] = $emp_record[$i]['OBD'][$j] . " - " . $emp_record[$i]['OBTS'][$j] . "<br/>" . $emp_record[$i]['OBTE'][$j] . " - " . $emp_record[$i]['OBA'][$j];
									$request_record['R'][$count_request][0] = $emp_record[$i]['RP'][$j];
									
									$count_times++;
								}
								
								
								echo ($count_request % 2 != 0)? "<tr style = 'background-color : #d3dfee;'>" : "<tr style = 'background-color : #ffffff;'>";
								echo "	<td style = 'text-align : center; vertical-align: middle;' width = 10%>" . $request_record['D'][$count_request] . "</td>";
								echo "	<td style = 'text-align : center;' width = 20%>";
									
								for($k = 0; $k < $count_times; $k++)
									echo $request_record['T'][$count_request][$k] . "<br/>";
									
								echo "	</td>";
								echo "	<td style = 'text-align : center;' width = 20%>";
								
								for($k = 0; $k < $count_times; $k++)
									echo $request_record['V'][$count_request][$k] . "<br/>";
									
								echo "	</td>";
								echo "	<td style = 'padding-left: 15px;'>";
								
								$b = false;
								
								for($k = 0; $k < $count_times; $k++)
								{
									$explode = explode('~',$request_record['R'][$count_request][$count_times-1]);
									
									echo substr($explode[$k+1],3) . "<br/>";
								}
									
								echo "	</td>";
								
								echo "</tr>";
								
								
								$count_request++;
							}//if that date has a request
						}//for each date request
						
						
						echo "	</table>";
						echo "</div>";
						
						break;
					}//if emp_num found
				}//for 
			?>
		
			<!--FOOTER-->
			<div id="footer">
                <br/>
                <p>Copyright 2011</p>     
            </div>
		</div>
    	</form>
    </body>
</html>